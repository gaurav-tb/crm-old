<?php
include("../include/conFig.php");
$theme = $_GET['theme'];
mysql_query("UPDATE `employee` SET `theme` = '$theme' WHERE `id` = '$loggeduserid'",$con) or die(mysql_error());
/*
if($theme =='css/style-purple.css')
{
'<img src="images/loadin3.gif"/>';
}
if($theme =='css/style-orange.css')
{
'<img src="images/loading-orange.gif"/>';
}
if($theme =='css/style-teal.css')
{
'<img src="images/loading-teal.gif"/>';
}

*/
?>
