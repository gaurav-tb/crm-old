<?php
include("../include/conFig.php");
$invid = $_GET['invid'];
if($invid != '')
{
$getTid = mysql_query("SELECT `transactionalid` FROM `invoice` WHERE `id` = '$invid'",$con) or die(mysql_error());
$row = mysql_fetch_array($getTid);
	if($row[0] != '')
	{
	mysql_query("DELETE FROM `invoice` WHERE `id` = '$invid'",$con) or die(mysql_error());
	mysql_query("DELETE FROM `servicecall` WHERE `transactionalid` = '$row[0]' AND `type` = 'c'",$con) or die(mysql_error());
	}
}
?>