<?php
ob_start();
include("../include/conFig.php");
$type = $_GET['type'];
$cid = $_GET['cid'];
$date = $_GET['date'];

if($type==1)
{

mysql_query("UPDATE `contact` SET `conversionrequestdate`= '$date' WHERE `id` = '$cid'",$con) or die(mysql_error());

}

else if($type==3)
{
mysql_query("UPDATE `activatepremium` SET `ApprovedDate` = '$date' WHERE `cid` = '$cid'",$con) or die(mysql_error());
}

else
{
 mysql_query("UPDATE `researchbooster` SET `ApprovalDate` = '$date' WHERE `cid` = '$cid'",$con) or die(mysql_error());
}
?>
