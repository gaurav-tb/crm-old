<?php
include("../include/connection.php");
$secretkey = $_REQUEST['secretkey'];
$secretkey = 'SxNTqlyZn';

if($secretkey == 'SxNTqlyZn')
{
	$code = $_REQUEST['code'];
	$name = str_ireplace("-"," ",$_REQUEST['name']);
	$amount = $_REQUEST['amount'];
	$chkData = mysql_query("SELECT `id`,`fname`,`code` FROM `contact` WHERE `code` = '$code' AND `delete` = '0'",$con) or die(mysql_error());
	$fetch = mysql_fetch_array($chkData);
	$count = mysql_num_rows($chkData);		
		if($count > 0)
		{
			$cid = $fetch[0];
			mysql_query("INSERT INTO `fundrequest`(`id`, `cid`, `name`, `amount`, `date`, `createdate`, `modifieddate`) VALUES ('','$cid','$name','$amount','$date','$datetime','$datetime')",$con) or die(mysql_error());
			//Mail added by Ritesh on 22-4-2015
			$From = 'nonreply@swastika.co.in';
			$mgg = "<strong>Name : </strong>".ucfirst($name);
			$mgg .= "\r\n";
			$mgg .= "<br/>";
			$mgg .= "<strong>Client code : </strong>".$code;
			$mgg .= "\r\n";
			$mgg .= "<br/>";
			$mgg .= "<strong>Amount : </strong>".$amount;
			$mgg .= "\r\n";
			$mgg .= "<br/>";
			$mgg .= "Please make the payment as soon as possible";
			$to = "sanjay.prajapati@swastika.co.in,shailendra.jatav@shareshoppe.in";
			$sub = "Pay Out request";
			$apiUrl = "http://webricks.in/mentor-teacher/api/smtpfile_swastika.php?to=".$to."&subject=".$sub."&mailbody=".$mgg;
			$ch = curl_init($apiUrl);
			curl_setopt ($ch, CURLOPT_POST, 1);
			curl_setopt ($ch, CURLOPT_POSTFIELDS, "data=".$apiUrl);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER ,1); // RETURN THE CONTENTS OF THE CALL
			echo $output = curl_exec($ch);
			curl_close ($ch);
			//Mail added by Ritesh on 22-4-2015
		}
		else
		{
			echo "<span style='color:red'>Client Code Not Valid</span>";
		}
}
else
{
	echo "<span style='color:red'>Unauthorized Request</span>";
}
?>
