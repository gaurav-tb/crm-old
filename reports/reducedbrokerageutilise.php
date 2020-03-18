<?php
include("../include/conFig.php");
?>
<html>
<body>

<div class="moduleHeading">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Reduced Brokerage Utilization Report :
</td>
<td align="right" style="width:70%">
&nbsp;</td>
</tr>
</table>
</div>
<form action="reports/generatereducedbutilise.php" method="post" target="_blank">

<div class="form">
<table width="100%" cellpadding="0" cellspacing="10">

<tr>
	<td colspan="1" style="width: 90px; height: 29px">
		<strong>Select Filter </strong>	
	</td>
	
</tr>


<!-- <tr>
	<td colspan="3" style="width: 90px; height: 29px">
	<strong>Ongoing Subscription</strong>	
	</td>
</tr>

<tr>	
	<td align="right" style="height: 36px">
	<strong>Start Date
	</strong>
	</td>
	<td style="height: 36px">
	<input id="from0" name="startdate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
	
</tr> -->

<tr>
	<td colspan="3" style="width: 90px; height: 29px">
	<strong>Date</strong>	
	</td>
</tr>
<tr>	
	<td align="right" style="height: 36px">
	<strong>Start Date
	</strong>
	</td>
	<td style="height: 36px">
	<input id="from0" name="fromdate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	<span id='fromdate'></span>
	</td>
	
	<td align="right" style="height:36px">
	<strong>End Date
	</strong>
	</td>
	<td style="height: 36px">
	<input id="from1" name="todate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	<span id='todate'></span>
	</td>

	 </tr>


	<tr>
	<td>
	<strong>RM Owner</strong>
	</td>
	

	
<td id="teamUsers">
<select name="Select1" class="input" onchange="addToteam(this.value,'opt2')">
			<option value="">Select Relationship Manager</option>
			<?php
			$getProfile = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `employee`.`delete`='0' AND `employee`.`status`='1' AND (`profile`='11' || `profile`='16') ORDER BY `name` ASC",$con) or die(mysql_error());
			while($rowProfile= mysql_fetch_array($getProfile))
			{
			?>
			<option value="<?php echo $rowProfile[1] ;?>**<?php echo $rowProfile[0] ;?>"><?php echo $rowProfile[0] ;?></option>
			<?php
			}
			?>
			
			</select>&nbsp;&nbsp;<span id="reselect"></span>
			<div style="padding:5px;" id="selectTeam">
		<?php
$getMates = mysql_query("SELECT employee.name,teamamtes.mateid FROM employee,teamamtes WHERE teamamtes.teamid = '$id' AND teamamtes.mateid = employee.id",$con) or die(mysql_error());
while($rowMates = mysql_fetch_array($getMates))
{
?>
<div class="teamMate" id="team<?php echo $rowMates[1];?>"><?php echo $rowMates[0];?>&nbsp;&nbsp;&nbsp;<span style="cursor:pointer" onclick="removeTeam('<?php echo $rowMates[1];?>','opt2')">x</span></div>
<?php
$valPut .= "-".$rowMates[1]."-,";
}		
?>				

</div>
<input type="text"  name="Display_rm"  value="<?php echo $valPut;?>" id="opt2" style="display:none" />

</td>	
	
	

</tr>

<tr>
	<td  style="width: 90px; height: 29px">
	<strong>Client Code</strong>	
	</td>

	<td style="height: 36px">
	<input id="code" name="code" class="" placeholder="Client Code" type="text">
	</td>
</tr>

	<!--  <tr>
	<td>
	<strong>Client Owner</strong>
	</td>
	<td style="">
	<select class="input" name="leadowner" style="width:200px" id="opt9">
	<option value="0">-None-</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' order by `name` asc",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
</select>
</td>

<td align="right" style="height: 36px">
<strong>Plans</strong>
</td>
<td>
<select class="input" name="plans">
<option value='0'>Select Plan</option>
<option value='1'>Silver</option>
<option value='2'>Gold</option>
<option value='3'>Diamond</option>
<option value='4'>Platinum</option>
</select>
</td>
</tr>

<tr>

<td style="height: 36px">
<strong>Approval Status</strong>
</td>
<td>
<select class="input" id="ApprovalStatus" name="ApprovalStatus">
<option value='3'>Select Approval Status</option>
<option value='1'>Not Approved</option>
<option value='0'>pending</option>
<option value='2'>Approved</option>

</select>
</td> -->
<tr>
<td align="right" style="width: 90px; height: 40px; padding-right:72px"><input name="Submit1" type="submit" value="Export" class="buttonBlue"  onclick = "return validateRBUtilize()"/></td>
</tr>
</table>
</div>
</form>
<br/>
<br/>
<br/>
<br/>
</body>
</html>

<td>
<strong></strong>
</td>


</td>