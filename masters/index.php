<?php
include("../include/conFig.php");
?>
<div class="moduleHeading">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="left" style="width: 30%">Setup</td>
</tr>
</table>
</div>

<div id="directResult">
<div style="height:475px;overflow:auto;">
<table width="100%" cellpadding="20" cellspacing="0">
<tr>
<td class="setup" style="vertical-align:top">
<?php  if(in_array('V_allot',$thisPer) || in_array('V_country',$thisPer) || in_array('V_contact',$thisPer) || in_array('V_contactS',$thisPer) || in_array('V_contactR',$thisPer) || in_array('V_city',$thisPer) || in_array('V_product',$thisPer) || in_array('V_service',$thisPer) || in_array('V_state',$thisPer) || in_array('V_org',$thisPer) || in_array('V_targetrange',$thisPer))
{
?>
<div id="head">Masters</div>
<ul class="setup">
 <!-- <?php //  if(in_array('V_country',$thisPer))
 //{
?>
<li onclick="getModule('masters/country/view','viewContent','manipulateContent','Countries')">Country</li> -->
<?php // } 
 if(in_array('V_contact',$thisPer)) { ?>
<li onclick="getModule('masters/leadsource/view','viewContent','manipulateContent','Contact Source')">Contact Source</li>
<?php }
 if(in_array('V_contactS',$thisPer)) { ?>
<li onclick="getModule('masters/leadstatus/view','viewContent','manipulateContent','Contact Status')">Contact Status</li>
<?php }
 if(in_array('V_contactR',$thisPer)) { ?>
<li onclick="getModule('masters/leadresponse/view','viewContent','manipulateContent','Contact Response')">Contact Response</li>
<?php }

 // if(in_array('V_city',$thisPer)) { 
 ?>
<!-- <li onclick="getModule('masters/city/view','viewContent','manipulateContent','Cities')">City/Location</li> -->
<?php // } ?>

<!--<li onclick="getModule('masters/introducer/view','viewContent','manipulateContent','Cities')">Introducer</li>-->
<?php
// if(in_array('V_allot',$thisPer))		{
?>
<!-- <li onclick="getModule('masters/allotmentrules/view','viewContent','manipulateContent','Allotment Rule')">Lead Allotment Rule</li> -->
<?php  // }


// if(in_array('V_product',$thisPer)) { ?>
<!-- <li onclick="getModule('masters/product/view','viewContent','manipulateContent','Products')">Product</li> -->
<?php // }

  // if(in_array('V_service',$thisPer)) { ?>
<!-- <li onclick="getModule('masters/category/view','viewContent','manipulateContent','Categories')">Service Category</li> -->
<?php  // }
 
// if(in_array('V_state',$thisPer)) { ?>
<!-- <li onclick="getModule('masters/state/view','viewContent','manipulateContent','States')">State</li> -->

<?php } //  } ?>
 
<?php //if(in_array('V_org',$thisPer)) { ?>
<!-- <li onclick="getModule('masters/companydetails/edit','manipulateContent','viewContent','States')">Organisation Details</li> -->
<?php // }


if(in_array('V_targetrange',$thisPer)) { ?>
<li onclick="getModule('masters/targetrange/view','viewContent','manipulateContent','Range')">Target Range</li>
<?php }
if(in_array('V_team',$thisPer)) { ?>
<ul class="setup">
<li onclick="getModule('team/view','viewContent','manipulateContent','View Team')">Teams</li>
</ul>
<?php }

if(in_array('V_template',$thisPer)) { ?>
<li onclick="getModule('masters/template/view','viewContent','manipulateContent','Template')">Template (Messenger and SMS)</li>
<?php }
if(in_array('V_templateemail',$thisPer)) { ?>
<li onclick="getModule('masters/templateemail/view','viewContent','manipulateContent','Template')">Template (Email)</li>
<?php }


// if(in_array('V_templateemail',$thisPer)) { ?>
<!-- <li onclick="getModule('masters/feedback/view','viewContent','manipulateContent','Feedback')">Feedback</li> -->
<?php // }?>



