<?php
include("../include/conFig.php");
$invoiceid=$_GET['invoiceid'];
if(isset($_POST['submit']))
{
$email=$_POST['email'];
$html=$_POST['html'];
$subject=$_POST['subject'];


mysql_query("INSERT INTO `sentitems` (`invoiceid`, `email`,`subject` , `html` , `id` , `createdate` , `modifieddate` , `updatedby` , `delete`) VALUES ('$invoiceid','$email','$subject','$html','','$datetime','$datetime','$loggeduserid','0')") or die(mysql_error());
$_POST[''];
echo "Email successfully sent";
}
$getData = mysql_query("SELECT contact.email, invoice.html FROM contact,invoice WHERE invoice.cid = contact.id AND invoice.id = '$invoiceid' AND invoice.delete = '0'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>
<script src="../ckeditor_3.6/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="../ckeditor_3.6/ckeditor/_samples/sample.js" type="text/javascript"></script>
<link href="../ckeditor_3.6/ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />

<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Send Invoice</td>
			<td> </td>
		</tr>
	</table>
</div>
<div id="directResult">
<form action="sendinvoice.php?invoiceid=<?php echo $invoiceid;?>" method="post">
<table id="viewtable" cellpadding="10" cellspacing="0" class="fetch" width="100%">
<tr>
	<td style="width:0px;font-size:12px; height: 26px;" align="right" >Email
	</td>
	<td style="height: 26px">
	
		<input name="email" type="text" value="<?php echo $row[0];?>"  style="width: 300px">
			</td>	
<td style="width:0px;font-size:12px; height: 26px;" align="right" >Subject</td>
<td style="height: 26px">
	
		<input name="subject" type="text"   style="width: 300px">
			</td>	

</tr>
<tr><td></td>
	<td style="text-align:left"  align="center" colspan="4">
	<textarea id="editor_kama" cols="60" name="html" rows="10"><?php echo $row[1];?>									</textarea>
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
			</script>
	</td>
</tr>
<tr><td></td>
	<td colspan="2">
	<input name="submit" type="submit" class="buttonBlue" value="Send" />
	</td>
</tr>
</table>
</form>
	