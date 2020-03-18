<?php 
session_start();
ob_start();

include("../include/conFig.php");
$from=date_create($_POST['fromdate']);
$fromdate=date_format($from,"Y-m-d 00:00:00");
//$to=date_create($_POST['todate']);
//$todate=date_format($to,"Y-m-d 23:59:59");
$RmOwner= $_POST['relationshipmanager'];

if($RmOwner!='null')
{
$strRm=" AND `employee`.`id`='$RmOwner'";	
}
else
{
$strRm=" ORDER BY `employee`.`name` ASC";	
}

$sql="SELECT `name`,`id` FROM `employee` WHERE `employee`.`status`='1' AND `employee`.`delete`='0' AND (`employee`.`profile`='11' || `employee`.`profile`='16' || `employee`.`profile`='30' || `employee`.`profile`='19' || `employee`.`profile`='28' || `employee`.`profile`='29')".$strRm;

$getdata=mysql_query($sql,$con) or die(mysql_error());



$sqlTargetRange="SELECT `fromdate`,`todate` FROM `targetrange` WHERE '$fromdate' BETWEEN `fromdate` AND `todate`";

$getTargetRange=mysql_query($sqlTargetRange,$con) or die(mysql_error());

$rowTarget=mysql_fetch_array($getTargetRange);

   

   
   $day=date("D",strtotime($rowTarget[0]));

   if($day=="Mon")
   {
   $initialWeek1 = date("Y-m-d", strtotime("+0 day",strtotime($rowTarget[0])));	
   $finalWeek1 = date("Y-m-d", strtotime("+6 day",strtotime($rowTarget[0])));	        
				
   $initialWeek2 = date("Y-m-d", strtotime("+7 day",strtotime($rowTarget[0])));	
   $finalWeek2 = date("Y-m-d", strtotime("+13 day",strtotime($rowTarget[0])));	
				
   $initialWeek3 = date("Y-m-d", strtotime("+14 day",strtotime($rowTarget[0])));	
   $finalWeek3 = date("Y-m-d", strtotime("+20 day",strtotime($rowTarget[0])));

   $initialWeek4 = date("Y-m-d", strtotime("+21 day",strtotime($rowTarget[0])));	
   $finalWeek4 = date("Y-m-d", strtotime("+27 day",strtotime($rowTarget[0])));

}

if($day=="Tue")
{
$initialWeek1 = date("Y-m-d", strtotime("-1 day",strtotime($rowTarget[0])));	
   $finalWeek1 = date("Y-m-d", strtotime("+5 day",strtotime($rowTarget[0])));	        
				
   $initialWeek2 = date("Y-m-d", strtotime("+6 day",strtotime($rowTarget[0])));	
   $finalWeek2 = date("Y-m-d", strtotime("+12 day",strtotime($rowTarget[0])));	
				
   $initialWeek3 = date("Y-m-d", strtotime("+13 day",strtotime($rowTarget[0])));	
   $finalWeek3 = date("Y-m-d", strtotime("+19 day",strtotime($rowTarget[0])));

   $initialWeek4 = date("Y-m-d", strtotime("+20 day",strtotime($rowTarget[0])));	
   $finalWeek4 = date("Y-m-d", strtotime("+26 day",strtotime($rowTarget[0])));

}

if($day=="Wed")
{
$initialWeek1 = date("Y-m-d", strtotime("-2 day",strtotime($rowTarget[0])));	
   $finalWeek1 = date("Y-m-d", strtotime("+4 day",strtotime($rowTarget[0])));	        
				
   $initialWeek2 = date("Y-m-d", strtotime("+5 day",strtotime($rowTarget[0])));	
   $finalWeek2 = date("Y-m-d", strtotime("+11 day",strtotime($rowTarget[0])));	
				
   $initialWeek3 = date("Y-m-d", strtotime("+12 day",strtotime($rowTarget[0])));	
   $finalWeek3 = date("Y-m-d", strtotime("+18 day",strtotime($rowTarget[0])));

   $initialWeek4 = date("Y-m-d", strtotime("+19 day",strtotime($rowTarget[0])));	
   $finalWeek4 = date("Y-m-d", strtotime("+25 day",strtotime($rowTarget[0])));

}

