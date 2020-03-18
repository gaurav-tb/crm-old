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
<td align="left" style="width:30%">
<div style="float:right">

<div style="background:#fff;padding:5px;color:#222;box-shadow:0px 0px 5px 0px #222;cursor:pointer;display:inline-block">
<img src="images/reload.png" style="height:20px;" alt="" onclick="if(document.getElementById('ftchart').style.display == 'block') {getModule('reports/todaysFT','ftTickerContent','','');document.getElementById('ftchart').style.display == 'block'} else { getModule('reports/todaysFT','ftTickerContent','','');}" title="Refresh"/>
</div>&nbsp;
<div style="background:#fff;padding:5px;color:#222;box-shadow:0px 0px 5px 0px #222;cursor:pointer;display:inline-block" >
<img src="images/chart.png" style="height:20px;"  alt="" onclick="document.getElementById('ftchart').style.display = 'block';document.getElementById('ftStatistics').style.display = 'none'" title="Graph Representation"/>
</div>&nbsp;
<div style="background:#fff;padding:5px;color:#222;box-shadow:0px 0px 5px 0px #222;cursor:pointer;display:inline-block" >
<img src="images/stats.png" style="height:20px;"  alt="" onclick="document.getElementById('ftchart').style.display = 'none';document.getElementById('ftStatistics').style.display = 'block'" title="Statistics"/>
</div>&nbsp;
</div>
Today's Free Trial Requests
</td>
</tr>
</table>
</div>

<div class="form" id="ftStatistics">
	<table width="100%" cellpadding="10" cellspacing="0">
	<tr>
		<td style="padding-left:50px"><strong>User</strong></td>
		<td><strong>Today's FreeTrial Requests</strong></td>
		<td><strong>Today's Re-trials Requests</strong></td>

	</tr>
<?php
$addCount = 0;
$repeatCount = 0;
$getResult = mysql_query("SELECT employee.name,employee.id FROM employee WHERE employee.delete = '0' ORDER BY employee.name ASC",$con) or die(mysql_error());
while($rowResult = mysql_fetch_array($getResult))
{
$empId = $rowResult[1];
//echo "DISTINCT(contact.id) FROM contact,servicecall WHERE servicecall.cid = contact.id AND servicecall.type = 'f' AND servicecall.createdate BETWEEN '$fdate' AND '$tdate' AND servicecall.delete = '0' AND servicecall.updatedby = '$empId'";
	$getCount = mysql_query("SELECT DISTINCT(servicecall.cid) FROM servicecall WHERE  servicecall.type = 'f' AND servicecall.createdate BETWEEN '$fdate' AND '$tdate' AND servicecall.delete = '0' AND servicecall.updatedby = '$empId' AND servicecall.repeat = '0'",$con) or die(mysql_error());
	
	//$getCount = mysql_query("SELECT COUNT(servicecall.id) FROM servicecall,employee,contact WHERE servicecall.type = 'f' AND servicecall.createdate BETWEEN '$fdate' AND '$tdate' AND servicecall.delete = '0' AND employee.id = contact.ownerid AND employee.id = '$empId' AND servicecall.cid = contact.id",$con) or die(mysql_error());
	$rowCount = mysql_num_rows($getCount);
	$addCount += $rowCount;
	
	$getRepeatCount = mysql_query("SELECT DISTINCT(servicecall.cid) FROM servicecall WHERE  servicecall.type = 'f' AND servicecall.createdate BETWEEN '$fdate' AND '$tdate' AND servicecall.delete = '0' AND servicecall.updatedby = '$empId' AND servicecall.repeat = '1'",$con) or die(mysql_error());
	$rowRepeatCount = mysql_num_rows($getRepeatCount);
	$repeatCount += $rowRepeatCount;


?>	
	<tr>
		<td style="padding-left:50px"><?php echo $rowResult[0];?></td>
		<td class="blueSimpletext" style="font-weight:bold"><?php echo $rowCount;?></td>
		<td class="blueSimpletext" style="font-weight:bold"><?php echo $rowRepeatCount;?></td>
	</tr>
<?php
}
?>	
	<tr>
		<td style="padding-left:50px"><strong>Total</strong></td>
		<td class="blueSimpletext" style="font-weight:bold;font-size:20px"><?php echo $addCount;?></td>
		<td class="blueSimpletext" style="font-weight:bold;font-size:20px"><?php echo $repeatCount;?></td>

	</tr>
</table>
<br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
<div id="ftchart" style="display:none;height:600px;overflow-x:hidden;overflow-y:auto">
<iframe src="bar-basic/index.php" style="height:2000px;width:100%" scrolling="no" frameborder="0" ></iframe>
<br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>

</body>
</html>
