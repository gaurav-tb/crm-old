<?php 
include("../include/conFig.php");
include("funnel_chart.php");

$tar_month= mysql_query("SELECT * FROM `contact` WHERE converted = '1' AND `ownerid` =  '$loggeduserid' AND conversiondate BETWEEN '$dateFrom' AND '$UpdateTo'",$con) or die(mysql_error());
$row_month=mysql_num_rows($tar_month);


$tar_week= mysql_query("SELECT * FROM `contact` WHERE converted = '1' AND `ownerid` =  '$loggeduserid' AND conversionrequestdate BETWEEN '2018-03-05' AND '2018-03-11'",$con) or die(mysql_error());
$row_week=mysql_num_rows($tar_week);



if($perm==4 || $perm==1)
{
$target_week=9;

if($row_week >= $target_week)
{
$remained_week=0;	
}
else
{
$remained_week=$target_week-$row_week;	
}

$target_month=36;

if($row_month >=$target_month)
{
$remained_week=0;	
}
else
{
$remained_month=$target_month-$row_month;	
}
}


if($perm==5 || $perm==11)
{
$target_week=12;

if($row_week >=$target_week)
{
$remained_week=0;	
}
else
{
$remained_week=$target_week-$row_week ;	
}
$target_month=48;
if($row_month >= $target_month)
{
$remained_week=0;	
}
else
{
$remained_month=$target_month-$row_month;	
}
}
?>

<script>
setInterval(function()
{
demo();
},10000);


function demo()
{
    var options = {
	animationEnabled: true,
	theme: "light1", //"light1", "light2", "dark1", "dark2"

	   data: [{
		type: "funnel",
		toolTipContent: "<b>{label}</b>: {y} <b>({percentage}%)</b>",
		indexLabel: "{label} ({percentage}%)",
		dataPoints: [
			{ y: <?php echo $rowLeadAll ?>, label: "Total Leads" },
			{ y: <?php echo $rowLeadCalled ?>, label: "Leads called" },
			{ y: <?php echo ($rowLeadInterest+$rowLeadPIInterest) ?>, label: "Interested" },
			{ y: <?php echo $rowLeadClient ?>, label: "Clients" }
		]
	    }] 
		
		
		};
		
calculatePercentage();
$("#chartContainer").CanvasJSChart(options);

function calculatePercentage()
{
var dataPoint = options.data[0].dataPoints;
var total = dataPoint[0].y;
for (var i = 0; i < dataPoint.length; i++) 
{
if (i == 0) 
{
options.data[0].dataPoints[i].percentage = 100;
}
else
{
options.data[0].dataPoints[i].percentage = ((dataPoint[i].y / total) * 100).toFixed(2);
}
}
}

var options = {
	animationEnabled: true,
	theme: "light2", //"light1", "light2", "dark1", "dark2"

	    data: [{
		type: "pie",
		toolTipContent: "<b>{label}</b>: {y} <b>({percentage}%)</b>",
		indexLabel: "{label} ({percentage}%)",
		dataPoints: [
       //{ y:<?php  echo $target_week ?>, label: "Total Target" },
		{ y:<?php  echo $row_week ?>, label: "Target Achieved" },
		{ y: <?php  echo $remained_week ?>, label: "Target Remains" }
		]
	}]
};


calculateWeek();
$("#chartContainerWeek").CanvasJSChart(options);

function calculateWeek()
{
var dataPoint = options.data[0].dataPoints;
var total = <?php echo $target_week  ?>;

for (var i = 0; i < dataPoint.length; i++) 
{
/*if (i == 0) 
{
options.data[0].dataPoints[i].percentage = 100;
}
else
{ */
options.data[0].dataPoints[i].percentage = ((dataPoint[i].y / total) * 100).toFixed(2);
/* } */
}
}


var options = {
	animationEnabled: true,
	theme: "light2", //"light1", "light2", "dark1", "dark2"

	data: [{
	type: "pie",
	toolTipContent: "<b>{label}</b>: {y} <b>({percentage}%)</b>",
	indexLabel: "{label} ({percentage}%)",
	dataPoints: [
//    { y: <?php  echo $target_month?>, label: "Total Target" },
	{ y: <?php echo $row_month ?>, label: "Target Achieved" },
	{ y: <?php echo $remained_month ?>, label: "Target Remains" }		]
	}]
};

calculateMonth();
$("#chartContainerMonth").CanvasJSChart(options);

function calculateMonth()
{
var dataPoint = options.data[0].dataPoints;
var total = <?php echo $target_month ?>;
for (var i = 0; i < dataPoint.length; i++) 
{
options.data[0].dataPoints[i].percentage = ((dataPoint[i].y / total) * 100).toFixed(2);
}
}

}
</script>



<div class="moduleHeading">
<div style="float:right">
</div>
Welcome <?php echo ucwords($loggeduser);?>  
</div>
 
<div id="directResult" style="height:730px;overflow:scroll">

