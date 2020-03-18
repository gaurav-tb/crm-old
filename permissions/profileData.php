<?php
include("../include/conFig.php");
$profile = $_GET['profile'];
if($profile != '')
{
$getData = mysql_query("SELECT `permission` FROM `profile` WHERE `id` = '$profile'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData); 
$permissions = $row[0];
$permissions = explode(",",$permissions); 
?>			
			
			
			<table cellpadding="5" cellspacing="0" class="fetch" width="100%">
			<tr>
							<td align="right" rowspan="7" valign="top"><strong> <input name="Checkbox1" type="checkbox"  id="leadAc" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','leadAc','16','1','')" />Leads</strong></td>

				<td>
				<input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;display:none" id="lds0" value="null" checked="checked" />
				<input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds101" value="A_leads" <?php if(in_array("A_leads",$permissions)) echo "checked='checked'";?> /> Add Lead</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds1" value="VO_leads" <?php if(in_array("VO_leads",$permissions)) echo "checked='checked'";?> />View Own Leads</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds2" value="VA_leads" <?php if(in_array("VA_leads",$permissions)) echo "checked='checked'";?> />View All Leads</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds3" value="U_leads" <?php if(in_array("U_leads",$permissions)) echo "checked='checked'";?> onchange="chkModule('lds','lds3','16','4','dis')"/>Update Leads</td>
			</tr>
			<tr>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds4" value="CO_leads" <?php if(in_array("CO_leads",$permissions)) echo "checked='checked'";?> />Change Owner</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds5" value="D_leads" <?php if(in_array("D_leads",$permissions)) echo "checked='checked'";?> />Delete Leads</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds6" value="CV_leads" <?php if(in_array("CV_leads",$permissions)) echo "checked='checked'";?> />Custom View</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds7" value="H_C_leads" <?php if(in_array("H_C_leads",$permissions)) echo "checked='checked'";?> />Hot & Cold Lead</td>
			</tr>
			<tr>
				<!-- <td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds8" value="FT_RN_leads" <?php if(in_array("FT_RN_leads",$permissions)) echo "checked='checked'";?> />Request New Free Trial</td> 
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds9" value="FT_VP_leads" <?php if(in_array("FT_VP_leads",$permissions)) echo "checked='checked'";?> />View Previous Free Trial</td> -->
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds10" value="M_C_leads" <?php if(in_array("M_C_leads",$permissions)) echo "checked='checked'";?> />Compose Message</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds11" value="M_SI_leads" <?php if(in_array("M_SI_leads",$permissions)) echo "checked='checked'";?> />View Sent Items</td>
			</tr>
			<tr>
			<!-- 	<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds12" value="A_NT_leads" <?php // if(in_array("A_NT_leads",$permissions)) echo "checked='checked'";?> />Add Task</td>  -->
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds13" value="A_AS_leads" <?php if(in_array("A_AS_leads",$permissions)) echo "checked='checked'";?> />Add Story</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds205" value="AD_FTD" <?php if(in_array("AD_FTD",$permissions)) echo "checked='checked'";?> />Add FTD</td>
			<!-- 	<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds14" value="A_VOS_leads" <?php // if(in_array("A_VOS_leads",$permissions)) echo "checked='checked'";?> />View Own Stories</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds15" value="A_VAS_leads" <?php // if(in_array("A_VAS_leads",$permissions)) echo "checked='checked'";?> />View All Stories</td>  -->

				</tr>
 			<tr>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds16" value="CTC_leads" <?php if(in_array("CTC_leads",$permissions)) echo "checked='checked'";?> />Convert To Client</td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds92" value="VA_tLeads" <?php if(in_array("VA_tLeads",$permissions)) echo "checked='checked'";?> />View Team Leads</td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds103" value="UTL_leads" <?php if(in_array("UTL_leads",$permissions)) echo "checked='checked'";?> />Update Team Leads</td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds104" value="CO_team" <?php if(in_array("CO_team",$permissions)) echo "checked='checked'";?> />Change Owner For Team Leads</td>
			</tr>
			
			<tr>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds105" value="UAL_leads" <?php if(in_array("UAL_leads",$permissions)) echo "checked='checked'";?> />Update All Leads</td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds130" value="ME_leads" <?php if(in_array("ME_leads",$permissions)) echo "checked='checked'";?> />Mass Edit Leads</td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds135" value="MNU_leads" <?php if(in_array("MNU_leads",$permissions)) echo "checked='checked'";?> />Mobile No Update</td>
			</tr>	
			
			<tr>
		<!-- 	<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds143" value="FT_leads" <?php // if(in_array("FT_leads",$permissions)) echo "checked='checked'";?> /><strong>Freetrial Leads</strong></td>  -->
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds144" value="TR_leads" <?php if(in_array("TR_leads",$permissions)) echo "checked='checked'";?> /><strong>Todays Followup</strong></td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds145" value="INT_leads" <?php if(in_array("INT_leads",$permissions)) echo "checked='checked'";?> /><strong>Intersted Leads</strong></td>
			</tr>	

			
			<tr>
			<td align="right" rowspan="6" valign="top"><strong> <input name="Checkbox1" type="checkbox"  id="contactAc" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','contactAc','34','17','')" />Clients</strong></td>
            <td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds17" value="VO_clients" <?php if(in_array("VO_clients",$permissions)) echo "checked='checked'";?> />View Own Clients</td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds18" value="VA_clients" <?php if(in_array("VA_clients",$permissions)) echo "checked='checked'";?>/> View All Clients </td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds19" value="CO_clients" <?php if(in_array("CO_clients",$permissions)) echo "checked='checked'";?> />Change Owner</td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds20" value="D_clients" <?php if(in_array("D_clients",$permissions)) echo "checked='checked'";?> />Delete Clients</td>
			</tr>
			
			<tr>
			<td></td>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds175" value="VS_clients" <?php if(in_array("VS_clients",$permissions)) echo "checked='checked'";?> />View Sales Clients</td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds179" value="VACT_clients" <?php if(in_array("VACT_clients",$permissions)) echo "checked='checked'";?>/> View Inactive Clients </td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds180" value="VALLACT_clients" <?php if(in_array("VALLACT_clients",$permissions)) echo "checked='checked'";?>/> View All Inactive Clients </td>
			</tr>
			
			<tr>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds195" value="RMClient_allot" <?php if(in_array("RMClient_allot",$permissions)) echo "checked='checked'";?> />RM Client Allotment </td>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds187" value="VARM_clients" <?php if(in_array("VARM_clients",$permissions)) echo "checked='checked'";?> />View All RM Clients</td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds188" value="VRM_clients" <?php if(in_array("VRM_clients",$permissions)) echo "checked='checked'";?>/> View RM Clients </td>
			</tr>
			
			
			
			
			<tr>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds171" value="COS_clients" <?php if(in_array("COS_clients",$permissions)) echo "checked='checked'";?> />Change Support Owner</td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds183" value="CRMO_clients" <?php if(in_array("CRMO_clients",$permissions)) echo "checked='checked'";?> />Change Relation Manager </td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds184" value="RBI_clients" <?php if(in_array("RBI_clients",$permissions)) echo "checked='checked'";?> />Activate individual Research Booster</td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds185" value="RBA_clients" <?php if(in_array("RBA_clients",$permissions)) echo "checked='checked'";?> />Activate all Research Booster</td>
		    </tr>
			
			
			<tr>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds21" value="CV_clients" <?php if(in_array("CV_clients",$permissions)) echo "checked='checked'";?> />Custom View</td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds22" value="U_clients" <?php if(in_array("U_clients",$permissions)) echo "checked='checked'";?>  onchange="chkModule('lds','lds22','34','23','dis')"  />Update Client</td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds23" value="FT_RN_clients" <?php if(in_array("FT_RN_clients",$permissions)) echo "checked='checked'";?> />Request New Free Trial</td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds24" value="FT_VP_clients" <?php if(in_array("FT_VP_clients",$permissions)) echo "checked='checked'";?> />View Previous Free Trial</td>
			</tr>
			<tr>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds25" value="M_C_clients" <?php if(in_array("M_C_clients",$permissions)) echo "checked='checked'";?> />Compose Message</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds26" value="M_SI_clients" <?php if(in_array("M_SI_clients",$permissions)) echo "checked='checked'";?> />View Sent Items</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds27" value="A_NT_clients" <?php if(in_array("A_NT_clients",$permissions)) echo "checked='checked'";?> />Add Task</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds28" value="A_AS_clients" <?php if(in_array("A_AS_clients",$permissions)) echo "checked='checked'";?> />Add Story</td>
			</tr>
			<!-- <tr>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds29" value="B_SD_clients" <?php // if(in_array("B_SD_clients",$permissions)) echo "checked='checked'";?> />Subscription Details</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds30" value="B_BI_clients" <?php // if(in_array("B_BI_clients",$permissions)) echo "checked='checked'";?> onchange="chkModule('lds','lds30','32','31','dis')"  />Billing Information</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds31" value="B_ANB_clients" <?php // if(in_array("B_ANB_clients",$permissions)) echo "checked='checked'";?> />Add New Bill</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds32" value="B_SIC_clients" <?php // if(in_array("B_SIC_clients",$permissions)) echo "checked='checked'";?> />Send Invoice</td>
			</tr>  -->
			<tr>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds33" value="B_SI_clients" <?php if(in_array("B_SI_clients",$permissions)) echo "checked='checked'";?> />View Sent Invoices</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds34" value="MD_clients" <?php if(in_array("MD_clients",$permissions)) echo "checked='checked'";?> />Messenger Details</td>
				<td style="display:none"><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds85" value="CRD_clients" <?php if(in_array("CRD_clients",$permissions)) echo "checked='checked'";?> />Customer Relationship Division</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds93" value="CA_tclients" <?php if(in_array("CA_tclients",$permissions)) echo "checked='checked'";?> />View Team Clients</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds103" value="UTC_clients" <?php if(in_array("UTC_clients",$permissions)) echo "checked='checked'";?> />Update Team Clients</td>
			
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds214" value="show_email" <?php if(in_array("show_email",$permissions)) echo "checked='checked'";?> />Display Email Address</td>
										
			</tr>
			<tr>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds106" value="CO_cteam" <?php if(in_array("CO_cteam",$permissions)) echo "checked='checked'";?> />Change Owner For Team Clients</td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds100" value="UAC_clients" <?php if(in_array("UAC_clients",$permissions)) echo "checked='checked'";?> />Update All Clients</td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds131" value="ME_clients" <?php if(in_array("ME_clients",$permissions)) echo "checked='checked'";?> />Mass Edit Clients</td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds136" value="MNU_clients" <?php if(in_array("MNU_clients",$permissions)) echo "checked='checked'";?> />Mobile No Update</td>
		
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds213" value="show_mobile" <?php if(in_array("show_mobile",$permissions)) echo "checked='checked'";?> />Display Mobile Numbers</td>
		
			</tr>
			<tr>
				<td align="right" rowspan="1" valign="top"><strong> <input name="Checkbox1" type="checkbox"  id="reportAc" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','reportAc','37','35','')" />Reports</strong></td>
                <td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds35" value="G_reports" <?php if(in_array("G_reports",$permissions)) echo "checked='checked'";?> />General Report</td>
				<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds157" value="RN_reports" <?php if(in_array("RN_reports",$permissions)) echo "checked='checked'";?> />Rejection Report</td>

                <td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds207" value="Reduced_brokerage_reports" <?php if(in_array("Reduced_brokerage_reports",$permissions)) echo "checked='checked'";?> />Reduced Brokerage Report</td>


                <td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds208" value="g2m_upload_report" <?php if(in_array("g2m_upload_report",$permissions)) echo "checked='checked'";?> />G2M Upload Report</td>



				
          
			<!--	<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds36" value="S_reports" <?php // if(in_array("S_reports",$permissions)) echo "checked='checked'";?> />Service Report</td>
				<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds37" value="UP_reports" <?php // if(in_array("UP_reports",$permissions)) echo "checked='checked'";?> />User Performance Report</td>	
				<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds83" value="B_reports" <?php  //if(in_array("B_reports",$permissions)) echo "checked='checked'";?> />Bill Report</td> -->
	         		
			</tr>
           		
			<tr>
			<td></td>
			<!-- 	<td ><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds84" value="SN_reports" <?php if(in_array("SN_reports",$permissions)) echo "checked='checked'";?> />Service No.</td>			
				<td ><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds86" value="LT_reports" <?php if(in_array("LT_reports",$permissions)) echo "checked='checked'";?> />Lead Report</td>			
				<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds146" value="Todays_FT"  <?php if(in_array("Todays_FT",$permissions)) echo "checked='checked'";?> />FreeTrial Requests</td>  -->
			  </tr>
			 <tr>
			<td></td>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds164" value="SAR_reports" <?php if(in_array("SAR_reports",$permissions)) echo "checked='checked'";?> />Sales Analysis Report</td>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds165" value="SSR_reports" <?php if(in_array("SSR_reports",$permissions)) echo "checked='checked'";?> />Sales Summary Report</td>
	        <td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds172" value="BAR_reports" <?php if(in_array("BAR_reports",$permissions)) echo "checked='checked'";?> />Brokerage Analysis Report</td>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds173" value="BCR_reports" <?php if(in_array("BCR_reports",$permissions)) echo "checked='checked'";?> />Referral Calculation Report</td>
			</tr>

			
			<tr>
			<td></td>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds174" value="RBR_reports" <?php if(in_array("RBR_reports",$permissions)) echo "checked='checked'";?> />Research Booster Report</td>
		    <td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds177" value="CER_reports" <?php if(in_array("CER_reports",$permissions)) echo "checked='checked'";?> />Call Exceptional Report</td>
            <td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds186" value="RMSR_reports" <?php if(in_array("RMSR_reports",$permissions)) echo "checked='checked'";?> />RM Sales Summary report</td>
	       	<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds189" value="RMSRD_reports" <?php if(in_array("RMSRD_reports",$permissions)) echo "checked='checked'";?> />RM Sales Detail report</td>
			</tr>
			
			<tr>
			<td></td>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds210" value="PIPO_reports" <?php if(in_array("PIPO_reports",$permissions)) echo "checked='checked'";?> />PayIn PayOut Report</td>
		    <td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds212" value="INTRODUCER_reports" <?php if(in_array("INTRODUCER_reports",$permissions)) echo "checked='checked'";?> />Introducer Report</td>
			</tr>
			


			<tr>
			<td align="right" valign="top"><strong> <input name="Checkbox1" type="checkbox" style="display:none"  id="masterAc" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','masterAc','69','38','')" />Masters</strong></td>

				</tr>
				
				
		<!-- 	<tr>
							<td align="right" valign="top"><strong> <input name="Checkbox1" type="checkbox"  id="countryAc" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','countryAc','41','38','')" />Country</strong></td>

				<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds38" value="A_country" <?php // if(in_array("A_country",$permissions)) echo "checked='checked'";?> />Add</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds39" value="V_country" <?php // if(in_array("V_country",$permissions)) echo "checked='checked'";?> /> View</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds40" value="U_country" <?php // if(in_array("U_country",$permissions)) echo "checked='checked'";?> />Update</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds41" value="D_country" <?php // if(in_array("D_country",$permissions)) echo "checked='checked'";?> />Delete</td>
			</tr>  -->
			<tr>
							<td align="right" valign="top"><strong> <input name="Checkbox1" type="checkbox"  id="contactStatus" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','contactStatus','45','42','')" />Contact Status</strong></td>

				<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds42" value="A_contact" <?php if(in_array("A_contact",$permissions)) echo "checked='checked'";?> />Add</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds43" value="V_contact" <?php if(in_array("V_contact",$permissions)) echo "checked='checked'";?> /> View</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds44" value="U_contact" <?php if(in_array("U_contact",$permissions)) echo "checked='checked'";?> />Update</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds45" value="D_contact" <?php if(in_array("D_contact",$permissions)) echo "checked='checked'";?> />Delete</td>
			</tr>
			<tr>
							<td align="right" valign="top"><strong> <input name="Checkbox1" type="checkbox"  id="contactSource" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','contactSource','49','46','')" />Contact Source</strong></td>

				<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds46" value="A_contactS" <?php if(in_array("A_contactS",$permissions)) echo "checked='checked'";?> />Add</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds47" value="V_contactS" <?php if(in_array("V_contactS",$permissions)) echo "checked='checked'";?> /> View</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds48" value="U_contactS" <?php if(in_array("U_contactS",$permissions)) echo "checked='checked'";?> />Update</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds49" value="D_contactS" <?php if(in_array("D_contactS",$permissions)) echo "checked='checked'";?> />Delete</td>
			</tr>
			<tr>
							<td align="right" valign="top"><strong> <input name="Checkbox1" type="checkbox"  id="contactResponse" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','contactResponse','53','50','')" />Contact Response</strong></td>

				<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds50" value="A_contactR" <?php if(in_array("A_contactR",$permissions)) echo "checked='checked'";?> />Add</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds51" value="V_contactR" <?php if(in_array("V_contactR",$permissions)) echo "checked='checked'";?> /> View</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds52" value="U_contactR" <?php if(in_array("U_contactR",$permissions)) echo "checked='checked'";?> />Update</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds53" value="D_contactR" <?php if(in_array("D_contactR",$permissions)) echo "checked='checked'";?> />Delete</td>
			</tr>

		<!-- 	<tr>
							<td align="right" valign="top"><strong> <input name="Checkbox1" type="checkbox"  id="cityAc" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','cityAc','57','54','')" />City</strong></td>

				<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds54" value="A_city" <?php // if(in_array("A_city",$permissions)) echo "checked='checked'";?> />Add</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds55" value="V_city" <?php // if(in_array("V_city",$permissions)) echo "checked='checked'";?> /> View</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds56" value="U_city" <?php // if(in_array("U_city",$permissions)) echo "checked='checked'";?> />Update</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds57" value="D_city" <?php // if(in_array("D_city",$permissions)) echo "checked='checked'";?> />Delete</td>
			</tr>   
			<tr>
							<td align="right" valign="top"><strong> <input name="Checkbox1" type="checkbox"  id="allotAc" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','allotAc','115','112','')" />Lead Allotment Rule</strong></td>

				<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds112" value="A_allot" <?php // if(in_array("A_allot",$permissions)) echo "checked='checked'";?> />Add</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds113" value="V_allot" <?php // if(in_array("V_allot",$permissions)) echo "checked='checked'";?> /> View</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds114" value="U_allot" <?php // if(in_array("U_allot",$permissions)) echo "checked='checked'";?> />Update</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds115" value="D_allot" <?php // if(in_array("D_allot",$permissions)) echo "checked='checked'";?> />Delete</td>
			</tr>
			<tr>
							<td align="right" valign="top"><strong> <input name="Checkbox1" type="checkbox"  id="productAc" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','productAc','61','58','')" />Product</strong></td>

				<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds58" value="A_product" <?php // if(in_array("A_product",$permissions)) echo "checked='checked'";?> />Add</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds59" value="V_product" <?php //if(in_array("V_product",$permissions)) echo "checked='checked'";?> /> View</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds60" value="U_product" <?php //if(in_array("U_product",$permissions)) echo "checked='checked'";?> />Update</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds61" value="D_product" <?php // if(in_array("D_product",$permissions)) echo "checked='checked'";?> />Delete</td>
			</tr> 
			<tr>
							<td align="right" valign="top"><strong> <input name="Checkbox1" type="checkbox"  id="serviceC" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','serviceC','65','62','')" />Service Category</strong></td>

				<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds62" value="A_service" <?php// if(in_array("A_service",$permissions)) echo "checked='checked'";?> />Add</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds63" value="V_service" <?php // if(in_array("V_service",$permissions)) echo "checked='checked'";?> /> View</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds64" value="U_service" <?php // if(in_array("U_service",$permissions)) echo "checked='checked'";?> />Update</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds65" value="D_service" <?php // if(in_array("D_service",$permissions)) echo "checked='checked'";?> />Delete</td>
			</tr>
			<tr>
							<td align="right" valign="top"><strong> <input name="Checkbox1" type="checkbox"  id="stateAc" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','stateAc','69','66','')" />State</strong></td>

				<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds66" value="A_state" <?php // if(in_array("A_state",$permissions)) echo "checked='checked'";?> />Add</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds67" value="V_state" <?php // if(in_array("V_state",$permissions)) echo "checked='checked'";?> /> View</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds68" value="U_state" <?php // if(in_array("U_state",$permissions)) echo "checked='checked'";?> />Update</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds69" value="D_state" <?php // if(in_array("D_state",$permissions)) echo "checked='checked'";?> />Delete</td>
			</tr>  -->
			<tr>
							<td align="right" valign="top"><strong> 
							<input name="Checkbox1" type="checkbox"  id="rangeAc" style="vertical-align:middle;margin-bottom:7px; height: 20px;" onchange="chkModule('lds','rangeAc','98','95','')" />Target Range</strong></td>

				<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds95" value="A_targetrange" <?php if(in_array("A_targetrange",$permissions)) echo "checked='checked'";?> />Add</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds96" value="V_targetrange" <?php if(in_array("V_targetrange",$permissions)) echo "checked='checked'";?> /> View</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds97" value="U_targetrange" <?php if(in_array("U_targetrange",$permissions)) echo "checked='checked'";?> />Update</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds98" value="D_targetrange" <?php if(in_array("D_targetrange",$permissions)) echo "checked='checked'";?> />Delete</td>
			</tr>
			<tr>
							<td align="right" valign="top"><strong> 
							<input name="Checkbox1" type="checkbox"  id="teamAc" style="vertical-align:middle;margin-bottom:7px; height: 20px;" onchange="chkModule('lds','teamAc','123','120','')" />Team</strong></td>

				<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds120" value="A_team" <?php if(in_array("A_team",$permissions)) echo "checked='checked'";?> />Add</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds121" value="V_team" <?php if(in_array("V_team",$permissions)) echo "checked='checked'";?> /> View</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds122" value="U_team" <?php if(in_array("U_team",$permissions)) echo "checked='checked'";?> />Update</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds123" value="D_team" <?php if(in_array("D_team",$permissions)) echo "checked='checked'";?> />Delete</td>
			</tr>

			<tr>
							<td align="right" valign="top"><strong> 
							<input name="Checkbox1" type="checkbox"  id="templateAc" style="vertical-align:middle;margin-bottom:7px; height: 20px;" onchange="chkModule('lds','templateAc','119','116','')" />Template (Messenger and SMS)</strong></td>

				<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds116" value="A_template" <?php if(in_array("A_template",$permissions)) echo "checked='checked'";?> />Add</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds117" value="V_template" <?php if(in_array("V_template",$permissions)) echo "checked='checked'";?> /> View</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds118" value="U_template" <?php if(in_array("U_template",$permissions)) echo "checked='checked'";?> />Update</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds119" value="D_template" <?php if(in_array("D_template",$permissions)) echo "checked='checked'";?> />Delete</td>
			</tr>
			<tr>
			<td align="right" valign="top"><strong> 
			<input name="Checkbox1" type="checkbox"  id="templateemailAc" style="vertical-align:middle;margin-bottom:7px; height: 20px;" onchange="chkModule('lds','templateemailAc','127','124','')" />Template (Email)</strong></td>

			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds124" value="A_templateemail" <?php if(in_array("A_templateemail",$permissions)) echo "checked='checked'";?> />Add</td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds125" value="V_templateemail" <?php if(in_array("V_templateemail",$permissions)) echo "checked='checked'";?> /> View</td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds126" value="U_templateemail" <?php if(in_array("U_templateemail",$permissions)) echo "checked='checked'";?> />Update</td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds127" value="D_templateemail" <?php if(in_array("D_templateemail",$permissions)) echo "checked='checked'";?> />Delete</td>
			</tr>
			
			<tr>
			<td align="right" valign="top"><strong> 
			<input name="Checkbox1" type="checkbox"  id="templateemailCat" style="vertical-align:middle;margin-bottom:7px; height: 20px;" onchange="chkModule('lds','templateemail','169','170','')" />Email Template Category</strong></td>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds169" value="templateemail_Cat" <?php if(in_array("templateemail_Cat",$permissions)) echo "checked='checked'";?> />Email Category</td>
			</tr>

			<!-- <tr  style="display:none">
							<td align="right" valign="top"><strong> <input name="Checkbox1" type="checkbox"  id="zoneAc" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','zoneAc','90','87','')" />Zone</strong></td>

				<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds87" value="A_zone" <?php // if(in_array("A_zone",$permissions)) echo "checked='checked'";?> />Add</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds88" value="V_zone" <?php // if(in_array("V_zone",$permissions)) echo "checked='checked'";?> /> View</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds89" value="U_zone" <?php // if(in_array("U_zone",$permissions)) echo "checked='checked'";?> />Update</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds90" value="D_zone" <?php // if(in_array("D_zone",$permissions)) echo "checked='checked'";?> />Delete</td>
			</tr>   -->


			<tr>
							<td align="right" valign="top"  rowspan="2"> <strong> <input name="Checkbox1" type="checkbox"  id="adminisAc" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','adminisAc','74','70','')" />Administration</strong></td>

				<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds70" value="AP_adminis" <?php if(in_array("AP_adminis",$permissions)) echo "checked='checked'";?> />Add Profile</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds71" value="VP_adminis" <?php if(in_array("VP_adminis",$permissions)) echo "checked='checked'";?> /> View Profiles</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds72" value="AC_adminis" <?php if(in_array("AC_adminis",$permissions)) echo "checked='checked'";?> />Access Control</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds73" value="AU_adminis" <?php if(in_array("AU_adminis",$permissions)) echo "checked='checked'";?> />Add User</td>
			</tr>
			<tr>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds74" value="VU_adminis" <?php if(in_array("VU_adminis",$permissions)) echo "checked='checked'";?> />View Users</td>
			
			</tr>	
			
			<tr>
				<td align="right"  valign="top" rowspan="2"><strong> <input name="Checkbox1" type="checkbox"  id="setUp" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','setUp','77','75','')" />Setup</strong></td>
				
				<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds75" value="BLA_setup" <?php if(in_array("BLA_setup",$permissions)) echo "checked='checked'";?> />Bulk Lead Allotment</td>
				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds76" value="AB_setup"  <?php if(in_array("AB_setup",$permissions)) echo "checked='checked'";?> /> Approve Bills</td>
				

				<!-- <td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds77" value="AFT_setup" <?php //if(in_array("AFT_setup",$permissions)) echo "checked='checked'";?> />Approve Free Trials</td>
				<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds91" value="AT_setup" <?php // if(in_array("AT_setup",$permissions)) echo "checked='checked'";?> />Allot Target</td>  -->
			</tr>
			<tr>
			<!-- <td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds94" value="ATT_setup" <?php // if(in_array("ATT_setup",$permissions)) echo "checked='checked'";?> />Allot Team Target</td> 
			<td style="display:none"><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds140" value="AMN_setup" <?php // if(in_array("AMN_setup",$permissions)) echo "checked='checked'";?> />Add More Numbers</td> -->
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds134" value="TC_setup" <?php if(in_array("TC_setup",$permissions)) echo "checked='checked'";?> />Bulk Contact Transfer</td>	
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds202" value="TP_setup" <?php if(in_array("TP_setup",$permissions)) echo "checked='checked'";?> />Transfer To Pool</td>

			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds204" value="TO_setup"  <?php if(in_array("TO_setup",$permissions)) echo "checked='checked'";?> /> Transfer Owners</td>

				<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds203" value="AL_setup"  <?php if(in_array("AL_setup",$permissions)) echo "checked='checked'";?> /> Add Leads</td>
			</tr>

			<!-- <tr>
				<td align="right" rowspan="2"  valign="top"><strong> <input name="Checkbox1" type="checkbox"  id="miSc" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','miSc','80','78','')" />Miscellaneous</strong></td>

				<td> <input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds78"  value="TASK"  <?php // if(in_array("TASK",$permissions)) echo "checked='checked'";?>>Tasks & Reminders</td>

				<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds79"  value="W_BDCT" <?php // if(in_array("W_BDCT",$permissions)) echo "checked='checked'";?>  />Wall & Broadcasting</td>
			
			   <td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds80" value="MESS"  <?php // if(in_array("MESS",$permissions)) echo "checked='checked'";?> />Messenger</td>
			
				<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds139" value="VAU_tips"  <?php // if(in_array("VAU_tips",$permissions)) echo "checked='checked'";?> />View all User's Tips</td>
			
			</tr>  
			<tr>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds132" value="SMS_type"  <?php // if(in_array("SMS_type",$permissions)) echo "checked='checked'";?> />Type SMS</td>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds133" value="EMAIL_type"  <?php // if(in_array("EMAIL_type",$permissions)) echo "checked='checked'";?> />Type Email</td>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds154" value="TIPS_Archive"  <?php // if(in_array("TIPS_Archive",$permissions)) echo "checked='checked'";?> />Tips Archive</td>
			</tr>
			
		<tr>
			<td align="right"  valign="top"><strong> <input name="Checkbox1" type="checkbox"  id="org" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','org','82','81','')" />Organisation Details</strong></td>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds81" value="V_org"  <?php // if(in_array("V_org",$permissions)) echo "checked='checked'";?> />View</td>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds82" value="U_org"  <?php // if(in_array("U_org",$permissions)) echo "checked='checked'";?>/>Update</td>

			</tr>	-->
	<!-- 	<tr>
			<td align="right" rowspan="2"  valign="top"><strong> <input name="Checkbox1" type="checkbox"  id="dash" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','dash','111','107','')" />Dashboard</strong></td>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds107" value="WA_dash"  <?php // if(in_array("WA_dash",$permissions)) echo "checked='checked'";?> />Week's Activity</td>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds108" value="ATT_dash"  <?php // if(in_array("ATT_dash",$permissions)) echo "checked='checked'";?>/>All Teams Targets</td>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds109" value="OT_dash"  <?php // if(in_array("OT_dash",$permissions)) echo "checked='checked'";?>/>Own Target</td>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds110" value="TT_dash"  <?php // if(in_array("TT_dash",$permissions)) echo "checked='checked'";?>/>Teams's Target</td>
			</tr>	
		<tr>
		<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds111" value="CT_dash"  <?php // if(in_array("CT_dash",$permissions)) echo "checked='checked'";?>/>Company's Target</td>
		<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds128" value="SL_dash"  <?php // if(in_array("SL_dash",$permissions)) echo "checked='checked'";?>/>Spot Light</td>
		
		</tr>
		<tr>
			<td align="right"  valign="top"><strong> <input name="Checkbox1" type="checkbox"  id="enable" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','enable','138','137','')" />Enable Control</strong></td>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds137" value="EFT_control"  <?php //if(in_array("EFT_control",$permissions)) echo "checked='checked'";?> />Control Free Trial</td>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds138" value="EB_control"  <?php //if(in_array("EB_control",$permissions)) echo "checked='checked'";?> />Edit Bill</td>
			
		</tr>
		<tr>
			<td align="right"  valign="top"><strong> <input name="Checkbox1" type="checkbox"  id="disable" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','disable','129','129','')" />Disable Control</strong></td>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds129" value="D_control"  <?php // if(in_array("D_control",$permissions)) echo "checked='checked'";?> />Disable Right Click</td>
			
		</tr> -->
		<tr>
		<!-- 	<td align="right"  valign="top"><strong> <input name="Checkbox1" type="checkbox"  id="Merge" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','Merge','141','141','')" />Merge Contacts</strong></td>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds141" value="C_Merge"  <?php  // if(in_array("C_Merge",$permissions)) echo "checked='checked'";?> />Merge</td>  -->
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds142" value="UN_Merge"  <?php  if(in_array("UN_Merge",$permissions)) echo "checked='checked'";?> />Over-write Unalloted Lead</td>
		</tr>
		
		<!-- <tr>
			<td align="right"  valign="top"><strong> <input name="Checkbox1" type="checkbox"  id="ChatSettings" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','ChatSettings','149','147','')" />Chat Settings</strong></td>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds147" value="ALLOW_CHAT"  <?php // if(in_array("ALLOW_CHAT",$permissions)) echo "checked='checked'";?> />Allow Chat</td>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds148" value="READ_CHAT"  <?php  // if(in_array("READ_CHAT",$permissions)) echo "checked='checked'";?> />Read Conversations</td>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds149" value="DELETE_CHAT"  <?php  // if(in_array("DELETE_CHAT",$permissions)) echo "checked='checked'";?> />Delete Conversations</td>
		</tr>  
		
		<tr>
			<td align="right"  valign="top"><strong> <input name="Checkbox1" type="checkbox"  id="ChatRestriction" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','ChatRestriction','153','150','')" />Chat Permission</strong></td>
			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;" id="lds150" value="A_cannottalkto" <?php // if(in_array("A_cannottalkto",$permissions)) echo "checked='checked'";?> />Add</td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds151" value="V_cannottalkto" <?php // if(in_array("V_cannottalkto",$permissions)) echo "checked='checked'";?> /> View</td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds152" value="U_cannottalkto" <?php // if(in_array("U_cannottalkto",$permissions)) echo "checked='checked'";?> />Update</td>
			<td><input name="Checkbox1" type="checkbox"  style="vertical-align:middle;margin-bottom:7px;" id="lds153" value="D_cannottalkto" <?php // if(in_array("D_cannottalkto",$permissions)) echo "checked='checked'";?> />Delete</td>
			
		
		</tr>
		
		
		<tr>

			<td align="right"  valign="top"><strong> <input name="Checkbox1" type="checkbox"  id="smsapi" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','smsapi','156','155','')" />SMS Api</strong></td>

			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds155" value="SMS_api1"  <?php // if(in_array("SMS_api1",$permissions)) echo "checked='checked'";?> />ICE CUBE</td>

			<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds156" value="SMS_api2"  <?php  // if(in_array("SMS_api2",$permissions)) echo "checked='checked'";?> />V</td>
	</tr>   -->
        <tr>

		<td align="right"  valign="top"><strong> <input name="Checkbox1" type="checkbox"  id="dashboard" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','dashboard','164','158','')" />DashBoard</strong></td>
    	<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds158" value="month_target"  <?php if(in_array("month_target",$permissions)) echo "checked='checked'";?> />Month Target</td>
        <td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds159" value="week_target"  <?php if(in_array("week_target",$permissions)) echo "checked='checked'";?> />Week Target</td>
        <td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds161" value="todays_followups"  <?php if(in_array("todays_followups",$permissions)) echo "checked='checked'";?> />Today's Followups</td>
        
		</tr>
		<tr>
		<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds162" value="in_spotlight"  <?php if(in_array("in_spotlight",$permissions)) echo "checked='checked'";?> />In The Spotlight</td>
     	<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds164" value="team_target"  <?php if(in_array("team_target",$permissions)) echo "checked='checked'";?> />Team Target</td>
	<!--	<td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds166" value="week_targetAVP"  <?php // if(in_array("week_targetAVP",$permissions)) echo "checked='checked'";?> />TL Week Target</td> -->
	    </tr>
		
		<tr>
		<td align="right"  valign="top"><strong> <input name="Checkbox1" type="checkbox"  id="dashboard" style="vertical-align:middle;margin-bottom:7px;" onchange="chkModule('lds','dashboard','167','170','')" />Uploading Sheets</strong></td>
    	<td><input name="Checkbox1" type="checkbox" style="vertical-align:middle;margin-bottom:7px;"  id="lds168" value="UCH_reports"  <?php if(in_array("UCH_reports",$permissions)) echo "checked='checked'";?> />Upload Calling Report</td>
     	<td><input name="Checkbox1" type="checkbox" style="vertical-align:middle;margin-bottom:7px;"  id="lds170" value="URB_reports"  <?php if(in_array("URB_reports",$permissions)) echo "checked='checked'";?> />Upload Research Booster Report</td>
        <td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds176" value="UFR_reports"  <?php if(in_array("UFR_reports",$permissions)) echo "checked='checked'";?> />Upload Fout Report</td>
        <td><input name="Checkbox1" type="checkbox"   style="vertical-align:middle;margin-bottom:7px;"  id="lds209" value="UTD_reports"  <?php if(in_array("UTD_reports",$permissions)) echo "checked='checked'";?> /> Update Trade Date</td>


        </tr>
		
		<tr>
    	<td><input name="Checkbox1" type="checkbox" style="vertical-align:middle;margin-bottom:7px;"  id="lds178" value="UTR_reports"  <?php if(in_array("UTR_reports",$permissions)) echo "checked='checked'";?> />Upload Trader Report</td>
		<td><input name="Checkbox1" type="checkbox" style="vertical-align:middle;margin-bottom:7px;"  id="lds194" value="Upload_PayIN"  <?php if(in_array("Upload_PayIN",$permissions)) echo "checked='checked'";?> />Upload PayIn PayOut Report</td>
	    <td><input name="Checkbox1" type="checkbox" style="vertical-align:middle;margin-bottom:7px;"  id="lds181" value="Password_Update"  <?php if(in_array("Password_Update",$permissions)) echo "checked='checked'";?> />Update Client Data</td>
		<td><input name="Checkbox1" type="checkbox" style="vertical-align:middle;margin-bottom:7px;"  id="lds190" value="RM_slabMaster"  <?php if(in_array("RM_slabMaster",$permissions)) echo "checked='checked'";?> />RM Slab Master</td>
		</tr>
	

        <tr>
    	<td><input name="Checkbox1" type="checkbox" style="vertical-align:middle;margin-bottom:7px;"  id="lds191" value="create_faq"  <?php if(in_array("create_faq",$permissions)) echo "checked='checked'";?> />Create FAQs</td>
	    <td><input name="Checkbox1" type="checkbox" style="vertical-align:middle;margin-bottom:7px;"  id="lds192" value="create_faq_category"  <?php if(in_array("create_faq_category",$permissions)) echo "checked='checked'";?> />Create FAQs Categories</td>
		<td><input name="Checkbox1" type="checkbox" style="vertical-align:middle;margin-bottom:7px;"  id="lds193" value="spotlight_master"  <?php if(in_array("spotlight_master",$permissions)) echo "checked='checked'";?> />Spotlight Master</td>
		</tr>
		<tr>
    	<td><input name="Checkbox1" type="checkbox" style="vertical-align:middle;margin-bottom:7px;"  id="lds196" value="upload_expense_report"  <?php if(in_array("upload_expense_report",$permissions)) echo "checked='checked'";?> />Upload expense report</td>
	    <td><input name="Checkbox1" type="checkbox" style="vertical-align:middle;margin-bottom:7px;"  id="lds197" value="punch_client_data"  <?php if(in_array("punch_client_data",$permissions)) echo "checked='checked'";?> />Punch Client Data</td>
		<td><input name="Checkbox1" type="checkbox" style="vertical-align:middle;margin-bottom:7px;"  id="lds198" value="rm_client_allotment"  <?php if(in_array("rm_client_allotment",$permissions)) echo "checked='checked'";?> />RM Client Allotment</td>
		</tr>
	
		<tr>
	    <td><input name="Checkbox1" type="checkbox" style="vertical-align:middle;margin-bottom:7px;"  id="lds199" value="email_sending"  <?php if(in_array("email_sending",$permissions)) echo "checked='checked'";?> />Email sending</td>

	    <td><input name="Checkbox1" type="checkbox" style="vertical-align:middle;margin-bottom:7px;"  id="lds200" value="AOC_report"  <?php if(in_array("AOC_report",$permissions)) echo "checked='checked'";?> />AOC Report</td>

		<td><input name="Checkbox1" type="checkbox" style="vertical-align:middle;margin-bottom:7px;"  id="lds201" value="RM_mapping_report"  <?php if(in_array("RM_mapping_report",$permissions)) echo "checked='checked'";?> />RM Mapping Report</td>
		<td><input name="Checkbox1" type="checkbox" style="vertical-align:middle;margin-bottom:7px;"  id="lds206" value="EMM_reports"  <?php if(in_array("EMM_reports",$permissions)) echo "checked='checked'";?> />Employee Manager mapping Report</td>
       </tr>
	
		<tr>
		<td></td>
			<td><input name="Button1" type="button" value="Save Changes" class="buttonGreen" onclick="SaveData('permissions/save?profile=<?php echo $profile;?>','lds','215','','','','3');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
			</td>
		</tr>
			
			</table>
			<br/><br/><br/><br/><br/><br/><br/><br/>
			
		<?php
}		
?>	
			
			
			
			
			
			
			
			
			
			
			
			
			
