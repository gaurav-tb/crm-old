<?php
include("../include/conFig.php");
$type = $_GET['type'];
?>
<center style="height:600px;;width:100%;background:#eee;">
<div class="moduleHeading" style="margin:0px;">
	
	<table cellpadding="0" cellspacing="0" width="100%" class="fetch">
		<tr>
			<td align="left" style="width: 30%; height: 19px;">Change Owner</td></tr>
			</table>
</div>
<br/><br/>
<div style="background:#325E7E;padding:5px;width:550px;-moz-box-shadow: 0 0 20px #222; -webkit-box-shadow: 0 0 20px #222;">
<table width="500px" cellpadding="5" cellspacing="0">
<tr>
<td align="left" style="color:#fff; height: 29px;">Please select the new owner</td>
</tr>
<tr>
	<td style="width: 163px; height: 38px;">
	<select class="input" name="leadowner" style="width: 344px;height:30px;" id="owner">
	<option value="null">-Select Owner-</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0'",$con) or die(mysql_error()); 
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
	<td>
	<input class="button" name="Button1" style="width: 149px;" type="button" value="Change" onclick="changeOwner(document.getElementById('owner').value,'<?php echo $type;?>')" />
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