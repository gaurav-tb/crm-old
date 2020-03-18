<?php 
include("../include/conFig.php");
$transType = $_GET['transType'];
$Ownerid = $_GET['ownerid'];

if($transType == '')
{
$idstr = "(1=1)";
}
else
{
$idstr = "contact.converted = '".$transType."'";
}
//echo "SELECT `id` FROM `contact` WHERE `delete` = '0' AND `ownerid` = '99' AND ".$idstr;


$getCount = mysql_query("SELECT `id` FROM `contact` WHERE `delete` = '0' AND `ownerid` = '$Ownerid' AND ".$idstr,$con) or die(mysql_error());
$count = mysql_num_rows($getCount);
if($transType == '')
echo "Total   " .$count. "   Contacts";
else if($transType == '0')
echo "Total   " .$count. "   Leads";
else
echo "Total   " .$count. "   Clients";

?>
