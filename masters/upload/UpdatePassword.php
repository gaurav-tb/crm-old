<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$getData = mysql_query("SELECT * FROM `leadsource` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="moduleHeading">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Update Client Data
</td>

<td align="right">
<a href="masters/upload/UpdatePassword.csv" style="text-decoration:none" class="buttonGreen" >Click Here To Download Sample</a>
</td>


</tr>
</table>
</div>
<form method="post" action="masters/upload/savePasswordSend.php" target="targetFrame" enctype="multipart/form-data">
<div style="padding:20px;" class="form">
<table width="100%" cellpadding="0" cellspacing="10">

<tr>
<td align="right" style="height:36px">Select Parameter <span style="color:maroon">*</span></td>
<td align="left" style="height:36px">
<select id="optFormat3" class="input" name="type">
<option value="0">Select Parameter</option>
<option value="1">Update Password</option>
<option value="2">Update Client ID details</option>
<option value="3">Update POA Received</option>
<option value="4">Update BO Mobile 1</option>
<option value="10">Update BO Mobile 2</option>
<option value="5">Update BO Email</option>
<option value="6">Update % Brokerage</option>
<option value="7">Update PanNumber </option>
<option value="8">Update BOClient Owner</option>
<option value="9">Update Introducer</option>
<option value="11">Update DOB</option>
<option value="12">Update BO Account Opening Date</option>
<option value="13">Update VIP Reversals</option>
</select></td>
</tr>

<tr>
<td align="right" style="height:36px">Uploading Date <span style="color:maroon">*</span></td>
<td align="left" style="height:36px"><input  type="date" class="input" name="date"  id="optFormat1" /></td>
</tr>
<tr>
<td align="right" valign="top">Select Document</td><td align="left">
<input type="file" name="csv" id="optFormat2"/>
</td>
</tr>

<tr>
<td></td>
<td align="left">
<?php  if(in_array('U_contactS',$thisPer))
{
?>
<input name="Submit" class="buttonGreen" type="submit" value="Upload File" onclick="return ValidatePasswordFile(); document.getElementById('uploadStats').style.display = 'inline-block';" />
<span class="" style="display:none;margin-left:20px;" id="uploadStats">
Loading File..
</span>
<?php } ?>
</td>
</tr>


</table>

</div>
