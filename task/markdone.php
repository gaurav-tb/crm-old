<?php
include("../include/conFig.php");
$id = $_GET['id'];

mysql_query("UPDATE `task` SET `status` = '1' WHERE `id` = '$id'",$con) or die(mysql_error());
?>