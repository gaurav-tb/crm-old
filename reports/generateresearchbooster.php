<?php
session_start();
ob_start();
include("../include/conFig.php");
// $from=date_create($_POST['fromdate']);
// $fromdate=date_format($from,"Y-m-d");
// $to=date_create($_POST['todate']);
// $todate=date_format($to,"Y-m-d");

$StartDate = $_POST['startdate'];
$FromDate = $_POST['fromdate'];
$ToDate = $_POST['todate'];
$startdate=date("Y-m-d", strtotime($StartDate));
$fromdate=date("Y-m-d", strtotime($FromDate));
$todate=date("Y-m-d", strtotime($ToDate));
if($startdate == '1970-01-01' || $startdate == ''){
	$startdate ='';
}else{
 $startdate=date("Y-m-d", strtotime($StartDate));
}
if($fromdate == '1970-01-01' || $fromdate == ''){
	$fromdate ='';
}else{
 $fromdate=date("Y-m-d", strtotime($FromDate));
}
if($todate == '1970-01-01' || $todate == ''){
	$todate ='';
}else{
  $todate=date("Y-m-d", strtotime($ToDate));
}



$debited_from=$_POST['debited_fromdate'];
$debited_fromdate=date("Y-m-d",strtotime($debited_from));
$debited_to=$_POST['debited_todate'];
$debited_todate=date("Y-m-d",strtotime($debited_to));

$clear_from=$_POST['clear_fromdate'];
$clear_fromdate=date("Y-m-d",strtotime($clear_from));
$clear_to=$_POST['clear_todate'];
$clear_todate=date("Y-m-d",strtotime($clear_to));

$leadowner = $_POST['leadowner'];
$segments = $_POST['segments'];
$CheckFilter = $_POST['CheckFilter'];
$ApprovalStatus = $_POST['ApprovalStatus'];


if($debited_fromdate == '1970-01-01' || $debited_fromdate == ''){
	$debited_fromdate ='';
}else{
 $debited_fromdate=date("Y-m-d", strtotime($debited_from));
}
if($debited_todate == '1970-01-01' || $debited_todate == ''){
	$debited_todate ='';
}else{
 $debited_todate=date("Y-m-d", strtotime($debited_to));
}
if($clear_fromdate == '1970-01-01' || $clear_fromdate == ''){
	$clear_fromdate ='';
}else{
  $clear_fromdate=date("Y-m-d", strtotime($clear_from));
}
if($clear_todate == '1970-01-01' || $clear_todate == ''){
	$clear_todate ='';
}else{
  $clear_todate=date("Y-m-d", strtotime($clear_to));
}
//ApprovalStatus

$sql="SELECT employee.name,contact.code, contact.id as id, contact.phone, researchbooster.TelegramMobile, researchbooster.StartDate, researchbooster.EndDate, researchbooster.Telegraminstalled, researchbooster.EmailReplied, researchbooster.EmailRepliedDate, researchbooster.EmailReplied, researchbooster.Activationamt, researchbooster.Segments, researchbooster.FundDebited, researchbooster.FundDebitedDate, researchbooster.FundAvailable, researchbooster.FundClearDate, researchbooster.Approved, researchbooster.ApprovalDate,researchbooster.service,customersupport.RMOwnerid,`researchbooster`.`RequestingDate`
FROM  `researchbooster` 
INNER JOIN contact ON researchbooster.cid = contact.id
INNER JOIN employee ON contact.ownerid=employee.id
INNER JOIN `customersupport` ON `customersupport`.`clientid`=`contact`.`id` WHERE `researchbooster`.`delete` ='0'";



// if($ApprovalStatus=="3")
// {
// $sql .="AND (`researchbooster`.`Approved`='2' || `researchbooster`.`Approved`='1')";
// }
// else 
// {
// $sql .="AND (`researchbooster`.`Approved`='$ApprovalStatus')";
// }

