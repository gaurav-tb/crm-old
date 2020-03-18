<?php
session_start();
ob_start();
include("../include/conFig.php");


$leadowner = $_POST['leadowner'];
$plans = $_POST['plans'];
$CheckFilter = $_POST['CheckFilter'];
$ApprovalStatus = $_POST['ApprovalStatus'];
$StartDate = $_POST['startdate'];
$FromDate = $_POST['fromdate'];
$ToDate = $_POST['todate'];
$startdate=date("Y-m-d", strtotime($StartDate));
$fromdate=date("Y-m-d", strtotime($FromDate));
$todate=date("Y-m-d", strtotime($ToDate));
$debited_from=$_POST['debited_fromdate'];
$debited_fromdate=date("Y-m-d",strtotime($debited_from));
$debited_to=$_POST['debited_todate'];
$debited_todate=date("Y-m-d",strtotime($debited_to));

$clear_from=$_POST['clear_fromdate'];
$clear_fromdate=date("Y-m-d",strtotime($clear_from));
$clear_to=$_POST['clear_todate'];
$clear_todate=date("Y-m-d",strtotime($clear_to));
if($startdate == '1970-01-01' || $startdate = ''){
	$startdate ='';
}else{
 $startdate=date("Y-m-d", strtotime($StartDate));
}
if($fromdate == '1970-01-01' || $fromdate = ''){
	$fromdate ='';
}else{
 $fromdate=date("Y-m-d", strtotime($FromDate));
}
if($todate == '1970-01-01' || $todate = ''){
	$todate ='';
}else{
  $todate=date("Y-m-d", strtotime($ToDate));
}
if($debited_fromdate == '1970-01-01' || $debited_fromdate = ''){
	$debited_fromdate ='';
}else{
 $debited_fromdate=date("Y-m-d", strtotime($debited_from));
}
if($debited_todate == '1970-01-01' || $debited_todate = ''){
	$debited_todate ='';
}else{
 $debited_todate=date("Y-m-d", strtotime($debited_to));
}
if($clear_fromdate == '1970-01-01' || $clear_fromdate = ''){
	$clear_fromdate ='';
}else{
  $clear_fromdate=date("Y-m-d", strtotime($clear_from));
}
if($clear_todate == '1970-01-01' || $clear_todate = ''){
	$clear_todate ='';
}else{
  $clear_todate=date("Y-m-d", strtotime($clear_to));
}
//ApprovalStatus

$sql="SELECT employee.name,employee.id as ownerid,contact.code, contact.phone,reduced_brokerage.EmailReplied, reduced_brokerage.EmailRepliedDate, reduced_brokerage.EmailReplied, reduced_brokerage.Activationamount,reduced_brokerage.amountWithGst,reduced_brokerage.brokeragePlan, reduced_brokerage.FundDebited, reduced_brokerage.FundDebitedDate, reduced_brokerage.FundAvailable, reduced_brokerage.FundClearDate, reduced_brokerage.FundClearDate, reduced_brokerage.Approved, reduced_brokerage.ApprovalDate,customersupport.RMOwnerid,`reduced_brokerage`.`RequestingDate`,`reduced_brokerage`.`StartDate`,`reduced_brokerage`.`EndDate`,`reduced_brokerage`.`BonusAmount`
FROM  `reduced_brokerage` 
INNER JOIN contact ON reduced_brokerage.cid = contact.id
INNER JOIN employee ON contact.ownerid=employee.id
INNER JOIN `customersupport` ON `customersupport`.`clientid`=`contact`.`id` WHERE `reduced_brokerage`.`delete` ='0' order by reduced_brokerage.RequestingDate ASC";



