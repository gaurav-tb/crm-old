<?php
include("../include/conFig.php");
?>
<html>
<body>

<div class="moduleHeading">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
User Performance Report
</td>
<td align="right" style="width:70%">
&nbsp;</td>
</tr>
</table>
</div>
<form action="reports/generateservice.php" method="post" target="_blank">

<div class="form">
<table width="100%" cellpadding="10" cellspacing="0">
<tr>
	<td align="right" style="width: 202px">
	From Date
	</td>
	<td style="">
	<input id="fromDate" name="fromdate" class="inputCalender"  onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
	<td align="right" style="; width: 202px;">
	To Date
	</td>
	<td align="left">
	<input id="toDate" name="todate" class="inputCalender"  onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
</tr>


<tr>
<td align="right" style="width: 202px">Select User</td>
<td>

<select class="input" name="leadowner" id="userShow" style="width: 200px" id="opt9">
	<option value="">-None-</option>			
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
<td></td>
	<td colspan="4" align="left">
	<input name="submit" type="button" value="Get Performance" class="buttonBlue" style="width: 130px;" onclick="getModule('reports/user-performance-result?f='+document.getElementById('fromDate').value+'&t='+document.getElementById('toDate').value+'&u='+document.getElementById('userShow').value,'viewmoodleContent','','User Performance')" /></td>
</tr>
	
</table>
</div>
</form>

</body>
</html>
