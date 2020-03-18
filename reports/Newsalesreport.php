<?php
include("../include/conFig.php");
?>
<html>
<body>

<div class="moduleHeading">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
New Sales Report:
</td>
<td align="right" style="width:70%">
&nbsp;</td>
</tr>
</table>
</div>
<form action="reports/Newsales.php" method="post" target="_blank">

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
	
	<td align="right" style="height: 36px">
	<strong>To Date
	</strong>
	</td>
	<td style="height: 36px">
	<input id="from0" name="todate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
	
	 </tr>
	 <tr>

	<td>

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

