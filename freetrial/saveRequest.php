<?php
include("../include/conFig.php");


$product = $_POST['productid'];
$from= $_POST['from'];
$to= $_POST['to'];
$cid= $_POST['cid'];
$mobile= $_POST['mobile'];
$p = explode(",",$product);
$f = explode(",",$from);
$t = explode(",",$to);
$sms = $_POST['sms'];
$call= $_POST['call'];
$messenger = $_POST['messenger'];
$chkEntry = mysql_query("SELECT `id` FROM `servicecall` WHERE `cid` = '$cid' AND `delete` = '0'",$con) or die(mysql_error());
$rowEntry = mysql_num_rows($chkEntry);

$k = 0;
foreach($p as $val)
{
	if($val != '0')
	{
		$tlf = $f[$k];
		$tlt = $t[$k];
		if($rowEntry == 0)
		{
		mysql_query("INSERT INTO `servicecall`(`cid`, `mobile`, `product`, `quantity`, `fromdate`, `todate`, `subtotal`, `transactionalid`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`,`type`,`approved`,`sms`,`call`,`messenger`) VALUES ('$cid','$mobile','$val','','$tlf','$tlt','','','','$datetime','$datetime','$loggeduserid','0','f','0','$sms','$call','$messenger')",$con) or die(mysql_error());
		}
		else
		{
		mysql_query("INSERT INTO `servicecall`(`cid`, `mobile`, `product`, `quantity`, `fromdate`, `todate`, `subtotal`, `transactionalid`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`,`type`,`approved`,`sms`,`call`,`messenger`,`repeat`) VALUES ('$cid','$mobile','$val','','$tlf','$tlt','','','','$datetime','$datetime','$loggeduserid','0','f','0','$sms','$call','$messenger','1')",$con) or die(mysql_error());
		}
		$requestid .= "FRT".mysql_insert_id().", ";
	}
	$k++;

}

foreach($p as $val)
{
$getP = mysql_query("SELECT category.name FROM category,product WHERE product.category = category.id AND product.id = '$val'",$con) or die(mysql_error());
$rowP = mysql_fetch_array($getP);
$pstr .= $rowP[0].", ";
}

$note = "Freetrial requested by <strong>".$loggedname."</strong><br/>Request initiated of <strong>".$pstr."</strong>. RequestIds:- <strong>".$requestid."</strong>";
mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('Frequest', '$note', '$cid', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());
ob_flush();
echo $cid;
?>