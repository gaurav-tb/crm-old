<?php 
include("../../include/conFig.php");

$form_data = $_POST['form_data'];
$team_id = array(0=>21,1=>15,2=>12,3=>29,4=>20);


$i=0;
foreach($form_data as $data)
{
$name = $data['name'];
$value = $data['value'];

$result = mysql_query("UPDATE `crm`.`dashboard_data` set ".$name."=".$value." WHERE `team_id`='".$team_id[$i]."'",$con) or die(mysql_error());



if($i==4)
{
$i=0;	
}
else
{
$i++;
}
}

if($result)
{
echo 1;
}
else
{
echo 0;
}


?>