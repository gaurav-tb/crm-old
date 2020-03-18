<?php
include("../include/conFig.php");
$id = $_GET['id'];
$getData = mysql_query("SELECT * FROM `team` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Edit Team
</td>
<td align="right" style="width:70%">
<input name="Button1" type="button" value="< Back To List" class="button" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>
</div>
<div style="padding:20px;" class="form"><table width="100%" cellpadding="0" cellspacing="10">
<tr>
<td align="right">Team Name<span style="color:maroon">*</span></td><td align="left"><input value="<?php echo $row['name'];?>" class="input" name="req" type="text" id="opt0" style="width: 303px"  /></td>
</tr>
<tr>
<td align="right" style="height: 36px">Team Leader Profile<span style="color:maroon">*</span></td>
	<td align="left" style="height: 36px">
	<?php
	$leader = $row['leader'];
	$getProfile = mysql_query("SELECT `profile` FROM `employee` WHERE `id` = '$leader'",$con) or die(mysql_error());
	$rowP = mysql_fetch_array($getProfile);
	
	?>
	
<select name="req" class="input" onchange="if(this.value != ''){getModule('team/getUser?profile='+this.value,'teamUsers','','Teams')}">
				<option value="">Select Profile</option>
			<?php
			$getProfile = mysql_query("SELECT `name`,`id` FROM `profile` WHERE `delete` = '0' AND `name` != 'none'",$con) or die(mysql_error());
			while($rowProfile= mysql_fetch_array($getProfile))
			{
			?>
			<option <?php if($rowP[0] == $rowProfile[1]){ echo "selected='selected'";} ?> value="<?php echo $rowProfile[1] ;?>"><?php echo $rowProfile[0] ;?></option>
			<?php
			}
			?>
			
			</select>
</td>
</tr>
<tr>
<td align="right">Team Leader<span style="color:maroon">*</span></td>
<td id="teamUsers">
<select name="req" title="isNotNull" class="input" id="opt1">
				<option value="">Select Team Leader</option>
			<?php
			$getProfile = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `profile` = '$rowP[0]'",$con) or die(mysql_error());
			while($rowProfile= mysql_fetch_array($getProfile))
			{
			?>
			<option <?php if($row['leader'] == $rowProfile[1]){ echo "selected='selected'";} ?>   value="<?php echo $rowProfile[1] ;?>"><?php echo $rowProfile[0] ;?></option>
			<?php
			}
			?>
			
			</select>

</td>
</tr>

<tr>
<td align="right" valign="top">Team Mates</td>
<td id="teamUsers">
<select name="Select1" class="input" onchange="addToteam(this.value,'opt2')">
				<option value="">Select Team Mates</option>
			<?php
			$getProfile = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' ORDER BY `employee`.`username`",$con) or die(mysql_error());
			while($rowProfile= mysql_fetch_array($getProfile))
			{
			?>
			<option value="<?php echo $rowProfile[1] ;?>**<?php echo $rowProfile[0] ;?>"><?php echo $rowProfile[0] ;?></option>
			<?php
			}
			?>
			
			</select>&nbsp;&nbsp;<span id="reselect"></span>
			<div style="padding:5px;width:500px;" id="selectTeam">
		<?php
$getMates = mysql_query("SELECT employee.name,teamamtes.mateid FROM employee,teamamtes WHERE teamamtes.teamid = '$id' AND teamamtes.mateid = employee.id ORDER BY `employee`.`name` ASC",$con) or die(mysql_error());
while($rowMates = mysql_fetch_array($getMates))
{
?>
<div class="teamMate" id="team<?php echo $rowMates[1];?>"><?php echo $rowMates[0];?>&nbsp;&nbsp;&nbsp;<span style="cursor:pointer" onclick="removeTeam('<?php echo $rowMates[1];?>','opt2')">x</span></div>
<?php
$valPut .= "-".$rowMates[1]."-,";
}		
?>				

		</div>
			<input name="Text1" type="text" value="<?php echo $valPut;?>" id="opt2" style="display:none" />

</td>
</tr>
<tr>
<td align="right" valign="top">Remark</td>

<td align="left">
<textarea name="TextArea1" id="opt3" class="input" style="width: 501px; height: 80px"><?php echo $row['desc'];?></textarea>
</td>
</tr>
<tr>
<td></td>
<td>
<?php 
if(in_array('U_team',$thisPer)) { ?>
<input name="Button1" type="button" value="Update" class="buttonGreen" onclick="SaveData('team/update?id=<?php echo $id; ?>&i=<?php echo $_GET['i'];?>','opt','4','<?php echo $_GET['i'];?>','','','2')" />&nbsp;&nbsp;
<?php } ?>
<input name="Button1" type="button" value="Cancel" class="buttonnegetive" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"/>
</td>
</tr>
</table>
</div>
