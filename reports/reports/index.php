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
		<li onclick="getModule('reports/alloted','manipulateContent','viewContent','General Report')">Alloted Leads Reports</li><?php } ?>
</ul>
</td>

<td class="setup" valign="top">
<div id="head">Service Reports</div>
<ul class="setup">
		<?php if(in_array('S_reports',$thisPer)){?> 
		<li onclick="getModule('reports/servicereport','viewContent','manipulateContent','Service Report')">Service Reports</li> <?php }?>
								
		<?php if(in_array('SN_reports',$thisPer)){?> 
		<li onclick="getModule('reports/service-numbers','viewContent','manipulateContent','Service Numbers')">Service Numbers</li><?php }?>

</ul>
</td>
<td class="setup" valign="top">
<div id="head">User Reports</div>
<ul class="setup">
		<?php if(in_array('UP_reports',$thisPer)){?> 
		<li onclick="getModule('reports/user-performance','viewContent','manipulateContent','User Performance')">User Performance</li>
		<li onclick="getModule('reports/performance-hierarchy','viewContent','manipulateContent','Performance Tree')">Performance Tree</li><?php } ?>

		<?php if(in_array('LT_reports',$thisPer)){?> 
		<li onclick="getModule('reports/leadTrack','viewContent','manipulateContent','Lead Tracking Report')">Lead Tracking</li><?php } ?>
		
		<?php if(in_array('Todays_FT',$thisPer)){?> 
		<li onclick="getModule('reports/FTRequests','viewmoodleContent','manipulatemoodleContent','Todays FT Report')">FreeTrial Requests</li><?php } ?>

</ul>
</td>
</tr>
<tr>
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
</td>



</tr>
</table>
</div>
</div>
