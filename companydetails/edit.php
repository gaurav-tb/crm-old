<?php
include("../../include/conFig.php");
//$id = $_GET['id'];
//echo "SELECT * FROM `company` WHERE `id` = '$id'";
$getData = mysql_query("SELECT * FROM `company` WHERE `id` = '1'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="moduleHeading">Organisation Details</div>
<div style="padding:20px;" class="form">
<table width="100%" cellpadding="0" cellspacing="10">
<?php
if($error)
{
?>
<tr><td colspan="4" style="text-align:center; height: 29px;"><?php echo $error;?></td></tr>
<?php
}
?>
<div style="float:right"><img id="sublogo" src="<?php echo str_ireplace("../","",$row['logo'])?>" title="Change Logo"  style="width:100px; vertical-align:middle;border:0px; cursor:pointer" onclick="getModule('masters/companydetails/changeLogo','viewmoodleContent','','Change Logo')"  />
</div>

<tr>
	<td>
	Company Name *
	</td>
	<td>
	<input class="input" style="width:200px" name="cname" id="opt0" type="text" value="<?php echo $row['name'] ?>"/>
	</td>
	<td>
	
	</td>
	<td>
	</td>
</tr>
<tr>
	<td>
	Address Line 1 *
	</td>
	<td>
			<input id="opt1" class="input" type="text" style="width:200px" value="<?php echo $row['adr1']?>">
&nbsp;</td>
	<td>
	Address Line 2
	</td>
	<td>

		<input type="text" id="opt2" class="input" style="width:200px" value="<?php echo $row['adr2']?>"></td>
</tr>
<tr>
<td>Email</td>
<td><input class="input" name="Text1" id="opt3" type="text" value="<?php echo $row['email']?>" style="width:200px" /></td>
	<td>
	City *
	</td>
	<td>

<select name="Select1" id="opt4" class="input"  style="width: 200px" id="opt13">
				
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `city` WHERE `delete` = '0' AND `id` != '1'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option <?php if($rowCity[1] == $row['city']) echo "selected='selected'"; ?> value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>

<?php
}
?>
			</select>

	</td>
	</tr>
	<tr>
	<td>
	State *
	</td>
	<td>
	<select name="select1" id="opt5" class="input"  style="width: 200px" > 
		<?php
		$getClient=mysql_query("SELECT `id`,`name` FROM  `state` WHERE `delete`=  '0'  AND `id` != '1' ",$con)or die(mysql_error());
		while($fetchClient=mysql_fetch_array($getClient))
		{
		?>
		<option <?php if($fetchClient[0] == $row['state']){echo "selected=selected";}?> value="<?php echo $fetchClient[0]?>"><?php echo  $fetchClient[1]?></option>
		<?php
		}
		?>		
			
			</select>
</td>
	<td>
	Country *
	</td>
	<td>
<select name="select2" id="opt6" class="input"  style="width: 200px" > 
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
	</td></tr>
	<tr>
	<td>
	Pin Code *
	</td>
	<td>
	<input class="input" name="pincode" id="opt7" type="text" value="<?php echo $row['pincode']?>" />
	</td>

	
	<td>
	Pan Number *
	</td>
	<td>
	<input class="input" name="panno" id="opt8" type="text" value="<?php echo $row['pan'] ?>" />
	</td>
</tr>
<tr>
<td style="height: 36px">
	Foot Note
	</td>
	<td colspan="2" style="height: 36px">
	<input class="input" name="footnote" id="opt9" type="text" value="<?php echo $row['footnote'] ?>" style="width: 300px"/>
	</td>

</tr>
<tr>
<td></td>
<td>
<?php if(in_array('U_org',$thisPer)) { ?>
<input class="buttonGreen" name="Button1" type="button" value="Update" onclick="SaveData('masters/companydetails/update?id=<?php echo $row['id'];?>','opt','10','','','','2');" style="width: 100px" /><?php } ?>
<input name="Button1" type="button" value="Cancel" class="button" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />

</td>
</tr>
</table>
</div>
