<?php 
session_start();
ob_start();

include("../include/conFig.php");
$from=date_create($_POST['fromdate']);
$fromdate=date_format($from,"Y-m-d 00:00:00");
$to=date_create($_POST['todate']);
$todate=date_format($to,"Y-m-d 23:59:59");
$leadowner= $_POST['leadowner'];




if($leadowner!="null")
{
$strOwner=" AND `employee`.`id`='$leadowner' AND `employee`.`status`='1' AND `employee`.`delete`='0' GROUP BY `callinghours`.`extension`";
}
else
{
$strOwner=" AND `employee`.`status`='1' AND `employee`.`delete`='0' GROUP BY `callinghours`.`extension`";
}
 

/*
$sql="SELECT `employee`.`name`,`employee`.`callingextension`,SUM(`callinghours`.`callingtime`),`employee`.`id`,
count(`contact`.`converted`) FROM `employee` INNER JOIN `callinghours` ON `employee`.`callingextension` =  `callinghours`.`extension` INNER JOIN `contact` ON `employee`.`id`=`contact`.`ownerid` WHERE `callinghours`.`uploadingtime` BETWEEN  '$fromdate' AND '$todate' AND `contact`.`converted`='1' AND `contact`.`conversionrequestdate` BETWEEN '$fromdate' AND '$todate' GROUP BY `callinghours`.`extension`";
*/

$sql="SELECT `employee`.`name`,`employee`.`callingextension`,SUM(`callinghours`.`callingtime`),`employee`.`id`,`employee`.`salary`,`employee`.`TargetBucket` FROM `employee` INNER JOIN `callinghours` ON `employee`.`callingextension` =  `callinghours`.`extension` WHERE `callinghours`.`uploadingtime` BETWEEN  '$fromdate' AND '$todate'".$strOwner;

$getdata=mysql_query($sql,$con) or die(mysql_error());

$format = date('Y-m-d His');
$name = "Sales_Summary_Report_".$format.".xls";
// $name = "Sales_Summary_Report".$fromdate."_".$todate.".xls";
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");

?>
<table width="100%" cellpadding="5" cellspacing="0" border="1">
<tr>
<th style="height:29px">Employee Name</th>
<th style="height:29px">Calling Extension</th>
<th style="height:29px">Client Converted</th>
<th style="height:29px">Current Week Conversion</th>
<th style="height:29px">Current Month Conversion</th>
<th style="height:29px">Calling Time</th>
<th style="height:29px">No. of Call Made</th>
<th style="height:29px">Total answered Calls</th>
</tr>


<?php 
while($row=mysql_fetch_array($getdata))
{
?>	
<tr>
<td><?php echo $row[0]; ?></td>	<!-- employee Name -->
<td><?php echo $row[1]; ?></td>	<!-- Calling Extension -->
<?php
$sql="SELECT `converted` FROM `contact` WHERE `ownerid`='$row[3]' AND `conversionrequestdate` BETWEEN '$fromdate' AND  '$todate'";
$getcon=mysql_query($sql,$con) or die(mysql_error());
$countClient = mysql_num_rows($getcon); 
?>
<td><?PHP  echo $countClient; ?></td><!-- client converted -->

<?php 


$day=date("D",strtotime($todate));

if($day=="Mon")
{
$initial = date("Y-m-d 00:00:00", strtotime("+0 day",strtotime($todate)));	
$final = date("Y-m-d 23:59:59", strtotime("+6 day", strtotime($todate)));	
}

if($day=="Tue")
{
$initial = date("Y-m-d 00:00:00", strtotime("-1 day",strtotime($todate)));	
$final = date("Y-m-d 23:59:59", strtotime("+5 day", strtotime($todate)));	
}

if($day=="Wed")
{
$initial = date("Y-m-d 00:00:00", strtotime("-2 day",strtotime($todate)));	
$final = date("Y-m-d 23:59:59", strtotime("+4 day", strtotime($todate)));	
}

if($day=="Thu")
{
$initial = date("Y-m-d 00:00:00", strtotime("-3 day",strtotime($todate)));	
$final = date("Y-m-d 23:59:59", strtotime("+3 day", strtotime($todate)));	
}

if($day=="Fri")
{
$initial = date("Y-m-d 00:00:00", strtotime("-4 day",strtotime($todate)));	
$final = date("Y-m-d 23:59:59", strtotime("+2 day", strtotime($todate)));	
}

if($day=="Sat")
{
$initial = date("Y-m-d 00:00:00", strtotime("-5 day",strtotime($todate)));	
$final = date("Y-m-d 23:59:59", strtotime("+1 day", strtotime($todate)));	
}

if($day=="Sun")
{
$initial = date("Y-m-d 00:00:00", strtotime("-6 day",strtotime($todate)));	
$final = date("Y-m-d 23:59:59", strtotime("+0 day", strtotime($todate)));	
}


$sql="SELECT * FROM `contact` WHERE `ownerid`='$row[3]' AND `conversionrequestdate` BETWEEN '$initial' AND '$final'";
$getweek=mysql_query($sql,$con) or die(mysql_error());
$countweek = mysql_num_rows($getweek); 
?>


<td><?php echo $countweek ?></td><!-- Current week Conversion -->

<?php 

$finalmon = date("Y-m-d", strtotime($todate));

$res=mysql_query("SELECT `fromdate`,`todate` FROM `targetrange` WHERE '$finalmon' BETWEEN `fromdate` AND `todate`");
$rowMon=mysql_fetch_array($res);


$initialmon=$rowMon[0]." "."00:00:01";
$finalmon=$rowMon[1]." "."23:59:59";

$sql="SELECT * FROM `contact` WHERE `ownerid`='$row[3]' AND `conversionrequestdate` BETWEEN '$initialmon' AND '$finalmon'";
$getmon=mysql_query($sql,$con) or die(mysql_error());
$rowmon = mysql_num_rows($getmon); 
?>

<td><?php echo $rowmon; ?></td>	<!-- Current Month Conversion -->
<?php 
$salary=str_replace(",", "", $row[4]);
?>

<?php 

$hours = floor($row[2] / 3600);
$mins = floor($row[2] / 60 % 60);
$secs = floor($row[2] % 60);

?>
<td><?php echo $timeFormat = sprintf('%02d:%02d:%02d', $hours, $mins, $secs); ?></td>

<?PHP 
$sql_call="SELECT COUNT(`callstatus`) FROM `callinghours` WHERE `uploadingtime` BETWEEN '$fromdate' AND  '$todate' AND `extension`='$row[1]'";
$putdata=mysql_query($sql_call,$con) or die(mysql_error());
$countAns = mysql_fetch_array($putdata);
?>
<td><?php echo $countAns[0]; ?></td><!-- total call made -->

<?PHP 
$sql_call="SELECT COUNT(`callstatus`) FROM `callinghours` WHERE `uploadingtime` BETWEEN '$fromdate' AND  '$todate' AND `extension`='$row[1]' AND `callstatus`='1'";
$putdata=mysql_query($sql_call,$con) or die(mysql_error());
$countAns = mysql_fetch_array($putdata);
?>
<td><?php echo $countAns[0] ; ?></td><!-- total answered calls -->

</tr>	
<?php } ?>
</table>
