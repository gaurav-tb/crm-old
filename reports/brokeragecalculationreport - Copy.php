<?php
include("../include/conFig.php");
?>
<html>
<body>

<div class="moduleHeading">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Revenue Analysis Report:
</td>
<td align="right" style="width:70%">
&nbsp;</td>
</tr>
</table>
</div>
<form action="reports/generatebrokeragereport.php" method="post" target="_blank">

<div class="form">
<table width="100%" cellpadding="0" cellspacing="10">
<tr>
	<td colspan="6" style="width: 90px; height: 29px">
		<strong>Select Date</strong>	
	</td>
</tr>
<tr>
	<td align="right" style="height: 36px">
	<strong>From Date
	</strong>
	</td>
	<td style="height: 36px">
	<input id="from0" name="fromdate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
	<td align="right" style="height:36px">
	<strong>To Date
	</strong>
	</td>
	<td style="height: 36px">
	<input id="from0" name="todate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
	 </tr>
	 <tr>
	<td align="right">
	<strong>RM Owner</strong>
	</td>
	<td id="teamUsers">
<select name="Select1" class="input" onchange="addToteam(this.value,'opt9')">
			<option value="">Select Relationship Manager</option>
			<?php
			$getProfile = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `employee`.`delete`='0' AND `employee`.`status`='1' AND (`profile`='11' || `profile`='16' || `id`='1' || `profile`='28' || `profile`='29' || `profile`='30' || `profile`='19') ORDER BY `name` ASC",$con) or die(mysql_error());
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
<div class="teamMate" id="team<?php echo $rowMates[1];?>"><?php echo $rowMates[0];?>&nbsp;&nbsp;&nbsp;<span style="cursor:pointer" onclick="removeTeam('<?php echo $rowMates[1];?>','opt9')">x</span></div>
<?php
$valPut .= "-".$rowMates[1]."-,";
}		
?>				

</div>
<input type="text"  name="DisplayRM"  value="<?php echo $valPut;?>" id="opt9" style="display:none" />

</td>
<td align="right" style="width: 90px; height: 40px; padding-right:72px"><input name="Submit1" type="submit" value="Export" class="buttonBlue" /></td>
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

