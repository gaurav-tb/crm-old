<?php
session_start();
ob_start();
include("../include/conFig.php");
$from     = date_create($_POST['fromdate']);
$fromdate = date_format($from, "Y-m-d H:i:s");
$to       = date_create($_POST['todate']);
$todate   = date_format($to, "Y-m-d 23:59:59");
$name     = "New Sales Report" . $introducer . "_" . $fromdate . "_" . $todate . ".xls";
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");
?>
<table border="1" cellpadding="0" cellspacing="0" width="100%">
<tr>
   <th style="height:29px">Date</th>
   <th style="height:29px">Total</th>
   <th style="height:29px">Average</th>
   <?php
   $get = mysql_query("SELECT UploadingDate FROM `expensereport` WHERE `UploadingDate` BETWEEN '$fromdate' AND '$todate' GROUP BY UploadingDate", $con) or die(mysql_error());
   while ($row = mysql_fetch_array($get)) {
   ?>
   <th style="height:29px"><?php echo $row['UploadingDate']; ?></th>
   <?php } ?>

</tr>
<!-- Premium Brokerage Row Start -->
<tr id="fetchRow<?php echo $i; ?>"  class="d<?php echo $i % 2; ?>">
   <td>Premium Brokerage</td>
   <td><?php
      $getTotal = mysql_query("SELECT SUM(`BrokeragePremium`) As PremiumBrokerage FROM `expensereport` WHERE `UploadingDate` BETWEEN '$fromdate' AND '$todate'", $con) or die(mysql_error());
      while ($row = mysql_fetch_array($getTotal)) {
      echo round($row['PremiumBrokerage']);
      } ?>
    </td>
    <td><?php
      $getAverage = mysql_query("SELECT (DATEDIFF('$todate','$fromdate')+1) As day,SUM(BrokeragePremium) As Total_Brokerage FROM `expensereport` WHERE `UploadingDate` BETWEEN '$fromdate' AND '$todate'", $con) or die(mysql_error());
      while ($row = mysql_fetch_array($getAverage)) {
      echo round($Ttl_Brokerage = $row['Total_Brokerage'] / $row['day']);
      } ?>
    </td>
    <?php
     $getTotal = mysql_query("SELECT UploadingDate,SUM(BrokeragePremium) As BrokeragePremium FROM `expensereport` WHERE `UploadingDate` BETWEEN '$fromdate' AND '$todate' GROUP BY UploadingDate", $con) or die(mysql_error());
     while ($row = mysql_fetch_array($getTotal)) {
     ?>
   <td><?php echo round($row['BrokeragePremium']); ?></td>
   <?php } ?>
</tr>
<!-- Premium Brokerage Row End -->
<!-- Discount Brokerage Row Start -->
<tr id="fetchRow<?php echo $i; ?>"  class="d<?php echo $i % 2; ?>">
   <td>Discount Brokerage</td>
   <td><?php
    $getDiscountBrokerage = mysql_query("SELECT SUM(`RevenueGeneration`) As DiscountBrokerage FROM `expensereport` WHERE `UploadingDate` BETWEEN '$fromdate' AND '$todate'", $con) or die(mysql_error());
    while ($row = mysql_fetch_array($getDiscountBrokerage)) {
    echo round($row['DiscountBrokerage']);
    } ?></td>
   <td><?php
    $getTotalBrokerage = mysql_query("SELECT (DATEDIFF('$todate','$fromdate')+1) As day,SUM(RevenueGeneration) As RevenueGeneration,SUM(BrokeragePremium) As BrokeragePremium FROM `expensereport` WHERE `UploadingDate` BETWEEN '$fromdate' AND '$todate'", $con) or die(mysql_error());
    while ($row = mysql_fetch_array($getTotalBrokerage)) {
    $PremiumBrokerageDiscount = $row['RevenueGeneration'] / $row['day'];
    $PremiumBrokerageAvg      = $row['BrokeragePremium'] / $row['day'];
    echo round($result = $PremiumBrokerageAvg - $PremiumBrokerageDiscount);
    } ?>
    </td>
    <?php
    $getDiscountTotal = mysql_query("SELECT UploadingDate,SUM(RevenueGeneration) As RevenueGeneration FROM `expensereport` WHERE `UploadingDate` BETWEEN '$fromdate' AND '$todate' GROUP BY UploadingDate", $con) or die(mysql_error());
    while ($row = mysql_fetch_array($getDiscountTotal)) { ?>
   <td><?php echo round($row['RevenueGeneration']); ?></td>
   <?php } ?>
