<?php
include("include/conFig.php");
$current = time();
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

/*
$tempAr = Array();
$k=0;
$getMin = mysql_query("SELECT * FROM `totalallotment` ".$instr." ORDER BY `alloted`",$con) or die(mysql_error());
while($rowMin = mysql_fetch_array($getMin))
{
$thisBAId = $rowMin['userid'];
$checkNotBa = mysql_query("SELECT * FROM `employee` WHERE `id` = '$thisBAId' AND `delete` = '0'",$con) or die(mysql_error());
$rowCheckNotBa  = mysql_fetch_array($checkNotBa);
if($rowCheckNotBa['profile'] == '4' || $rowCheckNotBa['profile'] == '5')
{
$tempAr[$k] = $rowMin['userid'];
$k++;               
}
}


*/
        
//echo $k = $k-1;
        
        
    $curTime = date("H");

    if($curTime > '9')
    {
    $diff = $current - $last;
    if($diff > 0)
    {
    $url ='http://www.bellseye.com/getlatest.php?u=42';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Host: www.bellseye.com", "Cache-Control: max-age=0", "Proxy-Connection: keep-alive","Upgrade-Insecure-Requests: 1","User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36"));
    $tuData = curl_exec($curl);
    $temp = json_decode($tuData,true);
    curl_close($curl); 

    mysql_query("UPDATE `requestlog` SET `time` = '$current' WHERE `id` = '1'",$con) or die(mysql_error());

    foreach($temp as $val)
    {
    $name = $val['name'];
    $mobile = $val['number'];
    $email = $val['email'];
    $ownerID = $val['ownerID'];     
    $code = $val['code'];   
    $leadsource=$val['leadsource'];
    $RMOwnerid = $val['RMOwnerid'];
    
    if($code != '' && $ownerID=='' && $leadsource=='')
    {
    // $source = '36'; // website referral
    $getOwner = mysql_query("SELECT `ownerid` FROM `contact` WHERE code='$code'",$con) or die(mysql_error());
    $rowOwner = mysql_fetch_row($getOwner);
    $ownerID = $rowOwner['ownerid'];
    $source = '57';
    }
    else if($ownerID!='0' && $ownerID!='' && $code == '' && $leadsource=='')
    {
    $source = '52';
    }
    
    else if($leadsource=='SMM' && $ownerID=='1' && $code == '')
    {
    $source = '55';//SMM leads
    }

    else if($leadsource=='MCL' && $ownerID=='1' && $code == '')
    {
    $source = '56';//MissedCall leads
    }
    
    else if($code != '' && $ownerID=='' && $leadsource=='BPL')
    {
    $getOwner = mysql_query("SELECT `ownerid` FROM `contact` WHERE code='$code'",$con) or die(mysql_error());
    $rowOwner = mysql_fetch_array($getOwner);
        
    $ownerID=$rowOwner[0];
    //$ownerID='52';
    //$ownerID=$val['ownerID'];     
    $source = '57'; // Bussiness Partner Leads
    }
    
    
    else
    {
    $source = '30'; 
    }
    

    $checkOld = mysql_query("SELECT * FROM `contact` WHERE `mobile` LIKE '%$mobile%' OR `phone` LIKE '%$mobile%'",$con) or die(mysql_error());
    if(mysql_num_rows($checkOld) > 0)
    {
    $rowOld = mysql_fetch_array($checkOld);
    $thisid = $rowOld['id'];
    $oldDesc= $rowOld['description'];
    if($name == 'NA' && $leadsource=='')
    {
    $type = "Get A Call Section";
    }
    else if($code == '' && $name != 'NA'  && $leadsource=='')
    {
    $clientName=$rowOld['fname']." ".$rowOld['lname'];
    $clientEmail=$rowOld['email'];
    $ownerid=$rowOld['ownerid'];
    
    $type = "<strong>" .$clientName. "</strong> is trying to make a Payment";
    

     mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$thisid','55','0','$datetime','0000:00:00')",$con) or die(mysql_error());

    }
    
    else if($leadsource=='SMM' && $ownerID=='1' && $code == '')
    {
    $type = "Under SMM Leads";//SMM leads
    }
    
    else if($leadsource=='MCL' && $ownerID=='1' && $code == '')
    {
    $type = "Under Miss Call Leads";//MissedCall leads  
    }
    
    else
    {
    $type = "Referred by client id with code:" .$code;
    }
    
    $note = "Number re-entered from website: ".$type;

    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('Website', '$note', '$thisid', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());

    mysql_query("UPDATE `contact` SET `notified` = '1' WHERE `id` = '$thisid'",$con) or die(mysql_error());
    }
    else
    {
    $checkCode = '0';
    //$ownerID
    $getmate=mysql_query("SELECT `mateid`,`teamid` FROM `teamamtes` WHERE `teamid` IN(12,15,20,21) ORDER BY RAND() LIMIT 1",$con) or die(mysql_error());
    $mates = $getmate['mateid'];
    if($source == 30)
    {
        if($code != '')
        {
            $brokerage = 10;
        }
    
    $result = mysql_query("INSERT INTO `contact`(`ownerid`, `fname`, `mobile`, `email`, `leadstatus`, `leadsource`, `latestresponse`, `contactstatus`, `callbackdate`,  `city`, `product`, `alloted`, `converted`, `mark`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`,`notified`,`inroducer`,`%brokerage`) VALUES ('$mates', '$name', '$mobile', '$email', '3', '$source', '1', '1', '$date', '1', '1', '0', '0', '0', '', '$datetime', '$datetime', '$loggeduserid', '0','1','$code','$brokerage')",$con) or die(mysql_error());

    echo $result;
    }
    else
    {
    if($code != '')
    {
            $brokerage = 10;
    }
    mysql_query("INSERT INTO `contact`(`ownerid`, `fname`, `mobile`, `email`, `leadstatus`, `leadsource`, `latestresponse`, `contactstatus`, `callbackdate`,  `city`, `product`, `alloted`, `converted`, `mark`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`,`notified`,`inroducer`,`%brokerage`) VALUES ('1', '$name', '$mobile', '$email', '3', '$source', '1', '1', '$date', '1', '1', '0', '0', '0', '', '$datetime', '$datetime', '$loggeduserid', '0','1','$code','$brokerage')",$con) or die(mysql_error());
    }
    $thisid = mysql_insert_id();
        
    if($name == 'NA' && $ownerID=='' && $leadsource=='')
    {
    $type = "Get A Call Section";
    }
    else if($code == '' && $name != 'NA' && $ownerID=='0' &&  $leadsource=='')
    {
    $type = "Open An Account Section";
    }
    else if($ownerID!='0' && $ownerID!='' && $leadsource=='')
    {
    $type = "Employee Referral Section";    
    }
    
    else if($leadsource=='SMM')
    {
    $type = "Social Media Leads";   
    }
    
    else if($leadsource=='MCL' && $ownerID=='1' && $code == '')
    {
    $type = "Under Miss Call Leads";//MissedCall leads  
    }
    
    else if($leadsource=='BPL' && $ownerID!='' && $code != '')
    {
    $type = "Under Bussiness Partner Leads";//MissedCall leads  
    }
    
    
    else
    {
    $type = "Referred by client id with code:" .$code;
    $checkCode = '1';
    
    $getData=mysql_query("SELECT `id`,`mobile` FROM `contact` WHERE `contact`.`converted`='1' AND `contact`.`code`='$code'",$con) or die(mysql_error());
    $row=mysql_fetch_array($getData);
    
    mysql_query("INSERT INTO `email_queue` (`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$row[0]','70','0','$datetime','0000-00-00')",$con) or die(mysql_error());

    
    
    /* start of sending sms for Client Referral*/
    

    $msg="Thank you for referring a client to TradingBells. We will review the details and let you know should there be any query. Keep referring and Keep earning!";


    $sms=urlencode($msg);

 $url = "http://125.16.147.178/webresources/CreateSMSCampaignGet?ukey=Ua5rw76jxFOucluTT4UPAFEBs&msisdn=".$row[1]."&language=0&credittype=2&senderid=TBELLS&templateid=0&message=".$sms;

   //$url = "http://bulkpush.mytoday.com/BulkSms/SingleMsgApi?feedid=360855&username=9177022699&password=mjttt&To=91".$row[1]."&Text=".$sms;
   $ch = curl_init($url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   $curl_scraped_page = curl_exec($ch);
   curl_close($ch);


   mysql_query("INSERT INTO `sentsms`(`cid`, `mobile`, `sms`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('$row[0]','$row[1]','$sms','','$datetime','$datetime','$loggeduserid','0')",$con) or die(mysql_error());

   mysql_query("INSERT INTO `smslog`(`cid`, `mobile`, `sms`, `status`, `id`, `createdate`, `updatedby`) VALUES ('$row[0]','$row[1]','$sms','0','','$datetime','$loggeduserid')",$con) or die(mysql_error());


   /* End of sending sms for Client Referral */
    
    
    
    }
    $note = "Number added from website: ".$type;

    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('Website', '$note', '$thisid', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());
    $prodEnter = '1';
    
    if($checkCode == '1')
    {
    $getCodeUser = mysql_query("SELECT * FROM `contact` WHERE `code` = '$code'",$con) or die(mysql_error());
    if(mysql_num_rows($getCodeUser) > 0)
    {
    $rowCodeUser = mysql_fetch_array($getCodeUser);
    $oldAlloted = $rowCodeUser['ownerid'];
    
    if($oldAlloted != '0')
    {
    mysql_query("UPDATE `contact` SET `ownerid` = '$oldAlloted' WHERE `id` = '$thisid'",$con)or die(mysql_error());
    $prodEnter = '0';
    }
    else
    {
    $prodEnter = '1';
    }
    }
    else
    {
    $prodEnter = '1';
    }
    }
        
    if($prodEnter == '1')
    {
    $getToday = mysql_query("SELECT * FROM `totalallotment` WHERE `date` = '$date'",$con) or die(mysql_error());
    $rowToday = mysql_num_rows($getToday);
    
    if($rowToday == '0')
    {
    mysql_query("UPDATE `totalallotment` SET `alloted` = '0', `date` = '$date'",$con) or die(mysql_error());
    }
    /*
    $getMin = mysql_query("SELECT * FROM `totalallotment` ".$instr." ORDER BY `alloted` ASC LIMIT 1",$con) or die(mysql_error());
    $rowMin = mysql_fetch_array($getMin);
    $toallot = $rowMin['userid'];
        
    $rand= rand (0,$k);
    $toallot = $tempAr[$rand]; */
    mysql_query("UPDATE `contact` SET `ownerid` = '1' WHERE `id` = '$thisid'",$con)or die(mysql_error());
    mysql_query("UPDATE totalallotment SET alloted = alloted + 1 WHERE userid = '$toallot'",$con) or die(mysql_error());
    }
    if($ownerID!='0' && $ownerID!='')
    {
    mysql_query("UPDATE `contact` SET `ownerid` = '$ownerID' WHERE `id` = '$thisid'",$con)or die(mysql_error());    
    }
    }
    }
    



}
$i=0;

$getNotif = mysql_query("SELECT * FROM `contact` WHERE `notified` = '1' AND `ownerid` = '1' LIMIT 1",$con) or die(mysql_error());
if(mysql_num_rows($getNotif) > 0)
{
?>
    <?php
    while($rowNotif = mysql_fetch_array($getNotif))
    { 
    $thisid = $rowNotif['id'];
    
//  mysql_query("UPDATE `contact` SET `notified` = '2' WHERE `id` = '$thisid'",$con) or die(mysql_error());

    ?>

    <?php
    echo $thisid;
    }
    ?>
    <?php
    $i++;
}


else 
{
$getReenterClient = mysql_query("SELECT `contact`.`id`,`contact`.`fname`,`contact`.`mobile` FROM `contact` INNER JOIN `customersupport` ON `contact`.`id`=`customersupport`.`clientid` WHERE `customersupport`.`RMOwnerid`='$loggeduserid' AND `contact`.`converted`='1' AND (`contact`.`mobile`='$mobile' OR `contact`.`phone`='$mobile') AND `contact`.`notified`='1' LIMIT 1",$con) or die(mysql_error());
  
if(mysql_num_rows($getReenterClient) > 0)
{
$row=mysql_fetch_array($getReenterClient);  
    
$sting .= "Name: ".$row['fname'];
$sting .= "--Mobile: ".$row['mobile'];
$sting .= "\r\n Mobile Number Reentered from Website .";    
echo $sting;

    mysql_query("UPDATE `contact` SET `notified` = '2' WHERE `id` = '$row[0]'",$con) or die(mysql_error());
    
}

$getReenterLead = mysql_query("SELECT `contact`.`id`,`contact`.`fname`,`contact`.`mobile` FROM `contact` WHERE `contact`.`ownerid`='$loggeduserid' AND `contact`.`converted`='0' AND (`contact`.`mobile`='$mobile' OR `contact`.`phone`='$mobile') AND `contact`.`notified`='1' LIMIT 1",$con) or die(mysql_error());
  
if(mysql_num_rows($getReenterLead) > 0)
{
$row=mysql_fetch_array($getReenterLead);    
$sting .= "Name: ".$row['fname'];
$sting .= "--Mobile: ".$row['mobile'];
$sting .= " \r\n Mobile Number Reentered from Website .";   
echo $sting;    

    mysql_query("UPDATE `contact` SET `notified` = '2' WHERE `id` = '$row[0]'",$con) or die(mysql_error());

}
else 
{
echo '0';   
}
}


}
else
{
echo "0";
}
?>
