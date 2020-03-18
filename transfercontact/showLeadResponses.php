<?php 
include("../include/conFig.php");
$transType = $_GET['transType'];
$Ownerid = $_GET['ownerid'];
$Leadsource = $_GET['Leadsource'];
$LeadResponse = $_GET['LeadResponse'];

if($Leadsource==0 || $Leadsource=='')
{
$idstr="`latestresponse`='$LeadResponse' AND converted='0'";	
}
else
{
$idstr="leadsource='$Leadsource' AND `latestresponse`='$LeadResponse' AND converted='0'";		
}

$getCount = mysql_query("SELECT `id` FROM `contact` WHERE `delete` = '0' AND `ownerid` = '$Ownerid' AND ".$idstr,$con) or die(mysql_error());
$count = mysql_num_rows($getCount);
if($transType == '')
echo "Total   " .$count. "   Contacts";
else if($transType == '0')
echo "Total   " .$count. "   Leads";
else
echo "Total   " .$count. "   Clients";

?>
