<?php
include("../include/conFig.php");
$getData = mysql_query("",$con) or die(mysql_error()); 
$row = mysql_fetch_array($getData);
print_r($row);
?>