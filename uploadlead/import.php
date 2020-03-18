<?php
include("../include/conFig.php");
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">

Import Leads</td>
<td align="right">
<a href="uploadlead/sample.csv" style="text-decoration:none" class="buttonGreen" >Click Here To Download Sample</a>
<input name="Button1" type="button" value="Or Copy Paste Leads" class="buttonGreen" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />


</td>
</tr>
</table>
</div>
<iframe id="targetFrame" src="#" style="width:0px;height:0px;display:none" scrolling="no" frameborder="0"></iframe>
<form method="post" action="uploadlead/importFile.php" target="targetFrame" enctype="multipart/form-data">
<table width="100%" cellpadding="0" cellspacing="10" class="form" align="center">
<tr>
<td align="right">Select Source</td>
<td colspan="" style="padding-top:10px; height: 39px;">


<select name="leadsource" class="input"  style="width: 200px" id="opt3">
				
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `leadsource` WHERE `delete` = '0' AND `id` != '1'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>



</td></tr>
<tr>
<td align="right">Please Select File</td>
<td align="left">
<input name="csv" type="file" />
</td>
</tr>
<tr>
<td></td>
<td align="left">
<input name="mobile" type="checkbox"/>&nbsp;Overwrite Mobile
</td>
</tr>
<tr>
<td></td>
<td align="left" style="display:none">
<input name="email" type="checkbox" />&nbsp;Overwrite Email
</td>
</tr>
<tr>
<td></td>
<td align="left">
<input name="Submit" class="buttonGreen" type="submit" value="Upload File" onclick="document.getElementById('uploadStats').style.display = 'inline-block';" />
<span class="" style="display:none;margin-left:20px;" id="uploadStats">
Loading File..
</span>
</td>
</tr>

</table>
</form>

