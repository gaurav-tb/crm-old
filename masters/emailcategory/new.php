<?php
include("../../include/conFig.php");
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Add New Email Category
</td>
<td align="right" style="width:70%">
<input name="Button1" type="button" value="< Back To List" class="button" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>
</div>
<div style="padding:20px;" class="form"><table width="100%" cellpadding="0" cellspacing="10">
<tr>
<td align="right">Email Category Name<span style="color:maroon">*</span></td><td align="left"><input class="input" name="req" type="text" id="opt0" /></td>
</tr>

<tr>
<td align="right">Order<span style="color:maroon">*</span></td><td align="left"><input class="input" name="req" type="text" id="opt2" /></td>
</tr>
<tr>
<td align="right">Display In<span style="color:maroon">*</span></td><td align="left">
<select class="input" id="opt3">
		<option value="0">Both Leads & Clients</option>
		<option value="1">Leads Only</option>
		<option value="2">Clients Only</option>
		<option value="3">None</option>
</select>
</select>

</td>
</tr>
<tr>

<td align="right" valign="top">Description</td><td align="left">
<textarea name="TextArea1" id="opt1" class="input" style="width: 340px; height: 109px"></textarea>

</td>
</tr>
<tr>
<td></td>
<td>
<input name="Button2" type="button" value="Save & New" class="buttonGreen" onclick="SaveData('masters/emailcategory/save','opt','4','','','','1')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Save & Back" class="buttonGreen" onclick="SaveData('masters/emailcategory/save','opt','4','','','','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Cancel" class="buttonnegetive" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>
</div>
