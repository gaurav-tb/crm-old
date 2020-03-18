<?php
include("../include/conFig.php");
$ls = $_GET['leadstatus'];
$cbdate = $_GET['callbackdate'];
if($ls == "")
{
$lsStr = "";
}
else
{
$lsStr = ",`leadstatus` = '$ls' ";
}
if($cbdate == "")
{
$cbStr = "";
}
else
{
$cbStr = ",`callbackdate` = '$cbdate' ";
}
$lsid = $_GET['lsid'];
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);

foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
print_r($post);
$c = count($post);
echo $c;

for($r=0;$r<=$c;$r++)
{
$userid = $post[$r];
$limit = $post[$r+1];
$limit = trim($limit);
	if($limit != '')
	{
		$getData = mysql_query("SELECT `id` FROM `contact` WHERE `alloted` = '0' AND `leadsource` = '$lsid' AND `delete` = '0' AND `ownerid` = '0' ORDER BY `id` DESC LIMIT ".$limit,$con) or die(mysql_error());
		while($row = mysql_fetch_array($getData))
		{
			mysql_query("UPDATE `contact` SET `ownerid` = '$userid',`alloted` = '1',`genby` = '$userid' ".$lsStr."".$cbStr." WHERE `id` = '$row[0]'",$con) or die(mysql_error());
		}
	}

$r++;
}


?>
DONOTSHOW