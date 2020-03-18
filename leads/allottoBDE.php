<?php
ob_start();
include("../include/conFig.php");
$cid = $_GET['cid'];
$i = $_GET['i'];
$fromprofile = $_GET['fromprofile'];
$fdate = date("Y-m-d")." 00:00:00";
$todate = date("Y-m-d")." 23:59:59";
$date = date("Y-m-d");
$time = time() - (60*60*24);
$yesterday = date("Y-m-d",$time);
$fyesterday = $yesterday." 00:00:00";
$toyesterday = $yesterday." 23:59:59";

$getToProfile =mysql_query("SELECT `to` FROM `allotmentrules` WHERE `from` = '$fromprofile' AND `delete` = '0'",$con) or die(mysql_error());
$rowTo = mysql_fetch_array($getToProfile);

$toPro = $rowTo[0];

$toProf = str_ireplace('-','',$toPro);
$toProf = substr($toProf,0,-1);
$toProf = "0,".$toProf;
$k=0;
$j=0;

$getUser = mysql_query("SELECT `id` FROM `employee` WHERE `profile` IN (".$toProf.") AND `delete` = '0' AND `status` = '1'",$con) or die(mysql_error());
while($rowUser = mysql_fetch_array($getUser))
{
$userArray[] .= $rowUser[0];
}

foreach($userArray as $val)
{
$thisId = $val;
echo "SELECT COUNT(alloted.id) FROM alloted WHERE alloted.to = '$thisId' AND (alloted.createdate BETWEEN '$fyesterday' AND '$toyesterday')";
echo '<br/>';
$getYest = mysql_query("SELECT COUNT(alloted.id) FROM alloted WHERE alloted.to = '$thisId' AND (alloted.createdate BETWEEN '$fyesterday' AND '$toyesterday')",$con) or die(mysql_error());
$rowYest = mysql_fetch_array($getYest);
$arrayYest[$k] = $rowYest[0];
$arrayYestId[$k] = $thisId;
$k++;
}
$orgYest = $arrayYest;
$tempYest = array_unique($orgYest);
if(count($tempYest) > 1)
{
$minYest = min($arrayYest);
$yesId = $arrayYestId[array_search($minYest,$arrayYest)];
$toallotId = $yesId;
$getBDE = mysql_query("SELECT `id`,`name` FROM `employee` WHERE `id` = '$toallotId'",$con) or die(mysql_error());  
$rowBDE = mysql_fetch_array($getBDE);
mysql_query("UPDATE `contact` SET `ownerid` = '$rowBDE[0]',`mark` = '1',`leadstatus` = '-6-',`read` = '0' WHERE `id` = '$cid'",$con) or die(mysql_error());
mysql_query("INSERT INTO `alloted` (`from`,`to`, `createdate`, `id`,`cid`,`truedate`) VALUES ('$loggeduserid','$toallotId', '$fyesterday', '','$cid','$datetime')",$con) or die(mysql_error());
header("location:view.php?message=Lead Sucessfully Alloted!");
}
else
{
$toallotId = 0;
}



if($toallotId == 0)
{
	foreach($userArray as $val)
	{
		$thisId = $val;
		$getCount = mysql_query("SELECT COUNT(alloted.id) FROM alloted WHERE alloted.to = '$thisId' AND (alloted.createdate BETWEEN '$fdate' AND '$todate')",$con) or die(mysql_error());
		$rowCount = mysql_fetch_array($getCount);
		$arrayCount[$j] = $rowCount[0];
		$arrayId[$j] = $thisId;
		$j++;
	}
	$min = min($arrayCount);
	$toallotId = $arrayId[array_search($min,$arrayCount)];

$getBDE = mysql_query("SELECT `id`,`name` FROM `employee` WHERE `id` = '$toallotId'",$con) or die(mysql_error());  
$rowBDE = mysql_fetch_array($getBDE);
mysql_query("UPDATE `contact` SET `ownerid` = '$rowBDE[0]',`mark` = '1',`leadstatus` = '-6-',`read` = '0' WHERE `id` = '$cid'",$con) or die(mysql_error());
mysql_query("INSERT INTO `alloted` (`from`,`to`, `createdate`, `id`,`cid`,`truedate`) VALUES ('$loggeduserid','$toallotId', '$datetime', '','$cid','$datetime')",$con) or die(mysql_error());
header("location:view.php?message=Lead Sucessfully Alloted!");

}
?>