<?php if(in_array('templateemail_Cat',$thisPer)) { ?>
<li onclick="getModule('masters/emailcategory/view','viewContent','manipulateContent','Template Catergory')">Email Template Catergory</li>
<?php  } ?>

<?php 
 if(in_array('RM_slabMaster',$thisPer)) { ?>
<li onclick="getModule('masters/rmslabmaster/view','viewContent','manipulateContent','RM Slab Master')">RM Slab Master</li>
<?php } ?>

<?php 
 if(in_array('create_faq_category',$thisPer)) { ?>

<li onclick="getModule('masters/faqcategory/view','viewContent','manipulateContent','FAQs Catergory')">FAQs Category</li>
<?php } ?>

<?php 
 if(in_array('create_faq',$thisPer)) { ?>

<li onclick="getModule('masters/createfaq/view','viewContent','manipulateContent','Create FAQ')">Create FAQ</li>

<?php } ?>


<?php 
 if(in_array('spotlight_master',$thisPer)) { ?>
<li onclick="getModule('masters/spotlightmaster/spotlightUpdate','viewContent','manipulateContent','Spotlight Master')">Dashboard Update Master</li>

<?php } ?>
<?php  if(in_array('UTR_reports',$thisPer)) { ?>
<li onclick="getModule('masters/Emailsend/Emailsend','viewContent','manipulateContent','Trader report')">E-mail Sending</li>
<?php  }
?>
<!-- <?php  if(in_array('email_sending',$thisPer)) { ?>
<li onclick="getModule('masters/Emailsend/Emailsend','viewContent','manipulateContent','Trader report')">E-mail Sending</li>
<?php  }
?> -->
</ul>

</td>
<td class="setup" valign="top">
<?php  if(in_array('AP_adminis',$thisPer) || in_array('VP_adminis',$thisPer) || in_array('AC_adminis',$thisPer) )
{
?>
<div id="head">Profile</div>
<ul class="setup">
<?php  if(in_array('AP_adminis',$thisPer))
			{
			?>
<li onclick="getModule('masters/profile/new','manipulateContent','viewContent','Add Profile')">Add A Profile</li><?php } 
if(in_array('VP_adminis',$thisPer))
			{
			?>
<li onclick="getModule('masters/profile/view','viewContent','manipulateContent','All Profiles')">View All Profiles</li>
<?php }
 if(in_array('AC_adminis',$thisPer))
			{
			?>
<li  onclick="getModule('permissions/index','viewContent','manipulateContent','Permissions')">Access Control</li><?php } } ?> 


</ul>
<br/>
<br/>
<?php if(in_array('BLA_setup',$thisPer)) {
?>
<div id="head">Allot Leads</div>
<?php }?>
<ul class="setup">
<?php
					if(in_array('BLA_setup',$thisPer))
                    {
                    ?>
					   
					 <li  onclick="getModule('uploadlead/view','viewContent','manipulateContent','Targets')">Bulk Lead Allotment</li>
					<?php }
					if(in_array('TC_setup',$thisPer))
                       {
                       ?>
					   
					 <li onclick="getModule('transfercontact/transferView','viewContent','manipulateContent','Contact Transfer')">Bulk Contact Transfer</li>
					<?php } if(in_array('TP_setup',$thisPer))
                       {
                       ?>
					 <li onclick="getModule('transfercontact/transfertopoolView','viewContent','manipulateContent','Contact Transfer')">Transfer to pool</li>
					 <?php }if(in_array('TO_setup',$thisPer)){?>
					 <li onclick="getModule('transfercontact/transferOwners','viewContent','manipulateContent','Contact Transfer')">Transfer Owners</li>

					 <?php }if(in_array('AL_setup',$thisPer)){?>
					  <li onclick="getModule('uploadlead/new','viewContent','manipulateContent','Contact Transfer')">Add leads</li>
					<?php }

					?>
</ul>


