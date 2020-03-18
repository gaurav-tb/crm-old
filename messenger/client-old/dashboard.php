<?php
include("../../include/conFigclient.php");

$getData = mysql_query("SELECT contact.fname,contact.lname,contact.mobile,contact.email,contact.address,userprofile.userid,contact.id  FROM contact,userprofile WHERE contact.id = $loggeduserid AND contact.converted = '1' AND contact.ownerid = userprofile.userid",$con) or die(mysql_error());
$rowClient = mysql_fetch_array($getData);
$getData1 = mysql_query("SELECT userprofile.displayname,userprofile.pic,userprofile.mobile,userprofile.email,employee.id,contact.ownerid FROM userprofile,employee,contact WHERE contact.id = $loggeduserid AND userprofile.userid = employee.id  AND  employee.id = contact.ownerid ",$con) or die(mysql_error());
$rowManager = mysql_fetch_array($getData1);


$dash = 'dash';
$cid = $loggeduserid;
$getData2 = mysql_query("SELECT product.name, servicecall.fromdate, servicecall.todate, servicecall.approved, servicecall.cid FROM servicecall,product,contact WHERE servicecall.approved = '1' AND product.id = servicecall.product AND servicecall.cid = contact.id AND servicecall.cid='$cid' AND servicecall.type = 'c'",$con) or die(mysql_error());



?>
<div class="moduleHeading">
	Welcome to Capital Builder&#39;s Messenger Lab! </div>
<table cellpadding="0" cellspacing="5" width="100%">
	<tr>
		<td style="width: 50%; height: 170px; background: #fff;" valign="top">
		<div class="buttonBlue" style="border-radius:0px;text-align:left;padding:5px;">
			My Details </div>
		<div class="form" style="height:170px;">
			<br />
			<table cellpadding="5" cellspacing="0" width="100%" style="font-size:11px; cursor:pointer">
				<tr>
					<td align="right"><strong>Name:</strong></td>
					<td align="left"><?php echo $rowClient['fname']?></td>
				</tr>
				<tr>
					<td align="right"><strong>Mobile Number:</strong></td>
					<td align="left"><?php echo $rowClient['mobile']?>
	</td>
				</tr>
				<tr>
					<td align="right"><strong>Email Id:</strong></td>
					<td align="left"><?php echo $rowClient['email']?>
</td>
				</tr>
				<tr>
					<td align="right" valign="top"><strong>Mailing Address:</strong></td>
					<td align="left"><?php echo $rowClient['address']?></td>
				</tr>
			</table>
		</div>
		</td>
				<td style="width: 50%; height: 170px; background: #fff;" valign="top">
		<div class="buttonBlue" style="border-radius:0px;text-align:left;padding:5px;">
			My Relationship Manager </div>
		<div class="form" style="height:170px;">
			<br />
	
			<table width="100%" cellpadding="0" cellspacing="0" style="cursor:pointer">
			<tr>
			<td style="width:16%" valign="top">
			<div style="margin:5px;">
			<img src="../<?php echo $rowManager[1]?>" alt="" style="border:4px #fff solid;box-shadow:0px 0px 3px 0px #444;" height="110"/>
			</div>
			</td>
			<td valign="top" style="padding-left:10px">
			<span style="color:#2F487E;font-size:12px;"><?php echo $rowManager['displayname']?></span>
			<br/>
			<em style="font-size:11px;color:#999;">Business Development Executive</em>
						<br/>
						<?php
					//	echo "SELECT * FROM  `noteline`  where `cid` = '$loggeduserid' and `subject` = 'call' and `delete` = '0'";
						$getVal=mysql_query("SELECT * FROM  `noteline`  where `cid` = '$loggeduserid' and `subject` = 'call' and `delete` = '0' ",$con)or die(mysql_error());
						$count = mysql_num_rows($getVal)
						?>
			Contacted <?php echo $count ?> times.

			
			<div style="float:right;font-size:11px;font-weight:bold;text-align:right;margin-right:10px;">
			<br/><br/><br/>
			<div style="background:#72AC57;padding:3px 5px;;color:#fff;;box-shadow:0px 0px 3px 0px #222;;width:100px;display:inline-block">
			<img src="../../images/phone1.png" style="height:12px;vertical-align:middle" alt=""/>&nbsp;&nbsp;<?php echo $rowManager['mobile']?>
			</div><br/><br/>
			<div style="background:#DD4B39;padding:3px 5px;color:#fff;;box-shadow:0px 0px 3px 0px #222;">
			<img src="../../images/mail.png" style="height:12px;vertical-align:middle" alt=""/>&nbsp;&nbsp;<?php echo $rowManager['email']?>
			</div>
			</div>
			</td>
			</tr>
			</table>

		</div>
		</td>

	</tr>
	<tr>
		<td style="width: 50%; height: 300px; background: #fff;" valign="top">
		<div class="buttonBlue" style="border-radius:0px;text-align:left;padding:5px;">
		My Subscription Details</div>
		<div class="form" style="height:300px;overflow-x:hidden;overflow-y:auto;padding:0px;">
			<table cellpadding="0" cellspacing="0" class="fetch" style="padding-left: 5px;" width="100%">
								<tr>
						<th style="background:#F9EDBE;color:#222">Product</th>
						<th style="background:#F9EDBE;color:#222">Start Date</th>
						<th style="background:#F9EDBE;color:#222">End Date</th>
					</tr>

					<?php
$i=0;
while($row = mysql_fetch_array($getData2))
{
?>
					<tr class="d<?php echo $i%2;?>">
						<td><?php echo $row[0];?></td>
						<td><?php echo $row[1];?></td>
						<td><?php echo $row[2];?></td>
					</tr>
					<?php
$i++;
}
?>
				</table>

		</div>
		</td>
				<td style="width: 50%; height: 300px; background: #fff;" valign="top">
		<div class="buttonBlue" style="border-radius:0px;text-align:left;padding:5px;">
			My Billing Details </div>
		<div class="form" style="height:300px;">
				<table cellpadding="0" cellspacing="0" class="fetch" style="padding-left: 5px;" width="100%">
											<tr>
			
								<th style="background:#F9EDBE;color:#222">Particulars</th>

		<th style="background:#F9EDBE;color:#222">Invoice No</th>

		<th style="background:#F9EDBE;color:#222">Net Amount Paid</th>
		<th style="background:#F9EDBE;color:#222">Dated</th>

					</tr>

	<?php
	$getData3 = mysql_query("SELECT invoice.createdate, invoice.id, invoice.grandtotal, invoice.approved,invoice.transactionalid FROM invoice WHERE invoice.cid = '$cid' AND invoice.approved = '1' AND invoice.delete = '0'",$con) or die(mysql_error());
	$i=0;
while($row = mysql_fetch_array($getData3))
{
?>
	<tr id="fetchRow<?php echo $i;?>"  class="d<?php echo $i%2;?>">
		
		<td  onclick="getModule('../../invoice/generateinvoice?id=<?php echo $row[1];?>&i=<?php echo $i;?>&new=<?php echo $dash;?>','manipulatemoodleContent','viewmoodleContent','Invoice')">
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
	

</tr>
	<?php
$i++;
}
?>
</table>


		</div>
		</td>

	</tr>

</table>
