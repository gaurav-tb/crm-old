<?php
include("../include/conFig.php");
//echo "SELECT contact.fname, contact.lname, contact.code,reduced_brokerage.Approved, contact.id, reduced_brokerage.RequestingDate, employee.name,reduced_brokerage.Approved,reduced_brokerage.FundAvailable,reduced_brokerage.brokeragePlan,reduced_brokerage.id as researchid,`contact`.`mobile` FROM reduced_brokerage INNER JOIN contact ON reduced_brokerage.cid = contact.id INNER JOIN employee ON employee.id = contact.ownerid WHERE (reduced_brokerage.Approved =  '1' || reduced_brokerage.Approved =  '0'  || ( reduced_brokerage.Approved =  '1' && reduced_brokerage.FundAvailable =  '3' )) AND reduced_brokerage.delete =  '0' ORDER BY `reduced_brokerage`.`id` DESC";
$getData = mysql_query("SELECT contact.fname, contact.lname, contact.code,reduced_brokerage.Approved, contact.id, reduced_brokerage.RequestingDate, customersupport.RMOwnerid,employee.name,reduced_brokerage.Approved,reduced_brokerage.FundAvailable,reduced_brokerage.brokeragePlan,reduced_brokerage.id as researchid,`contact`.`mobile`
FROM reduced_brokerage INNER JOIN contact ON reduced_brokerage.cid = contact.id INNER JOIN employee ON employee.id = contact.ownerid INNER JOIN customersupport on customersupport.tradingbellsid = contact.code
WHERE (reduced_brokerage.Approved =  '1' || reduced_brokerage.Approved =  '0'  || ( reduced_brokerage.Approved =  '1' && reduced_brokerage.FundAvailable =  '3' )
) AND reduced_brokerage.delete =  '0' ORDER BY `reduced_brokerage`.`id` DESC ",$con) or die(mysql_error());
// || researchbooster.Approved =  '0' 
?>


<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
	<td align="left" style="width: 30%">Approve Reduced Brokerage Plan</td>
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
<th style="">RM Owner</th>
<th style="">Client Name</th>
<th style="">Client Code</th>
<th style="">Requesting Date</th>
<!-- <th style="">Start Date</th>
<th style="">End Date</th> -->
<th style="">Brokerage Plan</th>
<th style="">Status</th>
<th style="">Reject</th>
<th style="">Click to Call</th>
</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{

?>
	    <tr style="" id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php if($row['Approved'] == '0') echo "Unapproved"; else echo "Approved"; ?>">
		<td>
		<?php
		if($row['Approved'] == '0')
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
		
		<!-- <td>
		<?php echo $row['name']?>
		</td> -->
		<td>
		<?php //echo
		 	$rm = $row['RMOwnerid'];

			$rmo=mysql_query("select name from employee where id = '$rm'");
			$getrm = mysql_fetch_array($rmo);
			echo $rmowner = $getrm['name'];
			// echo $rmowner;

		?>
		</td>
		
		<td  class="blueSimpletext"  onclick="getModule('billing/checkReducedBrokerage?clid=<?php echo $row['id'];?>&i=<?php echo $i;?>&researchid=<?php echo $row['researchid'];?>','manipulatemoodleContent','viewmoodleContent','Booster Bill');$('#fetchRow<?php echo $i;?>').hide();">
		<?php echo $row['fname']."&nbsp;".$row['lname'];?></td>
		
		
		<td>
		<?php echo $row['code']?>
		</td>
		
		
		<td>
		<?php echo date("d M, Y",strtotime($row['RequestingDate']));?>
		</td>
		
		<td>
		<?php 
		$brokeragePlan = $row['brokeragePlan'];
		if($brokeragePlan == 1){
			echo "Silver";
		}else if($brokeragePlan == 2){
			echo "Gold";
		}else if($brokeragePlan == 3){
			echo "Diamond";
		}else if($brokeragePlan == 4){
			echo "Platinum";
		}else{
			echo "--"; 
		}
		?>
		</td>
        
		<!-- <td>
		<?php   echo date("d M, Y",strtotime($row['EndDate'])); //d M, Y?>
		</td> -->
		
		<td>
		<?php  if($row['service'] == 2 ){  echo 'Free Trial';  ?>  <?php  } else {  echo 'Paid Services';  }  ?>
		</td>
		
		
		<?php if($row['FundAvailable']=='3' && $row['Approved']=='1') { ?>
		
		<td><?php echo 'Fund Insufficient' ; ?> </td>
		
		<?php    } else {  ?>
		<td>
		<?php echo 'Unapproved' ; ?> 
		</td>
		<?php } ?> 
		
<td>
<span id="reject<?php echo $row['id'];?>">
<input name="Button1" type="button" value="Click To Reject" class="button" title="Click to reject client conversion request" style="background-color: #ffebeb;" onclick="getModule('billing/rejectreasonreduced?researchid=<?php echo $row['researchid']  ?>&cid=<?php echo $row['id'];?>','manipulatemoodleContent','viewmoodleContent','rejectreason');$('#fetchRow<?php echo $i;?>').hide();" />
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



