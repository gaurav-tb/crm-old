<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$getData = mysql_query("SELECT * FROM `introducer` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Edit Introducer Name
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
<td align="right" style="height: 36px">Introducer Name<span style="color:maroon">*</span></td>
	<td align="left" style="height: 36px">
	<input class="input" name="req" type="text" id="opt0" value="<?php echo $row[0];?>" style="width: 303px" /></td>
</tr>
<tr>
<td style="height: 40px"></td>
<td style="height: 40px">
<?php if(in_array('U_country',$thisPer))
			{
			?>
<input name="Button1" type="button" value="Update" class="buttonGreen" onclick="SaveData('masters/introducer/update?id=<?php echo $id;?>&i=<?php echo $_GET['i'];?>','opt','2','<?php echo $_GET['i'];?>','','','2')" />&nbsp;&nbsp;<?php } ?>
<input name="Button1" type="button" value="Cancel" class="buttonnegetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>
</div>
