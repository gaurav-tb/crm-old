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
Upload Trade Date
</td>

<td align="right">
<a href="masters/upload/firsttradedate.csv" style="text-decoration:none" class="buttonGreen" >Click Here To Download Sample</a>
</td>


</tr>
</table>
</div>
<form method="post" action="masters/upload/savefirsttrade.php" target="targetFrame" enctype="multipart/form-data">
<div style="padding:20px;" class="form">
<table width="100%" cellpadding="0" cellspacing="10">
<tr>

<td align="right" valign="top">Select Document</td><td align="left">
<td align="right" valign="top">
<select name="uploadtradetype" class="input">
<option value="1">First Trade Date</option>
<option value="2">Last Trade Date</option>	
</select>	
</td>
</tr>
<tr>

<td align="right" valign="top">Select Document</td><td align="left">
<input type="file" name="csv" id="opt2"/>
</td>
</tr>




<tr>
<td></td>
<td align="left">
<?php  if(in_array('U_contactS',$thisPer))
{
?>
<input name="Submit" class="buttonGreen" type="submit" value="Upload File" onclick="return ValidatePunch(); document.getElementById('uploadStats').style.display ='inline-block';" />
<span class="" style="display:none;margin-left:20px;" id="uploadStats">
Loading File..
</span>
<?php } ?>
</td>
</tr>


</table>

</div>
