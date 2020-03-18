<?php
include("../include/conFig.php");
?>
<tr>
		<td valign="top">
		</br>
		<div class="container">
		<div class="jumbotron">
		<ul class="list-group" style="margin-top:-38px;">
          <li class="list-group-item d-flex justify-content-between align-items-center">
             <strong style="font-size:14px"> Team Spotlight </strong>
          </li>
 
        </ul>
		
       </br>
	
	 
	  <div style="height:300px;overflow:scroll;">
	    <table class="table table-hover" style="font-size:10px;">
       <thead>
       <tr>
      <th scope="col"></th>
      <th scope="col"></th>
      <th colspan="2" scope="col"> <span class="badge badge-dark" style="font-size:14px">Week</span> </th>
      <th colspan="2" scope="col"><span class="badge badge-dark" style="font-size:14px">Month</span> </th>
       </tr>
	
	 <tr>
      <th scope="col">Rank</th>
      <th scope="col">Name</th>
      <!-- <th scope="col">Accounts</th>
      <th scope="col">Revenue</th>
	  <th scope="col">Accounts</th>
      <th scope="col">Revenue</th> -->
      <th scope="col">Target</th>
      <th scope="col">Achieved</th>
	  <th scope="col">Target</th>
      <th scope="col">Achieved</th>
    </tr>
	
	  

  </thead>
  
  
  <tbody>
    
	<?php
	$i=1;		
	$GetTeamAvp= mysql_query("SELECT SUM(`spotlight`.`Accounts`),(SUM(`spotlight`.`BrokerageRevenue`)+SUM(`spotlight`.`BoosterAmount`)) as `RevenueMonth`,SUM(`spotlightweek`.`Accounts`),(SUM(`spotlightweek`.`BrokerageRevenue`)+SUM(`spotlightweek`.`BoosterAmount`)) as `RevenueWeek`,`employee`.`name` FROM `spotlight` INNER JOIN `spotlightweek` ON `spotlight`.`teamRMMateid`=`spotlightweek`.`teamRMMateid` INNER JOIN  `team` ON `spotlight`.`teamid`=`team`.`id` INNER JOIN `employee` ON `team`.`leader`=`employee`.`id` WHERE `team`.`delete`='0' AND `spotlight`.`delete`='0' AND `team`.`id`!='6' AND `team`.`id`!='19'  AND `team`.`id`!='17' GROUP BY `spotlight`.`teamid` ORDER BY SUM(`spotlight`.`Accounts`) DESC",$con) or die(mysql_error());

    while($rowTeamAvp=mysql_fetch_array($GetTeamAvp))
    {
	?>
    <tr class="table-light">
      <td><?php echo $i; ?></td>
      <td><?php echo $rowTeamAvp[4] ?></td>
      <td>30</td>
      <td><?php echo $rowTeamAvp[2] ?></td>
      <td>150</td>
     <!--  <td><?php echo number_format(($rowTeamAvp[3]),0)."<br>";?></td> -->
      <td><?php echo $rowTeamAvp[0] ?></td>
<!-- 	  <td><?php echo number_format(($rowTeamAvp[1]),0)."<br>";?></td> -->
    </tr>
	
	<?php 
	$i++;
	} 
	?>
 </tbody>
 
 
 </table>     
	
       
  
        </div>
      


		</td>
		
		<td valign="top" >
		</br>
		
		<div class="jumbotron">
       <ul class="list-group" style="margin-top:-38px;">
          <li class="list-group-item d-flex justify-content-between align-items-center">
		  <strong style="font-size:14px"> Acquisition Stream (No. of Accounts) </strong>
          </li>
 
        </ul>
		</br>
	   
	     <div style="height:300px;overflow:scroll">
	   
	    <table class="table table-hover" style="font-size:10px">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col"></th>
     <th colspan="2" scope="col"> <span class="badge badge-dark" style="font-size:14px">Week</span> </th>
      <th colspan="2" scope="col"><span class="badge badge-dark" style="font-size:14px">Month</span> </th>
    </tr>
	
	 <tr>
      <th scope="col">Rank</th>
      <th scope="col">Name</th>
      <th scope="col">Target </th>
      <th scope="col">Achieved </th>
	  <th scope="col">Target </th>
      <th scope="col">Achieved </th>
    </tr>
  </thead>
  <tbody>
    <?php
	$i=1;		
	$GetSpotlightCas= mysql_query("SELECT `spotlightweek`.`Accounts` AS `weekAccount`,`spotlight`.`Accounts` AS `monthAccount`,`employee`.`name`,`employee`.`profile` FROM `spotlightweek` INNER JOIN `spotlight` ON `spotlightweek`.`teamRMMateid`=`spotlight`.`teamRMMateid` INNER JOIN `employee` ON `spotlight`.`teamRMMateid`=`employee`.`id` WHERE `spotlight`.`delete`='0' AND (`employee`.`profile`='4' || `employee`.`profile`='5' || `employee`.`profile`='21' || `employee`.`profile`='22' || `employee`.`profile`='23' || `employee`.`profile`='24' || `employee`.`profile`='25' || `employee`.`profile`='26' || `employee`.`profile`='27') ORDER BY `spotlight`.`Accounts` DESC  LIMIT 0,5",$con) or die(mysql_error());

	
    while($rowSpotlightCas=mysql_fetch_array($GetSpotlightCas))
    {
	
    if($rowSpotlightCas[3]==4 or $rowSpotlightCas[3]==24 or $rowSpotlightCas[3]==25)  //profile table id
	{
	$targetWeek="3";
	$targetMonth="15";
	}	
    else if ($rowSpotlightCas[3]==5 or $rowSpotlightCas[3]==26 or $rowSpotlightCas[3]==27)
    {
	$targetWeek="4";
	$targetMonth="20";
	}
    else if ($rowSpotlightCas[3]==21 or $rowSpotlightCas[3]==22 or $rowSpotlightCas[3]==23)
    {
	$targetWeek="2";
	$targetMonth="10";
	}
    else 
    {
	$targetWeek="2";
	$targetMonth="10";
	}	
		
	
	?>
    <tr class="table-light">
      <td><?php echo $i; ?></td>
      <td><?php echo $rowSpotlightCas[2] ?></td>
      <td><?php echo $targetWeek ?></td>
      <td><?php echo $rowSpotlightCas[0] ?></td>
      <td><?php echo $targetMonth ?></td>
	  <td><?php echo $rowSpotlightCas[1] ?></td>
    </tr>
	
	<?php 
	$i++;
	} 
	?>
	
	
   
  </tbody>
