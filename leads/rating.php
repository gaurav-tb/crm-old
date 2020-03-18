<?php
    include("../include/conFig.php");
 	if(isset($_GET['rate']) && !empty($_GET['rate']))
	{
    $rate=$_GET['rate'];
	$clientid=$_GET['clientid'];

    $res=mysql_query("update `contact` set `mark`='$rate' where `id`='$clientid'",$con) or die(mysql_error());
	
    if($res===TRUE) 
	{
    echo '1';
    }
    }

?>