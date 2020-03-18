<?php
   include("include/connection.php");

$date=date('Y-m-d H:i:s');

echo date('d-M-Y',strtotime($date));
?>
