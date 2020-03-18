<?php 
include("../../include/conFigclient.php");

$getData = mysql_query("SELECT contact.fname,contact.lname,contact.mobile,contact.email,userprofile.userid,contact.id  FROM contact,userprofile WHERE contact.id = $loggeduserid AND contact.converted = '1' AND contact.ownerid = userprofile.userid",$con) or die(mysql_error());
$rowClient = mysql_fetch_array($getData);
$getData1 = mysql_query("SELECT userprofile.displayname,userprofile.pic,userprofile.mobile,userprofile.email,employee.id,contact.ownerid FROM userprofile,employee,contact WHERE  userprofile.userid = employee.id  AND  userprofile.userid = contact.ownerid ",$con) or die(mysql_error());
$rowManager = mysql_fetch_array($getData1);


$cid = $rowClient[5];
$getData2 = mysql_query("SELECT product.name, servicecall.fromdate, servicecall.todate, servicecall.approved, servicecall.cid FROM servicecall,product,contact WHERE servicecall.approved = '1' AND product.id = servicecall.product AND servicecall.cid = contact.id AND servicecall.cid='$cid' AND servicecall.type = 'c'",$con) or die(mysql_error());

?>


<table cellpadding="0" cellspacing="0" style="width: 100%">
<tr>
<td style="width:35%" valign="top">
<div  style="background:#eee;min-height:30px" class="moduleHeading">
			Welcome <?php echo $loggeduser ;?>...<br />
			Its Great To See You!!!</div><br/>
			<table style="padding: 5px 0 0 5px">
			<tr>
				<td><b>My Details:-- </b>
				<table cellpadding="0" cellspacing="0" style="padding: 5px 0 0 5px">
					<tr>
						<th>Name</th>
						<td style="padding-left: 10px;"><?php echo $rowClient['fname']?>
						</td>
					</tr>
					<tr>
						<th>Mobile</th>
						<td style="padding-left: 10px"><?php echo $rowClient['mobile']?>
						</td>
					</tr>
					<tr>
						<th>Email</th>
						<td style="padding-left: 10px"><?php echo $rowClient['email']?>
						</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>

</td>
<td style="width:35%" valign="top">
<div  style="background:#eee;min-height:30px" class="moduleHeading">
			Your Relationship Manager Details!!!<br/><br/>
				</div><br/>
				<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td><b>Details:-- </b>
				<table cellpadding="0" cellspacing="0" style="padding: 5px 0 0 5px">
					<tr>
						<th>Name</th>
						<td style="padding-left: 10px;"><?php echo $rowManager['displayname']?>
						</td>
					</tr>
					<tr>
						<th>Mobile</th>
						<td style="padding-left: 10px;"><?php echo $rowManager['mobile']?>
						</td>
					</tr>
					<tr>
						<th>Email</th>
						<td style="padding-left: 10px;"><?php echo $rowManager['email']?>
						</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
</td>
</tr>
<tr>
<td style="width:35%" valign="top">
<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td>
				<div class="moduleHeading" style="background:#eee;min-height:30px">
					Subscription Details!!!<br />
					<br />
				</div>
			</td>
			
			</tr>
			<tr>
				<td colspan="8">
				<table cellpadding="0" cellspacing="0" class="fetch" style="padding-left: 5px;" width="100%">
					<tr>
						<th>Product</th>
						<th>Start Date</th>
						<th>End Date</th>
					</tr>
					<?php
$i=0;
while($row = mysql_fetch_array($getData2))
{
?>
					<tr>
						<td><?php echo $row[0];?></td>
						<td><?php echo $row[1];?></td>
						<td><?php echo $row[2];?></td>
					</tr>
					<?php
$i++;
$Maxid = $row[4];
$MaxI = $i;
}
?>
				</table>
				</td>
			</tr>
		</table>
</td>
<td style="width:35%" valign="top">

<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td>
				<div class="moduleHeading" style="background:#eee;min-height:30px">
					Subscription Details!!!<br />
					<br />
				</div>
			</td>
			
			</tr>
			<tr>
				<td colspan="8">
				<table cellpadding="0" cellspacing="0" class="fetch" style="padding-left: 5px;" width="100%">
					<tr>
						<th>Product</th>
						<th>Start Date</th>
						<th>End Date</th>
					</tr>
					<?php
$i=0;
while($row = mysql_fetch_array($getData2))
{
?>
					<tr>
						<td><?php echo $row[0];?></td>
						<td><?php echo $row[1];?></td>
						<td><?php echo $row[2];?></td>
					</tr>
					<?php
$i++;
$Maxid = $row[4];
$MaxI = $i;
}
?>
				</table>
				</td>
			</tr>
		</table></td>
</tr>

</table>


