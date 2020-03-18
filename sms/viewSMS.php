<?php 
include("../include/conFig.php");
$cid=$_GET['clid'];
$getdata=mysql_query("SELECT sentsms.mobile,sentsms.sms,sentsms.createdate,sentsms.id FROM sentsms,contact WHERE sentsms.cid = '$cid' AND sentsms.cid = contact.id AND sentsms.delete = '0'",$con) or die(mysql_error());

?>
<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Sent Messages List<span style="text-transform:capitalize"><?php echo $_GET['name'];?></span></td>
			<td align="right"><div class="buttonGreen rightRound" style="display:inline-block" onclick="getModule('sms/newSMS?cid=<?php echo $cid?>&mobile=<?php echo $_GET['mobile']?>&bill=repeat&name=<?php echo $_GET['name'];?>','viewmoodleContent','manipulatemoodleContent','SMS')">Compose New</div>
			</td>
		</tr>
	</table>
</div>
<div>
<table cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		
		<th style="width:20%;" align="left">Mobile</th>
		<th style="width:70%;" align="left">SMS</th>
		<th style="width:10%;" align="left">Date</th>
	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getdata))
{
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>">
		
		<td style="width: 152px;">
		<strong onclick="getModule('sms/viewsentSMS?cid=<?php echo $cid?>','viewmoodleContent','manipulatemoodleContent','Sent SMS')">
		<?php echo substr($row[0], 0, 0) . 'XXXXXXX' . substr($row[0],  -3);?></strong></td>
		<td align="left">
		<?php echo substr($row[1],0,80);?>..
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
