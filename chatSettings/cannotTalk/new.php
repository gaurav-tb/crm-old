<?php
include("../../include/conFig.php");?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
User Settings
</td>
<td align="right" style="width:70%">
<input name="Button1" type="button" value="< Back To List" class="button" onclick="getModule('chatSettings/cannotTalk/view','viewContent','manipulateContent','Chat Settings')" />
</td>
</tr>
</table>
</div>
<div style="padding:20px;" class="form"><table width="100%" cellpadding="0" cellspacing="10">
<tr>
<td align="right" style="height: 36px">Select Profile<span style="color:maroon">*</span></td>
	<td align="left" style="height: 36px">
<select name="req" class="input" onchange="if(this.value != ''){getModule('chatSettings/cannotTalk/getUser?profile='+this.value,'teamUsers','','Users')}">
				<option value="">Select Profile</option>
			<?php
			$getProfile = mysql_query("SELECT `name`,`id` FROM `profile` WHERE `delete` = '0' AND `name` != 'none'",$con) or die(mysql_error());
			while($rowProfile= mysql_fetch_array($getProfile))
			{
			?>
			<option value="<?php echo $rowProfile[1] ;?>"><?php echo $rowProfile[0] ;?></option>
			<?php
			}
			?>
			
			</select>
</td>
</tr>
<tr>
<td align="right">User<span style="color:maroon">*</span></td>
<td id="teamUsers">
<select name="req" class="input" id="">
				<option value="">Select User</option>
			</select>

</td>
</tr>

<tr>
<td align="right" valign="top">Can Talk To</td>
<td id="teamUsers">
<select name="Select1" class="input" onchange="addToteam(this.value,'not1')">
				<option value="">Select User/Users</option>
			<?php
			$getProfile = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0'",$con) or die(mysql_error());
			while($rowProfile= mysql_fetch_array($getProfile))
			{
			?>
			<option value="<?php echo $rowProfile[1] ;?>**<?php echo $rowProfile[0] ;?>"><?php echo $rowProfile[0] ;?></option>
			<?php
			}
			?>
			
			</select>&nbsp;&nbsp;<span id="reselect"></span>
			<div style="padding:5px;width:500px;" id="selectTeam">
						</div>
			<input name="req" type="text" value="" id="not1" title="isNotNull" style="display:none" />

</td>
</tr>
<tr>
<td align="right" valign="top">Remark</td>

<td align="left">
<textarea name="TextArea1" id="not2" class="input" style="width: 501px; height: 80px"></textarea>
</td>
</tr>
<tr>
<td></td>
<td>
<input name="Button1" type="button" value="Save" class="buttonGreen" onclick="SaveData('chatSettings/cannotTalk/save','not','3','','','','1')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Cancel" class="buttonnegetive" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"/>
</td>
</tr>
</table>
</div>
