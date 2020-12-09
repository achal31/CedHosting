<?php
if(isset($_GET['data']))
{
    include_once ('Classes/User.php');
    $userdata = new User();
    $sql= $userdata->userverify($_GET['data']);
    header("Location:login.php");
}
 ?>