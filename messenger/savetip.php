<?php

include("../include/conFig.php");

$tip = $_POST['tip'];
$tip = str_ireplace("PLUSICON","+",$tip);
$serviceid = $_POST['serviceid'];

$serviceid = explode(",",$serviceid);

foreach($serviceid as $val)

{

	if($val != '')

	{

		$servId .= "-".$val."-,";

		$catStr .= $val.",";

	}

}



$catStr = substr($catStr,0,-1);



$servicename = $_POST['servicename'];

$time = date("H:i:s");

mysql_query("INSERT INTO `tips` (`sentbyname`,`tip`, `services`, `time`,`date`,`servicename`, `sentby`, `id`) VALUES ('$loggedname','$tip', '$servId', '$time','$date','$servicename','$loggeduserid', '')",$con) or die(mysql_error());

$resid = mysql_insert_id();





$getNumbers = mysql_query("SELECT contact.mobile FROM servicecall,product,contact WHERE servicecall.approved = '1' AND servicecall.cid = contact.id AND servicecall.fromdate <= '$date' AND  servicecall.todate >= '$date' AND servicecall.product = product.id AND servicecall.sms = '1' AND product.category IN ($catStr)",$con) or die(mysql_error());

/*while($row = mysql_fetch_array($getNumbers))
{
$number .= $row[0].",";
}
*/



//echo "To Send Numbers = ".$number;



//$getSms = mysql_query("SELECT * FROM `api` WHERE `id` = '1'",$con) or die(mysql_error());

//$rowSms = mysql_fetch_array($getSms);

$strtime = time();
$data='<!DOCTYPE REQ SYSTEM "http://bulkpush.mytoday.com/BulkSms/BulkSmsV1.00.dtd">
<REQ>
<VER>1.0</VER>
<USER>
        <USERNAME>9425902297</USERNAME>
        <PASSWORD>dwmpw</PASSWORD>
</USER>
<ACCOUNT>
        <ID>334479</ID>
</ACCOUNT>
<MESSAGE>
              <TAG>Uniqe tag 1</TAG>
               <TEXT>'.$tip.'</TEXT>                        
                     
        <MID>1</MID>'; 
$index = 1;        
while($row = mysql_fetch_array($getNumbers))
{
$number = $row[0];
if($number != '')
{
$data .= '<SMS FROM="RESRCH" TO ="91'.$number.'" INDEX="'.$index.'" TIME=""></SMS>';             
$index++;
}
}              
$data .='</MESSAGE></REQ>';

$apiUrl = "http://bulkpush.mytoday.com/BulkSms/SendSms";
$ch = curl_init($apiUrl);
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS, "UserRequest=".$data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
$output = curl_exec ($ch);
curl_close ($ch);
/*
$data='<?xml version="1.0" encoding="UTF-8"?'.'>
<xmlapi>
<auth>
<apikey>5688n7aj9838n91524nn</apikey>
</auth>
<sendSMS>
<to>'.$number.'</to>
<text>'.$tip.'</text>
<msgid>CUSTID1</msgid>                                                                                                                                                                                            
<sender>RESRCH</sender>
</sendSMS>
<response>Y</response>
</xmlapi>';


$apiUrl = "http://map-alerts.smsalerts.biz/api/xmlapi.php";
$ch = curl_init($apiUrl);
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS, "data=".$data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
$output = curl_exec ($ch);
curl_close ($ch);
*/
if($_GET['newCat'])

{

$newCat = $_GET['newCat'];

mysql_query("INSERT INTO `prefix` (`id`, `name`, `addedby`) VALUES ('', '$newCat', '$loggeduserid')",$con) or die(mysql_error());
}

echo $resid."BREAKTOGETLOGGEDID".$loggeduserid;
?>