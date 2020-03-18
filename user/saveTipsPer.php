<?php
include("../include/conFig.php");
$userid = $_GET['userid'];
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}

mysql_query("DELETE FROM `tipsper` WHERE `userid` = '$userid'",$con) or die(mysql_error());

$c = count($post);
for($g=0;$g<=$c;$g++)
{
$product = $post[$g];
if($product != 0)
{
mysql_query("INSERT INTO `tipsper`(`userid`, `serviceid`, `id`) VALUES ('$userid ','$product','')",$con) or die(mysql_error());
}
}
?>
DONOTSHOW