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
	<td align="right" style="">
	Lead Owner
	</td>
	<td style="">
	<input name="Text1" title="isNotNull" type="text" id="opt0" class="inputDisabled" value="<?php echo $loggedname;?>" />
	</td>
</tr>
<tr>
<td align="right" style="">First Name *</td><td>
	<input class="input"  style="text-transform:capitalize;width:200px" name="req" type="text" id="opt1"/></td>
<td align="right" style="width: 208px;">Last Name</td>
	<td align="left"><input class="input" style="text-transform:capitalize;width:200px" type="text" id="opt2" /></td>
</tr>
<tr>
	<td align="right" style="display:none">Phone</td>
	<td align="left" style="; height: 32px;display:none"><input class="input"  style="width: 200px" type="text" id="opt3" /></td>
	<td align="right" style="width: 208px;">Mobile  *</td>
	<td align="left" style="height: 32px">
	<div style="position:relative">
	<input class="input"  style="width: 200px" name="req" maxlength="10" type="text" id="opt4" onblur="autoCheck('contact','mobile',this.value,'ccav0')" />
	<div id="ccav0" title="Mobile Number" style="position:absolute;top:20px;"></div>
	</div>
	</td>


	<td align="right" style="">Email</td><td align="left" style=""><input class="input"  style="width: 200px" name="text1" type="text" id="opt5" /></td>
	<td align="right" style="width: 208px;display:none">Alternate Email</td><td align="left" style="display:none"><input class="input"  style="width: 200px" name="text1" type="text" id="opt17" /></td>

</tr>
<tr>
	<td align="right" style="display:none">Date of Birth</td>
	<td align="left" style="display:none">

<input  style="width: 200px" class="input" type="date" id="opt18" />
	</td>
	
	<td align="right" style="width: 208px;display:none">Trader's Profile</td>
	<td align="left" style="display:none">

<select class="input" title="" style="width: 200px" id="opt19">
				
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `traderprofile` WHERE `delete` = '0'",$con) or die(mysql_error()); 
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
	<td align="right" style="width: 208px;display:none">Trader's Experience</td>
	<td align="left" style="display:none">

<select class="input" title=""  style="width: 200px" id="opt20">
				
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `traderexp` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>

	</td>

	<td align="right" style="width: 208px;display:none">Investment Amount</td>
	<td align="left" style="display:none">

<select class="input" title=""  name="" style="width: 200px" id="opt21">
				
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `traderamt` WHERE `delete` = '0'",$con) or die(mysql_error()); 
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
	<td align="right" style=";display:none" valign="top">Website</td>
	<td align="left" style=";display:none" valign="top">
<input name="Text1" type="text" value="" class="input" id="opt6" />

	</td>
	<td align="right" style=";" valign="top">Lead Status  *</td>

<td id="teamUsers">
<select name="req" class="input" onchange="addToteam(this.value,'opt7')">
			 <option value="">Select Lead Status</option>
			 <?php
			$getProfile = mysql_query("SELECT `name`,`id` FROM `leadstatus` WHERE `delete` = '0' order by id desc",$con) or die(mysql_error());
			while($rowProfile= mysql_fetch_array($getProfile))
			{
			?>
			<option value="<?php echo $rowProfile[1] ;?>**<?php echo $rowProfile[0] ;?>"><?php echo $rowProfile[0] ;?></option>
			<?php
			}
			?>
			
			</select>&nbsp;&nbsp;<span id="reselect"></span>
			<div style="padding:5px;" id="selectTeam">
						</div>
			<input name="req" type="text" value="" id="opt7" title="isNotNull" style="display:none" />

</td>	
	
</tr>



<tr>
	<td align="right" style=";">Lead Source  *</td>
	<td align="left" style=";">

<select class="input leadsourcedropdown"  name="req" style="width: 200px" id="opt8">
<!-- 	<option value="">Select Lead Source</option>			
 -->
 <?php
/* if($perm == '4' || $perm == '5')
{
$getCity = mysql_query("SELECT `name`,`id` FROM `leadsource` WHERE `delete` = '0' AND `disp` = '1'",$con) or die(mysql_error()); 	
}
else
{
$getCity = mysql_query("SELECT `name`,`id` FROM `leadsource` WHERE `delete` = '0'",$con) or die(mysql_error()); 	
} */

if($perm==1)
{
$getCity = mysql_query("SELECT `name`,`id` FROM `leadsource` WHERE `delete` = '0'",$con) or die(mysql_error()); 
}
else
{
$getCity = mysql_query("SELECT `name`,`id` FROM `leadsource` WHERE `delete` = '0' and `disp`= '1'order by id asc",$con) or die(mysql_error()); 
}

