<?php
include("../include/conFig.php");
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Add New User
</td>
<td align="right" style="width:70%">
<input name="Button1" type="button" value="< Back To List" class="button" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>
</div>
<div class="form">
<table width="100%" cellpadding="0" cellspacing="10" class="form">
<tr>
<td align="right">Username *</td><td>
	<input class="input" name="req" type="text" id="opt0" onblur="autoCheck('employee','username',this.value,'ccav0')" style="width: 200px" /><span id="ccav0" title="Username"></span></td>
<td align="right" style="width: 128px">Password *</td><td align="left"><input class="input" name="req" type="text" id="opt1" style="width: 200px" /></td>
</tr>
<tr>
<td align="right">Name  *</td><td align="left"><input class="input" style="text-transform:capitalize;" name="req" type="text" id="opt2" style="width: 200px" /></td>

<td align="right" style="">Profile  *</td>
	<td align="left"  style="width: 500px; ;" >
	<select id="opt3" class="input" name="req" title="isNotNull"  style="width: 200px">
				
		<?php
		$getProfile  =mysql_query("SELECT `name`,`id` FROM `profile` WHERE `delete` = '0' ORDER BY `name` ASC",$con) or die(mysql_error());
		while($rowProfile = mysql_fetch_array($getProfile))
		{
		?>
		<option value="<?php echo $rowProfile[1];?>"><?php echo $rowProfile[0];?></option>
		
		<?php
		}
		?>

			</select></td>

</tr>


<tr>
<td align="right">Daily Fetch</td><td align="left"><input class="input" name="" type="text" id="opt13" style="width: 200px" /></td>

<td align="right">Per Fetch Limit</td><td align="left"><input class="input" name="" type="text" id="opt15" style="width: 200px" /></td>

</tr>
<tr>
	<td align="right" style="">Salary </td>
	<td align="left"  style="width: 500px; ;" >
		<input class="input" name="" type="text" id="opt14" style="width: 200px" />
	</td>
	<td align="right" style="">Lead fetch source </td>
	<td align="left"  style="width: 500px; ;" >
		<select name="" class="input"  style="width: 200px" id="opt16" >
			<option value="1">Select State</option>			
			<?php
				$getLeadsource = mysql_query("SELECT `name`,`id` FROM `leadsource` WHERE `delete` = '0'",$con) or die(mysql_error()); 
				while($rowLeadsource = mysql_fetch_array($getLeadsource)) {
				?>
					<option value="<?php echo $rowLeadsource[1];?>" ><?php echo $rowLeadsource[0];?></option>
				<?php
				}
			?>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;
	</td>
</tr>

<tr>
<td align="right">Status</td>
	<td align="left" style="width: 500px">
	<input name="Checkbox1" type="checkbox" value="1" id="opt4">
	<span>Active</span>
	</td>
	<td align="right">IP Not restricted</td>
	<td align="left" style="width: 500px">
	<input name="Checkbox1" type="checkbox" value="1" id="opt12">
	
	</td>

</tr>
<tr>
<td align="right">Email</td><td align="left" style="width: 500px"><input class="input" type="text" id="opt5" style="width: 200px" /></td>
<td align="right" style="width: 128px">Phone</td><td align="left"><input class="input"  type="text" id="opt6" style="width: 200px" /></td>
</tr>
<tr>
<td align="right" style="height: 32px">Mobile  *</td>
	<td align="left" style="height: 32px; width: 500px;"><input class="input" name="reqismob" type="text" id="opt7" style="width: 200px" /></td>

	<td align="right" style="height: 32px; width: 128px;">Date of Joining</td>
	<td align="left" style="height: 32px"><input class="input" type="date" id="opt8" style="width: 200px" /></td>

</tr>
<tr>
<td align="right" style="height: 32px">Employee Code  *</td>
<td align="left" style="height: 32px; width: 500px;"><input class="input" name="employee_code" type="text" id="opt17" style="width: 200px" /></td>
</tr>
<tr>
<td></td>
<td style="width: 500px">
<input name="Button2" type="button" value="Save & New" class="buttonGreen" onclick="SaveData('user/save','opt','18','','','','1')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Save & Back" class="buttonGreen" onclick="SaveData('user/save','opt','18','','','','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Cancel" class="buttonnegetive" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"/>
</td>
</tr>
</table>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
