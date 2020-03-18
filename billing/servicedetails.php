<?php
include("../include/conFig.php");
$cid = $_GET['cid'];
$getData = mysql_query("SELECT product.name, servicecall.fromdate, servicecall.todate, servicecall.approved, servicecall.cid, servicecall.id,servicecall.alertexpiry FROM servicecall,product WHERE product.id = servicecall.product and servicecall.cid='$cid' AND servicecall.type = 'c'",$con) or die(mysql_error());

?>
<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Subscription Details For <?php echo $_GET['name'];?></td>
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
		<th>Product</th>
		<th>Start Date</th>
		<th>End Date</th>
		<th>Status</th>
		<th>Action</th>
		<th>Alert</th>
		
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
		<td id="status<?php echo $i?>"><?php
		if($row[3] == '1')
		echo 'Approved';
		else if($row[3] == '0')
		echo 'Unapproved';
		else if($row[3] == '3')
		echo 'Approved';
		else
		echo 'Denied';
		?>
		
		</td>
		<td>
		<?php
	
		if($row[3] == '1' || $row[3] == '3')
		{
		?>

		<input name="Button1" id="stop<?php echo $i?>" type="button" value="<?php if($row[3] == '3') {echo 'Stopped';}else {echo 'Running';} ?>" title="<?php if($row[3] == '3') {echo 'Click to start';}else {echo 'Running, Click to stop';} ?>" class="<?php if($row[3] == '3') {echo 'buttonnegetive';}else {echo 'buttonBlue';} ?>" onclick="stopFreetrial('<?php echo $row[5];?>','<?php echo $i?>')" />
		<input type="text" id="btnVal<?php echo $i;?>" style="display:none" value="<?php if($row[3] == '3') {echo '1';}else {echo '3';} ?>"/>
		<?php
		}
		else 	if($row[3] == '4')
		{
		?>
		<input name="Button1" id="" type="button" value="Completed" title="Completed" class="buttonGreen" />
		<?php
		}

		else
		{
		echo "Sent for Approval";
		}
		?>
		</td>
		<td>
		<span id="alert<?php echo $i;?>">
		<?php if($row[6] == '1')
		{
		?>
				<input name="Button1" id="off<?php echo $i?>" type="button" value="OFF" class="buttonnegetive" onclick="getModule('freetrial/alertOff?id=<?php echo $row[5];?>&todo=0&i=<?php echo $i;?>','alert<?php echo $i;?>','','')"/>
		<?php
		
		}
		else
		{
			?>
	<input name="Button1" id="off<?php echo $i?>" type="button" value="ON" class="buttonGreen" onclick="getModule('freetrial/alertOff?id=<?php echo $row[5];?>&todo=1&i=<?php echo $i;?>','alert<?php echo $i;?>','','')"/>		
	<?php
	
		}
		
		?>		
		
		</span>

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
