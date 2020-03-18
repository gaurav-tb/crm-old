<?php
// ini_set('display_errors', false);
// error_reporting(0);


if(isset($_COOKIE['loggedusernamesws']))
{
include("connection.php");
date_default_timezone_set('Asia/Calcutta');
$loggeduser = $_COOKIE['loggedusernamesws'];
$loggedname = $_COOKIE['loggednamesws'];
$loggeduserid = $_COOKIE['loggeduseridsws'];
$loggedkey = $_COOKIE['loggedkeysws'];
$perm=$_COOKIE['permsws'];
$loggedemail=$_COOKIE['loggedemail'];
$loggedmobile=$_COOKIE['loggedusermobile'];



$profilePer = mysql_query("SELECT `permission` FROM `profile` WHERE `id` = '$perm'",$con) or die(mysql_error());

$permis = mysql_fetch_array($profilePer);

$thisPer = explode(",",$permis[0]);
//print_r($thisPer);
$datetime = date("Y-m-d H:i:s");
$date = date("Y-m-d");




$initial = date("Y-m-d 00:00:00", strtotime("-6 day",strtotime($datetime)));	
$final = date("Y-m-d 23:59:59", strtotime("+0 day", strtotime($datetime)));	


}
else
{
header("location:index.php");
}
?>
