<?php
include("include/conFig.php");
$id = $_GET['id'];
mysql_query("DELETE FROM `customview` WHERE `id` = '$id'",$con) or die(mysql_error());
?>