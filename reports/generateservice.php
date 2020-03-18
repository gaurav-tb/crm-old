<?php 
session_start();
ob_start();

include("../include/conFig.php");
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
//print_r($_POST);
$type=$_POST['type'];
$tips=$_POST['tips'];
$owner=$_POST['leadowner'];
$approved = $_POST['approved'];
$product = $_POST['product'];
	if($product == '')
	{
	$pstr = "(1=1)";
	}
	else
	{
	$pstr = "product.id = '$product'";
	}
	
	if($type == '')
	{
	$tystr = "(1=1)";
	}
	else
	{
	$tystr = "servicecall.type= '$type'";
	}
	
	if($approved == '')
	{
	$appstr = "(1=1)";
	}
	else
	{
	$appstr = "servicecall.approved = '$approved'";
	}
	
	if($owner == '')
	{
	$ownerstr = "(1=1)";
	}
	else
	{
	$ownerstr = "contact.ownerid = '$owner'";
	}
	
	if($tips == '')
	{
	$tipstr = "(1=1)";
	}
	else if($tips == 'Y')
	{
	$tipstr = "(servicecall.fromdate <= '$date' AND servicecall.todate >= '$date')";
	}
	else if($tips == 'N')
	{
	$tipstr = "(servicecall.fromdate >= '$date' OR servicecall.todate <= '$date')";
	}
	



$query = "SELECT employee.name,contact.fname,contact.lname,servicecall.mobile,product.name,servicecall.type,servicecall.approved,servicecall.fromdate,servicecall.todate FROM employee,contact,servicecall,product WHERE employee.id = contact.ownerid AND servicecall.cid = contact.id AND product.id = servicecall.product AND ".$pstr." AND ".$tipstr." AND ".$tystr." AND ".$ownerstr." AND ".$appstr." AND servicecall.fromdate >= '$fromdate' AND servicecall.todate <= '$todate' ORDER BY product.name ASC";

$format = date('Y-m-d His');
$name ="Freetrial_Report_".$format.".xls"; 
//$name = "Freetrial_Report_".$fromdate."_".$todate.".xls";
//echo $startdate;
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");


?>


<table width="100%" cellpadding="5" cellspacing="0" border="1">
<tr>
<th>Owner</th>
<th>Contact Name</th>
<!-- <th>Mobile</th>
 --><th>Product </th>
<th>Type</th>
<th>Approved</th>
<th>Start Date</th>
<th>End Date</th>
<th>For Today</th>
</tr>

<?php
$getData=mysql_query($query,$con)or die(mysql_error());
while($row = mysql_fetch_array($getData))
{
?>
	<tr>
		<td>
		<?php echo $row[0];?>
		</td>
		<td>
		<?php echo $row[1]." ".$row[2];?>
		</td>
		<!-- <td>
		<?php echo $row[3];?>
		</td> -->
		<td>
		<?php echo $row[4];?>
		</td>
		<td>		
		<?php echo $row[5];?>
		</td>
		<td>
		<?php
if($row[6] == '0')
{
echo "No";
}
else
{
echo "Yes";
}		
?>
		</td>
		<td>
		<?php echo date("d-m-y",strtotime($row[7]));?>
		</td>
		<td>
		
		<?php echo date("d-m-y",strtotime($row[8]));?>		</td>
		<td>
		<?php 
		if($row[7] <= $date && $row[8] >= $date)
		{
			echo 'Y';
		}
		else
		{
			echo 'N';
		}

 ?>
		
		</td>		
	</tr>
<?php
}
?>

</table>