<?php
include("../include/conFig.php");
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Add New Lead
</td>
<td align="right" style="width:70%">
<input name="Button1" type="button" value="< Back To List" class="button" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>
</div>
<div class="form">
<table width="100%" cellpadding="0" cellspacing="10">
<tr>
	<td align="right" style="height: 29px">
	Lead Owner
	</td>
	<td style="width: 303px">
	<input name="Text1" type="text" id="opt0" class="inputDisabled" value="<?php echo $loggedname;?>" />
	</td>
</tr>
<tr>
<td align="right">First Name *</td><td style="width: 303px">
	<input class="input"  style="width: 200px" name="req" type="text" id="opt1"/></td>
<td align="right" style="height: 32px; width: 208px;">Last Name *</td>
	<td align="left"><input class="input"  style="width: 200px" name="req" type="text" id="opt2" /></td>
</tr>
<tr>
	<td align="right" style="height: 32px">Phone</td>
	<td align="left" style="width: 303px; height: 32px;"><input class="input"  style="width: 200px" type="text" id="opt3" /></td>
	<td align="right" style="height: 32px; width: 208px;">Mobile  *</td>
	<td align="left" style="height: 32px"><input class="input"  style="width: 200px" name="reqismob" type="text" id="opt4" /></td>

</tr>
<tr>
	<td align="right">Email</td><td align="left" style="width: 303px"><input class="input"  style="width: 200px" name="text1" type="text" id="opt5" /></td>
	<td align="right" style="width: 208px">Website</td><td align="left"><input class="input"  style="width: 200px" name="text1" type="text" id="opt6" /></td>

</tr>
<tr>
	<td align="right" style="height: 35px">Lead Status  *</td>
	<td align="left" style="height: 35px; width: 303px;">

<select class="input" name="req" style="width: 200px" id="opt7">
				
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `leadstatus` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>

	</td>
	
	<td align="right" style="height: 35px; width: 208px;">Lead Source  *</td>
	<td align="left" style="height: 35px">

<select class="input" name="req" style="width: 200px" id="opt8">
				
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `leadsource` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>

	</td>

</tr>

<tr>
	<td align="right" style="height: 36px">Latest Response  *</td>
	<td align="left" style="height: 36px; width: 303px;">

<select class="input" name="req" style="width: 200px" id="opt9">
				
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `leadresponse` WHERE `delete` = '0'  AND (`display` = '2' OR `display` = '0') ORDER BY `order` ASC",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>

	</td>
	<td align="right" style="width: 208px">Call Back Date</td><td align="left"><input class="input"  style="width: 200px" name="req" type="text" id="opt10" /></td>
	
	
</tr>

<tr>
	<td align="right" style="width: 208px; height: 32px;">Messenger ID  *</td>
	<td align="left" style="width: 303px; height: 32px;"><input class="input" name="req" style="width: 200px" name="text1" type="text" id="opt11" /></td>

</tr>
<tr>
		<td align="right" valign="top" style="height: 31px">
		Services
		</td>
		<td colspan="3">

		<?php
		$h= 15;
$getProduct = mysql_query("SELECT `name`,`id` FROM `product` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowproduct = mysql_fetch_array($getProduct ))
{
?>
<input name="Checkbox1" type="checkbox" id="<?php echo 'opt'.$h;?>" value="<?php echo $rowproduct[1] ?>" /> <?php echo $rowproduct[0] ?>
<br/>
<?php
$h++;
}
?>

		
		

		
		</td>
		<td>
		
		
		</td>

</tr>
</table>
	<div class="moduleHeading">
	<table  width="100%" cellpadding="0" cellspacing="0">

<tr>
<td colspan="2" style="width:100%;">

	Address Details
	
	</td>
	<td></td>
</tr>
</table>
</div>
<table  width="100%" cellpadding="0" cellspacing="10" class="form">
<tr>
<td align="right" valign="top" style=" width: 96px;">Address</td>
<td>
<textarea name="TextArea2" id="opt12" class="input"  style="width: 700px;height:110px;"  ></textarea></td>


<tr>
<td align="right">City</td>
	<td align="left" style="width: 500px; height: 36px;">

<select name="Select1" class="input"  style="width: 200px" id="opt13">
				
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `city` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>

</td>

</tr>


</table>
</div>
<div class="moduleHeading">
	<table  width="100%" cellpadding="0" cellspacing="0">

<tr>
<td colspan="2" style="width:100%;">

	Description
	
	</td>
	<td></td>
</tr>
</table>
</div>
<table  width="100%" cellpadding="0" cellspacing="10" class="form">
<tr>
<td align="right" valign="top" style=" width: 96px;">Description</td>
<td>
<textarea name="TextArea2" id="opt14" class="input"  style="width: 700px;height: 101px;" ></textarea></td>


<tr>
<tr>
<td style="width: 59px"></td>
<td style="width: 500px">
<input name="Button2" type="button" value="Save & New" class="buttonGreen" onclick="SaveData('leads/save','opt','<?php echo $h;?>','','','','1')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Save & Back" class="buttonGreen" onclick="SaveData('leads/save','opt','<?php echo $h;?>','','','','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Cancel" class="buttonnegetive" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"/>
</td>
</tr>
</table>


