<?php
session_start();
ob_start();
error_reporting(0);
if(isset($_POST['login']))
{
include("../../include/connection.php");
$username = $_POST['username'];
$password = $_POST['password'];

$chkLogin = mysql_query("SELECT * FROM `client_messenger_settings` WHERE `username` = '$username' AND `password` = '$password'",$con) or die(mysql_error());
if(mysql_num_rows($chkLogin) == 1)
{
$row = mysql_fetch_array($chkLogin);
	if($row['status'] == '0')
	{
	 $error = "Your Account Is Disabled";
	}
	else
	{
	$cid = $row['cid'];
	$getData = mysql_query("SELECT `fname`,`lname` FROM `contact` WHERE `id` = '$cid'",$con) or die(mysql_error());
	$rd = mysql_fetch_array($getData);
	$name = $rd['fname']." ".$rd['lname'];
	$loggedid = $cid;
	$expire = time()+(60*60*24);
	setCookie("lcusername",$username,$expire,"/");
	setCookie("llcuserid",$loggedid,$expire,"/");
	setCookie("lcname",$name,$expire,"/");
	//echo "success";
	header("location:default.php");

	}

}
else
{
$error = "Incorrect Username or Password";
}

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
</head>

<body style="overflow:scroll">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="center">
	<table width="960px" cellpadding="0" cellspacing="0">
	<tr>
	<td valign="top">
	<br/><br/>
	
	<img src="../../images/headPage.jpg" width=";" alt=""/>
	<div style="background:#0072C6;width:475px;;height:150px;">
	<div style="padding:10px;color:#fff">
		<span style="font-size:30px;">Welcome To Gocrm.co.in</span>
		<br/>
		An application your sales team is going to love.
	</div>
	<br/>
	<div style="margin:10px;;background:#fff;color:#0072C6;padding:5px;width:130px;text-align:center;cursor:pointer">Sign Up Now</div>
	<br/>

	</div>
	
	</td>
	<td valign="top" align="left" style="width:40%">
	<br/>
	<br/>
	<br/>
	<br/>
	<img src="../../images/logo_blue.png" style="height:40px;" alt=""/>
	<br/><br/>
	<span style="font-size:13px;">Login to your account</span>
	<br/><br/><?php
if($error)
{
?>
<div style="font-size:12px;color:maroon">
<?php
echo $error;
}
?>
</div>

	<div style="line-height:200%">
	<form method="post" action="">
	<input name="username" type="text" placeholder="Username" class="input" style="width: 358px;border:1px #888 solid" />
<br/>
<input name="password" type="password" placeholder="Password" class="input" style="width: 358px;border:1px #888 solid" />
<br/>
<input class="buttonBlue" name="login" type="submit" value="Log Me In" style="width: 100px;" />
<br/><br/>
</form>
</div>
<div style="font-size:12px;line-height:180%">
<div class="blueSimpletext">Forgot Password</div>
<div class="blueSimpletext">Trouble Accessing My Account</div>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<span style="color:#222">Don't have a gocrm account?</span> <span class="blueSimpletext">Sign Up Now</span>
</div>

	</td>
	</tr>
	<tr>
	<td style="height:20px;"></td>
	</tr>
	<tr>
	<td colspan="2" style="border-top:1px #999 solid;font-size:12px;" align="right">
	<br/>
	<div style="float:left">
	Copyright 2012, Webricks Services
	</div>
	Terms & Conditions&nbsp;&nbsp;&nbsp;&nbsp;Feedback&nbsp;&nbsp;&nbsp;&nbsp;Support
	</td>
	</tr>
	</table>
</td>
</tr>
</table>
</body>

</html>

