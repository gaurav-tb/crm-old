<?php 
include("../include/conFig.php");
$catid = $_GET['catid'];
$nos = $_GET['nos'];
//echo "UPDATE `moresms` SET `numbers` = '$nos' WHERE `serviceid` = '$catid'";
mysql_query("UPDATE `moresms` SET `numbers` = '$nos' WHERE `serviceid` = '$catid' AND `delete` = '0'",$con) or die(mysql_error());
echo 'Numbers Added Sucessfully';
?>
