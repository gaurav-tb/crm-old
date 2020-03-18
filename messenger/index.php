<?php
include("../include/conFig.php");
?>
<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Send Tips </td>
			<td align="right" style="width: 70%">&nbsp;
			<div class="buttonGreen leftRound" onclick="getModule('archives/new','manipulatemoodleContent','viewmoodleContent','Tips Archive')" style="display: inline-block">
				Tips Archive</div>			<!--<input id="" class="buttonnegetive" name="Button1" onclick="deleteData('leads','Leads')" type="button" value="Delete Selected" /> -->
			</td>
		</tr>
	</table>
</div>
<div id="todaysTips" style="height: 350px; width: 98%; overflow: auto; background: #FFFFFF; padding: 5px 0px 5px 20px; -moz-box-shadow: inset 0 0 3px 2px #ccc; -webkit-box-shadow: inset 0 0 3px 2px #ccc; box-shadow: inset 0 0 10px 2px #ccc;">
	<?php
	//echo "SELECT * FROM `tips` WHERE `date` = '$date'";
	$getTips = mysql_query("SELECT * FROM `tips` WHERE `date` = '$date'",$con) or die(mysql_error());
	while($rowTip = mysql_fetch_array($getTips))
	{
	?>
	<div class="tip">
		<div style="float: right; font-size: 11px; font-weight: normal; color: #999; text-align: right">
			Today, <?php echo $rowTip['time'];?><br />
			<span style="color: #73AD59; font-style: normal"><?php echo $rowTip['servicename'];?>
			</span></div><span style="color:#000;font-weight:bold"><?php echo $rowTip['sentbyname'];?>:&nbsp;</span>
		<?php echo $rowTip['tip'];?><br />
		<br />
	</div>
	<?php
	}
	?>

</div>
<div style="overflow:auto;overflow:scroll">
	<table cellpadding="10" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 80%; border-right: 1px #ccc solid" valign="top">
			
			<div style="float:right">
			<select id="tem" name="Select1" onchange="document.getElementById('ttip').value=this.value" class="input">
				<option value="">Select Template</option>
				
				
<?php
$getCity = mysql_query("SELECT `template`,`name` FROM `template` WHERE `delete` = '0' AND `id` != '1' AND `messenger` = '1'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[0];?>"><?php echo $rowCity[1];?></option>
<?php
}
?>
			

				</select>
			</div>
			
			<select id="tprefix" class="input" name="Select1" style="width: 211px" onchange="getPrefix(this.value);">
			<option value="">Select Prefix</option>

			<?php
			$getCat = mysql_query("SELECT `name` FROM `prefix`",$con) or die(mysql_error());
			while($rowCat = mysql_fetch_array($getCat))
			{
			echo '<option value="'.$rowCat[0].'">'.$rowCat[0].'</option>';
			}
		
			?>
			<option value="other">Other</option>
			</select>&nbsp;&nbsp;<span id="oprefix" style="display:none"><input id="oprefixVal" class="input" name="Text1" type="text" placeholder="Enter Prefix Here" /></span><br />
			<textarea id="ttip" class="input" name="TextArea1" onkeypress="sendTip(event,'<?php echo $loggedname;?>');checkChar()" onkeyup="checkChar()" onblur="checkChar()"  style="width: 98%; height: 82px"></textarea>
			<br />
			Suffix:&nbsp;<input id="tsuffix" class="input" name="Text1" style="width: 50%" type="text" value="" />
			<input name="Text1" type="text" id="txtMessageCount" class="input" readonly="readonly" value="0  Character, 1 SMS"/>
			</td>
			
			<td align="left" valign="top"><strong>Please Select Services<br />
			<br />
			</strong>
			<div style="height:200px;overflow:auto">
			<?php
			$i=0;
$getCategory = mysql_query("SELECT `name`,`id` FROM `category` WHERE `delete` = '0' AND `id` != '1'",$con) or die(mysql_error());
while($row = mysql_fetch_array($getCategory))
{
?><input name="Checkbox1" type="checkbox" id="servTip<?php echo $i;?>" title="<?php echo $row[0];?>" value="<?php echo $row[1];?>" /> <?php echo $row[0];?><br />
			<?php
$i++;
}
?>
<input name="Text1" type="text" value="<?php echo $i;?>" style="display:none" id="maxServ" />
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
</div>
</td>
		</tr>
	</table>
</div>
