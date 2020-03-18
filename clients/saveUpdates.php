
    <?php
    include("../include/conFig.php");
    
    $valto = $_POST['valto'];
    $id = $_GET['id'];
	
	//$note = $_GET['comment'];
	
	
	$valto = explode("*$*$*",$valto);
	foreach($valto as $val)
	{
	$val = str_ireplace("'","\'",$val);
	$post[] .= $val;
	}
	
	$res=mysql_query("SELECT `level` FROM `customersupport` WHERE `clientid`='$id'",$con)or die(mysql_error()); 
	$row=mysql_fetch_array($res);
	
	$LatestID=$post[0];
	
    
	if($row[0]==1)
	{
	
	$res=mysql_query("UPDATE `supportdetails` SET `DemoVideo`='$post[4]',`SoftwareDemo`='$post[5]',`FundTransfer`='$post[6]',`BackOffice`='$post[7]',`ClientFilter`='$post[8]',`TelegramTips`='$post[9]',`POAStatus1`='$post[10]',`SegmentDetails`='$post[11]'
   ,`latestresponse`='$post[0]',`UpdatedBy`='$loggeduserid' WHERE `clientid`= '$id'",$con)or die(mysql_error()); 
   
    }
	
	if($row[0]==2)
	{
	$res=mysql_query("UPDATE `supportdetails` SET `FirstTrade`='$post[4]',`SLDemo`='$post[5]',`MarginPlusDemo`='$post[6]',`POA`='$post[7]',`FAO`='$post[8]',`IPO`='$post[9]',`latestresponse`='$post[0]',`UpdatedBy`='$loggeduserid' WHERE `clientid`= '$id'",$con)or die(mysql_error()); 
    }
	
	
	if($row[0]==3)
	{
	
	$res=mysql_query("UPDATE `supportdetails` SET `SocialMedia`='$post[4]',`ReferralPolicy`='$post[5]',`NCL`='$post[6]',`ClientDoubt`='$post[7]',`POAStatus2`='$post[8]',`latestresponse`='$post[0]',`UpdatedBy`='$loggeduserid' WHERE `clientid`= '$id'",$con)or die(mysql_error()); 
                                                                                                                                                                                                                                                                        
	$note = str_ireplace("'","",$post[6]);
	
	}
	
	
	if($row[0]=4)
	{
	
	$res=mysql_query("UPDATE `supportdetails` SET `HowTrading`='$post[4]',`AnyProblem`='$post[5]',`MF`='$post[6]',`ResearchRecommandation`='$post[7]',`latestresponse`='$post[0]',`UpdatedBy`='$loggeduserid' WHERE `clientid`= '$id'",$con)or die(mysql_error()); 
    
	}
	
	
	$res=mysql_query("UPDATE `customersupport` SET `callbackdate`='$post[1]',`callbacktime`='$post[2]',`description`='$post[3]',`modifieddate`='$date' WHERE `clientid`='$id' ",$con)or die(mysql_error()); 
	
	$note = str_ireplace("'","",$post[3]);
	
	if($note!='')
	{ 
	
	$res=mysql_query("INSERT INTO `noteline`(`subject`,`note`,`cid`,`id`,`createdate`,`updatedby`,`delete`) values('Client Story','$note','$id','','$datetime','$loggeduserid','0')",$con)or die(mysql_error()); 
	
	} 
	
	$ClientID=$id;
	
	if($LatestID==39)
	{
	
	$sqlNPC=mysql_query("SELECT `NpcCount` FROM `supportdetails` WHERE `clientid`='$ClientID' AND `latestresponse`='39'",$con) or die(mysql_error());
    
	$rowNPC=mysql_fetch_array($sqlNPC);	
	
	if($rowNPC[0]== 5)
	{
	 
     $sqlManager=mysql_query("SELECT  `teamamtes`.`mateid` ,`team`.`leader` FROM  `team` INNER JOIN  `teamamtes` ON  `team`.`leader` =  `teamamtes`.`mateid` 
     AND  `team`.`leader`  AND `team`.`id`='6'",$con) or die(mysql_error());

	
	$rowManager=mysql_fetch_array($sqlManager);	
	
	$res=mysql_query("update `customersupport` SET `allotmentid`='$rowManager[0]' where `clientid`='$ClientID'",$con) or die(mysql_error());
	
	$note='Client Has Been Alloted To Manager';
	
	$res=mysql_query("INSERT INTO `noteline`(`subject`,`note`,`cid`,`id`,`createdate`,`updatedby`,`delete`) values('Salloted','$note','$id','','$datetime','1','0')",$con)or die(mysql_error()); 
 
	 
	}

    if($rowNPC[0] == 6)
	{
	$sqlManager=mysql_query("SELECT `leader` FROM `team` WHERE `id`='1'",$con) or die(mysql_error());
	
	$rowManager=mysql_fetch_array($sqlManager);	
		
	$res=mysql_query("update `customersupport` SET `Npcpool`='1' where `clientid`='$ClientID'",$con) or die(mysql_error());
	
	$note='Client Shifted To NPC Pool';
	
	$res=mysql_query("INSERT INTO `noteline`(`subject`,`note`,`cid`,`id`,`createdate`,`updatedby`,`delete`) values('Salloted','$note','$id','','$datetime','1','0')",$con)or die(mysql_error()); 
	
	}
 	
	
	$NpcUpdate=$rowNPC[0]+1;
	
    $res=mysql_query("update `supportdetails` set `latestresponse`='$LatestID',`NpcCount`='$NpcUpdate' where `clientid`='$ClientID'",$con) or die(mysql_error());
	
	}
	
	else if($LatestID!=39)
	{
	
	$res=mysql_query("update `supportdetails` set `latestresponse`='$LatestID' where `clientid`='$ClientID'",$con) or die(mysql_error());
	
	} 
	
    if($res===TRUE) 
	{
    echo '1';
    }
 
   ?>
	
	
	
	
	
	

	
