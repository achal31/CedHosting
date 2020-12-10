<!---------------LOGOUT PAGE USE TO DESTROY ALL THE SESSION ------------------>
<?php

session_start();
session_destroy();
header("location: index.php");


?>
