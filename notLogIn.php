<?php 
 function function_notLogIn($message)
 {
     // Display the alert box  
     echo "<script>alert('$message');
      window.location.href='index.php';
     </script>";
     return false;
 }
 ?>