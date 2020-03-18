<?php
include("../include/conFig.php");
$dx = $_GET['dx'];
$oid = $_GET['id'];
$dx = explode(",",$dx);
$i=0;
foreach($dx as $val)
{
	if($val != '0')
	{
	$getOwner = mysql_query("SELECT employee.name FROM employee,contact WHERE employee.id = contact.ownerid AND contact.id = '$val'",$con) or die(mysql_error());
	$rowOwner = mysql_fetch_array($getOwner);
	$old  = $rowOwner[0];
	
	$getOwner = mysql_query("SELECT employee.name FROM employee WHERE employee.id = '$oid'",$con) or die(mysql_error());
	$rowOwner = mysql_fetch_array($getOwner);
	$new  = $rowOwner[0];
	
	
	$note = "<span style='color:#3B5998;text-transform:capitalize'>".$new."</span> is the new Owner. ".$old." no longer holds control of this record , and Ownership Changed By <strong>".$loggedname."</strong>";
		$subject = 'Oship';
		$note = str_ireplace("'","\'",$note);
mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$val', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());

	mysql_query("UPDATE `contact` SET `ownerid` = '$oid',`read` = '0' WHERE `id` = '$val'",$con) or die(mysql_error());
	$i++;
	}
}
echo "Owner Sucessfully Changed For ".$i." Records";
?>

