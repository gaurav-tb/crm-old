<?php 
include("../include/conFig.php");
$invoiceid=$_GET['cid'];
//echo "SELECT * FROM `sentitems` WHERE `invoiceid` IN ((SELECT id FROM `invoice` WHERE `cid`='$cid'))";
$getdata=mysql_query("SELECT * FROM `sentitems` WHERE `invoiceid` IN ((SELECT id FROM `invoice` WHERE `cid`='$invoiceid'))");
//$row = mysql_fetch_array($getdata);

?>

<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Sent Mails</td>
		</tr>
	</table>
</div>
<div>
<table cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		
		<th style="width:20%" align="left">Email</th>
		<th style="width:70%" align="left">Subject</th>
		<th style="width:10%" align="left">Date</th>
	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getdata))
{
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>">
		
		<td style="width: 152px" onclick="getModule('billing/viewsentmails?invoiceid=<?php echo $row['id']?>','manipulatemoodleContent','viewmoodleContent','Invoice')" type="button" value="View Sent Mails"/>
		<strong>
		<?php echo $row[1];?></strong></td>
		<td align="left">
		<?php echo substr($row[2],0,100);?>..
		</td>
		<td>
		<?php echo date("M d",strtotime($row[5]));?>
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
<div class="moduleFoot">
</div>
</div>
