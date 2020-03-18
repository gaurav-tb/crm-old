<?php 
include("include/conFig.php");

$after10mins = strtotime('+10 minutes');
$after11mins = strtotime('+11 minutes');

$dateafter10mins = date('H:i:s', $after10mins);
$dateafter11mins = date('H:i:s', $after11mins);

$query=mysql_query("SELECT `id` FROM `teamamtes` WHERE `mateid`='$loggeduserid' AND `teamid`='6'",$con) or die(mysql_error());
$row=mysql_fetch_array($query);

$query = "SELECT * FROM `customersupport` WHERE `callbackdate` = '$date' AND `allotmentid`='$row[0]' AND `callbacktime` BETWEEN '$dateafter10mins' AND '$dateafter11mins' order by `callbackdate` desc limit 10";
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
