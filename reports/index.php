<?php
include("../include/conFig.php");
?>
<div class="moduleHeading">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="left" style="width: 30%">Reports & Analysis</td>
</tr>
</table>
</div>

<div id="directResult">
<div style="height:475px;overflow:auto;">
<table width="100%" cellpadding="20" cellspacing="0">
<tr>
<td class="setup" valign="top">
<div id="head"> General Reports</div>
<ul class="setup">					
<?php if(in_array('G_reports',$thisPer)){?>
<li onclick="getModule('reports/new','manipulateContent','viewContent','General Report')">General Reports</li>
<li onclick="getModule('reports/alloted','manipulateContent','viewContent','General Report')">Alloted Leads Reports</li>
<?php } ?>
<?php  if(in_array('RN_reports',$thisPer)){?> 
<li onclick="getModule('reports/rejection','viewContent','manipulateContent','Lead Report')">Rejection Reports</li><?php  }?> 								

<?php  if(in_array('EMM_reports',$thisPer)){?> 
<li onclick="getModule('reports/employeemanager','viewContent','manipulateContent','Lead Report')">Employee Manager Mapping Reports</li> 								
<?php } ?>


<?php   if(in_array('g2m_upload_report',$thisPer)) {   ?> 
<li onclick="getModule('reports/g2mreport','manipulateContent','viewContent','G2M Upload Report')"> G2M Upload Report </li>
<?php } ?>

<?php   if(in_array('g2m_upload_report',$thisPer)) {   ?> 
<li onclick="getModule('reports/ftdtarget','manipulateContent','viewContent','FTD Target Report')"> FTD Target Report </li>
<?php } ?>


</ul>

</ul>
</td>

<td class="setup" valign="top">
<div id="head">Sales Analysis Report</div>
<ul class="setup">					
<?php  if(in_array('SAR_reports',$thisPer)) {   ?> 
<li onclick="getModule('reports/salesreport','manipulateContent','viewContent','Sales Analysis Report')">Sales Analysis Report</li>
<?php } ?>
<?php  if(in_array('SSR_reports',$thisPer))  {   ?> 
<li onclick="getModule('reports/salessummaryreport','manipulateContent','viewContent','Sales Summary Report')">Sales Summary Report</li>

<?php   } ?>
</ul>

</td>


<td class="setup" valign="top">
<div id="head">Referral Report</div>
<ul class="setup">					
<?php if(in_array('INTRODUCER_reports',$thisPer)){?> 
<li onclick="getModule('reports/viewIntroducer','manipulateContent','viewContent','Bill Report')">Introducer Reports</li>
<?php   } ?>

<?php   if(in_array('BCR_reports',$thisPer))	{   ?> 
<li onclick="getModule('reports/brokeragebackofficereport','manipulateContent','viewContent','Referral Calculation Report')">Referral Calculation Report</li>
<?php  } ?>

<!-- <li onclick="getModule('reports/clientdashboardsheet','manipulateContent','viewContent','Dashboard Uploading Sheet')">Dashboard Uploading Sheet</li>  -->

</ul>
</td>


<!-- 
<td class="setup" valign="top">
<div id="head">Service Reports</div>
<ul class="setup">
		<?php if(in_array('S_reports',$thisPer)){?> 
		<li onclick="getModule('reports/servicereport','viewContent','manipulateContent','Service Report')">Service Reports</li> <?php }?>
								
		<?php if(in_array('SN_reports',$thisPer)){?> 
		<li onclick="getModule('reports/service-numbers','viewContent','manipulateContent','Service Numbers')">Service Numbers</li><?php }?>

</ul>
</td> -->

<!-- 
<td class="setup" valign="top">
<div id="head">User Reports</div>
<ul class="setup">
		<?php if(in_array('UP_reports',$thisPer)){?> 
		<li onclick="getModule('reports/user-performance','viewContent','manipulateContent','User Performance')">User Performance</li>
		<?php } ?>

		<?php if(in_array('LT_reports',$thisPer)){?> 
		<li onclick="getModule('reports/leadTrack','viewContent','manipulateContent','Lead Tracking Report')">Lead Tracking</li><?php } ?>
		
		<?php if(in_array('Todays_FT',$thisPer)){?> 
		<li onclick="getModule('reports/FTRequests','viewmoodleContent','manipulatemoodleContent','Todays FT Report')">FreeTrial Requests</li><?php } ?>

