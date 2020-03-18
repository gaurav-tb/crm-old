<?php
include("../include/conFig.php");
?>
<html>
<body>

<div class="moduleHeading">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
PayIn Payout Report :
</td>
<td align="right" style="width:70%">
&nbsp;</td>
</tr>
</table>
</div>
<form action="reports/generaterepayinpayout.php" method="post" target="_blank">

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
	
	<td align="right" style="height:36px">
	<strong>To Date
	</strong>
	</td>
	<td style="height: 36px">
	<input id="from1" name="todate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
	 </tr>
	 
	 <tr>
	 <td align="right" style="height:36px">
	 <strong>
	 Select Format
	 </strong>
	</td>
	
	<td>
	Summary Report <input type="radio" name="CheckFilter" Onclick="CheckFilterEnabled();" id="summaryReport" value="summaryReport"/>  &nbsp; &nbsp; &nbsp; 
	Detailed Report <input type="radio" name="CheckFilter" Onclick="CheckFilterEnabled();" id="DetailedReport" value="DetailedReport"/> 
	</td>
	 </tr>
	
<tr>
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

<td>
<strong></strong>
</td>


</td>