<table style='height:1000px' cellpadding="0" cellspacing="5" width="100%">
<!--    <tr>
	<td colspan="3">
	<div class="buttonBlue" style="text-align: left">URL For Open An Account</div>
	<div style='margin-top:10px;height:22px' class="dashdivLeftBottom"><font color='blue'>https://tradingbells.com/openAnAccount.php?C=<?php //echo base64_encode($loggeduserid) ?></font>
	</div>
	</td>
	</tr> -->

    	<tr>
		<td style="width:33%; height:200px;" valign="top">
		<?php if(in_array('SL_dash',$thisPer))
		{
		?>
		<div class="buttonBlue" style="text-align: left">In The Spotlight</div>
		<?php 
		}?>
		<div class="dashdivLeft" style="overflow-x:hidden;overflow-y:scroll">
		<?php  if(in_array('SL_dash',$thisPer))
		{
		include("spotLight.php");
		} 
		?>
	    </div> 
		
		
        </td>
	    <!-- 	<td style="width:46%" valign="top">
		<?php if(in_array('WA_dash',$thisPer))
		{
		?>
		<div class="buttonBlue" style="text-align: left">This Week's Activity</div>
		<?php
		}
		else if(in_array('ATT_dash',$thisPer))
		{
		?>
 		<div class="buttonBlue" style="text-align: left">Target given vs achieved by Teams</div>
		<?php
		}
		?>
		<div class="dashdivMiddle">
		<?php
		if(in_array('ATT_dash',$thisPer))
		{
		?>
				
		<?php
		
		}
		?>
		
		</div>
		</td> -->
		
		<td style="width:33%;height:200px;" valign="top">
		<?php if(in_array('SL_dash',$thisPer))
		{
		?>
		<div class="buttonBlue" style="text-align: left">Progress This Week</div>
		<?php 
		}?>
	   
	   	<?php  if(in_array('SL_dash',$thisPer))
		{
		?>
        <div id="chartContainerWeek" style="height: 300px; width:100%;">
		</div>
		
		<div name="Button1" type="button" class="buttonDetails" onclick="TargetWeek('<?php echo $loggeduserid ?>')">Week Details</div>

	    <?php 	}   ?>
		</div> 
		</td>
	
		<td style="width:33%" valign="top">
		<div class="buttonBlue" style="text-align: left">Progress This Month</div>
		<div class="dashdivRight">
		<div id="chartContainerMonth" style="height:270px;width:100%;margin-bottom:25px;">
		</div>
	    <div name="Button1" type="button" class="buttonDetails" onclick="TargetMonth('<?php echo $loggeduserid ?>')">Month Details</div>

	
		
		<?php
	//	include('progress.php');
		?>
	
		</div>
		<br/>
	    <!--  <div class="buttonBlue" style="text-align: left">
		Overall Progress This Month
		</div>
		<div  class="dashdivRight">
		<?php
		//include('overallProgress.php');
		?>
    	</div> -->
		</td>
        </tr>
	
	    <tr>
				
		<td style="width: 46%" colspan="2">
		<div class="buttonBlue" style="text-align: left">Top 10 Prospects</div>
		<div class="dashdivLeftBottom">
		<?php
		if(in_array('Top_Prospect',$thisPer))
		{
		include("prospects_10.php");
		}
		?>
		</div>
		</td>
		<td style="width: 33%; height: 200px;" valign="top">
		<?php if(in_array('SL_dash',$thisPer))
		{
		?>
		<div class="buttonBlue" style="text-align: left">Sales Analysis</div>
		<?php 
		}?>
	
		<div id="chartContainer" style="height: 300px; width: 100%;">
		</div>
        </td>

		
		</tr> 
	
	
	    <tr>
		<td colspan="2">
		<div class="buttonBlue" style="text-align: left">Today's Followups</div>
		<div class="dashdivLeftBottom">
		<?php
		if(in_array('VO_leads',$thisPer) || in_array('VA_tLeads',$thisPer) || in_array('VA_leads',$thisPer))
		{
		include("todays-followups.php");
		}
		?>
		</div>
		</td>
	<!--	<td>
			<div class="buttonBlue" style="text-align: left">My Tasks</div>
			<div class="dashdivRightBottom">
			<font color='blue'>https://tradingbells.com/openAnAccount.php?C=<?php //echo base64_encode($loggeduserid) ?></font>
			<?php
	//	include('taskDash.php');
		?></div>
	</td> -->
	
	<td>
	<div class="buttonBlue" style="text-align: left">URL For Open An Account</div>
	<div class="dashdivRightBottom">
	<div style='margin-top:10px;'>
	<font color='blue'>https://tradingbells.com/openAnAccount.php?C=<?php echo base64_encode($loggeduserid) ?></font>
	</div>
	</div>
	</td>
	
	</tr> 
	
	<?php 
	$sql= mysql_query("SELECT * from `team` WHERE `leader`='$loggeduserid' AND `id`!='6'",$con) or die(mysql_error());
    if(mysql_num_rows($sql) > 0) 
	{
	include("Avp_target.php");
	}
	?>
	
	
</table>
</div>
