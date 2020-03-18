<?php
include("../../include/conFigclient.php");
?>
<center style="height: 600px;; width: 100%; background: #fff;">
<div class="moduleHeading" style="margin: 0px; text-align: left">
	Settings </div>
<br />
<br />
<div style="float: left; margin-top: 10px; margin-left: 50px; text-align: justify; line-height: 18px; font-family: Arial, Helvetica, sans-serif">
	<p style="font-size: 18px; color: #dd4b39;"><b>Change your Password</b></p>
	Enter a new password for <b><?php echo $loggeduser;?></b>We highly recommend<br />
	you create a unique password - one that you don&#39;t<br />
	use for any other websites. <br />
</div>
<div style="background: #eee; padding: 5px; width: 300px; -moz-box-shadow: 0 0 5px #222; float: right; margin-right: 50px; margin-top: 30px; -webkit-box-shadow: 0 0 5px #222;">
	<table cellpadding="0" cellspacing="0" style="" width="250px">
		<tr>
			<td>
			<table cellpadding="8" cellspacing="0" width="100%">
			<tr id="response">
			</tr>
				<tr>
					<td style="font-size: 12px"><b>Current Password</b> <br />
					<input id="oldp" class="input" style="height: 15px" type="password" />
					</td>
				</tr>
				<tr>
					<td style="font-size: 12px"><b>New Password</b> <br />
					<input id="newp" class="input" name="newpassword" style="height: 15px" type="password" />
					</td>
				</tr>
				<tr>
					<td style="font-size: 12px"><b>Confirm New Password</b>
					<br />
					<input id="conp" class="input" name="confirmpassword" style="height: 15px" type="password" />
					</td>
				</tr>
				<tr>
					<td align="left">
					<input class="buttonBlue" name="Update" onclick="getModule('checkPassword?o='+document.getElementById('oldp').value+'&amp;n='+document.getElementById('newp').value+'&amp;c='+document.getElementById('conp').value,'response','','Change Password')" type="button" value="Change Password" />
					<input class="buttonnegetive" name="cancel" type="button" value="Cancel" />
					</td>
				</tr>
			</table>
			</td>
		</tr>
	</table>
</div>
</center>