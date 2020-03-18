<?php
session_start();
ob_start();
include("../include/conFig.php");
$from=date_create($_POST['fromdate']);
$fromdate=date_format($from,"Y-m-d 00:00:00");
$to=date_create($_POST['todate']);
$todate=date_format($to,"Y-m-d 23:59:59");
$leadowner = $_POST['leadowner'];

$fromYMD=date_format($from,"Y-m-d");
$todateYMD=date_format($to,"Y-m-d");


$getData=mysql_query("SELECT contact.fname, contact.lname, contact.code, contact.`pancardnumber` , customersupport.`BOAccountOpeningDate` , contact.email
FROM contact
INNER JOIN customersupport ON contact.id = customersupport.Clientid
WHERE contact.converted =  '1' AND contact.conversiondate
BETWEEN  '$fromYMD' AND  '$todateYMD'",$con) or die(mysql_error());

$format = date('Y-m-d His');
$name ="Dashboard Uploading Data".$introducer."_".$format.".xls";
//$name = "Dashboard Uploading Data".$introducer."_".$fromdate."_".$todate.".xls";
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");
?>

<table border="1" cellpadding="0" cellspacing="0" width="100%">
<tr>
<th style="height:29px">Client Name</th>
<th style="height:29px">Client Code</th>
<th style="height:29px">Password</th>
<th style="height:29px">Email</th>
<th style="height:29px">Account Opening Date</th>
</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{

?>
<tr id="fetchRow<?php echo $i;?>"  class="d<?php echo $i%2;?>">
<td><?php echo $row['fname']. " " .$row['lname'] ?></td>
<td><?php echo $row['code'] ?></td>
<td><?php echo $row['pancardnumber'] ?></td>
<td><?php echo $row['email'] ?></td>
<td><?php echo $row['BOAccountOpeningDate'] ?></td>
</tr>

<?php
$i++;
}
?>

</table>







