<?php 
include("../include/conFig.php");
include("funnel_chart.php");
?>

<script>
window.onload= function () 
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
	/*		{ y: <?php echo $rowLeadKYCfill ?>, label: "Client Filling KYC" },
            { y: <?php echo $rowLeadBO ?>, label: "BO Account Opening Progress" }  */			
		]
	}]
};
calculatePercentage();
$("#chartContainer").CanvasJSChart(options);

function calculatePercentage()
{
	var dataPoint = options.data[0].dataPoints;
	var total = dataPoint[0].y;
	for (var i = 0; i < dataPoint.length; i++) {
		if (i == 0) {
			options.data[0].dataPoints[i].percentage = 100;
		} else {
			options.data[0].dataPoints[i].percentage = ((dataPoint[i].y / total) * 100).toFixed(2);
		}
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
		
		<td style="width:17%; height:200px;" valign="top">
		<?php if(in_array('SL_dash',$thisPer))
		{
		?>
		<div class="buttonBlue" style="text-align: left">Progress This Week</div>
		<?php 
		}?>
	   
	   	<?php  if(in_array('SL_dash',$thisPer))
		{
		//include("spotLight.php");
		}  
		?>

		</div> 
		</td>
	
		
		<td style="width:17%" valign="top">
		<div class="buttonBlue" style="text-align: left">Progress This Month</div>
		<div class="dashdivRight">
		<br/>
		<center>
		
		<?php
	//	include('progress.php');
		?>
	
		</center>	
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
		
		<td style="width: 46%" colspan="2">
		<div class="buttonBlue" style="text-align: left">Top 10 Prospects</div>
		<div class="dashdivLeftBottom">
		<?php
		if(in_array('VO_leads',$thisPer) || in_array('VA_tLeads',$thisPer) || in_array('VA_leads',$thisPer))
		{
		//	include("prospects_10.php");
	
		}
		?>
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
	
</table>
</div>