<!-- 
<?php if(in_array('ATT_setup',$thisPer) || in_array('ATT_setup',$thisPer)) {
?>
<div id="head">Allot Target</div>
<?php }?>
<ul class="setup">
<?php
if(in_array('AT_setup',$thisPer))
                       {
                       ?>
					   
<li onclick="getModule('allottarget/view','viewContent','manipulateContent','Targets')">Allot Individual Target</li>
<?php }
if(in_array('ATT_setup',$thisPer))
{
?>
<li onclick="getModule('allottarget/teamtarget','viewContent','manipulateContent','Targets')">Allot Team Target</li>
<?php }?>
</ul>		-->			
<br/>
<br/>
<?php if(in_array('AB_setup',$thisPer) || in_array('AFT_setup',$thisPer)) {
?>
<div id="head">Approve</div>
<?php }?>
<ul class="setup">
<?php if(in_array('AB_setup',$thisPer))
{
?>
<li onclick="getModule('billing/viewAllbill','viewContent','manipulateContent','Bills')">Approve Bill Level-1</li>

<li onclick="getModule('billing/viewAllbillLevel2','viewContent','manipulateContent','Bills')">Approve Bill Level-2</li>
<?php } ?>
<?php if(in_array('AFT_setup',$thisPer))
{
?>
<!-- <li onclick="getModule('freetrial/view','viewContent','manipulateContent','Free Trials')">Approve Free Trials</li>
-->
<?php }?>	

<?php if(in_array('AB_setup',$thisPer))
{
?>
<li onclick="getModule('billing/villAllbooster','viewContent','manipulateContent','Bills')">Approve Research Booster</li>

<li onclick="getModule('billing/viewAllReducedBrokerage','viewContent','manipulateContent','Bills')">Approve Reduced Brokerage</li>

<?php } ?>


<?php if(in_array('AB_setup',$thisPer))
{
?>

<li onclick="getModule('billing/viewAllPremium','viewContent','manipulateContent','Bills')">Approve Brokerage Plan</li>
<?php } ?>

				
</ul>
</td>
<td class="setup" valign="top">
<?php if(in_array('AU_adminis',$thisPer) || in_array('VU_adminis',$thisPer))
			{
			?>
<div id="head">Administration</div>
<ul class="setup">
<?php  
if(in_array('AU_adminis',$thisPer))
{
?>
<li onclick="getModule('user/new','manipulateContent','viewContent','Add User')">Add A User</li>
<?php 
} 
if(in_array('VU_adminis',$thisPer))
{
?>

<li onclick="getModule('user/view','viewContent','manipulateContent','All Users')">All Users</li>
<?php 
} 
?>
<!-- <li style="display:" onclick="getModule('dataMerging/getData','viewContent','manipulateContent','All Users')">Upload</li> -->
<li style="display:" onclick="getModule('iptrack/index','viewContent','manipulateContent','Ip Ranges')">Ip Range</li>
<?php
}
 ?>
</ul>
<br/>
<br/>

<!-- 
<?php if(in_array('V_cannottalkto',$thisPer) || in_array('READ_CHAT',$thisPer)) {
?>
<div id="head">Chat Settings</div>
<?php }?>
<ul class="setup">
<?php
if(in_array('V_cannottalkto',$thisPer))
{
?>
<li onclick="getModule('chatSettings/cannotTalk/view','viewContent','manipulateContent','Chat Settings')">Chat Permission</li>
<?php }
if(in_array('READ_CHAT',$thisPer))
{
?>
<li onclick="getModule('chatSettings/readChat/view','viewContent','manipulateContent','Read Conversations')">Read Conversations</li>
<?php }
?>

<li onclick="getModule('whatsapp/sendBulkWhatsapp','viewContent','manipulateContent','Read Conversations')">Whatsapp Bulk Send</li>

</ul>  
<br/>
<br/>
<?php if(in_array('AMN_setup',$thisPer))
{
?>
<div style="display:none" id="head">SMS</div>
<ul class="setup">
<?php  
if(in_array('AMN_setup',$thisPer))
{
?>
<li style="display:none" onclick="getModule('moresms/new','manipulatemoodleContent','','Add Numbers')">Add More Numbers</li>
<?php 
} 
}
?>

