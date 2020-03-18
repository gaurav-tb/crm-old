<?php 
include("include/conFig.php");

$getAllotment = mysql_query("SELECT mateid FROM teamamtes where teamid='19' ORDER BY RAND() LIMIT 1;",$con) or die(mysql_error());
$rowAllotment = mysql_fetch_array($getAllotment);

echo $rowAllotment[0];

//echo base64_decode('#bGVhZHMvdmlldw==$$**$$dmlld0NvbnRlbnQ=$$**$$bWFuaXB1bGF0ZUNvbnRlbnQ=$$**$$TGVhZHM=');
?>