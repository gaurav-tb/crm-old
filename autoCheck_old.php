<?php
include("include/conFig.php");
$table = $_GET['table'];
$field = $_GET['field'];
$value = $_GET['value'];

$tab = explode("::",$table);
if(count($tab) > 0)
{
$chkData = mysql_query("SELECT `$field` FROM `$tab[0]` WHERE `$field` = '$value' AND `id` != '$tab[1]' AND `delete` = '0'",$con) or die(mysql_error());
}
else
{
$chkData = mysql_query("SELECT `$field` FROM `$table` WHERE `$field` = '$value' AND `delete` = '0'",$con) or die(mysql_error());
}
if(mysql_num_rows($chkData) > 0)
{
echo "<span style='color:#b82121;font-weight:bold'>Duplicate Entry!!</span>";
}
else
{
echo "<span style='color:green;font-weight:bold'></span>";
}

?>
