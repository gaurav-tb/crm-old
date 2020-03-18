<?php
include("../include/conFig.php");
$name = $_GET['name'];
$mobile = $_GET['mobile'];
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Add Task related to this Lead
</td>
<td align="right" style="width:70%">
</td>
</tr>
</table>
</div>
<div style="background:#e6e6e6;padding:20px;">
<div style="float:right">
<input name="Button1" type="button" class="buttonBlue" onclick="getModule('task/quickShow?cid=<?php echo $_GET['cid'];?>&name=<?php echo $_GET['name'];?>&mobile=<?php echo $_GET['mobile'];?>','viewmoodleContent','manipulatemoodleContent','Previous Tasks')" value="View Previous Tasks" />
</div>
<table width="100%" cellpadding="0" cellspacing="10">
<tr>
<td align="right" >Owner</td> <td style="" align="left"> 
	<input class="inputDisabled" readonly="readonly" title="isNotNull" type="text" id="optm0" value="<?php echo $loggedname;?>" style="width: 384px" /></td>
</tr>

<tr>
<td align="right" style="">Subject  *</td> <td  align="left"><input class="input" name="req" type="text" id="optm1"style="width: 384px" value="Call <?php echo $_GET['name'];?> On <?php echo $_GET['mobile'];?>" /></td>
</tr>

<tr>
<td align="right" style="height: 36px">Status</td> <td align="left">
	<select name="Select1" id="optm2" style="width: 135px" class="input">
				<option value="0">Open</option>
				<option value="1">Close</option>

			</select>
	</td>
	</tr>
	<tr>
		<td align="right">
		Remind Date  *
		</td>
		<td align="left">
		
<input class="inputCalender" name="req" onclick="openCalendar(this);" style="width: 200px" type="text" id="optm3" value="<?php echo $date;?>">

		
		
		</td>
	<tr>
		<td align="right">
		Remind Time  *
		</td>
		<td align="left">
		<input class="input" id="optm4" name="req" type="number" min="0" max="24" style="width: 42px">&nbsp;&nbsp;&nbsp;
		<input class="input" id="optm5" name="req" type="number" min="0" max="59" style="width: 42px">
		
		</td>
	</tr>
	<tr>
		<td valign="top" align="right">
		Alert Type</td><td  align="left"> 
		  		   <input id="optm6" value="1" type="checkbox" >Email Notifications <br/> 
				   <input id="optm7" value="1" type="checkbox" >Profile Notifications<br/>
				   <input id="optm8" value="1" type="checkbox" >Popup Notifications<br/>
				   <input id="optm9" value="1" type="checkbox" >SMS Notifications<br/>

		</td>

	


<tr>
<td  valign="top" align="right" style="height: 123px">Description</td>
<td style="height: 123px" align="left">
 <textarea name="TextArea1" id="optm10" class="input" style="width: 384px; height: 109px"></textarea>
<input type="text" id="optm11" value="<?php echo  $_GET['cid']?>" style="display:none"/>
 </td>
</tr>
<tr>

<td style="">
</td>
<td style="" align="left">
<input name="Button2" type="button" value="Save & New" class="buttonGreen" onclick="SaveData('task/quickSave?name=<?php echo $name;?>&mobile=<?php echo $mobile;?>','optm','14','','','','3'); " />&nbsp;&nbsp;

<input name="Button1" type="button" value="Cancel" class="buttonnegetive" id="negetive" />
</td>
</tr>
</table>
<br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
