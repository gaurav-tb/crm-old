<?php
include("../include/conFig.php");

?>

<div class="moduleHeading">Bulk Lead Transfer</div>
<div class="form" style="background:#eee">

<table cellpadding="5" cellspacing="5" width="100%;" class="form">
<tr>
<td align="right" style="width:30%">
		<span class="blueSimpletext" style="">Transfer</span>
		
		</td><td align="left" style="width:30%">
				<select name="Select1" id="identify" style="width:208px" class="input" onchange="if(document.getElementById('from').value != ''){getModule('transfercontact/show?transType='+this.value+'&ownerid='+document.getElementById('from').value,'count','','Access Control')}">
				<option value="">Any Contact</option>
				<option value="0">Only Leads</option>
				<option value="1">Only Clients</option>

			</select>
		</td>
		<td style="width:30%"></td>
		</tr>
		
		

<tr>
		<td align="right">
		<span class="blueSimpletext" style="">From</span></td><td align="left">
		<select name="Select1" id="from" class="input" style="width:208px" onchange="getModule('transfercontact/show?transType='+document.getElementById('identify').value+'&ownerid='+this.value,'countLeadsVal','','Access Control')">
		<?php
		$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' ORDER BY `name` ASC",$con) or die(mysql_error()); 
			while($rowCity = mysql_fetch_array($getCity))
			{
			?>
			<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
			<?php
			}
			?>
			</select><span id="countLeadsVal" class="blueSimpletext"></span>
			</td>
</tr>
<tr>
	<td align="right">
		<span class="blueSimpletext" style="">Shift</span></td><td align="left">
		<input placeholder="Enter no. of Records" name="Text1" id="shift" type="text" class="input">
	</td>
	
</tr>
<tr>
	<td align="right">
		<span class="blueSimpletext" style="">To</span></td><td align="left">
			<select name="Select2" id="to" class="input" style="width:208px">
			<?php
		$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `status` = '1' ORDER BY `name` ASC",$con) or die(mysql_error()); 
			while($rowCity = mysql_fetch_array($getCity))
			{
			?>
			<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
			<?php
			}
			?>
			</select>
			</td>
	
</tr>
<tr>
	<td align="right" class="blueSimpletext">Mass Update Lead Status</td>
	<td>
	
<select name="Select1" title="isNotNull" id="leadstatus" style="width:210px"  class="input">
				<option value="">Select Lead Status</option>
			<?php
			$getProfile = mysql_query("SELECT `name`,`id` FROM `leadstatus` WHERE `delete` = '0'",$con) or die(mysql_error());
			while($rowProfile= mysql_fetch_array($getProfile))
			{
			?>
			<option value="-<?php echo $rowProfile[1] ;?>-"><?php echo $rowProfile[0] ;?></option>
			<?php
			}
			?>
			
			</select>
	
	

	</td>
</tr>
<tr>
	<td align="right" class="blueSimpletext">Mass Update Call Back Date</td>
	<td><input  style="width: 200px" class="input" type="date" id="callbackdate" value=""/></td>
</tr>


<tr>
<td></td>
	<td align="left">
	<input name="Button1" type="button" value="Shift" class="buttonBlue" style="width:100px" onclick="getModule('transfercontact/save?from='+document.getElementById('from').value+'&shift='+document.getElementById('shift').value+'&to='+document.getElementById('to').value+'&identify='+document.getElementById('identify').value+'&leadstatus='+document.getElementById('leadstatus').value+'&callbackdate='+document.getElementById('callbackdate').value,'manipulateContent','viewContent','Lead Transfer')">
	</td>
</tr>

</table>

