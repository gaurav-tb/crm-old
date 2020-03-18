<?php 
session_start();
ob_start();

include("../include/conFig.php");
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
$m_fromdate='';
$m_todate='';
// $c_fromdate=$_POST['c_fromdate'];
// $c_todate=$_POST['c_todate'];
$conversion_fromdate=$_POST['conversion_fromdate'];
$conversion_todate=$_POST['conversion_todate'];
// $approve_fromdate=$_POST['approve_fromdate'];
// $approve_todate=$_POST['approve_todate'];
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
$introducer=$_POST['introducer'];
$mates = $_POST['DisplayRM'];
// $mbl = $_POST['mobile'];
// $mobile = explode("\n", str_replace("\r", "", $mbl));
// $getmbl = implode(',', $mobile);
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
$sql="select contact.fname,contact.lname,contact.mobile,contact.email,contact.address,contact.createdate,contact.modifieddate,contact.callbackdate,contact.leadstatus,leadsource.name,leadresponse.name,employee.name,contact.description,contact.dob,contact.inroducer,contact.code,contact.conversionrequestdate,contact.conversiondate,contact.kycmethod,contact.demataccountrequied,contact.segment,contact.personverification,contact.BOPD_date,contact.TSPS_date,contact.bankmapping,contact.bankmapping_date,contact.welcomemail_date,contact.softwaredemogiven_date,contact.accountopening,contact.accountopeningamount,contact.accountopeningreffno,contact.id,activatepremium.Plan,activatepremium.ApprovedDate,contact.conversiondate,contact.pancardnumber,contact.uidnumber
,contact.bankname,contact.bankbranchname,contact.bankaccounttype,contact.bankaccountnumber,contact.dpname,contact.dpid,contact.clientid,contact.phone,contact.altemail,`contact`.`ownerid`,`customersupport`.`allotmentid`,contact.`paymethod`,contact.firstTradeDate,contact.inroducer,customersupport.lastTradeDate,customersupport.fund_counted,customersupport.fund_counted_date
 from contact INNER JOIN `leadresponse` ON `contact`.`latestresponse`=`leadresponse`.`id` INNER JOIN  `leadsource` ON `contact`.`leadsource`=`leadsource`.`id` INNER JOIN `employee` ON `contact`.`ownerid`=`employee`.`id` INNER JOIN `activatepremium` ON `contact`.`id`=`activatepremium`.`cid` 
