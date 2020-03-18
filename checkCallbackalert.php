<?php 
include("include/conFig.php");


$after10mins = strtotime('+10 minutes');
$after11mins = strtotime('+11 minutes');

$dateafter10mins = date('H:i:s', $after10mins);
$dateafter11mins = date('H:i:s', $after11mins);

if($perm==11 || $perm==16)
{
$query = "SELECT * FROM `contact` INNER JOIN `customersupport` ON `contact`.`id`=`customersupport`.`clientid` WHERE `contact`.`callbackdate` = '$date' AND `contact`.`callbacktime` BETWEEN '$dateafter10mins' AND '$dateafter11mins' AND `customersupport`.`RMOwnerid` = '$loggeduserid' AND `contact`.`converted`='1' order by `contact`.`callbackdate` desc limit 10";
}
else 
{
$query = "SELECT * FROM `contact` WHERE `callbackdate` = '$date' AND `callbacktime` BETWEEN '$dateafter10mins' AND '$dateafter11mins' AND `ownerid` = '$loggeduserid' AND `contact`.`converted`='0' order by `callbackdate` desc limit 10";
}	

$getData = mysql_query($query,$con) or die(mysql_error());


if(mysql_num_rows($getData) > 0)
{
while($row = mysql_fetch_array($getData))
{
$sting .= "Name: ".$row['fname'];
$sting .= "--Mobile: ".$row['mobile'];
$sting .= "\r\n";
}
echo $sting;
}
else
{
echo "NOTHINGFOUNDHERE";
}


?>
