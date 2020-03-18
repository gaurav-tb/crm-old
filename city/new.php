<?php
include("../../include/conFig.php");
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Add New City
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
<td align="right">City Name<span style="color:maroon">*</span></td><td align="left">
	<input class="input" name="req" type="text" id="opt0" style="width: 300px" /></td>
</tr>
<tr>
<td align="right" valign="top">State Name
</td><td align="left">
<select name="select1" id="opt1" style="width: 300px" class="input">
		<?php
		$getData = mysql_query("SELECT `id`,`name` FROM `state` WHERE `delete`='0' AND `id` != '1' ORDER BY `name` ",$con) or die(mysql_error());
		while($row = mysql_fetch_array($getData))
		{
		?>
		<option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>		
		<?php
		}
		
		?>

			</select></td>
</tr>
<tr>
<td></td>
<td>
<input name="Button2" type="button" value="Save & New" class="button" onclick="SaveData('masters/city/save','opt','2','','','','1')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Save & Back" class="button" onclick="SaveData('masters/city/save','opt','2','','','','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Cancel" class="buttonnegetive" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"/>
</td>
</tr>
</table>
</div>