// if($ApprovalStatus != 3){
// $sql .="AND (`reduced_brokerage`.`Approved`='$ApprovalStatus')";	
// }else
// if($leadowner != 0)
// {
// $sql .="AND `contact`.`ownerid`='$leadowner'";
// }
// else if ($plans != 0)
// {
// $sql .="AND `reduced_brokerage`.`brokeragePlan`='$plans'";
// }
// else if($leadowner != 0 && $plans != 0)
// {
// $sql .="AND `contact`.`ownerid`='$leadowner' AND `reduced_brokerage`.`brokeragePlan` ='$plans'";//.$strSegment;
// }
// else if($leadowner != 0 && $ApprovalStatus != 3)
// {
// $sql .="AND `contact`.`ownerid`='$leadowner' AND `reduced_brokerage`.`Approved` ='$ApprovalStatus'";//.$strSegment;
// }
// else if($plans != 0 && $ApprovalStatus != 3)
// {
// $sql .="AND `reduced_brokerage`.`brokeragePlan` ='$plans' AND `reduced_brokerage`.`Approved` ='$ApprovalStatus'";//.$strSegment;
// }
// else if($plans != 0 && $ApprovalStatus != 3 && ($leadowner != 0))
// {
// $sql .="AND `reduced_brokerage`.`brokeragePlan` ='$plans' AND `reduced_brokerage`.`Approved` ='$ApprovalStatus'";//.$strSegment;
// }
// else
// {
// $sql .="AND `reduced_brokerage`.`delete` ='0'";
// }
if($ApprovalStatus != 3){
$sql .="AND (`reduced_brokerage`.`Approved`='$ApprovalStatus')";	
}
if($leadowner != 0)
{
$sql .="AND `contact`.`ownerid`='$leadowner'";
}
if ($plans != 0)
{
$sql .="AND `reduced_brokerage`.`brokeragePlan`='$plans'";
}
if($startdate !=''){
	$sql .="AND `reduced_brokerage`.`StartDate`='$startdate'";

}
if($fromdate !='' && $todate !=''){
	$sql .="AND  `reduced_brokerage`.`RequestingDate` BETWEEN '$fromdate' AND '$todate'";

}
if($debited_fromdate != '' && $debited_todate != '' )

{
$sql .= " and reduced_brokerage.FundDebitedDate BETWEEN '$debited_fromdate' AND '$debited_todate'";
}
if($clear_fromdate != '' && $clear_todate != '' )
{
$sql .= " and reduced_brokerage.FundClearDate BETWEEN '$clear_fromdate' AND '$clear_todate'";
}
//echo $sql;

$getData=mysql_query($sql,$con) or die(mysql_error());

$format = date('Y-m-d His');
$name ="Reduced Brokerage Report".$introducer."_".$format.".xls";
//$name ="Reduced Brokerage Report".$introducer."_".$fromdate."_".$todate.".xls";
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");
?>

<table border="1" cellpadding="0" cellspacing="0" width="100%">
<tr>
<th style="height:29px">Client Owner</th>
<th style="height:29px">RM Owner</th>
<th style="height:29px">Client Code</th>
<th style="height:29px">BO Mobile Number</th><!-- 
<th style="height:29px">Telegram Number</th>
<th style="height:29px">Service</th>
<th style="height:29px">Booster Start Date</th>
<th style="height:29px">Booster End Date</th>
<th style="height:29px">Telegram Application Installed</th>-->
<th style="height:29px">Amount Paid</th>
<th style="height:29px">Amount With GST</th>
<th style="height:29px">Bonus Amount</th>
<th style="height:29px">Plan</th>
<th style="height:29px">Email Replied</th>
<th style="height:29px">Email Replied Date</th>
<th style="height:29px">Fund  Debited</th>
<th style="height:29px">Fund Debited Date</th>
<th style="height:29px">Fund Available</th>
<th style="height:29px">Fund Clear Date</th>
<th style="height:29px">Reduced Brokerage Conversion Date</th>
<th style="height:29px">Reduced Brokerage Approved </th>
<th style="height:29px">Reduced Brokerage Approval Date</th>
<th style="height:29px">Start Date</th>
<th style="height:29px">End Date</th>
</tr>
<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
	$rmId=$row['RMOwnerid'];
$getRMName=mysql_query("SELECT `employee`.`name` FROM `employee` WHERE `employee`.`id`='$rmId'",$con) or die(mysql_error());
$rowRMName=mysql_fetch_array($getRMName);
// $ownerid  = $row['ownerid'];
// $getRMName=mysql_query("SELECT `customersupport`.`BOClientOwner`,`employee`.`name`,`customersupport`.`BOAccountOpeningDate` FROM `customersupport` INNER JOIN `employee` ON `customersupport`.`RMOwnerid`=`employee`.`id` WHERE `customersupport`.`clientid`='$cid'",$con) or die(mysql_error());
//$getRMName=mysql_query("SELECT  `employee`.`name` FROM  `teamamtes` INNER JOIN  `contact` ON  `teamamtes`.`mateid` =  `contact`.`ownerid` INNER JOIN  `team` ON  `teamamtes`.`teamid` =  `team`.`id` INNER JOIN  `employee` ON  `team`.`leader` =  `employee`.`id` WHERE  `contact`.`ownerid` =  '$ownerid' AND `team`.`delete`='0' GROUP BY  `teamamtes`.`teamid`",$con) or die(mysql_error());
//$rowRMName=mysql_fetch_array($getRMName);


