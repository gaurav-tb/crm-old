<?php 
session_start();
ob_start();

include("../include/conFig.php");
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
$m_fromdate=$_POST['m_fromdate'];
$m_todate=$_POST['m_todate'];
$c_fromdate=$_POST['c_fromdate'];
$c_todate=$_POST['c_todate'];
$conversion_fromdate=$_POST['conversion_fromdate'];
$conversion_todate=$_POST['conversion_todate'];
$approve_fromdate=$_POST['approve_fromdate'];
$approve_todate=$_POST['approve_todate'];
$leadstatus=$_POST['leadstatus'];
$leadsource=$_POST['leadsource'];
$leadresponse=$_POST['leadresponse'];
$leadowner=$_POST['leadowner'];
$contactstatus=$_POST['contactstatus'];
$relationshipmanager=$_POST['relationshipmanager'];
$boAccountOpeningFromDate=$_POST['boaccountopening_fromdate'];
$boAccountOpeningToDate=$_POST['boaccountopening_todate'];

$trade_fromdate=$_POST['trade_fromdate'];
$trade_todate=$_POST['trade_todate'];

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

//Description Option
$descriptionCheck = $_POST['description'];
$ownermanagercheck = $_POST['ownermanager'];
if($contactstatus==1)
{

$sql="select employee.name AS owner,contact.id as id,contact.code,contact.fname, contact.lname,contact.conversionrequestdate,contact.`conversiondate`,contact.accountopeningamount,contact.accountopeningreffno,contact.`paymethod`,contact.firstTradeDate,activatepremium.ApprovedDate,`customersupport`.`lastTradeDate` from contact INNER JOIN `leadresponse` ON `contact`.`latestresponse`=`leadresponse`.`id` INNER JOIN  `leadsource` ON `contact`.`leadsource`=`leadsource`.`id` INNER JOIN `employee` ON `contact`.`ownerid`=`employee`.`id` INNER JOIN `activatepremium` ON `contact`.`id`=`activatepremium`.`cid` INNER JOIN `customersupport` ON `contact`.`id`=`customersupport`.`clientid` where contact.delete ='0'";
}
else
{
$sql="select employee.name AS Owner,contact.id as id, contact.code, contact.fname, contact.`conversionrequestdate`,contact.`conversiondate`,contact.accountopeningamount, contact.accountopeningreffno,contact.firstTradeDate,contact.`paymethod` from leadresponse,contact,leadsource,employee where contact.delete ='0' and contact.ownerid = employee.id and leadresponse.id = contact.latestresponse and leadsource.id = contact.leadsource";
}
	
	
if($fromdate != '' || $todate != '' )
{
$sql .= " and contact.createdate BETWEEN '$fromdate' AND '$todate'";
}
if($m_fromdate != '' || $m_todate != '' )
{
$sql .= " and contact.modifieddate BETWEEN '$m_fromdate' AND '$m_todate'";
}

if($c_fromdate != '' || $c_todate != '' )
{
$sql .= " and contact.callbackdate BETWEEN '$c_fromdate' AND '$c_todate'";
}

if($conversion_fromdate != '' || $conversion_todate != '' )
{
$conversion_fromdate=$conversion_fromdate." 00:00:01";
$conversion_todate=$conversion_todate." 23:59:59";
$sql .= " and contact.conversionrequestdate BETWEEN '$conversion_fromdate' AND '$conversion_todate'";
}
if($approve_fromdate != '' || $approve_todate != '' )
{
$sql .= " and contact.conversiondate BETWEEN '$approve_fromdate' AND '$approve_todate'";
}

if($boAccountOpeningFromDate != '' || $boAccountOpeningToDate != '' )
{
$sql .= " and `customersupport`.`BOAccountOpeningDate` BETWEEN '$boAccountOpeningFromDate' AND '$boAccountOpeningToDate'";
}
if($trade_fromdate != '' || $trade_todate != '' )
{
$sql .= " and `contact`.`firstTradeDate` BETWEEN '$trade_fromdate' AND '$trade_todate'";
}


if($leadstatus != "null")
{
$leadstatus = "-".$leadstatus ."-";
$sql .= " and contact.leadstatus LIKE '%$leadstatus%'";
}

if($leadsource != "null")
{
$sql .= " and contact.leadsource = '$leadsource'";
}

if($leadresponse != "null")
{
$sql .= " and contact.latestresponse = '$leadresponse'";
}

if($contactstatus != "")
{
$sql .= " and contact.converted = '$contactstatus'";
} 
//echo $sql;die;
if($leadowner != "null")
{
$sql .= " and contact.ownerid = '$leadowner'";
}

