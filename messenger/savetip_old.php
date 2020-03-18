<?php
include("../include/conFig.php");
$tip = $_POST['tip'];
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
while($row = mysql_fetch_array($getNumbers))
{
$number .= $row[0].",";
}

//echo "To Send Numbers = ".$number;

//$getSms = mysql_query("SELECT * FROM `api` WHERE `id` = '1'",$con) or die(mysql_error());
//$rowSms = mysql_fetch_array($getSms);


/*$url = 'http://69.167.137.5/instant1/xmlapi.php';
$str = "<xmlapi><auth><user>trifid</user><passwd>trifid123</passwd><sender>TRIFID</sender></auth><sendSMS><to>".$number."</to><text>".$tip."</text><msgid>CUSTOMID1</msgid></sendSMS><response>Y</response></xmlapi>";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,'data='.$str);
				$output = curl_exec($ch);
	

*/


if($_GET['newCat'])
{
$newCat = $_GET['newCat'];
mysql_query("INSERT INTO `prefix` (`id`, `name`, `addedby`) VALUES ('', '$newCat', '$loggeduserid')",$con) or die(mysql_error());
}
echo $resid;
?>
