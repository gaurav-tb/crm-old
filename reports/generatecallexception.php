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


$getData=mysql_query("SELECT employee.callingextension, employee.name, callinghours.mobile, ROUND( SUM(  `callinghours`.`callingtime` ) /60 ) AS CallDuration, COUNT( `callinghours`.`mobile` ) AS CallNumber
FROM callinghours LEFT JOIN  `employee` ON  `callinghours`.`extension` =  `employee`.`callingextension` 
WHERE  `callinghours`.`uploadingtime` BETWEEN  '$fromdate' AND  '$todate' AND  `employee`.`status` =  '1' AND  `employee`.`delete` =  '0'
GROUP BY  `callinghours`.`mobile` ORDER BY `callinghours`.`extension`" .$strOwner,$con) or die(mysql_error());
$format = date('Y-m-d His');
$name ="Call Exceptional Report".$introducer."_".$format.".xls";
//$name = "Call Exceptional Report".$introducer."_".$fromdate."_".$todate.".xls";
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");
?>

<table border="1" cellpadding="0" cellspacing="0" width="100%">
<tr>
<th style="height:29px">Extension</th>
<th style="height:29px">Employee Name</th>
<th style="height:29px">Destination</th>
<th style="height:29px">Duration Of call (In Mins.)</th>
<th style="height:29px">No. of Attempts</th>
<th style="height:29px">In CRM</th>
</tr>
<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
<tr id="fetchRow<?php echo $i;?>"  class="d<?php echo $i%2;?>">
<td><?php echo $row['callingextension'] ?></td>
<td><?php echo $row['name'] ?></td>
<td><?php echo $mobile=$row['mobile'] ?></td>
<td><?php echo $row['CallDuration'] ?></td>
<td><?php echo $row['CallNumber'] ?></td>
<?php 
$getMob=mysql_query("SELECT * FROM `contact` WHERE (`mobile`='$mobile' || `phone`='$mobile' || `alternateMobile`='$mobile')",$con) or die(mysql_error());
$getAlterNateMob=mysql_query("SELECT * FROM `customersupport` WHERE `customersupport`.`AlternativeMobile`='$mobile'",$con) or die(mysql_error());

if(mysql_num_rows($getMob)>0)
{
$status="Yes";	
}
else if(mysql_num_rows($getAlterNateMob) > 0)
{
$status="Yes";	
}
else
{
$status="No";		
}
?>

<td><?php echo $status ?></td>
</tr>

<?php
$i++;
}
?>

</table>







