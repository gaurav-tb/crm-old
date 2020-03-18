<?php
include("../include/conFig.php");

//echo "SELECT invoice.createdate, invoice.id, contact.fname, contact.lname, invoice.grandtotal,contact.id FROM contact,servicecall,invoice WHERE invoice.cid = contact.id AND servicecall.cid = contact.id AND servicecall.transactionalid = invoice.transactionalid AND invoice.delete = '0' AND contact.id ='$id' ORDER BY invoice.id DESC LIMIT 100";
$getData = mysql_query("SELECT invoice.createdate, invoice.id,  contact.fname, contact.lname, invoice.grandtotal,invoice.approved,invoice.transactionalid FROM contact,invoice WHERE invoice.cid = contact.id AND invoice.approved = '0'  AND invoice.delete = '0' ORDER BY invoice.id DESC",$con) or die(mysql_error());



?>
<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Billing Information</td>
			<td align="right" style="width: 70%">
			<!--Show&nbsp;&nbsp;<select name="Select1" class="input" id="todo" onchange="showCustomRows(this.value,'viewbilltable')">
				<option value="All">All</option>
				<option value="Approved">Approved</option>
				<option value="Unapproved">Unapproved</option>
			</select> -->
			</td>
		</tr>
	</table>
</div>
<div id="directResult"  style="height:600px;overflow:auto">
<table id="viewbilltable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr><th></th>
				<th style="">Name</th>
			<th style="">Particulars</th>
		<th style="">Invoice No</th>
		<th style="">Net Amount</th>
		<th style="">Date</th>
				<th style="">Approve</th>

	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	<tr style="" id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php if($row[5] == '0') echo "Unapproved"; else echo "Approved"; ?>">
		<td>
		<?php
		if($row[5] == '0')
		{
		?>
		<img src="images/unapproved.png" style="height:15px;" alt=""/>
		<?php
		}
		else
		{
		?>
		<img src="images/approved.png" style="height:15px;" alt=""/>
		<?php
		}
		?>
		</td>

		
		<td  onclick="getModule('invoice/generateinvoice?id=<?php echo $row[1];?>&i=<?php echo $i;?>','manipulatemoodleContent','viewmoodleContent','Fetching Data..')">
		<?php echo $row[2]."&nbsp;".$row[3];?></td>
		<td>
			<?php
	$pstr = '';
	$getProducts = mysql_query("SELECT product.name FROM product,servicecall WHERE servicecall.transactionalid = '$row[6]' AND servicecall.product = product.id",$con) or die(mysql_error());
	while($rowProducts = mysql_fetch_array($getProducts))
	{
	$pstr .= $rowProducts[0].", ";
	} 
	$pstr = substr($pstr,0,-2);
	$pstr = "<strong>".$pstr."</strong>";
	echo $pstr;

	?>

		</td>
		<td>
		INV<?php echo $row[1];?>
		</td>
		<td>
		<?php echo $row[4];?>
		</td>
				<td>
		<?php echo date("d M, Y",strtotime($row[0]));;?></td>
<td>
<?php
if($row[5] == '0')
{
?>
<span id="upBt<?php echo $row[1];?>">
<input name="Button1" type="button" value="Click To Approve" class="button" title="(Click To mark As Paid)" onclick="approveInvoice('<?php echo $row[1];?>')" />

</span>
<?php
}
else
{
?>
<div class="buttonBlue" style="display:inline-block"  onclick="getModule('invoice/presendinvoice?invoiceid=<?php echo $row[1]?>','viewmoodleContent','','Invoice')">Send Invoice&nbsp;&nbsp;<img src="images/next.png" style="height:18px;vertical-align:middle;" /></div>
<?php
}

?>
</td>
		
		<?php
$i++;
}
?>
</tr>
</table>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<div id="moreData">
</div>
</div>



