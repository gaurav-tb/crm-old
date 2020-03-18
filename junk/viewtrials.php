<?php
include("../include/conFig.php");
$cid = $_GET['cid'];
$getData = mysql_query("SELECT product.name, servicecall.fromdate, servicecall.todate, servicecall.approved, servicecall.cid FROM servicecall,product,contact WHERE product.id = servicecall.product and servicecall.cid = contact.id and servicecall.cid='$cid'",$con) or die(mysql_error());

?>
<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Previous Free Trials</td>
			<td align="right" style="width: 70%">
		
			Show&nbsp;&nbsp;<select name="Select1" class="input" id="todo" onchange="showCustomRows(this.value,'viewtable')">
				<option value="All">All</option>
				<option value="Approved">Approved</option>
				<option value="Unapproved">Unapproved</option>
				<option value="Denied">Denied</option>

			</select>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>
</div>
<div id="directResult">
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch"  style="padding-left:5px; "width="100%">
	<tr>
		<th style="height: 20px">Product</th>
		<th style="height: 20px">Start Date</th>
		<th style="height: 20px">End Date</th>
		<th style="height: 20px">Status</th>
		
	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>"title="<?php if($row[3] == '0') echo "Unapproved"; else if($row[3] == '1') echo "Approved"; else echo "Denied" ?>">
		<td>
		<?php echo $row[0];?></td>
		<td >
		<?php echo $row[1];?>
		</td>
		<td>
		<?php echo $row[2];?>
		</td>
		<td><?php
		if($row[3] == '1')
		echo 'Approved';
		else if($row[3] == '0')
		echo 'Unapproved';
		else
		echo 'Denied';
		?>
		
		</td>
			
	</tr>
	<?php
$i++;
$Maxid = $row[4];
$MaxI = $i;
}
?>
</table>
<div id="moreData">
</div>
</div>
<div id="directResult"></div>
