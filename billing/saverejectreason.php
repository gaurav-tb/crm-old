<?php
include("../include/conFig.php");

$valto = $_POST['valto'];
$invid = $_GET['invid'];
$cid = $_GET['cid'];

$valto = explode("*$*$*",$valto);
foreach($valto as $val) {
	$val = str_ireplace("'","\'",$val);
	$post[] .= $val;
}

$getTid = mysql_query("SELECT `transactionalid` FROM `invoice` WHERE `id` = '$invid'",$con) or die(mysql_error());
$rowTid = mysql_fetch_array($getTid);


if($rowTid[0] != '') {
     
    $getDate = mysql_query("SELECT `conversionrequestdate` FROM `contact` WHERE `id` = '$cid'",$con) or die(mysql_error());
    $rowDate = mysql_fetch_array($getDate);	
	
	$time = new DateTime($rowDate[0]);
    $dateconversion = $time->format('Y-m-d');

    $note = "Client conversion requested cancle by <strong>".$loggedname."</strong> and Request rejection reason :".$post[0];
	mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`,`conversionrequestdate`, `updatedby`, `delete`) VALUES ('Canclerequest', '$note', '$cid', '', '$datetime','$dateconversion', '$loggeduserid', '0')",$con) or die(mysql_error());
	mysql_query("DELETE FROM `invoice` WHERE `id` = '$invid'",$con) or die(mysql_error());
	mysql_query("DELETE FROM `servicecall` WHERE `transactionalid` = '$rowTid[0]' AND `type` = 'c'",$con) or die(mysql_error());
	
	mysql_query("INSERT INTO `email_queue` (`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$cid','63','0','$datetime','0000:00:00')",$con) or die(mysql_error());
	

mysql_query("UPDATE `contact` SET `conversionrequestdate`='0000-00-00 00:00:00',`pending`='0',`accountopeningreffno`='' WHERE `id`='$cid'",$con) or die(mysql_error());
	
// mysql_query("UPDATE `contact` SET `conversionrequestdate`='0000-00-00 00:00:00',`pending`='0',`code`='',converted='0' WHERE `id`='$cid'",$con) or die(mysql_error());
/*	$msg = "Dear ".$row[0].",<br/><br/>";
	$msg .= "Your client conversion request for ".$row[2].' '.$row[3]." has been reject by admin.";
	$msg .= "Request rejection reason : ".$post[0];
	$msg .= "<br/><br/>Thanks & Regards";
	$msg .= "<br/>".$loggedname;
	$subject = "Client conversion requested has been rejected";
	*/
	
	
	/*  Start Sending of Data to website */
 
    
	$getLeadSource = mysql_query("SELECT `leadsource`,`mobile` FROM `contact` WHERE `id` = '$cid'",$con) or die(mysql_error());
    $rowLeadSource = mysql_fetch_array($getLeadSource);	
	
/*    if($rowLeadSource[0]==57)
	{
	*/	
    $params = Array();
    $params['mobile'] = $rowLeadSource[1];
    $params['type'] = "Rejected";
    $params['notes'] = $note;

    $ch=curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));	
    curl_setopt($ch,CURLOPT_URL,"http://www.bellseye.com/fetchClientStatus.php");
    curl_setopt($ch,CURLOPT_POST,"1");
    curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $output=curl_exec($ch);
    curl_close($ch);
	
	/* }  */
   

   /*  End Sending of Data to website */
	
	
}
?>
