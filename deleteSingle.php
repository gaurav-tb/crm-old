<?php
include("include/conFig.php");
$table = $_GET['table'];
$id = $_GET['id'];

mysql_query("UPDATE `$table` SET `delete` = '1' WHERE `id` = '$id'",$con) or die(mysql_error());
?>