<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$getData = mysql_query("SELECT * FROM `leadstatus` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Edit Lead Status
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
<td align="right" style="height: 36px">Lead Status Name<span style="color:maroon">*</span></td>
	<td align="left" style="height: 36px"><input class="input" name="req" type="text" id="opt0" value="<?php echo $row[0];?>" /></td>
</tr>
<tr>
<td align="right" valign="top">Description</td><td align="left">
<textarea name="TextArea1" id="opt1" class="input" style="width: 340px; height: 109px"><?php echo $row['description'];?></textarea>
</td>
</tr>
<tr>
	<td align="right">Is this a junk Status?
	</td>
	<td>
	<select id="opt2" name="Select1" class="input" style="width:60px">
				<option <?php if($row['junk'] == '0') {echo 'selected==selected';}?> value="0">NO</option>
				<option <?php if($row['junk'] == '1') {echo 'selected==selected';}?> value="1">YES</option>
			</select>
	</td>
</tr>

<tr>
<td></td>
<td>
<?php if(in_array('U_contact',$thisPer))
			{
			?>
<input name="Button1" type="button" value="Update" class="buttonGreen" onclick="SaveData('masters/leadstatus/update?id=<?php echo $id;?>&i=<?php echo $_GET['i'];?>','opt','3','<?php echo $_GET['i'];?>','','','2')" />&nbsp;&nbsp;<?php } ?>
<input name="Button1" type="button" value="Cancel" class="button" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>
</div>
