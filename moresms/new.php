<?php 
include("../include/conFig.php");
$getServ = mysql_query("SELECT * FROM `category` WHERE `delete` = '0' AND `id` != '1'") or die(mysql_error());
?>
<div class="moduleHeading" style="margin:0px;">
<table cellpadding="0" cellspacing="0" width="100%" class="fetch">
<tr>
	<td align="left" class="blueSimpletext">Add More Numbers</td>
</tr>
</table>
</div>
<div style="background:#eee;padding:10px;line-height:180%">
Please Select Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<select class="input" name="Select1"  style="width: 390px" onchange="getModule('moresms/getNos?category='+this.value,'moreData','','')">
		<option value="">Select Service category</option>
		<?php
		$getC  =mysql_query("SELECT `name`,`id` FROM `category` WHERE `delete` = '0' AND `id` != '1' ORDER BY `name` ASC",$con) or die(mysql_error());
		while($rowC = mysql_fetch_array($getC))
		{
		?>
		<option value="<?php echo $rowC[1];?>"><?php echo $rowC[0];?></option>
		
		<?php
		}
		?>

			</select>
</div>
<div id="moreData" style="height: 550px; width: 98%; overflow: auto; background: #FFFFFF; padding: 5px 0px 5px 20px; -moz-box-shadow: inset 0 0 3px 2px #ccc; -webkit-box-shadow: inset 0 0 3px 2px #ccc; box-shadow: inset 0 0 10px 2px #ccc;">
		</div>

