<?php
session_start();
ob_start();
include("../include/conFig.php");
$from = $_GET['from'];
$shift = $_GET['shift'];
$to = $_GET['to'];
$identify = $_GET['identify'];
$ls = $_GET['leadstatus'];
$cbdate = $_GET['callbackdate'];
if($ls == "")
{
$lsStr = "";
}
else
{
$lsStr = ",`leadstatus` = '$ls' ";
}
if($cbdate == "")
{
$cbStr = "";
}
else
{
$cbStr = ",`callbackdate` = '$cbdate' ";
}

if($identify == '')
{
$idstr = "(1=1)";
}
else
{
$idstr = "contact.converted = '".$identify."'";
}

$getNames = mysql_query("SELECT e1.name as fromname,e2.name as toname FROM employee as e1,employee as e2 WHERE e1.id = '$from' AND e2.id = '$to'",$con) or die(mysql_error());
$rowNames = mysql_fetch_array($getNames);
$new = $rowNames[1];
$old = $rowNames[0];
$getData = mysql_query("SELECT `id` FROM `contact` WHERE `delete` = '0' AND ".$idstr." AND `ownerid` = '$from' LIMIT ".$shift,$con) or die(mysql_error());
while($row = mysql_fetch_array($getData))
{
mysql_query("UPDATE `contact` SET `ownerid` = '$to', `read` = '0', `transfrom` = '$from' ".$lsStr."".$cbStr." WHERE `id` = '$row[0]'",$con) or die(mysql_error());
$note = "<span style='color:#3B5998;text-transform:capitalize'>".$new."</span> is the new Owner. ".$old." no longer holds control of this record.";
$subject = 'Oship';
$note = str_ireplace("'","\'",$note);
mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$row[0]', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());
}

header("location:transferView.php?message=Successfully Transferred");
?>