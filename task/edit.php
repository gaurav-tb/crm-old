<?php
include("../include/conFig.php");
$id = $_GET['id'];
$getData = mysql_query("SELECT * FROM `task` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%;text-transform:capitalize">
<?php echo $row['subject'];?>
</td>
<td align="right" style="width:70%">
<?php
if(isset($_GET['refresh']) == 1)
{
?>
<input name="Button1" type="button" value="< Back To List" class="button" onclick="getModule('task/view','viewContent','manipulateContent','Tasks')" />
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
<div style="float:right">
<?php
if($row['contactid'] != '0')
{
$cid = $row['contactid'];
$getAllot = mysql_query("SELECT `converted`,`fname` FROM `contact` WHERE `id` = '$cid'",$con) or die(mysql_error());
$rowAllot = mysql_fetch_array($getAllot);
	if($rowAllot[0] != '0')
	{
		$url = "clients/edit?id=".$cid."&i=0";
	}
	else
	{
		$url = "leads/edit?id=".$cid."&i=0";
	}
	$showName = $rowAllot[1];
?>
<input name="Button1" class="buttonBlue" type="button" value="View Associated Contact" onclick="getModule('<?php echo $url;?>','manipulateContent','viewContent','<?php echo $showName;?>')" />
<?php
}
?>
</div>

<table width="100%" cellpadding="0" cellspacing="10">
<tr>
<table width="100%" cellpadding="0" cellspacing="10">
<tr>
<td align="right" style="height: 32px">Owner</td> <td style="height: 32px"> 
	<input class="inputDisabled" type="text" id="opt0" value="<?php echo $loggedname;?>" style="width: 384px" /></td>
</tr>
<tr>
<td align="right" style="height: 32px">Subject  *</td> <td style="height: 32px"><input class="input" name="req" type="text" id="opt1"style="width: 384px" value="<?php echo $row['subject'];?>" /></td>
</tr>

<tr>
<td align="right" style="height: 36px">Status</td> <td style="height: 36px">
	<select name="Select1" id="opt2" style="width: 135px" class="input">
				<option <?php if($row['status'] == '0') echo "selected='selected'"  ?> value="0">Open</option>
				<option <?php if($row['status'] == '1') echo "selected='selected'"  ?>  value="1">Close</option>

			</select>
	</td>
	</tr>
	<tr>
		<td align="right">
		Remind Date  *
		</td>
		<td>
		<?php
		$remindate = $row['reminddate'];
		$remindate = explode(" ",$remindate);
		?>
		<input class="input" name="req" type="date" id="opt3" style="width: 132px" value="<?php echo $remindate[0];?>">
		
		
		</td>
	<tr>
		<td align="right">
		Remind Time  *
		</td>
		<td>
		<?php
		$time = explode(":",$remindate[1])
		?>
		<input class="input" id="opt4" name="req" type="number" min="0" max="24" style="width: 42px" value="<?php echo $time[0];?>">&nbsp;&nbsp;&nbsp;
		<input class="input" id="opt5" name="req" type="number" min="0" max="59" style="width: 42px" value="<?php echo $time[1];?>">
		
		</td>
	</tr>
	<tr>
		<td valign="top" align="right">
		Alert Type</td><td> 
		  		   <input id="opt6" <?php if($row['email'] == '1') echo "checked='checked'"; ?> value="1" type="checkbox" >Email Notifications <br/> 
				   <input id="opt7" <?php if($row['profile'] == '1') echo "checked='checked'"; ?>  value="1" type="checkbox" >Profile Notifications<br/>
				   <input id="opt8" <?php if($row['popup'] == '1') echo "checked='checked'"; ?>  value="1" type="checkbox" >Popup Notifications<br/>
				   <input id="opt9" <?php if($row['sms'] == '1') echo "checked='checked'"; ?>  value="1" type="checkbox" >SMS Notifications<br/>

		</td>

	


<tr>
<td  valign="top" align="right" style="height: 123px">Description</td>
<td style="height: 123px">
 <textarea name="TextArea1" id="opt10" class="input" style="width: 384px; height: 109px"><?php echo $row['description']; ?> </textarea>

</td>
</tr>
<tr>

<td>
</td>
<td>

<input name="Button2" type="button" value="Update" class="buttonGreen" onclick="SaveData('task/update?id=<?php echo $id;?>&i=<?php echo $_GET['i'];?>','opt','11','<?php echo $_GET['i'];?>','','','2'); dynamicTask('<?php echo $remindate[0];?>',document.getElementById('opt3').value,'<?php echo $id;?>','<?php echo date("Y-m-d");?>',document.getElementById('opt1').value,document.getElementById('opt2').value)" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Cancel" class="buttonnegetive" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"/>
</td>
</tr>
</table>

