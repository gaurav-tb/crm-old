<?php
ob_start();
include("include/conFig.php");
$owner = $_GET['owner'];
$cid = $_GET['cid'];
$i = $_GET['i'];
$head = $_GET['header'];
if($owner != '' && $cid != '')
{
$getData=mysql_query("SELECT `id` FROM `teamamtes` WHERE `mateid`='$owner' AND `teamid`='6'",$con) or die(mysql_error());

$row=mysql_fetch_array($getData);


$currentDate = strtotime($datetime);
$futureDate = $currentDate+(432000);
$ClosingDate=date("Y-m-d H:S",$futureDate);

mysql_query("UPDATE `customersupport` SET `allotmentid` = '$owner',`ClosingDate`='$ClosingDate' WHERE `clientid` = '$cid'",$con) or die(mysql_error());
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
