<?php
$con = mysql_connect('db.crm.shareshoppe.in','5556c899','2449d7b324e5');
if(!$con)
{
die('error');
}
else
{
mysql_select_db('5556c899',$con);
}

$cid = array();

 $select = "SELECT `id`,`mobile` FROM `contact` WHERE `latestresponse` = '5' AND `converted` = '0' AND `delete` = '0' AND `leadstatus` NOT LIKE '%-4-%' AND `leadsource` != '12' LIMIT 1";
$getlead = mysql_query($select,$con) or die(mysql_error());


while($row = mysql_fetch_array($getlead))
{
	$cid[] = $row[0];
}

foreach($cid as $id)
{
	$update = "UPDATE `contact` SET `ownerid`='0',`leadsource`='12',`alloted`='0',`read`='0' WHERE `id` = '$id'";
	//mysql_query($update,$con) or die(mysql_error());
}

?>
