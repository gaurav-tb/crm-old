<?php
include("../include/conFig.php");
$invoiceid=$_GET['invoiceid'];
//echo "SELECT contact.email, invoice.html,sentitems.subject FROM contact,invoice,sentitems WHERE invoice.cid = contact.id AND invoice.id = '$invoiceid' AND invoice.delete = '0'";
$getData = mysql_query("SELECT * FROM `sentitems` WHERE `id`='$invoiceid'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>
<script src="../ckeditor_3.6/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="../ckeditor_3.6/ckeditor/_samples/sample.js" type="text/javascript"></script>
<link href="../ckeditor_3.6/ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />

<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Sent Invoice</td>
			<td align="right">
			<input name="Button1" type="button" value="< Back To List" class="button" onclick="ToggleBox('manipulatemoodleContent','none','');ToggleBox('viewmoodleContent','block','')" />
			</td>
		</tr>
	</table>
</div>
<div id="directResult">
<form action="viewsentmails.php?invoiceid=<?php echo $invoiceid;?>" method="post">
<table id="viewtable" cellpadding="10" cellspacing="0" class="fetch" width="100%">
<tr>
	<td style="width:0px;font-size:12px; height: 26px;" align="right" >Email
	</td>
	<td style="height: 26px">
	
		<input name="email" type="text" value="<?php echo $row[1];?>"  style="width: 300px">
			</td>	
<td style="width:0px;font-size:12px; height: 26px;" align="right" >Subject</td>
<td style="height: 26px">
	
		<input name="subject" type="text" value="<?php echo $row[2];?>"  style="width: 300px">
			</td>	

</tr>
<tr><td></td>
	<td style="text-align:left"  align="center" colspan="4">
	<textarea id="editor_kama" cols="60" name="html" rows="10"><?php echo $row[3];?>									</textarea>
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
</table>
</form>
	