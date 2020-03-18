<?php
include("../include/conFig.php");
?>
<html>
<body>

<div class="moduleHeading">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Alloted Leads
</td>
<td align="right" style="width:70%">
&nbsp;</td>
</tr>
</table>
</div>
<form action="reports/alloted-results.php" method="post" target="_blank">

<div class="form">
<table width="100%" cellpadding="10" cellspacing="0">
<tr>
	<td align="right" style="width: 202px">
	From Date
	</td>
	<td style="">
	<input id="from0" name="fromdate" class="inputCalender"  onclick="openCalendar(this);" type="text">
	</td>
	<td align="right" style="width: 202px">
	To Date
	</td>
	<td style="">
	<input id="from0" name="todate" class="inputCalender"  onclick="openCalendar(this);" type="text">
	</td>

</tr>


<tr>
<td></td>
	<td colspan="4" align="left">
	<input name="submit" type="submit" value="Export" class="buttonBlue" style="width: 130px; height: 26px" /></td>
</tr>
	
</table>
</div>
</form>

</body>
</html>
