<?php
include("../include/conFig.php");
$id = $_GET['id'];
$getdata=mysql_query("SELECT * FROM `invoice` WHERE `id` = '$id'",$con)or die(mysql_error());
$fetchData=mysql_fetch_array($getdata);
?>
<link type="text/css" rel="stylesheet" href="../css/style.css" />
<div style="font-size:11px;font-family:Tahoma,Arial, Helvetica, sans-serif;font-weight:bold;background:#fff;">
<?php
if($fetchData['approved'] == 0)
{
?>
<div style="padding:10px;">
<img src="../images/approved.png" alt="" style="height:15px;vertical-align:middle" />&nbsp;&nbsp;Invoice generated for this conversion. <br/>
<img src="../images/approved.png" alt="" style="height:15px;vertical-align:middle" />&nbsp;&nbsp;Salesorder created and sent for approval. Once approved, you wll be able to send this invoice to the client. <br/>
</div>
<?php
}
else
{
?>
<div style="padding:10px;">
<img src="../images/approved.png" alt="" style="height:15px;vertical-align:middle" />&nbsp;&nbsp;Invoice generated for this conversion. <br/>
<img src="../images/approved.png" alt="" style="height:15px;vertical-align:middle" />&nbsp;&nbsp;Salesorder created and approved. You can <span style="color:#5F78AB;text-decoration:underline;cursor:pointer" onclick="document.getElementById('sendEmail').style.display='block'">send invoice</span> to the client. <br/>
</div>
<?php
}
?>
<br/><div style="background:#eee;height:500px;overflow-x:hidden;overflow-y:scroll">
<?php
if($fetchData['approved'] == 1)
{
?>

<table width="100%" cellpadding="5" cellspacing="0" style="background:#eee;display:none;border-bottom:1px #eee solid" id="sendEmail">
<tr>
<td align="right" style="width:90px;font-size:11px;">To Email Id</td><td align="left">
	<input name="Text1" type="text" class="input" style="width: 342px" /></td>
</tr>
<tr>
<td></td>
<td><input name="Button1" class="buttonGreen" type="button" value="Send Invoice" /></td>
</tr>
<tr>
<td></td>
</tr>
</table>
<?php
}
?>
<?php
echo str_ireplace("﻿","",$fetchData['html']);
?>
</div>
<br/><br/><br/><br/>
</div>