<?php
include("../../include/conFig.php");
//$getData = mysql_query("SELECT allotmentrules.id, p1.name , p2.name FROM allotmentrules,profile AS p1,profile AS p2 WHERE p1.id = allotmentrules.from AND p2.id = allotmentrules.to AND allotmentrules.delete = '0' ORDER BY allotmentrules.id DESC LIMIT 100",$con) or die(mysql_error());
?>
<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Allotment Rules</td>
			<td align="right" style="width: 70%">
			&nbsp;&nbsp;
			<?php if(in_array('A_allot',$thisPer))
			{
			?>

			<input class="buttonGreen" name="Button1" onclick="getModule('masters/allotmentrules/new','manipulateContent','viewContent','New Allotment Rule')" type="button" value="+1 New" /><?php } ?>
			<?php if(in_array('D_allot',$thisPer))
			{
			?>
			<input id="" class="buttonnegetive" name="Button1" onclick="deleteData('allotmentrules','Allotment Rule')" type="button" value="Delete Selected" /><?php } ?>
			</td>
		</tr>
	</table>
</div>
<div id="directResult">
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th>
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
				<th>From Profile</th>
				<th>To Profile</th>	
			</tr>
	<?php
$i=0;
$getData = mysql_query("SELECT profile.name,allotmentrules.to,allotmentrules.id FROM allotmentrules,profile  WHERE allotmentrules.from = profile.id AND allotmentrules.delete = '0' ORDER BY allotmentrules.id DESC LIMIT 100",$con) or die(mysql_error());
while($row = mysql_fetch_array($getData))
{
$toProfile = explode(',',$row[1]);
$toPro = str_ireplace('-','',$toProfile);
$toProfiles = '';
	foreach($toPro as $val)
	{
		if($val != '')
		{
		$getToProfiles = mysql_query("SELECT `name` FROM `profile` WHERE `id` = '$val' AND `delete` = '0'",$con) or die(mysql_error()); 
		$rowTo =  mysql_fetch_array($getToProfiles);
		$toProfiles .= $rowTo[0].", ";
		}
	}
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>">
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[2];?>" /></td>
		<td onclick="getModule('masters/allotmentrules/edit?id=<?php echo $row[2];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo $row[0]?>')" style="width: 300px;">
		<?php echo $row[0];?></td>
		<td><?php echo substr($toProfiles,0,-2); ?></td>
	</tr>
	<?php
$i++;
$Maxid = $row[2];
$MaxI = $i;
}
?>
</table>
<div id="moreData">
</div>
<div class="moduleFoot">
	<div style="float: right;">
		&nbsp;</div>
	<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
	<div onclick="fetchMore('masters/allotmentrules/fetchmore');" style="cursor: pointer;padding-top:5px;" id="fetchingDone">
	<img alt="" src="images/more.png" style="vertical-align: middle; width: 6px;" /> 
	More <span id="fetching" style="display: none">Fetching..</span></div>
</div>
</div>
