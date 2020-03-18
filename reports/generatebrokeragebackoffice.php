<?php
session_start();
ob_start();
include("../include/conFig.php");
$from=date_create($_POST['fromdate']);
$fromdate=date_format($from,"Y-m-d H:i:s");
$to=date_create($_POST['todate']);
$todate=date_format($to,"Y-m-d H:i:s");$leadowner = $_POST['leadowner'];

if($leadowner!="null")
{
$strOwner="AND `contact`.`ownerid`='$leadowner'";
}
else
{
$strOwner="AND `contact`.`converted`='1'";
}


$getData=mysql_query("SELECT contact.fname, contact.lname, contact.ownerid,employee.name as empname,`contact`.`%brokerage`,`contact`.`code`,`contact`.`id`,`contact`.`inroducer`,`contact`.`%brokerage`, SUM( expensereport.Turnover ) as Turnover , 
(SUM(`expensereport`.`RevenueGeneration`)+SUM(`expensereport`.`BrokeragePremium`))  AS brokerage,SUM( ((  ( `expensereport`.`RevenueGeneration` )+( `expensereport`.`BrokeragePremium` ))  * ( `contact`.`%brokerage` )/100) ) AS payouts
FROM  `contact` INNER JOIN  `employee` ON  `contact`.`ownerid` =  `employee`.`id` INNER JOIN  `expensereport` ON  `contact`.`code` =  `expensereport`.`Clientid` 
WHERE  `expensereport`.`UploadingDate` BETWEEN  '$fromdate' AND '$todate' ". $strOwner ." GROUP BY expensereport.Clientid",$con) or die(mysql_error());



$format = date('Y-m-d His');
$name ="Brokerage Calculation Report".$introducer."_".$format.".xls";
//$name ="Brokerage Calculation Report".$introducer."_".$fromdate."_".$todate.".xls";
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");
?>

<table border="1" cellpadding="0" cellspacing="0" width="100%">
<tr>
<th style="height:29px">Owner Name</th>
<th style="height:29px">Client Number</th>
<th style="height:29px">Client Name</th>
<th style="height:29px">Client Code</th>
<th style="height:29px">Introducer Code</th>
<th style="height:29px">Brokerage</th>
<th style="height:29px">Percent Brokerage</th>
<th style="height:29px">Payout</th>
</tr>
<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
<tr id="fetchRow<?php echo $i;?>"  class="d<?php echo $i%2;?>">
<td><?php echo $row['empname'] ?></td>
<td><?php echo $row['id'] ?></td>
<td><?php echo $row['fname'] ." ".$row['lname'] ?></td>
<td><?php echo $row['code'] ?></td>
<td><?php echo $row['inroducer'] ?></td>
<td><?php echo $row['brokerage'] ?></td>
<td><?php 
if($row['inroducer'] == ''){
	echo "0%";
}else{
	echo $row['%brokerage']."%";
}?>
</td>
<td><?php echo $row['payouts'] ?></td>
</tr>

<?php
$i++;
}
?>

</table>







