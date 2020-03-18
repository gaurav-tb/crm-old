<?php
include("../include/conFig.php");
?>
<html>
<body>

<div class="moduleHeading">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Sales Summary Report :
</td>
<td align="right" style="width:70%">
&nbsp;</td>
</tr>
</table>
</div>
<form action="reports/generatesummaryreport.php" method="post" target="_blank">

<div class="form">
<table width="100%" cellpadding="0" cellspacing="10">
<tr>
	<td colspan="6" style="width: 90px; height: 29px">
	<strong>Select Date</strong>	
	</td>
</tr>
<tr>
	<td align="right" style="width: 90px; font-size:12px; height: 36px;">
	From Date
	</td>
	<td style="width: 170px; height: 36px;">
	<input id="from0" name="fromdate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	<td align="right" style="; width: 90px; font-size:12px; height: 36px;">
	To Date
	</td>
	<td style="width: 170px; height: 36px;">
	<!-- <input id="from0" name="todate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text"> -->
    <input id="from0" name="todate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
    </tr>
	 
	<tr>
	<td align="right">
	<strong>Select Employee</strong>
	</td>
	<td style="">
	<select class="input" name="leadowner"  id="opt9">
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

