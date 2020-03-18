    <?php
    include("../include/conFig.php");
    $trans = rand(100,10000);
    $trans = $trans.time();

    $valto = $_POST['valto'];
    $id = $_GET['id'];


    $chkAlready = mysql_query("SELECT `id` FROM `servicecall` WHERE `cid` = '$id' AND `type` = 'c'",$con) or die(mysql_error());
    
    if(mysql_num_rows($chkAlready) > 0)
	{
	echo "already";
    }
	else 
	{
	$valto = explode("*$*$*",$valto);
	foreach($valto as $val)
	{
	$val = str_ireplace("'","\'",$val);
	$post[] .= $val;
	}
	
	$getData = mysql_query("SELECT `email`,`fname`,`lname`,`mobile` FROM `contact` WHERE `id` = '$id'",$con) or die(mysql_error());
	$row = mysql_fetch_array($getData);

	// if($post[5] == 1){
	// 	$refno = "TB_ORDS".$post[6];
	//}else 

	// if($post[5] == 5){
	// 	$refno = "pay_".$post[6];
	// }else if($post[5] == 6){
	// 	$refno = "Inactive";
	// }else{
	// 	$refno = $post[6];
	// }
	
	mysql_query("UPDATE `contact` SET `kycmethod`='$post[0]',`segment`='$post[1]',`personverification`='$post[2]',`comments`='$post[10]',`conversionrequestdate`='$datetime',`accountopeningamount`='$post[4]',`accountopeningreffno`='$post[6]',`pancardnumber`='$post[9]',`paymethod`='$post[5]',`inroducer`='$post[3]',`softwarerequired`='1' WHERE `id`= '$id'",$con)or die(mysql_error());
    $note = "Client conversion requested by <strong>".$loggedname."</strong>";
	mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('Crequest', '$note', '$id', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());
	mysql_query("INSERT INTO `servicecall` (`cid`, `type`, `approved`, `id`, `createdate`, `modifieddate`, `updatedby`,`transactionalid`) VALUES ('$id', 'c', '0', '', '$datetime', '$datetime', '$loggeduserid','$trans')",$con) or die(mysql_error());
	mysql_query("INSERT INTO `invoice`(`cid`, `transactionalid`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`,`approved`) VALUES ('$id','$trans','','$datetime','$datetime','$loggeduserid','0','0')",$con) or die(mysql_error());

/*	$kycmethod = array('1'=>'Physical KYC','2'=>'E-KYC');
	$demataccountrequied = array('1'=>'Yes','2'=>'No');
	$segment = array('1'=>'Equity','2'=>'Equity Derivatives','3'=>'Currency Derivatives','4'=>'Commodity Derivatives');
	$softwarerequired = array('1'=>'Net Net','2'=>'Odin','3'=>'Iwin','4'=>'NOW');
	$segmentlist = '';
	$lst = explode(",",$post[2]);
	foreach($lst as $val) 
	{
	$val = str_ireplace("-","",$val);
	$val = trim($val);
	if($val != '') 
	{
	$segmentlist .= $segment[$val].',';
	}
	}                   */
	
	
	
 /* start of sending sms on Client conversion Request */
    $msg="Thank you for submitting your documents. We are working towards processing your form and shall get back to you should there be any query. www.tradingbells.com"; 

    $sms=urlencode($msg);
$url = "http://125.16.147.178/webresources/CreateSMSCampaignGet?ukey=Ua5rw76jxFOucluTT4UPAFEBs&msisdn=".$row[3]."&language=0&credittype=2&senderid=TBELLS&templateid=0&message=".$sms;

   // $url = "http://bulkpush.mytoday.com/BulkSms/SingleMsgApi?feedid=360855&username=9177022699&password=mjttt&To=91".$row[3]."&Text=".$sms;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $curl_scraped_page = curl_exec($ch);
    curl_close($ch);


     mysql_query("INSERT INTO `sentsms`(`cid`, `mobile`, `sms`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('$id','$row[3]','$sms','','$datetime','$datetime','$loggeduserid','0')",$con) or die(mysql_error());

     mysql_query("INSERT INTO `smslog`(`cid`, `mobile`, `sms`, `status`, `id`, `createdate`, `updatedby`) VALUES ('$id','$row[3]','$sms','0','','$datetime','$loggeduserid')",$con) or die(mysql_error());


   /* End of sending sms on Client conversion Request */
	

	
    //mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$id','59','0','$datetime','0000:00:00')",$con) or die(mysql_error());
  	
	// $templatefor = 'EKYC';
	// if($post[0] == 1)
	// {
	// $templatefor = 'physical_kyc';
	// }
	//echo "SELECT `subject` FROM  `sentemail` WHERE `cid` = '".$id."' AND (`subject` = 'physical_kyc' OR `subject` = 'EKYC')";
	// $getsentTemplate = mysql_query("SELECT `subject` FROM  `sentemail` WHERE `cid` = '".$id."' AND (`subject` = 'physical_kyc' OR `subject` = 'EKYC')",$con) or die(mysql_error());
	// $rowsentTemplate = mysql_fetch_array($getsentTemplate);	
	// if(empty($rowsentTemplate)) 
	// {
 //    $getTemplate = mysql_query("SELECT `id` FROM  `templateemail` WHERE `templatefor` = '$templatefor'",$con) or die(mysql_error());
	// $rowTemplate = mysql_fetch_array($getTemplate);
	
	// mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$id','$rowTemplate[0]','0','$datetime','0000:00:00')",$con) or die(mysql_error());

	
/*	$getTemplate = mysql_query("SELECT `templateemail`,`subject` FROM  `templateemail` WHERE `templatefor` = 'document_received'",$con) or die(mysql_error());
	$rowTemplate = mysql_fetch_array($getTemplate);
	$templateemail = !empty($rowTemplate[0]) ? $rowTemplate[0] : '' ;
	$subject = !empty($rowTemplate[1]) ? $rowTemplate[1] : '' ;
	if(!empty($templateemail)) 
	{
	
    $clientname = ucfirst($row[1]).' '.ucfirst($row[2]);
	$clientemail = $row[0];
	$templateemail = str_ireplace("{client_name}",$clientname,$templateemail);
	


    mysql_query("INSERT INTO `email_queue` (`cid`, `to_email`, `cc_email`, `bcc_email`, `subject`,`html`) VALUES ('$id', '$clientemail', '$loggedemail', 'admin@tradingbells.com', '$subject', '$templateemail')",$con) or die(mysql_error());
	mysql_query("INSERT INTO `sentemail`(`cid`, `email`, `subject`, `html`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('$id','$clientemail','$templatefor','$templateemail','','$datetime','$datetime','$loggeduserid','0')") or die(mysql_error());
	mysql_query("INSERT INTO `emaillog`(`cid`, `email`, `html`, `status`, `id`, `createdate`, `updatedby`) VALUES ('$id','$clientemail','$templateemail','0','','$datetime','$loggeduserid')",$con) or die(mysql_error());

	} */
	
	// }
    
  }
    ?>
