<?php session_start();
ob_start();
$expire = time()-60;
include("include/conFig.php");
mysql_query("UPDATE `user` SET `login`='0' WHERE `id` = '$loggeduserid'",$con) or die(mysql_error());
	setCookie("loggedusername",$username,$expire,"/");
	setCookie("loggeduserid",$loggedid,$expire,"/");
	setCookie("loggedname",$name,$expire,"/");
	setcookie("loggedkey",$loggedkey,$expire, "/");

session_destroy();
header("location:index.php");
?>
