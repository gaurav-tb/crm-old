<?php
include("../include/conFig.php");
$chkid = $_GET['chkid'];
$mergeto = $_GET['mergeto'];
$getData = mysql_query("SELECT * FROM `contact` WHERE `id` = '$mergeto' AND `delete` = '0'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
echo $merge = $row[0].", ".$row[1].", ".$row[2].", ".$row[3].", ".$row[4].", ".$row[5].", ".$row[6].", ".$row[7].", ".$row[8].", ".$row[9].", ".$row[10].", ".$row[11].", ".$row[12].", ".$row[13].", ".$row[14].", ".$row[15].", ".$row[16].", ".$row[17].", ".$row[18];
mysql_query("UPDATE `contact` SET `description` = '$merge' WHERE `id` = '$chkid' AND `delete` = '0'",$con) or die(mysql_error());
mysql_query("UPDATE `contact` SET `delete` = '1' WHERE `id` = '$mergeto'",$con) or die(mysql_error());
?>