<?php
include("../include/conFig.php");
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Add New User
</td>
<td align="right" style="width:70%">
<input name="Button1" type="button" value="< Back To List" class="button" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>
</div>
<div>
<table width="100%" cellpadding="0" cellspacing="10" class="form">
<tr>
<td align="right">Username *</td><td>
	<input class="input" name="req" type="text" id="opt0" onblur="autoCheck('employee','username',this.value,'ccav0')" style="width: 200px" /><span id="ccav0" title="Username"></span></td>
<td align="right" style="width: 128px">Password *</td><td align="left"><input class="input" name="req" type="text" id="opt1" style="width: 200px" /></td>
</tr>
<tr>
<td align="right">Name  *</td><td align="left"><input class="input" name="req" type="text" id="opt2" style="width: 200px" /></td>
</tr>
<tr>
<td align="right">Profile  *</td>
	<td align="left"  name="req" style="width: 500px" >
	<select id="opt3" class="input" name="Select1"  style="width: 200px">
				
		<?php
		$getProfile  =mysql_query("SELECT `name`,`id` FROM `profile` WHERE `delete` = '0' ORDER BY `name` ASC",$con) or die(mysql_error());
		while($rowProfile = mysql_fetch_array($getProfile))
		{
		?>
		<option value="<?php echo $rowProfile[1];?>"><?php echo $rowProfile[0];?></option>
		
		<?php
		}
		?>

			</select>&nbsp;&nbsp; (view permissions for the profile)</td>

</tr>
<tr>
<td align="right">Status</td>
	<td align="left" style="width: 500px">
	<input name="Checkbox1" type="checkbox" value="1" id="opt4">
	<span>Active</span>
	</td>
</tr>
<tr>
<td align="right">Email</td><td align="left" style="width: 500px"><input class="input" type="text" id="opt5" style="width: 200px" /></td>
<td align="right" style="width: 128px">Phone</td><td align="left"><input class="input"  type="text" id="opt6" style="width: 200px" /></td>
</tr>
<tr>
<td align="right" style="height: 32px">Mobile  *</td>
	<td align="left" style="height: 32px; width: 500px;"><input class="input" name="reqismob" type="text" id="opt7" style="width: 200px" /></td>
<td align="right" style="height: 32px; width: 128px;">Date of Birth</td>
	<td align="left" style="height: 32px"><input class="input" type="text" id="opt8" style="width: 200px" /></td>
</tr>
<tr>
<td align="right" valign="top">Address</td>
	<td align="left" style="width: 500px">
<textarea name="TextArea2" id="opt9" class="input" style="width: 500px; height: 85px;" ></textarea>

</td>
</tr>
<tr>
<td align="right">City</td><td align="left" style="width: 500px">

<select name="Select1" class="input" id="opt10" style="width: 200px">
				
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `city` WHERE `delete` = '0' ORDER BY `name` ASC",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>

</td>

</tr>

<tr>
<td align="right" valign="top" style="height: 50px">Comments/Remarks</td>
	<td align="left" style="width: 500px; height: 50px;">
<textarea name="TextArea2" id="opt11" class="input" style="width: 500px; height: 85px;" ></textarea>

</td>
</tr>
<tr>
<td></td>
<td style="width: 500px">
<input name="Button2" type="button" value="Save & New" class="buttonGreen" onclick="SaveData('user/save','opt','12','','','','1')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Save & Back" class="buttonGreen" onclick="SaveData('user/save','opt','12','','','','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Cancel" class="buttonnegetive" id="negetive" />
</td>
</tr>
</table>
</div>
