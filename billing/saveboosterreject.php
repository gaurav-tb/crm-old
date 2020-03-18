<?php
include("../include/conFig.php");

$valto = $_POST['valto'];
$cid = $_GET['cid'];

$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}


        
$note = "Booster activation request has been rejected by <strong>".$loggedname."</strong>,With Reason ".$post[0];
	
mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('CancleBooster', '$note', '$cid', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());
	
//mysql_query("UPDATE `researchbooster` SET `service`='0',`Telegraminstalled`='0',`Segments`='',`ResearchPlus`='0',`Activationamt`='',`AmountWithGst`='',`ActivationRequest`='0',`StartDate`='0000-00-00',`EndDate`='0000-00-00',`RequestingDate`='0000-00-00 00:00:00',`EmailReplied`='0',`EmailRepliedDate`='0000-00-00',`FundDebited`='0',`FundDebitedDate`='0000-00-00',`FundAvailable`='',`Comments`='$post[0]',`Approved`='0',`ApprovalDate`='0000-00-00',`FundClearDate`='0000-00-00' WHERE `cid`='$cid'",$con) or die(mysql_error());
	
	
mysql_query("DELETE FROM `researchbooster` WHERE `cid`='$cid'",$con) or die(mysql_error());
	
?>



