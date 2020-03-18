<?php
session_start();
ob_start();
include("../include/conFig.php");
$from=date_create($_POST['fromdate']);
$fromdate=date_format($from,"Y-m-d H:i:s");
$to=date_create($_POST['todate']);
$todate=date_format($to,"Y-m-d 23:59:59");
$leadowner = $_POST['leadowner'];


if($leadowner!='')
{
$strOwner=" AND `employee`.`id`='$leadowner'";	
}
else
{
$strOwner="";	
}

$getData=mysql_query("SELECT  `contact`.`fname` ,  `contact`.`lname` ,  `contact`.`mobile` ,  `contact`.`code` ,  `contact`.`pancardnumber` ,  `contact`.`conversiondate` , `contact`.`email` , (
SUM(  `expensereport`.`RevenueGeneration` ) + SUM(  `expensereport`.`BrokeragePremium` )
) AS  `BrokeragePaid` , SUM(  `expensereport`.`Turnover` ) AS  `Turnover` 
FROM  `contact` 
INNER JOIN  `expensereport` ON  `contact`.`code` =  `expensereport`.`Clientid` 
WHERE  `contact`.`converted` =  '1'
GROUP BY  `expensereport`.`Clientid` 
LIMIT 100",$con) or die(mysql_error());


$format = date('Y-m-d His');
$name ="Client Dashboard Report On".$introducer."_".$format.".xls";
//$name ="Client Dashboard Report On".$fromdate.".xls";
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");
?>

<table border="1" cellpadding="0" cellspacing="0" width="100%">
<tr>
<th style="height:29px">Client Name</th>
<th style="height:29px">Client Code</th>
<!-- <th style="height:29px">Client Email</th> -->
<th style="height:29px">Client Pancard</th>
<th style="height:29px">Account Opening Date</th>
<th style="height:29px">Turnover</th>
<th style="height:29px">Brokerage Paid</th>
<th style="height:29px">Client Referral</th>
<th style="height:29px">Referral Bonus Earned</th>
</tr>
<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
<tr id="fetchRow<?php echo $i;?>"  class="d<?php echo $i%2;?>">
<td><?php echo $row['fname']. " ".$row['lname'] ?></td>
<td><?php echo $row['code'] ?></td>
<!-- <td><?php echo $row['email'] ?></td>
 --><td><?php echo $row['pancardnumber'] ?></td>
<td><?php echo $row['conversiondate'] ?></td>
<td><?php echo $row['Turnover'] ?></td>
<td><?php echo $row['BrokeragePaid'] ?></td>

<?php 
 $getReferral=mysql_query("SELECT count(`contact`.`converted`) FROM `contact` WHERE `contact`.`converted`='1' AND `contact`.`inroducer`='$row[3]'",$con) or die(mysql_error());
$rowReferral=mysql_num_rows($getReferral);  
?>

<td><?php  echo $rowReferral ?></td>

<?php 
$getEarnReferral=mysql_query("SELECT ((SUM( `expensereport`.`Brokeragepremium` ) * ( (`contact`.`%brokerage`) /100 )
) + ( SUM( `expensereport`.`RevenueGeneration`) * ( (`contact`.`%brokerage`) /100 ) )
) AS `ReferralBonusEarned` FROM `contact` INNER JOIN `expensereport` ON `contact`.`code` = `expensereport`.`Clientid`
WHERE `contact`.`converted` =  '1'",$con) or die(mysql_error());
$rowEarnReferral=mysql_fetch_array($getEarnReferral); 
?>
<td><?php echo $rowEarnReferral['ReferralBonusEarned'] ?></td>
</tr>
<?php
$i++;
}
?>

</table>
