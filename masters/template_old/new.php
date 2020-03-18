<?php
include("../../include/conFig.php");
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Add New Template
</td>
<td align="right" style="width:70%">
<input name="Button1" type="button" value="< Back To List" class="button" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>
</div>
<div style="padding:20px;" class="form"><table width="100%" cellpadding="0" cellspacing="10">
<tr>
<td align="right">Template Name<span style="color:maroon">*</span></td><td align="left"><input class="input" name="req" type="text" id="opt0" /></td>
</tr>
<tr>
<td align="right" style="vertical-align:top">Template<span style="color:maroon">*</span></td>
<td align="left"><textarea style="height:50px;width:300px" cols="20" id="opt1" name="req" rows="2"></textarea>	</td>
<tr>
<td align="right">
Is this a Messenger Template<span style="color:maroon">*</span>
</td>
<td>

	<select id="opt2" name="req" class="input" style="width:60px">
	<option value="">Y/N</option>
	<option id="yes" value="1">YES</option>
	<option id="no" value="0">NO</option>
</select>
</td>
</tr>
<tr>
<td></td>
<td>
<input name="Button2" type="button" value="Save & New" class="buttonGreen" onclick="SaveData('masters/template/save','opt','3','','','','1')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Save & Back" class="buttonGreen" onclick="SaveData('masters/template/save','opt','3','','','','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Cancel" class="buttonnegetive" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>
</div>
