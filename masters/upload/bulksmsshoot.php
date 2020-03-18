<?php
include("../../include/conFig.php");
$id = $_GET['id'];
?>
<div class="moduleHeading">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Assing clients to RM/SRM
</td>

<td align="right">
<a href="masters/upload/RMSales.csv" style="text-decoration:none" class="buttonGreen" >Click Here To Download Sample</a>
</td>


</tr>
</table>
</div>
<form method="post" action="masters/upload/savepunch1.php" target="targetFrame" enctype="multipart/form-data">
<div style="padding:20px;" class="form">
<table width="100%" cellpadding="0" cellspacing="10">

<tr>
<td align="right" style="height:36px">Select Parameter <span style="color:maroon">*</span></td>
<td align="left" style="height:36px">
<select id="Ownershipparameter" class="input" name="type">
<option value="0">Select Parameter</option>
<option value="1">Update RMOwnership</option>
<option value="2">Update Client Owner</option>
<option value="3">Update Support Owner</option>
</select></td>
</tr>



<tr>
<td align="right" valign="top">Select Document</td><td align="left">
<input type="file" name="csv" id="opt2"/>
</td>

<td align="right" valign="top">Overwrite RM Ownership</td><td align="left">
<input type="checkbox" name="OverwriteRM" id="OverwriteRM"/>
</td>
</tr>




<tr>
<td></td>
<td align="left">
<?php  if(in_array('U_contactS',$thisPer))
{
?>
<input name="Submit" class="buttonGreen" type="submit" value="Upload File" onclick="return ValidateRMPunch();document.getElementById('uploadStats').style.display ='inline-block';" />
<span class="" style="display:none;margin-left:20px;" id="uploadStats">
Loading File..
</span>
<?php } ?>
</td>
</tr>


</table>
<table border="1" style="text-align:center">
<tr>
<td>RM Name </td>
<td>RM EMP. Id </td>
</tr>
<tr>
<td>Admin</td>
<td>1</td>
</tr>

<?php 
$getData  = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `employee`.`status`='1' AND `employee`.`delete`='0' ORDER BY `name` ASC",$con) or die(mysql_error());
while($row=mysql_fetch_array($getData))
{
?>
<tr>
<td><?php echo $row[0] ?></td>
<td><?php echo $row[1] ?></td>
</tr>
<?php } ?>
</table>
</div>
