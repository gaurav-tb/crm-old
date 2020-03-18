<?php
$name = 'RITESH';
$code = '8520';
$amount = '1230';
                        $From = 'nonreply@swastika.co.in';
			$mgg = 'Name'.' '.ucfirst($name);
			$mgg .= "\r\n";
			$mgg .= "<br/>";
			$mgg .= 'Client code'.' '.$code;
			$mgg .= "\r\n";
			$mgg .= "<br/>";
			$mgg .= 'Amount'.' '.$amount;
			$mgg .= "\r\n";
			$mgg .= "<br/>";
			$mgg .= 'Please make the payment as soon as possible';
			$to = 'ritesh.paliwal@webricks.com';
			$sub = 'Pay Out request';
			$apiUrl = "http://webricks.in/mentor-teacher/api/smtpfile_swastika.php?to=".$to."&subject=".$sub."&mailbody=".$mgg."";
			$ch = curl_init($apiUrl);
			curl_setopt ($ch, CURLOPT_POST, 1);
			curl_setopt ($ch, CURLOPT_POSTFIELDS, "data=".$apiUrl);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER ,1); // RETURN THE CONTENTS OF THE CALL
			echo $output = curl_exec($ch);
			curl_close ($ch);
                        ?>