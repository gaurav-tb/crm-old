<?php
include("../include/conFig.php");
$trans = rand(100,10000);
$trans = $trans.time();
$product = $_POST['productid'];
$quantity= $_POST['quantity'];
$discount = $_POST['discount'];
$adjustment= $_POST['adjustment'];
$from= $_POST['from'];
$to= $_POST['to'];
$subtotal= $_POST['st'];
$cid= $_POST['cid'];
$mobile= $_POST['mobile'];
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
$chkAlready = mysql_query("SELECT `id` FROM `servicecall` WHERE `cid` = '$cid' AND `type` = 'c'",$con) or die(mysql_error());
if(mysql_num_rows($chkAlready) > 0)
{
$old = 1;
}
else
{
$old = 0;
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
		mysql_query("INSERT INTO `servicecall`(`cid`, `mobile`, `product`, `quantity`, `fromdate`, `todate`, `subtotal`, `transactionalid`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`,`type`,`approved`,`sms`,`call`,`messenger`) VALUES ('$cid','$mobile','$val','$tlq','$tlf','$tlt','$tls','$trans','','$datetime','$datetime','$loggeduserid','0','c','0','$sms','$call','$messenger')",$con) or die(mysql_error());
		
	}
	$k++;

}

//mysql_query("UPDATE `contact` SET `converted` = '1' WHERE `id` = '$cid'",$con) or die(mysql_error());

foreach($p as $val)
{
if($val != '' && $val != '0')
{
$getP = mysql_query("SELECT `name` FROM `product` WHERE `id` = '$val'",$con) or die(mysql_error());
$rowP = mysql_fetch_array($getP);
$pstr .= $rowP[0].", ";
}
}


$getdata=mysql_query("select * from `contact` where `delete` = '0' and `id` = '$cid'"  ,$con)or die(mysql_error());
$fetchData=mysql_fetch_array($getdata);

		
		
		
	
		
mysql_query("INSERT INTO `invoice`(`cid`, `transactionalid`, `html`, `totalprice`, `discount`, `adjustment`, `grandtotal`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`,`approved`, `dealtype`, `offer`, `term`, `sms`, `call`, `messenger`, `bank`, `paymode`, `paydetails`, `des`, `partialpayment`) VALUES ('$cid','$trans','','$tp','$dc','$ad','$gt','','$datetime','$datetime','$loggeduserid','0','0', '$dealtype', '$offer', '$term', '$sms', '$call', '$messenger', '$bank', '$paymode', '$paydetails', '$des', '$pp')",$con) or die(mysql_error());
$id = mysql_insert_id();
$chkAlready = mysql_query("SELECT `id` FROM `servicecall` WHERE `cid` = '$cid' AND `type` = 'c'",$con) or die(mysql_error());
if($old > 0)
{
$note = "New Service requested by <strong>".$loggedname."</strong><br/>Purchase initiated of <strong>".$pstr."</strong> for <strong>Rs.".$gt."/-</strong> with PurchaseId <strong>CLT".$id."</strong> AND Inovice Number <strong>INV".$id."</strong>";
mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('Brequest', '$note', '$cid', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());
}
else
{
$note = "Client conversion requested by <strong>".$loggedname."</strong><br/>Purchase initiated of <strong>".$pstr."</strong> for <strong>Rs.".$gt."/-</strong> with PurchaseId <strong>CLT".$id."</strong> AND Inovice Number <strong>INV".$id."</strong>";
mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('Crequest', '$note', '$cid', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());
}

include("../invoice/readInvoice.php");
$html = str_ireplace("'","",$html);

mysql_query("UPDATE `invoice` SET `html` = '$html' WHERE `id` = '$id'",$con) or die(mysql_error());
echo $id;
ob_flush();
?>