// if($CheckFilter=='ConversionDate' || $CheckFilter=='')
// {
// $sql .="AND  `researchbooster`.`RequestingDate` BETWEEN '$fromdate' AND '$todate'";
// }
// else if($CheckFilter=='StartDate')
// {
// $sql .="AND '$fromdate' BETWEEN `researchbooster`.`StartDate` AND `researchbooster`.`EndDate`";	
// }else{

// }


// $strSegment=" FIND_IN_SET($segments,`Segments`)";



// if($leadowner!="null")
// {
// $sql .="AND `contact`.`ownerid`='$leadowner'";
// }

// else if ($segments!='null')
// {
// //$sql .=$strSegment;
// }

// else if($leadowner!="null" && $segments!='null')
// {
// $sql .="AND `contact`.`ownerid`='$leadowner' AND `researchbooster`.`delete` ='0'";//.$strSegment;
// }else if($debited_fromdate != '' && $debited_todate != '' )

// {
// $sql .= " and researchbooster.FundDebitedDate BETWEEN '$debited_fromdate' AND '$debited_todate'";
// }else if($clear_fromdate != '' && $clear_todate != '' )
// {
// $sql .= " and researchbooster.FundClearDate BETWEEN '$clear_fromdate' AND '$clear_todate'";
// }

// else
// {
// $sql .="AND `researchbooster`.`delete` ='0'";
// }

//echo $sql;

if($ApprovalStatus!="3")
{

$sql .="AND (`researchbooster`.`Approved`='$ApprovalStatus')";
}

if($fromdate !='' && $todate !=''){
$sql .="AND  `researchbooster`.`RequestingDate` BETWEEN '$fromdate' AND '$todate'";
}

if($startdate !='')
{
$sql .="AND '$startdate' BETWEEN `researchbooster`.`StartDate` AND `researchbooster`.`EndDate`";	
}


$strSegment=" FIND_IN_SET($segments,`Segments`)";



if($leadowner!="null")
{
$sql .="AND `contact`.`ownerid`='$leadowner'";
}

if ($segments!=0)
{
$sql .=$strSegment;
}

if($debited_fromdate != '' && $debited_todate != '' )

{
$sql .= " and researchbooster.FundDebitedDate BETWEEN '$debited_fromdate' AND '$debited_todate'";
}
if($clear_fromdate != '' && $clear_todate != '' )
{
$sql .= " and researchbooster.FundClearDate BETWEEN '$clear_fromdate' AND '$clear_todate'";
}
//echo $sql;
// else
// {
// $sql .="AND `researchbooster`.`delete` ='0'";
// }

$getData=mysql_query($sql,$con) or die(mysql_error());
$format = date('Y-m-d His');
$name ="Research Booster Report".$introducer."_".$format.".xls";

//$name ="Research Booster Report".$introducer."_".$fromdate."_".$todate.".xls";
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");
?>

<table border="1" cellpadding="0" cellspacing="0" width="100%">
<tr>
<th style="height:29px">Client Owner</th>
<th style="height:29px">RM Owner</th>
<th style="height:29px">BO Owner</th>

<th style="height:29px">Client Code</th>
<th style="height:29px">BO Mobile Number</th>
<th style="height:29px">Telegram Number</th>
<th style="height:29px">Service</th>
<th style="height:29px">Booster Start Date</th>
<th style="height:29px">Booster End Date</th>
<th style="height:29px">Telegram Application Installed</th>
<th style="height:29px">Amount Paid</th>
<th style="height:29px">Amount With GST</th>
<th style="height:29px">Segments Of Research Booster</th>
<th style="height:29px">Email Replied</th>
<th style="height:29px">Email Replied Date</th>
<th style="height:29px">Fund  Debited</th>
<th style="height:29px">Fund Debited Date</th>
<th style="height:29px">Fund Available</th>
<th style="height:29px">Fund Clear Date</th>
<th style="height:29px">Booster Conversion Date</th>
<th style="height:29px">Booster Approved </th>
<th style="height:29px">Booster Approval Date</th>

