<?php
error_reporting(0);
include("include/conFig.php");
if($loggeduserid == 1) 
{
	
$getData=mysql_query("SELECT email_queue.email_queue_id,templateemail.templateemail,email_queue.templateid,templateemail.subject,contact.email,contact.code,contact.fname,contact.lname,contact.address,contact.mobile,contact.pancardnumber,contact.bankname,contact.bankbranchname,contact.bankaccounttype,contact.bankaccountnumber,contact.dpname,contact.dpid,contact.clientid,contact.ownerid,contact.kycmethod,contact.demataccountrequied,contact.segment,contact.softwarerequired,contact.conversionrequestdate,contact.dob,contact.id from `email_queue` INNER JOIN `templateemail` ON `email_queue`.`templateid`=`templateemail`.`id` INNER JOIN `contact` ON `email_queue`.`cid`=`contact`.`id` WHERE `email_queue`.`queue_up_date`<='$datetime' AND `email_queue`.`is_send`='0' ORDER BY `email_queue`.`queue_up_date` limit 1",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
$empid=$row['ownerid'];
$code=$row['code'];
$cid=$row['id'];

$getCusSup=mysql_query("SELECT * FROM `customersupport` WHERE `clientid`='$cid'",$con) or die(mysql_error());
$rowCus= mysql_fetch_array($getCusSup);



$getEmp=mysql_query("SELECT `employee`.`email` as `emp_email`,`employee`.`name` FROM `employee` INNER JOIN `contact` ON `employee`.`id`=`contact`.`ownerid` WHERE `contact`.`ownerid`='$empid'",$con) or die(mysql_error());
$rowEmp=mysql_fetch_array($getEmp);

$getPayout=mysql_query("SELECT `amount` FROM `fundspayinrequest` WHERE `created_date` LIKE '%$datetime%' AND `clientid`='$code'",$con) or die(mysql_error());
$rowPay=mysql_fetch_array($getPayout);

$kycmethod = array('1'=>'Physical KYC','2'=>'E-KYC');
$demataccountrequied = array('1'=>'Yes','2'=>'No');
$segment = array('1'=>'Equity','2'=>'Equity Derivatives','3'=>'Currency Derivatives','4'=>'Commodity Derivatives');
$softwarerequired = array('1'=>'Net Net','2'=>'Odin','3'=>'Iwin','4'=>'NOW');



$segmentlist = '';
$lst = explode(",",$row['segment']);
foreach($lst as $val) 
{
$val = str_ireplace("-","",$val);
$val = trim($val);
if($val != '') 
{
$segmentlist .= $segment[$val].',';
}
}
$segmentlist = rtrim($segmentlist,",");


$Reserachsegments = array('1'=>'Commodity','2'=>'Future And Option','3'=>'Equity');

$segmentResearchlist = '';
$lst = explode(",",$rowCus['ResearchSegments']);
foreach($lst as $val) 
{
$val = str_ireplace("-","",$val);
$val = trim($val);
if($val != '') 
{
$segmentResearchlist .= $Reserachsegments[$val].',';
}
}
$segmentResearchlist = rtrim($segmentResearchlist,",");




$kycmethod=$kycmethod[$row['kycmethod']];
$demataccount=$demataccountrequied[$row['demataccountrequied']];
$softwarerequire=$softwarerequired[$row['softwarerequired']];

$clientcode = (!empty($row['code'])) ? $row['code'] : 'NA';
$clientfname = (!empty($row['fname'])) ? $row['fname'] : 'NA';
$clientlname = (!empty($row['lname'])) ? $row['lname'] : '';
$clientname = $clientfname." ".$clientlname;
$clientaddress = (!empty($row['address'])) ? $row['address'] : 'NA';
$clientmobile = (!empty($row['mobile'])) ? $row['mobile'] : 'NA';
$clientemail = (!empty($row['email'])) ? $row['email'] : 'NA';
$pancardnumber = (!empty($row['pancardnumber'])) ? $row['pancardnumber'] : 'NA';
$bankname	 = (!empty($row['bankname'])) ? $row['bankname'] : 'NA';
$bankbranchname = (!empty($row['bankbranchname'])) ? $row['bankbranchname'] : 'NA';
$bankaccounttype = (!empty($row['bankaccounttype'])) ? $row['bankaccounttype'] : 'NA';
$bankaccountnumber = (!empty($row['bankaccountnumber'])) ? $row['bankaccountnumber'] : 'NA';
$dpname = (!empty($row['dpname'])) ? $row['dpname'] : 'NA';
$dpid = (!empty($row['dpid'])) ? $row['dpid'] : 'NA';
$clientid = (!empty($row['clientid'])) ? $row['clientid'] : 'clientid';
$employee_email = (!empty($rowEmp['emp_email'])) ? $rowEmp['emp_email'] : '';
$kycmethod = (!empty($kycmethod)) ? $kycmethod : '';
$segment = (!empty($segmentlist)) ? $segmentlist : '';
$demataccountrequied =(!empty($demataccount)) ? $demataccount : '';
$softwarerequired= (!empty($softwarerequire)) ? $softwarerequire : '';
$templateemail=(!empty($row['templateemail'])) ? $row['templateemail'] : '';
$employeename=(!empty($rowEmp['name'])) ? $rowEmp['name'] : '';
$conversionrequest=(!empty($row['conversionrequestdate'])) ? $row['conversionrequestdate'] : '';
$clientbirth=(!empty($row['dob'])) ? $row['dob'] : '';
$amount=(!empty($rowPay['amount'])) ? $rowPay['amount'] : '';
$subject=(!empty($row['subject'])) ? $row['subject'] : '';
$segmentResearch = (!empty($segmentResearchlist)) ? $segmentResearchlist : '';
$segmentAmount = (!empty($rowCus['Activationamt'])) ?  $rowCus['Activationamt'] : '';


$templateemail = str_ireplace("{client_code}",$clientcode,$templateemail);
$templateemail = str_ireplace("{client_name}",$clientname,$templateemail);
$templateemail = str_ireplace("{client_address}",$clientaddress,$templateemail);
$templateemail = str_ireplace("{client_mobile}",$clientmobile,$templateemail);
$templateemail = str_ireplace("{client_email}",$clientemail,$templateemail);
$templateemail = str_ireplace("{pan_no}",$pancardnumber,$templateemail);
$templateemail = str_ireplace("{bank_name}",$bankname,$templateemail);
$templateemail = str_ireplace("{branch_name}",$bankbranchname,$templateemail);
$templateemail = str_ireplace("{account_type}",$bankaccounttype,$templateemail);
$templateemail = str_ireplace("{account_number}",$bankaccountnumber,$templateemail);
$templateemail = str_ireplace("{dp_name}",$dpname,$templateemail);
$templateemail = str_ireplace("{dp_id}",$dpid,$templateemail);
$templateemail = str_ireplace("{client_id}",$clientid,$templateemail);
$templateemail = str_ireplace("{conversion_request}",$conversionrequest,$templateemail);
$templateemail = str_ireplace("{kyc_method}",$kycmethod,$templateemail);
$templateemail = str_ireplace("{segment_require}",$segment,$templateemail);
$templateemail = str_ireplace("{demat_accountrequied}",$demataccountrequied,$templateemail);
$templateemail = str_ireplace("{software_required}",$softwarerequired,$templateemail);
$templateemail = str_ireplace("{employee_name}",$employeename,$templateemail);
$templateemail = str_ireplace("{client_dob}",$clientbirth,$templateemail);
$templateemail = str_ireplace("{amount}",$amount,$templateemail);
$templateemail = str_ireplace("'","\'",$templateemail);
$templateemail = str_ireplace("{pay_amount}",$amount,$templateemail);
$templateemail = str_ireplace("{research_segment}",$segmentResearch,$templateemail);
$templateemail = str_ireplace("{Activation_amt}",$segmentAmount,$templateemail);



$email_queue_id = (!empty($row['email_queue_id'])) ? $row['email_queue_id'] : '';


if($row['templateid']==60 || $row['templateid']==62 || $row['templateid']==63)
{
$to_email = (!empty($rowEmp['emp_email'])) ? $rowEmp['emp_email'] : '';	
}

 else if($row['templateid']==59)
{
$to_email ='tbsupport@tradingbells.com';	
}
else
{
$to_email = (!empty($row['email'])) ? $row['email'] : '';	
}
if($row['templateid']==55)
{
$cc_email = 'fund@tradingbells.com';
}
else
{
//$cc_email=(!empty($rowEmp['emp_email'])) ? $rowEmp['emp_email'] : '';
}

$bcc_email="admin@tradingbells.com";
$subject = (!empty($row['subject'])) ? $row['subject'] : '';
$templateemail = (!empty($templateemail)) ? $templateemail : '';


echo $to_email;

if(!empty($to_email)) 
{
$params = Array();
$params['content'] = $templateemail;
$params['recipients'] = $to_email;
$params['subject'] = $subject;
$params['recipients_cc'] = $cc_email;
$params['bcc'] = $bcc_email;
$params['from'] ="info@tradingbells.com";
$params['fromname'] = "TradingBells";
$params['api_key'] ="acd293ca5a3b70c6e958f65c495f1721";
$params['opentrack'] = "1";
$params['clicktrack'] ="1";
$params['X-APIHEADER'] = "1234";



$ch=curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));	
curl_setopt($ch,CURLOPT_URL,"http://api.falconide.com/falconapi/web.send.rest");
curl_setopt($ch,CURLOPT_POST,"1");
curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$output=curl_exec($ch);
curl_close($ch);

// $output;
$DataArray=json_decode($output,true);
$message=$DataArray['message'];

if($message =="SUCCESS") 
{
$prev_queue_id=$email_queue_id-1;		
mysql_query("UPDATE `email_queue` SET `is_send`='1',`send_date`='$datetime' WHERE `email_queue_id`='$email_queue_id'",$con)or die(mysql_error());
mysql_query("DELETE FROM `email_queue` WHERE `email_queue_id`='$prev_queue_id' AND `is_send`='1'",$con)or die(mysql_error());

mysql_query("INSERT INTO `sentemail`(`cid`, `email`, `subject`, `html`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('$cid','$clientemail','$subject','$templateemail','','$datetime','$datetime','$loggeduserid','0')") or die(mysql_error());
mysql_query("INSERT INTO `emaillog`(`cid`, `email`, `html`, `status`, `id`, `createdate`, `updatedby`) VALUES ('$cid','$clientemail','$templateemail','0','','$datetime','$loggeduserid')",$con) or die(mysql_error());


}
}

else
{
mysql_query("DELETE FROM `email_queue` WHERE `email_queue_id`='$email_queue_id'",$con)or die(mysql_error());
}

} 
else 
{
	
echo "Invalid Request";

} 
?>
