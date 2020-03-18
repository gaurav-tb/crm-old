<?php
include("../include/conFig.php");
$getData = mysql_query("SELECT contact.conversionrequestdate, invoice.id,  contact.fname, contact.lname, invoice.grandtotal,invoice.approved,invoice.transactionalid,employee.name,invoice.partialpayment,invoice.cid,contact.pending,contact.mobile,contact.code FROM contact,invoice,employee WHERE contact.ownerid = employee.id AND invoice.cid = contact.id AND invoice.approved = '0'  AND invoice.delete = '0' AND `contact`.`Level1Approval`='0' ORDER BY invoice.id DESC",$con) or die(mysql_error());
?>
<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
	<td align="left" style="width: 30%">Level 1 Approval</td>
	<td align="right" style="width: 70%">
			<!--Show&nbsp;&nbsp;<select name="Select1" class="input" id="todo" onchange="showCustomRows(this.value,'viewbilltable')">
				<option value="All">All</option>
				<option value="Approved">Approved</option>
				<option value="Unapproved">Unapproved</option>
			</select> -->
	</td>
	</tr>
	</table>
</div>
<div id="directResult"  style="height:600px;overflow:auto">
<table id="viewbilltable" cellpadding="0" cellspacing="0" class="fetch" width="100%" style="padding-right:5px">
	    <tr>
	    <th></th>
	    <th style="">Client Code</th>
		<th style="">Name</th>
		<th style="">Owner</th>
		<th style="">Date</th>
		<th style="">Approve</th>
		<th style="">Reject</th>
		<th style="">Pending</th>
		<th style="">Click to call</th>
	<!--<th>Request</th>
		<th>Delete</th> -->
	    </tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
//echo '<pre>'; print_r($row);
//echo "SELECT `id` FROM `invoice` WHERE `cid` = '$row[9]' AND `approved` = '1'";
?>
	    <tr style="" id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php if($row[5] == '0') echo "Unapproved"; else echo "Approved"; ?>">
		<td>
		<?php
		if($row[5] == '0')
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
		<td><?php echo $row['code']?></td>
		<td  class="blueSimpletext"  <?php if(in_array('EB_control',$thisPer)) {?> onclick="getModule('billing/preConvertClient?clid=<?php echo $row[9];?>&i=<?php echo $i;?>&cid=<?php echo $row[9];?>','manipulatemoodleContent','viewmoodleContent','Bill')" <?php } else {?>onclick="getModule('billing/preConvertClient?clid=<?php echo $row[9];?>&i=<?php echo $i;?>&cid=<?php echo $row[9];?>','manipulatemoodleContent','viewmoodleContent','Bill')"	<?php }?> >
		<?php echo $row[2]."&nbsp;".$row[3];?></td>
		<td>
		<?php echo $row[7];?>
		</td>
		
		<td>
		
		<?php   echo  date('d M, Y h:i A', strtotime($row[0])); /* date("d M, Y",strtotime($row[0]));; //d M, Y */?></td>
<td>
<?php
if($row[5] == '0')
{
?>
<span id="upBt<?php echo $row[1];?>">
<input name="Button1" type="button" value="Click To Approve" class="button" title="Click To Fill Payment" onclick="confirmApproved(<?php echo $row[9];?>,<?php echo $row[1];?>);$('#fetchRow<?php echo $i;?>').hide();" />
<!-- onclick="getModule('billing/preUpdatePay?invid=<?php echo $row[1];?>&i=<?php echo $i;?>&cid=<?php echo $row[9];?>&name=<?php echo $row[2];?>','manipulatemoodleContent','viewmoodleContent','preUpdatePay');"
-->
</span>
<?php
}
else
{
?>
<div class="buttonBlue" style="display:inline-block"  onclick="getModule('invoice/presendinvoice?invoiceid=<?php echo $row[1]?>','viewmoodleContent','','Invoice')">Send Invoice&nbsp;&nbsp;<img src="images/next.png" style="height:18px;vertical-align:middle;" /></div>
<?php
}
?>
</td>


<td>
<span id="reject<?php echo $row[1];?>">
<input name="Button1" type="button" value="Click To Reject" class="button" title="Click to reject client conversion request" style="background-color: #ffebeb;" onclick="getModule('billing/rejectreason?invid=<?php echo $row[1];?>&i=<?php echo $i;?>&cid=<?php echo $row[9];?>','manipulatemoodleContent','viewmoodleContent','rejectreason');$('#fetchRow<?php echo $i;?>').hide();" />
</span>
</td>

<td>
<span id="pending<?php echo $row[10];?>">
<input name="Button1" <?php if($row[10]==1){?> value="Client Is on Pending" style="background-color:#ff9800;"<?php  } else {   ?> style="background-color:lightsteelblue;" value="Click For Pending" <?php } ?>  type="button" class="button" title="Click to Pending client conversion request"  onclick="getModule('billing/pendingreason?invid=<?php echo $row[1];?>&i=<?php echo $i;?>&cid=<?php echo $row[9];?>&pending=<?php echo $row[10] ?>','manipulatemoodleContent','viewmoodleContent','rejectreason');" />
</span>
</td> 

<td>
<a class="blueSimpletext clickto" href="callto:<?php echo $row['mobile']; ?>">Click to call</a>
</td>
		


<!-- 
<td><?php if($count == 0){echo 'New';} else echo 'Renewal';?></td>
<td><img src="images/delete-can.png" style="height:15px;cursor:pointer" title="Delete Bill"  alt=""  onclick="var r=confirm('Are You Sure You Want To Delete this Bill?');if (r==true){getModule('billing/deleteBill?invid=<?php echo $row[1]?>','','','');document.getElementById('fetchRow<?php echo $i;?>').style.display='none'}"/>
</td> -->
<?php
$i++;
}
?>
</tr>
</table>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<div id="moreData">
</div>
</div>