if($day=="Thu")
{
$initialWeek1 = date("Y-m-d", strtotime("-3 day",strtotime($rowTarget[0])));	
   $finalWeek1 = date("Y-m-d", strtotime("+3 day",strtotime($rowTarget[0])));	        
				
   $initialWeek2 = date("Y-m-d", strtotime("+4 day",strtotime($rowTarget[0])));	
   $finalWeek2 = date("Y-m-d", strtotime("+10 day",strtotime($rowTarget[0])));	
				
   $initialWeek3 = date("Y-m-d", strtotime("+11 day",strtotime($rowTarget[0])));	
   $finalWeek3 = date("Y-m-d", strtotime("+17 day",strtotime($rowTarget[0])));

   $initialWeek4 = date("Y-m-d", strtotime("+18 day",strtotime($rowTarget[0])));	
   $finalWeek4 = date("Y-m-d", strtotime("+24 day",strtotime($rowTarget[0])));

}

if($day=="Fri")
{
$initialWeek1 = date("Y-m-d", strtotime("-4 day",strtotime($rowTarget[0])));	
   $finalWeek1 = date("Y-m-d", strtotime("+2 day",strtotime($rowTarget[0])));	        
				
   $initialWeek2 = date("Y-m-d", strtotime("+3 day",strtotime($rowTarget[0])));	
   $finalWeek2 = date("Y-m-d", strtotime("+9 day",strtotime($rowTarget[0])));	
				
   $initialWeek3 = date("Y-m-d", strtotime("+10 day",strtotime($rowTarget[0])));	
   $finalWeek3 = date("Y-m-d", strtotime("+16 day",strtotime($rowTarget[0])));

   $initialWeek4 = date("Y-m-d", strtotime("+17 day",strtotime($rowTarget[0])));	
   $finalWeek4 = date("Y-m-d", strtotime("+23 day",strtotime($rowTarget[0])));

}

if($day=="Sat")
{
$initialWeek1 = date("Y-m-d", strtotime("-5 day",strtotime($rowTarget[0])));	
   $finalWeek1 = date("Y-m-d", strtotime("+1 day",strtotime($rowTarget[0])));	        
				
   $initialWeek2 = date("Y-m-d", strtotime("+2 day",strtotime($rowTarget[0])));	
   $finalWeek2 = date("Y-m-d", strtotime("+8 day",strtotime($rowTarget[0])));	
				
   $initialWeek3 = date("Y-m-d", strtotime("+9 day",strtotime($rowTarget[0])));	
   $finalWeek3 = date("Y-m-d", strtotime("+15 day",strtotime($rowTarget[0])));

   $initialWeek4 = date("Y-m-d", strtotime("+16 day",strtotime($rowTarget[0])));	
   $finalWeek4 = date("Y-m-d", strtotime("+22 day",strtotime($rowTarget[0])));

}

if($day=="Sun")
{
$initialWeek1 = date("Y-m-d", strtotime("-6 day",strtotime($rowTarget[0])));	
   $finalWeek1 = date("Y-m-d", strtotime("+0 day",strtotime($rowTarget[0])));	        
				
   $initialWeek2 = date("Y-m-d", strtotime("+1 day",strtotime($rowTarget[0])));	
   $finalWeek2 = date("Y-m-d", strtotime("+7 day",strtotime($rowTarget[0])));	
				
   $initialWeek3 = date("Y-m-d", strtotime("+8 day",strtotime($rowTarget[0])));	
   $finalWeek3 = date("Y-m-d", strtotime("+14 day",strtotime($rowTarget[0])));

   $initialWeek4 = date("Y-m-d", strtotime("+15 day",strtotime($rowTarget[0])));	
   $finalWeek4 = date("Y-m-d", strtotime("+21 day",strtotime($rowTarget[0])));

}
$format = date('Y-m-d His');
$name ="RelationManager Sales Detail Report_".$format.".xls";       
//$name = "RelationManager Sales Detail Report".$fromdate."_".$todate.".xls";
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");

?>
<table width="100%" cellpadding="5" cellspacing="0" border="1" style="text-align:center;">
<tr>
<td></td>
<td></td>
<td></td>
<td colspan="2" style="height:29px"><strong>Week 1 (<?php echo $initialWeek1 ." To ". $finalWeek1   ?>)</strong></td>
<td colspan="2" style="height:29px"><strong>Week 2 (<?php echo $initialWeek2 ." To ". $finalWeek2   ?>)</strong></td>
<td colspan="2" style="height:29px"><strong>Week 3 (<?php echo $initialWeek3 ." To ". $finalWeek3   ?>)</strong></td>
<td colspan="2" style="height:29px"><strong>Week 4 (<?php echo $initialWeek4 ." To ". $finalWeek4   ?>)</strong></td>
</tr>

