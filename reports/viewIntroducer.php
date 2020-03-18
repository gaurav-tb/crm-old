<?php
include("../include/conFig.php");
?>
<html>
<body>

<div class="moduleHeading">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
 Introducer Report
</td>
<td align="right" style="width:70%">
&nbsp;</td>
</tr>
</table>
</div>
<form action="reports/viewintroducerresult.php" method="post" target="_blank">

<div class="form">
<table width="100%" cellpadding="0" cellspacing="10">
<tr>
	<td align="right" style="height: 36px">
	<strong>From Date
	</strong>
	</td>
	<td style="height: 36px">
	<input id="from0" name="fromdate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
	<td align="right" style="height: 36px">
	<strong>To Date
	</strong>
	</td>
		<td style="height: 36px">
	<input id="from0" name="todate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>


</tr>

<tr>

		<td align="right" align="right">
		<strong>Introducer Code
	</strong>
	</td>
<td style="width: 163px">
<Input type="text" name="introducer" class="input" placeholder="Client TB Code" style="width: 200px" id="opt9" />
</td>

</tr>
<tr>
<td></td>
<td align="left">
<input name="Submit1" type="submit" value="Export" class="buttonBlue" /></td>
</tr>


</table>
</div>
</form>

</body>
</html>
