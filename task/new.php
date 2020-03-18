<?php
include("../include/conFig.php");
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Add New Task
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
<div class="form">
<table width="100%" cellpadding="0" cellspacing="10">
<tr>
<td align="right" style="height: 32px">Owner</td> <td style="height: 32px"> 
	<input class="inputDisabled" readonly="readonly" title="isNotNull" type="text" id="opt0" value="<?php echo $loggedname;?>" style="width: 384px" /></td>
</tr>
<tr>
<td align="right" style="height: 32px">Subject  *</td> <td style="height: 32px"><input class="input" name="req" type="text" id="opt1"style="width: 384px" /></td>
</tr>

<tr>
<td align="right" style="height: 36px">Status</td> <td style="height: 36px">
	<select name="Select1" id="opt2" style="width: 135px" class="input">
				<option value="0">Open</option>
				<option value="1">Close</option>

			</select>
	</td>
	</tr>
	<tr>
		<td align="right">
		Remind Date  *
		</td>
		<td>
		
<input class="inputCalender" name="req" onclick="openCalendar(this);" style="width: 200px" type="text" id="opt3" value="<?php echo $date;?>">

		
		
		</td>
	<tr>
		<td align="right">
		Remind Time  *
		</td>
		<td>
		<input class="input" id="opt4" name="req" type="number" min="0" max="24" style="width: 42px">&nbsp;&nbsp;&nbsp;
		<input class="input" id="opt5" name="req" type="number" min="0" max="59" style="width: 42px">
		
		</td>
	</tr>
	<tr>
		<td valign="top" align="right">
		Alert Type</td><td> 
		  		   <input id="opt6" value="1" type="checkbox" >Email Notifications <br/> 
				   <input id="opt7" value="1" type="checkbox" >Profile Notifications<br/>
				   <input id="opt8" value="1" type="checkbox" >Popup Notifications<br/>
				   <input id="opt9" value="1" type="checkbox" >SMS Notifications<br/>

		</td>

	


<tr>
<td  valign="top" align="right" style="height: 123px">Description</td>
<td style="height: 123px">
 <textarea name="TextArea1" id="opt10" class="input" style="width: 384px; height: 109px"></textarea>

</td>
</tr>
<tr>

<td style="height: 40px">
</td>
<td style="height: 40px">

<input name="Button2" type="button" value="Save & New" class="buttonGreen" onclick="SaveData('task/save','opt','11','','','','1'); " />&nbsp;&nbsp;
<input name="Button1" type="button" value="Save & Back" class="buttonGreen" onclick="SaveData('task/save','opt','11','','','','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','');" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Cancel" class="buttonnegetive" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"/>
</td>
</tr>
</table>
</div>
