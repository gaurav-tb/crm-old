<?php
include("../include/conFig.php");
$id = $_GET['id'];
mysql_query("UPDATE `contact` SET `delete` = '1',`modifieddate`='$datetime' WHERE `id` = '$id'",$con) or die(mysql_error());
echo '<div title="Click To Close" style="color:green;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;cursor:pointer" onclick="document.getElementById(\'ccav0\').style.display = \'none\'">Number Overwritten</div>';
?>
