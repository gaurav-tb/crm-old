<?php
include("../../include/conFig.php");
$me = $_GET['from'];
$other = $_GET['to'];
mysql_query("UPDATE `chat` SET `delete` = '1' WHERE ((`from` = '$me' AND `to` = '$other') OR (`from`  = '$other' AND `to`  = '$me'))",$con) or die(mysql_error());
?>