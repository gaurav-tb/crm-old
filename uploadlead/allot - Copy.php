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
//echo $limit;
	if($limit != '')
	{
		echo "SELECT `id`,`description` FROM `contact` WHERE `alloted` = '0' AND `leadsource` = '$lsid' AND `delete` = '0' AND `ownerid` = '0' ORDER BY `id`";
		$getData = mysql_query("SELECT `id`,`description` FROM `contact` WHERE `alloted` = '0' AND `leadsource` = '$lsid' AND `delete` = '0' AND `ownerid` = '0' ORDER BY `id` DESC LIMIT ".$limit,$con) or die(mysql_error());
		//$getData = mysql_query("SELECT `id`,`description` FROM `contact` WHERE `alloted` = '0' AND `leadsource` = '$lsid' AND `delete` = '0' AND `ownerid` = '542' ORDER BY `id` DESC LIMIT ".$limit,$con) or die(mysql_error());
		while($row = mysql_fetch_array($getData))
		{ 	
			echo "UPDATE `contact` SET `ownerid` = '$userid',`alloted` = '1',`genby` = '$userid',`read` = '0' ".$lsStr."".$cbStr." WHERE `id` = '$row[0]'";
			mysql_query("UPDATE `contact` SET `ownerid` = '$userid',`alloted` = '1',`genby` = '$userid',`read` = '0' ".$lsStr."".$cbStr." WHERE `id` = '$row[0]'",$con) or die(mysql_error());
			if($lsid == '15')
			{
			$addStr = $row[1];
			$note = "Free Trial requested from Website. Free Trial given <strong>".$addStr."</strong>";
			mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('Frequest', '$note', '$row[0]', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());
			}
		}
	}

$r++;
}


?>
DONOTSHOW