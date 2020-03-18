<?php
date_default_timezone_set('Asia/Calcutta');
$datetime = date("Y-m-d H:i:s");
$date = date("Y-m-d");

$con = mysql_connect('localhost','root','');
if(!$con)
{
die();
}
else
{
mysql_select_db('crm',$con);
}
$getclient = mysql_query("SELECT `email` FROM `contact_duplicate` WHERE `converted` = '1'",$con) or die(mysql_error());

while($clientdata = mysql_fetch_array($getclient)){

	$email = $clientdata['email'];
	$templateemail = file_get_contents("email_template.html");
	$params = Array();
	$params['content'] = $templateemail;
	$params['recipients'] = $email;
	$params['subject'] = '*IMPORTANT* Our phone numbers are changing';
	$params['recipients_cc'] = '';
	$params['bcc'] = '';
	$params['from'] ='helpdesk@tradingbells.com';
	$params['fromname'] = 'TradingBells Helpdesk Team';
	$params['api_key'] ="acd293ca5a3b70c6e958f65c495f1721";
	$params['opentrack'] = "1";
	$params['clicktrack'] ="1";
	$params['X-APIHEADER'] = "1234";

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_HTTPHEADER, array('Expect:'));	
	curl_setopt($ch,CURLOPT_URL,"http://api.falconide.com/falconapi/web.send.rest");
	curl_setopt($ch,CURLOPT_POST,"1");
	curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	$output=curl_exec($ch);
	print_r($output);
	curl_close($ch);

}

?>