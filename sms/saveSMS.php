<?php 
include("../include/conFig.php");
$cid = $_GET['cid'];
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
$msg = str_ireplace("<br/>","\r\n",$post[1]);
$sms = urlencode($msg);

// $url = "http://125.16.147.178/webresources/CreateSMSCampaignGet?ukey=Ua5rw76jxFOucluTT4UPAFEBs&msisdn=".$post[0]."&language=0&credittype=2&senderid=TBELLS&templateid=0&message=".$sms;

$url = "http://bulkpush.mytoday.com/BulkSms/SingleMsgApi?feedid=360855&username=9177022699&password=tB@151&To=91".$post[0]."&Text=".$sms;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$curl_scraped_page = curl_exec($ch);
curl_close($ch);


mysql_query("INSERT INTO `sentsms`(`cid`, `mobile`, `sms`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('$cid','$post[0]','$post[1]','','$datetime','$datetime','$loggeduserid','0')",$con) or die(mysql_error());
mysql_query("INSERT INTO `smslog`(`cid`, `mobile`, `sms`, `status`, `id`, `createdate`, `updatedby`) VALUES ('$cid','$post[0]','$post[1]','0','','$datetime','$loggeduserid')",$con) or die(mysql_error());
echo '<td><p style="color:green;font-size:12px;">SMS Sent Successfully</p></td>';

?>