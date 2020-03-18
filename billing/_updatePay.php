<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$invid = $_GET['invid'];
$cid = $_GET['cid'];
/*
$valto = explode("*$*$*",$valto);
foreach($valto as $val) {
	$val = str_ireplace("'","\'",$val);
	$post[] .= $val;
}
*/

$getLastData = mysql_query("SELECT `code`,`id` FROM `contact` where `code` != '' AND `code` != 'TB' order by `id` desc ",$con) or die(mysql_error());
$rowLast = mysql_fetch_assoc($getLastData);
$privousCode = (!empty($rowLast['code'])) ? str_ireplace("TB","",$rowLast['code']) : '';
$newCode = $privousCode+1;
$code='';
if($newCode != '') {
	$code = "TB".$newCode;
}
$getData = mysql_query("SELECT `cid`,`transactionalid` FROM `invoice` WHERE `id` = '$invid'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
$cid = $row[0];
$note = "Client conversion approved";
mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('Capproved', '$note', '$cid', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());
mysql_query("UPDATE `invoice` SET `partialpayment` = '0',`approved`  = '1' WHERE `id` = '$invid'",$con) or die(mysql_error());
mysql_query("UPDATE `servicecall` SET `approved` = '$approved' WHERE `transactionalid` = '$row[1]'",$con) or die(mysql_error());
mysql_query("UPDATE `contact` SET `converted` = '1',`conversiondate` = '$date',`code` = '$code' WHERE `id` = '$cid'",$con) or die(mysql_error());


	$getData = mysql_query("SELECT employee.name, employee.email, contact.fname, contact.lname, contact.mobile, contact.email FROM contact,employee WHERE contact.ownerid = employee.id AND contact.id = '$cid'",$con) or die(mysql_error());
	$row = mysql_fetch_array($getData);
	
	$note = "Hello ".$row[0].",<br/><br/>";
	$note .= "<br/>Your client conversion request for ".$row[2]." ".$row[3]." is successfully apporved by support team";
	$note .= "<br/><br/>Thanks & Regards";
	$note .= "<br/>Support Team";
	$subject = "Client conversion requested approved for ".$row[2]." ".$row[3];

//	mysql_query("INSERT INTO `email_queue` (`cid`, `to_email`, `cc_email`, `bcc_email`, `subject`, `html`) VALUES ('$cid', '$row[1]', '$loggedemail', 'admin@tradingbells.com', '$subject', '$note')",$con) or die(mysql_error());

	$getTemplate = mysql_query("SELECT `templateemail`,`subject` FROM  `templateemail` WHERE `templatefor` = 'document_verified'",$con) or die(mysql_error());
	$rowTemplate = mysql_fetch_array($getTemplate);
	$templateemail = !empty($rowTemplate[0]) ? $rowTemplate[0] : '' ;
	$subject = !empty($rowTemplate[1]) ? $rowTemplate[1] : '' ;
	if(!empty($templateemail)) {
		$templateemail = str_ireplace("{client_code}",$code,$templateemail);
		$clientemail = (!empty($row[5])) ? $row[5] : '';
		
	//	mysql_query("INSERT INTO `email_queue` (`cid`, `to_email`, `cc_email`, `bcc_email`, `subject`, `html`) VALUES ('$cid', '$clientemail', '$row[1]', 'admin@tradingbells.com', '$subject', '$templateemail')",$con) or die(mysql_error());
		
		mysql_query("INSERT INTO `sentemail`(`cid`, `email`, `subject`, `html`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('$cid','$clientemail','$subject','$templateemail','','$datetime','$datetime','$loggeduserid','0')") or die(mysql_error());
		mysql_query("INSERT INTO `emaillog`(`cid`, `email`, `html`, `status`, `id`, `createdate`, `updatedby`) VALUES ('$cid','$clientemail','$templateemail','0','','$datetime','$loggeduserid')",$con) or die(mysql_error());
	}

?>
