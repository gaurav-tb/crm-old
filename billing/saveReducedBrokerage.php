<?php
    include("../include/conFig.php");
    $trans = rand(100,10000);
    $trans = $trans.time();

    $valto = $_POST['valto'];
    $id = $_GET['id'];  
    $plan = $_GET['plan'];
    $bonusamount = $_GET['bonusamount'];
   
    
	
	$valto = explode("*$*$*",$valto);
	foreach($valto as $val)
	{
	$val = str_ireplace("'","\'",$val);
	$post[] .= $val;
	}
	
	//$segment=$post[2].",".$post[3].",".$post[4].",".$post[5];
 	
//    //$Strdate=str_replace("GMT+0530 (India Standard Time)","",$post[4]);
// echo "start date ".$post[4];
// echo "start date ".$post['startdate'];
    $Startdate=date('Y-m-d',strtotime($post[3]));
    $Enddate=date('Y-m-d',strtotime($post[4]));	
    	
// Time=strtotime($post[10])-strtotime($post[9]);
	
	$datetime = date("Y-m-d h:i:sa");
	
	if($Time < 2592000)
	{
	$servicePS="2";	
	}
	else 
	{
	$servicePS="1";	
	}
	
	
	$AmtWithGst=(round($post[1]/100)*18)+$post[1];
	
	
/*	$getData=mysql_query("SELECT * FROM `researchbooster` WHERE  `cid` ='$id' AND id = (SELECT MAX( id ) FROM  `researchbooster` WHERE cid ='$id')",$con) or die(mysql_error());
	if(mysql_num_rows($getData)>0)
	{
	mysql_query("UPDATE `researchbooster` SET `Telegraminstalled`='$post[8]',`TelegramMobile`='$post[7]',`Segments`='$segment',`Activationamt`='$post[6]',`ActivationRequest`='1',`StartDate`='$post[9]',`EndDate`='$Enddate',`RequestingDate`='$datetime',`FundClearDate`='$post[6]',`ResearchPlus`='$UpdateResearch',`service`='$servicePS',`AmountWithGst`='$AmtWithGst' WHERE `cid`='$id'",$con) or die(mysql_error());
	}
	else 
	{ }   */
	//echo "INSERT INTO `reduced_brokerage`(`id`,`cid`,`brokeragePlan`,`activationAmount`,`amountWithGst`,`validity`,`RequestingDate`,`StartDate`,`EndDate`) VALUES ('','$id','$plan','$post[1]','$AmtWithGst','$post[2]','$datetime','$Startdate','$post[5]'";
	
	mysql_query("INSERT INTO `reduced_brokerage`(`id`,`cid`,`brokeragePlan`,`activationAmount`,`amountWithGst`,`validity`,`RequestingDate`,`StartDate`,`EndDate`,`BonusAmount`) VALUES ('','$id','$plan','$post[1]','$AmtWithGst','$post[2]','$datetime','$Startdate','$Enddate','$bonusamount')",$con) or die(mysql_error());
	
	$note = "Requested For Reduced Brokerage Activation By ".$loggedname;
	
	mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('Brequest', '$note', '$id', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());

	// mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$id','64','0','$datetime','0000:00:00')",$con) or die(mysql_error());

	?>
