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
<form action="reports/generatereport.php" method="post" target="_blank">

<div class="form">
<table width="100%" cellpadding="0" cellspacing="10">
<tr>
	<td style="width: 90px; height: 29px">
		<strong>Create Date</strong>	
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
	<td align="right" style="; width: 90px; height: 56px;">
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
</tr>

<tr>
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

</tr>
<tr>

		<td colspan="5" align="right" style="; width: 90px;">
		<strong>Lead Owner
	</strong>
	</td>
	<td style="width: 163px">
	<select class="input" name="leadowner" style="width: 200px" id="opt9">
	<option value="null">-None-</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0'",$con) or die(mysql_error()); 
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
	<td colspan="6" align="right" style="width: 90px; height: 40px; padding-right:72px">
	<input name="Submit1" type="submit" value="Export" class="buttonBlue" /></td>
</tr>


</table>
</div>
</form>

</body>
</html>