</tr>
<!-- Discount Brokerage Row End -->
<!-- Total Brokerage Row Start -->
<tr id="fetchRow<?php echo $i; ?>"  class="d<?php echo $i % 2; ?>">
   <td>Total Brokerage</td>
   <td><?php
       $getTotalBrokerage = mysql_query("SELECT SUM(`RevenueGeneration`)+SUM(`BrokeragePremium`) As TotalBrokerage FROM `expensereport` WHERE `UploadingDate` BETWEEN '$fromdate' AND '$todate'", $con) or die(mysql_error());
        while ($row = mysql_fetch_array($getTotalBrokerage)) {
        echo round($row['TotalBrokerage']);
        } ?>
    </td>
    <td><?php
      $getDiscountAverage = mysql_query("SELECT (DATEDIFF('$todate','$fromdate')+1) As day,SUM(RevenueGeneration) As Total_Brokerage FROM `expensereport` WHERE `UploadingDate` BETWEEN '$fromdate' AND '$todate'", $con) or die(mysql_error());
       while ($row = mysql_fetch_array($getDiscountAverage)) {
       echo round($Ttl_Brokerage = $row['Total_Brokerage'] / $row['day']);
        } ?>
    </td>
      <?php
       $getDatesTotal = mysql_query("SELECT UploadingDate,SUM(RevenueGeneration) As RevenueGeneration,SUM(BrokeragePremium) As BrokeragePremium  FROM `expensereport` WHERE `UploadingDate` BETWEEN '$fromdate' AND '$todate' GROUP BY UploadingDate", $con) or die(mysql_error());
        while ($row = mysql_fetch_array($getDatesTotal)) { ?>
    <td><?php
    $R = $row['RevenueGeneration'];
    $B = $row['BrokeragePremium'];
    echo round($resut = $R + $B);
    ?>
    </td>
    <?php } ?>
</tr>
<!-- Total Brokerage Row End -->
<!-- Check Row Start -->

<tr style="background-color: ##D5D8DC;" id="fetchRow<?php echo $i; ?>"  class="d<?php echo $i % 2; ?>">
    <td>Check</td>
    <td>0</td>
    <td></td>
    <?php
     $getDatesTotal = mysql_query("SELECT UploadingDate,SUM(RevenueGeneration) As RevenueGeneration,SUM(BrokeragePremium) As BrokeragePremium  FROM `expensereport` WHERE `UploadingDate` BETWEEN '$fromdate' AND '$todate' GROUP BY UploadingDate", $con) or die(mysql_error());
     while ($row = mysql_fetch_array($getDatesTotal)) { ?>
    <td>0</td>
<?php } ?>
</tr>
<!-- Check Row End -->
<!-- Premium Count Start -->
<tr id="fetchRow<?php echo $i; ?>"  class="d<?php echo $i % 2; ?>">
    <td>Premium Count</td>
    <td></td>
    <td>Not Done</td>
    <?php
     $getPremiumTotal = mysql_query("SELECT COUNT(BrokeragePremium) AS day,UploadingDate FROM `expensereport` WHERE `UploadingDate` BETWEEN '$fromdate' AND '$todate' AND BrokeragePremium!='0' GROUP BY `UploadingDate`", $con) or die(mysql_error());
     while ($row = mysql_fetch_array($getPremiumTotal)) {
     ?>
    <td><?php echo $Premiumresult = $row['day']; ?></td>
    <?php } ?>
</tr>
<!-- Premium Count End -->
<!-- Discount Count Row Start -->
<tr id="fetchRow<?php echo $i; ?>" class="d<?php echo $i % 2; ?>">
   <td>Discount Count</td>
   <td></td>
   <td>Not Done</td>
   <?php
    $getDiscountCount = mysql_query("SELECT COUNT(`RevenueGeneration`) AS day,UploadingDate,BrokeragePremium FROM `expensereport` WHERE `UploadingDate` BETWEEN '$fromdate' AND '$todate' AND RevenueGeneration!='0' GROUP BY `UploadingDate`", $con) or die(mysql_error());
    while ($row = mysql_fetch_array($getDiscountCount)) {
    ?>
   <td><?php echo $Discountresult = $row['day']; ?></td>
   <?php } ?>
