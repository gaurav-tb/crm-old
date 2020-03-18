<?php
error_reporting(0);
date_default_timezone_set('Asia/Kolkata');
//$con = mysql_connect("166.62.27.187","tbdatabase","Tb!2#4Tb");
$con = mysql_connect("166.62.27.187","tbdatabase","Tb!2#4Tb");

if(!$con)
{
	die(mysql_error());
}
echo $con;die;
$datetime = date("Y-m-d H:i:s");
?>
