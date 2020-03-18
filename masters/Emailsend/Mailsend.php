<?php
session_start();
ob_start();
include ("../../include/conFig.php");

    if(isset($_POST["import"]))
	{
	$Categories = $_POST['Categories'];
	$Templateid = $_POST['Template'];
	$fileName = $_FILES["file"]["tmp_name"];
	if($_FILES["file"]["size"] > 0)
	{
		$file = fopen($fileName, "r");
		while (($column = fgetcsv($file, 10000, ",")) !== FALSE)
			{
			$Client = "SELECT fname,clientid,address,mobile,email,pancardnumber,bankname,bankbranchname,bankaccounttype,bankaccountnumber,dpname,dpid,clientid,conversionrequestdate,kycmethod,segment,demataccountrequied,softwarerequired,dob FROM contact WHERE `code`='$column[0]'";
			$result = mysql_query($Client, $con);
			while ($rowClient = mysql_fetch_array($result))
				{
				$client_name = $rowClient['fname'];
				$getTemplate = mysql_query("SELECT `name`,`templateemail`,`subject` FROM `templateemail` WHERE `id`='$Templateid' ", $con) or die(mysql_error());
				while ($rowMailcat = mysql_fetch_array($getTemplate))
					{
					$templateemail = $rowMailcat['templateemail'];
					$subject = $rowMailcat['subject'];
					$Clientamount = "SELECT amount FROM fundspayinrequest WHERE `created_date` LIKE '%$datetime%' AND `clientid`='$column[0]'";
					$result2 = mysql_query($Clientamount, $con);
					while ($rowClient2 = mysql_fetch_array($result2))
						{
						$amount = $rowClient2['amount'];
						$templateemail = str_ireplace("{amount}", $amount, $templateemail);
						$templateemail = str_ireplace("{pay_amount}", $amount, $templateemail);
						}

					$Clientboosteramt = "SELECT Activationamt,Segments,StartDate,EndDate FROM researchbooster WHERE  AND `clientid`='$column[0]'";
					$result3 = mysql_query($Clientboosteramt, $con);
					while ($rowClient3 = mysql_fetch_array($result3))
						{
						if (!$rowClient['Activationamt'] == "")
							{
							$Activationamt = $rowClient['Activationamt'];
							}
						  else
							{
							$Activationamt = "NA";
							}

						if (!$rowClient['Segments'] == "")
							{
							$Segments = $rowClient['Segments'];
							}
						  else
							{
							$Segments = "NA";
							}

						if (!$rowClient['StartDate'] == "")
							{
							$BoosterStartDate = $rowClient['StartDate'];
							}
						  else
							{
							$BoosterStartDate = "NA";
							}

						if (!$rowClient['EndDate'] == "")
							{
							$BoosterEndDate = $rowClient['EndDate'];
							}
						  else
							{
							$BoosterEndDate = "NA";
							}

						$templateemail = str_ireplace("{Activation_amt}", $Activationamt, $templateemail);
						$templateemail = str_ireplace("{Activation_amt_without_gst}", $Activationamt, $templateemail);
						$templateemail = str_ireplace("{BoosterStartDate}", $StartDate, $templateemail);
						$templateemail = str_ireplace("{BoosterEndDate}", $EndDate, $templateemail);
						}

					if (!$rowClient['fname'] == "")
						{
						$clientname = $rowClient['fname'];
						}
					  else
						{
						$clientname = "NA";
						}

					if (!$rowClient['clientid'] == "")
						{
						$clientcode = $rowClient['clientid'];
						}
					  else
						{
						$clientcode = "NA";
						}

					if (!$rowClient['address'] == "")
						{
						$clientaddress = $rowClient['address'];
						}
					  else
						{
						$clientaddress = "NA";
						}

					if (!$rowClient['mobile'] == "")
						{
						$clientmobile = $rowClient['mobile'];
						}
					  else
						{
						$clientmobile = "NA";
						}

					if (!$rowClient['email'] == "")
						{
						$clientemail = $rowClient['email'];
						}
					  else
						{
						$clientemail = "NA";
						}

					if (!$rowClient['pancardnumber'] == "")
						{
						$pancardnumber = $rowClient['pancardnumber'];
						}
					  else
						{
						$pancardnumber = "NA";
						}

					if (!$rowClient['bankname'] == "")
						{
						$bankname = $rowClient['bankname'];
						}
					  else
						{
						$bankname = "NA";
						}

					if (!$rowClient['bankbranchname'] == "")
						{
						$bankbranchname = $rowClient['bankbranchname'];
						}
					  else
						{
						$bankbranchname = "NA";
						}

					if (!$rowClient['bankaccounttype'] == "")
						{
						$bankaccounttype = $rowClient['bankaccounttype'];
						}
					  else
						{
						$bankaccounttype = "NA";
						}

					if (!$rowClient['bankaccountnumber'] == "")
						{
						$bankaccountnumber = $rowClient['bankaccountnumber'];
						}
					  else
						{
						$bankaccountnumber = "NA";
						}

					if (!$rowClient['dpname'] == "")
						{
						$dpname = $rowClient['dpname'];
						}
					  else
						{
						$dpname = "NA";
						}

					if (!$rowClient['dpid'] == "")
						{
						$dpid = $rowClient['dpid'];
						}
					  else
						{
						$dpid = "NA";
						}

					if (!$rowClient['clientid'] == "")
						{
						$clientid = $rowClient['clientid'];
						}
					  else
						{
						$clientid = "NA";
						}

					if (!$rowClient['conversionrequestdate'] == "")
						{
						$conversionrequest = $rowClient['conversionrequestdate'];
						}
					  else
						{
						$conversionrequest = "NA";
						}

					if (!$rowClient['kycmethod'] == "")
						{
						$kycmethod = $rowClient['kycmethod'];
						}
					  else
						{
						$kycmethod = "NA";
						}

					if (!$rowClient['segment'] == "")
						{
						$segment = $rowClient['segment'];
						}
					  else
						{
						$segment = "NA";
						}

					if (!$rowClient['demataccountrequied'] == "")
						{
						$demataccountrequied = $rowClient['demataccountrequied'];
						}
					  else
						{
						$demataccountrequied = "NA";
						}

					if (!$rowClient['softwarerequired'] == "")
						{
						$softwarerequired = $rowClient['softwarerequired'];
						}
					  else
						{
						$softwarerequired = "NA";
						}

					if (!$rowClient['softwarerequired'] == "")
						{
						$softwarerequired = $rowClient['softwarerequired'];
						}
					  else
						{
						$softwarerequired = "NA";
						}

					if (!$rowClient['dob'] == "")
						{
						$clientbirth = $rowClient['dob'];
						}
					  else
						{
						$clientbirth = "NA";
						}

					$templateemail = str_ireplace("{client_code}", $clientcode, $templateemail);
					$templateemail = str_ireplace("{client_name}", $clientname, $templateemail);
					$templateemail = str_ireplace("{client_address}", $clientaddress, $templateemail);
					$templateemail = str_ireplace("{client_mobile}", $clientmobile, $templateemail);
					$templateemail = str_ireplace("{client_email}", $clientemail, $templateemail);
					$templateemail = str_ireplace("{pan_no}", $pancardnumber, $templateemail);
					$templateemail = str_ireplace("{bank_name}", $bankname, $templateemail);
					$templateemail = str_ireplace("{branch_name}", $bankbranchname, $templateemail);
					$templateemail = str_ireplace("{account_type}", $bankaccounttype, $templateemail);
					$templateemail = str_ireplace("{account_number}", $bankaccountnumber, $templateemail);
					$templateemail = str_ireplace("{dp_name}", $dpname, $templateemail);
					$templateemail = str_ireplace("{dp_id}", $dpid, $templateemail);
					$templateemail = str_ireplace("{client_id}", $clientid, $templateemail);
				    $templateemail = str_ireplace("{conversion_request}", $conversionrequest, $templateemail);
					$templateemail = str_ireplace("{kyc_method}", $kycmethod, $templateemail);
					$templateemail = str_ireplace("{segment_require}", $segment, $templateemail);
					$templateemail = str_ireplace("{demat_accountrequied}", $demataccountrequied, $templateemail);
					$templateemail = str_ireplace("{software_required}", $softwarerequired, $templateemail);
					$templateemail = str_ireplace("{employee_name}", $employeename, $templateemail);
					$templateemail = str_ireplace("{client_dob}", $clientbirth, $templateemail);
					$templateemail = str_ireplace("'", "\'", $templateemail);
					$templateemail = str_ireplace("{research_segment}", $segmentResearch, $templateemail);
					$templateemail = str_ireplace("{Activation_amt}", $segmentAmount, $templateemail);
					
					    $params = Array();
						$params['content'] = $templateemail;
						$params['recipients'] = $clientemail;
						$params['subject'] = $subject;
						$params['recipients_cc'] = "";
						$params['bcc'] = "";
						$params['from'] = "info@tradingbells.club";
						$params['fromname'] = "TradingBells";
						$params['api_key'] = "acd293ca5a3b70c6e958f65c495f1721";
						$params['opentrack'] = "1";
						$params['clicktrack'] = "1";
						$params['X-APIHEADER'] = "1234";
						$ch = curl_init();
						curl_setopt($ch, CURLOPT_HTTPHEADER, array(
							'Expect:'
						));

						curl_setopt($ch,CURLOPT_URL,"http://api.falconide.com/falconapi/web.send.rest");

						curl_setopt($ch, CURLOPT_POST, "1");
						curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						$output = curl_exec($ch);
						curl_close($ch);
					}
				}

			/*while loop breacket*/
			}
       
		}

		if(isset($_POST['nonpoaclients']))
		{
	  	$Client = "SELECT id FROM `contact` where POA_Activation='0' and converted='1'";
	    $result = mysql_query($Client, $con);
		while($rowClient = mysql_fetch_array($result))
		{
	    mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$rowClient[0]','$Templateid','0','$datetime','0000:00:00')",$con) or die(mysql_error());
	
		}

		}

     	if(isset($_POST['allclients']))
		{
	  	$Client = "SELECT id FROM `contact` where converted='1'";
	    $result = mysql_query($Client, $con);
		while($rowClient = mysql_fetch_array($result))
		{
	    mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$rowClient[0]','$Templateid','0','$datetime','0000:00:00')",$con) or die(mysql_error());
	
		}

		}


	}

?>