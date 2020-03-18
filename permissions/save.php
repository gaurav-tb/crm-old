<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$id = $_GET['profile'];
$valto = explode("*$*$*",$valto);
print_r($valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
$permission .= $val.",";
}
//echo "UPDATE `profile` SET `permission` = '$permission' WHERE `id` = '$id'";
mysql_query("UPDATE `profile` SET `permission` = '$permission' WHERE `id` = '$id'",$con) or die(mysql_error());
?>
DONOTSHOW