<?php
include("../include/conFig.php");
$id=$_GET['cid'];
//echo "SELECT invoice.createdate, invoice.id, contact.fname, contact.lname, invoice.grandtotal,contact.id FROM contact,servicecall,invoice WHERE invoice.cid = contact.id AND servicecall.cid = contact.id AND servicecall.transactionalid = invoice.transactionalid AND invoice.delete = '0' AND contact.id ='$id' ORDER BY invoice.id DESC LIMIT 100";
$getData = mysql_query("SELECT invoice.createdate, invoice.id, invoice.grandtotal, invoice.approved,invoice.transactionalid FROM invoice WHERE invoice.cid = '$id' AND invoice.delete = '0'",$con) or die(mysql_error());
?>
<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Billing Information</td>
			<td align="right" style="width: 70%">
			
			Show&nbsp;&nbsp;<select name="Select1" class="input" id="todo" style="padding:2px;" onchange="showCustomRows(this.value,'viewtable')">
				<option value="All">All</option>
				<option value="Approved">Approved</option>
				<option value="Unapproved">Unapproved</option>
</select>
<?php if(in_array('B_ANB_clients',$thisPer)) {?>
<div class="buttonGreen rightRound" style="display:inline-block" onclick="getModule('billing/new?cid=<?php echo $_GET['cid']?>&mobile=<?php echo $_GET['mobile']?>&bill=repeat&name=<?php echo $_GET['name'];?>&bill=new','manipulatemoodleContent','viewmoodleContent','<?php echo $_GET['name'];?>-New Bill')">Or Add A New Bill</div>
<?php } ?>			
			</td>
		</tr>
	</table>
</div>
<div id="directResult">
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
			<th style="height: 19px"></th>
			<th style="height: 19px">Particulars</th>

		<th style="height: 19px">Invoice No</th>

		<th style="height: 19px">Net Amount Paid</th>
		<th style="height: 19px">Dated</th>
	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	<tr id="fetchRow<?php echo $i;?>"  class="d<?php echo $i%2;?>" title="<?php if($row[3] == '0') echo "Unapproved"; else echo "Approved"; ?>">
		<td>
		<?php
		if($row[3] == '0')
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
		<td  <?php if(in_array('EB_control',$thisPer)) {?> onclick="getModule('billing/edit?id=<?php echo $row[1];?>&i=<?php echo $i;?>&cid=<?php echo $id;?>','manipulatemoodleContent','viewmoodleContent','Bill')" <?php } else {?>onclick="getModule('invoice/generateinvoice?id=<?php echo $row[1];?>&i=<?php echo $i;?>','manipulatemoodleContent','viewmoodleContent','Fetching Data..')"	<?php }?> >
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



