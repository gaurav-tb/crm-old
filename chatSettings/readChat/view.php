<?php
include("../../include/conFig.php");
$set = 0;
?>

<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Read Conversations</td>
			<td align="right" style="width: 70%">
					
			</td>
		</tr>
	</table>
</div>
<div style="background:#eee;padding:10px;line-height:180%">
Conversation Between<br/>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td style="width: 315px">
<select class="input" name="Select1"  style="width: 300px" id="from" onchange="getModule('chatSettings/readChat/getUser?from='+document.getElementById('from').value,'to','','Conversation');document.getElementById('delHistory').style.display='none'">
		<option value="">-Select User-</option>
		<?php
		$getProfile  =mysql_query("SELECT `name`,`id` FROM `user` WHERE `delete` = '0' ORDER BY `name` ASC",$con) or die(mysql_error());
		while($rowProfile = mysql_fetch_array($getProfile))
		{
		?>
		<option value="<?php echo $rowProfile[1];?>"><?php echo $rowProfile[0];?></option>
		
		<?php
		}
		?>

			</select></td><td style="width: 50px;padding-right:15px" align="center">AND
</td><td style="width: 315px">			
<select class="input" name="Select1"  style="width: 300px" id="to">
		<option value="">-Select User 1 First-</option>

			</select></td><td>
<span style="display:inline-block" class="buttonGreen" onclick="if(document.getElementById('from').value == '' || document.getElementById('to').value == ''){alert('Please Select Both The Users.')} else { getModule('chatSettings/readChat/getChat?from='+document.getElementById('from').value+'&to='+document.getElementById('to').value,'directResult','','Conversation');document.getElementById('delHistory').style.display='block';}">Read</span>

</td><td><?php
if(in_array('DELETE_CHAT',$thisPer))
{
?>
<span style="display:inline-block;float:right;margin-right:10px;display:none" title="Delete Chat History" id="delHistory" class="buttonnegetive" onclick="var r=confirm('Are You Sure You Want To Delete The Chat History Between The Selected Users?');if (r==true){getModule('chatSettings/readChat/deleteChat?from='+document.getElementById('from').value+'&to='+document.getElementById('to').value,'','','Delete Conversation')};">Delete History</span>
<?php
}
?>
</td></tr>
</table>
</div>

<div id="directResult" class="form">
	</div>