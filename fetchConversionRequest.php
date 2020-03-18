<?php
include("include/conFig.php");
$current = time();

$trans = rand(100,10000);
$trans = $trans.time();

mysql_query("DELETE FROM `localrequestlog` WHERE `userid` = '$loggeduserid'",$con) or die(mysql_error());
mysql_query("INSERT INTO `localrequestlog` (`id`, `userid`, `time`, `date`) VALUES ('', '$loggeduserid', '$current', '$date')",$con);
$checkLast = mysql_query("SELECT * FROM `requestlog` WHERE `id` = '1'",$con) or die(mysql_error());
$rowLast = mysql_fetch_array($checkLast);
$last = $rowLast['time'];
$fifmins = $current - 300;	
$instr = '';
$getInactive = mysql_query("SELECT * FROM `localrequestlog` WHERE `time` <= '$fifmins'",$con) or die(mysql_error());
$rowInCount = mysql_num_rows($getInactive);
if($rowInCount > 0)
{
while($rowInactive = mysql_fetch_array($getInactive))
{
$instr .= $rowInactive['userid'].",";	
}
$instr = substr($instr,0,-1);	
$instr = 'WHERE `userid` NOT IN ('.$instr.')';
}
else
{
$instr = '';
}

		


    $curTime = date("H");

    if($curTime > '9')
    {
    $diff = $current - $last;
    if($diff > 0)
    {
    $url ='http://tradingbells.com/user/getConversionRequest.php?u=48';
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Host: www.tradingbells.com", "Cache-Control: max-age=0", "Proxy-Connection: keep-alive","Upgrade-Insecure-Requests: 1","User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36"));
	$tuData = curl_exec($curl);
	$temp = json_decode($tuData,true);
	curl_close($curl); 
	
	mysql_query("UPDATE `requestlog` SET `time` = '$current' WHERE `id` = '1'",$con) or die(mysql_error());

	foreach($temp as $val)
	{
	$mobile = $val['number'];
    $kycMethod = $val['kycMethod'];
    $partnerCode = $val['partnerCode'];		
	$Accountopeningcharges = $val['Accountopeningcharges'];	
    $paymentmethod=$val['paymentmethod'];
	$referrenceNumber=$val['referrenceNumber'];
	$conversionRequestDate=$val['conversionRequestDate'];
	
	
    if($mobile!='')
	{
	mysql_query("UPDATE `contact` SET `paymethod`='$paymentmethod',`kycmethod`='$kycMethod',`inroducer`='$partnerCode',`accountopeningamount`='$Accountopeningcharges',`accountopeningreffno`='$referrenceNumber',`conversionrequestdate`='$conversionRequestDate',`softwarerequired`='1',`segment`='',`personverification`='3' WHERE `contact`.`mobile`='$mobile' AND `contact`.`converted`='0'",$con) or die(mysql_error());

	
	$getUserId=mysql_query("SELECT `id` FROM `contact` WHERE `contact`.`mobile`='$mobile'",$con) or die(mysql_error());
    $rowUserId=mysql_fetch_row($getUserId);

	
	$note = "Client conversion requested by <strong>".$loggedname."</strong>";
	mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('Crequest', '$note', '$rowUserId[0]', '', '$datetime', '52', '0')",$con) or die(mysql_error());
	mysql_query("INSERT INTO `servicecall` (`cid`, `type`, `approved`, `id`, `createdate`, `modifieddate`, `updatedby`,`transactionalid`) VALUES ('$rowUserId[0]', 'c', '0', '', '$datetime', '$datetime', '52','$trans')",$con) or die(mysql_error());
	mysql_query("INSERT INTO `invoice`(`cid`, `transactionalid`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`,`approved`) VALUES ('$rowUserId[0]','$trans','','$datetime','$datetime','52','0','0')",$con) or die(mysql_error());

	
		/* start of sending sms on Client conversion Request */
  $msg="Thank you for submitting your documents. We are working towards processing your form and shall get back to you should there be any query. www.tradingbells.com"; 

    $sms=urlencode($msg);



 $url = "http://125.16.147.178/webresources/CreateSMSCampaignGet?ukey=Ua5rw76jxFOucluTT4UPAFEBs&msisdn=".$mobile."&language=0&credittype=2&senderid=TBELLS&templateid=0&message=".$sms;

   //$url = "http://bulkpush.mytoday.com/BulkSms/SingleMsgApi?feedid=360855&username=9177022699&password=mjttt&To=91".$mobile."&Text=".$sms;
   $ch = curl_init($url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   $curl_scraped_page = curl_exec($ch);
   curl_close($ch);


   mysql_query("INSERT INTO `sentsms`(`cid`, `mobile`, `sms`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('$id','$row[3]','$sms','','$datetime','$datetime','$loggeduserid','0')",$con) or die(mysql_error());

   mysql_query("INSERT INTO `smslog`(`cid`, `mobile`, `sms`, `status`, `id`, `createdate`, `updatedby`) VALUES ('$id','$row[3]','$sms','0','','$datetime','$loggeduserid')",$con) or die(mysql_error());


   /* End of sending sms on Client conversion Request */
   
   
   
   
	
  //  mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$rowUserId[0]','59','0','$datetime','0000:00:00')",$con) or die(mysql_error());
  	
	$templatefor = 'EKYC';
	if($kycMethod == 1)
	{
	$templatefor = 'physical_kyc';
	}
	
	
	$getsentTemplate = mysql_query("SELECT `subject` FROM  `sentemail` WHERE `cid` = '".$rowUserId[0]."' AND (`subject` = 'physical_kyc' OR `subject` = 'EKYC')",$con) or die(mysql_error());
	$rowsentTemplate = mysql_fetch_array($getsentTemplate);	
	if(empty($rowsentTemplate)) 
	{
    $getTemplate = mysql_query("SELECT `id` FROM  `templateemail` WHERE `templatefor` = '$templatefor'",$con) or die(mysql_error());
	$rowTemplate = mysql_fetch_array($getTemplate);
	
//	mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$id','$rowTemplate[0]','0','$datetime','0000:00:00')",$con) or die(mysql_error());



}
$i=0;
}
} 
}
}
else
{
echo "0";
} 
?>
