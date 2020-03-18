<?php
include("../include/conFig.php");
?>
	<table width="100%" cellpadding="5" cellspacing="0">
	<tr>
	<td>Advanced Search
	</td>
	</tr>
	<tr>
	<td colspan="4">
	<input name="Text1" type="text" class="input" placeholder="Enter Search Term Here" id="strem" />
	</td>
	</tr>
<tr>
	<td>
	<select class="input" name="leadstatus" style="width: 207px;" id="advView1">
	<option value="">Lead Status</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `leadstatus` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
	</select>
	&nbsp;&nbsp;
	<select class="input" name="leadsource" style="width: 207px" id="advView2">
	<option value="">Lead Source</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `leadsource` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>
	&nbsp;&nbsp;	<select class="input" name="leadresponse" style="width: 207px" id="advView3">
	<option value="">Lead Response</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `leadresponse` WHERE `delete` = '0'",$con) or die(mysql_error()); 
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
	&nbsp;&nbsp;	<select class="input" name="leadowner" style="width: 207px" id="advView4">
	<option value="">Lead Owner</option>			
<?php
if(in_array('VA_leads',$thisPer))
{
$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0'",$con) or die(mysql_error()); 
}
else if(in_array('VA_tLeads',$thisPer))
{
	$getLead = mysql_query("SELECT COUNT(`id`) FROM `team` WHERE `leader` = '$loggeduserid'",$con) or die(mysql_error());
	$rowLead = mysql_fetch_array($getLead);
		if($rowLead[0] > 0)
		{
			$getCity = mysql_query("SELECT employee.name,teamamtes.mateid FROM employee,team,teamamtes WHERE team.leader = '$loggeduserid' AND teamamtes.mateid = employee.id AND teamamtes.teamid = team.id AND team.delete = '0' AND employee.delete = '0'",$con) or die(mysql_error());
		}
		else
		{
			$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `id` = '$loggeduserid'",$con) or die(mysql_error()); 
		}
}
else
{
$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `id` = '$loggeduserid'",$con) or die(mysql_error()); 
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
			
				<input id="advView5" name="fromdate" class="inputCalender" placeholder="From Date" onclick="openCalendar(this);" readonly="readonly" type="text">&nbsp;
				<input id="advView6" name="fromdate" class="inputCalender" placeholder="To Date" onclick="openCalendar(this);" readonly="readonly" type="text"> in 
				<select id="advView7" name="Select1" class="input" style="width: 207px">
				<option value="Cl">Call Back Date</option>
				<option value="C">Create Date</option>
				<option value="M">Modified Date</option>

			</select>
			&nbsp;&nbsp;
			<select id="advView10" class="input" style="width:207">
			<option value="ALL">All Leads</option>
			<option value="HL">Hot Leads</option>
			<option value="CL">Cold Leads</option>

			</select>
	
				
			
				
	</td>


</tr>
<tr>
	<td>
	<input name="Button1" class="buttonBlue" type="button" value="Search" onclick="if(document.getElementById('strem').value != ''){getModule('search/advancedView?term='+document.getElementById('strem').value+'&status='+document.getElementById('advView1').value+'&source='+document.getElementById('advView2').value+'&response='+document.getElementById('advView3').value+'&owner='+document.getElementById('advView4').value+'&fromdate='+document.getElementById('advView5').value+'&todate='+document.getElementById('advView6').value+'&type='+document.getElementById('advView7').value+'&mark='+document.getElementById('advView10').value,'viewContent','manipulateContent','Search Results');ToggleBox('bigMoodle','none','');}" />	</td>
</tr>

</table>

