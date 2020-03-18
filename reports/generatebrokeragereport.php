<?php
session_start();
ob_start();
include("../include/conFig.php");
$from=date_create($_POST['fromdate']);
$fromdate=date_format($from,"Y-m-d 00:00:00");
$to=date_create($_POST['todate']);
$todate=date_format($to,"Y-m-d 23:59:59");
$leadowner = $_POST['leadowner'];
$fromYMD=date_format($from,"Y-m-d");
$todateYMD=date_format($to,"Y-m-d");


$mates = $_POST['DisplayRM'];
$mates = explode(",",$mates);
foreach($mates as $val)
{
if($val != '')
{
$temp = str_ireplace("-","",$val);
$newMates[] .= $temp;
}
}

$arrayCount=sizeof($newMates);

if($arrayCount!=0)
{
$strOwner=" AND (FIND_IN_SET('$newMates[0]',`RMOwner`) || FIND_IN_SET('$newMates[1]',`RMOwner`) || FIND_IN_SET('$newMates[2]',`RMOwner`) || FIND_IN_SET('$newMates[3]',`RMOwner`) || FIND_IN_SET('$newMates[4]',`RMOwner`) || FIND_IN_SET('$newMates[5]',`RMOwner`) || FIND_IN_SET('$newMates[6]',`RMOwner`) || FIND_IN_SET('$newMates[7]',`RMOwner`) || FIND_IN_SET('$newMates[8]',`RMOwner`)) AND `contact`.`converted`='1'";
}
else
{
$strOwner="AND `contact`.`converted`='1'";
}


$sql="SELECT contact.fname, contact.lname, contact.ownerid, contact.code,contact.id,contact.inroducer,`contact`.`%brokerage`,employee.name, `revenuermreport`.`DiscountBrokerage` As `DiscountBrokerage`, `revenuermreport`.`PremiumBrokerage` As `premiumBrokerage`, `revenuermreport`.`Turnover` as `Turnover` , (`revenuermreport`.`DiscountBrokerage` + `revenuermreport`.`PremiumBrokerage` ) AS `grossbrokerage`,(( `revenuermreport`.`DiscountBrokerage` + `revenuermreport`.`PremiumBrokerage` )   * (( `contact`.`%brokerage` )/100) ) AS payouts
 ,`revenuermreport`.`RMOwner`,`revenuermreport`.`uploadingDate` as `UploadingDate` FROM  `contact` INNER JOIN  `employee` ON  `contact`.`ownerid` = `employee`.`id` 
 INNER JOIN  `revenuermreport` ON  `contact`.`code` =  `revenuermreport`.`code`
 where `revenuermreport`.`uploadingDate` BETWEEN  '$fromdate' AND '$todate'". $strOwner ."";

$getData=mysql_query($sql,$con) or die(mysql_error());

$format = date('Y-m-d His');
$name ="Brokerage Analysis Report".$introducer."_".$format.".xls";
//$name = "Brokerage Analysis Report".$introducer."_".$fromdate."_".$todate.".xls";
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");
?>

<table border="1" cellpadding="0" cellspacing="0" width="100%">
<tr>
<!-- <th style="height:29px">Client Owner</th> -->
<th style="height:29px">RM Owner</th>
<th style="height:29px">Client Number</th>
<th style="height:29px">Client Code</th>
<th style="height:29px">Client Name</th>
<th style="height:29px">Introducer</th>
<th style="height:29px">Turnover</th>
<th style="height:29px">Premium Brokerage</th>
<th style="height:29px">Discount Brokerage</th>
<th style="height:29px">Gross Brokerage</th>
<th style="height:29px">Payouts</th>
<th style="height:29px">Net Brokerage</th>
<!-- <th style="height:29px">Manager Owner</th> -->
<th style="height:29px">Traded On </th>
</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
$RmOwnerid=$row['RMOwner'];	
$UploadingDate=$row['UploadingDate'];
$getRMOwnerid=mysql_query("SELECT `employee`.`name` FROM `employee` WHERE `employee`.`id`='$RmOwnerid'",$con) or die(mysql_error());
$rowRMOwnerid=mysql_fetch_array($getRMOwnerid);
?>

<tr id="fetchRow<?php echo $i;?>"  class="d<?php echo $i%2;?>">
<!-- <td><?php echo $row['name'] ?></td> -->
<td><?php echo $rowRMOwnerid[0] ?></td>
<td><?php echo $row['id'] ?></td>
<td><?php echo $code=$row['code'] ?></td>
<td><?php echo $row['fname'] ." ".$row['lname'] ?></td>
<td><?php echo $row['inroducer'] ?></td>
<td><?php echo round($row['Turnover']) ?></td>
<td><?php echo round($row['premiumBrokerage']) ?></td>
<td><?php echo round($row['DiscountBrokerage']) ?></td>
<td><?php echo round($row['grossbrokerage']) ?></td>
<td><?php echo round($row['payouts']) ?></td>
<td><?php echo round($row['grossbrokerage'])-round($row['payouts']) ?></td>


<?php 
$sqlDataManager=mysql_query("SELECT  `employee`.`name` 
FROM  `teamamtes` INNER JOIN  `contact` ON  `teamamtes`.`mateid` =  `contact`.`ownerid` 
INNER JOIN  `team` ON  `teamamtes`.`teamid` =  `team`.`id` 
INNER JOIN  `employee` ON  `team`.`leader` =  `employee`.`id` 
WHERE  `contact`.`ownerid` =  '$row[2]' AND `team`.`delete`='0' GROUP BY `teamamtes`.`teamid`",$con);
$rowManager=mysql_fetch_array($sqlDataManager);
?>

<!-- <td><?php echo $rowManager[0] ?></td> -->
<td><?php echo date('d-m-Y', strtotime($row['UploadingDate'])); ?></td>
</tr>

<?php
$i++;
}
?>

</table>







