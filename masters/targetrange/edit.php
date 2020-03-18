<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$getData = mysql_query("SELECT * FROM `targetrange` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Edit Target Range Name
</td>
<td align="right" style="width:70%">
<?php
if(isset($_GET['type']) && $_GET['type'] == 'search')
{
?>
<input name="Button1" type="button" value="< Back To Search Results" class="button" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
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
<table width="100%" cellpadding="0" cellspacing="10">
<tr>
<td align="right">Target Range Name<span style="color:maroon">*</span></td><td align="left">
	<input class="input" name="req" type="text" id="opt0" style="width: 300px" value="<?php echo $row['name']?>" /></td>
</tr>
<tr>
<td align="right" valign="top">From Date<span style="color:maroon">*</span></td>
<td align="left"><input name="req"  style="width: 200px" class="inputCalender" readonly="readonly" onclick="openCalendar(this);" type="text" id="opt1" value="<?php echo $row['fromdate']?>" /></td>
</tr>
<tr>
<td align="right" valign="top">To Date<span style="color:maroon">*</span></td>
<td align="left"><input name="req"  style="width: 200px" class="inputCalender" readonly="readonly" onclick="openCalendar(this);" type="text" id="opt2" value="<?php echo $row['todate']?>" /></td>
</tr>
<tr>
<td align="right" valign="top">No. of weeks<span style="color:maroon">*</span></td>
<td align="left"><input name="req"  style="width: 200px" class="input" value="<?php echo $row['weeks']?>"  type="text" id="opt3" /></td>
</tr>


<tr>
<td></td>
<td>
<?php if(in_array('U_targetrange',$thisPer))
			{
			?>
<input name="Button1" type="button" value="Update" class="buttonGreen" onclick="SaveData('masters/targetrange/update?id=<?php echo $id;?>&i=<?php echo $_GET['i'];?>','opt','4','<?php echo $_GET['i'];?>','','','2')" />&nbsp;&nbsp;<?php } ?>
<input name="Button1" type="button" value="Cancel" class="button" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>

