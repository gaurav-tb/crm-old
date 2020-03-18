<?php
ob_start();
include("include/conFig.php");
$owner = $_GET['owner'];
$cid = $_GET['cid'];
$i = $_GET['i'];
$head = $_GET['header'];
if($owner != '' && $cid != '')
{
mysql_query("UPDATE `contact` SET `ownerid` = '$owner',`read` = '0' WHERE `id` = '$cid'",$con) or die(mysql_error());


$res=mysql_query("SELECT `name` FROM `employee` WHERE `id`='$owner'",$con) or die(mysql_error());
$row=mysql_fetch_array($res);




$note = "Client Owner has been changed to <strong>" .$row[0]. "</strong> Changed By <strong>".$loggedname."</strong>";

mysql_query("INSERT INTO `noteline`(`subject`,`note`,`cid`,`id`,`createdate`,`updatedby`,`delete`) values('Oship','$note','$cid','','$datetime','$loggeduserid','0')",$con)or die(mysql_error()); 


}
if($head == 1)
{
header("location:clients/edit.php?id=".$cid."&i=".$i);
}
else
{
header("location:leads/edit.php?id=".$cid."&i=".$i);
}
?>
