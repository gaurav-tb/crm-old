<?php 
include("../include/conFig.php");
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
$m_fromdate=$_POST['m_fromdate'];
$m_todate=$_POST['m_todate'];
$c_fromdate=$_POST['c_fromdate'];
$c_todate=$_POST['c_todate'];
$leadstatus=$_POST['leadstatus'];
$leadsource=$_POST['leadsource'];
$leadresponse=$_POST['leadresponse'];
$leadowner=$_POST['leadowner'];
$sql= "select contact.fname,contact.lname,contact.mobile,contact.email,contact.address,contact.createdate,contact.modifieddate,contact.callbackdate,leadstatus.name,leadsource.name,leadresponse.name,employee.name from leadresponse,contact,leadstatus,leadsource,employee where contact.delete ='0' and contact.ownerid = employee.id and leadresponse.id = contact.latestresponse and leadstatus.id= contact.leadstatus and leadsource.id = contact.leadsource";
//$sql = "SELECT * FROM `contact` WHERE `delete` = '0'";
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

if($leadstatus != "null")
{
$sql .= " and contact.leadstatus = '$leadstatus'";
}

if($leadsource != "null")
{
$sql .= " and contact.leadsource = '$leadsource'";
}

if($leadresponse != "null")
{
$sql .= " and contact.latestresponse = '$leadresponse'";
}

if($leadowner != "null")
{
$sql .= " and contact.ownerid = '$leadowner '";
}
//echo $sql;
$getdata=mysql_query($sql,$con) or die(mysql_error());


$name = "General_Report_".$fromdate."_".$todate.".xls";
//echo $startdate;
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");

?>
<div style="float:right"><a href="export.php?data=<?php echo base64_encode($sql)?>">Download</a></div>
<table width="100%" cellpadding="5" cellspacing="0" border="1">
<tr>
<th style="height: 29px">Owner</th>
<th style="height: 29px">Name</th>
<th style="height: 29px">Mobile</th>
<th style="height: 29px">Email</th>
<th style="height: 29px">address</th>
<th style="height: 29px">Createdate</th>
<th style="height: 29px">Modifieddate</th>
<th style="height: 29px">Callbackdate</th>
<th style="height: 29px">Leadstatus</th>
<th style="height: 29px">Leadsource</th>
<th style="height: 29px">Leadresponse</th>



</tr>

<?php
while($row = mysql_fetch_array($getdata))
{
?>
	<tr>
		<td>
		<?php echo $row[11];?>
		</td>
		<td>
		<?php echo $row[0]." ".$row[1];?>
		</td>
		<td>
		<?php echo $row[2];?>
		</td>
		<td>
		<?php echo $row[3];?>
		</td>
		<td>
		<?php echo $row[4];?>
		</td>
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
		<?php echo $row[8];

		/*$leadso= $row['leadstatus'];
		$getValue=mysql_query("SELECT `name` FROM  `leadstatus` where `id` = '$leadso' ",$con)or die(mysql_error());
		$fetchVal=mysql_fetch_array($getValue);
		echo $fetchVal[0];*/
		?>
		</td>
		<td>
		<?php echo $row[9];?>
		</td>
		<td>
		<?php echo $row[10];?>
		</td>
</tr>
<?php
}
?>

</table>
