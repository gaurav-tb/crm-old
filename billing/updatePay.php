<?php
include("../include/conFig.php");
$invid = $_GET['invid'];
$cid = $_GET['cid'];

// $code = "TB".rand(14681,99999);
// $getData = mysql_query("SELECT * FROM `contact` WHERE `code`='$code' AND `contact`.`converted`='1'",$con) or die(mysql_error());
// $row = mysql_num_rows($getData);
// if($row > 0)
// {
// $code = "TB".rand(28965,99999);
// } 



 $currentDate = strtotime($datetime);
 $futureDate = $currentDate+(432000);
 $CloseDate= date("Y-m-d H:i:s", $futureDate);




$getInvoiceData = mysql_query("SELECT `cid`,`transactionalid` FROM `invoice` WHERE `id` = '$invid'",$con) or die(mysql_error());
$rowInvoice = mysql_fetch_array($getInvoiceData);
$cid = $rowInvoice[0];


$getDataContact = mysql_query("SELECT `ownerid`,`id`,`code`,`fname`,`lname`,`mobile`,`email`,`conversiondate`,`segment` FROM `contact` WHERE `id` = '$cid'",$con) or die(mysql_error());
$rowContact = mysql_fetch_array($getDataContact);

$getAllotment = mysql_query("SELECT `allotmentid` FROM `customersupport` WHERE `id`=(SELECT MAX(`id`) FROM `customersupport` WHERE `Npcpool`='0')",$con) or die(mysql_error());
$rowAllotment = mysql_fetch_array($getAllotment);

$getMaxId = mysql_query("SELECT `id` FROM `teamamtes` WHERE  `id` = ( SELECT MAX(`id`) FROM  `teamamtes` WHERE  `teamid` =  '6' )",$con) or die(mysql_error());
$rowMaxId = mysql_fetch_array($getMaxId);
//echo "SELECT `id` FROM `teamamtes` WHERE  `mateid` = '$rowAllotment[0]' and `teamid` = '6'";
$getTeammateId = mysql_query("SELECT `id` FROM `teamamtes` WHERE  `mateid` = '$rowAllotment[0]' and `teamid` = '6' ",$con) or die(mysql_error());
$TeammateId = mysql_fetch_row($getTeammateId);
//echo "teammateId ".$TeammateId[0];
if($TeammateId[0] < $rowMaxId[0] ){

  $allotmentid = $TeammateId[0] + 1;


}else if($TeammateId[0] >=  $rowMaxId[0]){
   $getMinId = mysql_query("SELECT `id` FROM `teamamtes` WHERE  `id` = ( SELECT MIN(`id`) FROM  `teamamtes` WHERE  `teamid` =  '6' )",$con) or die(mysql_error());
  $rowMinId = mysql_fetch_array($getMinId);

  $allotmentid=$rowMinId[0];  
  echo "min  ".$allotmentid;
}

$getAllotmentId = mysql_query("SELECT `id` FROM `teamamtes` WHERE  `id` = '$allotmentid' and `teamid` = '6' ",$con) or die(mysql_error());
if(mysql_num_rows($getAllotmentId) == 0){
  $allotmentid = $allotmentid+1;
}



// $allotmentid=$rowAllotment[0]+1;

// $getLeader = mysql_query("select team.leader,teamamtes.mateid from team inner join teamamtes on team.id=teamamtes.teamid where team.leader=`mateid` AND `teamamtes`.`id`='$allotmentid' AND `teamamtes`.`teamid`='6'",$con) or die(mysql_error());
// if(mysql_num_rows($getLeader) > 0)
// {
// $allotmentid=$rowAllotment[0]+2;
// }



// if($allotmentid > $rowMaxId[0])
// {
// $getMinId = mysql_query("SELECT `id` FROM `teamamtes` WHERE  `id` = ( SELECT MIN(`id`) FROM  `teamamtes` WHERE  `teamid` =  '6' )",$con) or die(mysql_error());
// $rowMinId = mysql_fetch_array($getMinId);

// $allotmentid=$rowMinId[0];  

// }

$Ownerid=$rowContact[0];
$clientcode = $rowContact['code'];

//get RM on the priority basis
// $convertedClient = mysql_query("SELECT `id` FROM `customersupport` WHERE  `conversiondate` = CURDATE()",$con) or die(mysql_error());
// if(mysql_num_rows($convertedClient) > 9){
//   $converted= mysql_query("SELECT `id`,`RMOwnerid` FROM `customersupport` WHERE  `conversiondate` = CURDATE()",$con) or die(mysql_error());
//   $rmid='';
//   while($rm = mysql_fetch_array($converted)){
//     $rmid .= $rm[1].",";
//   }

