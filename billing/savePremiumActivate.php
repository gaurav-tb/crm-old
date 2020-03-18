    <?php
    include("../include/conFig.php");
    $trans = rand(100,10000);
    $trans = $trans.time();

    $valto = $_POST['valto'];
    $id = $_GET['id'];
	$plan = $_GET['plan'];
	$mail = $_GET['mail'];
	
	

   	$valto = explode("*$*$*",$valto);
	foreach($valto as $val)
	{
	$val = str_ireplace("'","\'",$val);
	$post[] .= $val;
	}
	
	$segmentAmount=$post[2].",".$post[3].",".$post[4].",".$post[5].",".$post[6].",".$post[7];
	
	
	
	
    if($mail==1)
	{
	$Emaildate=$datetime;	
	}
	else
	{
	$Emaildate='0000-00-00';	
	}
	
	
	
	mysql_query("UPDATE `activatepremium` SET `segmentAmt`='$segmentAmount',`Plan`='$plan',`EmailSend`='$mail',`EmailSendDate`='$Emaildate',`PremiumActivate`='$ActivatePlan',`PremiumActivationDate`='$post[8]',`activatepremium`.`Approval`='0' WHERE `cid`='$id'",$con) or die(mysql_error());

    $note = "Request Changed For".$msg." By ".$loggedname."on ".$datetime;
	
	mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('PremiumRequest', '$note', '$id', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());

	
	if($EmailSend==1)
	{
//	mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$id','64','0','$datetime','0000:00:00')",$con) or die(mysql_error());
	}
	

	?>
