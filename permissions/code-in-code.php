<?php
error_reporting(0);
//$permissions = "A_leads,VO_leads,VA_leads";
//$permissions = explode(",",$permissions);






$html = '<table cellpadding="5" cellspacing="0" class="fetch" width="100%">
			<tr>
				<td><input name="Checkbox1" type="checkbox" checked="checked"  style="vertical-align:middle;margin-bottom:7px;" id="lds0" value="A_leads" /> Add Lead</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds1" value="VO_leads" />View Own Leads</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds2" value="VA_leads" />View All Leads</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds3" value="U_leads" onchange="chkModule(\'lds\',\'lds3\',\'16\',\'4\',\'dis\')"/>Update Leads</td>
			</tr>
			<tr>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds4" value="CO_leads" />Change Owner</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds5" value="D_leads" />Delete Leads</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds6" value="CV_leads" />Custom View</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds7" value="H_C_leads" />Hot & Cold Lead</td>
			</tr>
			<tr>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds8" value="FT_RN_leads" />Request New Free Trial</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds9" value="FT_VP_leads" />View Previous Free Trial</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds10" value="M_C_leads" />Compose Message</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds11" value="M_SI_leads" />View Sent Items</td>
			</tr>
			<tr>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds12" value="A_NT_leads" />Add Task</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds13" value="A_AS_leads" />Add Story</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds14" value="A_VOS_leads" />View Own Stories</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds15" value="A_VAS_leads" />View All Stories</td>

				</tr>
 			<tr>
			<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds16" value="CTC_leads" />Convert To Client</td>
			</tr>
				
			<tr>
				<td><input name="Checkbox1" type="checkbox" checked="checked"  style="vertical-align:middle;margin-bottom:7px;" id="lds17" value="VO_clients" />View Own Clients</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds18" value="VA_clients"/> View All Clients </td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds19" value="CO_clients" />Change Owner</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds20" value="D_clients" />Delete Clients</td>
			</tr>
			<tr>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds21" value="CV_clients" />Custom View</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds22" value="U_clients"  onchange="chkModule(\'lds\',\'lds22\',\'34\',\'23\',\'dis\')"  />Update Client</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds23" value="FT_RN_clients" />Request New Free Trial</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds24" value="FT_VP_clients" />View Previous Free Trial</td>
			</tr>
			<tr>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds25" value="M_C_clients" />Compose Message</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds26" value="M_SI_clients" />View Sent Items</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds27" value="A_NT_clients" />Add Task</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds28" value="A_AS_clients" />Add Story</td>
			</tr>
			<tr>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds29" value="B_SD_clients" />Subscription Details</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds30" value="B_BI_clients" onchange="chkModule(\'lds\',\'lds30\',\'32\',\'31\',\'dis\')"  />Billing Information</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds31" value="B_ANB_clients" />Add New Bill</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds32" value="B_SIC_clients" />Send Invoice</td>
			</tr>
			<tr>
				<td style="height: 37px"><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds33" value="B_SI_clients" />View Sent Invoices</td>
				<td style="height: 37px"><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds34" value="MD_clients" />Messenger Details</td>
							
			</tr>
			<tr>
				<td><input name="Checkbox1" type="checkbox" checked="checked"  style="vertical-align:middle;margin-bottom:7px;" id="lds35" value="G_reports" />General Report</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked"  style="vertical-align:middle;margin-bottom:7px;" id="lds36" value="S_reports" />Service Report</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked"  style="vertical-align:middle;margin-bottom:7px;" id="lds37" value="UP_reports" />User Performance Report</td>			
			</tr>
			<tr>
				<td><input name="Checkbox1" type="checkbox" checked="checked"  style="vertical-align:middle;margin-bottom:7px;" id="lds38" value="A_masters" />Add</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds39" value="V_masters"/> View</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds40" value="U_masters" />Update</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds41" value="D_masters" />Delete</td>
			</tr>
			<tr>
				<td><input name="Checkbox1" type="checkbox" checked="checked"  style="vertical-align:middle;margin-bottom:7px;" id="lds42" value="BLA_setup" />Bulk Lead Allotment</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds43" value="AB_setup"/> Approve Bills</td>
				<td><input name="Checkbox1" type="checkbox" checked="checked" style="vertical-align:middle;margin-bottom:7px;" id="lds44" value="AFT_setup" />Approve Free Trials</td>
				
			</tr>
			<tr>
				<td align="right" rowspan="1" valign="top"><strong> <input name="Checkbox1" type="checkbox" checked="checked" id="lds45" style="vertical-align:middle;margin-bottom:7px;" />Tasks & Reminders</strong></td>

				<td align="right" rowspan="1" valign="top"><strong> <input name="Checkbox1" type="checkbox" checked="checked" id="lds46" style="vertical-align:middle;margin-bottom:7px;"  />Wall & Broadcasting</strong></td>
			
			   <td align="right" rowspan="1" valign="top"><strong> <input name="Checkbox1" type="checkbox" checked="checked" id="lds47" style="vertical-align:middle;margin-bottom:7px;"  />Messenger</strong></td>
			</tr>

			
			</table>';
			
$temp = explode('value="',$html);
foreach($temp as $tal)
{
if($tal != $temp[0])
{
$temp1 = explode('" />',$tal);
$permissions[] .=$temp1[0];
}
}

			

			
$i=0;
foreach($permissions as $val)
{
$ex = 'value="'.$val.'"';
//$ex = 'id="lds'.$i.'"';
$new = $ex.'" <'.'?'.'php if(in_array("'.$val.'",$permissions) echo "checked=checked";?'.'>';
$html = str_ireplace($ex,$new,$html);
$i++;
}
			


?>
<textarea name="TextArea1" cols="20" rows="2"><?php echo $html;?></textarea>