// $getRmTeamId = mysql_query("SELECT  `teamamtes`.`mateid` FROM  `teamamtes` INNER JOIN  `team` ON  `teamamtes`.`teamid` =  `team`.`id`WHERE  (`teamamtes`.`teamid` =  '19') AND `teamamtes`.`mateid` NOT IN(176,289,368,$rmid 0) AND  `team`.`delete` =  '0' ORDER BY RAND() LIMIT 1",$con) or die(mysql_error());

// $rowRmId = mysql_fetch_array($getRmTeamId);
// $mid =$rowRmId[0];


// if(mysql_num_rows($getRmTeamId) == 0){
//   $getRmTeamId1 = mysql_query("SELECT  `teamamtes`.`mateid` 
// FROM  `teamamtes` 
// INNER JOIN  `team` ON  `teamamtes`.`teamid` =  `team`.`id` 
// WHERE  (`teamamtes`.`teamid` =  '19') AND `teamamtes`.`mateid` IN(176,289,368)
// AND  `team`.`delete` =  '0'
// ORDER BY RAND() 
// LIMIT 1",$con) or die(mysql_error());

// $rowRmId = mysql_fetch_array($getRmTeamId1);
// }

// //}
// //$rowRmId = mysql_fetch_array($getRmTeamId);
// }else{ 
// $getRmTeamId = mysql_query("SELECT  `teamamtes`.`mateid` 
// FROM  `teamamtes` 
// INNER JOIN  `team` ON  `teamamtes`.`teamid` =  `team`.`id` 
// WHERE  (`teamamtes`.`teamid` =  '19') AND `teamamtes`.`mateid` IN(176,289,368)
// AND  `team`.`delete` =  '0'
// ORDER BY RAND() 
// LIMIT 1",$con) or die(mysql_error());

// $rowRmId = mysql_fetch_array($getRmTeamId);
// }

//End get RM on the priority basis




// $getRmTeamId = mysql_query("SELECT  `teamamtes`.`mateid` 
// FROM  `teamamtes` 
// INNER JOIN  `team` ON  `teamamtes`.`teamid` =  `team`.`id` 
// WHERE  (`teamamtes`.`teamid` =  '19')
// AND  `team`.`delete` =  '0'
// ORDER BY RAND() 
// LIMIT 1",$con) or die(mysql_error());
// $rowRmId = mysql_fetch_array($getRmTeamId);

//you can put the Team id in above query like (`teamamtes`.`teamid` =  '19' || `teamamtes`.`teamid` =  '20' )


$note = "Level-1 successfully approved by  <strong>". $loggedname."</strong>";

mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('Capproved', '$note', '$cid', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());
 mysql_query("UPDATE `invoice` SET `partialpayment` = '0',`approved`  = '0' WHERE `id` = '$invid'",$con) or die(mysql_error());
 mysql_query("UPDATE `servicecall` SET `approved` = '$approved' WHERE `transactionalid` = '$row[1]'",$con) or die(mysql_error());
 mysql_query("UPDATE `contact` SET `converted` = '0',`pending`='0',`conversiondate` = '$date',`Level1Approval`='1' WHERE `id` = '$cid'",$con) or die(mysql_error());
// mysql_query("UPDATE `contact` SET `converted` = '0',`pending`='0',`conversiondate` = '$date',`code` = '$code',`Level1Approval`='1' WHERE `id` = '$cid'",$con) or die(mysql_error());
 mysql_query("INSERT INTO `ActivatePremium`(`id`,`cid`,`segmentAmt`,`Plan`,`EmailSend`,`PremiumActivate`,`Approval`,`ApprovedDate`) VALUES ('','$cid','0,1,1,20,1,20','1','0','0','1','$datetime')",$con) or die(mysql_error());

/*$getIntroducer = mysql_query("SELECT `code`,`inroducer` FROM `contact` WHERE `id`= '$cid'",$con) or die(mysql_error());
if(mysql_num_rows($getIntroducer>0))
{
$rowIntro=mysql_fetch_array($getIntroducer);
if($rowIntro[1]!='')
{
mysql_query("INSERT INTO `introducer` (`id`,`code`,`introducer`,`IsSend`) VALUES ('','$rowIntro[0]','$rowIntro[1]','0')",$con) or die(mysql_error());
}
} */



$mateId = mysql_query("SELECT `mateid` FROM `teamamtes` WHERE  `id` = '$allotmentid'",$con) or die(mysql_error());
$MaterowId = mysql_fetch_array($mateId);

$getData = mysql_query("SELECT `name` FROM `employee` WHERE `id`='$MaterowId[0]'",$con) or die(mysql_error());
$rowName = mysql_fetch_array($getData);

/* Assigning RM in levele 1 */


$getRmTeamId = mysql_query("SELECT teamid from teamamtes where mateid='$Ownerid'",$con) or die(mysql_error());
$rowRmId = mysql_fetch_array($getRmTeamId);



