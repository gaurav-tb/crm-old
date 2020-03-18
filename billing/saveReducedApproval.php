    <?php
    include("../include/conFig.php");
    $valto = $_POST['valto'];
    $id = $_GET['id'];
	$researchid = $_GET['researchid'];
	

    
	
	$valto = explode("*$*$*",$valto);
	foreach($valto as $val)
	{
	$val = str_ireplace("'","\'",$val);
	$post[] .= $val;
	}
	
	if($post[4]==3)
	{
	$approved='1';	
	$dateApproval='000-00-00';
	$Requestpproval='0';
	$fundClearDate='';
	$fundDebitedDate=$post[3];
	$fundDebited='0';
	}
	else
	{
	$approved='2';
    $dateApproval=$date;	
	$Requestpproval='1';
	$fundClearDate=$post[5];
	$fundDebitedDate=$post[3];
	$fundDebited=$post[2];
    }
	

	mysql_query("UPDATE `reduced_brokerage` SET `EmailReplied`='$post[0]',`EmailRepliedDate`='$post[1]',`FundDebited`='$fundDebited',`FundDebitedDate`='$fundDebitedDate',`FundAvailable`='$post[4]',`Comments`='$post[6]',`Approved`='$approved',`ApprovalDate`='$dateApproval',`ActivationRequest`='$Requestpproval',`FundClearDate`='$fundClearDate' WHERE `reduced_brokerage`.`cid`='$id' AND `reduced_brokerage`.`id`='$researchid'",$con) or die(mysql_error());
	
	
	
	$note = "Reduced Brokerage Plan Activated By ".$loggedname;
	
	mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('Brequest', '$note', '$id', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());

	if($approved==2)
	{
	//mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$id','64','0','$datetime','0000:00:00')",$con) or die(mysql_error());

    $getActivationAmount=mysql_query("SELECT `reduced_brokerage`.`ActivationAmount` FROM `reduced_brokerage` WHERE cid='$id' AND `reduced_brokerage`.`ApprovalDate`='$dateApproval' AND `reduced_brokerage`.`Approved`='2'",$con) or die(mysql_error());
	
	$rowActivationAmt=mysql_fetch_array($getActivationAmount);
		$purchaseAmt = $rowActivationAmt['ActivationAmount'];

	$checkPurchaseAmount=mysql_query("SELECT * FROM `reducedbrokerageutilise` join `contact` on contact.id = reducedbrokerageutilise.cid WHERE contact.id='$id' AND `date` ='$dateApproval'",$con) or die(mysql_error());
	$getPurchaseAmount = mysql_fetch_array($checkPurchaseAmount);
	$code=$getPurchaseAmount['code'];
	if(mysql_num_rows($checkPurchaseAmount) > 0){
			
			mysql_query("update reducedbrokerageutilise set PurchaseAmount='$purchaseAmt' WHERE client='$code' and date='$dateApproval' ",$con) or die(mysql_error());
	}else{
			mysql_query("INSERT INTO `reducedbrokerageutilise`(`id`,`date`,`client`,`grossAmount`,`utilise`,`openingBalance`,`closingBalance`,`PurchaseAmount`) VALUES ('','$dateApproval','$code','0','0','0','0','$purchaseAmount')",$con) or die(mysql_error());
	}
	



	
	

	$getTeamId=mysql_query("SELECT `teamamtes`.`teamid`,`customersupport`.`RMOwnerid` FROM `teamamtes` INNER JOIN `customersupport` ON `teamamtes`.`mateid`=`customersupport`.`RMOwnerid` INNER JOIN `team` ON `teamamtes`.`teamid`=`team`.`id` WHERE `customersupport`.`clientid`='$id' AND `team`.`delete`='0'",$con) or die(mysql_error());
	
	if(mysql_num_rows($getTeamId)>0)
	{
	$rowTeamId=mysql_fetch_array($getTeamId);	
		
	//Updation of Spotlight with every monday new feed of data
	
	$getNewWeek=mysql_query("SELECT * FROM `spotlightweek` WHERE `spotlightweek`.`teamRMMateid`='$rowTeamId[1]' AND `spotlightweek`.`delete`='0'",$con) or die(mysql_error());
	
	if(mysql_num_rows($getNewWeek)==0)
    {
     mysql_query("INSERT INTO `spotlightweek` (`id`,`teamid`,`BoosterAmount`,`profile`,`teamRMMateid`,`TargetRangeFrom`,`TargetRangeTo`) VALUES ('','$rowTeamId[0]','$rowActivationAmt[0]','','$rowTeamId[1]','$intial','$final')",$con) or die(mysql_error());
	}
    else 
	{
	mysql_query("UPDATE `spotlightweek` SET `BoosterAmount`=`BoosterAmount`+'$rowActivationAmt[0]' WHERE `spotlightweek`.`teamRMMateid`='$rowTeamId[1]' AND `spotlightweek`.`delete`='0'",$con) or die(mysql_error());
	}
	
	
	
	$getDuplicateRM=mysql_query("SELECT * FROM `spotlight` WHERE `spotlight`.`teamRMMateid`='$rowTeamId[1]' AND `spotlight`.`delete`='0'",$con) or die(mysql_error());
    if(mysql_num_rows($getDuplicateRM)==0)	
    {
    mysql_query("INSERT INTO `spotlight` (`id`,`teamid`,`BoosterAmount`,`profile`,`teamRMMateid`,`TargetRangeFrom`,`TargetRangeTo`) VALUES ('','$rowTeamId[0]','$rowActivationAmt[0]','','$rowTeamId[1]','$rowMon[0]','$rowMon[1]')",$con) or die(mysql_error());
    }
    else 
    { 
    mysql_query("UPDATE `spotlight` SET `BoosterAmount`=`BoosterAmount`+'$rowActivationAmt[0]' WHERE `spotlight`.`teamRMMateid`='$rowTeamId[1]' AND `spotlight`.`delete`='0'",$con) or die(mysql_error());
    }
	
	}
	}
	

	
	
    ?>
