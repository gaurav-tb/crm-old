<?php 
session_start();
ob_start();

include("../include/conFig.php");
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
/*
if($fromdate <= '2013-05-23')
{
$fromdate = '2013-05-24';
}
*/
//print_r($_POST);
if($fromdate != '')
{
$datestr = " AND alloted.createdate >= '$fromdate' AND alloted.createdate <= '$todate'";
}
else
{
$datestr = " AND (1=1)";
}
$sql = "SELECT alloted.id,e1.name,e2.name,alloted.createdate,contact.mobile,contact.id FROM employee AS e1,employee AS e2,alloted,contact WHERE alloted.cid = contact.id  AND e1.id = alloted.from AND e2.id = alloted.to ".$datestr;
$getRes = mysql_query($sql,$con) or die(mysql_error());
$i=0;
while($row = mysql_fetch_array($getRes))
{
$servStr='';
$print[$i]['from'] = $row[1];
$print[$i]['to'] = $row[2];
$print[$i]['mobile'] = $row[4];
$thisCid = $row[5];
$getServices = mysql_query("SELECT category.name FROM category,servicecall WHERE servicecall.approved = '1' AND servicecall.cid = '$thisCid' AND servicecall.product = category.id",$con) or die(mysql_error());
while($rowServ = mysql_fetch_array($getServices))
{
$servStr .= $rowServ[0].",";
}
$print[$i]['services'] =$servStr;
$print[$i]['date'] = date("d,M y",strtotime($row[3]));

$i++;
}
?>

	<table cellpadding="0" cellspacing="0" width="100%" border="1px">
		<tr>
			<th>From</th>
			<th>To</th>
			<th>Mobile</th>
			<th>Services</th>
			<th>Date</th>
		</tr>
<?php
foreach($print as $val)
{
?>		
		<tr>
			<td><?php echo $val['from'];?></td>
			<td><?php echo $val['to'];?></td>
			<td><?php echo $val['mobile'];?></td>
			<td><?php echo $val['services'];?></td>
			<td><?php echo $val['date'];?></td>
		</tr>
<?php
}
?>		
	</table>

<?php

$name = "Numbers_Report_".$fordate.".xls";
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");


?>



<table width="100%" cellpadding="5" cellspacing="0" border="1">
<tr>
<?php echo $thstr;?>
</tr>
<tr>
<?php echo $t2hstr;?>
</tr>
<tr>
<?php
foreach($service as $val)
{
?>
<td colspan="3" valign="top"  style='width:300px;'>
<table width="100%" cellpadding="5" cellspacing="0" border="1">
<?php
$temp = explode(":::::::forbreak::::::",$val);
foreach($temp as $tal)
{
?>
<tr><?php echo $tal;?></tr>
<?php
}
?>
</table>
</td>
<?php
}
?>
</tr>
</table>