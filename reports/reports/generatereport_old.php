<?php 
include("../include/conFig.php");
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
$m_fromdate=$_POST['m_fromdate'];
$m_todate=$_POST['m_todate'];
$c_fromdate=$_POST['c_fromdate'];
$c_todate=$_POST['c_todate'];

$s_fromdate=$_POST['s_fromdate'];
$s_todate=$_POST['s_todate'];

$leadstatus=$_POST['leadstatus'];
$leadsource=$_POST['leadsource'];
$leadresponse=$_POST['leadresponse'];
$leadowner=$_POST['leadowner'];

$sql= "SELECT contact.fname,contact.lname,contact.mobile,contact.email,contact.address,contact.createdate,contact.modifieddate,contact.callbackdate,leadstatus.name,leadsource.name,leadresponse.name,employee.name,servicecall.startdate,servicecall.enddate FROM leadresponse,contact,leadstatus,leadsource,servicecall,employee WHERE employee.id = contact.ownerid AND contact.delete ='0' AND leadresponse.id = contact.latestresponse AND leadstatus.id= contact.leadstatus AND leadsource.id = contact.leadsource";

if($fromdate != 'YYYY-MM-DD' || $todate != 'YYYY-MM-DD' )
{
$sql .= " AND contact.createdate BETWEEN '$fromdate' AND '$todate'";
}
if($m_fromdate != 'YYYY-MM-DD' || $m_todate != 'YYYY-MM-DD' )
{
$sql .= " AND contact.modifieddate BETWEEN '$m_fromdate' AND '$m_todate'";
}

if($c_fromdate != 'YYYY-MM-DD' || $c_todate != 'YYYY-MM-DD' )
{
$sql .= " AND contact.callbackdate BETWEEN '$c_fromdate' AND '$c_todate'";
}

if($s_fromdate != 'YYYY-MM-DD' || $s_todate != 'YYYY-MM-DD' )
{
$sql .= " AND servicecall.fromdate >= '$s_fromdate' AND  servicecall.todate <= '$s_todate' AND servicecall.cid = contact.id";
}

if($leadstatus != "null")
{
$sql .= " AND contact.leadstatus = '$leadstatus'";
}

if($leadsource != "null")
{
$sql .= " AND contact.leadsource = '$leadsource'";
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


?>
<div style="float:right"><a href="export.php?data=<?php echo base64_encode($sql)?>">Download</a></div>
<table width="100%" cellpadding="5" cellspacing="0" border="1">
<tr>
<th style="height: 29px">Contact Owner</th>
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
<th style="height: 29px">Freetrial StartDate</th>
<th style="height: 29px">Freetrial StartDate</th>



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
