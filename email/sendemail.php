<?php
include("../include/conFig.php");
$cid=$_GET['cid'];
if(isset($_POST['submit']))
{
$email=$_POST['email'];

$subject=$_POST['subject'];
$html=$_POST['html'];


mysql_query("INSERT INTO `sentemail`(`cid`, `email`, `subject`, `html`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('$cid','$email','$subject','$html','','$datetime','$datetime','$loggeduserid','0')") or die(mysql_error());
mysql_query("INSERT INTO `email_queue` (`cid`, `to_email`, `cc_email`, `bcc_email`, `subject`, `html`) VALUES ('$cid', '$email', '', 'admin@tradingbells.com', '$subject', '$txt')",$con) or die(mysql_error());
$success = 'Your Email has been successfully sent. You can now close the window.';
}

$getData = mysql_query("SELECT  sentemail.email, sentemail.subject, sentemail.html, sentemail.cid FROM sentemail,contact WHERE sentemail.cid = '$cid' AND sentemail.delete = '0'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>
<script src="../ckeditor_3.6/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="../ckeditor_3.6/ckeditor/_samples/sample.js" type="text/javascript"></script>
<link href="../ckeditor_3.6/ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />

<div class="moduleHeading">
	
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="left" style="width: 30%; height: 24px;">Send Email</td>
<td><div class="button" style="display:inline-block;float:right" onclick="ToggleBox('viewmoodleContent','none','');ToggleBox('manipulatemoodleContent','block','')"><img src="images/back.png" style="vertical-align:middle" alt=""/>&nbsp;&nbsp;Back To List </div></td>
</tr>
</table>
</div>
<?php
if($success)
{
?>
<center style="padding-top:20px;">
<div class="buttonGreen" style="display:inline-block"><?php echo $success;?></div>
</center>
<?php
}
else
{
?>
<form action="sendemail.php?cid=<?php echo $cid;?>" method="post">
<table id="form" cellpadding="5" cellspacing="0" width="100%" style="font-size:12px;background:#eee;">
<tr>
	<td style=" " align="right" >Email
	</td>
	<td style="height: 26px">
	
		<input name="email" type="text" class="input" value="<?php echo $row[0] ?>"  style="width: 300px">
				
		</td>	
			</tr>
	<tr>
	<td style="height: 26px" align="right" >Subject
	</td>
	<td style="height: 26px">
	<input name="subject" type="text" class="input" readonly="readonly" value="<?php echo $row[1];?>"  style="width: 300px">
 	</td>	
	</tr>
		
<tr>
<td valign="top" align="right">Message</td>
<td style="text-align:left"  align="center" colspan="4">
<?php
echo str_ireplace("&#65279;","",$row[2]);
?>

	&nbsp;<script type="text/javascript">
			//<![CDATA[

				  CKEDITOR.replace( 'editor_kama',
					{
						skin : 'kama',
						  enterMode : CKEDITOR.ENTER_BR,
                    shiftEnterMode: CKEDITOR.ENTER_P
						
					});  

			//]]>
			</script>&nbsp;<script type="text/javascript">
			//<![CDATA[

				CKEDITOR.replace( 'editor_v2',
					{
						skin : 'v2'
					});

			//]]>
			</script><br/>
				&nbsp;</td>
</tr>
</table>
</form>
<?php
}
?>
	