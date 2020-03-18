<?php
include("../include/conFig.php");
$id = $_GET['id'];
$value= $_GET['value'];
$i = $_GET['i'];
mysql_query("UPDATE `servicecall` SET `approved` = '$value' WHERE `id` = '$id'",$con) or die(mysql_query());
?>