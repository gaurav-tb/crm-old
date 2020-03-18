<?php
session_start();
ob_start();
include("../include/conFig.php");

$teamid=$_POST['teamid'];

if($teamid==0)
{
$getdata=mysql_query("SELECT employee.name,employee.id,employee.mobile,employee.landing_number_2,employee.landing_number_3,employee.landing_number_4,leadsource.name as leadsource,profile.name as designation,employee.joiningdate,employee.email FROM employee 
INNER JOIN teamamtes ON employee.id = teamamtes.mateid
INNER JOIN leadsource ON employee.poolfetchsource = leadsource.id
INNER JOIN profile ON employee.profile= profile.id
INNER JOIN team ON teamamtes.teamid=team.id
WHERE employee.delete =  '0' AND team.delete='0'",$con) or die(mysql_error());
}
else
{
$getdata=mysql_query("SELECT employee.name,employee.id,employee.mobile,employee.landing_number_2,employee.landing_number_3,employee.landing_number_4,leadsource.name as leadsource,profile.name as designation,employee.joiningdate,employee.email FROM employee 
INNER JOIN teamamtes ON employee.id = teamamtes.mateid
INNER JOIN leadsource ON employee.poolfetchsource = leadsource.id
INNER JOIN profile ON employee.profile= profile.id
INNER JOIN team ON teamamtes.teamid=team.id
WHERE teamamtes.teamid = '$teamid'
AND employee.delete =  '0' AND team.delete='0'",$con) or die(mysql_error());
}




$format = date('Y-m-d His');


$name = "Employee Manager mapping Report_".$format.".xls";
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");
?>

<table border="1" cellpadding="0" cellspacing="0" width="100%">
<tr>
<th>Team Name</th>
<th>Employee Name</th>
<th>Manager Name</th>
<th>Designation</th>
<th>Email Address</th>
<th>Mobile number</th>
<th>Landing number 2</th>
<th>Landing number 3</th>
<th>Landing number 4</th>
<th>Employee joining date</th>
<th>Lead fetch source</th>
</tr>
<?php
$i=0;


while($row = mysql_fetch_array($getdata))
{
$getLeaderdata=mysql_query("SELECT employee.name AS leadername,team.name as teamname 
FROM employee
INNER JOIN team ON employee.id = team.leader
INNER JOIN teamamtes ON team.id = teamamtes.teamid
WHERE teamamtes.mateid='$row[1]'",$con) or die(mysql_error());
$rowLeaderName=mysql_fetch_array($getLeaderdata);
?>
<tr id="fetchRow<?php echo $i;?>"  class="d<?php echo $i%2;?>">
<td><?php echo $rowLeaderName[1]; ?></td>
<td><?php echo $row[0] ?></td>
<td><?php echo $rowLeaderName[0]; ?></td>
<td><?php echo $row['designation']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['mobile']; ?></td>
<td><?php echo $row['landing_number_2']; ?></td>
<td><?php echo $row['landing_number_3']; ?></td>
<td><?php echo $row['landing_number_4']; ?></td>
<td><?php if($row['joiningdate']!='0000-00-00') { echo date('d-M-Y', strtotime($row['joiningdate'])); } else { echo "NA"; }  ?></td>
<td><?php echo $row['leadsource']; ?></td>
</tr>		
<?php
$i++;
}
?>

</table>
