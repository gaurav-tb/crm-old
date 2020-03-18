<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$i=$_GET['i'];

$getData = mysql_query("SELECT  * FROM `cannottalkto` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
$userid = $row['userid'];
$users = explode(",",$row['cannottalkto']);
$user = str_ireplace('-','',$users);
$replaceInCtt = "-".$row['userid']."-,";

////////////Deleting userid from Cannottalkto 
	$getCtt = mysql_query("SELECT * FROM `cannottalkto` WHERE `cannottalkto` LIKE '%$userid%' AND `delete` = '0'",$con) or die(mysql_error());
		while($rowCtt = mysql_fetch_array($getCtt))
		{
		$cid = $rowCtt['id']; 
		$newCtt = str_ireplace($replaceInCtt,"",$rowCtt['cannottalkto']);
		mysql_query("UPDATE `cannottalkto` SET `cannottalkto` = '$newCtt' WHERE `id` = '$cid'",$con) or die(mysql_error());
		}

mysql_query("DELETE FROM `cannottalkto` WHERE `id` = '$id'") or die(mysql_error());

mysql_query("DELETE FROM `cannottalkto` WHERE `cannottalkto` = ''",$con) or die(mysql_error());

?>