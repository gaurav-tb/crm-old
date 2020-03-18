<?php 
include("../include/conFig.php");
$invid=$_GET['invid'];
$cid=$_GET['cid'];
$pending=$_GET['pending'];

$getData=mysql_query("SELECT `note`,id FROM `noteline` WHERE `cid`='$cid' AND `subject`='PendingRequest'",$con) or die(mysql_error());
$row=mysql_fetch_array($getData);
$noteId=$row[1];
$notes = $row[0];
?>
<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 100%">Please give reason for Pending.<span style="text-transform:capitalize"><?php echo $_GET['name'];?></span></td>
			</td>
		</tr>
	</table>
</div>
<div>
<div class=form>
	<table width="100%" cellpadding="0" cellspacing="10">
		<tr>
		<td align="right" style="">
		</td>
		<td >
		<textarea name="req" id="opt0" class="input"  style="width: 700px;height:110px;"><?php echo $row[0] ?></textarea></td>
		</td>
		</tr>		
		
		<tr>
		<td align="right" style="">
		</td>
		<td>
		<?php if($pending!=1) { ?>
		<input name="Button2" type="button" value="Click For Pending" class="buttonGreen" onclick="SaveData('billing/savependingreason?invid=<?php echo $invid;?>&cid=<?php echo $cid;?>','opt','1','','','','2');document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','')" />&nbsp;&nbsp;
		<?php } else { ?>
		<input name="Button2" type="button" value="Client Is on Pending" class="buttonGreen"  />&nbsp;&nbsp;
		<?php } ?>
		</td>
		</tr>	
	    </table>
        </div>
        </div>
