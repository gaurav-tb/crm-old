<?php 
include("../include/conFig.php");
$sql=base64_decode($_GET['data']);
$getdata=mysql_query($sql,$con) or die(mysql_error());
$name = "Report.xls";
//echo $startdate;
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");

?>
<table width="100%" cellpadding="4" cellspacing="0" border="1">
<tr>
<th>Name</th>
<th>Mobile</th>
<th>Email</th>
<th>address</th>
</tr>

<?php
while($row = mysql_fetch_array($getdata))
{
?>
	<tr>
		<td>
		<?php echo $row[1]." ".$row[2];?></td>
		<td >
		<?php echo $row[4];?>
		</td>
		<td>
		<?php echo $row[5];?>
		</td>
		<td>
		<?php echo $row[13];?>
		</td>

						
	</tr>
	<?php
}
?>

</table>
