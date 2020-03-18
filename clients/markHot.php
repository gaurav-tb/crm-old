<?php
include("../include/conFig.php");
$id = $_GET['id'];
$todo = $_GET['todo'];
if($todo == 'hot')
{
$toput = '1';
}
else
{
$toput = '0';
}
mysql_query("UPDATE `contact` SET `mark` = '$toput' WHERE `id` = '$id'",$con) or die(mysql_error());

?>
