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
$ApprovedClientOnly=$_POST['ApprovedClientOnly'];
$OwnerManager=$_POST['OwnerManager'];
$introducer=$_POST['introducer'];
$trade_fromdate=$_POST['trade_fromdate'];
$trade_todate=$_POST['trade_todate'];
// $mbl = $_POST['mobile'];
// $mobile = explode("\n", str_replace("\r", "", $mbl));
// $getmbl = implode(',', $mobile);
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
$ownermanagerCheck = $_POST['ownermanager'];
if($contactstatus==1)
{
$sql="select contact.leadstatus,leadsource.name,leadresponse.name,employee.name as ownername,contact.description,contact.dob,contact.inroducer,contact.code,contact.conversionrequestdate,contact.conversiondate,contact.kycmethod,contact.demataccountrequied,contact.segment,contact.id,activatepremium.Plan,activatepremium.ApprovedDate,contact.conversiondate,`contact`.`ownerid`,`customersupport`.`allotmentid`,contact.`paymethod`,contact.firstTradeDate,contact.`%brokerage`,`customersupport`.`LastRMOwnerChangeDate`,`customersupport`.`lastTradeDate`,`contact`.`fname`,`contact`.`lname`,`leadsource`.`name` as leadsourcename,customersupport.BOAccountOpeningDate,customersupport.fund_counted,customersupport.fund_counted_date,contact.conversionrequestdate from contact INNER JOIN `leadresponse` ON `contact`.`latestresponse`=`leadresponse`.`id` INNER JOIN `leadsource` ON `contact`.`leadsource`=`leadsource`.`id` INNER JOIN `employee` ON `contact`.`ownerid`=`employee`.`id` INNER JOIN `activatepremium` ON `contact`.`id`=`activatepremium`.`cid` INNER JOIN `customersupport` ON `contact`.`id`=`customersupport`.`clientid` where contact.delete ='0'";


}
else
{

	
	$sql="select contact.leadstatus,leadsource.name,leadresponse.name,employee.name as ownername,contact.description,contact.dob,contact.inroducer,contact.code,contact.conversionrequestdate,contact.conversiondate,contact.id,contact.firstTradeDate,contact.`%brokerage`,`customersupport`.`LastRMOwnerChangeDate`,`contact`.`fname`,`contact`.`lname`,`leadsource`.`name` as leadsourcename,customersupport.BOAccountOpeningDate,customersupport.fund_counted,customersupport.fund_counted_date,contact.conversionrequestdate from leadresponse,contact,leadsource,employee ,customersupport where contact.delete ='0' and contact.ownerid = employee.id and leadresponse.id = contact.latestresponse and leadsource.id = contact.leadsource and `contact`.`id`=`customersupport`.`clientid`";


}

// if($fromdate != '' || $todate != '' )
// {
// $sql .= " and contact.createdate BETWEEN '$fromdate' AND '$todate'";
// }
// if($m_fromdate != '' || $m_todate != '' )
// {
// $sql .= " and contact.modifieddate BETWEEN '$m_fromdate' AND '$m_todate'";
// }

// if($c_fromdate != '' || $c_todate != '' )
// {
// $sql .= " and contact.callbackdate BETWEEN '$c_fromdate' AND '$c_todate'";
// }

// if($conversion_fromdate != '' || $conversion_todate != '' )
// {
// $conversion_fromdate=$conversion_fromdate." 00:00:01";
// $conversion_todate=$conversion_todate." 23:59:59";
// $sql .= " and contact.conversionrequestdate BETWEEN '$conversion_fromdate' AND '$conversion_todate'";
// }
// if($approve_fromdate != '' || $approve_todate != '' )
// {
// $sql .= " and contact.conversiondate BETWEEN '$approve_fromdate' AND '$approve_todate'";
// }

// if($boAccountOpeningFromDate != '' || $boAccountOpeningToDate != '' )
// {
// $sql .= " and `customersupport`.`BOAccountOpeningDate` BETWEEN '$boAccountOpeningFromDate' AND '$boAccountOpeningToDate'";
// }
// if($trade_fromdate != '' || $trade_todate != '' )
// {
// $sql .= " and `contact`.`firstTradeDate` BETWEEN '$trade_fromdate' AND '$trade_todate'";
// }



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
if($introducer != "")
{
$sql .= " and contact.inroducer = '$introducer'";
}
if($arrayCount!=0)
{
$sql .= " AND (FIND_IN_SET('$newMates[0]',`RMOwnerid`) || FIND_IN_SET('$newMates[1]',`RMOwnerid`) || FIND_IN_SET('$newMates[2]',`RMOwnerid`) || FIND_IN_SET('$newMates[3]',`RMOwnerid`) || FIND_IN_SET('$newMates[4]',`RMOwnerid`)|| FIND_IN_SET('$newMates[5]',`RMOwnerid`)|| FIND_IN_SET('$newMates[6]',`RMOwnerid`)|| FIND_IN_SET('$newMates[7]',`RMOwnerid`)|| FIND_IN_SET('$newMates[8]',`RMOwnerid`)|| FIND_IN_SET('$newMates[9]',`RMOwnerid`))";
}
$getdata=mysql_query($sql,$con) or die(mysql_error());
$countData = mysql_num_rows($getdata);

$name = "RM_Mapping_Report_".$fromdate."_".$todate.".xls";
$format = date('Y-m-d His');
$name ="RM_Mapping_Report_".$format.".xls";
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");

