<?php
include('../include/connection.php');
$getUsers = mysql_query("SELECT `id` FROM `employee",$con) or die(mysql_error());
while($row = mysql_fetch_array($getUsers))
{
mysql_query("INSERT INTO `userprofile`( `userid`, `updatedby`) VALUES ('$row[0]','1')",$con) or die(mysql_error());
}

?>