$getRmTeamId = mysql_query("SELECT employee.id
FROM teamamtes
INNER JOIN employee ON teamamtes.mateid = employee.id
WHERE teamamtes.teamid = '$rowRmId[0]'
AND employee.profile='35'
ORDER BY RAND( )
LIMIT 1 ",$con) or die(mysql_error());
$rowRmId = mysql_fetch_array($getRmTeamId);




mysql_query("INSERT INTO `customersupport` (`id`,`ownerid`,`clientid`,`tradingbellsid`,`fname`, `lname`, `mobile`,`email`,`conversiondate`,`level`,`ClosingDate`,`allotmentid`,`Npcpool`,`RMOwnerid`) VALUES ('','$rowContact[0]','$rowContact[1]','$clientcode','$rowContact[3]','$rowContact[4]','$rowContact[5]','$rowContact[6]','$date','1','$CloseDate','373','0','$rowRmId[0]')",$con) or die(mysql_error());  

mysql_query("INSERT INTO `supportdetails` (`id`,`clientid`,`NpcCount`) VALUES ('','$rowContact[1]','0')",$con) or die(mysql_error());  

$note = "Client has been alloted to <strong>" .$rowName[0]. "</strong>";

$res=mysql_query("INSERT INTO `noteline`(`subject`,`note`,`cid`,`id`,`createdate`,`updatedby`,`delete`) values('Salloted','$note','$cid','','$datetime','1','0')",$con)or die(mysql_error()); 
  
  
$note = "Relationship Mananger of the Client is <strong>" .$rowRMManager[0]. "</strong>";

$res=mysql_query("INSERT INTO `noteline`(`subject`,`note`,`cid`,`id`,`createdate`,`updatedby`,`delete`) values('Oship','$note','$cid','','$datetime','1','0')",$con)or die(mysql_error()); 
  
mysql_query("UPDATE `customersupport` SET `LastRMOwnerChangeDate` = '$datetime' WHERE `tradingbellsid` = '$clientcode'",$con) or die(mysql_error());

   /* Template for Email for Client Conversion approved */
   
//  mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$cid','60','0','$datetime','0000:00:00')",$con) or die(mysql_error());
  
  /* Template end for Email for Client Conversion approved */
   

  
   /* Template for Email for document verified  */
  
//  mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$cid','16','0','$datetime','0000:00:00')",$con) or die(mysql_error());
  
   /* Template for Email for document verified  */
  
  
/* Template for Email for account activation  */
  
//  mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$cid','52','0','$datetime','0000:00:00')",$con) or die(mysql_error());
  
   /* Template for Email for account activation  */
   
   
   /* start of sending sms on Client Approval  status*/
    

//    $msg="Congrats! Your TradingBells account opening form has been approved. Your client code is ".$code." and your password will be sent to you within 24hours separately";


//    $sms=urlencode($msg);
   
//    $mobile=$rowContact['mobile'];

// // $url = "http://125.16.147.178/webresources/CreateSMSCampaignGet?ukey=Ua5rw76jxFOucluTT4UPAFEBs&msisdn=".$mobile."&language=0&credittype=2&senderid=TBELLS&templateid=0&message=".$sms;

//   // $url = "http://bulkpush.mytoday.com/BulkSms/SingleMsgApi?feedid=360855&username=9177022699&password=mjttt&To=91".$mobile."&Text=".$sms;
//    $ch = curl_init($url);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    $curl_scraped_page = curl_exec($ch);
//    curl_close($ch);


//    mysql_query("INSERT INTO `sentsms`(`cid`, `mobile`, `sms`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('$cid','$mobile','$sms','','$datetime','$datetime','$loggeduserid','0')",$con) or die(mysql_error());

//    mysql_query("INSERT INTO `smslog`(`cid`, `mobile`, `sms`, `status`, `id`, `createdate`, `updatedby`) VALUES ('$cid','$mobile','$sms','0','','$datetime','$loggeduserid')",$con) or die(mysql_error());

   

   /* End of sending sms on Client Approval  status */
   
   
    /*  Start Sending of Data to website */
  
/*  $getData = mysql_query("SELECT `mobile`,`code`,`inroducer`,`pancardnumber`,`fname`,`lname` FROM `contact` WHERE `id`='$cid' AND `contact`.`converted`='1'",$con) or die(mysql_error());
    $row = mysql_fetch_array($getData);

  
   $params = Array();
   $params['mobile'] = $row['mobile'];
   $params['type'] = "Approved";
   $params['ClientCode'] = $code;
   $params['IntroducerCode'] = $row['inroducer'];
   $params['conversionDate'] = $date;
   $params['panCardNo'] =$row['pancardnumber'];
   $params['name'] =$row['fname']." ".$row['lname'];

    $ch=curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:')); 
    curl_setopt($ch,CURLOPT_URL,"http://tradingbells.com/user/fetchClientStatus.php");
    curl_setopt($ch,CURLOPT_POST,"1");
    curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $output=curl_exec($ch);
    curl_close($ch);
   
    */
   /*  End Sending of Data to website */
  
  
?>
