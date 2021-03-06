<html>

<head>
	<title>師大環境通報系統</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<style>
		body {
			background-color: #bbbf95;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.bigTitle {
			cursor: default;
			font-size: 3rem;
			text-shadow: black 1rem 0.1em 0.2em;
			display: flex;
			justify-content: center;
		}

		.signInBar {
			background-color: #23345c;
			border-radius: 2rem;
			box-shadow: -10px 10px 0px 0px black;
			color: aliceblue;
			width: 700;
			padding: 2rem;
		}

		.signInBar p {
			cursor: default;
			font-size: 1.4rem;
			font-weight: bolder;
		}


		.inputText {
			width: 32rem;
			height: 2.5rem;
			margin-left: 0.rem;
			border-radius: 20px;
			text-align: center;

		}

		.inputText:focus {
			background-color: azure;
			transition: 1s;
			outline: none
		}


		.button {
			float: right;
			margin-left: 3rem;
			width: 7rem;
			font-size: 2rem;
			background-color: black;
			color: aliceblue;
			border-radius: 7%;
			box-shadow: 4px 3px 4px rgb(63, 134, 192);
			font-weight: bold;

		}

		.button:hover {
			color: #e76f45;
			background-color: aliceblue;
			box-shadow: 4px 3px 4px rgb(139, 28, 28);
			transition: 1s;
			cursor: pointer;
		}
	</style>
</head>

<body>


	<form class="signInBar" action="" method="post" name="signInForm">
		<h1 class="bigTitle">師大環境通報系統</h1>

		<p>帳號</p>
		<input class="inputText" placeholder="請輸入帳號......" type="text" name="account" />

		<p>密碼</p>
		<input class="inputText" placeholder="請輸入密碼......" type="password" name="password" />

		<p>
			<input style="margin-right: 2rem" class="button" type="submit" value="登入" onclick="signIn()" />
			<input style="margin-left:2rem" class="button" type="submit" value="註冊" onclick="signUp()" />
		</p>

	</form>

	<script>
		function signIn() {
			document.signInForm.action = "./signIn.php"
		}

		function signUp() {
			document.signInForm.action = "./register.php"

		}
	</script>

</body>

</html>