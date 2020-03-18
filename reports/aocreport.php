<?php
include("../include/conFig.php");
?>
<html>
<body>

<div class="moduleHeading">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Please Select Appropriate Filters:
</td>
<td align="right" style="width:70%">
&nbsp;</td>
</tr>
</table>
</div>
<form action="reports/generateAoc.php" method="post" target="_blank">

<div class="form">
<table width="100%" cellpadding="0" cellspacing="10">
 <tr>
	<td style="width: 90px; height: 29px">
		<strong>Create Date</strong>	
	</td>
</tr> 

<tr>
<td align="right" style="; width: 90px; height: 36px;">
		<strong>Lead Status
	</strong>
	</td>
	<td style="width: 163px; height: 36px;">
	<select class="input" name="leadstatus" style="width: 200px" id="opt9">
	<option value="null">-None-</option>			
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
	
	
	<td align="" style="; width: 90px; height: 56px;">
		<strong>Lead Source
	</strong>
	</td>
	<td style="width: 163px; height: 56px;">
	<select class="input" name="leadsource" style="width: 200px" id="opt11">
	<option value="null">-None-</option>			
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

	
	<td align="right" style="; width: 90px; height: 56px;">
		<strong>Lead Response
	</strong>
	</td>
	<td style="width: 163px; height: 56px;">
	<select class="input" name="leadresponse" style="width: 200px" id="opt12">
	<option value="null">-None-</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `leadresponse` WHERE `delete` = '0'",$con) or die(mysql_error()); 
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
	 <td align="right" style="width: 90px; font-size:12px; height: 36px;">
	From Date
	</td>
	<td style="width: 170px; height: 36px;">
	<input id="from0" name="fromdate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
	<td align="right" style="; width: 90px; font-size:12px; height: 36px;">
	To Date
	</td>
	<td style="width: 170px; height: 36px;">
	<input id="from0" name="todate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
    </tr>	
	
 <tr>
	<td style="width: 90px">
		<strong>Modified Date	
	</strong>	
	</td>
</tr>
<tr>
	<td align="right" style="width: 90px; font-size:12px; height: 56px;">
	From Date
	</td>
	<td style="width: 170px; height: 56px;">
	<input id="from0" name="m_fromdate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
	<td align="right" style="width: 84px; font-size:12px; height: 56px;">
	To Date
	</td>
	<td style="width: 170px; height: 56px;">
	<input id="from0" name="m_todate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
	
</tr> 

<!-- <tr>
	<td style="width: 90px">
		<strong>CallBack Date	
	</strong>	
	</td>
</tr>
<tr>
	<td align="right" style="width: 90px; font-size:12px; height: 56px;">
	From Date
	</td>
	<td style="width: 170px; height: 56px;">
	<input id="from0" name="c_fromdate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
	<td align="right" style="width: 84px; font-size:12px; height: 56px;">
	To Date
	</td>
	<td style="width: 170px; height: 56px;" >
	<input id="from0" name="c_todate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
	<td align="right" style="; width: 90px; height: 56px;">
		<strong>Lead Response
	</strong>
	</td>
	<td style="width: 163px; height: 56px;">
	<select class="input" name="leadresponse" style="width: 200px" id="opt12">
	<option value="null">-None-</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `leadresponse` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>
	</td>

</tr>  -->

<tr>
	<td style="width: 100px">
		<strong>Conversion Date	
	</strong>	
	</td>
</tr>

<tr>
	<td align="right" style="width: 90px; font-size:12px; height: 56px;">
		From Date
	</td>
	<td style="width: 170px; height: 56px;">
		<input id="from0" name="conversion_fromdate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
	<td align="right" style="width: 84px; font-size:12px; height: 56px;">
		To Date
	</td>
	<td style="width: 170px; height: 56px;" >
		<input id="from0" name="conversion_todate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
</tr>

<tr>
	<td style="width: 100px">
		<strong>Approve Date	
	</strong>	
	</td>
</tr>

<tr>
	<td align="right" style="width: 90px; font-size:12px; height: 56px;">
		From Date
	</td>
	<td style="width: 170px; height: 56px;">
		<input id="from0" name="approve_fromdate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
	<td align="right" style="width: 84px; font-size:12px; height: 56px;">
		To Date
	</td>
	<td style="width: 170px; height: 56px;" >
		<input id="from0" name="approve_todate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
</tr>


<tr>
	<td style="width:100px">
		<strong>BO Account Open. Date :	
	</strong>	
	</td>
</tr>

<tr>
	<td align="right" style="width: 90px; font-size:12px; height: 56px;">
		From Date
	</td>
	<td style="width: 170px; height: 56px;">
		<input id="from0" name="boaccountopening_fromdate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
	<td align="right" style="width: 84px; font-size:12px; height: 56px;">
		To Date
	</td>
	<td style="width: 170px; height: 56px;" >
		<input id="from0" name="boaccountopening_todate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
</tr>

<tr>
	<td style="width:100px">
		<strong>Trade Date :	
	</strong>	
	</td>
</tr>

<tr>
	<td align="right" style="width: 90px; font-size:12px; height: 56px;">
		From Date
	</td>
	<td style="width: 170px; height: 56px;">
		<input id="from0" name="trade_fromdate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
	<td align="right" style="width: 84px; font-size:12px; height: 56px;">
		To Date
	</td>
	<td style="width: 170px; height: 56px;" >
		<input id="from0" name="trade_todate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
</tr>

<tr>
	<td>
	<strong>Contact Status</strong>
	</td>
	<td>
		<select class="input" name="contactstatus" style="width: 200px" id="opt10">
		<option value="1">Client</option>
        <option value="2">All</option>
		<option value="0">Lead</option>
	<td>
	<td>
	<strong>Lead Owner
	</strong>
	</td>
	<td style="">
	<select class="input" name="leadowner" style="width: 200px" id="opt9">
	<option value="null">-None-</option>			
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
	<!-- <td colspan="3" align="right" style="width: 90px; height: 40px; padding-right:72px">
		If you want to show Description Please tick Checkbox <input type="checkbox" style="vertical-align:middle" value="2" name="description">
	</td> -->
	<!-- <td colspan="3" align="right" style="width: 90px; height: 40px; padding-right:72px">
		If you want to see Owner Manager Please tick Checkbox <input type="checkbox" style="vertical-align:middle" value="3" name="ownermanager">
	</td> -->
	<td colspan="3" align="right" style="width: 90px; height: 40px; padding-right:72px">
	<input name="Submit1" type="submit" value="Export" class="buttonBlue" /></td>
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
