<?php
include("../../include/conFig.php");
		$getLogo = mysql_query("SELECT `logo` FROM `company` WHERE `id` = '1'",$con) or die(mysql_error());
		$rowLogo = mysql_fetch_array($getLogo);


?>

<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Change Logo</td>
		</tr>
	</table>
</div>
<br/>
<form action="masters/companydetails/saveLogo.php" method="post" target="myUploadFrame" enctype="multipart/form-data">
<table width="100%" cellpadding="5" cellspacing="0" class="form" style="background:#f3f3f3">
<tr>
<td style="width:30%" align="right">
<img src="<?php echo str_ireplace("../","",$rowLogo[0])?>" style="width:160px;"  id="forChangelogo" />
</td>
<td style="width:70%;line-height:200%" valign="top">
<input name="file" class="input" type="file" style="width: 392px;padding:0px;background:#fff;" />
<br/>
<input name="submit" type="submit" value="Upload" class="buttonBlue" onclick="document.getElementById('uploadingTemp').style.display='inline-block'" />
&nbsp;&nbsp; <span id="uploadingTemp" style="display:none">Uploading..</span>
</td>
</tr>
</table>
</form>

<p>

<iframe style="height:0;width:0;" id="myUploadFrame" scrolling="0" frameborder="0"></iframe>
</p>








	