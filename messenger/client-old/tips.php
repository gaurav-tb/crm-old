<?php
include("../../include/conFigclient.php");
?>
<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">My Tips </td>
			<td align="right" style="width: 70%">&nbsp;
			<div class="buttonGreen" style="text-shadow:0px 0px 0px white;display:inline-block" onclick="getModule('tips','manipulateContent','viewContent','Laoding Dashboard')">
				Reload</div>			<!--<input id="" class="buttonnegetive" name="Button1" onclick="deleteData('leads','Leads')" type="button" value="Delete Selected" /> -->
			</td>
		</tr>
	</table>
</div>
<div id="todaysTips" style="height: 500px; width: 98%;  font-size:12px; overflow: auto; background: #FFFFFF; padding: 5px 0px 5px 20px; -moz-box-shadow: inset 0 0 3px 2px #ccc; -webkit-box-shadow: inset 0 0 3px 2px #ccc; box-shadow: inset 0 0 10px 2px #ccc;">
	<?php
	$getSubs = mysql_query("SELECT category.id FROM category,servicecall,product WHERE category.id = product.category AND servicecall.product = product.id AND servicecall.cid = '$loggeduserid' AND servicecall.messenger= '1' AND servicecall.fromdate <= '$date' AND servicecall.todate >= '$date' AND servicecall.approved = '1'",$con) or die(mysql_error());
	$numB = mysql_num_rows($getSubs);
	while($rowSub = mysql_fetch_array($getSubs))
	{
		if(!in_array($rowSub[0],$already))
		{
			$thisP = "-".$rowSub[0]."-";
			$pstr .= "`services` LIKE '%".$thisP."%' OR ";
			$already[] .= $rowSub[0];
		}
	}
	
	if($numB > 0)
	{
	$query = "SELECT * FROM `tips` WHERE `date` = '$date' AND ".$pstr;
	$query= substr($query,0,-3);
	$getTips = mysql_query($query,$con) or die(mysql_error());
	while($rowTip = mysql_fetch_array($getTips))
	{
	?>
	<div class="tip">
		<div style="float: right; font-size: 11px; font-weight: normal; color: #999; text-align: right">
			Today, <?php echo $rowTip['time'];?><br />
			<span style="color: #73AD59; font-style: normal"><?php echo $rowTip['servicename'];?>
			</span></div><?php echo $rowTip['tip'];?><br />
		<br />
	</div>
	<?php
	}
	}
	?>
</div>
