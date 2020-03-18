<?php 
session_start();
ob_start();

include("../include/conFig.php");
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
//print_r($_POST);
if($fromdate != '')
{
$datestr = " AND alloted.truedate >= '$fromdate' AND alloted.truedate <= '$todate'";
}
else
{
$datestr = " AND (1=1)";
}
$sql = "SELECT alloted.id,e1.name,e2.name,alloted.truedate,alloted.createdate FROM employee AS e1,employee AS e2,alloted WHERE e1.id = alloted.from AND e2.id = alloted.to ".$datestr;
$getRes = mysql_query($sql,$con) or die(mysql_error());
?>
	<table cellpadding="0" cellspacing="0" width="100%" border="1px">
		<tr>
			<th>From</th>
			<th>To</th>
			<th>Date</th>
		</tr>
<?php
while($row = mysql_fetch_array($getRes))
{
$showdate = date("d M, Y H:i:s",strtotime($row[3]));
if($showdate == '01 Jan, 1970')
{
$showdate = date("d M, Y H:i:s",strtotime($row[4]));
}

?>		
		<tr>
			<td><?php echo $row[1]?></td>
			<td><?php echo $row[2]?></td>
			<td><?php echo $showdate;?></td>
		</tr>
<?php
}
?>		
	</table>

<?php
//$name = "Alloted_Leads_Report_".$fromdate."_".$todate.".xls";
$format = date('Y-m-d His');
$name = "Alloted_Leads_Report_".$format.".xls";
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