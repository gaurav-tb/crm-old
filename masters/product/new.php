<?php
include("../../include/conFig.php");
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Add New Product
</td>
<td align="right" style="width:70%">
<input name="Button1" type="button" value="< Back To List" class="button" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>
</div>
<div style="padding:20px;" class="form"><table width="100%" cellpadding="0" cellspacing="10">
<tr>
<td align="right">Service Category<span style="color:maroon">*</span></td><td align="left">

<select name="req" class="input" style="width:300px;" id="opt7">
<?php
$getCat = mysql_query("SELECT `name`,`id` FROM `category` WHERE `delete` = '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowCat = mysql_fetch_array($getCat))
{
?>
				<option value="<?php echo $rowCat[1];?>"><?php echo $rowCat[0];?></option>
				
<?php
}
?>				
			</select>
	
	
	</td>
</tr>

<tr>
<td align="right">Name<span style="color:maroon">*</span></td><td align="left">
	<input class="input" name="req" type="text" id="opt0" style="width: 300px" /></td>
</tr>
<tr>
<td align="right">Code<span style="color:maroon">*</span></td><td align="left"><input class="input" name="req" type="text" id="opt1" style="width: 300px"  /></td>
</tr>
<tr>
<td align="right" valign="top">Description</td><td align="left">
<textarea name="TextArea1" id="opt2" class="input" style="width: 445px; height: 109px"></textarea>
</td>
</tr>

<tr>
<td align="right">Amount<span style="color:maroon">*</span></td><td align="left"><input class="input" name="reqisnum" type="text" id="opt3"  style="width: 300px" /></td>
</tr>
<tr>
<td align="right">Unit<span style="color:maroon"></span></td><td align="left"><input class="input" name="unit" type="text" id="opt4" style="width: 300px"  /></td>
</tr>
<tr>

<td align="right">Money Back<span style="color:maroon"></span></td><td align="left">
<select name="Select1" id="opt5" class="input"  style="width: 300px" >
				<option value="No">No</option>
								<option value="Yes">Yes</option>

			</select>
</td>
</tr>
<tr>
<td align="right">Quantity<span style="color:maroon"></span></td><td align="left"><input class="input" name="isnum" type="text" id="opt6" value="1" style="width: 300px" /></td>
</tr>
<tr>
<td></td>
<td>
<input name="Button2" type="button" value="Save & New" class="buttonGreen" onclick="SaveData('masters/product/save','opt','8','','','','1')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Save & Back" class="buttonGreen" onclick="SaveData('masters/product/save','opt','8','','','','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Cancel" class="buttonnegetive" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>
</div>
