<?php
include("../../include/conFigclient.php");

$currentpassword=$_GET['o'];
$newpassword=$_GET['n'];
$confirmpassword=$_GET['c'];
$resultset=mysql_query("SELECT `password` from `client_messenger_settings` WHERE `username` ='$loggeduser'") or die(mysql_error());
$row=mysql_fetch_array($resultset);
	if($currentpassword == '' || $newpassword == '' || $confirmpassword == '')
	{
	$error= '<td><p style="color:maroon;font-size:12px;">Please fill all the fields.</p></td>';
	}
	else
	{
		if($currentpassword!= $row['password'])
		{
			$error= '<td><p style="color:maroon;font-size:12px;">Incorrect Old Password.</p></td>';
		}
		else
		{
			if($newpassword != $confirmpassword)
			{
			$error= '<td><p style="color:maroon;font-size:12px;">Passwords In Both Fields Must Match.</p></td>';
			}
			else
			{
				if($newpassword == $confirmpassword)
				{
				mysql_query("UPDATE `client_messenger_settings` SET `password`='$confirmpassword' WHERE `username`='$loggeduser'") or die(mysql_error());
				$error= '<td><p style="color:green;font-size:12px;">Password Successfully changed</p></td>';
				}
			}
		}
	}
echo $error;
?>
