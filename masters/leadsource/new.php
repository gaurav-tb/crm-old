<?php
include("../../include/conFig.php");
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Add New Lead Source
</td>
<td align="right" style="width:70%">
<?php
if($_GET['refresh'] == 1)
{
?>
<input name="Button1" type="button" value="< Back To List" class="button" onclick="getModule('masters/leadsource/view','viewContent','manipulateContent','New Lead Source')" />
<?php
}
else
{
?>
<input name="Button1" type="button" value="< Back To List" class="button" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
<?php
}
?>
</td>
</tr>
</table>
</div>
<div style="padding:20px;" class="form"><table width="100%" cellpadding="0" cellspacing="10">
<tr>
<td align="right">Lead Source Name<span style="color:maroon">*</span></td><td align="left">
	<input class="input" name="req" type="text" id="opt0" style="width: 320px" /></td>
</tr>
<tr>
<td align="right" valign="top">Description</td><td align="left">
<textarea name="TextArea1" id="opt1" class="input" style="width: 460px; height: 109px"></textarea>

</td>
</tr>

<tr>
<td align="right">Display To BA/SBA</td><td align="left">

<select class="input" id="opt2">
<option value="1">YES</option>
<option  value="0">NO</option></select>

</td>
</tr>


<tr>
<td></td>
<td>
<input name="Button2" type="button" value="Save & New" class="buttonGreen" onclick="SaveData('masters/leadsource/save','opt','3','','','','1')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Save & Back" class="buttonGreen" onclick="SaveData('masters/leadsource/save','opt','3','','','','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Cancel" class="buttonnegetive" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>
</div>