while($rowCity = mysql_fetch_array($getCity))
{
?>
<option <?php if($rowCity[1]=='40') { echo 'selected="selected"'; } ?> value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>

	</td>

	<td align="right" style=";">Latest Response  *</td>
	<td align="left" style=";">

<select class="input"  name="req" style="width: 200px" id="opt9">
<!-- 	<option value="">Select Latest response</option>			
 -->
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `leadresponse` WHERE `delete` = '0' AND (`display` = '1' OR `display` = '0') ORDER BY `order` ASC",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option <?php if($rowCity[1]=='1') { echo 'selected="selected"'; } ?> value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>

	</td>
</tr>
<tr style="display:none">
	<td align="right" style="width: 208px;display:none">Expected Conversion Date</td><td align="left">
	<input  style="width: 200px;position:relative;display:none" class="input" type="date" id="opt16" />
	</td>
	<td align="right" style=";display:none">Messenger ID</td>
	<td align="left" style=";display:none"><input class="input" style="width: 200px" name="text1" type="text" id="opt11" /></td>
</tr>
<tr>
	<td align="right" style="width: 208px">Call Back Date</td><td align="left"><input  style="width: 200px" class="input" type="date" value="<?php echo date('Y-m-d'); ?>" id="opt10" /></td>
	<td align="right" style=";display:none">Expeceted Revenue</td>
	<td align="left" style=";display:none">
	<input name="Text1" type="text" value="" class="input" id="opt15" />

	</td>
	<td align="right" style="width: 208px;display:none">Language</td>
	<td align="left" style="display:none">

<select class="input" style="width: 200px;" id="opt22">
				
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `language` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
	</select>

	</td>
	<td align="right" style=";">Introducer Client Code</td>
	<td align="left" style=";">
	<div style="position:relative">
		<input class="introducerclientcode" style="width: 200px" name="text1" type="text" id="opt23" onblur="CheckIntroducer('opt23','0','ccav23')">
		<div id="ccav23" title="Introducer" style="position:absolute;top:30px;"></div>
	</div>

	</td>

</tr>
<tr>
		<td align="right" valign="top" style="height: 31px; display:none;">
		Services
		</td>
		<td style="font-size:11px;display:none">
			<table cellpadding="0" cellspacing="5">
				<tr>
					<?php
					$h= 25;
					$g=0;
					$getProduct = mysql_query("SELECT `name`,`id` FROM `category` WHERE `delete` = '0' AND `id` != '1' ORDER BY `name` ASC",$con) or die(mysql_error()); 
					while($rowproduct = mysql_fetch_array($getProduct))
					{
					?>
					<td>
					<input name="Checkbox1" type="checkbox" id="<?php echo 'opt'.$h;?>" value="<?php echo $rowproduct[1] ?>" > <?php echo $rowproduct[0] ?></td>
				
			<?php
			if($g%2 != 0)
			{
			echo "</tr><tr>";
			}
			$g++;
			$h++;
			}
			?>
			</table>
		</td>
		<td align="right" style=";display:none">Feedback *</td>
		<td align="left" style=";display:none">
			<select class="input"  name="" style="width: 200px" id="opt24">
				<option value="">Select Feedback</option>			
				<?php
				$getFDBK = mysql_query("SELECT `name`,`id` FROM `feedback` WHERE `delete` = '0'",$con) or die(mysql_error()); 
				while($rowFDBK = mysql_fetch_array($getFDBK))
				{
				?>
				<option value="<?php echo $rowFDBK[1];?>"><?php echo $rowFDBK[0];?></option>
				<?php
				}
				?>
			</select>
		</td>

		<td>
		
		
		</td>

</tr>
</table>


<div class="moduleHeading">
<!-- <table  width="100%" cellpadding="0" cellspacing="0">
<tr>
<td colspan="2" style="width:100%;border:0px;">

	Address Details
	
	</td>
	<td></td>
</tr>
</table>
 --></div>

<table  width="100%" cellpadding="0" cellspacing="10">
<!-- <tr>
<td align="right" valign="top" style="width: 169px">Address</td>
<td colspan="3">
<textarea name="TextArea2" id="opt12" class="input"  style="width: 700px;height:110px;"  ></textarea></td>


<tr>
<td align="right">State</td>
	<td colspan="" align="left" style="width: 500px;">

<select name="Select1" class="input"  style="width: 200px" id="state" onchange="getModule('leads/getCity?id=opt13&state='+this.value,'getCity','',document.title)">
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
City
</td>
<td>
<span id="getCity" style="display:inline">
<select name="Select1" id="opt13" class="input">
				<option value="1">Select State First</option>
			</select>
</span>

</td>

</tr>

<tr>
<td align="right" valign="top">Description</td>
<td>
<textarea name="TextArea2" id="opt14" class="input"  style="width: 700px;height: 101px;" ></textarea></td>
</tr>
 -->
<tr>
<td style="width: 59px"></td>
<td style="width: 500px">
<input name="Button2" type="button" value="Save & New" class="buttonGreen" onclick="SaveData('leads/save','opt','<?php echo $h;?>','','','','1')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Save & Back" class="buttonGreen" onclick="SaveData('leads/save','opt','<?php echo $h;?>','','','','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Cancel" class="buttonnegetive" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></div>

