<?php 
session_start();
ob_start();
include("../include/conFig.php");

$sql="select team.leader,team.id from team where team.id IN(29,21,20,15,12)";
$getdata=mysql_query($sql,$con) or die(mysql_error());

while($row = mysql_fetch_array($getdata))
{
select count(customersupport.fund_counted),teamamtes.mateid from teamamtes where teamid='29' and customersupport.fund_counted_date between '2020-02-01' and '2020-02-28' group by customersupport.ownerid


}


$format=date('Y-m-d H:i:s');
$name ="G2M Upload Report".$format.".xls";
// header("Content-Disposition: attachment; filename=\"$name\"");
// header("Content-Type: application/vnd.ms-excel");



?>

<table width="100%" cellpadding="5" cellspacing="0" border="1" style="text-align:center;">
<tr>
<th style="height:29px">Dealer Id </th>
<th style="height:29px">ClientId</th>
<th style="height:29px">Direct Client</th>
<th style="height:29px">ClientName</th>
<th style="height:29px">ClientNo</th>
<th style="height:29px">Dealer Name</th>
<th style="height:29px">Dealer Email ID</th>
<th style="height:29px">Dealer Mobile Number</th>
<th style="height:29px">Landline No.1</th>
<th style="height:29px">Landing No.2</th>
<th style="height:29px">Landing No.3</th>
<th style="height:29px">Landing No.4</th>
<th style="height:29px">Agentlandingno_BKUP1</th>
<th style="height:29px">Agentlandingno_BKUP2</th>
<th style="height:29px">Agentlandingno_BKUP3</th>
<th style="height:29px">Agentlandingno_BKUP4</th>
<th style="height:29px">HeadOffice1</th>
<th style="height:29px">HeadOffice2</th>
<th style="height:29px">HeadOffice3</th>
<th style="height:29px">HeadOffice4</th>
<th style="height:29px">HeadOffice5</th>
<th style="height:29px">HeadOffice6</th>
<th style="height:29px">HeadOffice1_BKUP</th>
<th style="height:29px">HeadOffice2_BKUP</th>
<th style="height:29px">HeadOffice3_BKUP</th>
<th style="height:29px">HeadOffice4_BKUP</th>
<th style="height:29px">HeadOffice5_BKUP</th>
<th style="height:29px">HeadOffice6_BKUP</th>
<th style="height:29px">Alt_ClientNo</th>
</tr>
<?php 

while($row=mysql_fetch_array($getdata))
{

 if($row['plan']=='1')
 {
 $getadminnumbers=mysql_query("SELECT mobile, landing_number_2, landing_number_3, landing_number_4
 FROM employee WHERE id = '1'",$con) or die(mysql_error());

  $rowadmin=mysql_fetch_array($getadminnumbers);

  $landing_number_1=$rowadmin['mobile'];
  $landing_number_2=$rowadmin['landing_number_2'];
  $landing_number_3=$rowadmin['landing_number_3'];
  $landing_number_4=$rowadmin['landing_number_4'];

 }
 else
 {
  $landing_number_1=$row['dealermobile'];
  $landing_number_2=$row['landing_number_2'];
  $landing_number_3=$row['landing_number_3'];
  $landing_number_4=$row['landing_number_4'];
 } 


 if($row['bomobile1']=='' || preg_match("/X/",$row['bomobile1']))
 {
 $bomobilenumer=$row['mobile'];
 } 
 else
 {
 $bomobilenumer=$row['bomobile1']; 
 }

?>
<tr>
  <td><?php echo "TBE".$row['dealerid']; ?></td> 
  <td><?php echo $row['code']; ?></td> 
  <td>Direct</td> 
  <td><?php echo $row['clientname']; ?></td> 
  <td><?php echo $bomobilenumer; ?></td> 
  <td><?php echo $row['dealername']; ?></td> 
  <td><?php echo $row['dealeremail']; ?></td> 
  <td><?php echo $landing_number_1; ?></td> 
  <td><?php echo $landing_number_1; ?></td>
  <td><?php echo $landing_number_2; ?></td>  
  <td><?php echo $landing_number_3; ?></td> 
  <td><?php echo $landing_number_4; ?></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
 
 
</tr>
<?php }  ?>

<?php 
while($row=mysql_fetch_array($getdata2))
{
 if($row['bomobile2']=='' || preg_match("/X/",$row['bomobile2']))
 {
 $bomobilenumer=$row['mobile'];
 } 
 else
 {
 $bomobilenumer=$row['bomobile2']; 
 }




 if($row['plan']=='1')
 {
 $getadminnumbers=mysql_query("SELECT mobile, landing_number_2, landing_number_3, landing_number_4
 FROM employee WHERE id = '1'",$con) or die(mysql_error());

  $rowadmin=mysql_fetch_array($getadminnumbers);

  $landing_number_1=$rowadmin['mobile'];
  $landing_number_2=$rowadmin['landing_number_2'];
  $landing_number_3=$rowadmin['landing_number_3'];
  $landing_number_4=$rowadmin['landing_number_4'];
 }
 else
 {
  $landing_number_1=$row['dealermobile'];
  $landing_number_2=$row['landing_number_2'];
  $landing_number_3=$row['landing_number_3'];
  $landing_number_4=$row['landing_number_4'];
 } 




  ?>
  <tr>
  <td><?php echo "TBE".$row['dealerid']; ?></td> 
  <td><?php echo $row['code']."a"; ?></td> 
  <td>Direct</td> 
  <td><?php echo $row['clientname']; ?></td> 
  <td><?php echo $bomobilenumer; ?></td> 
  <td><?php echo $row['dealername']; ?></td> 
  <td><?php echo $row['dealeremail']; ?></td> 
  <td><?php echo $landing_number_1; ?></td> 
  <td><?php echo $landing_number_1; ?></td>
  <td><?php echo $landing_number_2; ?></td>  
  <td><?php echo $landing_number_3; ?></td> 
  <td><?php echo $landing_number_4; ?></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td> 
  <td></td>  
  </tr>
<?php }  ?>





