<?php
include("../include/conFig.php");
$id=$_GET['cid'];
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
$owner =$_POST['leadowner'];
if($owner == '')
{
$owstr = "(1=1)";
}
else
{
$owstr = "contact.ownerid = '$owner'";
}

//echo "SELECT invoice.createdate, invoice.id, invoice.grandtotal, invoice.approved,invoice.transactionalid,contact.fname,contact.lname,employee.name FROM invoice,contact,employee WHERE invoice.cid = contact.id AND invoice.approved = '1' AND invoice.delete = '0' AND contact.ownerid = employee.id  AND ".$owstr."  AND invoice.createdate BETWEEN '$fromdate' AND '$todate'";
$getdata= mysql_query("SELECT invoice.createdate, invoice.id, invoice.grandtotal, invoice.approved,invoice.transactionalid,contact.fname,contact.lname,employee.name FROM invoice,contact,employee WHERE invoice.cid = contact.id AND invoice.approved = '1' AND invoice.delete = '0' AND contact.ownerid = employee.id AND ".$owstr."  AND invoice.createdate BETWEEN '$fromdate' AND '$todate'",$con) or die(mysql_error());
$name = "Billing_Report_".$fromdate."_".$todate.".xls";
//echo $startdate;
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");



?>
<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Billing Information</td>
		</tr>
	</table>
</div>
<div id="directResult">
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
			<th style="height: 19px">Lead Owner</th>

			<th style="height: 19px">Client name</th>
			<th style="height: 19px">Particulars</th>

		<th style="height: 19px">Invoice No</th>

		<th style="height: 19px">Net Amount Paid</th>
		<th style="height: 19px">Dated</th>
	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getdata))
{
?>
	<tr id="fetchRow<?php echo $i;?>"  class="d<?php echo $i%2;?>" title="<?php if($row[3] == '0') echo "Unapproved"; else echo "Approved"; ?>">
		<td><?php echo $row[7]?></td>
		<td><?php echo $row[5]."".$row[6]?></td>
		<td  onclick="getModule('invoice/generateinvoice?id=<?php echo $row[1];?>&i=<?php echo $i;?>','manipulatemoodleContent','viewmoodleContent','Invoice')">
	<?php
	$pstr = '';
	$getProducts = mysql_query("SELECT product.name FROM product,servicecall WHERE servicecall.transactionalid = '$row[4]' AND servicecall.product = product.id",$con) or die(mysql_error());
	while($rowProducts = mysql_fetch_array($getProducts))
	{
	$pstr .= $rowProducts[0].", ";
	} 
	$pstr = substr($pstr,0,-2);
	$pstr = "<strong>".$pstr."</strong>";
	echo $pstr;

	?>
	
	</td>
		<td >
		INV<?php echo $row[1];?>
		</td>
		<td>
		<?php echo $row[2];?>
		</td>
				<td>
		<?php echo date("d M, Y",strtotime($row[0]));?></td>
		<?php
$i++;
}
?>

</table>

<div id="moreData">
</div>
<div class="moduleFoot">
	</div>
</div>



