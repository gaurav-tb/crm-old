<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$i=$_GET['i'];

$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}

$getEntry = mysql_query("SELECT `id` FROM `cannottalkto` WHERE `userid` = '$post[0]' AND `delete` = '0'",$con) or die(mysql_error());
$rowEntry = mysql_fetch_array($getEntry);
$updateId = $rowEntry[0];
if(mysql_num_rows($getEntry) > 0)
{
	mysql_query("UPDATE `cannottalkto` SET `userid` = '$post[0]', `cannottalkto` = '$post[1]', `desc` = '$post[2]', `modifieddate` = '$datetime', `updatedby` = '$loggeduserid' WHERE `id` = '$updateId'",$con) or die(mysql_error());
}
else
{
	mysql_query("INSERT INTO `cannottalkto` (`userid`, `cannottalkto`, `desc`, `createdate`, `modifieddate`, `updatedby`) VALUES ('$post[0]', '$post[1]', '$post[2]', '$datetime', '$datetime', '$loggeduserid')",$con) or die(mysql_error());
}

$users = explode(',',$post[1]);
$user = str_ireplace('-','',$users);
$replaceInCtt = "-".$post[0]."-,";


	////////////Deleting userid from Cannottalkto 
	$getCtt = mysql_query("SELECT * FROM `cannottalkto` WHERE `cannottalkto` LIKE '%$post[0]%' AND `delete` = '0'",$con) or die(mysql_error());
		while($rowCtt = mysql_fetch_array($getCtt))
		{
		$cid = $rowCtt['id']; 
		$newCtt = str_ireplace($replaceInCtt,"",$rowCtt['cannottalkto']);
		mysql_query("UPDATE `cannottalkto` SET `cannottalkto` = '$newCtt' WHERE `id` = '$cid'",$con) or die(mysql_error());
		}
		
foreach($user as $addto)
{
	if($addto != '')
	{	
	////////////Inserting or Updating cannottalkto for automatic entries 		
	$getFrom = mysql_query("SELECT * FROM `cannottalkto` WHERE `userid` = '$addto' AND `delete` = '0'",$con) or die(mysql_error());
		if(mysql_num_rows($getFrom) > 0)
		{
			while($rowFrom = mysql_fetch_array($getFrom))
			{
			////////////Getting previously saved cannottalkto
			$addCttStr = $rowFrom['cannottalkto'].$replaceInCtt;
			$cannotid = $rowFrom['id'];
			////////////Updating 
			mysql_query("UPDATE `cannottalkto` SET `cannottalkto` = '$addCttStr' WHERE `id` = '$cannotid'",$con) or die(mysql_error());
			}
		}
		else
		{
		////////////Inserting
		mysql_query("INSERT INTO `cannottalkto` (`userid`, `cannottalkto`, `desc`, `createdate`, `modifieddate`, `updatedby`) VALUES ('$addto', '$replaceInCtt', '$post[2]', '$datetime', '$datetime', '$loggeduserid')",$con) or die(mysql_error());
		}	
	
	}
}

mysql_query("DELETE FROM `cannottalkto` WHERE `cannottalkto` = ''",$con) or die(mysql_error());

//$id = mysql_insert_id();

//$getData = mysql_query("SELECT cannottalkto.id,employee.name,cannottalkto.desc,cannottalkto.modifieddate FROM cannottalkto,employee WHERE cannottalkto.userid= employee.id AND cannottalkto.delete = '0' AND cannottalkto.id = '$id' ORDER BY cannottalkto.id DESC",$con) or die(mysql_error());
//$row = mysql_fetch_array($getData);
?>