</table>   
</div>  
  
        </div>
        
        </td>
		
		
		<td valign="top">
		</br>
		<div class="container">
		<div class="jumbotron">
       <ul class="list-group" style="margin-top:-38px;">
          <li class="list-group-item d-flex justify-content-between align-items-center">
           <strong style="font-size:14px"> Brokerage Revenue (Amount in Rs.) </strong>
          </li>
 
        </ul>
		
       </br>
	   
	  <div style="height:300px;overflow:scroll">
	  <table class="table table-hover" style="font-size:10px">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col"></th>
      <th colspan="2" scope="col"> <span class="badge badge-dark" style="font-size:14px">Week</span> </th>
      <th colspan="2" scope="col"><span class="badge badge-dark" style="font-size:14px">Month</span> </th>
	</tr>
	
	 <tr>
      <th scope="col">Rank</th>
      <th scope="col">Name</th>
      <th scope="col">Target </th>
      <th scope="col">Revenue </th>
	  <th scope="col">Target </th>
      <th scope="col">Revenue </th>
    </tr>
  </thead>
  <tbody>
    
    
    <?php
	$i=1;		
	$GetSpotlightRm=mysql_query("SELECT `spotlightweek`.`BrokerageRevenue` AS `BrokerageRevenueweek`,`spotlight`.`BrokerageRevenue` AS `BrokerageRevenueMonth`,`employee`.`name`,`employee`.`profile` FROM `spotlightweek` INNER JOIN `spotlight` ON `spotlightweek`.`teamRMMateid`=`spotlight`.`teamRMMateid` INNER JOIN `employee` ON `spotlight`.`teamRMMateid`=`employee`.`id` WHERE `spotlight`.`delete`='0' AND (`employee`.`profile`='11' || `employee`.`profile`='16' || `employee`.`profile`='30' || `employee`.`profile`='28' || `employee`.`profile`='19' || `employee`.`profile`='29') ORDER BY `spotlight`.`BrokerageRevenue` DESC  LIMIT 0,5",$con) or die(mysql_error());

    while($rowSpotlightRm=mysql_fetch_array($GetSpotlightRm))
    {
	
    if($rowSpotlightRm[3]==11 or $rowSpotlightRm[3]==29) // rm /srm profile id
	{
	$targetWeek="55,000";
	$targetMonth="2,75,000";
	}	
    else if ($rowSpotlightRm[3]==16 or $rowSpotlightRm[3]==19)
    {
	$targetWeek="45,000";
	$targetMonth="2,25,000";
	}
    else if ($rowSpotlightRm[3]==30)
    {
	$targetWeek="40,000";
	$targetMonth="2,00,000";
	}
    else if ($rowSpotlightRm[3]==28)
    {
	$targetWeek="50,000";
	$targetMonth="2,50,000";
	}
    
		
	
	?>
    <tr class="table-light">
    <td><?php echo $i; ?></td>
    <td><?php echo $rowSpotlightRm[2] ?></td>
    <td><?php echo $targetWeek ?></td>
    <td><?php echo number_format(($rowSpotlightRm[0]),0)."<br>";?></td>
    <td><?php echo $targetMonth ?></td>
	<td><?php echo number_format(($rowSpotlightRm[1]),0)."<br>";?></td>
    </tr>
	
	<?php 
	$i++;
	} 
	?>
	
	
   
   
  </tbody>
  </table>     
  </div>

  
        </div>
        </div>
		</td>
		</tr>
		<tr>
		
		<td valign="top" colspan="2">
		
		<table width="100%">
		<td width="50%">
		<div class="container">
		<div class="jumbotron">
		<ul class="list-group">
          <li class="list-group-item d-flex justify-content-between align-items-center">
             <strong style="font-size:16px">Progress This Month </strong>
		  </li>
		  </ul>
		</br>
	   
	  <ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Target &nbsp;&nbsp;&nbsp;
    <span class="badge badge-primary badge-pill" style="font-size:16px"><?php echo $targetMon ?></span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Achieved  &nbsp;&nbsp;&nbsp;
    <span class="badge badge-primary badge-pill" style="font-size:16px"><?php echo $TgtAchievedMonth ?></span>
  </li>

