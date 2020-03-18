<?php
include("../include/conFig.php");
$value = $_GET['values'];
if($value == 'fname')
{
echo '<input name="Text1" type="text" id="getBox" class = "input" placeholder = "Enter First Name"/>';
}
if($value == 'lname')
{
echo '<input name="Text1" type="text" id="getBox" class = "input" placeholder = "Enter Last Name"/>';
}
if($value == 'mobile')
{
echo '<input name="Text1" type="text" id="getBox" class = "input" placeholder = "Enter Mobile Number"/>';
}
if($value == 'email')
{
echo '<input name="Text1" type="text" id="getBox" class = "input" placeholder = "Enter Email Address"/>';
}
if($value == 'inroducer')
{
echo '<input name="Text1" type="text" id="getBox" class = "input" placeholder = "Enter Introducer Code"/>';
}
if($value == '%brokerage')
{
echo '<input name="Text1" type="text" id="getBox" class = "input" placeholder = "Enter % brokerage"/>';
}
if($value == 'firsttrade')
{
echo '<input name="Text1" type="date" id="getBox" class = "input" placeholder = "Enter First Trade Date"/>';
}
if($value == 'traderprofile')
{
?>
<select class="input" title="isNotNull" style="width: 210px" id="getBox">
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
<?php
 }

if($value == 'experience')
{
?>
<select class="input" title="isNotNull" style="width: 210px" id="getBox">
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
<?php
 }

 if($value == 'invamount')
{
?>
<select class="input" title="isNotNull" style="width: 210px" id="getBox">
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
<?php
 }
 
if($value == 'website')
{
echo '<input name="Text1" type="text" id="getBox" class = "input" placeholder = "Enter Website"/>';
}

if($value == 'leadstatus')
{?>
<select name="Select1" title="isNotNull" id="" style="width:210px"  class="input" onchange="addToteam(this.value,'getBox')">
				<option value="">Select Lead Status</option>
			<?php
			$getProfile = mysql_query("SELECT `name`,`id` FROM `leadstatus` WHERE `delete` = '0'",$con) or die(mysql_error());
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
			<input name="Text1" type="text" value="" id="getBox" style="display:none" />
<?php }
if($value == 'leadsource')
{?>
<select class="input" title="isNotNull"  style="width: 210px" id="getBox">
				
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `leadsource` WHERE `delete` = '0' order by name ASC",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>
<?php }
if($value == 'latestresponse')
{?>
<select class="input" title="isNotNull"  style="width: 210px" id="getBox" >
<option value="0">Select Response</option>
				
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `leadresponse` WHERE `delete` = '0' and display IN(1,2) ORDER BY `order` asc",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>
<?php }
if($value == 'callbackdate')
{
echo '<input  style="width: 200px" class="input" type="date" id="getBox" placeholder = "Enter Call Back Date"/>';
}
if($value == 'revenue')
{
echo '<input name="Text1" type="text" id="getBox" class = "input" placeholder = "Enter Expected Revenue"/>';
}
if($value == 'conversiondate')
{
echo '<input  style="width: 200px" class="input" type="date" id="getBox" placeholder = "Enter Expected Conversion Date"/>';
}
if($value == 'address')
{
echo '<textarea name="TextArea1" cols="20" rows="2" id="getBox" placeholder = "Enter Address" style=width:300px;height:50px></textarea>';
}
if($value == 'city')
{ ?>
<select class="input" title="isNotNull"  style="width: 210px" id="getBox" >
				
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
<?php
}

if($value == 'description')
{
echo '<textarea name="TextArea1" cols="20" rows="2" id="getBox" placeholder = "Enter Description" style=width:300px;height:50px></textarea>';
}

