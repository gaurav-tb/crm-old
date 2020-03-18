    <?php
    include("../include/conFig.php");
    $valto = $_POST['valto'];
    $id = $_GET['id'];

    
	
	$valto = explode("*$*$*",$valto);
	foreach($valto as $val)
	{
	$val = str_ireplace("'","\'",$val);
	$post[] .= $val;
	}
	
	$getData=mysql_query("SELECT * FROM `activatepremium` WHERE `cid`='$id' AND `activatepremium`.`Plan`='2'",$con) or die(mysql_error());
	
	if(mysql_num_rows($getData)>0)
	{
	$note = "Premium Plan Activated On ".$datetime." By ".$loggedname;	
	}
	else
	{
	$note = "Regular Discount Brokerage Activated On ".$datetime." By ".$loggedname;		
	}
	
	
	
	mysql_query("UPDATE `activatepremium` SET `EmailReplied`='$post[0]',`EmailRepliedDate`='$post[1]',`Comment`='$post[2]',`activatepremium`.`Approval`='1',`ApprovedDate`='$datetime' WHERE `activatepremium`.`cid`='$id'",$con) or die(mysql_error());
	
	
	
	mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('PremiumRequest', '$note', '$id', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());

//	mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$id','64','0','$datetime','0000:00:00')",$con) or die(mysql_error());

	
	
    ?>