</ul>
			 
        
       </br>
	   
	 
  
        </div>
        </div>
		</td>
		<td width="50%">
		<div class="container">
		<div class="jumbotron">
		<ul class="list-group">
          <li class="list-group-item d-flex justify-content-between align-items-center">
             <strong style="font-size:16px">Progress This Week </strong>
		  </li>
		  </ul>
		</br>
	   
	  <ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Target &nbsp;&nbsp;&nbsp;
    <span class="badge badge-primary badge-pill" style="font-size:16px"><?php echo $targetWeek1 ?></span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Achieved  &nbsp;&nbsp;&nbsp;
    <span class="badge badge-primary badge-pill" style="font-size:16px"><?php echo $TgtAchievedWeek ?></span>
  </li>

</ul>
			 
        
       </br>
	   
	 
  
        </div>
        </div>
		</td>
		
		
		</table>
		
		
		
		
	
		<div class="container">
		<div class="jumbotron" style="padding:1.3rem 1rem;">
 <ul class="list-group">	
 
  <li class="list-group-item d-flex justify-content-between align-items-center">
       <a id="PaymentTextCopy" Onclick="window.open('https://tradingbells.com/openAnAccount.php?C=<?php echo base64_encode($loggeduserid) ?>')" ><strong><span style="color:#D9230F">https://tradingbells.com/openAnAccount.php?C=<?php echo base64_encode($loggeduserid) ?></span></strong></a> &nbsp;&nbsp;&nbsp;
  <button type="button" id="CopyOn" onclick="copyToClipboard('#PaymentTextCopy')"  class="btn btn-info btn-sm"> Copy To Clipboard</button> 
 </li>
 </ul>       
       </br>
	   
	   </div>
        </div>
		</td> 
	
		
		<td valign="top">
		
		<div class="container">
		<div class="jumbotron">
       <ul class="list-group" style="margin-top:-38px;">
          <li class="list-group-item d-flex justify-content-between align-items-center">
           <strong style="font-size:14px">Booster Revenue (Amount in Rs.) </strong>
          </li>
 
        </ul>
		
       </br>
	   
	  <div style="height:300px;overflow:scroll">
	  <table class="table table-hover" style="font-size:10px">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col"></th>
      <th colspan="2" scope="col"> <span class="badge badge-dark" style="font-size:14px">Week</span> </th>
      <th colspan="2" scope="col"><span class="badge badge-dark" style="font-size:14px">Month</span> </th>
	</tr>
	
	 <tr>
      <th scope="col">Rank</th>
      <th scope="col">Name</th>
      <th scope="col">Target </th>
      <th scope="col">Revenue </th>
	  <th scope="col">Target </th>
      <th scope="col">Revenue </th>
    </tr>
  </thead>
  <tbody>
    
    
    <?php
	$i=1;		
	$GetSpotlightBooster=mysql_query("SELECT `spotlightweek`.`BoosterAmount` AS `BoosterAmountweek`,`spotlight`.`BoosterAmount` AS `BoosterAmountMonth`,`employee`.`name`,`employee`.`profile` FROM `spotlightweek` INNER JOIN `spotlight` ON `spotlightweek`.`teamRMMateid`=`spotlight`.`teamRMMateid` INNER JOIN `employee` ON `spotlight`.`teamRMMateid`=`employee`.`id` WHERE `spotlight`.`delete`='0' AND (`employee`.`profile`='11' || `employee`.`profile`='16' || `employee`.`profile`='30' || `employee`.`profile`='28' || `employee`.`profile`='19' || `employee`.`profile`='29') ORDER BY `spotlight`.`BoosterAmount` DESC  LIMIT 0,5",$con) or die(mysql_error());

    while($rowSpotlightBooster=mysql_fetch_array($GetSpotlightBooster))
    {
	
    if($rowSpotlightBooster[3]==19 or $rowSpotlightBooster[3]==16)
	{
	$targetWeek="10,000";
	$targetMonth="50,000";
	}	
    else if ($rowSpotlightBooster[3]==11 or $rowSpotlightBooster[3]==29)
    {
	$targetWeek="20,000";
	$targetMonth="1,00,000";
	}
    else if ($rowSpotlightBooster[3]==30)
    {
	$targetWeek="5,000";
	$targetMonth="25,000";
	}
    else if ($rowSpotlightBooster[3]==28)
    {
	$targetWeek="15,000";
	$targetMonth="75,000";
	}
    
		
	
	?>
    <tr class="table-light">
    <td><?php echo $i; ?></td>
    <td><?php echo $rowSpotlightBooster[2] ?></td>
    <td><?php echo $targetWeek ?></td>
    <td><?php echo number_format(($rowSpotlightBooster[0]),0)."<br>";?></td>
    <td><?php echo $targetMonth ?></td>
	<td><?php echo number_format(($rowSpotlightBooster[1]),0)."<br>";?></td>
    </tr>
	
	<?php 
	$i++;
	} 
	?>
	
	
   
   
  </tbody>
  </table>     
  </div>

  
        </div>
        </div>
		</td>
	</tr>
		
	
	