<?php  
include("../../include/conFig.php");

if($_FILES[csv][size] > 0) 
{ 
$file = $_FILES[csv][tmp_name]; 
 $handle = fopen($file,"r"); 
     
 do 
 { 

$str =    addslashes($data[0])."--".addslashes($data[1])."--".addslashes($data[2])."--".addslashes($data[3]);
		
$clientcode[] .= trim(addslashes($data[0]));
$turnover[] .= trim(addslashes($data[1]));
$BrokeragePremium[] .= trim(addslashes($data[2]));
$Revenue[] .= trim(addslashes($data[3]));


}
while ($data = fgetcsv($handle,1000,",","'")); 
     
$thisdate = $_POST['date'];
$UpdateSpotlight = $_POST['spotlight'];


	
foreach($clientcode as $key => $val)
{
if($clientcode[$key]!='')	
{
// 	$getTradedDate=mysql_query("SELECT  `UploadingDate` ,  `Clientid` ,  `BrokeragePremium` ,  `RevenueGeneration` FROM  `expensereport`  where `Clientid`='$clientcode[$key]' and `UploadingDate` <= '$thisdate' GROUP BY  `Clientid` ORDER BY  `id`",$con);
// 	$tradeDate=mysql_fetch_array($getTradedDate);
// 	if(mysql_num_rows($getTradedDate)>0)
// 	{
		
// 		$FirstTradeDate = $tradeDate['UploadingDate'];
// 	}
// 	else
// 	{
// 		$FirstTradeDate = $thisdate;
// 	}

// //echo "firstTradeDate ".$FirstTradeDate;
// //echo "SELECT firstTradeDate FROM  `contact`  where `code`='$clientcode[$key]'";
// $contactTradeDate = mysql_query("SELECT firstTradeDate FROM  `contact`  where `code`='$clientcode[$key]'",$con);
// //echo mysql_num_rows($contactTradeDate);
// $traddate=mysql_fetch_array($contactTradeDate);	
// $firstTD = $traddate['firstTradeDate'];

// if($firstTD == '0000-00-00' || $firstTD ==''){
// //	echo "UPDATE  `contact` SET FirstTradeDate='$FirstTradeDate' where `code`='$clientcode[$key]'";
// $getTradedDate=mysql_query("UPDATE  `contact` SET firstTradeDate='$FirstTradeDate' where `code`='$clientcode[$key]'",$con);
// }else{

// }

// if(mysql_num_rows($contactTradeDate) > 0 && ($firstTD !='0000-00-00' || $firstTD !='')){

// }else{
// 	echo "UPDATE  `contact` SET FirstTradeDate='$FirstTradeDate' where `code`='$clientcode[$key]'";
// //$getTradedDate=mysql_query("UPDATE  `contact` SET firstTradeDate='$FirstTradeDate' where `code`='$clientcode[$key]'",$con);
// }

$getRMOwnerid=mysql_query("SELECT `customersupport`.`RMOwnerid` FROM `customersupport` WHERE `customersupport`.`tradingbellsid`='$clientcode[$key]'",$con);
$rowRmownerid=mysql_fetch_array($getRMOwnerid);	
	
$getExist=mysql_query("SELECT * FROM `expensereport` WHERE `expensereport`.`UploadingDate`='$thisdate' and `expensereport`.`Clientid`='$clientcode[$key]'",$con);	
if(mysql_num_rows($getExist) > 0)
{
// $getData=mysql_query("SELECT `noteline`.`createdate`,max(`noteline`.`id`) FROM `contact` INNER JOIN `noteline` ON `contact`.`id`=`noteline`.`cid` WHERE `contact`.`code`='$clientcode[$key]' AND `noteline`.`subject`='Oship' AND `noteline`.`RandomAssignments`='1'",$con) or die(mysql_error());


// $row=mysql_fetch_array($getData);

// $UploadDay=strtotime($row[0]);
// $currDay=strtotime($row[0]);
// $prev1Mon=strtotime($thisdate)-2592000;
// $prev2Mon=strtotime($thisdate)-5184000;
// $prev3Mon=strtotime($thisdate)-7776000;

// if($prev1Mon<=$UploadDay && $UploadDay >= $currDay )
// {
// $target='0.25';	
// }

// else if($prev2Mon<=$UploadDay && $UploadDay <=$prev1Mon)
// {
// $target='0.50';
// }

// else if($prev3Mon<=$UploadDay && $UploadDay < $prev2Mon)
// {
// $target='0.75';	
// }
// else
// {
// $target='1.00';	
// }

mysql_query("UPDATE `revenuermreport` SET `Turnover`='$turnover[$key]',`PremiumBrokerage`='$BrokeragePremium[$key]',`DiscountBrokerage`='$Revenue[$key]',`RMOwner`='$rowRmownerid[0]' WHERE `revenuermreport`.`code`='$clientcode[$key]' and `revenuermreport`.`uploadingDate`='$thisdate'") or die(mysql_error());


$result=mysql_query("UPDATE `expensereport` SET `RevenueGeneration`='$Revenue[$key]',`Turnover`='$turnover[$key]',`RevenueForOwner`='1',`BrokeragePremium`='$BrokeragePremium[$key]' WHERE `expensereport`.`Clientid`='$clientcode[$key]' and `expensereport`.`UploadingDate`='$thisdate'") or die(mysql_error());
}	
else
{
$getData=mysql_query("SELECT `noteline`.`createdate`,max(`noteline`.`id`) FROM `contact` INNER JOIN `noteline` ON `contact`.`id`=`noteline`.`cid` WHERE `contact`.`code`='$clientcode[$key]' AND `noteline`.`subject`='Oship' AND `noteline`.`RandomAssignments`='1'",$con) or die(mysql_error());

if(mysql_num_rows($getData) >0)
{
$row=mysql_fetch_array($getData);

$UploadDay=strtotime($row[0]);
$currDay=strtotime($row[0]);
$prev1Mon=strtotime($thisdate)-2592000;
$prev2Mon=strtotime($thisdate)-5184000;
$prev3Mon=strtotime($thisdate)-7776000;

if($prev1Mon<=$UploadDay && $UploadDay >= $currDay )
{
$target='0.25';	
}

else if($prev2Mon<=$UploadDay && $UploadDay <=$prev1Mon)
{
$target='0.50';
}

else if($prev3Mon<=$UploadDay && $UploadDay < $prev2Mon)
{
$target='0.75';	
}
else
{
$target='1.00';	
}
}

else if(mysql_num_rows($getData) ==0)
{
$target='1.00';	
}

mysql_query("INSERT INTO `revenuermreport`(`id`,`code`,`Turnover`,`PremiumBrokerage`,`DiscountBrokerage`,`RMOwner`,`uploadingDate`) VALUES ('','$clientcode[$key]','$turnover[$key]','$BrokeragePremium[$key]','$Revenue[$key]','$rowRmownerid[0]','$thisdate')") or die(mysql_error());

	
$result=mysql_query("INSERT INTO `expensereport`(`id`,`Clientid`,`RevenueGeneration`,`Turnover`,`RevenueForOwner`,`BrokeragePremium`,`UploadingDate`) VALUES('','$clientcode[$key]','$Revenue[$key]','$turnover[$key]','1','$BrokeragePremium[$key]','$thisdate')",$con) or die(mysql_error());



}


// //---------start Reduced brokerage utilise code------------------------------
// //$BrokeragePremium =0;$RevenueGeneration=0;
// //SELECT `reduced_brokerage`.StartDate,`reduced_brokerage`.EndDate,reduced_brokerage`.activationAmount,`reduced_brokerage`.cid FROM `reduced_brokerage` join `contact` on contact.id = reduced_brokerage.cid  WHERE  `contact`.`code`='$clientcode[$key]' order by reduced_brokerage.id desc limit 
// //echo "SELECT `reduced_brokerage`.StartDate,`reduced_brokerage`.EndDate,`reduced_brokerage`.activationAmount,`reduced_brokerage`.cid FROM `reduced_brokerage` join `contact` on contact.id = reduced_brokerage.cid  WHERE  `contact`.`code`='$clientcode[$key]' order by reduced_brokerage.id desc limit 1";
// $getReducedBExist = mysql_query("SELECT `reduced_brokerage`.StartDate,`reduced_brokerage`.EndDate,`reduced_brokerage`.activationAmount,`reduced_brokerage`.cid FROM `reduced_brokerage` join `contact` on contact.id = reduced_brokerage.cid  WHERE  `contact`.`code`='$clientcode[$key]' order by reduced_brokerage.id asc limit 1",$con) or die(mysql_error($con));
// $getRecord = mysql_fetch_array($getReducedBExist);
// //print_r($getRecord);
// $startDate = $getRecord['StartDate'];
// $EndDate = $getRecord['EndDate'];
// //$openingBalance = $getRecord['activationAmount'];
// //echo "openingBalance ".$openingBalance;
// //echo $previousDate = date('Y-m-d', strtotime($thisdate .' -1 day'));
// //echo "SELECT * FROM `expensereport` WHERE `expensereport`.`UploadingDate`='$thisdate' and `expensereport`.`Clientid`='$clientcode[$key]'";
// $getExist1=mysql_query("SELECT * FROM `expensereport` WHERE `expensereport`.`UploadingDate`='$thisdate' and `expensereport`.`Clientid`='$clientcode[$key]'",$con);	
// 	$row = mysql_fetch_array($getExist1);
// 	$BrokeragePremium1 = $row['BrokeragePremium'];
// 	$RevenueGeneration1 = $row['RevenueGeneration'];
// 	$grossAmount = $BrokeragePremium1 + $RevenueGeneration1;
// //echo $startDate."<=".$thisdate."&&".$openingBalance .">=".$grossAmount;


// 	$getdata1=mysql_query("SELECT * FROM `reducedbrokerageutilise` join `contact` on contact.code = reducedbrokerageutilise.client  WHERE  `contact`.`code`='$clientcode[$key]' AND reducedbrokerageutilise.date < '$thisdate' order by reducedbrokerageutilise.id desc limit 1",$con);
// 	if(mysql_num_rows($getdata1) > 0)
// 	{
// 	$clb=mysql_fetch_array($getdata1);
// 		$purchaseAmount = $clb['PurchaseAmount'];
// 		$closing = $clb['closingBalance'];
// 		$openingCharge = $closing;
// 	}
// 	else
// 	{
// 		$purchaseAmount = 0;
// 		$openingCharge = 0;
// 	}

// 	if(($startDate <= $thisdate) && ($openingCharge >= $grossAmount))
// 	{
//   	$utilise = $grossAmount;
// 			//echo "utilise1 ".$utilise;
// 	}
// 	else if($startDate > $thisdate )
// 	{
// 		$utilise = 0;
// 		//echo "utilise2 ".$utilise;
// 	}
// 	else if(($startDate <= $thisdate) && ($openingCharge < $grossAmount))
// 	{
// 		$utilise = $openingCharge;
// 		//echo "utilise3 ".$utilise;
// 	}
// 	$purchaseAmount = 0;

// 	//echo $closingBalance = ($openingBalance - $utilise) + $purchaseAmount;
// 	//$PurchaseAmount = $openingBalance;


// // $getPrevious=mysql_query("SELECT * FROM `expensereport` WHERE `UploadingDate`<'$thisdate' and `Clientid` = '$clientcode[$key]' order by `UploadingDate` desc limit 1",$con);
// // 	if(mysql_num_rows($getPrevious) > 0){
// 	//echo "SELECT SUM(`expensereport`.`BrokeragePremium` ) + SUM(  `expensereport`.`RevenueGeneration` ) as openingAmount FROM  `expensereport` INNER JOIN  `contact` ON contact.code = expensereport.`Clientid` INNER JOIN  `reduced_brokerage` ON reduced_brokerage.cid = contact.id WHERE  `expensereport`.`Clientid` =  '$clientcode[$key]' AND  `expensereport`.`UploadingDate` BETWEEN  '$startDate' AND  '$EndDate'";
// 	//$getdata1=mysql_query("SELECT SUM(`expensereport`.`BrokeragePremium` ) + SUM(  `expensereport`.`RevenueGeneration` ) as openingAmount FROM  `expensereport` INNER JOIN  `contact` ON contact.code = expensereport.`Clientid` INNER JOIN  `reduced_brokerage` ON reduced_brokerage.cid = contact.id WHERE  `expensereport`.`Clientid` =  '$clientcode[$key]' AND  `expensereport`.`UploadingDate` BETWEEN  '$startDate' AND  '$EndDate'",$con);

	
//     $closingBalance = ($openingCharge - $utilise) + $purchaseAmount;
// 	// $opb=mysql_fetch_array($getdata1);
// 	// $opening = $opb['openingAmount'];

// 	// if(mysql_num_rows($getdata1) > 0){
// 	// 	$openingCharge = $openingBalance - $opening;
// 	// }else{
// 	// 		$openingCharge = $openingBalance;
// 	// }
// 	// if($openingCharge < 0){
// 	// 	$openingCharge = 0;
// 	// 	//$openingBalance = $purchaseAmount;
// 	// }
		
// 	// }else{
// 	// 	$openingCharge = 0;
// 	// }
// 	//echo "openingBalance ".$openingCharge;
	
// //echo mysql_num_rows($getReducedBExist);
//     if(mysql_num_rows($getReducedBExist) > 0)
//     {
// 	//echo "SELECT * FROM `reducedbrokerageutilise` WHERE `reducedbrokerageutilise`.`date`='$thisdate' and `reducedbrokerageutilise`.`client`='$clientcode[$key]'";
	

// 	$getRecordExist=mysql_query("SELECT * FROM `reducedbrokerageutilise` WHERE `reducedbrokerageutilise`.`date`='$thisdate' and `reducedbrokerageutilise`.`client`='$clientcode[$key]'",$con);	
// 	if(mysql_num_rows($getRecordExist) > 0)
// 	{
		
// 		//echo "UPDATE `reducedbrokerageutilise` SET `date`='$thisdate',`grossAmount`='$grossAmount',`utilise`='$utilise',`openingBalance`='$openingBalance',`closingBalance`='$closingBalance' WHERE `date`='$thisdate' and `client`='$clientcode[$key]'";
// 	mysql_query("UPDATE `reducedbrokerageutilise` SET `date`='$thisdate',`grossAmount`='$grossAmount',`utilise`='$utilise',`openingBalance`='$openingCharge',`closingBalance`='$closingBalance' WHERE `date`='$thisdate' and `client`='$clientcode[$key]'") or die(mysql_error());

// 	}	
// 	else
// 	{
// 		//echo "INSERT INTO `reducedbrokerageutilise`(`id`,`date`,`client`,`grossAmount`,`utilise`,`openingBalance`,`closingBalance`,`PurchaseAmount`) VALUES ('','$thisdate','$clientcode[$key]','','','','','')";
// 	mysql_query("INSERT INTO `reducedbrokerageutilise`(`id`,`date`,`client`,`grossAmount`,`utilise`,`openingBalance`,`closingBalance`,`PurchaseAmount`) VALUES ('','$thisdate','$clientcode[$key]','$utilise','$grossAmount','$openingCharge','$closingBalance','$purchaseAmount')") or die(mysql_error());

		
// 	//$result=mysql_query("INSERT INTO `expensereport`(`id`,`Clientid`,`RevenueGeneration`,`Turnover`,`RevenueForOwner`,`BrokeragePremium`,`UploadingDate`) VALUES('','$clientcode[$key]','$Revenue[$key]','$turnover[$key]','1','$BrokeragePremium[$key]','$thisdate')",$con) or die(mysql_error());



// 	}
// }



//----------End Reduced brokerage utilise code-------------------------------------------------------------------------



$getTradedDate=mysql_query("SELECT * FROM `LastTradedDate` WHERE `LastTradedDate`.`code`='$clientcode[$key]'",$con) or die(mysql_error());

if(mysql_num_rows($getTradedDate)==0)
{
		mysql_query("INSERT INTO `LastTradedDate`(`id`,`code`,`LastTradeOccured`) VALUES('','$clientcode[$key]','$thisdate')",$con) or die(mysql_error());
}
else 
{
		mysql_query("UPDATE `LastTradedDate` SET `LastTradedDate`.`LastTradeOccured`='$thisdate' WHERE `LastTradedDate`.`code`='$clientcode[$key]'",$con) or die(mysql_error());
}


if($UpdateSpotlight ==1)
{
	
$getTeamId=mysql_query("SELECT `customersupport`.`RMOwnerid`,`contact`.`%brokerage` from customersupport inner join contact on customersupport.Clientid=contact.id where contact.code='$clientcode[$key]'",$con) or die(mysql_error());


$TotalRevenue=$BrokeragePremium[$key]+$Revenue[$key];


if(mysql_num_rows($getTeamId) > 0)
{
	
$rowTeamId=mysql_fetch_array($getTeamId);	

$PerBrokerage=$rowTeamId[1];

$TotalRevenueWithIntroducer=($TotalRevenue-($TotalRevenue*($PerBrokerage/100)));

$getDuplicateRM=mysql_query("SELECT * FROM `spotlight` WHERE `spotlight`.`teamRMMateid`='$rowTeamId[0]' AND `spotlight`.`delete`='0'",$con) or die(mysql_error());
if(mysql_num_rows($getDuplicateRM) > 0)	
{
		mysql_query("UPDATE `spotlight` SET `BrokerageRevenue`=`BrokerageRevenue`+'$TotalRevenueWithIntroducer' WHERE `spotlight`.`teamRMMateid`='$rowTeamId[0]' AND `spotlight`.`delete`='0'",$con) or die(mysql_error());
}
else 
{
		mysql_query("INSERT INTO `spotlight` (`id`,`teamid`,`BrokerageRevenue`,`profile`,`teamRMMateid`,`TargetRangeFrom`,`TargetRangeTo`) VALUES ('','','$TotalRevenueWithIntroducer','','$rowTeamId[0]','$rowMon[0]','$rowMon[1]')",$con) or die(mysql_error());
}


$getDuplicateRMweek=mysql_query("SELECT * FROM `spotlightweek` WHERE `spotlightweek`.`teamRMMateid`='$rowTeamId[0]' AND `spotlightweek`.`delete`='0'",$con) or die(mysql_error());
if(mysql_num_rows($getDuplicateRMweek) > 0)	
{
		mysql_query("UPDATE `spotlightweek` SET `BrokerageRevenue`=`BrokerageRevenue`+'$TotalRevenueWithIntroducer' WHERE `spotlightweek`.`teamRMMateid`='$rowTeamId[0]' AND `spotlightweek`.`delete`='0'",$con) or die(mysql_error());
}
else 
{
		mysql_query("INSERT INTO `spotlightweek` (`id`,`teamid`,`BrokerageRevenue`,`profile`,`teamRMMateid`,`TargetRangeFrom`,`TargetRangeTo`) VALUES ('','','$TotalRevenueWithIntroducer','','$rowTeamId[0]','$initial','$final')",$con) or die(mysql_error());

}

}  
	
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



