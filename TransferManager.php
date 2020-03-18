<?php
include("include/conFig.php");

 	
$after1mins = strtotime('+10 minutes');
$after2mins = strtotime('+11 minutes');
$dateafter1mins = date('H:i:s', $after1mins);
$dateafter2mins = date('H:i:s', $after2mins);

$dateFrom=$date." ".$dateafter1mins;
$dateTo=$date." ".$dateafter2mins;


$query = "SELECT * FROM `customersupport` WHERE `ClosingDate` BETWEEN '$dateFrom' AND '$dateTo' AND `allotmentid`='$loggeduserid' order by `ClosingDate`";


$getData = mysql_query($query,$con) or die(mysql_error());

   
    if(mysql_num_rows($getData) > 0)
    {
	while($row = mysql_fetch_array($getData))
	{
	$cid=$row['clientid'];	
	if($row['level']==1)
	{
	$query="SELECT * FROM `supportdetails` WHERE `clientid`='$cid'";
    $getSupport = mysql_query($query,$con) or die(mysql_error());
    $rowSup=mysql_fetch_array($getSupport);

	if($rowSup['DemoVideo']==1 && $rowSup['SoftwareDemo']==1 && $rowSup['FundTransfer']==1 && $rowSup['BackOffice']==1 && $rowSup['ClientFilter']==1 && $rowSup['TelegramTips']==1 && $rowSup['POAStatus1']==1 && $rowSup['SegmentDetails']==1)
	{
	$currentDate = strtotime($datetime);
    $futureDate = $currentDate+(432000);
    $CloseDate= date("Y-m-d H:i:s", $futureDate); 
	
	mysql_query("UPDATE `customersupport` SET `ClosingDate`='$CloseDate',`level`='2' WHERE `clientid`='$row[2]'",$con) or die(    mysql_error()); 	

    $sting .= "Name: ".$row['fname']." ".$row['lname'];
	$sting .= "\r\n";
	$sting .= "UserId: ".$row['tradingbellsid'];
	$sting .= "\r\n";
	$sting .= "Has Been Shifted To Level-2";	
		
	}
	else
	{
	$sqlManager=mysql_query("SELECT  `teamamtes`.`mateid` ,`team`.`leader` FROM  `team` INNER JOIN  `teamamtes` ON  `team`.`leader` =  `teamamtes`.`mateid` 
AND  `team`.`leader`  AND `team`.`id`='6'",$con) or die(mysql_error());

	$rowManager=mysql_fetch_array($sqlManager);	
     
	$managerId=$rowManager[0];
	
	
	$res=mysql_query("UPDATE `customersupport` SET `allotmentid`='$managerId' WHERE `allotmentid`='$allotedid' AND `clientid`='$cid' AND `ClosingDate` BETWEEN '$dateFrom' AND '$dateTo'",$con) or die(mysql_error()); 	
		   
	
	$sting .= "Name: ".$row['fname']." ".$row['lname'];
	$sting .= "\r\n";
	$sting .= "UserId: ".$row['tradingbellsid'];
	$sting .= "\r\n";
	$sting .= "Client Has Been Alloted To Manager";	
	}
	}
	
	
     else if($row['level']==2)
	{	
    $query="SELECT * FROM `supportdetails` WHERE `clientid`='$cid'";	
	$getSupport = mysql_query($query,$con) or die(mysql_error());
    $rowSup=mysql_fetch_array($getSupport);

	if($rowSup['FirstTrade']==1 && $rowSup['SLDemo']==1 && $rowSup['MarginPlusDemo']==1 && $rowSup['POA']==1 && $rowSup['FAO']==1 && $rowSup['IPO']==1)
	{
	$currentDate = strtotime($datetime);
    $futureDate = $currentDate+(432000);
    $CloseDate= date("Y-m-d H:i:s", $futureDate); $currentDate = strtotime($datetime);
		
		
		
	mysql_query("UPDATE `customersupport` SET `ClosingDate`='$CloseDate',`level`='3' WHERE `clientid`='$row[2]'",$con) or die(mysql_error()); 	

    $sting .= "Name: ".$row['fname']." ".$row['lname'];
	$sting .= "\r\n";
	$sting .= "UserId: ".$row['tradingbellsid'];
	$sting .= "\r\n";
	$sting .= "Has Been Shifted To Level-3";	
		
	}
	else
	{
	$sqlManager=mysql_query("SELECT  `teamamtes`.`mateid` ,`team`.`leader` FROM  `team` INNER JOIN  `teamamtes` ON  `team`.`leader` =  `teamamtes`.`mateid` 
AND  `team`.`leader`  AND `team`.`id`='6'",$con) or die(mysql_error());
	$rowManager=mysql_fetch_array($sqlManager);	
     
	$managerId=$rowManager[0];
	
	
	$res=mysql_query("UPDATE `customersupport` SET `allotmentid`='$managerId' WHERE `allotmentid`='$allotedid' AND `clientid`='$cid' AND `ClosingDate` BETWEEN '$dateFrom' AND '$dateTo'",$con) or die(mysql_error()); 	
	 	
	$sting .= "Name: ".$row['fname']." ".$row['lname'];
	$sting .= "\r\n";
	$sting .= "UserId: ".$row['tradingbellsid'];
	$sting .= "\r\n";
	$sting .= "Client Has Been Alloted To Manager";	
	}
	}
	

	else if($row['level']==3)
	{	
    $query="SELECT * FROM `supportdetails` WHERE `clientid`='$cid'";	
	$getSupport = mysql_query($query,$con) or die(mysql_error());
    $rowSup=mysql_fetch_array($getSupport);

	if($rowSup[19]==1 && $rowSup[20]==1 && $rowSup[21]==1 && $rowSup[22]==1)
	{
	$currentDate = strtotime($datetime);
    $futureDate = $currentDate+(1296000);
    $CloseDate= date("Y-m-d H:i:s", $futureDate); $currentDate = strtotime($datetime);
		
		
	mysql_query("UPDATE `customersupport` SET `ClosingDate`='$CloseDate',`level`='4' WHERE `clientid`='$row[2]'",$con) or die(mysql_error()); 	

    $sting .= "Name: ".$row['fname']." ".$row['lname'];
	$sting .= "\r\n";
	$sting .= "UserId: ".$row['tradingbellsid'];
	$sting .= "\r\n";
	$sting .= "Has Been Shifted To Level-N";	
		
	}
	else
	{
	$sqlManager=mysql_query("SELECT  `teamamtes`.`mateid` ,`team`.`leader` FROM  `team` INNER JOIN  `teamamtes` ON  `team`.`leader` =  `teamamtes`.`mateid` 
AND  `team`.`leader`  AND `team`.`id`='6'",$con) or die(mysql_error());
	$rowManager=mysql_fetch_array($sqlManager);	
     
	$managerId=$rowManager[0];
	
	
	$res=mysql_query("UPDATE `customersupport` SET `allotmentid`='$managerId' WHERE `allotmentid`='$allotedid' AND `clientid`='$cid' AND `ClosingDate` BETWEEN '$dateFrom' AND '$dateTo'",$con) or die(mysql_error()); 	
	 	
	$sting .= "Name: ".$row['fname']." ".$row['lname'];
	$sting .= "\r\n";
	$sting .= "UserId: ".$row['tradingbellsid'];
	$sting .= "\r\n";
	$sting .= "Client Has Been Alloted To Manager";	
	}
	
	}

	
	
	
	if($row['level']==4)
	{
    $query="SELECT * FROM `supportdetails` WHERE `clientid`='$cid'";	
	$getSupport = mysql_query($query,$con) or die(mysql_error());
    $rowSup=mysql_fetch_array($getSupport);

	if($rowSup[23]==1 && $rowSup[24]==1 && $rowSup[25]==1 && $rowSup[26]==1 && $rowSup[26]==1 && $rowSup[27]==1)
	{
    $sting .= "Name: ".$row['fname']." ".$row['lname'];
	$sting .= "\r\n";
	$sting .= "UserId: ".$row['tradingbellsid'];
	$sting .= "\r\n";
	$sting .= "Your KPI For Client Has Been Completed";	
		
	}
	else
	{
	$sqlManager=mysql_query("SELECT  `teamamtes`.`mateid` ,`team`.`leader` FROM  `team` INNER JOIN  `teamamtes` ON  `team`.`leader` =  `teamamtes`.`mateid` 
AND  `team`.`leader`  AND `team`.`id`='6'",$con) or die(mysql_error());
	$rowManager=mysql_fetch_array($sqlManager);	
     
	$managerId=$rowManager[0];
	
	
     $res=mysql_query("UPDATE `customersupport` SET `allotmentid`='$managerId' WHERE `allotmentid`='$allotedid' AND `clientid`='$cid' AND `ClosingDate` BETWEEN '$dateFrom' AND '$dateTo'",$con) or die(mysql_error()); 	
		 	
	$sting .= "Name: ".$row['fname']." ".$row['lname'];
	$sting .= "\r\n";
	$sting .= "UserId: ".$row['tradingbellsid'];
	$sting .= "\r\n";
	$sting .= "Client Has Been Alloted To Manager";	
	}
	}
	
	}
	echo $sting;
    }
	else
    {
	echo 'NOTHINGFOUNDHERE';
    }


    mysql_close();
    ?>
