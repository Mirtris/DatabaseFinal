<?php
session_start();
$conn = require('config.php');
// 是否為管理員
$admin = require('isAdmin.php');
$topMargin = '20rem';
if ($_SESSION['user_type'] == '管理員') {
	$topMargin = '27rem';
}
//一頁幾筆
define("TRACK_PAGE_LIMIT", 5);

// 分頁數
$sql_count = sprintf(
	$sql_count = "SELECT count(*) AS totalRows FROM `team10`.`task` where user_ID = %s",
	$_SESSION['user_id']
);
$sth_count = $conn->query($sql_count);
$result_count = $sth_count->fetch_assoc();
$totalRows = $result_count['totalRows'];
$totalPages = ceil($totalRows / TRACK_PAGE_LIMIT);

//抓各頁資料
$page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
$previousPage = (($page - 1) < 1) ? 1 : ($page - 1);
$nextPage = (($page + 1) > $totalPages) ? $totalPages : ($page + 1);

$sql =  sprintf(
	"SELECT * FROM `team10`.`task` where user_ID = %s LIMIT %s, %s",
	$_SESSION['user_id'],
	($page - 1) * TRACK_PAGE_LIMIT,
	TRACK_PAGE_LIMIT
);

$result = $conn->query($sql);



?>

<!DOCTYPE html>
<html>

<head>
	<title>HomePage</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="./track.css">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	<style>
		.admin {
			display: <?= $admin ?>;
		}

		.inMid {

			margin-top: 27rem;
		}

		.textArea {
			font-size: 1.15rem;
			border: none;
			background-color: rgb(39, 34, 34);
			color: #fff;
			display: flex;
			padding: 0.5rem;
			resize: none;
			float: left;
			width: 95%;
			outline: none;
		}

		@media screen and (max-width:1240px) {
			.board {
				margin-top: 4rem;
			}

		}

		@media screen and (max-width:610px) {
			.board {
				margin-top: 8rem;

			}
		}

		@media screen and (min-width:1420px) {
			.topBar {
				position: absolute;
				right: 0rem;
			}

			.admin {
				position: relative;
				top: 7.8rem;
			}
		}
	</style>

</head>

<body>

	<div class="Pboard">
		<a href="./homepage.php">
			<h1 class="mainTitle">師大環境通報系統</h1>
		</a>
		<nav>
			<ul class="topBar">
				<li><a href="./task.php">案件查詢</a></li>
				<li><a href="./track.php">回報案件追蹤</a></li>
				<li><a href="./contact.php">聯絡我們</a></li>
				<li><a href="./profile.php">個人資料</a></li>
				<li><a href="./logout.php">登出</a></li>
			</ul>
			<ul class="admin">
				<li><a href="./taskManage.php">管理案件</a></li>
				<li><a href="./userManage.php">管理使用者</a></li>
				<li><a href="./companyManage.php">管理款項</a></li>
			</ul>
		</nav>
	</div>

	<div class="inMid">

		<table width="100%" class="board">
			<thead>
				<tr align="center">
					<td class="boardTitle">案件ID</td>
					<td class="boardTitle">案件類別</td>
					<td class="boardTitle">案件通報時間</td>
					<td class="boardTitle">地點</td>
					<td class="boardTitle">狀態</td>
					<td class="boardTitle">案件簡述</td>
				</tr>
			</thead>
			<tbody>
				<?php while ($board = $result->fetch_assoc()) : ?>
					<?php
					if ($board['flag'] == 0) {
						$board['flag'] = '未處理';
					} else if ($board['flag'] == 1) {
						$board['flag'] = '處理中';
					} else if ($board['flag'] == 2) {
						$board['flag'] = '已處理';
					} ?>
					<tr align="center">
						<td class="boardInput" name="task_ID"><?php echo $board['task_id'] ?></td>
						<td class="boardInput" name="task_type"><?php print $board['task_type'] ?></td>
						<td class="boardInput" name="task_time"><?php print $board['time'] ?></td>
						<td class="boardInput" name="locatio"><?php print $board['location'] ?></td>
						<td class="status" name="task_status" bgcolor="<?php if ($board['flag'] === '未處理') {
																			echo "#A7414A";
																		} elseif ($board['flag'] === '處理中') {
																			echo "#F28A30";
																		} elseif ($board['flag'] === '已處理') {
																			echo "#ADFF2F";
																		} ?>"><?php print $board['flag'] ?></td>
						<td class="boardInput" name="problem"><textarea class="textArea" readonly="true" rows="2" cols="10"><?php print $board['problem'] ?></textarea> </td>
					</tr>
				<?php endwhile ?>



			</tbody>
		</table>
		<nav>
			<ul class="pagination">
				<li class="page-item"><a class="page-link" href="track.php?page=<?php print $previousPage ?>">前一頁</a></li>
				<?php for ($i = 1; $i <= $totalPages; $i++) : ?>
					<li class="page-item<?php if ($page == $i) print 'active' ?>"><a class="page-link" href="track.php?page=<?php print $i ?>"><?php print $i ?></a></li>
				<?php endfor ?>
				<li class="page-item"><a class="page-link" href="track.php?page=<?php print $nextPage ?>">下一頁</a></li>
			</ul>
		</nav>
	</div>
	<script>
		function submitForm() {
			document.forms[0].submit();
		}
	</script>
	</div>
</body>

</html>