<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
$ips = trim($post[0]);
mysql_query("UPDATE `iprange` SET `from` = '$ips', `modified` = '$datetime' WHERE `id` = '1'",$con) or die(mysql_error());

?> 
