<?php
include("../include/conFig.php");
$EmailSmsService = $_GET['EmailSmsService'];
$cid = $_GET['cid'];
$mobile = $_GET['mobile'];
$email = $_GET['email'];
$name = $_GET['name'];


if($EmailSmsService ==1)
{
//mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$cid','69','0','$datetime','0000-00-00')",$con) or die(mysql_error());
}

if($EmailSmsService ==2)
{
$sms = "www.tradingbells.com/payCharges.php?mobile=".$mobile."&email=".$email."&name=". $name;

$url = "http://125.16.147.178/webresources/CreateSMSCampaignGet?ukey=Ua5rw76jxFOucluTT4UPAFEBs&msisdn=".$mobile."&language=0&credittype=2&senderid=TBELLS&templateid=0&message=".$sms;

//$url = "http://bulkpush.mytoday.com/BulkSms/SingleMsgApi?feedid=360855&username=9177022699&password=mjttt&To=91".$mobile."&Text=".$sms;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$curl_scraped_page = curl_exec($ch);
$output=curl_close($ch);

mysql_query("INSERT INTO `sentsms`(`cid`, `mobile`, `sms`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('$cid','$mobile','$sms','','$datetime','$datetime','$loggeduserid','0')",$con) or die(mysql_error());
mysql_query("INSERT INTO `smslog`(`cid`, `mobile`, `sms`, `status`, `id`, `createdate`, `updatedby`) VALUES ('$cid','$mobile','$sms','0','','$datetime','$loggeduserid')",$con) or die(mysql_error());
}

?>