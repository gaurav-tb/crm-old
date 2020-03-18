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
			//$to = "sanjay.prajapati@swastika.co.in";
			$to = "sanjay.prajapati@swastika.co.in";
			$to1 = "shailendra.jatav@shareshoppe.in";
			$sub = "Pay Out request";
$headers = "From: noreply@swastika.co.in" . "\r\n" .
"To: ".$to."\r\n".
"Subject: ".$sub."\r\n".
"MIME-Version: 1.0\r\n".
"Content-Type: text/html; charset=ISO-8859-1\r\n";

$headers1 = "From: noreply@swastika.co.in" . "\r\n" .
"To: ".$to1."\r\n".
"Subject: ".$sub."\r\n".
"MIME-Version: 1.0\r\n".
"Content-Type: text/html; charset=ISO-8859-1\r\n";
  //$headers = array ('From' => $from,'To' => $to,'Subject' => $sub,'MIME-Version' => '1.0','Content-Type' => "text/html; charset=ISO-8859-1");


  
mail($to,$sub,$mgg,$headers);
mail($to1,$sub,$mgg,$headers1);


			/*
			$apiUrl = "http://webricks.in/mentor-teacher/api/smtpfile_swastika.php?to=".$to."&subject=".$sub."&mailbody=".$mgg;
			$ch = curl_init($apiUrl);
			curl_setopt ($ch, CURLOPT_POST, 1);
			curl_setopt ($ch, CURLOPT_POSTFIELDS, "data=".$apiUrl);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER ,1); // RETURN THE CONTENTS OF THE CALL
			echo $output = curl_exec($ch);
			curl_close ($ch);
			*/
			//Mail added by Ritesh on 22-4-2015
			echo "Thankyou for submitting your request. We will get back to you shortly.";
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
