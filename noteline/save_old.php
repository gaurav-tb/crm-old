<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\\'",$val);
$post[] .= $val;
}
$note = str_ireplace("'","",$post[0]);
$callback = $post[1];
$cid = $_GET['cid'];
$callbacktime=date("H:i", strtotime($post[2])) ;

mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('Client Story', '$note', '$cid', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());
$getOld = mysql_query("SELECT `description` FROM `contact` WHERE `id` = '$cid'",$con) or die(mysql_error());
$rowOld = mysql_fetch_array($getOld);
$desc = $rowOld[0];
$desc = $desc."<br/>".$note." [".date('d-m-y h:i A')."]";
mysql_query("INSERT INTO `leadupdate` (`id`, `userid`, `cid`, `createdate`, `delete`) VALUES ('', '$loggeduserid', '$cid', '$datetime', '0')",$con) or die(mysql_error());
if(!empty($note)) {
mysql_query("UPDATE `contact` SET `description` = '$desc' WHERE `id` = '$cid'",$con) or die(mysql_error());
}
if($callback != '')
{
	mysql_query("UPDATE `contact` SET `callbackdate` = '$callback',`callbacktime` = '$callbacktime' WHERE `id` = '$cid'",$con) or die(mysql_error());
}
/*
if($post[0] == 'Call')
{
mysql_query("UPDATE `contact` SET `contacted` = '1' WHERE `id` = '$cid'",$con) or die(mysql_error());
}*/
?>
DONOTSHOW
