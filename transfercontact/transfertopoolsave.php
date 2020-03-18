<?php
session_start();
ob_start();
include("../include/conFig.php");
$from = $_GET['from'];
$shift = $_GET['shift'];
$LeadSource = $_GET['LeadSource'];
$LeadResponse = $_GET['LeadResponse'];


if($LeadResponse==0 && $LeadSource != 0)
{
	$getData = mysql_query("SELECT `id`,`leadsource` FROM `contact` WHERE `delete` = '0' AND contact.converted = '0' AND `ownerid` = '$from' LIMIT $shift",$con) or die(mysql_error());
	while($row = mysql_fetch_array($getData))
	{
		mysql_query("UPDATE `contact` SET `ownerid` = '0', `read` = '0', `description` = '', `leadstatus` = '', `latestresponse` = '1', `leadsource` = '$LeadSource', `alloted` = '0', `callbackdate` = '', `callbacktime` = '' WHERE `id` = '$row[0]'",$con) or die(mysql_error());
		mysql_query("DELETE FROM `noteline` WHERE `cid` = '$row[0]'",$con) or die(mysql_error());
		
	}
}
else if($LeadResponse!=0 && $LeadSource == 0)
{
	$getData = mysql_query("SELECT `id`,`leadsource` FROM `contact` WHERE `delete` = '0' AND contact.converted = '0' AND `ownerid` = '$from' and latestresponse ='$LeadResponse' LIMIT $shift",$con) or die(mysql_error());
	while($row = mysql_fetch_array($getData))
	{
		mysql_query("UPDATE `contact` SET `ownerid` = '0', `read` = '0', `description` = '', `leadstatus` = '', `latestresponse` = '1', `alloted` = '0', `callbackdate` = '', `callbacktime` = '' WHERE `id` = '$row[0]'",$con) or die(mysql_error());
		mysql_query("DELETE FROM `noteline` WHERE `cid` = '$row[0]'",$con) or die(mysql_error());
		
	}
	
}

header("location:transferView.php?message=Successfully Transferred");



  



?>
