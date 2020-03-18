<?
//---------start Reduced brokerage utilise code------------------------------
$BrokeragePremium =0;$RevenueGeneration=0;

echo "SELECT `reduced_brokerage`.StartDate,`reduced_brokerage`.activationAmount,`reduced_brokerage`.cid FROM `reduced_brokerage` join `contact` on contact.id = reduced_brokerage.cid  WHERE  `contact`.`code`='$clientcode[$key]'";
$getReducedBExist = mysql_query("SELECT `reduced_brokerage`.StartDate,`reduced_brokerage`.activationAmount,`reduced_brokerage`.cid FROM `reduced_brokerage` join `contact` on contact.id = reduced_brokerage.cid  WHERE  `contact`.`code`='$clientcode[$key]' order by reduced_brokerage.id desc limit 1",$con);
$getRecord = mysql_fetch_array($getReducedBExist);
$startDate = $getRecord['StartDate'];
$openingBalance = $getRecord['activationAmount'];
echo "openingBalance ".$openingBalance;
//echo $previousDate = date('Y-m-d', strtotime($thisdate .' -1 day'));
echo "SELECT * FROM `expensereport` WHERE `expensereport`.`UploadingDate`='$thisdate' and `expensereport`.`Clientid`='$clientcode[$key]'";
	$getExist=mysql_query("SELECT * FROM `expensereport` WHERE `expensereport`.`UploadingDate`='$thisdate' and `expensereport`.`Clientid`='$clientcode[$key]'",$con);	
	$row = mysql_fetch_array($getExist);
	$BrokeragePremium = $row['BrokeragePremium'];
	$RevenueGeneration = $row['RevenueGeneration'];
	echo $grossAmount = $BrokeragePremium + $RevenueGeneration;
echo $startDate."<=".$thisdate."&&".$openingBalance .">=".$grossAmount;
	if(($startDate <= $thisdate) && ($openingBalance >= $grossAmount)){

		$utilise = $grossAmount;
			echo "utilise1 ".$utilise;
	}else if($startDate > $thisdate ){
		$utilise = 0;
		echo "utilise2 ".$utilise;
	}else if($startDate < $thisdate){
		$utilise = $openingBalance;
		echo "utilise3 ".$utilise;
	}
	
	echo $closingBalance = ($openingBalance - $utilise) + $purchaseAmount;
	//$PurchaseAmount = $openingBalance;


$getPrevious=mysql_query("SELECT * FROM `expensereport` WHERE `UploadingDate`<'$thisdate' and `Clientid` = '$clientcode[$key]' order by `UploadingDate` desc limit 1",$con);
	if(mysql_num_rows($getPrevious) > 0){
	$getdata1=mysql_query("SELECT * FROM `reducedbrokerageutilise` WHERE  `client` = '$clientcode[$key]' order by `id` desc limit 1",$con);
			if(mysql_num_rows($getdata1) > 0){
				$openingCharge = $openingBalance - $utilise;
			}else{
				$openingCharge = $openingBalance;
			}
		//$openingBalance = $purchaseAmount;
		
	}else{
		$openingCharge = 0;
	}
	
if(mysql_num_rows($getReducedBExist)>0){
	

	echo "SELECT * FROM `reducedbrokerageutilise` WHERE `reducedbrokerageutilise`.`date`='$thisdate' and `reducedbrokerageutilise`.`client`='$clientcode[$key]'";
	

	$getRecordExist=mysql_query("SELECT * FROM `reducedbrokerageutilise` WHERE `reducedbrokerageutilise`.`date`='$thisdate' and `reducedbrokerageutilise`.`client`='$clientcode[$key]'",$con);	
	if(mysql_num_rows($getRecordExist) > 0)
	{
		
		echo "UPDATE `reducedbrokerageutilise` SET `date`='$thisdate',`grossAmount`='$grossAmount',`utilise`='$utilise',`openingBalance`='$openingBalance',`closingBalance`='$closingBalance' WHERE `date`='$thisdate' and `client`='$clientcode[$key]'";
	mysql_query("UPDATE `reducedbrokerageutilise` SET `date`='$thisdate',`grossAmount`='$grossAmount',`utilise`='$utilise',`openingBalance`='$openingCharge',`closingBalance`='$closingBalance' WHERE `date`='$thisdate' and `client`='$clientcode[$key]'") or die(mysql_error());

	}	
	else
	{
		echo "INSERT INTO `reducedbrokerageutilise`(`id`,`date`,`client`,`grossAmount`,`utilise`,`openingBalance`,`closingBalance`,`PurchaseAmount`) VALUES ('','$thisdate','$clientcode[$key]','','','','','')";
	mysql_query("INSERT INTO `reducedbrokerageutilise`(`id`,`date`,`client`,`grossAmount`,`utilise`,`openingBalance`,`closingBalance`,`PurchaseAmount`) VALUES ('','$thisdate','$clientcode[$key]','$utilise','$grossAmount','$openingCharge','$closingBalance','$openingBalance')") or die(mysql_error());

		
	//$result=mysql_query("INSERT INTO `expensereport`(`id`,`Clientid`,`RevenueGeneration`,`Turnover`,`RevenueForOwner`,`BrokeragePremium`,`UploadingDate`) VALUES('','$clientcode[$key]','$Revenue[$key]','$turnover[$key]','1','$BrokeragePremium[$key]','$thisdate')",$con) or die(mysql_error());



	}
}



//----------End Reduced brokerage utilise code-------------------------------------------------------------------------