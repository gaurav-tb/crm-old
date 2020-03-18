<?php
include("../include/conFig.php");
$todo = $_GET['todo'];
if($todo == 'All')
{
$todostr = "(1=1)";
}
else
{
$todostr = "invoice.approved = '$todo'";
}

//echo "SELECT invoice.createdate, invoice.id, contact.fname, contact.lname, invoice.grandtotal,contact.id FROM contact,servicecall,invoice WHERE invoice.cid = contact.id AND servicecall.cid = contact.id AND servicecall.transactionalid = invoice.transactionalid AND invoice.delete = '0' AND contact.id ='$id' ORDER BY invoice.id DESC LIMIT 100";
$getData = mysql_query("SELECT invoice.createdate, invoice.id, contact.mobile,  contact.fname, contact.lname, invoice.grandtotal,invoice.approved FROM contact,invoice WHERE invoice.cid = contact.id  AND invoice.delete = '0' AND ".$todostr." ORDER BY invoice.id DESC LIMIT 100",$con) or die(mysql_error());



?>

<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
				<th style="height: 20px">Name</th>
		<th style="height: 20px">Invoice No</th>
		<th style="height: 20px">Mobile No</th>
		<th style="height: 20px">Date</th>
		<th style="height: 20px">Net Amount Paid</th>
				<th style="height: 20px">Mark</th>

	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row[0]));?>">
		<td  onclick="getModule('billing/genrateinvoice?id=<?php echo $row[1];?>&i=<?php echo $i;?>','manipulatemoodleContent','viewmoodleContent','Fetching Data..')">
		<?php echo $row[3]."&nbsp;&nbsp;&nbsp;".$row[4];?></td>
		<td >
		<?php echo $row[1];?>
		</td>
		<td>
		<?php echo $row[2];?>
		</td>
				<td>
		<?php echo date("d-m-Y H:i:s",strtotime($row[0]));;?></td>
		<td>
		<?php echo $row[5];?>
		</td>
<td>
<?php
if($row[6] == '0')
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
<input name="Button1" type="button" class="" value="Send Invoice"  onclick="getModule('billing/presendinvoice?invoiceid=<?php echo $row[1]?>','viewmoodleContent','','Invoice')" />
<?php
}

?>
</td>
		
		<?php
$i++;
$Maxid = $row[2];
$MaxI = $i;
}
?>
</tr>
</table>

<div id="moreData">
</div>
<div class="moduleFoot">
	<div style="float: right;">
		<select id="fetchCount" style="vertical-align:middle" class="input" name="Select1" onchange="fetchMore('billing/fetchmore');">
		<option value="100">Fetch 100 Records</option>
		<option value="200">Fetch 200 Records</option>
		<option value="500">Fetch 500 Records</option>
		<option value="1000">Fetch 1000 Records</option>
		<option value="0">Fetch All Records</option>
		</select> </div>
	<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
	<div onclick="fetchMore('billing/fetchmore');" style="cursor: pointer;padding-top:5px;" id="fetchingDone">
	<img alt="" src="images/more.png" style="vertical-align: middle; width: 6px;" /> 
	More <span id="fetching" style="display: none">Fetching..</span></div>
</div>
