<?php
include("../include/conFig.php");
?>
	<table width="100%" cellpadding="5" cellspacing="0">
	<tr>
	<td style="border-bottom:1px #999 solid; height: 43px;">
		<div style="float:right">
	<img src="images/close-light.png" alt="" style="cursor:pointer" onclick="$('#custViewBox').slideToggle('fast')" />
	</div>

	Saved Views&nbsp;&nbsp;
				<?php
			$getView = mysql_query("SELECT `id`,`name` FROM `customview` WHERE `eid` = '$loggeduserid' AND `type` = 'l'",$con) or die(mysql_error());
			?>
			<select name="Select1" class="input" style="padding:3px 4px" id="savedView">
			<option value="">Select View</option>
				
			<?php
			while($rowView = mysql_fetch_array($getView))
			{
			?>
			<option value="<?php echo $rowView[0];?>"><?php echo $rowView[1];?></option>
			<?php
			}
			?>

			</select><div style="display:inline-block;padding:5px;" class="buttonGreen" onclick="getModule('leads/customView?view='+document.getElementById('savedView').value,'directResult','','Leads')">Go</div>
			<div style="float:right;margin-right:20px">
			<div class="buttonnegetive" style="display:inline-block" onclick="getModule('deleteView?id='+document.getElementById('savedView').value,'viewDeleted','','Leads');$('#custViewBox').slideToggle('fast')">Delete Selected View</div>
			<div id="viewDeleted"></div>
			</div>
			
	</td>
	</tr>
	<tr>
	<td>Create New View
	</td>
	</tr>
<tr>
	<td>
	<select class="input" name="leadstatus" style="width: 207px;" id="cstview1">
	<option value="">Lead Status</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `leadstatus` WHERE `delete` = '0' order by `name` asc",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="-<?php echo $rowCity[1];?>-"><?php echo $rowCity[0];?></option>
<?php
}
?>
	</select>
	&nbsp;&nbsp;
	<select class="input" name="leadsource" style="width: 207px" id="cstview2">
	<option value="">Lead Source</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `leadsource` WHERE `delete` = '0' order by `name` asc",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>
	&nbsp;&nbsp;	<select class="input" name="leadresponse" style="width: 207px" id="cstview3">
	<option value="">Lead Response</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `leadresponse` WHERE `delete` = '0' order by `order` asc ",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>
	<?php

	?>
	&nbsp;&nbsp;	<select class="input" name="leadowner" style="width: 207px" id="cstview4">
	<option value="">Lead Owner</option>
	<option value="">Team Leads</option>		
	<option value="<?php echo $loggeduserid;?>">Self</option>	
<?php
if(in_array('VA_leads',$thisPer))
{
$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `status` = '1' ORDER BY `name` ASC",$con) or die(mysql_error()); 
}
else if(in_array('VA_tLeads',$thisPer))
{
	$getLead = mysql_query("SELECT COUNT(`id`) FROM `team` WHERE `leader` = '$loggeduserid'",$con) or die(mysql_error());
	$rowLead = mysql_fetch_array($getLead);
		if($rowLead[0] > 0)
		{
			$getCity = mysql_query("SELECT employee.name,teamamtes.mateid FROM employee,team,teamamtes WHERE team.leader = '$loggeduserid' AND teamamtes.mateid = employee.id AND teamamtes.teamid = team.id AND team.delete = '0' AND employee.delete = '0' ORDER BY employee.name ASC",$con) or die(mysql_error());
		}
		else
		{
			$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `id` = '$loggeduserid' ORDER BY `name` ASC",$con) or die(mysql_error()); 
		}
}
else
{
$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `id` = '$loggeduserid' ORDER BY `name` ASC",$con) or die(mysql_error()); 
}

while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>
			<br/>
			
				<input id="cstview5" name="fromdate" class="inputCalender" placeholder="From Date" onclick="openCalendar(this);" readonly="readonly" type="text">&nbsp;
				<input id="cstview6" name="fromdate" class="inputCalender" placeholder="To Date" onclick="openCalendar(this);" readonly="readonly" type="text"> in 
				<select id="cstview7" name="Select1" class="input" style="width: 207px">
				<option value="Cl">Call Back Date</option>
				<option value="C">Create Date</option>
				<option value="M">Modified Date</option>
				<option value="F">Fretrial Request Date</option>

			</select>
			&nbsp;&nbsp;
			<select id="cstview10" class="input" style="width:207">
			<option value="ALL">All Leads</option>
			<option value="HL">Hot Leads</option>
			<option value="CL">Cold Leads</option>
			<option value="UL">Unread Leads</option>
			<option value="RL">Read Leads</option>
			</select>
			&nbsp;&nbsp;
	
				<select class="input" name="product" style="width: 207px" id="cstview11">
	<option value="">Segment</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `category` WHERE `delete` = '0' order by `name` asc",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>
			&nbsp;&nbsp;

			<select name="Select1" class="input" id="cstview12">
				<option value="">Contact Status (Any)</option>
				<option value="con">Contacted</option>
				<option value="notcon">Not Contacted</option>
			</select>

			
				
	</td>


</tr>
<tr>
	<td style="font-size:11px;">
	Sort By
		<select id="cstview8" name="Select2" class="input" style="width:214">
		<option value="contact.fname">Name</option>
		<option value="contact.callbackdate">Call Back Date</option>
		<option value="employee.name">Lead Owner</option>
		<option value="contact.modifieddate">Modified Date</option>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;
Order 		
			<select id="cstview9" name="Select1" class="input" style="width:214">
			<option value="ASC">Ascending</option>
				<option value="DESC">Descending</option>

			</select>

	
	</td>
</tr>
<tr>
	<td>
	<input name="Button1" class="buttonBlue" type="button" value="Create View For Now" onclick="getModule('leads/customView?status='+document.getElementById('cstview1').value+'&source='+document.getElementById('cstview2').value+'&response='+document.getElementById('cstview3').value+'&owner='+document.getElementById('cstview4').value+'&fromdate='+document.getElementById('cstview5').value+'&todate='+document.getElementById('cstview6').value+'&type='+document.getElementById('cstview7').value+'&sortby='+document.getElementById('cstview8').value+'&order='+document.getElementById('cstview9').value+'&mark='+document.getElementById('cstview10').value+'&product='+document.getElementById('cstview11').value+'&cnc='+document.getElementById('cstview12').value,'directResult','','Leads');$('#custViewBox').slideToggle('fast')" />&nbsp;&nbsp;Or&nbsp;&nbsp;<input id="viewName" placeholder="Save This View For Future Use" class="input" name="Text1" type="text" style="width: 187px" /><div style="display:inline-block" class="buttonGreen rightRound" onclick="getModule('leads/customView?status='+document.getElementById('cstview1').value+'&source='+document.getElementById('cstview2').value+'&response='+document.getElementById('cstview3').value+'&owner='+document.getElementById('cstview4').value+'&fromdate='+document.getElementById('cstview5').value+'&todate='+document.getElementById('cstview6').value+'&type='+document.getElementById('cstview7').value+'&sortby='+document.getElementById('cstview8').value+'&order='+document.getElementById('cstview9').value+'&mark='+document.getElementById('cstview10').value+'&product='+document.getElementById('cstview11').value+'&cnc='+document.getElementById('cstview12').value+'&future='+document.getElementById('viewName').value,'directResult','','Leads');$('#custViewBox').slideToggle('fast')">Save It!</div>	</td>
</tr>

</table>

