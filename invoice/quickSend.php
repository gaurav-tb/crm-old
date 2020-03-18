<?php
include("../include/conFig.php");
$invoiceid=$_GET['id'];
$getHtml = mysql_query("SELECT `html` FROM `invoice` WHERE `id` = '$invoiceid'",$con) or die(mysql_error());
$rowHtml = mysql_fetch_array($getHtml);
$html = $rowHtml[0];
$email=$_POST['email'];


mysql_query("INSERT INTO `sentitems` (`invoiceid`, `email`,`subject` , `html` , `id` , `createdate` , `modifieddate` , `updatedby` , `delete`) VALUES ('$invoiceid','$email','$subject','$html','','$datetime','$datetime','$loggeduserid','0')") or die(mysql_error());
mysql_query("INSERT INTO `emaillog`(`cid`, `email`, `html`, `status`, `id`, `createdate`, `updatedby`) VALUES ('$','$email','$html','0','','$datetime','$loggeduserid')",$con) or die(mysql_error());
$success = 'Your invoice has been successfully sent. You can now close the window.';
?>
<center style="padding-top:20px;">
<div class="buttonGreen" style="display:inline-block"><?php echo $success;?></div>
</center>

