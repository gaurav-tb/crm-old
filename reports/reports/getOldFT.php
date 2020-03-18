<?php
include("../include/conFig.php");

$fdate = $_GET['fdate'];
$tdate = $_GET['tdate'];
if($fdate != '' && $tdate !='')
{
$fromdate =  $fdate." 00:00:00";
$todate = $tdate." 23:59:59";
$title = "Requests Between ".$fdate." And ".$tdate;
}
else
{
$fromdate = $date." 00:00:00";
$fromdate = $date." 23:59:59";
$title = "Today's FreeTrial Requests";
}
?>
<table width="100%" cellpadding="10" cellspacing="0">
	<tr>
		<td style="padding-left:50px"><strong>User</strong></td>
		<td><strong><?php echo $title?></strong></td>
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