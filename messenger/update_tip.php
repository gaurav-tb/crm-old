<?php
include('check_session.php');
$newtip = $_GET['newtip'];
$service = $_GET['service'];
$name = $_GET['name'];
$tipMode= $_GET['tipMode'];
$service = str_ireplace("null","",$service);
$newtip = str_ireplace("thisismpercentinjavascipt","&",$newtip);
$newtip = str_ireplace("thisishashinjavascipt","#",$newtip);
$newtip_sms = str_ireplace("<br/>","\r\n",$newtip);
$time = date("H:i:s");
if($tipMode == '0' || $tipMode == '2')
{
	if(!mysql_query("INSERT INTO `tips`(`message`,`date`,`service`,`time`,`user`)VALUES('$newtip','$date','$service','$time','$name')",$con))
	{
		echo 'false';
	}
}
if($tipMode == '0' || $tipMode == '1')
{
$serviceMode = explode("::",$service);
	foreach($serviceMode as $val)
	{
		if($val != '')
		{
			$sendService[] .= $val; 
		
		}
	}

$getNumbers = mysql_query("SELECT * FROM `groups` WHERE `id` = '1'",$con);
$row = mysql_fetch_array($getNumbers);

foreach($sendService as $val)
{
$val = strtolower($val);
	if($val == 'intradayfuture')
	{
	$val = 'future';
	}
if($row[$val])
	{
	$numberArray .= $row[$val].",";
	}
	
}

$getNumbers = mysql_query("SELECT * FROM `groups_ft` WHERE `id` = '1'",$con);
$row = mysql_fetch_array($getNumbers);

foreach($sendService as $val)
{
$val = strtolower($val);
	if($val == 'intradayfuture')
	{
	$val = 'future';
	}
	if($row[$val])
	{
	$numberArray .= $row[$val].",";
	
	}
	
}


$numberArray = str_ireplace("\n",",",$numberArray);
$numberArray = explode(",",$numberArray);
$numberArray = array_unique($numberArray);
$numberActualArray = $numberArray;
$numberArray = implode(",",$numberArray);
$result = mysql_query("SELECT `current` FROM `gateway` WHERE `id` = '1'",$con);
$row = mysql_fetch_array($result);

$newtip_sms = str_ireplace("&","and",$newtip_sms);
$newtip_sms = str_ireplace("+","%2B",$newtip_sms);

$data='<?xml version="1.0" encoding="UTF-8"?'.'>
<xmlapi>
<auth>
<apikey>5688n7aj9838n91524nn</apikey>
</auth>
<sendSMS>
<to>'.$numberArray.'</to>
<text>'.$newtip_sms.'</text>
<msgid>CUSTID1</msgid>                                                                                                                                                                                            
<sender>RESRCH</sender>
</sendSMS>
<response>Y</response>
</xmlapi>';


$apiUrl = "http://69.167.136.130/alerts/api/xmlapi.php";
$ch = curl_init($apiUrl);
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS, "data=".$data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
$output = curl_exec ($ch);
curl_close ($ch);


/*
$data='<?xml version="1.0" encoding="UTF-8"?'.'>
<xmlapi>
<auth>
<apikey>2111ytiar3gs098r2s4v</apikey>
</auth>
<sendSMS>
<to>'.$numberArray.'</to>
<text>'.$newtip_sms.'</text>
<msgid>CUSTID1</msgid>                                                                                                                                                                                            
<sender>RESRCH</sender>
</sendSMS>
<response>Y</response>
</xmlapi>';



$apiUrl = "http://69.167.136.130/alerts/api/xmlapi.php";
$ch = curl_init($apiUrl);
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS, "data=".$data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
$output = curl_exec ($ch);
curl_close ($ch);
*/
/*

//$url = 'http://tran.icisms.in/xmlapi.php';
$url = 'http://69.167.137.5/instant1/xmlapi.php';
$str = "<xmlapi><auth><user>resrch</user><passwd>abcd123</passwd><sender>RESRCH</sender></auth><sendSMS><to>".$numberArray."</to><text>".$newtip_sms."</text><msgid>CUSTOMID1</msgid></sendSMS><response>Y</response></xmlapi>";

//$url = 'http://bulkpush.mytoday.com/BulkSms/SingleMsgApi';
//$str = "null&feedid=334483&senderid='RESRCH'&username=9424511100&password=wgdgt&To=".$numberArray."&Text=".$newtip_sms;



$ch = curl_init($url);

				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,'data='.$str);
				$output = curl_exec($ch);
				

*/





}



?>