</tr>
<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
	$rmId=$row['RMOwnerid'];
$getRMName=mysql_query("SELECT `employee`.`name` FROM `employee` WHERE `employee`.`id`='$rmId'",$con) or die(mysql_error());
$rowRMName=mysql_fetch_array($getRMName);


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
<?php 
		$cid= $row['id'];
		$sqlData=mysql_query("SELECT `customersupport`.`BOClientOwner`,`employee`.`name`,`customersupport`.`BOAccountOpeningDate` FROM `customersupport` INNER JOIN `employee` ON `customersupport`.`RMOwnerid`=`employee`.`id` WHERE `customersupport`.`clientid`='$cid'",$con);
        $rowBO=mysql_fetch_array($sqlData);
		?>
	
<td style="text-align:center;">
<?php echo $rowBO[0];?>
</td>
<td style="text-align:center;"><?php echo $row['code'] ?></td>
<td style="text-align:center;"><?php  if($perm==1) {  echo $row['phone']; 	} else { echo 'NA'; }  ?></td>
<td style="text-align:center;"><?php  if($perm==1) {  echo $row['TelegramMobile']; 	} else { echo 'NA'; }?></td>
<td style="text-align:center;"><?php echo $service[$row['service']] ?></td>
<td><?php if($row['StartDate']!='0000-00-00') { echo date('d-M-Y', strtotime($row['StartDate'])); } else { echo "NA"; }  ?></td>
<td><?php if($row['EndDate']!='0000-00-00') { echo date('d-M-Y', strtotime($row['EndDate'])); } else { echo "NA"; }  ?></td>
<td style="text-align:center;"><?php echo $condition[$row['Telegraminstalled']]	?></td>
<td style="text-align:center;"><?php echo $row['Activationamt'] ?></td>
<td style="text-align:center;"><?php echo $row['AmountWithGst'] ?></td>
<td style="text-align:center;"><?php echo $segmentlist ?></td>
<td style="text-align:center;"><?php echo $condition[$row['EmailReplied']]  ?></td>
<td><?php if($row['EmailRepliedDate']!='0000-00-00') { echo date('d-M-Y', strtotime($row['EmailRepliedDate'])); } else { echo "NA"; }  ?></td>
<td style="text-align:center;"><?php echo $condition[$row['FundDebited']] ?></td>
<td><?php if($row['FundDebitedDate']!='0000-00-00') { echo date('d-M-Y', strtotime($row['FundDebitedDate'])); } else { echo "NA"; }  ?></td>
<td style="text-align:center;"><?php echo $fundAvailable[$row['FundAvailable']] ?></td>
<td style="text-align:center;"><?php 
if($row['FundClearDate']=='0000-00-00') {  echo 'NA'; } else { echo  date('d-M-Y', strtotime($row['FundClearDate'])); }
// if($row['FundClearDate']=='0000-00-00') 
// {
// 	if( $fundAvailable[$row['FundAvailable']] == 'Credit Balance'){
// 	echo  date('d M, Y', strtotime($row['FundDebitedDate']));
// 	}else{
//   		echo 'NA';
//   	} 
// }else 
// { 
// 	if( $fundAvailable[$row['FundAvailable']] == 'Credit Balance'){
// 		echo  date('d M, Y', strtotime($row['FundDebitedDate']));
// 	}else{
// 		echo  date('d M, Y', strtotime($row['FundClearDate']));
// 	}
// }  

?></td>
<td><?php if($row['RequestingDate']!='0000-00-00 00:00:00') { echo date('d-M-Y', strtotime($row['RequestingDate'])); } else { echo "NA"; }  ?></td>
<td style="text-align:center;"><?php echo $approved[$row['Approved']]  ?> </td>
<td><?php if($row['ApprovalDate']!='0000-00-00') { echo date('d-M-Y', strtotime($row['ApprovalDate'])); } else { echo "NA"; }  ?></td>
</tr>

<?php
$i++;
}
?>

</table>









