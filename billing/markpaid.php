<?php
include("../include/conFig.php");
$id=$_GET['id'];
$getCid = mysql_query("SELECT `cid`,`transactionalid` FROM `invoice` WHERE `id` = '$id'",$con) or die(mysql_error());
$rowCid= mysql_fetch_array($getCid); 
$chkAlready = mysql_query("SELECT `id` FROM `servicecall` WHERE `cid` = '$cid' AND `type` = 'c'",$con) or die(mysql_error());
if(mysql_num_rows($chkAlready) == 1)
{
$note = "Client conversion approved for PurchaseId <strong>CLT".$id."</strong> AND Inovice Number <strong>INV".$id."</strong>";
mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('Capproved', '$note', '$rowCid[0]', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());
}
else
{
$note = "New services approved for PurchaseId <strong>CLT".$id."</strong> AND Inovice Number <strong>INV".$id."</strong>";
mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('Bapproved', '$note', '$rowCid[0]', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());
}
mysql_query("UPDATE `invoice` SET `approved` = '1'  WHERE `id`='$id' ",$con ) or  die(mysql_error());
mysql_query("UPDATE `servicecall` SET `approved` = '1' WHERE `transactionalid` = '$rowCid[1]'",$con) or die(mysql_error());
?>




