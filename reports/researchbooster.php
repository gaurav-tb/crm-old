<?php
include("../include/conFig.php");
?>
<html>
<body>

<div class="moduleHeading">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Research Booster Report :
</td>
<td align="right" style="width:70%">
&nbsp;</td>
</tr>
</table>
</div>
<form action="reports/generateresearchbooster.php" method="post" target="_blank">

<div class="form">
<table width="100%" cellpadding="0" cellspacing="10">

<!-- <tr>
	<td colspan="1" style="width: 90px; height: 29px">
		<strong>Select Filter </strong>	
	</td>
	<td colspan="2" style="width: 90px; height: 29px">
		<strong>Check By Start & End Date</strong>	&nbsp; <input type="radio" name="CheckFilter" Onclick="CheckFilterEnabled();" id="StartDate" value="StartDate"/>
	</td>
	<td colspan="2" style="width: 90px; height: 29px">
		<strong>Check By Booster Conversion Date </strong>	&nbsp; <input type="radio" Onclick="CheckFilterEnabled();" name="CheckFilter" id="ConversionDate" value="ConversionDate"/>
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
	<input id="from1" name="todate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
	 </tr>
 -->	
 <tr>
 	<td colspan="1" style="width: 90px; height: 29px">
 		<strong>Select Filter </strong>	
 	</td>
 	
 </tr>


 <tr>
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
 	
 </tr>

 <tr>
 	<td colspan="3" style="width: 90px; height: 29px">
 	<strong>Conversion Date</strong>	
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
 	<input id="from1" name="todate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
 	</td>
 	 </tr>
 <tr>
	<td>
	<strong>Client Owner</strong>
	</td>
	<td style="">
	<select class="input" name="leadowner" style="width:200px" id="opt9">
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

<td align="right" style="height: 36px">
<strong>Segments</strong>
</td>
<td>
<select class="input" name="segments">
<option value='0'>Select Segments</option>
<option value='1'>Commodity</option>
<option value='2'>Future</option>
<option value='3'>Option</option>
<option value='4'>Equity</option>
</select>
</td>
</tr>
<tr>
	<td style="width: 100px">
		<strong>Fund debited date
	</strong>	
	</td>
</tr>

<tr>
	<td align="right" style="width: 90px; font-size:12px; height: 56px;">
		From Date
	</td>
	<td style="width: 170px; height: 56px;">
		<input id="from0" name="debited_fromdate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
	<td align="right" style="width: 84px; font-size:12px; height: 56px;">
		To Date
	</td>
	<td style="width: 170px; height: 56px;" >
		<input id="from0" name="debited_todate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
</tr>
<tr>
	<td style="width: 100px">
		<strong>Fund clear date
	</strong>	
	</td>
</tr>

<tr>
	<td align="right" style="width: 90px; font-size:12px; height: 56px;">
		From Date
	</td>
	<td style="width: 170px; height: 56px;">
		<input id="from0" name="clear_fromdate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
	<td align="right" style="width: 84px; font-size:12px; height: 56px;">
		To Date
	</td>
	<td style="width: 170px; height: 56px;" >
		<input id="from0" name="clear_todate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
</tr>

<tr>

<td style="height: 36px">
<strong>Approval Status</strong>
</td>
<td>
<select class="input" id="ApprovalStatus" name="ApprovalStatus">
<option value='3'>Select Approval Status</option>
<option value='0'>Not Approved</option>
<option value='1'>pending</option>
<option value='2'>Approved</option>

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

<td>
<strong></strong>
</td>


</td>