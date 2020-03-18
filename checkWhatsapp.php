<?php
error_reporting(0);
include("include/conFig.php");
if($loggeduserid == 1) 
{
$getData=mysql_query("SELECT * FROM `whatsapplog` WHERE `createddate`<= '$datetime' AND `status`='0'")or die(mysql_error());;
if(mysql_num_rows($getData) >0 )
{

$row=mysql_fetch_array($getData);
$WhatsAppId=$row['id'];
$WhatsAppMobile=$row['mobile'];
$WhatsAppBody=$row['body'];


echo "<script>
window.location = 'https://secure.capitalvia.com/whatsapp.php?phone=' + $WhatsAppMobile + '&body=' + $WhatsAppBody ;
</script>";

 
mysql_query("UPDATE `whatsapplog` SET `status`='1' WHERE `id`='$WhatsAppId'") or die(mysql_error());
} 

}
else 
{
	
echo "Invalid Request";

} 
?>
