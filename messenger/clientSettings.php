<?php
include("../include/conFig.php");
$cid = $_GET['cid'];

$getData = mysql_query("SELECT * FROM `client_messenger_settings` WHERE `cid`= '$cid'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>
<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Messenger Settings For <?php echo $_GET['name'];?> </td>
			<td align="right" style="width: 70%">&nbsp;
			</td>
		</tr>
	</table>
</div>
<table width="100%" cellpadding="5" cellspacing="0" class="form" style="background:#f3f3f3">
<tr>
<td align="right">Username</td><td align="left"><input id="cms0" value="<?php echo $row['username'];?>" class="input" name="Text1" type="text" /></td>
</tr>
<tr>
<td align="right">Password</td><td align="left"><input id="cms1" value="<?php echo $row['password'];?>"  class="input" name="Text1" type="text" /></td>
</tr>
<tr>
<td align="right">What's App Id</td><td align="left"><input class="input" id="cms4" value="<?php echo $row['whtsappid'];?>"  class="whtApId" name="Text1" type="text" /></td>
</tr>
<tr>
<td align="right">BBM Pin</td><td align="left"><input class="input"  id="cms5" value="<?php echo $row['bbmid'];?>"  class="bbmId" name="Text1" type="text" /></td>
</tr>
<tr>
<td align="right">Skype Id</td><td align="left"><input class="input"  id="cms6" value="<?php echo $row['skypeid'];?>"  class="skypeId" name="Text1" type="text" /></td>
</tr>
<tr>
<td align="right">Yahoo MessengerId</td><td align="left"><input class="input"  id="cms7" value="<?php echo $row['yahooid'];?>"   class="yahooId" name="Text1" type="text" /></td>
</tr>

<tr>
<td align="right"></td><td align="left"><input id="cms2" name="Checkbox1" value="1" type="checkbox" <?php if($row['copytips'] == '1') echo "checked='checked'"; ?> />&nbsp;Can Copy Tips</td>
</tr>
<tr>
<td align="right"></td><td align="left"><input id="cms3" name="Checkbox1" value="1" type="checkbox" <?php if($row['status'] == '1') echo "checked='checked'"; ?> />&nbsp;Messenger Activated</td>
</tr>

<tr>
<td align="right"></td><td align="left"><div class="buttonGreen" style="text-shadow:0px 0px 0px white;display:inline-block"  onclick="SaveData('messenger/updateSettings?cid=<?php echo $cid;?>','cms','8','','','ssaved','3');" >Save Settings</div>
<span id="ssaved"></span>
</td>
</tr>

</table>			