$segment = array('1'=>'Commodity','2'=>'Future','3'=>'Option','4'=>'Equity');
	
$segmentlist = '';
$lst = explode(",",$row['Segments']);
foreach($lst as $val) 
{
$val = str_ireplace("-","",$val);
$val = trim($val);
if($val != '') 
{
$segmentlist .= $segment[$val].',';
}
}
$segmentlist = rtrim($segmentlist,",");	
	
	
$fundAvailable = array('1'=>'Credit Balance','2'=>'Excess Stocks With POA','3'=>'Insufficient Fund');
$approved = array('0'=>'Unapproved','1'=>'Pending Due To Insufficient Fund','2'=>'Approved');
$condition=array('0'=>'No','1'=>'Yes');
$service=array('1'=>'Paid Service','2'=>'Free Trial');

	
?>
<tr id="fetchRow<?php echo $i;?>"  class="d<?php echo $i%2;?>">
<td style="text-align:center;"><?php echo $row['name'] ?></td>
<td style="text-align:center;"><?php echo $rowRMName[0] ?></td>

<td style="text-align:center;"><?php echo $row['code'] ?></td>
 <td style="text-align:center;"><?php  if($perm==1) {  echo $row['phone']; 	} else { echo 'NA'; }  ?></td>
<!--<td><?php  if($perm==1) {  echo $row['TelegramMobile']; 	} else { echo 'NA'; }?></td>
<td><?php echo $service[$row['service']] ?></td>
<td><?php echo date('d-m-Y', strtotime($row['StartDate'])); ?></td>
<td><?php echo date('d-m-Y', strtotime($row['EndDate'])); ?></td>
<td><?php echo $condition[$row['Telegraminstalled']]	?></td> -->
<td style="text-align:center;"><?php echo $row['Activationamount'] ?></td>
<td style="text-align:center;"><?php echo $row['amountWithGst'] ?></td>
<td style="text-align:center;"><?php echo $row['BonusAmount'] ?></td>
<td style="text-align:center;"><?php echo $row['brokeragePlan'] ?></td>
<td style="text-align:center;"><?php echo $condition[$row['EmailReplied']]  ?></td>
<td><?php if($row['EmailRepliedDate']!='0000-00-00') { echo date('d-M-Y', strtotime($row['EmailRepliedDate'])); } else { echo "NA"; }  ?></td>
<td style="text-align:center;"><?php echo $condition[$row['FundDebited']] ?></td>
<td><?php if($row['FundDebitedDate']!='0000-00-00') { echo date('d-M-Y', strtotime($row['FundDebitedDate'])); } else { echo "NA"; }  ?></td>
<td style="text-align:center;"><?php echo $fundAvailable[$row['FundAvailable']] ?></td>
<td style="text-align:center;"><?php if($row['FundClearDate']=='0000-00-00') {  echo 'NA'; } else { echo  date('d-M-Y', strtotime($row['FundClearDate'])); }  ?></td>
<td style="text-align:center;"><?php if($row['RequestingDate']=='0000-00-00 00:00:00') {  echo 'NA'; } else { echo  date('d-M-Y', strtotime($row['RequestingDate'])); }  ?></td>
<td style="text-align:center;"><?php echo $approved[$row['Approved']]  ?> </td>
<td><?php if($row['ApprovalDate']!='0000-00-00') { echo date('d-M-Y', strtotime($row['ApprovalDate'])); } else { echo "NA"; }  ?></td>
<td><?php if($row['StartDate']!='0000-00-00') { echo date('d-M-Y', strtotime($row['StartDate'])); } else { echo "NA"; }  ?></td>
<td><?php if($row['EndDate']!='0000-00-00') { echo date('d-M-Y', strtotime($row['EndDate'])); } else { echo "NA"; }  ?></td>

</tr>

<?php
$i++;
}
?>

</table>









