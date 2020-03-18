    <?php
    include("../include/conFig.php");
    $trans = rand(100,10000);
    $trans = $trans.time();

    $valto = $_POST['valto'];
    $id = $_GET['id'];
    $UpdateResearch = $_GET['plan'];
    
	
	$valto = explode("*$*$*",$valto);
	foreach($valto as $val)
	{
	$val = str_ireplace("'","\'",$val);
	$post[] .= $val;
	}
	
	$segment=$post[2].",".$post[3].",".$post[4].",".$post[5];
	
	
	$Strdate=str_replace("GMT+0530 (India Standard Time)","",$post[10]);
	
	$Enddate=date('Y-m-d',strtotime($Strdate));
	
	
	
	
	
	
	
	
	$Time=strtotime($post[10])-strtotime($post[9]);
	
	
	
	if($post[12]=='FT')
	{
	$servicePS="2";	
	}
	else 
	{
	$servicePS="1";	
	}
	
	
	$AmtWithGst=(round($post[6]/100)*18)+$post[6];
	
	
/*	$getData=mysql_query("SELECT * FROM `researchbooster` WHERE  `cid` ='$id' AND id = (SELECT MAX( id ) FROM  `researchbooster` WHERE cid ='$id')",$con) or die(mysql_error());
	if(mysql_num_rows($getData)>0)
	{
	mysql_query("UPDATE `researchbooster` SET `Telegraminstalled`='$post[8]',`TelegramMobile`='$post[7]',`Segments`='$segment',`Activationamt`='$post[6]',`ActivationRequest`='1',`StartDate`='$post[9]',`EndDate`='$Enddate',`RequestingDate`='$datetime',`FundClearDate`='$post[11]',`ResearchPlus`='$UpdateResearch',`service`='$servicePS',`AmountWithGst`='$AmtWithGst' WHERE `cid`='$id'",$con) or die(mysql_error());
	}
	else 
	{ }   */
	mysql_query("INSERT INTO `researchbooster`(`id`,`cid`,`Telegraminstalled`,`TelegramMobile`,`Segments`,`Activationamt`,`AmountWithGst`,`ActivationRequest`,`StartDate`,`EndDate`,`RequestingDate`,`ResearchPlus`,`service`) VALUES ('','$id','$post[8]','$post[7]','$segment','$post[6]','$AmtWithGst','1','$post[9]','$Enddate','$datetime','$UpdateResearch','$servicePS')",$con) or die(mysql_error());
	
//confirmation Email for the clients

//	mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$id','64','0','$datetime','0000:00:00')",$con) or die(mysql_error());

	
	$note = "Requested For Research Activation By ".$loggedname;
	
	mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('Brequest', '$note', '$id', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());

	//mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$id','64','0','$datetime','0000:00:00')",$con) or die(mysql_error());

	?>