</tr>
<!-- Discount Count Row End -->
<!-- Active Clients Row Start -->
<tr id="fetchRow<?php echo $i; ?>"  class="d<?php echo $i % 2; ?>">
   <td>Active Clients</td>
   <td></td>
   <td>Not Done</td>
   <?php
    $getDiscountCount = mysql_query("SELECT COUNT(BrokeragePremium)+COUNT(`RevenueGeneration`) AS manu,UploadingDate FROM `expensereport` WHERE `UploadingDate` BETWEEN '$fromdate' AND '$todate'  GROUP BY `UploadingDate`", $con) or die(mysql_error());
    while ($row = mysql_fetch_array($getDiscountCount)) {
    ?>
   <td><?php echo $row['manu']; ?></td>
   <?php } ?>
</tr>
<!-- Active Clients Row End -->
</table>
<?php
   $getData = mysql_query("SELECT COUNT(expensereport.UploadingDate) As Total_trading_days,SUM(expensereport.Turnover) As Total_turn_over,SUM(expensereport.BrokeragePremium) As Total_Premium_Brockrage,SUM(expensereport.RevenueGeneration)+SUM(expensereport.BrokeragePremium) As Total_Brockrage,expensereport.Clientid,employee.name As Owner_Name,customersupport.fname As Client_name FROM expensereport INNER JOIN customersupport ON expensereport.Clientid = customersupport.tradingbellsid INNER JOIN employee ON customersupport.RMOwnerid = employee.id WHERE `UploadingDate` BETWEEN '$fromdate' AND '$todate' AND `employee`.`status` = '1' AND `employee`.`delete` = '0' GROUP BY expensereport.Clientid", $con) or die(mysql_error());

?>
<table border="1" cellpadding="0" cellspacing="0" width="100%">
<tr style="background-color: #D5D8DC;">
   <th style="height:24px">Client ID</th>
   <th style="height:24px">Client Name</th>
   <th style="height:24px">Total</th>
   <th style="height:24px">SRM/RM</th>
   <?php
   $get = mysql_query("SELECT UploadingDate FROM `expensereport` WHERE `UploadingDate` BETWEEN '$fromdate' AND '$todate' GROUP BY UploadingDate", $con) or die(mysql_error());
   while ($row = mysql_fetch_array($get)) { ?>
   <th style="height:24px"><?php echo $row['UploadingDate']; ?></th>
   <?php } ?>
</tr>
<?php
    while ($row = mysql_fetch_array($getData)) {
    $C_id = $row['Clientid'];
     $getBalance=mysql_query("SELECT SUM(`RevenueGeneration`)+ SUM(`BrokeragePremium`) As Balance,UploadingDate FROM `expensereport` WHERE `UploadingDate` BETWEEN '$fromdate' AND '$todate'  AND `Clientid`='$C_id' GROUP BY UploadingDate",$con) or die(mysql_error());
    
?>
<tr id="fetchRow<?php echo $i; ?>" class="d<?php echo $i % 2; ?>">
    <td><?php echo $C_id = $row['Clientid']; ?></td>
    <td><?php echo $row['Client_name']; ?></td>
    <td>0</td>
    <td><?php echo $row['Owner_Name']; ?></td>
    
  <?php
while($row = mysql_fetch_array($getBalance))
{
if (!$row['Balance'] && !$row['UploadingDate']=="") {
    echo '<td>NA</td>';
} 
 else {
   echo '<td>'.$row['Balance'].'</td>';
}




}
?>

</tr>

<?php $i++;} ?>

</table>





<!-- <?php
     $C_id = $row['Clientid'];
     $rty= mysql_query(" SELECT SUM(`RevenueGeneration`)+ SUM(`BrokeragePremium`) As manu,UploadingDate FROM `expensereport` WHERE `UploadingDate` BETWEEN '$fromdate' AND '$todate' AND `Clientid`='$C_id' GROUP BY UploadingDate", $con) or die(mysql_error());
     while ($t=mysql_fetch_array($rty)) {
       echo $t['manu'];
     }
    ?>



    <?php
   $getMonthRmtotal = mysql_query("SELECT SUM(`RevenueGeneration`)+ SUM(`BrokeragePremium`) As RBtotal FROM `expensereport` WHERE `UploadingDate` BETWEEN '$fromdate' AND '$todate' AND `Clientid`='$C_id'", $con) or die(mysql_error());
   while ($Rmtotal = mysql_fetch_array($getMonthRmtotal)) { echo $Rmtotal['RBtotal']; } ?> -->