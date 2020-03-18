<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$cid = $_GET['cid'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}

/*echo"INSERT INTO `client_messenger_settings` (`username`, `password`, `copytips`, `status`, `cid`, `createdate`, `modifieddate`, `delete`, `id`,`whtsappid`, `bbmid`, `skypeid`, `yahooid`) VALUES ('$post[0]', '$post[1]', '$post[2]', '$post[3]', '$cid', '$datetime', '$datetime', '0','', '$post[4]','$post[5]','$post[6]','$post[7]')";
mysql_query("INSERT INTO `client_messenger_settings` (`username`, `password`, `copytips`, `status`, `cid`, `createdate`, `modifieddate`, `delete`, `id`,`whtsappid`, `bbmid`, `skypeid`, `yahooid`) VALUES ('$post[0]', '$post[1]', '$post[2]', '$post[3]', '$cid', '$datetime', '$datetime', '0','', '$post[4]','$post[5]','$post[6]','$post[7]')",$con) or die(mysql_error());*/

$getData = mysql_query("SELECT COUNT(`id`) FROM `client_messenger_settings` WHERE `cid` = '$cid'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
if($row[0] > 0)
{
mysql_query("UPDATE  `client_messenger_settings` SET `username` = '$post[0]', `password` = '$post[1]', `copytips` = '$post[2]',`status` =  '$post[3]', `whtsappid`='$post[4]',`bbmid`='$post[5]',`skypeid`='$post[6]',`yahooid`='$post[7]' WHERE  `cid` ='$cid'",$con) or die(mysql_error());
}
else
{
//echo"INSERT INTO `client_messenger_settings` (`username`, `password`, `copytips`, `status`, `cid`, `createdate`, `modifieddate`, `delete`, `id`,`whtsappid`, `bbmid`, `skypeid`, `yahooid`) VALUES ('$post[0]', '$post[1]', '$post[2]', '$post[3]', '$cid', '$datetime', '$datetime', '0','', '$post[4]','$post[5]','$post[6]','$post[7]')";
mysql_query("INSERT INTO `client_messenger_settings` (`username`, `password`, `copytips`, `status`, `cid`, `createdate`, `modifieddate`, `delete`, `id`,`whtsappid`, `bbmid`, `skypeid`, `yahooid`) VALUES ('$post[0]', '$post[1]', '$post[2]', '$post[3]', '$cid', '$datetime', '$datetime', '0','', '$post[4]','$post[5]','$post[6]','$post[7]')",$con) or die(mysql_error());
}
?>
<span style="color:#009900"><img src="images/approved.png" style="height:15px;" alt=""/>&nbsp;<strong>Settings Saved</strong></span>
