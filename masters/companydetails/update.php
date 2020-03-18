<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$id = $_GET['id'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}


mysql_query("UPDATE `company` SET `name`='$post[0]',`adr1`='$post[1]',`adr2`='$post[2]',`city`='$post[4]',`state`='$post[5]',`pincode`='$post[7]',`email`='$post[3]',`pan`='$post[8]',`footnote`='$post[9]',`modifieddate`='$datetime' WHERE `id` = '1'",$con) or die(mysql_error());

?>
