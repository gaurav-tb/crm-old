<?php
session_start();
ob_start();
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

$getdata= mysql_query("SELECT invoice.createdate, invoice.id, invoice.grandtotal, invoice.approved,invoice.transactionalid,contact.fname,contact.lname,employee.name,contact.mobile,invoice.partialpayment,invoice.sms,invoice.call,invoice.messenger,bank.name,invoice.paymode,invoice.des FROM invoice,contact,employee,bank WHERE invoice.bank = bank.id AND invoice.cid = contact.id AND invoice.approved = '1' AND invoice.delete = '0' AND contact.ownerid = employee.id AND ".$owstr."  AND invoice.createdate BETWEEN '$fromdate' AND '$todate'",$con) or die(mysql_error());
$name = "Billing_Report_".$fromdate."_".$todate.".xls";
//echo $startdate;
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");
?>

<table border="1" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<th>Lead Owner</th>
		<th>Client name</th>
		<th>Mobile</th>
		<th>Particulars</th>
		<th>Invoice No</th>
		<th>Net Amount Paid</th>
		<th>Payment Received</th>
		<th>Dated</th>
		<th>Way Of Communication</th>
		<th>Bank</th>
		<th>Payment Mode</th>
		<th>Description</th>
	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getdata))
{
?>
	<tr id="fetchRow<?php echo $i;?>"  class="d<?php echo $i%2;?>" title="<?php if($row[3] == '0') echo "Unapproved"; else echo "Approved"; ?>">
	<td><?php echo $row[7]?></td>
	<td><?php echo $row[5]?></td>
	<td><?php echo $row[8]?></td>
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
		<?php echo $row[9];?>
		</td>
		<td>
		<?php echo date("d M, Y",strtotime($row[0]));?>
		</td>
		<td>
		<?php if($row[10] == '1') echo 'SMS<br/>'; else {} if($row[11] == '1') echo 'Call<br/>'; else{}  if($row[12] == '1') echo 'Messenger<br/>'?>
		</td>
		<td>
		<?php echo $row[13];?>
		</td>
		<td>
		<?php echo $row[14];?>
		</td>
		<td>
		<?php echo $row[15];?>
		</td>

		<?php
$i++;
}
?>

</table>



