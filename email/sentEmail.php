<?php
include("../include/conFig.php");
$eid=$_GET['eid'];
$getData = mysql_query("SELECT  sentemail.email, sentemail.subject, sentemail.html, sentemail.cid FROM sentemail,contact WHERE sentemail.id = '$eid' AND sentemail.delete = '0'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div style="text-align:left">
<br/>
&nbsp;&nbsp;<div class="button" style="display:inline-block;float:right" onclick="ToggleBox('viewmoodleContent','none','');ToggleBox('manipulatemoodleContent','block','')"><img src="images/back.png" style="vertical-align:middle" alt=""/>&nbsp;&nbsp;Back To List </div>

<div style="font-size:11px;font-family:'Segoe UI', Tahoma, Geneva, Verdana,Tahoma,Arial, Helvetica, sans-serif;font-weight:bold;background:#fff;text-align:left">
<br/>
<table width="100%;" cellpadding="5" cellspacing="0" class="form">
<tr>
<td align="right">To</td><td align="left"><?php echo $row['email'];?></td><td style="width:60%"></td>
</tr>
<tr>
<td align="right">Subject</td><td align="left"><?php echo $row['subject'];?></td>
</tr>
<tr></tr>
</table>

<div style="background:#eee;height:500px;overflow-x:hidden;overflow-y:scroll;padding:10px;" id="allInvoice">
<?php
echo str_ireplace("&#65279;","",$row['html']);
?>
</div>
<br/><br/><br/><br/>
</div>
</div>