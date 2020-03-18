<?php
//error_reporting(0);
include("../include/conFig.php");
//if($loggeduserid == 1) 
//{

	
	
$params = Array();
$params['bodyHtml'] = 'test mail';
$params['to'] = 'ritu.sahu2014@gmail.com';
$params['msgTo'] = 'ritu.sahu2014@gmail.com';
$params['subject'] = 'Forgot Password Request';
$params['recipients_cc'] = 'admin@tradingbells.com';
$params['from'] ="info@tradingbells.in";
$params['replyTo'] ="info@tradingbells.com";
$params['fromName'] = "TradingBells";
$params['apikey'] ="3ef8a0d6-d597-4f04-a758-32545ab6b634";
$params['sender']='info@tradingbells.in';
$params['senderName']='TradingBells';
$params['msgFrom']='info@tradingbells.in';
$params['msgFromName']='Tradingbells';
$params['replyToName']='Tradingbells';
$params['isTransactional']=false;





// $params['content'] = 'Test mail';
// $params['recipients'] = 'ritu.sahu2014@gmail.com';
// $params['subject'] = 'Test';
// $params['recipients_cc'] = '';
// $params['bcc'] ='';
// $params['from'] ='ritu.s@tradingbells.com';  //$fromEmail
// $params['replytoid'] ='';  //$replyToId
// $params['fromname'] = 'TB';
// $params['api_key'] ="acd293ca5a3b70c6e958f65c495f1721";
// $params['opentrack'] = "1";
// $params['clicktrack'] ="1";
// $params['X-APIHEADER'] = "1234";

print_r($params);

// $ch=curl_init();
// curl_setopt($ch,CURLOPT_HTTPHEADER, array('Expect:'));	
// curl_setopt($ch,CURLOPT_URL,"http://api.falconide.com/falconapi/web.send.rest");
// curl_setopt($ch,CURLOPT_POST,"1");
// curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
// curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
// $output=curl_exec($ch);
// curl_close($ch);

$ch=curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));	
curl_setopt($ch,CURLOPT_URL,"http://tracking.orbitmx.com/v2/email/send");
curl_setopt($ch,CURLOPT_POST,"1");
curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$output=curl_exec($ch);
curl_close($ch);

 $DataArray=json_decode($output,true);
// $message=$DataArray['message'];

// if($message =="SUCCESS") 
// {
// 	echo "SUCCESS";
// }else{
// 	echo "Failed";
// }
print_r($DataArray);

?>
