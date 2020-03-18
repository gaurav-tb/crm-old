<?php
include("../include/conFig.php");
$cid = $_GET['cid'];
$getdata = mysql_query("SELECT `mobile` FROM `contact` WHERE `id` = '$cid'",$con) or die(mysql_error);
$row = mysql_fetch_array($getdata);
?>
<div class="moduleHeading">
<span id="afterSave">
<div class="button" style="display:inline-block;float:right" onclick="ToggleBox('viewmoodleContent','none','');ToggleBox('manipulatemoodleContent','block','')"><img src="images/back.png" style="vertical-align:middle" alt=""/>&nbsp;&nbsp;Back To List </div>
</span>	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Send SMS<?php echo $_GET['name'];?> </td>
			<td align="right" style="width: 70%">&nbsp;
			</td>
		</tr>
	</table>
</div>
<table width="100%" cellpadding="5" cellspacing="0" class="form">
<tr>
 <td  style="padding-top:10px" align="right">Select Template<span style="color:maroon">*</span></td>
 <td style="padding-top:10px" align="left">
<span>
<select id="tem" name="Select1" onchange="document.getElementById('sms1').value=this.value" class="input">
				<option value="">Select Template</option>
				
				
<?php
$getCity = mysql_query("SELECT `template`,`name` FROM `template` WHERE `delete` = '0' AND `id` != '1' AND `messenger` = '0' ORDER BY `name` ASC",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo str_ireplace("<br/>","\r\n",$rowCity[0]);?>"><?php echo $rowCity[1];?></option>
<?php
}
?>
			

</select>
</span>
 <input id="sms0" type="hidden" class="input" name="reqismob" value="<?php echo $row[0]?>" readonly />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</td>
</tr>
<tr>
<td align="right" style="vertical-align:top">SMS</td><td align="left">
	<form method="post">
	<?php
	if(in_array('SMS_type',$thisPer))
	{
	$readStr = '';
	}
	else
	{
	$readStr = "readonly='readonly'";
	}
	
	?>
	
		<textarea <?php echo $readStr;?> id="sms1" name="req" style="width: 500px; height: 125px" readonly></textarea></form>
	</td>
</tr>

<tr>
<td align="right" style="height: 29px"></td>
	<td align="left">
	<textarea name="TextArea1" cols="20" rows="2" id="preSend" style="display:none">
	<div class="button" style="display:inline-block;float:right" onclick="getModule('sms/viewSMS?clid=<?php echo $cid;?>','manipulatemoodleContent','viewmoodleContent','Sent SMS')"> <img src="images/back.png" style="vertical-align:middle" alt=""/>&nbsp;&nbsp;Back To List </div>
	</textarea>
	<?php
	//$savehtml = 'div class="button" style="display:inline-block;float:right" onclick="getModule(\'sms/viewSMS?clid='.$cid.'\',\'manipulatemoodleContent\',\'viewmoodleContent\',\'Loading SMS List\')img src="images/back.png" style="vertical-align:middle" alt=""/>&nbsp;&nbsp;Back To List </div>';
	?>
	<div class="buttonGreen" style="text-shadow:0px 0px 0px white;display:inline-block"  onclick="SaveData('sms/saveSMS?cid=<?php echo $cid;?>','sms','3','','','ssaved','1');document.getElementById('afterSave').innerHTML =document.getElementById('preSend').value" >Send SMS</div>
<span id="ssaved"></span>
</td>
</tr>

</table>			

