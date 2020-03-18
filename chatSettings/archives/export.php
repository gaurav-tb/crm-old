<?php 
include("../include/conFig.php");
$name = "Tips_Report.xls";
//echo $startdate;
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");
$fromdate=$_GET['fdate'];
$todate=$_GET['tdate'];
$sort = $_GET['sort'];
$services = $_GET['services'];
$sname = $_GET['sname'];
$c = 0;
//print_r($_GET);
foreach($_GET as $key => $val)
{
	if($key != 'fdate' && $key != 'tdate' && $key != 'sort')
	{
	$val = str_ireplace("1,","",$val);
	$temp = explode("-",$val);
	foreach($temp as $sers)
	{
	if($sers != "")
	{
	$serv = "-".$sers."-"; 
	$servStr .= "`services` LIKE '%$serv%' OR ";
	$c++;
	}
	}
		/*if($temp[1] == '1')
		{
		echo "3452";
		$serv = "-".$temp[0]."-"; 
		$servStr .= "`services` LIKE '%$serv%' OR ";
		$c++;
		}*/
	}
}
if($sname != "")
{
	$snameStr = " `sentby` = '$sname' ";
}
else
{
	$snameStr = " 1 = 1 ";
}

if($c == 0)
{
?>
<?php
}
else
{
$servStr = substr($servStr ,0,-3);
$sql = "SELECT * FROM `tips` WHERE `date` BETWEEN '$fromdate' AND '$todate' AND ".$snameStr." AND (".$servStr.")  ORDER BY ".$sort;
$getdata=mysql_query($sql,$con) or die(mysql_error());


?>
<table cellpadding="0" cellspacing="0" width="100%" border="1px">
<tr><th>Date Time</th><th>Service</th><th>Send By</th><th>Message</th></tr>
<?php

while($row = mysql_fetch_array($getdata))
{
?>
	<tr>
		<td>
		<?php
		echo date("d M,Y",strtotime($row['date']))." ".$row['time'];
		?>
		</td>
		<td>
		<?php 
		echo str_ireplace(",","",$row['servicename']);
		?></td>
		<td>
		<?php echo $row['sentbyname'];?>
		</td>
		<td><?php echo $row['tip'];?></td>
		</tr>
		<?php  }?>
</table>
<?php }?>