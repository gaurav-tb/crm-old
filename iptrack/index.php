<?php
include("../include/conFig.php");
$getData = mysql_query("SELECT * FROM `iprange` WHERE `id` = '1'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

$Ips = $row['from'];

?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Ip Ranges
</td>
<td align="right" style="width:70%">
</td>
</tr>
</table>
</div>
<div style="padding:20px;" class="form">
<center>
<table width="100%;" cellpadding="0" cellspacing="20">
<tr>
<td align="left">Ips Allowed<span style="color:maroon">*</span>
<br/>
<textarea name="req" id="ipTr0" style="height: 137px; width: 545px;" title="isNotNull"><?php echo $Ips;?></textarea>
<span style="font-size:10px;font-style:italic">Seperted by comma!</span>
</td></tr>
<tr>

<td>
<input name="Button2" type="button" value="Save" class="buttonGreen" onclick="SaveData('iptrack/save','ipTr','1','','','','4')" />&nbsp;&nbsp;
</td>
</tr>
</table></center>
</div>
