<?php
include("../../include/conFig.php");
$value = $_GET['value'];
$id = $_GET['id'];

$output=mysql_query("UPDATE `templateemail` SET `templatecategory` = '$value' WHERE `id` = '$id'",$con) or die(mysql_error());
if($output==1)
{
echo '1';	
}

?>