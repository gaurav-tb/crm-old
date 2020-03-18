<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$getData = mysql_query("SELECT * FROM `leadsource` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Edit Lead Source
</td>
<td align="right" style="width:70%">
<?php
if(isset($_GET['type']) && $_GET['type'] == 'search')
{
?>
<input name="Button1" type="button" value="< Back To Search Results" class="button" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
<?php
}
else if(isset($_GET['refresh']) && $_GET['refresh'] == '1')
{
?>
<input name="Button1" type="button" value="< Back To List" class="button" onclick="getModule('masters/leadsource/view','viewContent','manipulateContent','Lead Source')" />
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
<td align="right" style="height: 36px">Lead Source Name<span style="color:maroon">*</span></td>
	<td align="left" style="height: 36px"><input class="input" name="req" type="text" id="opt0" value="<?php echo $row[0];?>" /></td>
</tr>
<tr>
<td align="right" valign="top">Description</td><td align="left">
<textarea name="TextArea1" id="opt1" class="input" style="width: 340px; height: 109px"><?php echo $row['description'];?></textarea>
</td>
</tr>

<tr>
<td align="right">Display To BA/SBA</td><td align="left">

<select class="input" id="opt2">
<option <?php if($row['disp'] == '1') echo "selected='selected'";?> value="1">YES</option>
<option <?php if($row['disp'] == '0') echo "selected='selected'";?>  value="0">NO</option></select>

</td>
</tr>

<tr>
<td></td>
<td><?php  if(in_array('U_contactS',$thisPer))
			{
			?>

<input name="Button1" type="button" value="Update" class="buttonGreen" onclick="SaveData('masters/leadsource/update?id=<?php echo $id;?>&i=<?php echo $_GET['i'];?>','opt','3','<?php echo $_GET['i'];?>','','','2')" />&nbsp;&nbsp;<?php } ?>
<input name="Button1" type="button" value="Cancel" class="button" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>
</div>