?>
<table width="100%" cellpadding="5" cellspacing="0" border="1">




<tr>
	<th style="height:29px">Client Code</th>
	<th style="height:29px">Client Name</th>
	<th style="height:29px">RM Owner</th>
	<th style="height:29px">Brokerage Plan</th>
	<th style="height:29px">Introducer</th>
	<th style="height:29px">% Brokerage</th>
	<th style="height:29px">Conversion Date</th>
	<th style="height:29px">BO Account Opening Date</th>
	<?php
	if($ownermanagerCheck == 3)
	{
	?>
	<th style="height:29px">Owner Manager</th>
	<?php
	}
	?>

	<?php
	if($descriptionCheck == 2)
	{
	?>
	<th style="height: 29px">Description</th>
	<?php
	}
	?>

	<th style="height:29px">First Trade Date</th>
	<th style="height:29px">Last Trade Date</th>
</tr>

<?php
$kycmethod = array('1'=>'Physical KYC','2'=>'E-KYC');
$demataccountrequied = array('1'=>'Yes','2'=>'No');
$segment = array('1'=>'Equity','2'=>'Equity Derivatives','3'=>'Currency Derivatives','4'=>'Commodity Derivatives');
$softwarerequired = array('1'=>'Net Net','2'=>'Odin','3'=>'Iwin','4'=>'NOW');
$personverification = array('1'=>'Not Done','2'=>'Done','3'=>'Not Required');
$bankmapping = array('0'=>'Not selected yet','1'=>'Yes','2'=>'No');
$accountcharge = array('1'=>'Paid','2'=>'To be cut from margin');

while($row = mysql_fetch_array($getdata))
{
$SupportAllotment=$row['allotmentid'];
$getSupportOwner = mysql_query("SELECT `employee`.`name` FROM `employee` INNER JOIN `teamamtes` ON `employee`.`id`=`teamamtes`.`mateid` where `teamamtes`.`id`='$SupportAllotment'
",$con)or die(mysql_error());

	$rowSupportOwner = mysql_fetch_array($getSupportOwner);

	
$lstatus = "";
	$leadsta = explode('-',$row[8]);
	$status = str_ireplace(',','',$leadsta);
	foreach($status as $lsval)
	{
	$getValue = mysql_query("SELECT `name` FROM  `leadstatus` where `id` = '$lsval'",$con)or die(mysql_error());
	$fetchVal = mysql_fetch_array($getValue);
	$lstatus .= $fetchVal[0].", ";
	}

?>

	<tr>
		<?php 
		$cid= $row['id'];

        $getPlan = mysql_query("SELECT `Plan` FROM `activatepremium` WHERE `cid`='$cid'",$con) or die(mysql_error());
        $rowPlan = mysql_fetch_array($getPlan);
	
    	if($rowPlan[0]==1)
	    {
	    $plan="Regular Plan";
    	}
        else
        {
    	$plan="Premium Plan";
		}	

		$sqlData=mysql_query("SELECT `customersupport`.`BOClientOwner`,`employee`.`name`,`customersupport`.`BOAccountOpeningDate`,`employee`.`id` as `rmid` FROM `customersupport` INNER JOIN `employee` ON `customersupport`.`RMOwnerid`=`employee`.`id` WHERE `customersupport`.`clientid`='$cid'",$con);
        $rowBO=mysql_fetch_array($sqlData);
		?>
		<td><?php echo $row['code'];?></td>
		<td><?php echo $row['fname']." ".$row['lname']; ?></td>
    	<td><?php echo $rowBO[1];?></td>
	    <td><?php echo $plan; ?></td>
		<td>
		<?php echo $row['inroducer'];?>
		</td>
	    <td>
		<?php  echo $row['%brokerage'];?>
		</td>
        <td><?php echo date('d-M-Y', strtotime($row['conversionrequestdate'])); ?></td>
  
		
<?php 
if($ownermanagerCheck == 3)
{
$ownerid=$row['ownerid'];
$sqlDataManager=mysql_query("SELECT  `employee`.`name` 
FROM  `teamamtes` INNER JOIN  `contact` ON  `teamamtes`.`mateid` =  `contact`.`ownerid` 
INNER JOIN  `team` ON  `teamamtes`.`teamid` =  `team`.`id` 
INNER JOIN  `employee` ON  `team`.`leader` =  `employee`.`id` 
WHERE  `contact`.`ownerid` =  '$ownerid' AND `team`.`delete`='0'  GROUP BY  `teamamtes`.`teamid`",$con);

$rowManager=mysql_fetch_array($sqlDataManager);
?>	
<td><?php echo $rowManager[0] ?></td>
<?php }?>
<td><?php if($row['BOAccountOpeningDate']!='0000-00-00') { echo date('d-M-Y', strtotime($row['BOAccountOpeningDate'])); } else { echo "NA"; }  ?></td>
<td><?php if($row['firstTradeDate']!='0000-00-00') { echo date('d-M-Y', strtotime($row['firstTradeDate'])); } else { echo "NA"; }  ?>
</td>
<td><?php if($row['lastTradeDate']!='0000-00-00') { echo date('d-M-Y', strtotime($row['lastTradeDate'])); } else { echo "NA"; }  ?></td>
</tr>
<?php
}
?>

</table>
