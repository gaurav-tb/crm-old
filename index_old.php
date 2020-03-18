<?php
error_reporting(0);
if(isset($_POST['login']))
{
include("include/connection.php");
$username = $_POST['username'];
$password = $_POST['password'];

$chkLogin = mysql_query("SELECT * FROM `employee` WHERE `username` = '$username' AND `password` = '$password'",$con) or die(mysql_error());
if(mysql_num_rows($chkLogin) == 1)
{
$row = mysql_fetch_array($chkLogin);
	if($row['status'] == '1')
	{
	 $error = "Your Account Is Disabled";
	}
	else
	{
	$name = $row['name'];
	$loggedid = $row['id'];
	$expire = time()+(60*60*24);
	setCookie("loggedusername",$username,$expire,"/");
	setCookie("loggeduserid",$loggedid,$expire,"/");
	setCookie("loggedname",$name,$expire,"/");
	setCookie("perm",$row['profile'],$expire,"/");

	header("location:default.php");

	}

}
else
{
$error = "Incorrect Username Password";
}

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<center style="padding-top:200px;">
<table width="400" cellpadding="0" cellspacing="0">
<?php
if($error)
{
?>
<tr>
<td colspan="2">
<?php echo $error;?>
</td>
</tr>
<?php
}
?>
<tr>
<th style="background:#222;color:#fff;text-align:left;padding:10px" colspan="2">Please Login</th>
</tr>
<tr>
<td style="width:100%;background:#f7f7f7;border:1px #999 solid;border-top:0px;">
<form method="post" action="index.php">
<table width="100%" cellpadding="10" cellspacing="0">
<tr>
<td align="right">Username</td>
<td align="left">
<input name="username" type="text" class="input" style="width: 187px" />
</td>
</tr>
<tr>
<td align="right">Password</td>
<td align="left">
<input name="password" type="password" class="input" style="width: 187px" />
</td>
</tr>
<tr>
<td align="right"></td>
<td align="left">
<input name="login" type="submit" class="buttonGreen" value="Log Me In" />
</td>
</tr>
</table>
</form>

</td>
</tr>
</table>
</center>
</body>

</html>
