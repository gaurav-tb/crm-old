<?php

include_once("../include/conFig.php");
$id = $_GET['id'];

$getData = mysql_query("SELECT * FROM client_code_archive where `client_code_archive`.`deleted`='0' ORDER BY rand() LIMIT 1",$con) or die(mysql_error());
if(mysql_num_rows($getData)) 
{
$row = mysql_fetch_array($getData);
$client_id=$row['id'];
$code=$row['code'];

mysql_query("UPDATE client_code_archive set `client_code_archive`.`deleted`='1',`assigned_to`='$id'  where `client_code_archive`.`id`='$client_id'",$con) or die(mysql_error());

 $getData = mysql_query("UPDATE `contact` SET `code`='$code' WHERE `id`='$id'",$con) or die(mysql_error());


echo $code;
}





?>