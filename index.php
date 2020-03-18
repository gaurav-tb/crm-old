<?php

session_start();

ob_start();

//error_reporting(0);

if(!isset($_COOKIE['gocrmuser']))

{

$expire = time()+(60*60*24*365);

$cookie = 'dummyvalue';

setcookie("gocrmuser",$cookie,$expire,"/");

}



$ip = $_SERVER['REMOTE_ADDR'];

if(isset($_POST['login']))

{

include("include/connection.php");

$username = $_POST['username'];

$password = $_POST['password'];

$getip = mysql_query("SELECT `from` FROM `iprange`",$con) or die(mysql_error());

$rowip = mysql_fetch_array($getip);

//echo $rowip[0];

$iparr = explode(',',$rowip[0]);

$chkLogin = mysql_query("SELECT * FROM `employee` WHERE `username` = '$username' AND `password` = '$password' AND `delete` = '0'",$con) or die(mysql_error());

if(mysql_num_rows($chkLogin) == 1)



{

$row = mysql_fetch_array($chkLogin);

	if($row['status'] == '0')

	{

	 $error = "Your Account Is Disabled";

	}

	else

	{

		if(in_array($ip,$iparr))

		{

		$name = $row['name'];

		$loggedid = $row['id'];

		$name = $row['name'];

		$loggedid = $row['id'];

		$expire = time()+(60*60*24);

		if($_POST['remember'])

		{

		$cookie = base64_encode($username).'**$$**'.base64_encode($password);

		setcookie("gocrmuser",$cookie,$expire,"/");

		

		}

			setcookie("loggedusernamesws",$username,$expire,"/");

			setcookie("loggeduseridsws",$loggedid,$expire,"/");

			setcookie("loggednamesws",$name,$expire,"/");

			setcookie("permsws",$row['profile'],$expire,"/");
			
			setcookie("loggedusermobile",$row['mobile'],$expire,"/");

			
			 

				

			//////////////////////////	Chat ///////////////////

				

		$chkLogin1 = mysql_query("SELECT * FROM `user` WHERE `id` = '$loggedid' ",$con) or die(mysql_error());

		$row1 = mysql_fetch_array($chkLogin1);

		$key = $row1['key'];

		mysql_query("UPDATE `user` SET `loadReqtime` = '$datetime' WHERE `id` = '$loggedid'",$con) or die(mysql_error());

		

			

		$count = 0;



	

			if($key == '0')

			{

			

			$getKey = mysql_query("SELECT `key`,`count` FROM `keys` WHERE `count` != '10' limit 1 ",$con) or die(mysql_error());

		

			$rowKey = mysql_fetch_array($getKey);

			$key = $rowKey[0];

			$count = $rowKey[1]+1;

			mysql_query("UPDATE `user` SET `key` = '$key' ,`login`='1' WHERE `id` = '$loggedid'",$con) or die(mysql_error());

			mysql_query("UPDATE `keys` SET `count` = '$count' WHERE `key` = '$key'",$con) or die(mysql_error());

			setCookie("loggedkey",$key,$expire,"/");

			

			}

			else

			{

			setCookie("loggedkey",$key,$expire,"/");

			mysql_query("UPDATE `user` SET `login`='1' WHERE `id` = '$loggedid'",$con) or die(mysql_error());

			}
				///////////////////////////		

			header("location:default.php");

			}

			else

			{

				$IPper = $row['IPper'];

				if($IPper == '1') 

				{
					$name = $row['name'];

					$loggedid = $row['id'];
					$loggedemail = $row['email'];

					$expire = time()+(60*60*24);

					if($_POST['remember'])

						{

						$cookie = base64_encode($username).'**$$**'.base64_encode($password);

						setcookie("gocrmuser",$cookie,$expire,"/");

						}

						setcookie("loggedusernamesws",$username,$expire,"/");

						setcookie("loggeduseridsws",$loggedid,$expire,"/");

						setcookie("loggednamesws",$name,$expire,"/");

						setcookie("permsws",$row['profile'],$expire,"/");
						setcookie("loggedemail",$loggedemail,$expire,"/");

						setcookie("loggedusermobile",$row['mobile'],$expire,"/");

						
						

				//////////////////////////	Chat ///////////////////

				

	    $chkLogin1 = mysql_query("SELECT * FROM `user` WHERE `id` = '$loggedid' ",$con) or die(mysql_error());

		$row1 = mysql_fetch_array($chkLogin1);

		$key = $row1['key'];

		mysql_query("UPDATE `user` SET `loadReqtime` = '$datetime' WHERE `id` = '$loggedid'",$con) or die(mysql_error());

		

			

		$count = 0;



		if($key == '0')

	    {

			

		$getKey = mysql_query("SELECT `key`,`count` FROM `keys` WHERE `count` != '10' limit 1 ",$con) or die(mysql_error());

		

		$rowKey = mysql_fetch_array($getKey);

		$key = $rowKey[0];

		$count = $rowKey[1]+1;

			echo "UPDATE `user` SET `key` = '$key' ,`login`='1' WHERE `id` = '$loggedid'";

			mysql_query("UPDATE `user` SET `key` = '$key' ,`login`='1' WHERE `id` = '$loggedid'",$con) or die(mysql_error());

			mysql_query("UPDATE `keys` SET `count` = '$count' WHERE `key` = '$key'",$con) or die(mysql_error());

			setCookie("loggedkeysws",$key,$expire,"/");

			

			}

			else

			{

			setCookie("loggedkey",$key,$expire,"/");

			mysql_query("UPDATE `user` SET `login`='1' WHERE `id` = '$loggedid'",$con) or die(mysql_error());

			

			

			}
				///////////////////////////		

						

						

						

			header("location:default.php");
            }



			else

			{

			$error = "This system is not authorized system. IP: ".$ip." is not allowed.";

			}

		}

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

<link href="css/common.css" rel="stylesheet" type="text/css" />

<link href="css/style.css" rel="stylesheet" type="text/css" />

</head>



<body style="overflow:scroll">

<table width="100%" cellpadding="0" cellspacing="0">

<tr>

<td align="center">

	<table width="960px" cellpadding="0" cellspacing="0">

	<tr>

	<td valign="top">

	<br/><br/>

	

	<img src="images/headPage.jpg" width=";" alt=""/>

	<div style="background:#0072C6;width:475px;;height:150px;">

	<div style="padding:10px;color:#fff">

		<span style="font-size:30px;">Welcome To TradingBells</span>

		<br/>

		An application your sales team is going to love.

	</div>

	<br/>

	

	<br/>



	</div>

	

	</td>

	<td valign="top" align="left" style="width:40%">

	<br/>

	<br/>

	<br/>

	<br/>

	<img src="images/logo.png" style="height:60px;" alt=""/>

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

	<?php

	if(isset($_COOKIE['gocrmuser']))

	{

	$autofill = $_COOKIE['gocrmuser'];

	if($autofill != 'dummyvalue')

	{

	$temp = explode("**$$**",$autofill);

	$autoUser = base64_decode($temp[0]);

	$autoPass = base64_decode($temp[1]);

	}

	else

	{

	$autoUser = '';

	$autoPass = '';	

	}

	}

	?>

	<input name="username" type="text" placeholder="Username" value="<?php echo $autoUser;?>" autocomplete="off" class="input" style="width: 358px;border:1px #888 solid" />

<br/>

<input name="password" type="password" placeholder="Password" value="<?php echo $autoPass;?>"  autocomplete="off"  class="input" style="width: 358px;border:1px #888 solid" />



<br/>

<input name="remember" type="checkbox" <?php echo 'checked=checked'?> style="vertical-align:middle" /> Remember Me

<br/>





<input class="buttonBlue" name="login" type="submit" value="Log Me In" style="width: 100px;" />

<br/><br/>

</form>

</div>

<div style="font-size:12px;line-height:180%">



<br/>

<br/>

<br/>

<br/>

<br/>

<br/>

<br/>

<br/>


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

	</div>

	</td>

	</tr>

	</table>

</td>

</tr>

</table>

</body>



</html>

