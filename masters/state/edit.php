<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$getData = mysql_query("SELECT * FROM `state` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Edit State Name
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
<td align="right" style="height: 36px">State Name<span style="color:maroon">*</span></td>
	<td align="left" style="height: 36px"><input class="input" name="req" type="text" id="opt0" value="<?php echo $row[0];?>" style="width: 300px"  /></td>
</tr>
<tr>
<td align="right" valign="top">Country Name
</td><td align="left">
<select name="select1" id="opt1" class="input"  style="width: 300px" > 
		<?php
		$getClient=mysql_query("SELECT * FROM  `country` WHERE `delete` = '0' AND `id` != '1'",$con)or die(mysql_error());
		while($fetchClient=mysql_fetch_array($getClient))
		{
		?>
		<option <?php if($fetchClient[4] == $row[0]){echo "selected=selected";}?> value="<?php echo $fetchClient[4]?>"><?php echo  $fetchClient[0]?></option>
		<?php
		}
		?>		
			
			</select>
</td>
</tr>
<tr>
<td></td>
<td><?php
			if(in_array('U_state',$thisPer))
			{
			?>
<input name="Button1" type="button" value="Update" class="buttonGreen" onclick="SaveData('masters/state/update?id=<?php echo $id;?>&i=<?php echo $_GET['i'];?>','opt','2','<?php echo $_GET['i'];?>','','','2')" />&nbsp;&nbsp;<?php } ?>
<input name="Button1" type="button" value="Cancel" class="button" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>
</div>
