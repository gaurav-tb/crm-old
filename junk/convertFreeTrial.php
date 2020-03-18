<?php
include("../include/conFig.php");


$product = $_GET['productid'];
$from= $_GET['from'];
$to= $_GET['to'];
$cid= $_GET['cid'];
$mobile= $_GET['mobile'];
$p = explode(",",$product);
$f = explode(",",$from);
$t = explode(",",$to);
$k = 0;
foreach($p as $val)
{
	if($val != '0')
	{
		$tlf = $f[$k];
		$tlt = $t[$k];
		mysql_query("INSERT INTO `servicecall`(`cid`, `mobile`, `product`, `quantity`, `fromdate`, `todate`, `subtotal`, `transactionalid`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`,`type`,`approved`) VALUES ('$cid','$mobile','$val','','$tlf','$tlt','','','','$datetime','$datetime','$loggeduserid','0','f','0')",$con) or die(mysql_error());
		
	}
	$k++;

}

ob_flush();
?>