if($arrayCount!=0)
{
$sql .= " AND (FIND_IN_SET('$newMates[0]',`RMOwnerid`) || FIND_IN_SET('$newMates[1]',`RMOwnerid`) || FIND_IN_SET('$newMates[2]',`RMOwnerid`) || FIND_IN_SET('$newMates[3]',`RMOwnerid`) || FIND_IN_SET('$newMates[4]',`RMOwnerid`)|| FIND_IN_SET('$newMates[5]',`RMOwnerid`)|| FIND_IN_SET('$newMates[6]',`RMOwnerid`)|| FIND_IN_SET('$newMates[7]',`RMOwnerid`)|| FIND_IN_SET('$newMates[8]',`RMOwnerid`)|| FIND_IN_SET('$newMates[9]',`RMOwnerid`))";
}


//echo $sql;
$getdata=mysql_query($sql,$con) or die(mysql_error());
$countData = mysql_num_rows($getdata);
$format = date('Y-m-d His');
//$name = "AOC_Report".$fromdate."_".$todate.".xls";
$name = "AOC_Report_".$format.".xls";
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");

?>
<table width="100%" cellpadding="5" cellspacing="0" border="1">
<th style="height:29px">Owner</th>
<th style="height:29px">BO Owner</th>
<th style="height:29px">RM Owner</th>
<th style="height:29px">Name</th>
<th style="height:29px">Client Code</th>
<th style="height:29px">Conversion Request Date</th>
<th style="height:29px">Approve Date</th>
<th style="height:29px">Payment Method</th>
<th style="height:29px">BO Account Opening Date</th>
<th style="height:29px">Account opening charges Amount</th>
<th style="height:29px">Account opening charge reference no.</th>
<th style="height:29px">First Trade Date</th>
<th style="height:29px">Last Trade Date</th>


</tr>

<?php

while($row = mysql_fetch_array($getdata))
{


$clientid=$row['code'];



?>
	<tr>
	<?php 
	$cid= $row['id'];
	$sqlData=mysql_query("SELECT `customersupport`.`BOClientOwner`,`employee`.`name`,`customersupport`.`BOAccountOpeningDate` FROM `customersupport` INNER JOIN `employee` ON `customersupport`.`RMOwnerid`=`employee`.`id` WHERE `customersupport`.`clientid`='$cid'",$con);
    $rowBO=mysql_fetch_array($sqlData);
	?>
	<td>
	<?php echo $row['owner'];?>
	</td>
	<td>
	<?php echo $rowBO[0];?>
	</td>
	<td>
	<?php echo $rowBO[1];?>
	</td>
	<td>
	<?php echo $row['fname']." ".$row['lname'];?>
	</td>
	<td>
	<?php echo $row['code'];?>
	</td>

	<td><?php if($row['conversionrequestdate']!='0000-00-00 00:00:00') { echo date('d-M-Y', strtotime($row['conversionrequestdate'])); } else { echo "NA"; }  ?></td>


	<td><?php if($row['ApprovedDate']!='0000-00-00') { echo date('d-M-Y', strtotime($row['ApprovedDate'])); } else { echo "NA"; }  ?></td>


	<td>
		<?php	if($row['paymethod'] == 1){
				echo "PAYTM";
			}else if ($row['paymethod'] == 2) {
				echo "IMPS";
			}else if ($row['paymethod'] == 3) {
				echo "NEFT/RTGS";
			}else if ($row['paymethod'] == 4) {
				echo "CHEQUE";
			}else if ($row['paymethod'] == 5) {
				echo "RAZORPAY";
			}else if ($row['paymethod'] == 6) {
				echo "Cut To Margin";
			}
			?>
	</td>

    <td><?php if($row['BOAccountOpeningDate']!='0000-00-00') { echo date('d-M-Y', strtotime($row['BOAccountOpeningDate'])); } else { echo "NA"; }  ?></td>


	<td><?php echo $row['accountopeningamount'];?>
	</td>
	<td>
	<?php echo $row['accountopeningreffno'];?>
	</td>

    <td><?php if($row['firstTradeDate']!='0000-00-00') { echo date('d-M-Y', strtotime($row['firstTradeDate'])); } else { echo "NA"; }  ?></td>

    <td><?php if($row['lastTradeDate']!='0000-00-00') { echo date('d-M-Y', strtotime($row['lastTradeDate'])); } else { echo "NA"; }  ?></td>

</tr>
<?php }?>
</table>
