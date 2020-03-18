<?php  
include("../../include/conFig.php");

if($_FILES[csv][size] > 0) 
{ 
$file = $_FILES[csv][tmp_name]; 
 $handle = fopen($file,"r"); 
     
 do 
 { 

$str =    addslashes($data[0])."--".addslashes($data[1])."--".addslashes($data[2])."--".addslashes($data[3]);

$tradedate[] .= trim(addslashes(date('Y-m-d',strtotime($data[0]))));
$clientcode[] .= trim(addslashes($data[1]));
$turnover[] .= trim(addslashes($data[2]));
$BrokeragePremium[] .= trim(addslashes($data[3]));
$Revenue[] .= trim(addslashes($data[4]));


}
while ($data = fgetcsv($handle,1000,",","'")); 
     
$thisdate = date('Y-m-d');
$UpdateSpotlight = $_POST['spotlight'];


	
foreach($clientcode as $key => $val)
{
if($clientcode[$key]!='')	
{
$getRMOwnerid=mysql_query("SELECT `customersupport`.`RMOwnerid` FROM `customersupport` WHERE `customersupport`.`tradingbellsid`='$clientcode[$key]'",$con);
$rowRmownerid=mysql_fetch_array($getRMOwnerid);	
	
$getExist=mysql_query("SELECT * FROM `expensereport` WHERE `expensereport`.`UploadingDate`='$thisdate' and `expensereport`.`Clientid`='$clientcode[$key]'",$con);	

mysql_query("UPDATE customersupport set `first_trade_date`='$date',`first_trade`='1' where `first_trade`='0' and tradingbellsid='$clientcode[$key]'",$con) or die(mysql_error());

if(mysql_num_rows($getExist) > 0)
{
mysql_query("UPDATE `revenuermreport` SET `Turnover`='$turnover[$key]',`PremiumBrokerage`='$BrokeragePremium[$key]',`DiscountBrokerage`='$Revenue[$key]',`RMOwner`='$rowRmownerid[0]' WHERE `revenuermreport`.`code`='$clientcode[$key]' and `revenuermreport`.`uploadingDate`='$thisdate'") or die(mysql_error());


$result=mysql_query("UPDATE `expensereport` SET `TradeDate`='$tradedate',`RevenueGeneration`='$Revenue[$key]',`Turnover`='$turnover[$key]',`RevenueForOwner`='1',`BrokeragePremium`='$BrokeragePremium[$key]' WHERE `expensereport`.`Clientid`='$clientcode[$key]' and `expensereport`.`UploadingDate`='$thisdate'") or die(mysql_error());
}	
else
{

mysql_query("INSERT INTO `revenuermreport`(`id`,`code`,`Turnover`,`PremiumBrokerage`,`DiscountBrokerage`,`RMOwner`,`uploadingDate`) VALUES ('','$clientcode[$key]','$turnover[$key]','$BrokeragePremium[$key]','$Revenue[$key]','$rowRmownerid[0]','$thisdate')") or die(mysql_error());

	
$result=mysql_query("INSERT INTO `expensereport`(`id`,`Clientid`,`RevenueGeneration`,`Turnover`,`RevenueForOwner`,`BrokeragePremium`,`UploadingDate`,`TradeDate`) VALUES('','$clientcode[$key]','$Revenue[$key]','$turnover[$key]','1','$BrokeragePremium[$key]','$thisdate','$tradedate')",$con) or die(mysql_error());

}


$getTradedDate=mysql_query("SELECT * FROM `LastTradedDate` WHERE `LastTradedDate`.`code`='$clientcode[$key]'",$con) or die(mysql_error());

if(mysql_num_rows($getTradedDate)==0)
{
		mysql_query("INSERT INTO `LastTradedDate`(`id`,`code`,`LastTradeOccured`) VALUES('','$clientcode[$key]','$thisdate')",$con) or die(mysql_error());
}
else 
{
		mysql_query("UPDATE `LastTradedDate` SET `LastTradedDate`.`LastTradeOccured`='$thisdate' WHERE `LastTradedDate`.`code`='$clientcode[$key]'",$con) or die(mysql_error());
}

}	
}

if($result)
{ ?>
<script>
setTimeout("window.close()",0);	
</script>	
<?php 
}

}  

?>
<script type="text/javascript">
/* window.top.window.document.getElementById('uploadStats').style.display = 'none';
window.top.window.document.getElementById('bigMoodle').style.display = 'block';
window.top.window.document.getElementById('manipulatemoodleContent').style.display = 'block';
window.top.window.document.getElementById('viewmoodleContent').style.display = 'block';
window.top.window.document.getElementById('manipulatemoodleContent').innerHTML ="Data Successfully Uploaded";   */
</script> 	



