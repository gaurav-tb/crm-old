<?php
include("../../include/conFig.php");
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Add New Target Range
</td>
<td align="right" style="width:70%">
<input name="Button1" type="button" value="< Back To List" class="button" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>
</div>
<div style="padding:20px;" class="form"><table width="100%" cellpadding="0" cellspacing="10">
<tr>
<table width="100%" cellpadding="0" cellspacing="10">
<tr>
<td align="right">Target Range Name<span style="color:maroon">*</span></td><td align="left">
	<input class="input" name="req" type="text" id="opt0" style="width: 300px" /></td>
</tr>
<tr>
<td align="right" valign="top">From Date<span style="color:maroon">*</span></td>
<td align="left"><input name="req"  style="width: 200px" class="inputCalender" readonly="readonly" onclick="openCalendar(this);" type="text" id="opt1" /></td>
</tr>
<tr>
<td align="right" valign="top">To Date<span style="color:maroon">*</span></td>
<td align="left"><input name="req"  style="width: 200px" class="inputCalender" readonly="readonly" onclick="openCalendar(this);" type="text" id="opt2" /></td>
</tr>

<tr>
<td align="right" valign="top">No. of weeks<span style="color:maroon">*</span></td>
<td align="left"><input name="req"  style="width: 200px" class="input"  type="text" id="opt3" /></td>
</tr>




<tr>
<td></td>
<td>
<input name="Button2" type="button" value="Save & New" class="buttonGreen" onclick="SaveData('masters/targetrange/save','opt','4','','','','1')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Save & Back" class="buttonGreen" onclick="SaveData('masters/targetrange/save','opt','4','','','','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Cancel" class="buttonnegetive" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"/>
</td>
</tr>
</table>
</div>
