<?php
include("../include/conFig.php");
$cid = $_GET['cid'];
$getData = mysql_query("SELECT noteline.subject,noteline.note,employee.name,noteline.createdate FROM noteline,employee WHERE noteline.cid = '$cid' AND noteline.updatedby = employee.id AND noteline.delete = '0' ORDER BY noteline.id DESC",$con) or die(mysql_error());
$p=0;
$maxl=0;
$maxr=0;
while($row = mysql_fetch_array($getData))
{
$chk = $p%2;


	if($chk == 0)
	{
		$lArray[] .= $row[2]."brkline".$row[0]."brkline".$row[3]."brkline".$row[1];
		$maxl++;
	}
	else
	{
		$RArray[] .= $row[2]."brkline".$row[0]."brkline".$row[3]."brkline".$row[1];
		$maxr++;
	}
$p++;	
}
$maxl = $maxl-1;
$maxr = $maxr;
?>
<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">NoteLine&nbsp;
			<input id="totalRight" name="Text1" style="display: none" type="text" value="<?php echo $maxl;?>" />
			<input id="totalLeft" name="Text1" style="display: none" type="text" value="<?php echo $maxr;?>" />
			</td>
		</tr>
	</table>
</div>
<div style="height:650px;overflow:auto">
<div style="background: #E7EBF2 url('images/noteline-back.png') repeat-y scroll center; padding: 10px;text-align:left">
	<div style="padding: 10px; background: #fff;border:1px #ccc solid">
		<strong><span style="color: #3B5998">Add New Note</span></strong> <br />
		<select id="ntl0" class="input" name="Select1" style="width: 100%">
		<option value="">Select Note Type</option>
		<option value="Call">Call</option>
		<option value="Meeting">Meeting</option>
		<option value="Visit">Visit</option>
		</select><br />
		<textarea id="ntl1" class="input" cols="20" name="TextArea1" rows="2" style="width: 98%; height: 50px;"></textarea>
		<div style="float: left">
			<input class="buttonBlue" name="Button1" onclick="SaveData('noteline/save?cid=<?php echo $cid;?>','ntl','2','','','','3')" type="button" value="Add Note" style="width:100px;" />
		</div>
		<br />
		<br />
		<br />
	</div>


	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 48%" valign="top"><?php
			$t=0;
			foreach($lArray as $val)
			{
				$temp = explode("brkline",$val);
				?>
			<div id="noteR<?php echo $t;?>" class="left">
				<div style="float: right; margin-top: 20px; margin-right: -8px;">
					<img alt="" src="images/ntarr.png" /> </div>
				<div style="padding: 10px;">
					<?php
				if($temp[1]=='Call')
				{
				?><img alt="" src="images/call.png" style="width: 15px; vertical-align: middle" />&nbsp;&nbsp;
					<?php
				}
				else
				{
				?><img alt="" src="images/visit.png" style="width: 15px;; vertical-align: middle" />&nbsp;&nbsp;
					<?php
				}
				?><strong><span style="color: #3B5998"><?php echo $temp[0];?>
					</span></strong>had a <strong><?php echo $temp[1];?>
					</strong>
					<div style="float: right; font-size: 11px;; color: #888; font-style: italic">
						<?php echo $temp[2];?></div>
					<br />
					<div style="border-top: 1px #eee solid; padding-top: 10px; margin-top: 5px;">
						<?php echo $temp[3];?></div>
				</div>
			</div>
			<?php
				$t++;;
			}
			?></td>
			<td align="center" style="width: 4%" valign="top"><center>
			<div id="imgHere" style="position: relative">
				<img alt="" src="images/theDot.png" style="position: absolute; top: 40px; left: 35%" />
			</div>
			</center></td>
			<td align="left" style="width: 48%" valign="top">
			
			<div style="height:20px;font-size:18px;font-weight:bold;padding:10px 0px;margin-top:20px;" id="noteL0">Noteline Index For <?php echo $_GET['name'];?></div>
			<?php
				$t=1;
			foreach($RArray as $val)
			{
				$temp = explode("brkline",$val);
				?>
			<div id="noteL<?php echo $t;?>" class="right">
				<div style="float: left; margin-top: 20px; margin-left: -8px;">
					<img alt="" src="images/ntarl.png" /> </div>
				<div style="padding: 10px;">
					<?php
				if($temp[1]=='Call')
				{
				?><img alt="" src="images/call.png" style="width: 15px; vertical-align: middle" />&nbsp;&nbsp;
					<?php
				}
				else
				{
				?><img alt="" src="images/visit.png" style="width: 15px;; vertical-align: middle" />&nbsp;&nbsp;
					<?php
				}
				?><strong><span style="color: #3B5998"><?php echo $temp[0];?>
					</span></strong>had a <strong><?php echo $temp[1];?>
					</strong>
					<div style="float: right; font-size: 11px;; color: #888; font-style: italic">
						<?php echo $temp[2];?></div>
					<br />
					<div style="border-top: 1px #eee solid; padding-top: 10px; margin-top: 5px;">
						<?php echo $temp[3];?></div>
				</div>
			</div>
			<?php
				$t++;
			}
			?></td>
		</tr>
	</table>
	<br/><br/><br/><br/>
	</div>
</div>
