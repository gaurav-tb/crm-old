<?php
include("../include/conFig.php");
$id = $_GET['id'];
$getData = mysql_query("SELECT * FROM `employee` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Edit User
</td>
<td align="right" style="width:70%">
<input name="Button1" type="button" value="Tips Permission" class="buttonBlue" onclick="getModule('user/tipsPer?id=<?php echo $id;?>&name=<?php echo $row['name'];?>','manipulatemoodleContent','viewmoodleContent','Tips Permission')"/>
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
<div style="background:#eee" class="form">
<table width="100%" cellpadding="0" cellspacing="10" class="form">
<tr>
<td align="right" style="">Username *</td><td style=""><input class="input" name="req" type="text" id="opt0" value="<?php echo $row['username'];?>"/></td>
<td align="right" style="width:128px">Password *</td>
	<td align="left" style=""><input class="input" name="req" type="text" id="opt1"  value="<?php echo $row['password'];?>" /></td>
</tr>
<tr>
<td align="right">Name  *</td><td align="left"><input class="input" style="text-transform:capitalize;" name="req" type="text" id="opt2"  value="<?php echo $row['name'];?>" /></td>

<td align="right">Profile  *</td>
	<td align="left"  name="" style="width: 500px"  >
	<select id="opt3"  class="input" name="req" title="isNotNull" style="width: 152px" >
				
	<?php
		$getProfile  =mysql_query("SELECT `name`,`id` FROM `profile` WHERE `delete` = '0'",$con) or die(mysql_error());
		while($rowProfile = mysql_fetch_array($getProfile))
		{
		?>
		<option <?php if($rowProfile[1] == $row['profile']) echo "selected='selected'";  ?> value="<?php echo $rowProfile[1];?>"><?php echo $rowProfile[0];?></option>
		
		<?php
		}
		?>

			</select></td>

</tr>
<tr>
<td align="right">Daily Fetch</td><td align="left"><input class="input" name="" value="<?php echo $row['poolfetch'];?>" type="text" id="opt13" style="width: 200px" /></td>
<td align="right">Per Fetch Limit</td><td align="left"><input class="input" name="" value="<?php echo $row['perfetch'];?>" type="text" id="opt15" style="width: 200px" /></td>

</tr>
<tr>
	<td align="right" style="">Salary </td>
	<td align="left"  style="width: 500px; ;" >
		<input class="input" value="<?php echo $row['salary'];?>"  name="" type="text" id="opt14" style="width: 200px" />
	</td>
	<td align="right" style="">Lead fetch source </td>
	<td align="left"  style="width: 500px; ;" >
		<select name="" class="input"  style="width: 200px" id="opt16" >
			<option value="">Select State</option>			
			<?php
				$getLeadsource = mysql_query("SELECT `name`,`id` FROM `leadsource` WHERE `delete` = '0'",$con) or die(mysql_error()); 
				while($rowLeadsource = mysql_fetch_array($getLeadsource)) {
				?>
					<option value="<?php echo $rowLeadsource[1];?>" <?php if($row['poolfetchsource'] == $rowLeadsource[1]) { echo "selected";} ?> ><?php echo $rowLeadsource[0];?></option>
				<?php
				}
			?>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;
	</td>
</tr>
<tr>
<td align="right">Status</td>
	<td align="left" style="width: 500px">
	<input name="Checkbox1" type="checkbox" value="1" id="opt4" <?php if($row['status'] == '1') echo "checked='checked'";?>>
	<span>Active</span>
	</td>
	<td align="right">IP Not restricted</td>
	<td align="left" style="width: 500px">
	<input name="Checkbox1" type="checkbox" value="1" id="opt12" <?php if($row['IPper'] == '1') echo "checked='checked'";?>>
	
	</td>
</tr>
<tr>
<td align="right" style="">Email</td>
	<td align="left" style="width: 500px; ;"><input class="input" type="text" id="opt5"  value="<?php echo $row['email'];?>"/></td>
<td align="right" style="">Phone</td>
	<td align="left" style=""><input class="input" type="text" id="opt6"  value="<?php echo $row['phone'];?>"/></td>
</tr>
<tr>
<td align="right" style="">Mobile  *</td>
	<td align="left" style="; width: 500px;"><input class="input" type="text" id="opt7"  value="<?php echo $row['mobile'];?>"/></td>

<td align="right" style="">Calling Extension</td>
	<td align="left" style=""><input class="input" type="text" id="opt28"  value="<?php echo $row['callingextension'];?>" /></td>

	
	</tr>
<tr>

<td align="right" style="">Landing number 2  </td>
	<td align="left" style="; width: 500px;"><input class="input"  type="text" id="opt8"  value="<?php echo $row['landing_number_2'];?>"/></td>


<td align="right" style="">Landing number 3 </td>
	<td align="left" style=""><input class="input" type="text" id="opt11"  value="<?php echo $row['landing_number_3'];?>" /></td>

</tr>

<tr>
<td align="right" style="">Landing number 4  </td>
	<td align="left" style="; width: 500px;"><input class="input"  type="text" id="opt10"  value="<?php echo $row['landing_number_4'];?>"/></td>
</tr>

<!-- <tr>
<td align="right" valign="top" style="height: 50px">Address</td>
	<td align="left" style="width: 500px; height: 50px;" colspan="3">
<textarea name="TextArea2" id="opt9" class="input" style="width: 500px;height:85px" ><?php echo $row['address'];?></textarea>

</td>
</tr>
<tr>
<td align="right">State</td>
	<td colspan="" align="left" style="width: 500px;">

<select name="" class="input"  style="width: 200px" id="state" onchange="getModule('leads/getCity?id=opt10&state='+this.value,'getCity','',document.title)">
	<option value="">Select State</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `state` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>&nbsp;&nbsp;&nbsp;&nbsp;
			
</td>

</tr>
<tr>
<td align="right">
City</td>
<td>
<span id="getCity" style="display:inline">
<select name="" class="input"  style="width: 200px" id="opt10">
				
<?php
$cityId = $row['city'];
$getCity = mysql_query("SELECT `name`,`id` FROM `city` WHERE `delete` = '0' and `id` = '$cityId'",$con) or die(mysql_error()); 
$rowCity = mysql_fetch_array($getCity);
?>
<option <?php if($rowCity[1] == $row['city']) echo "selected='selected'"; ?> value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
			</select>&nbsp;&nbsp;&nbsp;To update City select State first.
</span>

</td>

</tr>

<tr>
<td align="right" valign="top" style="height: 50px">Comments/Remarks</td>
	<td align="left" style="width: 500px; height: 50px;" colspan="3">
<textarea name="TextArea2" id="opt11" class="input" style="width: 500px; height: 85px;" ><?php echo $row['comments'];?></textarea>

</td>
</tr> -->
<tr>
<td></td>
<td><input name="Button1" type="button" value="Update" class="buttonGreen" onclick="SaveData('user/update?id=<?php echo $id;?>&i=<?php echo $_GET['i'];?>','opt','29','<?php echo $_GET['i'];?>','','','2')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Cancel" class="buttonnegetive" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"/>
</td>
</tr>
</table>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
