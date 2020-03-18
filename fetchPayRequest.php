<?php
include("include/conFig.php");
if($loggeduserid == 1) 
{
    $current = time();
	$url ='http://www.bellseye.com/getrequest.php?u=44';
	
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Host: www.bellseye.com", "Cache-Control: max-age=0", "Proxy-Connection: keep-alive","Upgrade-Insecure-Requests: 1","User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36"));
	$tuData = curl_exec($curl);
	$temp = json_decode($tuData,true);
	curl_close($curl); 
	
	
	
    foreach($temp as $val) 
	{
	$clientid = $val['clientid'];
	$amount = $val['amount'];
	$amounttype = $val['amounttype'];		
	$referenceno = $val['referenceno'];		
	$transfermode = $val['transfermode'];		
	$filepath = $val['filepath'];		
	$created_date = $val['created_date'];		
	$issendtocrm = $val['issendtocrm'];		
	$requesttype = $val['requesttype'];		
	//echo "INSERT INTO `fundspayinrequest` (`clientid`, `amount`, `amounttype`, `referenceno`, `transfermode`, `filepath`, `created_date`, `issendtocrm`, `requesttype`) VALUES ('$clientid', '$amount', '$amounttype', '$referenceno', '$transfermode', '$filepath', '$created_date', '$issendtocrm', '$requesttype')";
	

	mysql_query("INSERT INTO `fundspayinrequest` (`clientid`, `amount`, `amounttype`, `referenceno`, `transfermode`, `filepath`, `created_date`, `issendtocrm`, `requesttype`) VALUES ('$clientid', '$amount', '$amounttype', '$referenceno', '$transfermode', '$filepath', '$created_date', '$issendtocrm', '$requesttype')",$con) or die(mysql_error());


	$getData=mysql_query("SELECT `id`,`mobile` FROM `contact` WHERE `code`='$clientid'",$con) or die(mysql_error());
	
	if(mysql_num_rows($getData)>0)
	{
	$row=mysql_fetch_array($getData);
	
	mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$row[0]','55','0','$datetime','0000:00:00')",$con) or die(mysql_error());
	
	//sending payout Request Mail to Clients 
	$msg="We have received a fund withdrawal request for ".$clientid." for Rs.".number_format($amount)."/- If you have not requested this, please call us on 9667658800. http://bit.ly/tbfunds";	
	
    $sms = urlencode($msg);
	$url = "http://125.16.147.178/webresources/CreateSMSCampaignGet?ukey=Ua5rw76jxFOucluTT4UPAFEBs&msisdn=".$row[1]."&language=0&credittype=2&senderid=TBELLS&templateid=0&message=".$sms;

   //$url = "http://bulkpush.mytoday.com/BulkSms/SingleMsgApi?feedid=360855&username=9177022699&password=mjttt&To=91".$row[1]."&Text=".$sms;
   $ch = curl_init($url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   $curl_scraped_page = curl_exec($ch);
   curl_close($ch);


   mysql_query("INSERT INTO `sentsms`(`cid`, `mobile`, `sms`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('$row[0]','$row[1]','$sms','','$datetime','$datetime','$loggeduserid','0')",$con) or die(mysql_error());
   mysql_query("INSERT INTO `smslog`(`cid`, `mobile`, `sms`, `status`, `id`, `createdate`, `updatedby`) VALUES ('$row[0]','$row[1]','$sms','0','','$datetime','$loggeduserid')",$con) or die(mysql_error());

	
	}
	
	
	}
	
		
	/* update of spotlight week */
	
	$getSpotligtWeekRange=mysql_query("SELECT * FROM `spotlightweek` WHERE '$date' NOT BETWEEN `spotlightweek`.`TargetRangeFrom` AND `spotlightweek`.`TargetRangeTo`",$con) or die(mysql_error());

	if(mysql_num_rows($getSpotligtWeekRange) > 0)
	{
	$rowWeekRange=mysql_fetch_array($getSpotligtWeekRange);
	$SpotlightId=$rowWeekRange['id'];
	mysql_query("UPDATE `spotlightweek` SET `spotlightweek`.`Accounts`='0',`spotlightweek`.`BrokerageRevenue`='0',`spotlightweek`.`BoosterAmount`='0',`spotlightweek`.`TargetRangeFrom`='$initial',`TargetRangeTo`='$final' WHERE `spotlightweek`.`id`='$SpotlightId'",$con) or die(mysql_error());
	}
	
	/* update of spotlight week */
	
	/* update of spotlight month */
	
	$getSpotligtMonthRange=mysql_query("SELECT * FROM `spotlight` WHERE '$date' NOT BETWEEN `spotlight`.`TargetRangeFrom` AND `spotlight`.`TargetRangeTo`",$con) or die(mysql_error());

	if(mysql_num_rows($getSpotligtMonthRange) > 0)
	{
	$rowMonthRange=mysql_fetch_array($getSpotligtMonthRange);
	$SpotlightMonthId=$rowMonthRange['id'];
	
	mysql_query("UPDATE `spotlight` SET `spotlight`.`Accounts`='0',`spotlight`.`BrokerageRevenue`='0',`spotlight`.`BoosterAmount`='0',`spotlight`.`TargetRangeFrom`='$rowMon[0]',`TargetRangeTo`='$rowMon[1]' WHERE `spotlight`.`id`='$SpotlightMonthId'",$con) or die(mysql_error());
	}
	
	/* update of spotlight month */
	
	
    }
	else
	{
	echo 'Invalid Request';	
		
	}
?>