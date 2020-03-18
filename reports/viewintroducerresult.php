<?php
session_start();
ob_start();
include("../include/conFig.php");
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
$introducer = $_POST['introducer'];

if($introducer=='' && $fromdate == '' && $todate=='')
{	
$STR="contact.inroducer!='$introducer'";
}
else if($introducer=='' && $fromdate != '' && $todate !='')
{
$STR="contact.inroducer!='' AND contact.conversiondate BETWEEN '$fromdate' AND '$todate'";
}
else
{
$STR="contact.inroducer='$introducer'";
}



$getData=mysql_query("SELECT contact.`fname` , contact.`lname` , contact.`code` , contact.`mobile` , contact.`inroducer` , contact.`accountopeningreffno` , contact.`accountopeningamount` , contact.`pancardnumber` , contact.`conversiondate` , contact.`id` , contact.`converted` , firstTradeDate, `employee`.`name`, `contact`.`ownerid`,`customersupport`.fund_counted,`customersupport`.fund_counted_date FROM `contact` LEFT JOIN employee ON contact.ownerid = employee.id LEFT JOIN customersupport on contact.id=customersupport.clientid WHERE ". $STR ."",$con) or die(mysql_error());

$name = "Introducer_Report_For".$introducer."_".$fromdate."_".$todate.".xls";
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");
?>

<table border="1" cellpadding="0" cellspacing="0" width="100%">
	    <tr>
		<th>Number</th>
		<th>Owner Name</th>
		<th>Name</th>
		<th>Client Code</th>
		<th>Introducer Code</th>
		<th>Account Opening Charges</th>
		<th>Pancard No.</th>
		<th>Conversion Date</th>
		<th>First Trade Date</th>
		<th>lead/client</th>
		<th>Counted FTD</th>
        <th>Counted FTD Date</th>
		</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{

	if($row[13]==0)
	{
    $client_owner='CRM Pool';
	}
	else
	{
    $client_owner=$row[12];
	}
?>
	<tr id="fetchRow<?php echo $i;?>"  class="d<?php echo $i%2;?>">
	<td align="center"><?php echo $row[9]?></td>
	<td align="center"><?php echo $client_owner ?></td>
	<td align="center"><?php echo $row[0] .''. $row[1] ?></td>
	<td align="center"><?php echo $row[2]?></td>
	<!-- <td align="center"><?php echo $row[3];?></td> -->
	<td align="center"><?php echo $row[4];?></td>
	<!-- <td align="center"><?php echo $row[5];?></td> -->
	<td align="center"><?php echo $row[6];?></td>
	<td align="center"><?php echo $row[7];?></td>
	<td><?php if($row[8]!='0000-00-00') { echo date('d-M-Y', strtotime($row[8])); } else { echo "NA"; }  ?></td>
	<td><?php if($row['firstTradeDate']!='0000-00-00') { echo date('d-M-Y', strtotime($row['firstTradeDate'])); } else { echo "NA"; }  ?></td>
	<td align="center"><?php 
		if($row['converted'] == 1){
			echo "Client";
		}else{
			echo "Lead";
		}
	?></td>
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
$i++;
}
?>

</table>





