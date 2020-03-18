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
        



        


$name = "Relation Manager Sales Summary Report".$fromdate."_".$todate.".xls";
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");

?>

<?php 

while($row=mysql_fetch_array($getdata))
{
/* start counting all clients of RM  */
$getCountRm=mysql_query("SELECT COUNT(`customersupport`.`RMOwnerid`) FROM `customersupport` WHERE `customersupport`.`RMOwnerid`='$row[1]'",$con) or die(mysql_error()); 
$rowCountRm=mysql_fetch_array($getCountRm);
/* end counting all clients of RM  */


   
$getslabs=mysql_query("SELECT `rmslabMaster`.`slabName`,`rmslabMaster`.`slabrangeFrom`,`rmslabMaster`.`slabrangeTo`,`rmslabMaster`.`incentive` FROM `rmslabMaster` WHERE `rmslabMaster`.`delete`='0' ORDER BY `rmslabMaster`.`order` ASC",$con) or die(mysql_error());  

/* start counting target range */
   
$getWeek1Revenue=mysql_query("SELECT (SUM((`revenuermreport`.`DiscountBrokerage`)+(`revenuermreport`.`PremiumBrokerage`))-SUM( ( ( ( `revenuermreport`.`DiscountBrokerage` )+(`revenuermreport`.`PremiumBrokerage`)) * ( `contact`.`%brokerage` )/100) )) as `Netbrokerage`
 FROM  `revenuermreport` INNER JOIN `contact` ON `revenuermreport`.`code`=`contact`.`code`
WHERE  `revenuermreport`.`uploadingDate` BETWEEN  '$initialWeek1' AND  '$finalWeek1' AND  `revenuermreport`.`RMOwner` =  '$row[1]'",$con) or die(mysql_error());  
$rowWeek1Revenue=mysql_fetch_row($getWeek1Revenue);

// $getWeek2Revenue=mysql_query("SELECT (SUM((`revenuermreport`.`DiscountBrokerage`)+(`revenuermreport`.`PremiumBrokerage`))-SUM( ( ( ( `revenuermreport`.`DiscountBrokerage` )+(`revenuermreport`.`PremiumBrokerage`)) * ( `contact`.`%brokerage` )/100) )) as `Netbrokerage`
//  FROM  `revenuermreport` INNER JOIN `contact` ON `revenuermreport`.`code`=`contact`.`code`
// WHERE  `revenuermreport`.`uploadingDate` BETWEEN  '$initialWeek2' AND  '$finalWeek2' AND  `revenuermreport`.`RMOwner` =  '$row[1]'",$con) or die(mysql_error());  
// $rowWeek2Revenue=mysql_fetch_row($getWeek2Revenue);


// $getWeek3Revenue=mysql_query("SELECT (SUM((`revenuermreport`.`DiscountBrokerage`)+(`revenuermreport`.`PremiumBrokerage`))-SUM( ( ( ( `revenuermreport`.`DiscountBrokerage` )+(`revenuermreport`.`PremiumBrokerage`)) * ( `contact`.`%brokerage` )/100) )) as `Netbrokerage`
//  FROM  `revenuermreport` INNER JOIN `contact` ON `revenuermreport`.`code`=`contact`.`code`
// WHERE  `revenuermreport`.`uploadingDate` BETWEEN  '$initialWeek3' AND  '$finalWeek3' AND  `revenuermreport`.`RMOwner` =  '$row[1]'",$con) or die(mysql_error());  
// $rowWeek3Revenue=mysql_fetch_row($getWeek3Revenue);


// $getWeek4Revenue=mysql_query("SELECT (SUM((`revenuermreport`.`DiscountBrokerage`)+(`revenuermreport`.`PremiumBrokerage`))-SUM( ( ( ( `revenuermreport`.`DiscountBrokerage` )+(`revenuermreport`.`PremiumBrokerage`)) * ( `contact`.`%brokerage` )/100) )) as `Netbrokerage`
//  FROM  `revenuermreport` INNER JOIN `contact` ON `revenuermreport`.`code`=`contact`.`code`
// WHERE  `revenuermreport`.`uploadingDate` BETWEEN  '$initialWeek4' AND  '$finalWeek4' AND  `revenuermreport`.`RMOwner` =  '$row[1]'",$con) or die(mysql_error());  
// $rowWeek4Revenue=mysql_fetch_row($getWeek4Revenue);

/* end of counting target range */


?>
<table width="100%" cellpadding="5" cellspacing="0" border="1" style="text-align:center;">
<tr>
<th style="height:29px">SRM/RM </th>
<th style="height:29px">Week 1 (<?php echo $initialWeek1 ." To ". $finalWeek1   ?>)</th>
<!-- <th style="height:29px">Week 2 (<?php echo $initialWeek2 ." To ". $finalWeek2   ?>)</th>
<th style="height:29px">Week 3 (<?php echo $initialWeek3 ." To ". $finalWeek3   ?>)</th>
<th style="height:29px">Week 4 (<?php echo $initialWeek4 ." To ". $finalWeek4   ?>)</th> -->
<th style="height:29px"> Incentive per client</th>
<th style="height:29px"> Total Incentive</th>
</tr>
<tr>
<th><?php echo $row[0] ?></th>
<td><?php echo number_format(($rowWeek1Revenue[0]),0)."<br>"; ?></td>
<!-- <td><?php echo number_format(($rowWeek2Revenue[0]),0)."<br>"; ?></td>
<td><?php echo number_format(($rowWeek3Revenue[0]),0)."<br>"; ?></td>
<td><?php echo number_format(($rowWeek4Revenue[0]),0)."<br>"; ?></td> -->
<td></td>
<td></td>
</tr>

<?php 
$i=1;

while($rowSlab=mysql_fetch_array($getslabs))
{
   
if($rowSlab[2]==0)
{
$strBetween="> '$rowSlab[1]'";
}  
else 
{
$strBetween="BETWEEN '$rowSlab[1]' AND '$rowSlab[2]'";
}  


$getCountWeek1=mysql_query("SELECT COUNT(`revenuermreport`.`code`) 
FROM  `revenuermreport` WHERE `revenuermreport`.`uploadingDate` BETWEEN  '$initialWeek1' AND  '$finalWeek1'
AND  `revenuermreport`.`RMOwner` =  '$row[1]' GROUP BY `revenuermreport`.`code` 
HAVING SUM( (`revenuermreport`.`DiscountBrokerage`) + (`revenuermreport`.`PremiumBrokerage` ) ) $strBetween",$con) or die(mysql_error());



$rowCountWeek1=mysql_num_rows($getCountWeek1);

$sumCountWeek1 += $rowCountWeek1;



// $getCountWeek2=mysql_query("SELECT COUNT(`revenuermreport`.`code`) 
// FROM  `revenuermreport` WHERE `revenuermreport`.`uploadingDate` BETWEEN  '$initialWeek2' AND  '$finalWeek2'
// AND  `revenuermreport`.`RMOwner` =  '$row[1]' GROUP BY `revenuermreport`.`code` 
// HAVING SUM( (`revenuermreport`.`DiscountBrokerage`) + (`revenuermreport`.`PremiumBrokerage` ) ) $strBetween",$con) or die(mysql_error()); 
// $rowCountWeek2=mysql_num_rows($getCountWeek2);

// $sumCountWeek2 += $rowCountWeek2;


// $getCountWeek3=mysql_query("SELECT COUNT(`revenuermreport`.`code`) 
// FROM  `revenuermreport` WHERE `revenuermreport`.`uploadingDate` BETWEEN  '$initialWeek3' AND  '$finalWeek3'
// AND  `revenuermreport`.`RMOwner` =  '$row[1]' GROUP BY `revenuermreport`.`code` 
// HAVING SUM( (`revenuermreport`.`DiscountBrokerage`) + (`revenuermreport`.`PremiumBrokerage` ) ) $strBetween",$con) or die(mysql_error()); 
// $rowCountWeek3=mysql_num_rows($getCountWeek3);

// $sumCountWeek3 += $rowCountWeek3;




// $getCountWeek4=mysql_query("SELECT COUNT(`revenuermreport`.`code`) 
// FROM  `revenuermreport` WHERE `revenuermreport`.`uploadingDate` BETWEEN  '$initialWeek4' AND  '$finalWeek4'
// AND `revenuermreport`.`RMOwner` =  '$row[1]' GROUP BY `revenuermreport`.`code` 
// HAVING SUM( (`revenuermreport`.`DiscountBrokerage`) + (`revenuermreport`.`PremiumBrokerage` ) ) $strBetween",$con) or die(mysql_error()); 
// $rowCountWeek4=mysql_num_rows($getCountWeek4);  

// $sumCountWeek4 += $rowCountWeek4;


   
?>
<tr>  
<th><?php echo $rowSlab[0] ?></th>
<td><?php if($rowCountWeek1=='') { echo '0'; } else { echo $rowCountWeek1 ; } ?> </td>
<!-- <td><?php if($rowCountWeek2=='') { echo '0'; } else { echo $rowCountWeek2 ; } ?> </td>
<td><?php if($rowCountWeek3=='') { echo '0'; } else { echo $rowCountWeek3 ; } ?> </td>
<td><?php if($rowCountWeek4=='') { echo '0'; } else { echo $rowCountWeek4 ; } ?> </td> -->
<td><?php echo $rowSlab[3] ?></td>
<?php 
//$weekTotal =(($rowCountWeek1+$rowCountWeek2+$rowCountWeek3+$rowCountWeek4) * $rowSlab[3]) ;
$weekTotal =(($rowCountWeek1) * $rowSlab[3]) ;
$weekAllTotal +=$weekTotal;
?>
<td><?php if($weekTotal=='') { echo '0'; } else { echo number_format($weekTotal); }  ?> </td>
</tr>
<?php $i++ ;  } ?>


<tr>
<th>Total Active</th>
<td><?php echo $sumCountWeek1  ?></td>
<!-- <td><?php echo $sumCountWeek2  ?></td>
<td><?php echo $sumCountWeek3  ?></td>
<td><?php echo $sumCountWeek4  ?></td> -->
<td></td>
<td><?php echo number_format(($weekAllTotal),0)."<br>"; ?></td>
</tr>
<tr>
<th>Total Clients</th>
<td><?php echo $rowCountRm[0] ?></td>
<!-- <td><?php echo $rowCountRm[0] ?></td>
<td><?php echo $rowCountRm[0] ?></td>
<td><?php echo $rowCountRm[0] ?></td> -->
<td></td>
<td></td>
</tr>
<tr>
<th>Active %</th>

<td><?php echo round(($sumCountWeek1 / $rowCountRm[0])*100)."%" ?></td>
<!-- <td><?php echo round(($sumCountWeek2 / $rowCountRm[0])*100)."%" ?></td>
<td><?php echo round(($sumCountWeek3 / $rowCountRm[0])*100)."%" ?></td>
<td><?php echo round(($sumCountWeek4 / $rowCountRm[0])*100)."%" ?></td> -->
<td></td>
<td></td>
</tr>
</table>

<table>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
</table>

<?php 
$sumCountWeek1=0;
$sumCountWeek2=0;
$sumCountWeek3=0;
$sumCountWeek4=0;
$weekAllTotal=0;


}  ?>