INNER JOIN `customersupport` ON `contact`.`id`=`customersupport`.`clientid` where contact.delete ='0'";
}
else
{

	$sql="select contact.fname,contact.lname,contact.mobile,contact.email,contact.address,contact.createdate,contact.modifieddate,contact.callbackdate,contact.leadstatus,leadsource.name,leadresponse.name,employee.name,contact.description,contact.dob,contact.inroducer,contact.code,contact.conversionrequestdate,contact.conversiondate,contact.kycmethod,contact.demataccountrequied,contact.segment,contact.personverification,contact.BOPD_date,contact.TSPS_date,contact.bankmapping,contact.bankmapping_date,contact.welcomemail_date,contact.softwaredemogiven_date,contact.accountopening,contact.accountopeningamount,contact.accountopeningreffno,contact.id,contact.conversiondate,contact.pancardnumber,contact.uidnumber
	,contact.bankname,contact.bankbranchname,contact.bankaccounttype,contact.bankaccountnumber,contact.dpname,contact.dpid,contact.clientid,contact.phone,contact.altemail,`contact`.`ownerid`,contact.`paymethod`,contact.firstTradeDate from leadresponse,contact,leadsource,employee where contact.delete ='0' and contact.ownerid = employee.id and leadresponse.id = contact.latestresponse and leadsource.id = contact.leadsource";

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
if($introducer != "")
{
$sql .= " and contact.inroducer = '$introducer'";
}
if($arrayCount!=0)
{
$sql .= " AND (FIND_IN_SET('$newMates[0]',`RMOwnerid`) || FIND_IN_SET('$newMates[1]',`RMOwnerid`) || FIND_IN_SET('$newMates[2]',`RMOwnerid`) || FIND_IN_SET('$newMates[3]',`RMOwnerid`) || FIND_IN_SET('$newMates[4]',`RMOwnerid`)|| FIND_IN_SET('$newMates[5]',`RMOwnerid`)|| FIND_IN_SET('$newMates[6]',`RMOwnerid`)|| FIND_IN_SET('$newMates[7]',`RMOwnerid`)|| FIND_IN_SET('$newMates[8]',`RMOwnerid`)|| FIND_IN_SET('$newMates[9]',`RMOwnerid`))";
}


//echo $sql;
$getdata=mysql_query($sql,$con) or die(mysql_error());
$countData = mysql_num_rows($getdata);
$format = date('Y-m-d His');
// $name = "Sales_Analysis_Report".$fromdate."_".$todate.".xls";
$name = "Sales_Analysis_Report_".$format.".xls";
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");

?>
<table width="100%" cellpadding="5" cellspacing="0" border="1">
<tr>
<th style="height:29px">Client Code</th>
<th style="height:29px">Lead Number</th>
<th style="height:29px">Owner</th>
<th style="height:29px">BO Owner</th>
<th style="height:29px">RM Owner</th>
<th style="height:29px">Name</th>
<!-- <th style="height:29px">Mobile</th>
<th style="height:29px">BO Mobile</th>
<th style="height:29px">Email</th>
<th style="height:29px">BO Email</th> -->
<th style="height:29px">Createdate</th>
<th style="height:29px">Modifieddate</th>
<th style="height:29px">Callbackdate</th>
<th style="height:29px">Leadstatus</th>
<th style="height:29px">Leadsource</th>
<th style="height:29px">Originalsource</th>
<th style="height:29px">Leadresponse</th>
<th style="height:29px">Date of Birth</th>
<th style="height:29px">Introducer</th>
<th style="height:29px">Conversion Request Date</th>
<th style="height:29px">Approve Date</th>
<th style="height:29px">KYC Method</th>
<th style="height:29px">Payment Method</th>
<th style="height:29px">Demat account requied</th>
<th style="height:29px">Segment </th>
<th style="height:29px">In Person Verification</th>
<th style="height:29px">Back office punching done date</th>
<th style="height:29px">Trading software password sent date</th>
<th style="height:29px">Bank Mapping</th>
<th style="height:29px">Bank Mapping date</th>
<th style="height:29px">Send welcome mail date</th>
<th style="height:29px">Is software demo given date</th>
<th style="height:29px">Account opening charges</th>
<th style="height:29px">Account opening charge amount</th>
<!-- <th style="height:29px">Account opening charge reference no.</th>-->
<th style="height:29px">Brokerage Plan</th>
<th style="height:29px">Pancard No.</th>
<th style="height:29px">Uid No.</th>
<th style="height:29px">Bank Name</th>
<th style="height:29px">Bank Branch Name</th>
<th style="height:29px">Account Type</th>
<th style="height:29px">Account Number</th>
<th style="height:29px">DP Name</th>
<th style="height:29px">DP ID</th>
<th style="height:29px">Client ID</th>
<th style="height:29px">BO Account Opening Date</th>
<?php
if($ownermanagercheck == 3)
{
?>
<th style="height:29px">Owner Manager</th>
<?php
}
?>

<th style="height:29px">Support Owner</th>


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
<th style="height:29px">Counted FTD</th>
<th style="height:29px">Counted FTD Date</th>


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
		<td>
		<?php echo $row[15];?>
		</td>
	<td>
		<?php echo $row['id'];?>
		</td>
		
		<td>
		<?php echo $row[11];?>
		</td>
		<?php 
		$cid= $row['id'];
		$sqlData=mysql_query("SELECT `customersupport`.`BOClientOwner`,`employee`.`name`,`customersupport`.`BOAccountOpeningDate` FROM `customersupport` INNER JOIN `employee` ON `customersupport`.`RMOwnerid`=`employee`.`id` WHERE `customersupport`.`clientid`='$cid'",$con);
        $rowBO=mysql_fetch_array($sqlData);
		?>
	
		<td>
		<?php echo $rowBO[0];?>
		</td>
		
		<td>
		<?php echo $rowBO[1];?>
		</td>
		
		
		
		<td>
		<?php echo $row[0]." ".$row[1];?>
		</td>
	    <!--	<td>
		<?php // echo $row[2];?>
		</td>
		
		<!-- <td>
		<?php // echo $row['phone'];?>
		</td>  
		<td>
		<?php //echo $row[3];?>
		</td>
		
		<td>
		<?php //echo $row['altemail'];?>
		</td> -->
		
		
		<!-- <td>
		<?php echo $row[4];?>
		</td>-->
		<td>
		<?php echo $row[5];?>
		</td>
		<td>
		<?php echo $row[6];?>
		</td>
		<td>
		<?php echo $row[7];?>
		</td>
		<td>
		<?php echo substr($lstatus,1,-2);
		?>
		</td>
		<td>
		<?php echo $row[9];?>
		</td>
		<td>
		<?php echo $row[9];?>
		</td>
		<td>
		<?php echo $row[10];?>
		</td>		
		<td>
		<?php echo $row[13];?>
		</td>
		<td>
		<?php echo $row[14];?>
		</td>
		
		<td>
		<?php echo $row[16];?>
		</td>
		<td>
		<?php echo $row['ApprovedDate'];?>
		</td>
		<td>
		<?php echo $kycmethod[$row[18]];?>
		</td>
		<td>
		<?php
		if($row['paymethod'] == 1){
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
		<td>
		<?php echo $demataccountrequied[$row[19]];?>
		</td>
		<td>
		<?php
		$segmentlist = '';
		$lst = explode(",",$row[20]);
		foreach($lst as $val)
		{
		$val = str_ireplace("-","",$val);
		$val = trim($val);
		if($val != '')
		{
					$segmentlist .= $segment[$val].',';
		}
		}
			echo $segmentlist;?>
		</td>
		<td>
		<?php echo $personverification[$row[21]] ;?>
		</td>
		<td>
		<?php echo $row[22] ;?>
		</td>
		<td>
		<?php echo $row[23] ;?>
		</td>
		<td>
		<?php echo $bankmapping[$row[24]] ;?>
		</td>
		<td>
		<?php echo $row[25] ;?>
		</td>
		<td>
		<?php echo $row[26] ;?>
		</td>
		<td>
		<?php echo $row[27] ;?>
		</td>
		<td>
		<?php echo $accountcharge[$row[28]] ;?>
		</td>
		<td>
		<?php echo $row[29] ;?>
		</td>
		<!-- <td>
		<?php echo $row[30] ;?>
		</td> -->
		<?php
		if($descriptionCheck == 2)
		{
		?>
		<td>
		<?php echo $row[12];?>
		</td>
		<?php
		}
		
		if($row['Plan']==1)
		{
		$plan='Regular Brokerage Plan';	
			
		}
		else
		{
		$plan='Premium Brokerage Plan';	
		}
		
		if($row['ApprovedDate'] == '0000-00-00')
		{
		$activationDate=$row['conversiondate'];	
		}
		else
		{
		$activationDate=$row['ApprovedDate'];
		}
		
		?>
		
<td><?php echo $plan;?></td>
<td><?php echo $row[35] ;?></td>
<td><?php echo $row[36] ;?></td>
<td><?php echo $row[37] ;?></td>
<td><?php echo $row[38] ;?></td>
<td><?php echo $row[39] ;?></td>
<td><?php echo $row[40] ;?></td>
<td><?php echo $row[41] ;?></td>
<td><?php echo $row[42] ;?></td>
<td><?php echo $row[43] ;?></td>
<td><?php echo date('d-m-Y', strtotime($rowBO[2])); ?></td>

<?php
$ownerid=$row['ownerid'];
if($ownermanagercheck == 3)
{
$sqlDataManager=mysql_query("SELECT  `employee`.`name` 
FROM  `teamamtes` INNER JOIN  `contact` ON  `teamamtes`.`mateid` =  `contact`.`ownerid` 
INNER JOIN  `team` ON  `teamamtes`.`teamid` =  `team`.`id` 
INNER JOIN  `employee` ON  `team`.`leader` =  `employee`.`id` 
WHERE  `contact`.`ownerid` =  '$ownerid' AND `team`.`delete`='0' GROUP BY  `teamamtes`.`teamid`",$con);
$rowManager=mysql_fetch_array($sqlDataManager);
?>



<td><?php echo $rowManager[0] ?></td>
<?php }?>
<td><?php echo $rowSupportOwner[0] ?></td>
<td><?php echo $row['firstTradeDate'] ?></td>	
<td><?php if($row['lastTradeDate']!='0000-00-00') { echo date('d/m/Y', strtotime($row['lastTradeDate'])); } else { echo "Never Traded"; }  ?></td>

<?php 
if(!empty($row['fund_counted']) && $row['fund_counted']==1)
{
$lastTradeDate ='Yes'; 
$ftd_date = date('d-M-Y', strtotime($row['fund_counted_date']));
}
else
{
$lastTradeDate ='No'; 
$ftd_date = 'NA';
}
?>
<td><?php echo $lastTradeDate; ?></td>
<td><?php echo $ftd_date; ?></td>
</tr>
<?php
}
?>

</table>
