<?php
include("../include/conFig.php");
$getData = mysql_query("SELECT  `contact`.`fname` ,  `contact`.`lname` ,`contact`.`id`,  `contact`.`code` ,  `employee`.`name` ,  `activatepremium`.`Plan` ,  `activatepremium`.`EmailSend` ,`activatepremium`.`PremiumActivationDate`,`activatepremium`.`Approval` ,`contact`.`mobile`
FROM  `contact` INNER JOIN  `employee` ON  `contact`.`ownerid` =  `employee`.`id`
INNER JOIN  `activatepremium` ON  `contact`.`id` = `activatepremium`.`cid`  WHERE `activatepremium`.`Approval` ='0' ORDER BY `activatepremium`.`id` DESC",$con) or die(mysql_error());
?>
<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
	<td align="left" style="width: 30%">Approve Brokerage Plan</td>
	<td align="right" style="width: 70%">
	</td>
	</tr>
	</table>
</div>
<div id="directResult"  style="height:600px;overflow:auto">
<table id="viewbilltable" cellpadding="0" cellspacing="0" class="fetch" width="100%" style="padding-right:5px">
<tr>
<th></th>
<th style="">RM Owner</th>
<th style="">Client Name</th>
<th style="">Client Code</th>
<th style="">Activation Plan</th>
<th style="">Email To Client</th>
<th style="">Activation Date</th>
<th style="">Click to call</th>
<th style="">Reject</th>
<th style="">Status</th>
</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
	
	
?>
	    <tr style="" id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php if($row['Approved'] == '0') echo "Unapproved"; else echo "Approved"; ?>">
		<td>
		<?php
		if($row['Approval'] == '0')
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
		
		<td>
		<?php //echo $row['name']

			$cid = $row['code'];
			$rmo1=mysql_query("select RMOwnerid from customersupport  where tradingbellsid = '$cid'");
			$getrm1 = mysql_fetch_array($rmo1);
			$rm = $getrm1['RMOwnerid'];
			$rmo=mysql_query("select name from employee where employee.id = '$rm'");
			$getrm = mysql_fetch_array($rmo); 
			echo $rmowner = $getrm['name'];
		?>
		</td>
		
		
		<td  class="blueSimpletext"  <?php if(in_array('EB_control',$thisPer)) {?> onclick="getModule('billing/checkBrokeragePlan?clid=<?php echo $row['id'];?>&i=<?php echo $i;?>&cid=<?php echo $row[9];?>','manipulatemoodleContent','viewmoodleContent','Brokerage Plan')" <?php } else {?>onclick="getModule('billing/checkBrokeragePlan?clid=<?php echo $row['id'];?>&i=<?php echo $i;?>&cid=<?php echo $row['id'];?>','manipulatemoodleContent','viewmoodleContent','Brokerage Plan');$('#fetchRow<?php echo $i;?>').hide();"	<?php }?> >
		<?php echo $row['fname']."&nbsp;".$row['lname'];?></td>
		
		
		<td>
		<?php echo $row['code']?>
		</td>
		
		<td>
		<?php if($row['Plan'] ==1){  echo 'Regular Brokerage Plan'; } else {  echo 'Premium Brokerage Plan';  }  ?>
		</td>
		
		<td>
		<?php if($row['EmailSend'] ==1){  echo 'Yes'; } else {  echo 'No';  }  ?>
		</td>
		
		<td>
		<?php echo date("d M, Y",strtotime($row['PremiumActivationDate']));?>
		</td>
		
   <td>
   <a class="blueSimpletext clickto" href="callto:<?php echo $row['mobile']; ?>">Click to call</a>
   </td>
   
   <td>
<span id="reject<?php echo $row['id'];?>">
<input name="Button1" type="button" value="Click To Reject" class="button" title="Click to reject premium plan" style="background-color: #ffebeb;" onclick="getModule('billing/rejectreasonpremium?cid=<?php echo $row['id'];?>&name=<?php echo $row['fname']." ".$row['lname'] ?>','manipulatemoodleContent','viewmoodleContent','rejectreason');$('#fetchRow<?php echo $i;?>').hide();" />
</span>
</td>

		 		
		<td>
		<?php   if($row['Approval'] ==1 ){  echo 'Approved'; } else {  echo 'Unapproved';  }  ?>
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



