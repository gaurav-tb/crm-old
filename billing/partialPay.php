<?php
include("../include/conFig.php");
$id = $_GET['id'];
$amt = $_GET['amt'];
$i = $_GET['i'];
$getpartialPay = mysql_query("SELECT `partialpayment` FROM `invoice` WHERE `id` = '$id'") or die(mysql_error());
$row = mysql_fetch_array($getpartialPay);


?>
<center style="height:600px;;width:100%;background:#eee;">
<div class="moduleHeading" style="margin:0px;">
	
	<table cellpadding="0" cellspacing="0" width="100%" class="fetch">
		<tr>
			<td align="left" style="">Payment Details</td></tr>
			</table>
</div>
<br/><br/>
<div style=";padding:5px;width:550px;-moz-box-shadow: 0 0 20px #222; -webkit-box-shadow: 0 0 20px #222;" class="form">
<table width="500px" cellpadding="5" cellspacing="0">
<tr>
	<td>Total Amount
	</td>
	<td>
	<input class="input" name="parPay" type="text" id="totalamt" style="border:none" readonly="readonly" value="<?php echo $amt;?>"/>

	</td>
	</tr>
	<tr>
	<td>Payment received till date</td>
	<td><input class="input" type="text" id="parPay" value="<?php echo $row[0];?>"/></td>
	</tr>
	<tr>
	<td></td>
	<td>
	<input class="buttonGreen" name="Button1" style="" type="button" value="Update Only" onclick="if(document.getElementById('parPay').value != ''){getModule('billing/updatePay?approved=0&amp;amt=<?php echo $amt;?>&amp;id=<?php echo $id;?>&amp;parPay='+document.getElementById('parPay').value,'','',''); document.getElementById('aprtill<?php echo $id;?>').innerHTML = document.getElementById('parPay').value;document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','');ShowError('<br/>Sucessfully Updated');} else { ShowError('<br/>Please fill Partial Payment');}" />
	&nbsp;&nbsp;&nbsp;&nbsp;
	<input class="buttonGreen" name="Button1" style="" type="button" value="Update And Approve" onclick="var r=confirm('Are You Sure You Want To Approve this Bill?');if (r==true){ getModule('billing/updatePay?approved=1&amp;amt=<?php echo $amt;?>&amp;id=<?php echo $id;?>&amp;parPay='+document.getElementById('parPay').value,'','','');document.getElementById('fetchRow'+<?php echo $i;?>).style.display ='none';document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','');ShowError('<br/>Sucessfully Approved');}" />
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