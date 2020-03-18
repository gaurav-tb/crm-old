<?php
include("../include/conFig.php");
$value = $_GET['value'];
$type = $_GET['type'];
$id = $_GET['id'];

if($type == 'lr')
{
	$field = 'latestresponse';
}
else
{
	$field = 'leadstatus';
}

mysql_query("UPDATE `contact` SET `$field` = '$value' WHERE `id` = '$id'",$con) or die(mysql_error());

?>