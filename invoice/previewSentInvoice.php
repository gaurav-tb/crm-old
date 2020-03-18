<?php
include("../include/conFig.php");
$invoiceid=$_GET['invoiceid'];
//echo "SELECT contact.email, invoice.html,sentitems.subject FROM contact,invoice,sentitems WHERE invoice.cid = contact.id AND invoice.id = '$invoiceid' AND invoice.delete = '0'";
$getData = mysql_query("SELECT * FROM `sentitems` WHERE `id`='$invoiceid'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>

<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Sent Invoice <strong>INV<?php echo $row['invoiceid'];?></strong></td>
			<td align="right">
			<input name="Button1" type="button" value="< Back To List" class="button" onclick="ToggleBox('manipulatemoodleContent','none','');ToggleBox('viewmoodleContent','block','')" />
			</td>
		</tr>
	</table>
</div>
<div style="background:#eee;height:600px;overflow-x:hidden;overflow-y:scroll" id="">
<?php
echo str_ireplace("&#65279;","",$row['html']);
?>
</div>
<br/><br/><br/><br/>
