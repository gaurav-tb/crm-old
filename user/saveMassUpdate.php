<?php 
include("../include/conFig.php");
$dx = $_GET['dx'];
$id = $_GET['id'];
$col = $_GET['column'];
$dx = explode(",",$dx);
$i=0;
foreach($dx as $val)
{
	if($val != '0')
	{
	//echo "UPDATE `employee` SET `$col` = '$id' WHERE `id` = '$val'";
	//echo "UPDATE `employee` SET `$col` = '$id' WHERE `id` = '$val'";
	mysql_query("UPDATE `employee` SET `$col` = '$id' WHERE `id` = '$val'",$con) or die(mysql_error());
	$i++;
	}
}
echo "Fields Sucessfully Updated For ".$i." Records";
?>
