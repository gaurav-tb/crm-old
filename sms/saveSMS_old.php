<?php 

include("../include/conFig.php");

$cid = $_GET['cid'];

$valto = $_POST['valto'];

$valto = explode("*$*$*",$valto);

foreach($valto as $val)

{

$val = str_ireplace("'","\'",$val);

$post[] .= $val;

}
if(in_array('SMS_api1',thisPer))
{
$url = "http://control.msg91.com/sendhttp.php?user=".urlencode('sdevpura')."&password=".urlencode('9876543210')."&mobiles=".urlencode($post[0])."&message=".urlencode($post[1])."&sender=".urlencode('WTOCAP');
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$curl_scraped_page = curl_exec($ch);
curl_close($ch);
//echo $curl_scraped_page;
}
else
{
echo 'here';
/*
$url = "http://vtermination.com/sendhttp.php?user=ways2c&password=ways2capital&mobiles=".$post[0]."&message=".$post[1]."&sender=WAYSTO";
echo $url; 
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$curl_scraped_page = curl_exec($ch);
curl_close($ch);
echo $curl_scraped_page;
*/
	
$url = "http://vtermination.com/NewXML.php";

$data=urlencode('<MESSAGE><username>ways2c</username><password>ways2capital</password>
<seqid>1563876444</seqid>

<SMS TEXT="'.$post[1].'">
<ADDRESS FROM="WAYSTO" TO="'.$post[0].'" SEQ="8475464089">
</ADDRESS></SMS></MESSAGE>');

$query = 'data='.$data;
$objURL = curl_init($url);
curl_setopt($objURL, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($objURL,CURLOPT_POST,1);
curl_setopt($objURL, CURLOPT_POSTFIELDS,$query);
$response = trim(curl_exec($objURL));
curl_close($objURL);
echo $response;	
}	
mysql_query("INSERT INTO `sentsms`(`cid`, `mobile`, `sms`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('$cid','$post[0]','$post[1]','','$datetime','$datetime','$loggeduserid','0')",$con) or die(mysql_error());

mysql_query("INSERT INTO `smslog`(`cid`, `mobile`, `sms`, `status`, `id`, `createdate`, `updatedby`) VALUES ('$cid','$post[0]','$post[1]','0','','$datetime','$loggeduserid')",$con) or die(mysql_error());

echo '<td><p style="color:green;font-size:12px;">SMS Sent Successfully</p></td>';



?>