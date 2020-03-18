<?php
include("../include/conFig.php");
$id = $_GET['id'];
$cid = $_GET['cid'];
$getContact = mysql_query("SELECT * FROM  `contact` WHERE `id` = '$cid'",$con) or die(mysql_error());
$rowContact = mysql_fetch_array($getContact);

$contid = (!empty($rowContact['id'])) ? $rowContact['id'] : 'NA';
$clientcode = (!empty($rowContact['code'])) ? $rowContact['code'] : 'NA';
$clientfname = (!empty($rowContact['fname'])) ? $rowContact['fname'] : 'NA';
$clientlname = (!empty($rowContact['lname'])) ? $rowContact['lname'] : '';
$clientname = $clientfname." ".$clientlname;
$clientaddress = (!empty($rowContact['address'])) ? $rowContact['address'] : 'NA';
$clientmobile = (!empty($rowContact['mobile'])) ? $rowContact['mobile'] : 'NA';
$clientemail = (!empty($rowContact['email'])) ? $rowContact['email'] : 'NA';
$pancardnumber = (!empty($rowContact['pancardnumber'])) ? $rowContact['pancardnumber'] : 'NA';
$bankname	 = (!empty($rowContact['bankname'])) ? $rowContact['bankname	'] : 'NA';
$bankbranchname = (!empty($rowContact['bankbranchname'])) ? $rowContact['bankbranchname'] : 'NA';
$bankaccounttype = (!empty($rowContact['bankaccounttype'])) ? $rowContact['bankaccounttype'] : 'NA';
$bankaccountnumber = (!empty($rowContact['bankaccountnumber'])) ? $rowContact['bankaccountnumber'] : 'NA';
$dpname = (!empty($rowContact['dpname'])) ? $rowContact['dpname'] : 'NA';
$dpid = (!empty($rowContact['dpid'])) ? $rowContact['dpid'] : 'NA';
$clientid = (!empty($rowContact['clientid'])) ? $rowContact['clientid'] : 'NA';	

$getTemplate = mysql_query("SELECT `templateemail`,`subject`,`id` FROM  `templateemail` WHERE `templatefor` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getTemplate);

   $templateemail = !empty($row[0]) ? $row[0] : '' ;
   $subject = !empty($row[1]) ? $row[1] : '' ;
   $templateid = !empty($row[2]) ? $row[2] : '' ;
   if(!empty($templateemail))
   {
   if($id == 'welcome_mail')
   {
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
	
	}
	else if($id == 'physical_kyc' || $id == 'EKYC' || $id == 'document_received')
	{
		$templateemail = str_ireplace("{client_name}",$clientname,$templateemail);
	}
	
	else if($id == 'document_verified' || $id== 'account_activation' || $id== 'online_helpdesk' ||$id== 'Save_brokerage' || $id== 'trading_tips' || $id== 'online_trading')
	{
	$templateemail = str_ireplace("{client_code}",$clientcode,$templateemail);
	$templateemail = str_ireplace("{client_name}",$clientname,$templateemail);
	}
	
	
	
	else if($id =='short_welcome')
	{
		$templateemail = str_ireplace("{client_code}",$clientcode,$templateemail);
	}
    }
    echo $templateemail.'###'.$subject.'###'.$templateid;
    ?>
