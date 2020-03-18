<?php
include("../include/conFig.php");
$id = $_GET['id'];
$getdata=mysql_query("SELECT * FROM `invoice` WHERE `id` = '$id'",$con)or die(mysql_error());
$fetchData=mysql_fetch_array($getdata);
?>
<div style="font-size:11px;font-family:Tahoma,Arial, Helvetica, sans-serif;font-weight:bold;background:#fff;text-align:left">
<?php
if(!$_GET['new'])
{
$divHeight = "500px";
?>
<br/>
&nbsp;&nbsp;&nbsp;&nbsp;
<?php
}
else
{
$divHeight = "630px";
}
?>
<?php
if(!$_GET['new'])
{
if($fetchData['approved'] == 0)
{
?>
<div style="padding:10px;">
<img src="images/approved.png" alt="" style="height:15px;vertical-align:middle" />&nbsp;&nbsp;Invoice generated for this conversion. <br/>
<img src="images/approved.png" alt="" style="height:15px;vertical-align:middle" />&nbsp;&nbsp;Salesorder created and sent for approval. Once approved, you wll be able to send this invoice to the client. <br/>
</div>
<?php
}
else
{
if(in_array('B_SIC_clients',$thisPer)) {?>
<div style="padding:10px;">
<img src="images/approved.png" alt="" style="height:15px;vertical-align:middle" />&nbsp;&nbsp;Invoice generated for this conversion. <br/>
<img src="images/approved.png" alt="" style="height:15px;vertical-align:middle" />&nbsp;&nbsp;Salesorder created and approved. You can <span style="color:#5F78AB;text-decoration:underline;cursor:pointer" onclick="document.getElementById('sendEmail').style.display='block'">Send Invoice</span> to the client. <br/>
<?php
$getInv=mysql_query("SELECT COUNT(`id`) FROM `sentitems` WHERE `invoiceid` = '$id'",$con)or die(mysql_error());
$fetchInv=mysql_fetch_array($getInv);
if($fetchInv[0] > 0)
{
?>
<img src="images/approved.png" alt="" style="height:15px;vertical-align:middle" />&nbsp;&nbsp;Invoice already sent <?php echo $fetchInv[0] ;?> times. Please visit <span style="color:#5F78AB;text-decoration:underline;cursor:pointer">Sent Invoices Section</span> for more details. <br/>
<?php

}
?>
</div>
<?php
}
}
}
?>
<br/><div style="background:#eee;height:<?php echo $divHeight;?>;overflow-x:hidden;overflow-y:scroll" id="allInvoice">
<?php
if($fetchData['approved'] == 1)
{
$cid = $fetchData['cid'];
$getEmail = mysql_query("SELECT `email` FROM `contact` WHERE `id` = '$cid'",$con) or die(mysql_error());
$rowEmail = mysql_fetch_array($getEmail);

?>

<table width="100%" cellpadding="5" cellspacing="0" style="background:#eee;display:none;border-bottom:1px #eee solid" id="sendEmail">
<tr>
<td align="right" style="width:90px;font-size:11px;">To Email Id</td><td align="left">
	<input name="Text1" type="text" class="input" style="width: 342px" id="toEmail" value="<?php echo $rowEmail[0];?>" /></td>
</tr>
<tr>
<td></td>
<td><input name="Button1" class="buttonGreen" type="button" value="Send Invoice" onclick="getModule('invoice/quickSend?id=<?php echo $id;?>&email='+document.getElementById('toEmail').value,'allInvoice','','')" /></td>
</tr>
<tr>
<td></td>
</tr>
</table>
<?php
}
?>
<?php
echo str_ireplace("&#65279;","",$fetchData['html']);
?>
</div>
<br/><br/><br/><br/>
</div>