</ul>
</td> -->
</tr>
<tr>
<!-- 
<td class="setup" valign="top">
<div id="head"> Accounts Reports</div>
<ul class="setup">					
		<?php if(in_array('B_reports',$thisPer)){?> 
		<li onclick="getModule('reports/viewbillreport','manipulateContent','viewContent','Bill Report')">Bill Reports</li><?php } ?>
</ul>
</td>

<td class="setup" valign="top">
<div id="head">Contact Reports</div>
<ul class="setup">
		<?php if(in_array('LT_reports',$thisPer)){?> 
		<li onclick="getModule('reports/leadTrack','viewContent','manipulateContent','Lead Report')">Lead Reports</li><?php }?> 								
</ul>
</td>   -->


</tr>
<tr>
	<td  class="setup" valign="top">
	<div id="head">Revenue Report</div>
<ul class="setup">
<?php   if(in_array('BAR_reports',$thisPer)) {   ?> 
<!-- <li onclick="getModule('reports/brokeragecalculationreport','manipulateContent','viewContent','Revenue Analysis Report')">Brokerage Analysis Report</li>
 --><?php } ?>



<?php   if(in_array('RBR_reports',$thisPer)) {   ?> 
<li onclick="getModule('reports/researchbooster','manipulateContent','viewContent','Research Booster Report')">Research Booster Report</li>
<!-- <li onclick="getModule('reports/reducedbrokerageutilise','manipulateContent','viewContent','Reduced Brokerage Utilise Report')">Reduced Brokerage Utilise Report</li>
 -->
<?php } ?>

<?php   if(in_array('Reduced_brokerage_reports',$thisPer)) {   ?> 
<li onclick="getModule('reports/reducedbrokerage','manipulateContent','viewContent','Reduced Brokerage Report')">Reduced Brokerage Report</li>
<?php } ?>


<?php   if(in_array('RMSR_reports',$thisPer)) {   ?> 
<!-- <li onclick="getModule('reports/rmsalesreport','manipulateContent','viewContent','RM Sales Report')">RM Sales Summary Report</li>
 --><?php } ?>

<?php  if(in_array('RMSRD_reports',$thisPer)) {   ?> 
<!-- <li onclick="getModule('reports/rmsalesdetailreport','manipulateContent','viewContent','RM Sales Detail Report')">RM Sales Detailed Report</li>
 --><?php  } ?>
</ul>
</td>
<td  class="setup" valign="top">
<div id="head">Quality Report</div>
<ul class="setup">
<?php  if(in_array('AOC_report',$thisPer))  {   ?> 
<li onclick="getModule('reports/aocreport','manipulateContent','viewContent','AOC Report')">AOC Report</li>

<?php   } ?>

<?php   if(in_array('CER_reports',$thisPer)) {   ?> 
<li onclick="getModule('reports/callexceptionalreport','manipulateContent','viewContent','Call Exceptional Report')">Call Exceptional Report</li>
<?php } ?>
<!-- <?php   if(in_array('CER_reports',$thisPer)) {   ?> 
<li onclick="getModule('reports/Newsalesreport','manipulateContent','viewContent','Call Exceptional Report')">New Report</li>
<?php } ?> -->


<?php   if(in_array('PIPO_reports',$thisPer)) {   ?> 
<li onclick="getModule('reports/payinpayout','manipulateContent','viewContent','PayIn PayOut Report')">PayIn PayOut Report</li>
<?php }?>

<?php   if(in_array('RM_mapping_report',$thisPer)) {   ?> 
<li onclick="getModule('reports/newreport','manipulateContent','viewContent','RM Mapping Report')">RM Mapping Report</li>
<?php }?>

</ul>
</td>
</tr>



</table>
</div>
</div>
