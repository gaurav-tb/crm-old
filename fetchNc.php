<?php
include("include/conFig.php");
$checkStr = time() - 600;
$checkTime = date("Y-m-d H:i:s",$checkStr);
$getData = mysql_query("SELECT * FROM `contact` WHERE `leadstatus` = '3' AND `leadsource` = '30' AND `createdate` < '$checkTime' AND `delete` = '0'",$con) or die(mysql_error());
$count = mysql_num_rows($getData);
echo $count;
?>
