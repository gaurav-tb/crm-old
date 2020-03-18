<?php
include("../include/conFig.php");
$cid = $_GET['cid'];
$getdata = mysql_query("SELECT `mobile`,`sms` FROM `sentsms` WHERE `cid` = '$cid'",$con) or die(mysql_error);
$row = mysql_fetch_array($getdata);
?>
<div class="moduleHeading">
<div class="button" style="display:inline-block;float:right" onclick="ToggleBox('viewmoodleContent','none','');ToggleBox('manipulatemoodleContent','block','')"><img src="images/back.png" style="vertical-align:middle" alt=""/>&nbsp;&nbsp;Back To List </div>
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Sent SMS<?php echo $_GET['name'];?> </td>
			<td align="right" style="width: 70%">&nbsp;
			</td>
		</tr>
	</table>
</div>
<table width="100%" cellpadding="5" cellspacing="0" class="form">
<tr>
<td  style="padding-top:10px" align="right">Mobile</td><td style="padding-top:10px" align="left">
<input id="sms0" class="input" name="Text1" type="text" readonly="readonly" value="<?php echo substr($row[0], 0, 0) . 'XXXXXXX' . substr($row[0],  -3);?>" /></td>
</tr>
<tr>
<td align="right" style="vertical-align:top">SMS</td><td align="left">
	<form method="post">
		<textarea id="sms1" name="TextArea1" readonly="readonly" style="width: 500px; height: 125px"><?php echo str_ireplace("<br/>","\r\n",$row[1])?></textarea></form>
	</td>
</tr>

</table>			

