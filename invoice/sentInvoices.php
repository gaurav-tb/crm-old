<?php 
include("../include/conFig.php");
$cid=$_GET['cid'];
$getdata=mysql_query("SELECT sentitems.email,invoice.totalprice,sentitems.createdate,sentitems.id FROM sentitems,invoice WHERE invoice.id = sentitems.invoiceid AND invoice.cid = '$cid'",$con) or die(mysql_error());
?>
<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Previous Invoices Sent To <span style="text-transform:capitalize"><?php echo $_GET['name'];?></span></td>
		</tr>
	</table>
</div>
<div>
<table cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		
		<th style="width:20%" align="left">Email</th>
		<th style="width:70%" align="left">Amount</th>
		<th style="width:10%" align="left">Date</th>
	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getdata))
{
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>">
		
		<td style="width: 152px">
		<strong onclick="getModule('invoice/previewSentInvoice?invoiceid=<?php echo $row[3]?>','manipulatemoodleContent','viewmoodleContent','Sent Invoice')">
		<?php echo $row[0];?></strong></td>
		<td align="left">
		<?php echo $row[1];?>..
		</td>
		<td>
		<?php echo date("M d,Y",strtotime($row[2]));?>
		</td>
	</tr>
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
