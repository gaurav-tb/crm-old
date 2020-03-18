<?php
include("../include/conFig.php");

$valto = $_POST['valto'];
$invid = $_GET['invid'];
$cid = $_GET['cid'];

$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}

$getTid = mysql_query("SELECT `transactionalid` FROM `invoice` WHERE `id` = '$invid'",$con) or die(mysql_error());
$rowTid = mysql_fetch_array($getTid);


    if($rowTid[0] != '') 
    {
    mysql_query("UPDATE `contact` SET `pending`='1' WHERE `id`='$cid'",$con) or die(mysql_error());
	    
	
	$note = "Client conversion requested is on pending by <strong>".$loggedname."</strong>";
   // echo "aaaaa".$post[0];
   //  if($_GET['update']){
   //      $noteId = $_GET['update'];
   
   //      echo "UPDATE `noteline` set `note` = '$post[0]',`cid`= '$cid',`createdate`= '$datetime',`updatedby`='$loggeduserid' where  id='$noteId'";
   //      mysql_query("UPDATE `noteline` set `note` = '$post[0]',`cid`= '$cid',`createdate`= '$datetime',`updatedby`='$loggeduserid' where  id='$noteId'",$con) or die(mysql_error());
    
    
   //  }else{
        mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('PendingRequest', '$post[0]', '$cid', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());
   // }

	
	
   // mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$cid','62','0','$datetime','0000:00:00')",$con) or die(mysql_error());
	

	/*  Start Sending of Data to website */
 
    
	$getLeadSource = mysql_query("SELECT `leadsource`,`mobile` FROM `contact` WHERE `id` = '$cid'",$con) or die(mysql_error());
    $rowLeadSource = mysql_fetch_array($getLeadSource);	
	
/*    if($rowLeadSource[0]==57)
	{
	*/	
		
    $params = Array();
    $params['mobile'] = $rowLeadSource[1];
    $params['type'] = "Pending";
    $params['notes'] = $note;

    $ch=curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));	
    curl_setopt($ch,CURLOPT_URL,"http://www.bellseye.com/fetchClientStatus.php");
    curl_setopt($ch,CURLOPT_POST,"1");
    curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $output=curl_exec($ch);
    curl_close($ch);
/*	}  */
   

   /*  End Sending of Data to website */
	
	}
?>
