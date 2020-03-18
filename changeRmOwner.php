<?php
ob_start();
include("include/conFig.php");
$owner = $_GET['RMOwnerid'];
$cid = $_GET['cid'];
$i = $_GET['i'];
$head = $_GET['header'];
if($owner != '' && $cid != '')
{
$getOwner=mysql_query("SELECT `name` FROM `employee` WHERE `employee`.`id`='$owner'",$con) or die(mysql_error());
$row=mysql_fetch_array($getOwner);

mysql_query("UPDATE `customersupport` SET `RMOwnerid` = '$owner' WHERE `clientid` = '$cid'",$con) or die(mysql_error());

$note = "Client Relationship Manager has been changed to <strong>" .$row[0]. "</strong> <strong> Changed By ".$loggedname."</strong>";

mysql_query("INSERT INTO `noteline`(`subject`,`note`,`cid`,`id`,`createdate`,`updatedby`,`delete`) values('Oship','$note','$cid','','$datetime','$loggeduserid','0')",$con)or die(mysql_error()); 
mysql_query("UPDATE `customersupport` SET `LastRMOwnerChangeDate` = '$datetime' WHERE `clientid` = '$cid'",$con) or die(mysql_error());

}
if($head == 1)
{
header("location:clients/edit.php?id=".$cid."&i=".$i);
}
else
{
header("location:leads/edit.php?id=".$cid."&i=".$i);
}
?>
