<?php
error_reporting(0);
include("include/conFig.php");
if($loggeduserid == 1) 
{
$getData=mysql_query("SELECT `id`,`cid`,`EmailTemplateid`,`sendingDate` FROM `onboardingemails` WHERE `onboardingemails`.`sendingDate`<='$datetime' AND `onboardingemails`.`queue_up`='0' LIMIT 10",$con)  or die(mysql_error());	

if(mysql_num_rows($getData)>0)
{
	while($row=mysql_fetch_array($getData))
	{	
	mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES('','$row[1]','$row[2]','0','$row[3]','0000:00:00 00:00:00')") or die(mysql_error());	

	mysql_query("DELETE FROM `onboardingemails` WHERE `id`='$row[0]'") or die(mysql_error());
	}	
}
else
{
echo "NOTHINGFOUNDHERE";	
}
} 
else 
{
echo "NOTHINGFOUNDHERE";
} 
?>
