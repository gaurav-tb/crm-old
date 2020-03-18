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
$leadstatus=$_POST['leadstatus'];
$leadsource=$_POST['leadsource'];
$leadresponse=$_POST['leadresponse'];
$leadowner=$_POST['leadowner'];
$sql= "select contact.fname,contact.lname,contact.mobile,contact.email,contact.address,contact.createdate,contact.modifieddate,contact.callbackdate,contact.leadstatus,leadsource.name,leadresponse.name,employee.name from leadresponse,contact,leadsource,employee where contact.delete ='0' and contact.ownerid = employee.id and leadresponse.id = contact.latestresponse and leadsource.id = contact.leadsource and contact.leadstatus LIKE '-4-'";
$getdata=mysql_query($sql,$con) or die(mysql_error());
echo $countData = mysql_num_rows($getdata);


//$name = "General_Report_".$fromdate."_".$todate.".xls";
//echo $startdate;
//header("Content-Disposition: attachment; filename=\"$name\"");
//header("Content-Type: application/vnd.ms-excel");

?>
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
		<?php echo substr($lstatus,1,-2);
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
