<head>
<!-- <link href="css/bootswatch.css" rel="stylesheet" type="text/css" />
 -->
 	
 </head>

<?php 
include("../include/conFig.php");

$dateFrom=$date." 00:00:01";
$getCalling= mysql_query("SELECT SUM(`callinghours`.`callingtime`),MAX(uploadingtime) FROM `employee` INNER JOIN `callinghours` ON `employee`.`callingextension` =  `callinghours`.`extension` WHERE `callinghours`.`uploadingtime` BETWEEN '$dateFrom' AND '$datetime' AND `employee`.`id`='$loggeduserid'",$con) or die(mysql_error());
$rowCalling=mysql_fetch_array($getCalling);


$GetRevenueMon= mysql_query("SELECT (`spotlight`.`BrokerageRevenue`+`spotlight`.`BoosterAmount`) as `RevenueAchieved` FROM `spotlight` WHERE '$date' BETWEEN `TargetRangeFrom` AND `TargetRangeTo` AND `spotlight`.`teamRMMateid`='$loggeduserid'",$con) or die(mysql_error());

$rowRevenueMon=mysql_fetch_array($GetRevenueMon);


$GetMonAcc= mysql_query("SELECT COUNT(contact.converted) FROM `contact` WHERE `contact`.`converted`='1' AND `contact`.`ownerid`='$loggeduserid' AND `contact`.`conversionrequestdate` BETWEEN '$initialmon' AND '$finalmon'",$con) or die(mysql_error());

$rowMonAcc=mysql_fetch_array($GetMonAcc);



$GetRevenueWeek= mysql_query("SELECT (`spotlightweek`.`BrokerageRevenue`+`spotlightweek`.`BoosterAmount`) as `RevenueAchieved` FROM `spotlightweek` WHERE '$date' BETWEEN `TargetRangeFrom` AND `TargetRangeTo` AND `spotlightweek`.`teamRMMateid`='$loggeduserid'",$con) or die(mysql_error());

$rowRevenueWeek=mysql_fetch_array($GetRevenueWeek);



$GetWeekAcc= mysql_query("SELECT COUNT(contact.converted) FROM `contact` WHERE `contact`.`converted`='1' AND `contact`.`ownerid`='$loggeduserid' AND `contact`.`conversionrequestdate` BETWEEN '$initial' AND '$datetime'",$con) or die(mysql_error());

$rowWeekAcc=mysql_fetch_array($GetWeekAcc);

if($perm==11 || $perm==16 || $perm==30 || $perm==28 || $perm==19 || $perm==29)
{
if($perm==11 or $perm==29)
{
$targetMon="2,75,000";
$targetWeek1="55,000";		
}
 if($perm==16 or $perm==19)
{
$targetMon="2,25,000";
$targetWeek1="45,000";		
}	
 if($perm==30)
{
$targetMon="2,00,000";
$targetWeek1="40,000";		
}	
 if($perm==28)
{
$targetMon="2,50,000";
$targetWeek1="50,000";		
}	
	
$TgtAchievedMonth=number_format(($rowRevenueMon[0]),0)."<br>";	
$TgtAchievedWeek=number_format(($rowRevenueWeek[0]),0)."<br>";	
	
}

else if($perm==4 || $perm==5)
{
	
if($perm==4 or $perm==24 or $perm==25)	////cas
{
$targetMon=15;
$targetWeek1=3;	
}
if($perm==5 or $perm==26 or $perm==27)    /////cam (available in profile table)
{
$targetMon=20;
$targetWeek1=4;		
}
if($perm==21 or $perm==22 or $perm==23)    /////cat
{
$targetMon=10;
$targetWeek1=2;		
}

/*
if($perm==id from profile table)
{
$targetMon=45;
$targetWeek1=9;		
}

*/
else 
{
$targetMon=10;
$targetWeek1=2;			
}	

$TgtAchievedMonth=number_format(($rowMonAcc[0]),0)."<br>";	
$TgtAchievedWeek=number_format(($rowWeekAcc[0]),0)."<br>";	

}

else 
{
$targetMon=0;
$targetWeek1=0;			
$TgtAchievedMonth=0;
$TgtAchievedWeek=0;
}



?>








<div class="moduleHeading">
<div style="float:right">
</div>
Welcome <?php echo ucwords($loggeduser);?>  

<?php
$hours =floor($rowCalling[0] / 3600);
$mins  =floor($rowCalling[0] / 60 % 60);
$secs  =floor($rowCalling[0] % 60);

if($rowCalling[0]='NULL')
{
?>
<span style="font-size:12px;float:right">
Calling Hours :- <span style="font-size:16px"><b><?php echo sprintf('%02d:%02d:%02d', $hours, $mins, $secs)  ?></b></span> ( <?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($rowCalling[1]));?> )</span>
<?php } ?>
	
</div>




 
<div id="directResult" style="height:730px;overflow:scroll">

 <table style='height:1000px' cellpadding="0" cellspacing="5" width="100%">

	    <?php  if(in_array('in_spotlight',$thisPer))
		{
    	include("spotLight.php");
		} 
		?>

    
	
	<!--     <tr>
		<td valign="top" colspan="3">
		<div class="container dashdivTodaysFollowUps">
		<div class="jumbotron">
		<ul class="list-group" >
          <li class="list-group-item d-flex justify-content-between align-items-center">
             <strong style="font-size:16px"> Today's Followups </strong>
          </li>
 
        </ul>
		</br>
		<?php// if(in_array('todays_followups',$thisPer))
		{ 
    	//include("todays-followups.php");
	    }
		?>
		
       </br>
	   
	    </div>
        </div>
    	</td>  
		</tr> 
	 -->
	
	<td>
	<div class="buttonBlue" style="text-align: left">URL For Open An Account</div>
	<div class="dashdivRightBottom">
	<div style='margin-top:10px;'>
	<font color='blue'>https://tradingbells.com/openAnAccount.php?C=<?php echo base64_encode($loggeduserid) ?></font>
	</div>
	</div>
	</td>
	 
	
	
</table>

<table>
<tr>
	<td colspan="3">
	<div class="buttonBlue" style="text-align: left">URL For Open An Account</div>
	<div class="dashdivRightBottom">
	<div style='margin-top:10px;'>
	<font color='blue'>https://tradingbells.com/openAnAccount.php?C=<?php echo base64_encode($loggeduserid) ?></font>
	</div>
	</div>
	</td>

	<td colspan="3">
<!-- 	<div class="buttonBlue" style="text-align: left">Diwali Offer Link</div>
	<div class="dashdivRightBottom">
	<div style='margin-top:10px;'>
     <font color='blue'>https://www.tradingbells.com/diwali?C=<?php echo base64_encode($loggeduserid) ?></font>
    </div>

	</div>
 -->	
    </td>


</tr>	
</table>

</div> 
 