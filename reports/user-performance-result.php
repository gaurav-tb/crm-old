<?php
include("../include/conFig.php");

$fromdate = $_GET['f']." 00:00:00";
$todate = $_GET['t']." 23:59:59";
$owner = $_GET['u'];

if($owner == '')
{
$owstr = "(1=1)";
}
else
{
$owstr = "contact.ownerid = '$owner'";
}
$getName=mysql_query("SELECT employee.name, profile.description, userprofile.pic FROM contact,employee,profile,userprofile WHERE  ".$owstr." AND contact.ownerid = employee.id AND profile.id = employee.profile AND userprofile.userid = employee.id") or die(mysql_error());
$name = mysql_fetch_array($getName);

$getLAlloted = mysql_query("SELECT contact.id FROM contact,employee WHERE contact.alloted = '1' AND contact.self = '0' AND contact.genby = employee.id AND contact.createdate BETWEEN '$fromdate' AND '$todate'",$con) or die(mysql_error()); 
$count = mysql_num_rows($getLAlloted);
$getLCreated = mysql_query("SELECT contact.id FROM contact,employee WHERE contact.alloted = '1' AND contact.self = '1' AND contact.ownerid = employee.id  AND ".$owstr." AND  contact.createdate BETWEEN '$fromdate' AND '$todate'",$con) or die(mysql_error()); 
$count1 = mysql_num_rows($getLCreated);
$getLModified = mysql_query("SELECT contact.id FROM contact,employee WHERE contact.alloted = '1' AND contact.ownerid = employee.id  AND ".$owstr." AND  contact.modifieddate BETWEEN '$fromdate' AND '$todate'",$con) or die(mysql_error()); 
$count2 = mysql_num_rows($getLModified);
$getCalls=mysql_query("SELECT noteline.id FROM noteline,contact,employee WHERE noteline.subject ='Call' AND noteline.cid = contact.id AND ".$owstr." AND contact.ownerid = employee.id  AND  noteline.createdate BETWEEN '$fromdate' AND '$todate'",$con) or die(mysql_error());
$count3 = mysql_num_rows($getCalls);
$getMeetings=mysql_query("SELECT noteline.id FROM noteline,contact,employee WHERE noteline.subject ='Meeting' AND noteline.cid = contact.id AND ".$owstr." AND contact.ownerid = employee.id  AND  noteline.createdate BETWEEN '$fromdate' AND '$todate'",$con) or die(mysql_error());
$count4 = mysql_num_rows($getMeetings);
$getFreetrial = mysql_query("SELECT servicecall.id FROM servicecall,employee,contact WHERE servicecall.type = 'f' AND servicecall.cid = contact.id  AND ".$owstr." AND contact.ownerid = employee.id  AND  servicecall.createdate BETWEEN '$fromdate' AND '$todate' ",$con) or die(mysql_error());
$count5 = mysql_num_rows($getFreetrial);
$getFtGiven = mysql_query("SELECT servicecall.id FROM servicecall,employee,contact WHERE  servicecall.type = 'f' AND servicecall.approved = '1' AND servicecall.cid = contact.id  AND ".$owstr." AND contact.ownerid = employee.id  AND  servicecall.createdate BETWEEN '$fromdate' AND '$todate'",$con) or die(mysql_error());
$count6 = mysql_num_rows($getFtGiven);
$getServicecall = mysql_query("SELECT servicecall.id FROM servicecall,employee,contact WHERE servicecall.type = 'c' AND servicecall.cid = contact.id  AND ".$owstr." AND contact.ownerid = employee.id  AND  servicecall.createdate BETWEEN '$fromdate' AND '$todate'",$con) or die(mysql_error());
$count7 = mysql_num_rows($getServicecall);
$getScGiven = mysql_query("SELECT servicecall.id FROM servicecall,employee,contact WHERE  servicecall.type = 'c' AND servicecall.approved = '1' AND servicecall.cid = contact.id  AND ".$owstr." AND contact.ownerid = employee.id  AND  servicecall.createdate BETWEEN '$fromdate' AND '$todate'",$con) or die(mysql_error());
$count8 = mysql_num_rows($getScGiven);
$total = mysql_query("SELECT SUM(invoice.grandtotal) FROM invoice,employee,contact WHERE invoice.approved = '1' AND invoice.cid = contact.id AND contact.ownerid = employee.id AND  ".$owstr."  AND  invoice.createdate BETWEEN '$fromdate' AND '$todate'",$con) or die(mysql_error());
$sum = mysql_fetch_array($total);
?>

<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Performance Report</td>
			<td align="right" style="width: 70%">
			
			<div style="float:right;margin:5px;">
<img src="<?php echo str_ireplace("../","",$name[2])?>" style="height:40px; width:40px;border:0px;"  />
</div>
<span class="blueSimpletext"><?php echo $name[0];?></span><br/>
<em style="font-size:12px;"><?php echo $name[1]?>
</em>
	
			</td>
		</tr>
	</table>
</div>

<table width="100%" cellpadding="10" cellspacing="0" class="form">
<tr>
<td colspan="4" align="center" style="font-size:24px;">
From <?php echo date("d-M-y",strtotime($fromdate));?> to <?php echo date("d-M-y",strtotime($todate));?>

</td>
</tr>
<tr><td valign="top" align="right" style="width:200px;"><strong>Leads Alloted</strong></td><td align="left"><?php echo $count;?></td><td valign="top" align="right">
	<strong>Leads Created</strong></td><td align="left"><?php echo $count1;?></td></tr>
<tr><td valign="top" align="right"><strong>Leads Modified</strong></td><td align="left"><?php echo $count2;?></td><td valign="top" align="right">
	<strong>Calls Made</strong></td><td align="left"><?php echo $count3;?></td></tr>
<tr><td valign="top" align="right"><strong>Meetings</strong></td><td align="left"><?php echo $count4;?></td>
</tr><tr>
<td valign="top" align="right" style="border-top:2px #89A54E solid ;"><strong>Freetrials Requested</strong></td><td style="border-top:2px #89A54E solid ;" align="left"><?php echo $count5;?></td><td style="border-top:2px #89A54E solid ;" valign="top" align="right">
		<strong>Freetrials Given</strong></td><td style="border-top:2px #89A54E solid ;" align="left"><?php echo $count6;?></td></tr>
<tr><td valign="top" align="right"  style="border-top:2px #4572A7 solid"><strong>ServiceCalls Requested</strong></td><td style="border-top:2px #4572A7 solid" align="left"><?php echo $count7;?></td><td style="border-top:2px #4572A7 solid" valign="top" align="right">
	<strong>ServiceCalls Given</strong></td><td style="border-top:2px #4572A7 solid" align="left"><?php echo $count8;?></td></tr>
<tr>

<td colspan="3" style="border-top:2px #b82121 solid;font-size:16px;" valign="top" align="right">
<strong>Total Revenue Generated</strong></td><td style="border-top:2px #b82121 solid;font-size:16px;"  align="left">
	<strong><?php echo $sum[0]?></strong></td></tr>
<tr>
<td colspan="4">
<iframe src="dash/page.php?label=Calls*Meetings*Conversions&num=<?php echo $count3;?>*<?php echo $count4;?>*<?php echo $count8;?>" scrolling="no" frameborder="0" style="width:100%;height:300px;"></iframe>
</td>
</tr>
</table>
