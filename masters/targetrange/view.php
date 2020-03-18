<?php
include("../../include/conFig.php");
$getData = mysql_query("SELECT targetrange.name,targetrange.fromdate,targetrange.todate,targetrange.modifieddate,employee.name,targetrange.id,`targetrange`.`weeks` FROM targetrange,employee WHERE targetrange.updatedby = employee.id AND targetrange.delete = '0' AND targetrange.id != '1' ORDER BY targetrange.id DESC LIMIT 100",$con) or die(mysql_error());
?>
<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Target Range Master </td>
			<td align="right" style="width: 70%">
			<input class="input" name="Text1" placeholder="Search Target Range" type="text" id="subsearch" /><input class="buttonGreen" name="Button1" style="width: 40px;" type="button" value="Go" onclick="getModule('masters/targetrange/searchresult?term='+document.getElementById('subsearch').value,'directResult','','Searching for '+document.getElementById('subsearch').value+'..')" />&nbsp;&nbsp;
			<?php if(in_array('A_targetrange',$thisPer))
			{
			?>

			<input class="buttonGreen" name="Button1" onclick="getModule('masters/targetrange/new','manipulateContent','viewContent','New Target Range')" type="button" value="+1 New" /><?php } ?>
			<?php if(in_array('D_targetrange',$thisPer))
			{
			?>
			<input id="" class="buttonnegetive" name="Button1" onclick="deleteData('targetrange','Range')" type="button" value="Delete Selected" /><?php } ?>
			</td>
		</tr>
	</table>
</div>
<div id="directResult">
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th style="height: 20px">
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
		<th style="height: 20px">Target Range Name</th>
				<th style="height: 20px">From Date</th>
				<th style="height: 20px">To Date</th>	
				<th style="height: 20px">No. of Weeks</th>	
				
		<th style="height: 20px">Details</th>
	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>">
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[5];?>" /></td>
		<td class="blueSimpletext" onclick="getModule('masters/targetrange/edit?id=<?php echo $row[5];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo $row[0]?>')" style="width: 300px;">
		<?php echo $row[0];?></td>
		<td><?php echo $row[1]; ?></td>
		<td><?php echo $row[2]; ?></td>
		<td><?php echo $row[6]; ?></td>
		<td id="details" style="width: 400px;"><?php echo "Last Updated By ".$row[4]." on ".date("d-m-Y H:i:s",strtotime($row[3]));?>
		</td>
	</tr>
	<?php
$i++;
$Maxid = $row[5];
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
	<div onclick="fetchMore('masters/targetrange/fetchmore');" style="cursor: pointer;padding-top:5px;" id="fetchingDone">
	<img alt="" src="images/more.png" style="vertical-align: middle; width: 6px;" /> 
	More <span id="fetching" style="display: none">Fetching..</span></div>
</div>
</div>
