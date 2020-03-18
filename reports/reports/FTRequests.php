<?php
include("../include/conFig.php");
$fdate = $date." 00:00:00";
$tdate = $date." 23:59:59";
?>
<html>
<body>

<div class="moduleHeading">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:100%%">
<div style="float:right">
<div style="display:inline-block"><input id="from" class="inputCalender" placeholder="From" onclick="openCalendar(this);" readonly="readonly" type="text"></div>
<div style="display:inline-block"><input id="to"  class="inputCalender" placeholder="To" onclick="openCalendar(this);" readonly="readonly" type="text"></div>
<div style="display:inline-block" class="buttonGreen" onclick="getModule('reports/getOldFT?fdate='+document.getElementById('from').value+'&tdate='+document.getElementById('to').value,'directResult','','FreeTrial Requests')">Go</div>&nbsp;&nbsp;
</div>
Free Trial Requests
</td>
</tr>
</table>
</div>

<div class="form" id="directResult">
	<table width="100%" cellpadding="10" cellspacing="0">
	<tr>
		<td style="padding-left:50px"><strong>User</strong></td>
		<td><strong>Today's FreeTrial Requests</strong></td>
	</tr>
<?php
$addCount = 0;
$getResult = mysql_query("SELECT employee.name,employee.id FROM employee WHERE employee.delete = '0' ORDER BY employee.name ASC",$con) or die(mysql_error());
while($rowResult = mysql_fetch_array($getResult))
{
$empId= $rowResult[1];
	$getCount = mysql_query("SELECT DISTINCT(servicecall.cid) FROM servicecall WHERE  servicecall.type = 'f' AND servicecall.createdate BETWEEN '$fdate' AND '$tdate' AND servicecall.delete = '0' AND servicecall.updatedby = '$empId'",$con) or die(mysql_error());
	$rowCount = mysql_num_rows($getCount);
	$addCount += $rowCount;

?>	
	<tr>
		<td style="padding-left:50px"><?php echo $rowResult[0];?></td>
		<td class="blueSimpletext" style="font-weight:bold"><?php echo $rowCount[0];?></td>
	</tr>
<?php
}
?>	
	<tr>
		<td style="padding-left:50px"><strong>Total</strong></td>
		<td class="blueSimpletext" style="font-weight:bold;font-size:20px"><?php echo $addCount;?></td>
	</tr>

</table>
<br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
</body>
</html>
