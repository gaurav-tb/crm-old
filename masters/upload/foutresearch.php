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
Upload Fout Report
</td>

<td align="right">
<a href="masters/upload/foutReport.csv" style="text-decoration:none" class="buttonGreen" >Click Here To Download Sample</a>
</td>


</tr>
</table>
</div>
<form method="post" action="masters/upload/savefoutreport.php" target="targetFrame" enctype="multipart/form-data">
<div style="padding:20px;" class="form">
<table width="100%" cellpadding="0" cellspacing="10">
<tr>
<td align="right" style="height:36px">Uploading Date <span style="color:maroon">*</span></td>
<td align="left" style="height:36px"><input  type="date" class="input" name="date"  id="opt1" /></td>
</tr>
<tr>
<td align="right" valign="top">Select Document</td><td align="left">
<input type="file" name="csv" id="opt2"/>
</td>
</tr>




<tr>
<td></td>
<td align="left">
<?php  //if(in_array('U_contactS',$thisPer))
//{
?>
<input name="Submit" class="buttonGreen" type="submit" value="Upload File" onclick="return ValidateFile();document.getElementById('uploadStats').style.display = 'inline-block';" />
<span class="" style="display:none;margin-left:20px;" id="uploadStats">
Loading File..
</span>
<?php//} ?>
</td>
</tr>


</table>

</div>
