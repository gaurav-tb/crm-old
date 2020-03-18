<?php 
include("../include/conFig.php");
$cid=$_GET['cid'];
$researchid=$_GET['researchid'];


?>
<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 100%">Please give reason of rejection for  <span style="text-transform:capitalize"><?php echo $_GET['name'].".";?></span></td>
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
				<input name="Button2" type="button" value="Click to reject" class="buttonGreen" onclick="SaveData('billing/savepremiumreject?researchid=<?php echo $researchid ?>&cid=<?php echo $cid;?>','opt','1','','','','2');document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','')" />&nbsp;&nbsp;
			</td>
		</tr>	
	</table>
</div>
</div>
