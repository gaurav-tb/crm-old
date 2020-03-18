<?php
include("../include/conFig.php");
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
<div style="float:right">
<input name="Button1" onclick="getModule('uploadlead/import','manipulateContent','viewContent','Import Leads')" type="button" value="Or Import Via Excel" class="buttonGreen" />
</div>
Upload Leads</td>
</tr>
</table>
</div>
<table width="100%" cellpadding="0" cellspacing="10" class="form" align="center">
<tr><td colspan="3" style="padding-top:10px; height: 39px;">
<div style="float:right">

<select name="req" class="input"  style="width: 200px" id="opt3">
				
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `leadsource` WHERE `delete` = '0' AND `id` != '1' ORDER BY name ASC",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
</select>
</div>
Please paste the mobile numbers in the box below. These leads will directly go into the Unalloted Leads Section

</td></tr>
<tr>
<td style="width:33%;" ><b>Lead Name( Default Value : -- )</b></td>
<td style="width:33%;"><b>Mobile Nmber( Required Field )</b>
<input name="Checkbox1" type="checkbox" id="opt4"  value="1"/>Overwrite Number
</td>
<td style="width:33%;"><b>Email Id( Default Value : -- )</b>
<input name="Checkbox1" style="display:none" type="checkbox" id="opt5"  value="1"/></td>
</tr>

<tr>
<td  style=" height: 310px;"><textarea class="input" name="TextArea1" cols="20" rows="2" id="opt0" style="height:300px;width:98%" ></textarea></td>
	<td style="height: 310px"><textarea class="input"  name="TextArea1" cols="20" rows="2" id="opt1" style="height:300px;width:98%"></textarea></td>
	<td style="height: 310px"><textarea class="input"  name="TextArea1" cols="20" rows="2" id="opt2" style="height:300px;width:98%"></textarea></td>
</tr>
<tr>

<td align="right" colspan="3">
<input name="Button" type="button" value="Upload Leads" class="buttonGreen" onclick="SaveData('uploadlead/save','opt','6','','','viewmoodleContent','3')" style="width: 207px" />&nbsp;&nbsp;</td>
</tr>
</table>

