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
	//echo "UPDATE `contact` SET `$col` = '$id' WHERE `id` = '$val'";
	mysql_query("UPDATE `contact` SET `$col` = '$id' WHERE `id` = '$val'",$con) or die(mysql_error());
	if($col == 'inroducer'){
		mysql_query("UPDATE `contact` SET `%brokerage` = '10' WHERE `id` = '$val'",$con) or die(mysql_error());
	}
	$i++;
	}
}
echo "Fields Sucessfully Updated For ".$i." Records";
?>
