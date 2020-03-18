<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$getData = mysql_query("SELECT * FROM `cannottalkto` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
$cannot = explode('-',$row['cannottalkto']);
$cant = str_ireplace(',','',$cannot);
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Edit User Settings
</td>
<td align="right" style="width:70%">
<input name="Button1" type="button" value="< Back To List" class="button" onclick="getModule('chatSettings/cannotTalk/view','viewContent','manipulateContent','Chat Settings')" />
</td>
</tr>
</table>
</div>
<div style="padding:20px;" class="form"><table width="100%" cellpadding="0" cellspacing="10">
<tr>
<td align="right" style="height: 36px">Select Profile<span style="color:maroon">*</span></td>
	<td align="left" style="height: 36px">
	<?php
	$uid = $row['userod'];
	$getProfile = mysql_query("SELECT `profile` FROM `employee` WHERE `id` = '$uid'",$con) or die(mysql_error());
	$rowP = mysql_fetch_array($getProfile);
	
	?>
	
<select name="req" class="input" onchange="if(this.value != ''){getModule('chatSettings/cannotTalk/getUser?profile='+this.value,'teamUsers','','Users')}">
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
<td align="right">User<span style="color:maroon">*</span></td>
<td id="teamUsers">
<select name="req" title="isNotNull" class="input" id="not0">
				<option value="">Select User</option>
			<?php
			$getProfile = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0'",$con) or die(mysql_error());
			while($rowProfile= mysql_fetch_array($getProfile))
			{
			?>
			<option <?php if($row['userid'] == $rowProfile[1]){ echo "selected='selected'";} ?>   value="<?php echo $rowProfile[1] ;?>"><?php echo $rowProfile[0] ;?></option>
			<?php
			}
			?>
			
			</select>

</td>
</tr>

<tr>
<td align="right" valign="top">Can Talk To</td>
<td id="teamUsers">
<select name="Select1" class="input" onchange="addToteam(this.value,'not1')">
				<option value="">Select User/Users</option>
			<?php
			$getProfile = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0'",$con) or die(mysql_error());
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
foreach($cant as $val)
{
		
$getMates = mysql_query("SELECT employee.name FROM employee WHERE employee.id = '$val' AND employee.delete= '0'",$con) or die(mysql_error());
while($rowMates = mysql_fetch_array($getMates))
{
?>
<div class="teamMate" id="team<?php echo $val;?>"><?php echo $rowMates[0];?>&nbsp;&nbsp;&nbsp;<span style="cursor:pointer" onclick="removeTeam('<?php echo $val;?>','not1')">x</span></div>
<?php
$valPut .= "-".$val."-,";
}	
}
?>				

		</div>
			<input name="req" type="text" value="<?php echo $valPut;?>" id="not1" name="req" title="isNotNull" style="display:none" />

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
if(in_array('U_cannottalkto',$thisPer)) { ?>
<input name="Button1" type="button" value="Update" class="buttonGreen" onclick="SaveData('chatSettings/cannotTalk/save?id=<?php echo $id; ?>&i=<?php echo $_GET['i'];?>','not','3','<?php echo $_GET['i'];?>','','','2')" />&nbsp;&nbsp;
<?php } ?>
<input name="Button1" type="button" value="Cancel" class="buttonnegetive" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"/>
</td>
</tr>
</table>
</div>
