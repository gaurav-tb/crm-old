<?php
session_start();
ob_start();
include("../include/conFig.php");


$rmowner = $_POST['Select1'];
$code = $_POST['code'];

$FromDate = $_POST['fromdate'];
$ToDate = $_POST['todate'];
$fromdate=date("Y-m-d", strtotime($FromDate));
$todate=date("Y-m-d", strtotime($ToDate));


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


$sql = "SELECT employee.name,employee.id as ownerid,contact.code, contact.phone,reduced_brokerage.EmailReplied,reducedbrokerageutilise.*,reduced_brokerage.EmailRepliedDate, reduced_brokerage.EmailReplied, reduced_brokerage.Activationamount,reduced_brokerage.amountWithGst,reduced_brokerage.brokeragePlan, reduced_brokerage.FundDebited, reduced_brokerage.FundDebitedDate, reduced_brokerage.FundAvailable, reduced_brokerage.FundClearDate, reduced_brokerage.FundClearDate, reduced_brokerage.Approved, reduced_brokerage.ApprovalDate,customersupport.RMOwnerid,`reduced_brokerage`.`RequestingDate`,`reduced_brokerage`.`StartDate`,`reduced_brokerage`.`EndDate`
FROM  `reduced_brokerage` 
INNER JOIN contact ON reduced_brokerage.cid = contact.id
INNER JOIN reducedbrokerageutilise ON reducedbrokerageutilise.client = contact.code
INNER JOIN employee ON contact.ownerid=employee.id
INNER JOIN `customersupport` ON `customersupport`.`clientid`=`contact`.`id` WHERE `reduced_brokerage`.`delete` ='0' AND reducedbrokerageutilise.date BETWEEN '$fromdate' AND '$todate'";

if($rmowner != ''){
$sql .="AND (`customersupport`.`RMOwnerid`='$rmowner')";	
}
if($code != '')
{
$sql .="AND `contact`.`code`='$code'";
}
//echo $sql;
// if ($plans != 0)
// {
// $sql .="AND `reduced_brokerage`.`brokeragePlan`='$plans'";
// }
// if($startdate !=''){
// 	$sql .="AND `reduced_brokerage`.`StartDate`='$startdate'";

// }
// if($fromdate !='' && $todate !=''){
// 	$sql .="AND  `reduced_brokerage`.`RequestingDate` BETWEEN '$fromdate' AND '$todate'";

// }
// if($debited_fromdate != '' && $debited_todate != '' )

// {
// $sql .= " and reduced_brokerage.FundDebitedDate BETWEEN '$debited_fromdate' AND '$debited_todate'";
// }
// if($clear_fromdate != '' && $clear_todate != '' )
// {
// $sql .= " and reduced_brokerage.FundClearDate BETWEEN '$clear_fromdate' AND '$clear_todate'";
// }
//echo $sql;

$getData=mysql_query($sql,$con) or die(mysql_error());
$format = date('Y-m-d His');
$name ="Reduced Brokerage Utilise Report".$introducer."_".$format.".xls";

//$name ="Reduced Brokerage Utilise Report".$introducer."_".$fromdate."_".$todate.".xls";
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");
?>

<table border="1" cellpadding="0" cellspacing="0" width="100%">
<tr>
<!-- <th style="height:29px">Client Owner</th>
 -->
 <th style="height:29px">RM Owner</th>
<th style="height:29px">Client Code</th>
<th style="height:29px">Utilise Date</th>

<th style="height:29px">Start Date</th>
<th style="height:29px">End Date</th>
<th style="height:29px">Fund Clear Date</th>
<th style="height:29px">Opening Balance</th>
<th style="height:29px">Utilise</th>
<th style="height:29px">Purchase</th>
<th style="height:29px">Closing Balance</th>


</tr>
<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
	$rmId=$row['RMOwnerid'];
$getRMName=mysql_query("SELECT `employee`.`name` FROM `employee` WHERE `employee`.`id`='$rmId'",$con) or die(mysql_error());
$rowRMName=mysql_fetch_array($getRMName);

	
?>
<tr id="fetchRow<?php echo $i;?>"  class="d<?php echo $i%2;?>">
<!-- <td style="text-align:center;"><?php echo $row['name'] ?></td> -->
<td style="text-align:center;"><?php echo $rowRMName[0] ?></td>

<td style="text-align:center;"><?php echo $row['code'] ?></td>
<td style="text-align:center;"><?php echo date('Y-m-d', strtotime($row['date']));   ?> </td>
 <td style="text-align:center;"><?php echo date('Y-m-d', strtotime($row['StartDate']));   ?> </td>
<td style="text-align:center;"><?php echo date('Y-m-d', strtotime($row['EndDate'])); ?></td>
<td style="text-align:center;"><?php if($row['FundClearDate']=='0000-00-00') {  echo 'NA'; } else { echo  date('Y-m-d', strtotime($row['FundClearDate'])); }  ?></td>

<td style="text-align:center;"><?php echo $row['openingBalance'] ?></td>
<td style="text-align:center;"><?php echo $row['utilise'] ?></td>
<td style="text-align:center;"><?php echo $row['PurchaseAmount'] ?></td>
<td style="text-align:center;"><?php echo $row['closingBalance'] ?></td>


</tr>

<?php
$i++;
}
?>

</table>









