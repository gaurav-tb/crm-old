<?php 
include("../include/conFig.php");
$eid = $_GET['UserId'];
$BucketId = $_GET['TargetId'];
$i='1';
	
mysql_query("UPDATE `employee` SET `TargetBucket`= '$BucketId' WHERE `id`='$eid'",$con) or die(mysql_error());
	
?>
