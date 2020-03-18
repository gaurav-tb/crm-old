<?php 
include("../include/conFig.php");
$cid=$_GET['clid'];
$getdata= mysql_query("SELECT  sentemail.email, sentemail.subject, sentemail.createdate, sentemail.id FROM sentemail,contact WHERE  sentemail.cid = '$cid' AND sentemail.cid = contact.id AND sentemail.delete = '0'",$con) or die(mysql_error());

?>
<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Sent Emails List<span style="text-transform:capitalize"><?php echo $_GET['name'];?></span></td>
			<td align="right"><div class="buttonGreen" style="display:inline-block;text-shadow:0px 0px 0px white" onclick="getModule('email/prenewemail?cid=<?php echo $cid?>','viewmoodleContent','manipulatemoodleContent','-New Email')">Compose New</div>
			</td>
		</tr>
	</table>
</div>
<div>
<table cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		
		<th style="width:45%;" align="left">Email</th>
		<th style="width:45%;" align="left">Subject</th>
		<th style="width:10%;" align="left">Date</th>
	</tr>
	<?php
    $i=0;
    while($row = mysql_fetch_array($getdata))
    { 
    ?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>">
		
	<td style="width:152px;">
	<strong onclick="getModule('email/sentEmail?eid=<?php echo $row[3];?>','viewmoodleContent','manipulatemoodleContent','Sent Email')">
	<?php echo $row[0];?></strong></td>
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
