<?php 
include("../include/conFig.php");
$invid=$_GET['invid'];
$cid=$_GET['cid'];
$i=$_GET['i'];
$getLastData = mysql_query("SELECT `code`,`id` FROM `contact` where `code` != '' AND `code` != 'TB' order by `id` desc ",$con) or die(mysql_error());
$rowLast = mysql_fetch_assoc($getLastData);
$privousCode = (!empty($rowLast['code'])) ? str_ireplace("TB","",$rowLast['code']) : '';
$newCode = $privousCode+1;

$getData = mysql_query("SELECT `code` FROM `contact` WHERE `id` = '$cid'",$con) or die(mysql_error());
$row = mysql_fetch_assoc($getData);
$code = (!empty($row['code'])) ? str_ireplace("TB","",$row['code']) : '';
if(empty($code)) {
	$code = $newCode;
}
?>
<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 100%">Please enter the client code for <span style="text-transform:capitalize"><?php echo $_GET['name'];?></span></td>
			</td>
		</tr>
	</table>
</div>
<div>
<div class=form>
	<table width="100%" cellpadding="0" cellspacing="10">
		<tr>
			<td align="right" style="">
				Client Code *
			</td>
			<td >
				<span class="clientcodeinput">TB<input type="text" name="req" id="opt0" class="" value="<?php echo $code; ?>"  onKeyPress="if(this.value.length==5) return false;"></span>
			</td>
		</tr>		
		
		<tr>
			<td align="right" style="">
			</td>
			<td>
				<input name="Button2" type="button" value="Click To Approve" class="buttonGreen" onclick="SaveData('billing/updatePay?cid=<?php echo $cid;?>&invid=<?php echo $invid;?>','opt','1','','','','2');document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','');$('#fetchRow<?php echo $i;?>').hide();" />&nbsp;&nbsp;
			</td>
		</tr>	
	</table>
</div>
</div>
