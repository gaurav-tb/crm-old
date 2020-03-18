	<table id="" cellpadding="0" cellspacing="0" class="fetch" width="100%">
    <tr>
    <th style="" >Team Member </th>
    <th style="" >Total Target</th>
    <th style="" >Target Achieved</th>
    <th style="" >Target Remained</th> 
    </tr>

	<?php 	
	$i=0;	 
	
	$row=mysql_fetch_array($sql);
	
	$sql_Team=mysql_query("SELECT `mateid` from `teamamtes` WHERE `teamid`='$row[6]'",$con) or die(mysql_error());	

	 if(mysql_num_rows($sql_Team)>0) 
	 {	
     while($row_team=mysql_fetch_array($sql_Team))
	 {
	
/*	 $sql_Data=mysql_query("SELECT `contact`.`converted`,`employee`.`name` 
     FROM  `contact` 
     INNER JOIN  `employee` ON  `employee`.`id` =  `contact`.`ownerid` 
     WHERE  `converted` =  '1'
     AND conversionrequestdate
     BETWEEN  '$UpdateFrom' AND  '$dateTo' AND `ownerid` = '($row_team[0]'",$con) or die(mysql_error());   */
	 
	
	$sql_Data=mysql_query("SELECT COUNT(`converted`),`name`,`profile`,`employee`.`id` FROM `contact`,`employee` WHERE `converted` =  '1' AND conversionrequestdate BETWEEN '$dateFrom' AND '$UpdateTo' AND `ownerid` = '$row_team[0]' AND `employee`.`id`='$row_team[0]'",$con) or die(mysql_error());
  	
	
    while($rowDetail=mysql_fetch_array($sql_Data))
	{
	
	?>
	<tr id="dashRow<?php echo $i;?>" class="d<?php echo $i%2;?>">
	<td onclick="AvpDetails('<?php echo $rowDetail[3] ?>','<?php echo $rowDetail[4] ?>')" class="blueSimpletext"><?php echo $rowDetail[1] ?></td>
	<?php
	if($rowDetail[2]==4) 
	{  
    $team_target='36';
	} 
	else  
	{  
    $team_target='48';
	} ?>
	<td align="center"><?php echo $team_target ?></td>
	<td align="center"><?php echo $rowDetail[0] ?></td>
	<?php  $remains=$team_target-$rowDetail[0] ;
	if($remains < $rowDetail[0])
	{
	$remains='0';	
	}
    ?>
	<td align="center"><?php echo $remains ?></td>
	</tr>
	
	<?php
	}
    $i++;
	} }  ?>
	</table>
	
	