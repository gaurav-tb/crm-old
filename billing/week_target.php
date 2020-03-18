<?php 
include("../include/conFig.php");
$cid=$_GET['clid'];
$getData = mysql_query("SELECT contact.fname, contact.lname, contact.ownerid, contact.code,contact.id,contact.inroducer,`contact`.`%brokerage`,employee.name,expensereport.RevenueForOwner, SUM(expensereport.BrokeragePremium) As premiumBrokerage, SUM( expensereport.Turnover ) as Turnover ,SUM( (( `expensereport`.`RevenueGeneration` )+( `expensereport`.`BrokeragePremium` )) * ( `expensereport`.`RevenueForOwner` ) ) AS grossbrokerage,SUM( ( ( (( `expensereport`.`RevenueGeneration` )+( `expensereport`.`BrokeragePremium` )) * ( `expensereport`.`RevenueForOwner` ) ) * ( `contact`.`%brokerage` )/100) ) AS payouts
FROM  `contact` INNER JOIN  `employee` ON  `contact`.`ownerid` =  `employee`.`id` INNER JOIN  `expensereport` ON  `contact`.`code` =  `expensereport`.`Clientid` 
WHERE  `expensereport`.`UploadingDate` BETWEEN  '$initial' AND '$date'  AND `contact`.`ownerid`='$loggeduserid' GROUP BY expensereport.Clientid
",$con) or die(mysql_error());



?>
<div onclick="CloseDiv()" class="moduleHeading">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="left" style="width:100%;text-align:center;">
Weekly Revenue Report<span style="text-transform:capitalize"></span></td>
</td>
</tr>
</table>
</div>
<div>
<div  class=form>
<table width="100%" style="text-align:center;height:auto;" cellpadding="0" cellspacing="10">
<tr>
<th>S.No.</th>
<th>Client Name</th>
<th>Client Code</th>
<th>Gross Brokerage</th>
<th>Total Payouts</th>
<th>Your Share</th>
<th>Net Brokerage</th>

</tr>
<?php
 
while($row=mysql_fetch_array($getData)) 
{ 
$no=='0';
$no++;
		
 ?>
<tr>
<td><?php echo $no ?></td>
<td><?php echo $row['fname'] ." ".$row['lname'] ?></td>
<td><?php echo $row['code']; ?></td>
<td><?php echo round($row['grossbrokerage']); ?></td>
<td><?php echo round($row['payouts']); ?></td>
<td><?php echo round($row['RevenueForOwner']*100)." %"; ?></td>
<td><?php echo round($row['grossbrokerage']-$row['payouts']) ?></td>

</tr>
<?php 
} ?>	
</table>
</div>
</div>
