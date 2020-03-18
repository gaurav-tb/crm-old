<?php
include("../../include/conFig.php");
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Add New Slab
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
<td align="right">Slab Range<span style="color:maroon">*</span></td>
<td align="left">
<input class="input" name="req" type="text" id="opt0" style="width: 320px" />
</td>
<td align="right">Incentives On Slab<span style="color:maroon">*</span></td>
<td align="left">
<input class="input" name="req" type="text" id="opt1" style="width:320px" />
</td>

</tr>

<tr>
<td align="right">Slab Range From<span style="color:maroon">*</span></td>
<td align="left">
<input class="input" name="req" type="text" id="opt2" style="width: 320px" />
</td>

<td align="right">Slab Range To<span style="color:maroon">*</span></td>
<td align="left">
<input class="input" name="req" type="text" id="opt3" style="width: 320px" />
</td>
</tr>

<tr>
<td align="right">Order In Report <span style="color:maroon">*</span></td>
<td align="left">
<select id="opt4" class="input"  name="req" style="width:320px" >
<option>Select Order</option>
<?php 
for($j=1;$j<=50;$j++)
{
?>	
<option value="<?php echo $j; ?>"><?php echo $j; ?></option>	
<?php
}
?>
</select>
</td>
</tr>


<tr>
<td></td>
<td>
<input name="Button2" type="button" value="Save & New" class="buttonGreen" onclick="SaveData('masters/rmslabmaster/save','opt','5','','','','1')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Save & Back" class="buttonGreen" onclick="SaveData('masters/rmslabmaster/save','opt','5','','','','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Cancel" class="buttonnegetive" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>
</div>
