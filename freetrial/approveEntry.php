<?php
include("../include/conFig.php");
$dx = $_GET['dx'];
$table = $_GET['table'];
$value = $_GET['value'];

$dx = explode(",",$dx);
foreach($dx as $val)
{
	if($value == '1')
	{
		$note = "Freetrial approved for requestid FRT".$val;
		$subject = 'Fapproved';
	}
	else
	{
		$note = "Freetrial denied for requestid FRT".$val;
		$subject = 'Fdenied';
	}
$getCid = mysql_query("SELECT `cid` FROM `servicecall` WHERE `id` = '$val'",$con) or die(mysql_error());
$rowCid = mysql_fetch_array($getCid);
$cid = $rowCid[0];
mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$cid', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());
mysql_query("UPDATE `$table` SET `approved` = '$value' WHERE `id` = '$val'",$con) or die(mysql_error());
}
?>