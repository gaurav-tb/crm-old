<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$getData = mysql_query("SELECT * FROM `template` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Edit Messenger/SMS Template
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
<td align="right">Template Name<span style="color:maroon">*</span></td>
	<td align="left"><input class="input" name="req" type="text" id="opt0" value="<?php echo $row['name'];?>" /></td>
</tr>
<tr>
<td align="right" style="vertical-align:top">Template<span style="color:maroon">*</span></td>
<td align="left"><textarea style="height:50px;width:300px" cols="20" id="opt1" name="req" rows="2"><?php echo str_ireplace("<br/>","\r\n",$row['template']);?></textarea>
</td>
</tr>
<tr>
<td align="right">
Is this a Messenger Template* 
</td>
<td>
<select id="opt2" name="req" class="input" style="width:60px">
	<option value="">Y/N</option>
	<option <?php if($row['messenger']== '1') {echo 'selected==selected';}?> id="yes" value="1">YES</option>
	<option <?php if($row['messenger']== '0') {echo 'selected==selected';}?> id="no" value="0">NO</option>
</select>
</td>
</tr>
<tr>
<td></td>
<td>
<?php if(in_array('U_template',$thisPer))
			{
			?>
<input name="Button1" type="button" value="Update" class="buttonGreen" onclick="SaveData('masters/template/update?id=<?php echo $id;?>&i=<?php echo $_GET['i'];?>','opt','3','<?php echo $_GET['i'];?>','','','2')" />&nbsp;&nbsp;<?php } ?>
<input name="Button1" type="button" value="Cancel" class="button" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>
</div>
