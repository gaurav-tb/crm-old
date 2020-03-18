<?php
error_reporting(0);
if(isset($_COOKIE['lcusername']))
{
include("connection.php");
date_default_timezone_set('Asia/Calcutta');
$loggeduser = $_COOKIE['lcusername'];
$loggedname = $_COOKIE['lcname'];
$loggeduserid = $_COOKIE['llcuserid'];
$datetime = date("Y-m-d H:i:s");
$date = date("Y-m-d");
}
else
{
header("location:index.php");
}
?>
