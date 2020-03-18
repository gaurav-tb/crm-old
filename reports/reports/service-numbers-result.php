<?php 
include("../include/conFig.php");
$fordate=$_POST['fordate'];
//print_r($_POST);
$type=$_POST['type'];
$category = $_POST['category'];
	if($category == '')
	{
	$cstr = "servicecall.product =  product.id AND product.category = category.id";
	}
	else
	{
	$cstr = "servicecall.product =  product.id AND product.category = category.id AND category.id = '$category'";
	}
	
	if($type == '')
	{
	$tystr = "(1=1)";
	}
	else
	{
	$tystr = "servicecall.type= '$type'";
	}
$query = mysql_query("SELECT contact.fname,contact.lname,servicecall.mobile,category.name,servicecall.id,servicecall.type FROM contact,servicecall,product,category WHERE servicecall.cid = contact.id AND ".$cstr." AND ".$tystr." AND servicecall.fromdate <= '$fordate' AND servicecall.todate >= '$fordate'  ORDER BY category.name ASC",$con) or die(mysql_error());

while($row = mysql_fetch_array($query))
{
$masterkey = $row[3].$row[2];
	if(!array_key_exists($masterkey,$master))
	{
	$master[$masterkey] = 'occured';
		if($row[5] == 'c')
		{
		$type = "Client";
		}
		else
		{
		$type = "FreeTrial";
		}
		$service[$row[3]] .= "<td>".$row[0]." ".$row[1]."</td><td>".$row[2]."</td><td>".$type."</td>,"; 
		
		if(!array_key_exists($row[3],$already))
		{
		$already[$row[3]] = 'Happened';
		$thstr .= "<th colspan='3' style='width:300px;background:#222;color:#fff;'>".$row[3]."</th>";
		$t2hstr .= "<th style='width:100px;'>Name</th><th style='width:100px;'>Number</th><th style='width:100px;'>Type</th>";
		}
	}	

}



$name = "Numbers_Report_".$fordate.".xls";

header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");


?>



<table width="100%" cellpadding="5" cellspacing="0" border="1">
<tr>
<?php echo $thstr;?>
</tr>
<tr>
<?php echo $t2hstr;?>
</tr>
<tr>
<?php
foreach($service as $val)
{
?>
<td colspan="3" valign="top"  style='width:300px;'>
<table width="100%" cellpadding="5" cellspacing="0" border="1">
<?php
$temp = explode(",",$val);
foreach($temp as $tal)
{
?>
<tr><?php echo $tal;?></tr>
<?php
}
?>
</table>
</td>
<?php
}
?>
</tr>
</table>