</ul>  -->



<div  id="head">Uploading Masters</div>
<!-- <ul class="setup"> 
<?php  //if(in_array('AB_setup',$thisPer)) {
if(in_array('upload_expense_report',$thisPer)) {
 ?>
<li onclick="getModule('masters/upload/edit','viewContent','manipulateContent','Feedback')">Upload Expense Report</li>
<?php }?>

<?php  //if(in_array('UAC_clients',$thisPer)) {
if(in_array('punch_client_data',$thisPer)) {
 ?>
<li onclick="getModule('masters/upload/clientpunch','viewContent','manipulateContent','Feedback')">Punch Client Data</li>
<?php }if(in_array('rm_client_allotment',$thisPer)) {?>
<li onclick="getModule('masters/upload/bulksmsshoot','viewContent','manipulateContent','RM Clients')">RM Client Allotment</li>


<?php }?>
 </ul>
 -->
 <ul class="setup"> 
<?php // if(in_array('AB_setup',$thisPer)) {
 if(in_array('upload_expense_report',$thisPer)) { 
 ?>
<li onclick="getModule('masters/upload/edit','viewContent','manipulateContent','Feedback')">Upload Expense Report</li>
<?php }?>

<?php  if(in_array('UAC_clients',$thisPer)) { ?>
<li onclick="getModule('masters/upload/clientpunch','viewContent','manipulateContent','Feedback')">Punch Client Data</li>
<?php }?>

<?php  //if(in_array('RMClient_allot',$thisPer)) { ?>
<?php  if(in_array('rm_client_allotment',$thisPer)) { ?>
<li onclick="getModule('masters/upload/bulksmsshoot','viewContent','manipulateContent','RM Clients')">RM Client Allotment</li>

<?php }?>

 </ul>
 
 <ul class="setup"> 
<?php  if(in_array('UCH_reports',$thisPer)) { ?>
<li onclick="getModule('masters/upload/callingsheet','viewContent','manipulateContent','Feedback')">Upload Calling Report</li>
<?php  }?>
</ul>

<ul class="setup"> 
<?php  if(in_array('URB_reports',$thisPer)) { ?>
<li onclick="getModule('masters/upload/researchbooster','viewContent','manipulateContent','research Booster')">Upload Research Booster</li>
<?php  }?>
</ul>

<ul class="setup"> 
<?php  if(in_array('UFR_reports',$thisPer)) { ?>
<li onclick="getModule('masters/upload/foutresearch','viewContent','manipulateContent','Fout report')">Upload Fout Booster</li>
<?php  } ?>


<?php  if(in_array('UTR_reports',$thisPer)) { ?>
<li onclick="getModule('masters/upload/tradersheet','viewContent','manipulateContent','Trader report')">Upload Trader Report</li>
<?php  }?>


<?php  if(in_array('Password_Update',$thisPer)) { ?>
<li onclick="getModule('masters/upload/UpdatePassword','viewContent','manipulateContent','Update Password')">Update Client Data
 </li>
<?php  }?>

<?php  if(in_array('Upload_PayIN',$thisPer)) { ?>
<li onclick="getModule('masters/upload/PayinPayout','viewContent','manipulateContent','Upload Pay In Payout Report')">Upload Pay In Payout Report</li>
<?php  }?>

<?php  if(in_array('Upload_PayIN',$thisPer)) { ?>
<li onclick="getModule('masters/upload/VipRevesals','viewContent','manipulateContent','Upload VIP Reversals')">Upload VIP Reversals</li>
<?php  }?>

<?php  if(in_array('UTD_reports',$thisPer)) { ?>
<li onclick="getModule('masters/upload/firsttradedate','viewContent','manipulateContent','Feedback')">Update Trade Date</li>
<?php  }?>
</ul> 

</td>


</tr>
</table>
</div>
</div>
