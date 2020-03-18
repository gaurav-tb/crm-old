<?php
include("../include/conFig.php");
$id = $_POST['mobile'];
//$cid = $_POST['id'];
$getTid = mysql_query("SELECT `transactionalid`,`cid`,`approved` FROM `invoice` WHERE `id` = '$id'",$con) or die(mysql_error());
$rowTid = mysql_fetch_array($getTid);


$product = $_POST['productid'];
$quantity= $_POST['quantity'];
$discount = $_POST['discount'];
$adjustment= $_POST['adjustment'];
$from= $_POST['from'];
$to= $_POST['to'];
$subtotal= $_POST['st'];

$cid= $rowTid[1];


$getdata=mysql_query("select * from `contact` where `delete` = '0' and `id` = '$cid'",$con)or die(mysql_error());
$fetchData=mysql_fetch_array($getdata);



$mobile= $fetchData['mobile'];
$tp= $_POST['tp'];
$dc= $_POST['dc'];
$ad= $_POST['ad'];
$gt= $_POST['gt'];
$pp= $_POST['pp'];
$dealtype = $_POST['dealtype'];
$offer = $_POST['offer'];
$term = $_POST['term'];
$sms = $_POST['sms'];
$call = $_POST['call'];
$messenger = $_POST['messenger'];
$bank = $_POST['bank'];
$paymode = $_POST['paymode'];
$paydetails = $_POST['paydetails'];
$des = $_POST['des'];
$p = explode(",",$product);
$q = explode(",",$quantity);
$f = explode(",",$from);
$t = explode(",",$to);
$st = explode(",",$subtotal);
if($rowTid[0] != '')
{
mysql_query("DELETE FROM `servicecall` WHERE `transactionalid` = '$rowTid[0]' AND `type` = 'c'",$con) or die(mysql_error());
}
$k = 0;
foreach($p as $val)
{
	if($val != '0')
	{
		$tlq = $q[$k];	
		$tlf = $f[$k];
		$tlt = $t[$k];
		$tls = $st[$k];
		mysql_query("INSERT INTO `servicecall`(`cid`, `mobile`, `product`, `quantity`, `fromdate`, `todate`, `subtotal`,`transactionalid`, `modifieddate`, `updatedby`, `delete`,`type`,`approved`,`sms`,`call`,`messenger`) VALUES ('$cid','$mobile','$val','$tlq','$tlf','$tlt','$tls', '$rowTid[0]', '$datetime','$loggeduserid','0','c','$rowTid[2]','$sms','$call','$messenger')",$con) or die(mysql_error());
		
	}
	$k++;

}




include("../invoice/readInvoice.php");

$html = str_ireplace("'","",$html);

//echo "UPDATE `invoice` SET `html`= '$html',`totalprice`='$tp',`discount`='$dc',`adjustment`='$ad',`grandtotal`='$gt',`modifieddate`='$datetime',`updatedby`='$loggeduserid',`dealtype`='$dealtype',`offer`='$offer',`term`='$term',`sms`='$sms',`call`='$call',`messenger`='$messenger',`bank`='$bank',`paymode`='$paymode',`paydetails`='$paydetails',`des`='$des', `approved` = '$rowTid[2]', `partialpayment`= '$pp' WHERE `id` = '$id'";
mysql_query("UPDATE `invoice` SET `html`= '$html',`totalprice`='$tp',`discount`='$dc',`adjustment`='$ad',`grandtotal`='$gt',`modifieddate`='$datetime',`updatedby`='$loggeduserid',`dealtype`='$dealtype',`offer`='$offer',`term`='$term',`sms`='$sms',`call`='$call',`messenger`='$messenger',`bank`='$bank',`paymode`='$paymode',`paydetails`='$paydetails',`des`='$des', `approved` = '$rowTid[2]', `partialpayment`= '$pp' WHERE `id` = '$id'",$con) or die(mysql_error());
echo $id;
ob_flush();
?>