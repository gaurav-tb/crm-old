<?php
include("connection.php");
$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];


$getData = mysql_query("SELECT * FROM `openaccount` WHERE `mobile` = '$mobile'",$con) or die(mysql_error());
if(mysql_num_rows($getData) > 0)
{
	$already = 1;
}
else
{
	$getData = mysql_query("SELECT * FROM `getacall` WHERE `number` = '$mobile'",$con) or die(mysql_error());
	if(mysql_num_rows($getData) > 0)
	{
		$already = 1;
	}
	else
	{
		$already = 0;
	}
}

if($already == 0)
{
$url = "https://tradingbells.bitrix24.com/crm/configs/import/lead.php?LOGIN=info@tradingbells.com&PASSWORD=abcd1234&TITLE=".$name."&NAME=".$name."&PHONE_MOBILE=".$mobile."&EMAIL_WORK=".$email."&SOURCE_ID=WEB";
file_get_contents($url);
mysql_query("INSERT INTO `openaccount` (`id`, `name`, `email`, `mobile`, `createdate`) VALUES ('', '$name', '$email', '$mobile', '$datetime')",$con) or die(mysql_error());
}
else
{
	echo "We already have a request from this mobile number. In case you haven't received a call from us, kindly call us on 022-33756200";
}

mysql_close(); 


?>