<tr>
<td><strong>SRM/RM</strong></td>
<td><strong>Client Code</strong></td>
<td><strong>Name </strong></td>
<td><strong>Brokerage</strong></td>
<td><strong>Slab </strong></td>
<td><strong>Brokerage </strong></td>
<td><strong>Slab </strong></td>
<td><strong>Brokerage </strong></td>
<td><strong>Slab </strong></td>
<td><strong>Brokerage </strong></td>
<td><strong>Slab </strong></td>
</tr>



<?php 

while($row=mysql_fetch_array($getdata))
{
$getActiveClients=mysql_query("SELECT `revenuermreport`.`code`,`customersupport`.`fname`,`customersupport`.`lname`
FROM  `revenuermreport` INNER JOIN  `customersupport` ON  `revenuermreport`.`code` =  `customersupport`.`tradingbellsid` 
WHERE  `revenuermreport`.`RMOwner` =  '$row[1]' AND  `revenuermreport`.`uploadingDate` BETWEEN  '$initialWeek1' AND  '$finalWeek4' GROUP BY  `revenuermreport`.`code`",$con) or die(mysql_error());

while($rowActive=mysql_fetch_array($getActiveClients))
{
$getFirstWeekRevenue=mysql_query("SELECT  (SUM((`revenuermreport`.`DiscountBrokerage`)+(`revenuermreport`.`PremiumBrokerage`))-SUM( ((( `revenuermreport`.`DiscountBrokerage` )+(`revenuermreport`.`PremiumBrokerage`)) * ( `contact`.`%brokerage` )/100) )) as `Netbrokerage`
FROM  `revenuermreport` INNER JOIN  `contact` ON  `revenuermreport`.`code` =  `contact`.`code` 
WHERE  `revenuermreport`.`uploadingDate` BETWEEN '$initialWeek1' AND  '$finalWeek1'
AND  `revenuermreport`.`code` =  '$rowActive[0]' GROUP BY  `revenuermreport`.`code`",$con) or die(mysql_error());

$rowWeek1Revenue=mysql_fetch_array($getFirstWeekRevenue);



$getSecondWeekRevenue=mysql_query("SELECT  (SUM((`revenuermreport`.`DiscountBrokerage`)+(`revenuermreport`.`PremiumBrokerage`))-SUM( ((( `revenuermreport`.`DiscountBrokerage` )+(`revenuermreport`.`PremiumBrokerage`)) * ( `contact`.`%brokerage` )/100) )) as `Netbrokerage`
FROM  `revenuermreport` INNER JOIN  `contact` ON  `revenuermreport`.`code` =  `contact`.`code` 
WHERE  `revenuermreport`.`uploadingDate` BETWEEN '$initialWeek2' AND  '$finalWeek2'
AND  `revenuermreport`.`code` =  '$rowActive[0]' GROUP BY  `revenuermreport`.`code`",$con) or die(mysql_error());

$rowWeek2Revenue=mysql_fetch_array($getSecondWeekRevenue);



$getThirdWeekRevenue=mysql_query("SELECT  (SUM((`revenuermreport`.`DiscountBrokerage`)+(`revenuermreport`.`PremiumBrokerage`))-SUM( ((( `revenuermreport`.`DiscountBrokerage` )+(`revenuermreport`.`PremiumBrokerage`)) * ( `contact`.`%brokerage` )/100) )) as `Netbrokerage`
FROM  `revenuermreport` INNER JOIN  `contact` ON  `revenuermreport`.`code` =  `contact`.`code` 
WHERE  `revenuermreport`.`uploadingDate` BETWEEN '$initialWeek3' AND  '$finalWeek3'
AND  `revenuermreport`.`code` =  '$rowActive[0]' GROUP BY  `revenuermreport`.`code`",$con) or die(mysql_error());

$rowWeek3Revenue=mysql_fetch_array($getThirdWeekRevenue);

$getFourthWeekRevenue=mysql_query("SELECT  (SUM((`revenuermreport`.`DiscountBrokerage`)+(`revenuermreport`.`PremiumBrokerage`))-SUM( ((( `revenuermreport`.`DiscountBrokerage` )+(`revenuermreport`.`PremiumBrokerage`)) * ( `contact`.`%brokerage` )/100) )) as `Netbrokerage`
FROM  `revenuermreport` INNER JOIN  `contact` ON  `revenuermreport`.`code` =  `contact`.`code` 
WHERE  `revenuermreport`.`uploadingDate` BETWEEN '$initialWeek4' AND  '$finalWeek4'
AND  `revenuermreport`.`code` =  '$rowActive[0]' GROUP BY  `revenuermreport`.`code`",$con) or die(mysql_error());

$rowWeek4Revenue=mysql_fetch_array($getFourthWeekRevenue);




?>
 <tr>
<td><?php echo $row[0] ?></td>
<td><?php echo $rowActive[0] ?></td>
<td><?php echo ($rowActive[1] . " " .$rowActive[2])  ?></td>
<td><?php if($rowWeek1Revenue[0]=='') { echo '0'; } else { echo $rowWeek1Revenue[0]; }  ?></td>

<td>
<?php if($rowWeek1Revenue[0] ==0 ) {echo "0-500"; }  if($rowWeek1Revenue[0] > 0 && $rowWeek1Revenue[0] < 500){echo "0-500"; } if($rowWeek1Revenue[0] > 500  &&  $rowWeek1Revenue[0] < 1000){ echo "500-1000";	 }  if($rowWeek1Revenue[0] > 1000 && $rowWeek1Revenue[0] < 2500){ echo "1k-2.5k"; 	} if($rowWeek1Revenue[0] > 2500 && $rowWeek1Revenue[0] < 5000) {echo "2.5k-5k"; } if($rowWeek1Revenue[0] > 5000) { echo "5k"; 	}  ?>
</td>


<td><?php if($rowWeek2Revenue[0]=='') { echo '0'; } else { echo $rowWeek2Revenue[0]; }  ?></td> 

<td>
 <?php if($rowWeek2Revenue[0] ==0 ) {echo "0-500"; }  if($rowWeek2Revenue[0] > 0 && $rowWeek2Revenue[0] < 500){echo "0-500"; } if($rowWeek2Revenue[0] > 500  &&  $rowWeek2Revenue[0] < 1000){ echo "500-1000";	 }  if($rowWeek2Revenue[0] > 1000 && $rowWeek2Revenue[0] < 2500){ echo "1k-2.5k"; 	} if($rowWeek2Revenue[0] > 2500 && $rowWeek2Revenue[0] < 5000) {echo "2.5k-5k"; } if($rowWeek2Revenue[0] > 5000) { echo "5k"; 	}  ?>
</td>

<td><?php if($rowWeek3Revenue[0]=='') { echo '0'; } else { echo $rowWeek3Revenue[0]; }  ?></td>

<td>
 <?php if($rowWeek3Revenue[0] ==0 ) {echo "0-500"; } if($rowWeek3Revenue[0] > 0 && $rowWeek3Revenue[0] < 500){echo "0-500"; } if($rowWeek3Revenue[0] > 500  &&  $rowWeek3Revenue[0]< 1000){ echo "500-1000";	 }  if($rowWeek3Revenue[0] > 1000 && $rowWeek3Revenue[0] < 2500){ echo "1k-2.5k"; 	} if($rowWeek3Revenue[0] > 2500 && $rowWeek3Revenue[0] < 5000) {echo "2.5k-5k"; } if($rowWeek3Revenue[0] > 5000) { echo "5k"; 	}  ?>
</td>

<td><?php if($rowWeek4Revenue[0]=='') { echo '0'; } else { echo $rowWeek4Revenue[0]; }  ?></td>

<td> 
<?php if($rowWeek4Revenue[0] ==0 ) {echo "0-500"; }  if($rowWeek4Revenue[0]> 0 && $rowWeek4Revenue[0] < 500){echo "0-500"; } if($rowWeek4Revenue[0] > 500  &&  $rowWeek4Revenue[0] < 1000){ echo "500-1000";	 }  if($rowWeek4Revenue[0] > 1000 && $rowWeek4Revenue[0] < 2500){ echo "1k-2.5k"; 	} if($rowWeek4Revenue[0] > 2500 && $rowWeek4Revenue[0] < 5000) {echo "2.5k-5k"; } if($rowWeek4Revenue[0] > 5000) { echo "5k"; 	}  ?>
</td>

</tr>




<?php  } } ?>

</table>



