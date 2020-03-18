<?php 
include("include/conFig.php");
$id = $_GET['cid'];
	
mysql_query("UPDATE `contact` SET `welcomemail`= '1',`welcomemail_date`='$datetime' WHERE `id`='$id'",$con) or die(mysql_error());



       /* condition start for welcome mails */
        
        /* start of sending welcome sms		*/
		$msg="Dear Customer ".$code.". We have sent you an email with all your personal details from your trading and demat account. www.tradingbells.com 9667658800";	
	
		$sms=urlencode($msg);

		$url = "http://125.16.147.178/webresources/CreateSMSCampaignGet?ukey=Ua5rw76jxFOucluTT4UPAFEBs&msisdn=".$mobile."&language=0&credittype=2&senderid=TBELLS&templateid=0&message=".$sms;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $curl_scraped_page = curl_exec($ch);
        curl_close($ch);


        mysql_query("INSERT INTO `sentsms`(`cid`, `mobile`, `sms`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('$id','$mobile','$sms','','$datetime','$datetime','$loggeduserid','0')",$con) or die(mysql_error());

        mysql_query("INSERT INTO `smslog`(`cid`, `mobile`, `sms`, `status`, `id`, `createdate`, `updatedby`) VALUES ('$id','$mobile','$sms','0','','$datetime','$loggeduserid')",$con) or die(mysql_error());
	
		/*  end of sending welcome sms*/	
			
			
		mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$id','12','0','$datetime','0000:00:00')",$con) or die(mysql_error());
		
		// start of Client drip mails 
		
		// $getClientDrip=mysql_query("SELECT `id`,`onboardingdays` FROM  `templateemail` WHERE  `templatecategory`='7' AND `templateemail`.`delete`='0'") or die(mysql_error());
		
		// while($rowClientDrip=mysql_fetch_array($getClientDrip))
		// {
		// $addTime=$rowClientDrip[1]*3600*24  ;
		
	 //    $currentDate = strtotime($datetime);
		// $futureDate = $currentDate+$addTime;
  //       $UpdateEmailQueue= date("Y-m-d H:i:s", $futureDate);
	
		// mysql_query("INSERT INTO `onboardingemails`(`id`,`cid`,`EmailTemplateid`,`sendingDate`) VALUES('','$id','$rowClientDrip[0]','$UpdateEmailQueue')",$con) or die(mysql_error());
	 //    }   
	
		mysql_query("INSERT INTO `sentemail`(`cid`,`id`,`createdate`,`modifieddate`,`iswelcomemail`,`subject`) VALUES ('$id','','$datetime','$datetime','1','Welcome to TradingBells')",$con) or die(mysql_error());

        echo 1;	
mysql_close();
?>
