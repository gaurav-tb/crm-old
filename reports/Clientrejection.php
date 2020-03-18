<?php
session_start();
ob_start();
include("../include/conFig.php");

$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];

$getdata=mysql_query("SELECT noteline.cid,contact.fname,noteline.createdate,contact.lname,noteline.conversionrequestdate,contact.mobile,employee.name,noteline.note,contact.kycmethod,contact.segment,contact.accountopeningreffno,contact.accountopeningamount,contact.pancardnumber,contact.softwarerequired,contact.personverification,contact.accountopening,contact.code
FROM `noteline` INNER JOIN `contact` ON `noteline`.cid=`contact`.id INNER JOIN `employee` ON `contact`.ownerid=`employee`.id WHERE `noteline`.`conversionrequestdate` BETWEEN '$fromdate' AND '$todate' AND `noteline`.`subject`='Canclerequest'",$con) or die(mysql_error());

$format = date('Y-m-d His');
// $name = "Rejection_Report_".$fromdate."_".$todate.".xls";
$name = "Rejection_Report_".$format.".xls";
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");
?>

<table border="1" cellpadding="0" cellspacing="0" width="100%">
<tr>
<th>Lead Number</th>
<th>Client Owner</th>
<th>Client Name</th>
<th>Client Code</th>
<!-- th>Mobile</th> -->
<th>Conversion Request Date</th>
<th>Rejection Date</th>
<th>Rejection Reason</th>
<th>Kyc Method</th>
<!-- <th>Segments</th> -->
<th>Inperson Verification</th>
<th>Software Required</th>
<th>Account Opening Charges</th>
<th>Account Opening Amount</th>
<th>Order ID </th>
<th>Pancard No.</th>
</tr>
<?php
$i=0;
while($row = mysql_fetch_array($getdata))
{
	
?>
<tr id="fetchRow<?php echo $i;?>"  class="d<?php echo $i%2;?>">
<td align="center"><?php echo $row[0] ?></td><!-- Client Number   -->
<td align="center"><?php echo $row[6] ?></td><!-- Client Owner   -->
<td align="center"><?php echo $row[1]." " .$row[3] ?></td><!-- Client name  -->
<td align="center"><?php echo $row['code'] ?></td><!-- Client Owner   -->

<!-- <td align="center"><?php echo $row[5] ?></td> -->

<!--  Mobile  -->
<!-- Conversion -->
<td align="center"><?php if($row[4]!='0000-00-00 00:00:00') { echo date('d-M-Y', strtotime($row[4])); } else { echo "NA"; }  ?></td>

<!-- Request Date  -->
<td align="center"><?php if($row[2]!='0000-00-00') { echo date('d-M-Y', strtotime($row[2])); } else { echo "NA"; }  ?></td>

<td align="center"><?php echo date("d-M-Y",strtotime());?></td><!-- Rejection Date  -->
<td align="center"><?php echo $row[7] ?></td><!-- Rejection Reason -->
<td align="center"><?php if($row[8]==1){ echo 'Physical KYC' ;} else { echo 'E-KYC'; }	   ?></td><!-- Kyc Method   -->
<!-- <td align="center"><?php // if($row[9]==1){ echo 'Equity'; } if($row[9]==2){ echo 'Equity Derivatives'; } if($row[9]==3){ echo 'Currency Derivatives'; } if($row[9]==4) { echo 'Commodity Derivatives'; } ?></td><!-- Segments   --> 
<td align="center"><?php if($row[14]==1) { echo 'not done'; } if($row[14]==2) { echo 'done'; } else { echo 'not required'; }	?></td><!-- Inperson Verification  -->
<td align="center"><?php if($row[13]==1){ echo 'Net Net'; } if($row[13]==2){ echo 'Odin'; } if($row[13]==3){ echo 'Iwin' ; } if($row[13]==4) { echo 'NOW' ; } ?></td><!-- Software Required  -->
<td align="center"><?php if($row[15]==1) { echo 'Paid'; } if($row[15]==2) {  ' To be cut from margin'; } else { 'Not Paid' ; } ?></td><!-- Account Opening Charges  -->
<td align="center"><?php echo $row[11] ?></td><!-- Account Opening Amount  -->
<td align="center"><?php echo $row[10] ?></td><!-- Order ID -->
<td align="center"><?php echo $row[12] ?></td><!-- Pancard No. -->
</tr>		
<?php
$i++;
}
?>

</table>
