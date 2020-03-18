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
<div  style="padding:5px;width:550px;-moz-box-shadow: 0 0 20px #222; -webkit-box-shadow: 0 0 20px #222;" class="form">
<table width="500px" cellpadding="5" cellspacing="0">
<tr>
<td align="left">Please select the Field</td>
</tr>
<tr>
	<td>
	<select name="Select1" id="column" class="input" style="width:210px" onchange="getModule('user/getMassVal?values='+this.value,'resp','','Mass Edit')">
		<option value="">-Select Field-</option>
		<option value="poolfetch">Daily Fetch</option>
		<option value="perfetch">Per Fetch Limit</option>
		<option value="poolfetchsource">Lead fetch source</option>
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
	<input class="buttonBlue" name="Button1" style="width: 149px;" type="button" value="Update" onclick="massUpdateUser(document.getElementById('getBox').value,'column')" />
	</td>
	
	</tr>
	<tr>
	<td style="color:#fff;font-weight:bold">
	<div id="owresponse"></div>
	</td>
	</tr>
</table>
</div>
</center>
