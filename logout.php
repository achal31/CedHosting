<!---------------LOGOUT PAGE USE TO DESTROY ALL THE SESSION ------------------>
<?php

session_start();
if(session_destroy()) {
unset($_SESSION['username']);
header("location: index.php");
}
?>
