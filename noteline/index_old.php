<?php
include("../include/conFig.php");
$cid = 1;
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
			<input name="Text1" type="text" id="totalRight" value="<?php echo $maxl;?>" style="display:none" />
			<input name="Text1" type="text" id="totalLeft" value="<?php echo $maxr;?>" style="display:none"  />			
		</tr>
	</table>
</div>
<div id="directResult" style="background:#E7EBF2 url('images/noteline-back.png') repeat-y scroll center;padding: 10px;">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 48%" valign="top">
			
			<?php
			$t=0;
			foreach($lArray as $val)
			{
				$temp = explode("brkline",$val);
				?>
				<div class="left" id="noteR<?php echo $t;?>">
				<div style="float:right;margin-top:20px;margin-right:-8px;">
				
				<img src="images/ntarr.png" alt=""/>			</div>
				<div style="padding:10px;">
				<?php
				if($temp[1]=='Call')
				{
				?>
				<img src="images/call.png" style="width:15px;vertical-align:middle" alt=""/>&nbsp;&nbsp;
				<?php
				}
				else
				{
				?>
				<img src="images/visit.png" style="width:15px;;vertical-align:middle" alt=""/>&nbsp;&nbsp;
				<?php
				}
				?>
				
				<strong><span style="color:#3B5998"><?php echo $temp[0];?></span></strong> had a 
					<strong> <?php echo $temp[1];?>
					</strong>
				<div style="float:right;font-size:11px;;color:#888;font-style:italic"><?php echo $temp[2];?></div>
				<br/>
				<div style="border-top:1px #eee solid;padding-top:10px;margin-top:5px;">
				<?php echo $temp[3];?></div>
				</div>
				
				</div>
				
				<?php
				$t++;;
			}
			?>
			
			
	
		</td>
			<td align="center" style="width: 4%" valign="top">
			<center>
			<div style="position:relative" id="imgHere">
			<img src="images/theDot.png" alt="" style="position:absolute;top:40px;left:35%"/>
			</div></center>
						</td>
			<td align="left" style="width: 48%" valign="top">
		<div class="right" id="noteL0">
				<div style="float:left;margin-top:20px;margin-left:-8px;">
				
				<img src="images/ntarl.png" alt=""/>			</div>
				<div style="padding:10px;">
				<strong><span style="color:#3B5998">Add New Note</span></strong>
				<br/>
	
			<div style="padding:5px;background:#eee;">
			<select name="Select1" class="input" style="width:100%" id="ntl0">
				<option value="">Select Note Type</option>
				<option value="Call">Call</option>
				<option value="Meeting">Meeting</option>
				<option value="Visit">Visit</option>
			</select><br/>
<textarea name="TextArea1" cols="20" rows="2" style="width:98%;height:100px;" class="input"  id="ntl1"></textarea>
<div style="float:right">
<input name="Button1" type="button" value="+1 Add" class="button" onclick="SaveData('noteline/save?cid=<?php echo $cid;?>','ntl','2','','','','3')" />

</div>
<br/><br/><br/>
</div>
				
				</div></div>
				<?php
				$t=1;
			foreach($RArray as $val)
			{
				$temp = explode("brkline",$val);
				?>
	
				<div class="right" id="noteL<?php echo $t;?>">
				<div style="float:left;margin-top:20px;margin-left:-8px;">
				
				<img src="images/ntarl.png" alt=""/>			</div>
				<div style="padding:10px;">
					<?php
				if($temp[1]=='Call')
				{
				?>
				<img src="images/call.png" style="width:15px;vertical-align:middle" alt=""/>&nbsp;&nbsp;
				<?php
				}
				else
				{
				?>
				<img src="images/visit.png" style="width:15px;;vertical-align:middle" alt=""/>&nbsp;&nbsp;
				<?php
				}
				?>

				<strong><span style="color:#3B5998"><?php echo $temp[0];?></span></strong> had a 
					<strong> <?php echo $temp[1];?>
					</strong>
			<div style="float:right;font-size:11px;;color:#888;font-style:italic"><?php echo $temp[2];?></div>
				<br/>
				<div style="border-top:1px #eee solid;padding-top:10px;margin-top:5px;">
				<?php echo $temp[3];?></div>
				</div>
				
				</div>
				
				<?php
				$t++;
			}
			?>

		
		
			
			
						</td>
		</tr>
	</table>
</div>
