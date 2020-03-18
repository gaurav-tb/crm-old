<?php 
include("../include/conFig.php");
$invid=$_GET['invid'];
$cid=$_GET['cid'];
?>
<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 100%">Please give reason for rejection.<span style="text-transform:capitalize"><?php echo $_GET['name'];?></span></td>
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
				<textarea name="req" id="opt0" class="input"  style="width: 700px;height:110px;"></textarea></td>
			</td>
		</tr>		
		
		<tr>
			<td align="right" style="">
			</td>
			<td>
				<input name="Button2" type="button" value="Click to reject" class="buttonGreen" onclick="SaveData('billing/saverejectreason?invid=<?php echo $invid;?>&cid=<?php echo $cid;?>','opt','1','','','','2');document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','')" />&nbsp;&nbsp;
			</td>
		</tr>	
	</table>
</div>
</div>
