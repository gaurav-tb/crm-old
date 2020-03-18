<?php
include("../include/conFig.php");
$type = $_GET['type'];
?>
<center style="height:600px;;width:100%;background:#eee;">
<div class="moduleHeading" style="margin:0px;">
	
	<table cellpadding="0" cellspacing="0" width="100%" class="fetch">
		<tr>
			<td align="left" style="width: 30%; height: 19px;">Mass Edit</td></tr>
			</table>
</div>
<br/><br/>
<div  style=";padding:5px;width:550px;-moz-box-shadow: 0 0 20px #222; -webkit-box-shadow: 0 0 20px #222;" class="form">
<table width="500px" cellpadding="5" cellspacing="0">
<tr>
<td align="left">Please select the Field</td>
</tr>
<tr>
	<td>
	<select name="Select1" id="column" class="input" style="width:210px" onchange="getModule('leads/getMassVal?values='+this.value,'resp','','Mass Edit')">
		<option value="">-Select Field-</option>
		<option value="fname">First Name</option>
		<option value="lname">Last Name</option>
		<option value="mobile">Mobile</option>
		<option value="email">Email</option>
		<!-- <option value="traderprofile">Trader's Profile</option>
		<option value="experience">Trader's Experience</option>
		<option value="invamount">Investment Amount</option>
		<option value="website">Website</option> -->
		<option value="leadstatus">Lead Status</option>
		<option value="leadsource">Lead Source</option>
		<option value="latestresponse">Latest Response</option>
		<option value="callbackdate">Call Back Date</option>
		<option value="inroducer">Introducer</option>
		<option value="%brokerage">% Brokerage</option>
		<option value="firsttrade">First Trade Date</option>
		<!-- <option value="address">Address</option>
		<option value="city">City</option>
		<option value="description">Description</option> -->

		</select>
	</td>
	</tr>
	<tr>
	<td colspan="2">
	<div id="resp" style="color:#333;font-weight:bold">
	</div>
	</td>
	</tr>
	<tr>
	<td>
	<input class="buttonBlue" name="Button1" style="width: 149px;" type="button" value="Update" onclick="massUpdate(document.getElementById('getBox').value,'<?php echo $type;?>','column')" />
	</td>
	
	</tr>
	<tr>
	<td style="color:;font-weight:bold">
	<div id="owresponse"></div>
	</td>
	</tr>
</table>
</div>
</center>