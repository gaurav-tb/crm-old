<?php
include("../include/conFig.php");
$invoiceid=$_GET['invoiceid'];
if(isset($_POST['submit']))
{
$email=$_POST['email'];
$html=$_POST['html'];


mysql_query("INSERT INTO `sentitems` (`invoiceid`, `email`,`subject` , `html` , `id` , `createdate` , `modifieddate` , `updatedby` , `delete`) VALUES ('$invoiceid','$email','$subject','$html','','$datetime','$datetime','$loggeduserid','0')") or die(mysql_error());
$success = 'Your invoice has been successfully sent. You can now close the window.';
}
$getData = mysql_query("SELECT contact.email, invoice.html FROM contact,invoice WHERE invoice.cid = contact.id AND invoice.id = '$invoiceid' AND invoice.delete = '0'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>
<script src="../ckeditor_3.6/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="../ckeditor_3.6/ckeditor/_samples/sample.js" type="text/javascript"></script>
<link href="../ckeditor_3.6/ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />

<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Send Invoice</td>
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
<form action="sendinvoice.php?invoiceid=<?php echo $invoiceid;?>" method="post">
<table id="form" cellpadding="5" cellspacing="0" width="100%" style="font-size:12px;background:#eee;">
<tr>
	<td style=" " align="right" >Email
	</td>
	<td style="height: 26px">
	
		<input name="email" type="text" class="input" value="<?php echo $row[0];?>"  style="width: 300px">
			</td>	
			</tr>
<tr><td valign="top" align="right">Invoice</td>
	<td style="text-align:left"  align="center" colspan="4">
	<textarea id="editor_kama" cols="60" name="html" rows="10"><?php echo str_ireplace("&#65279;","",$row[1]);?>									</textarea>
<script type="text/javascript">
			//<![CDATA[

				CKEDITOR.replace( 'editor_kama',
					{
						skin : 'kama'
					});

			//]]>
			</script>
&nbsp;<script type="text/javascript">
			//<![CDATA[

				CKEDITOR.replace( 'editor_v2',
					{
						skin : 'v2'
					});

			//]]>
			</script><br/>
				<input name="submit" type="submit" class="buttonBlue" value="Send Invoice" style="width: 125px" />
	</td>
</tr>
</table>
</form>
<?php
}
?>
	