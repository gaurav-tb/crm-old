<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$getData = mysql_query("SELECT * FROM `allotmentrules` WHERE `id` = '$id'",$con) or die(mysql_error());
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
<div style="padding:20px;" class="form">

<table width="100%" cellpadding="0" cellspacing="10">
<tr>
<td align="right" valign="top">From Profile<span style="color:maroon">*</span></td>
<td align="left"><select id="opt0"  class="input" name="req" style="width: 200px">
				
	<?php
		$getProfile  =mysql_query("SELECT `name`,`id` FROM `profile` WHERE `delete` = '0'",$con) or die(mysql_error());
		while($rowProfile = mysql_fetch_array($getProfile))
		{
		?>
		<option <?php if($rowProfile[1] == $row['from']) echo "selected='selected'";  ?> value="<?php echo $rowProfile[1];?>"><?php echo $rowProfile[0];?></option>
		
		<?php
		}
		?>

			</select></td>
</tr>
<tr>
<td align="right" valign="top">To Profile<span style="color:maroon">*</span></td>
<td id="teamUsers">
<select name="Select1" style="width:200px" class="input" onchange="addToteam(this.value,'opt1')">
				<option value="">Select Profile</option>
			<?php
			$getProfile = mysql_query("SELECT `name`,`id` FROM `profile` WHERE `delete` = '0'",$con) or die(mysql_error());
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
$toPro = '';
$toProfile = explode(',',$row['to']);
$toPro = str_ireplace('-','',$toProfile);
	foreach($toPro as $val)
	{
		if($val != '')
		{
		
		$getToProfiles = mysql_query("SELECT `name` FROM `profile` WHERE `id` = '$val' AND `delete` = '0'",$con) or die(mysql_error()); 
			while($rowTo =  mysql_fetch_array($getToProfiles))
			{
			?>
<div class="teamMate" id="team<?php echo $val;?>"><?php echo $rowTo[0];?>&nbsp;&nbsp;&nbsp;<span style="cursor:pointer" onclick="removeTeam('<?php echo $val;?>','opt1')">x</span></div>
<?php

			}
		}
	}
		
		
{
$valPut .= "-".$rowMates[1]."-,";
   }		
?>				

		</div>
			<input name="Text1" type="text" value="<?php echo $row['to'];?>" id="opt1" style="display:none" />

</td>
			
</tr>

<tr>
<td></td>
<td>
<?php if(in_array('U_allot',$thisPer))
			{
			?>
<input name="Button1" type="button" value="Update" class="buttonGreen" onclick="SaveData('masters/allotmentrules/update?id=<?php echo $id;?>&i=<?php echo $_GET['i'];?>','opt','2','<?php echo $_GET['i'];?>','','','2')" />&nbsp;&nbsp;<?php } ?>
<input name="Button1" type="button" value="Cancel" class="button" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>

