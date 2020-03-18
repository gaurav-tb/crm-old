<?php
include("../include/conFig.php");

$sql="SELECT employee.id, employee.name, profile.name, teamamtes.teamid
FROM employee
INNER JOIN profile ON employee.profile = profile.id
INNER JOIN  `teamamtes` ON  `employee`.`id` =  `teamamtes`.`mateid` 
WHERE profile.id =  '16'
GROUP BY  `teamamtes`.`mateid`";

$getData = mysql_query($sql,$con) or die(mysql_error());

?>

<table style="width:100%;" cellpadding="0" cellspacing="0">
<tr>
<td style="width:50%">
<table id="" cellpadding="0" cellspacing="0" class="fetch" width="100%">
<tr>
<th colspan="5">Top Employee Of The Current Week</th>
</tr>

<tr>
<th style="" >Name  </th>
<th style="" >Profile</th>
<th style="" >Target</th>
<th style="" >Net Brokerage</th>
<th style="" >Booster Revenue</th>
<th style="" >Target Achieved</th>
</tr>
<?php
$i=0;
while($row=mysql_fetch_array($getData))
{
/*$getRevenue=mysql_query("SELECT (SUM(`expensereport`.`RevenueGeneration` ) + SUM(  `expensereport`.`BrokeragePremium` )
) AS BrokerageRevenue, contact.ownerid, SUM(`researchbooster`.`Activationamt` ) AS  `BoosterRevenue` 
FROM expensereport INNER JOIN contact ON expensereport.Clientid = contact.code
INNER JOIN employee ON  `contact`.`ownerid` =  `employee`.`id` 
INNER JOIN `teamamtes` ON  `contact`.`ownerid` =  `teamamtes`.`mateid` 
INNER JOIN `researchbooster` ON `contact`.`id`=`researchbooster`.`cid`
WHERE  `teamamtes`.`teamid` =  '$row[3]' AND (`expensereport`.`UploadingDate` 
BETWEEN  '$initial' AND  '2018-09-30') || (`researchbooster`.`Approved` =  '2' AND  `researchbooster`.`ApprovalDate` 
BETWEEN  '2018-09-24' AND  '2018-09-30') AND  `employee`.`delete` =  '0'",$con) or die(mysql_error());
*/


$getBrokerageRevenue=mysql_query("SELECT (
SUM(  `expensereport`.`RevenueGeneration` ) + SUM(  `expensereport`.`BrokeragePremium` )
) AS BrokerageRevenue, contact.ownerid
FROM expensereport
INNER JOIN contact ON expensereport.Clientid = contact.code
INNER JOIN employee ON  `contact`.`ownerid` =  `employee`.`id` 
INNER JOIN  `teamamtes` ON  `contact`.`ownerid` =  `teamamtes`.`mateid` 
WHERE  `teamamtes`.`teamid` =  '$row[3]'
AND (`expensereport`.`UploadingDate` BETWEEN  '$initial' AND '$final'
) AND  `employee`.`delete` =  '0'",$con) or die(mysql_error());
$rowBrokerageRevenue=mysql_fetch_array($getBrokerageRevenue);



$getBoosterRevenue=mysql_query("SELECT SUM(`researchbooster`.`Activationamt` ) AS  `BoosterRevenue` 
FROM researchbooster
INNER JOIN contact ON researchbooster.cid = contact.id
INNER JOIN employee ON  `contact`.`ownerid` =  `employee`.`id` 
INNER JOIN  `teamamtes` ON  `contact`.`ownerid` =  `teamamtes`.`mateid` 
WHERE  `teamamtes`.`teamid` =  '$row[3]' AND  `researchbooster`.`ApprovalDate` 
BETWEEN  '$initial' AND  '$final' AND  `employee`.`delete` =  '0'",$con) or die(mysql_error());
$rowBoosterRevenue=mysql_fetch_array($getBoosterRevenue);




?>
<tr id="dashRow<?php echo $i;?>" class="d<?php echo $i%2;?>">
<td><?php echo $row[1] ?></td>
<td><?php echo $row[2] ?></td>
<td><?php echo '75,000' ?></td>

<td> <?php echo $rowBrokerageRevenue['BrokerageRevenue'];?></td> 

<td> <?php echo $rowBoosterRevenue['BoosterRevenue']  ;?></td> 

<td> <?php echo $rowBrokerageRevenue['BrokerageRevenue']+$rowBoosterRevenue['BoosterRevenue']; ?></td> 


</tr>
<?php
$i++;
$list .= $row[0].",";

}
?>
</table>

</td>

</tr>
</table>
<div class="moduleFoot" style="display:none">
<input name="Text1" type="text" value="<?php echo $sql;?>" id="tlview" style="display:none" />
<input name="Text1" type="text" value="<?php echo $list;?>" id="idList" style="display:none" />
	<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
	<div onclick="fetchMore('leads/fetchmore');" style="cursor: pointer;padding-top:5px;" id="fetchingDone">
	<img alt="" src="images/more.png" style="vertical-align: middle; width: 6px;" /> 
	More <span id="fetching" style="display: none">Fetching..</span></div>
</div>

<br/><br/><br/><br/><br/>

