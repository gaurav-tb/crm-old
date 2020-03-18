<?php
include("include/conFig.php");
$dx = $_GET['dx'];
$table = $_GET['table'];
$dx = explode(",",$dx);
foreach($dx as $val)
{
mysql_query("UPDATE `$table` SET `delete` = '1' WHERE `id` = '$val'",$con) or die(mysql_error());



    if($table == 'employee')
    {
	mysql_query("UPDATE `spotlight` SET `spotlight`.`delete`='1' WHERE `spotlight`.`teamRMMateid`='$val'",$con) or die(mysql_error());	
	
	mysql_query("UPDATE `spotlightweek` SET `spotlightweek`.`delete`='1' WHERE `spotlightweek`.`teamRMMateid`='$val'",$con) or die(mysql_error());	
	
	$getId=mysql_query("SELECT `id` FROM `contact` WHERE `contact`.`converted`='1' AND `ownerid`='$val'",$con) or die(mysql_error());
	while($rowId=mysql_fetch_array($getId))
	{
	mysql_query("UPDATE `contact` SET `ownerid`='0',`alloted`='0',`description`='' WHERE `ownerid`='$val' AND `contact`.`converted`='0'",$con) or die(mysql_error());	
	
	mysql_query("DELETE FROM `noteline` WHERE `noteline`.`cid`='$rowId[0]'",$con) or die(mysql_error());	
	
	
	
	$getTeamId=mysql_query("SELECT `teamid` FROM `teamamtes` INNER JOIN `team` ON `teamamtes`.`teamid`=`team`.`id` WHERE `teamamtes`.`mateid`='$val' and `team`.`delete`='0'",$con) or die(mysql_error());
    $rowTeamId=mysql_fetch_array($getTeamId);
	
	
	$getMateId=mysql_query("SELECT `mateid` FROM `teamamtes` WHERE `teamid`='$rowTeamId[0]' ORDER BY RAND() LIMIT 1",$con) or die(mysql_error());
    $empid=mysql_fetch_array($getMateId);
	
   
    $getData=mysql_query("SELECT  `id` ,`name` FROM  `employee` WHERE  `employee`.`id` =  '$empid[0]' AND ( `employee`.`status` =  '1' &&  `employee`.`delete` =  '0' &&  (`employee`.`profile` =  '21' ||  `employee`.`profile` =  '22' ||  `employee`.`profile` =  '23' ||  `employee`.`profile` =  '24' ||  `employee`.`profile` =  '4' ||  `employee`.`profile` =  '25' ||  `employee`.`profile` =  '26' ||  `employee`.`profile` =  '5' ||  `employee`.`profile` =  '27')) LIMIT 1",$con) or die(mysql_error());

    if(mysql_num_rows($getData)>0)
	{
	$rowMin=mysql_fetch_array($getData);
	
	$note="Ownership Changed To ".$rowMin[1];
	mysql_query("UPDATE `contact` SET `ownerid`='$rowMin[0]' WHERE `id`='$rowId[0]' AND `contact`.`converted`='1'",$con) or die(mysql_error());
	mysql_query("INSERT INTO `noteline`(`subject`,`note`,`cid`,`id`,`createdate`,`updatedby`,`RandomAssignments`,`delete`) values('Oship','$note','$rowId[0]','','$datetime','$loggeduserid','1','0')",$con)or die(mysql_error()); 
   // mysql_query("UPDATE `customersupport` SET `ownerid`='$rowMin[0]',`RMOwnerid`='1' WHERE `clientid`='$rowId[0]'",$con) or die(mysql_error());
	 mysql_query("UPDATE `customersupport` SET `ownerid`='$rowMin[0]'  WHERE `clientid`='$rowId[0]'",$con) or die(mysql_error());
	
	}
	else
	{

    $getNewMateId=mysql_query("SELECT `mateid` FROM `teamamtes` WHERE `teamid`='$rowTeamId[0]' AND `mateid`!='$empid[0]' ORDER BY RAND() LIMIT 1",$con) or die(mysql_error());
    $empid=mysql_fetch_array($getNewMateId);
	
	$getData=mysql_query("SELECT  `id` ,`name` FROM  `employee` WHERE  `employee`.`id` =  '$empid[0]' AND ( `employee`.`status` =  '1' &&  `employee`.`delete` =  '0' &&  (`employee`.`profile` =  '4' ||  `employee`.`profile` =  '5' ||  `employee`.`profile` =  '11' ||  `employee`.`profile` =  '10')) LIMIT 1",$con) or die(mysql_error());

	$rowMin=mysql_fetch_array($getData);
	
    $note="Ownership Changed To ".$rowMin[1];
	mysql_query("UPDATE `contact` SET `ownerid`='$rowMin[0]' WHERE `id`='$rowId[0]' AND `contact`.`converted`='1'",$con) or die(mysql_error());
	mysql_query("INSERT INTO `noteline`(`subject`,`note`,`cid`,`id`,`createdate`,`updatedby`,`RandomAssignments`,`delete`) values('Oship','$note','$rowId[0]','','$datetime','$loggeduserid','1','0')",$con)or die(mysql_error()); 
    // mysql_query("UPDATE `customersupport` SET `ownerid`='$rowMin[0]',`RMOwnerid`='1' WHERE `clientid`='$rowId[0]'",$con) or die(mysql_error());
	mysql_query("UPDATE `customersupport` SET `ownerid`='$rowMin[0]' WHERE `clientid`='$rowId[0]'",$con) or die(mysql_error());
	}   
	}
	
	mysql_query("UPDATE `employee` SET `status` = '0' WHERE `id` = '$val'",$con) or die(mysql_error());

    mysql_query("DELETE FROM `teamamtes` WHERE `teamamtes`.`mateid`='$val'",$con) or die(mysql_error());

	}
    }
	

?>