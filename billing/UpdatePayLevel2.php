<?php
include("../include/conFig.php");
$invid = $_GET['invid'];
$cid = $_GET['cid'];

$note = "Level-2 successfully approved by <strong>". $loggedname."</strong>";




mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('Capproved', '$note', '$cid', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());
mysql_query("UPDATE `invoice` SET `partialpayment` = '0',`approved`  = '1' WHERE `id` = '$invid'",$con) or die(mysql_error());
mysql_query("UPDATE `contact` SET `converted` = '1' WHERE `id` = '$cid'",$con) or die(mysql_error());






$getData=mysql_query("SELECT * FROM `contact` WHERE `id`='$cid' AND `Level1Approval`='1'",$con) or die(mysql_error());

$row=mysql_fetch_array($getData);

   /* Template for Email for Client Conversion approved */
   
//	mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$cid','60','0','$datetime','0000:00:00')",$con) or die(mysql_error());
	
	/* Template end for Email for Client Conversion approved */
   

	 /* Template for Email for document verified  */
	
//	mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$cid','16','0','$datetime','0000:00:00')",$con) or die(mysql_error());
	
	 /* Template for Email for document verified  */
	
	
/* Template for Email for account activation  */
	
	// mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$cid','52','0','$datetime','0000:00:00')",$con) or die(mysql_error());
	
	 /* Template for Email for account activation  */
	 
	 
  /* start of sending sms on Client Approval status*/
    

   $code=$row['code'];
   $mobile=$row['mobile'];
	
   $msg="Congrats! Your TradingBells account opening form has been approved. Your client code is ".$code." and your password will be sent to you within 24hours separately";


   $sms=urlencode($msg);
   
   $url = "http://125.16.147.178/webresources/CreateSMSCampaignGet?ukey=Ua5rw76jxFOucluTT4UPAFEBs&msisdn=".$mobile."&language=0&credittype=2&senderid=TBELLS&templateid=0&message=".$sms;

   //$url = "http://bulkpush.mytoday.com/BulkSms/SingleMsgApi?feedid=360855&username=9177022699&password=mjttt&To=91".$mobile."&Text=".$sms;
   $ch = curl_init($url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   $curl_scraped_page = curl_exec($ch);
   curl_close($ch);


   mysql_query("INSERT INTO `sentsms`(`cid`, `mobile`, `sms`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('$cid','$mobile','$sms','','$datetime','$datetime','$loggeduserid','0')",$con) or die(mysql_error());

   mysql_query("INSERT INTO `smslog`(`cid`, `mobile`, `sms`, `status`, `id`, `createdate`, `updatedby`) VALUES ('$cid','$mobile','$sms','0','','$datetime','$loggeduserid')",$con) or die(mysql_error());


   /* End of sending sms on Client Approval  status */
   
   
 /*  Start Sending of Data to website */
	
   $getData = mysql_query("SELECT  `ownerid`,`mobile` ,  `email` ,  `code` ,  `inroducer` ,  `pancardnumber` ,  `fname` ,  `lname` ,  `firstTradeDate` ,  `conversionrequestdate` ,  `bankname` ,  `bankbranchname` ,  `bankaccountnumber` FROM `contact` WHERE `id`='$cid' AND `contact`.`converted`='1'",$con) or die(mysql_error());
   $row = mysql_fetch_array($getData);
   
   
   $ftd = $row['firstTradeDate'];
   $conversionrequestdate = $row['conversionrequestdate'];
   $params = Array();
   $params['type'] = 1;
   $params['mobile'] = $row['mobile'];
   $params['email'] = $row['email'];
   $params['ClientCode'] = $row['code'];
   $params['IntroducerCode'] = $row['inroducer'];
   $params['conversionDate'] = $date;
   $params['panCardNo'] =$row['pancardnumber'];
   $params['name'] =$row['fname']." ".$row['lname'];
   $params['bankname'] =$row['bankname'];
   $params['bankbranchname'] =$row['bankbranchname'];
   $params['bankaccountnumber'] =$row['bankaccountnumber'];
   $params['ownerid'] =$row['ownerid'];
   $params['firstTradeDate'] = $row['firstTradeDate'];
   
    
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:')); 
    curl_setopt($ch,CURLOPT_URL,"http://www.bellseye.com/fetchClientStatus.php");
    curl_setopt($ch,CURLOPT_POST,"1");
    curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $output=curl_exec($ch);
    curl_close($ch);


   /*  End Sending of Data to website */	 
   
   
   

/* start for calculation of spotlight */
$getTeamId=mysql_query("SELECT `teamamtes`.`teamid`,`contact`.`ownerid` FROM `teamamtes` INNER JOIN `contact` ON `teamamtes`.`mateid`=`contact`.`ownerid` INNER JOIN  `team` ON `teamamtes`.`teamid`=`team`.`id` WHERE `contact`.`id`='$cid' AND `team`.`delete`='0'",$con) or die(mysql_error());
	
if(mysql_num_rows($getTeamId) > 0)
{
$rowTeamId=mysql_fetch_array($getTeamId);	
  

//$CheckOverMonthConversions=mysql_query("SELECT * FROM `targetrange` WHERE '$conversiondate' BETWEEN `fromdate` AND `todate`",$con) or die(mysql_error());  
  // $CheckOverMonthConversions=mysql_query("SELECT * FROM `targetrange` WHERE '$date' BETWEEN `fromdate` AND `todate`",$con) or die(mysql_error());
 $CheckOverMonthConversions=mysql_query("SELECT * FROM `targetrange` WHERE '$ftd' BETWEEN `fromdate` AND `todate`",$con) or die(mysql_error());
if($rowMon=mysql_num_rows($CheckOverMonthConversions)==1)
{
$rowMon=mysql_fetch_array($CheckOverMonthConversions);	
$fromdate=$rowMon['fromdate'];
$todate=$rowMon['todate'];
	
mysql_query("INSERT INTO `noteline` (`subject`,`note`) VALUES ('$conversiondate','1')",$con) or die(mysql_error());


$getDuplicateRM=mysql_query("SELECT * FROM `spotlight` WHERE `spotlight`.`teamRMMateid`='$rowTeamId[1]' AND `spotlight`.`delete`='0'",$con) or die(mysql_error());
if(mysql_num_rows($getDuplicateRM)==0)	
{
  if($conversionrequestdate >='2019-04-22'){
    mysql_query("INSERT INTO `spotlight` (`id`,`teamid`,`Accounts`,`profile`,`teamRMMateid`,`TargetRangeFrom`,`TargetRangeTo`) VALUES ('','$rowTeamId[0]','1','','$rowTeamId[1]','$fromdate','$todate')",$con) or die(mysql_error());
  }
}
else 
{
  if($conversionrequestdate >='2019-04-22'){
    mysql_query("UPDATE `spotlight` SET `Accounts`=`Accounts`+'1' WHERE `spotlight`.`teamRMMateid`='$rowTeamId[1]' AND `spotlight`.`delete`='0'",$con) or die(mysql_error());

    mysql_query("INSERT INTO `noteline` (`subject`,`note`) VALUES ('$rowTeamId[1]','1')",$con) or die(mysql_error());
  }

}
}


//if($conversiondate  >= $intial  &&  $conversiondate  <= $final)
if($ftd  >= $initial  &&  $ftd  <= $final && $conversionrequestdate >= '2019-04-22')
{
$getDuplicateRMweek=mysql_query("SELECT * FROM `spotlightweek` WHERE `spotlightweek`.`teamRMMateid`='$rowTeamId[1]' AND `spotlightweek`.`delete`='0'",$con) or die(mysql_error());
if(mysql_num_rows($getDuplicateRMweek)==0)	
{
mysql_query("INSERT INTO `spotlightweek` (`id`,`teamid`,`Accounts`,`profile`,`teamRMMateid`,`TargetRangeFrom`,`TargetRangeTo`) VALUES ('','$rowTeamId[0]','1','','$rowTeamId[1]','$initial','$final')",$con) or die(mysql_error());
}
else 
{
mysql_query("UPDATE `spotlightweek` SET `Accounts`=`Accounts`+'1' WHERE `spotlightweek`.`teamRMMateid`='$rowTeamId[1]' AND `spotlightweek`.`delete`='0'",$con) or die(mysql_error());
}

}  


} 
 /* end for calculation of spotlight */ 
   
   ?>
