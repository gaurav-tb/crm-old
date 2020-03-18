<?php
$term = $_GET['term'];
include("../../include/conFig.php");
$getData = mysql_query("SELECT targetrange.name,targetrange.fromdate,targetrange.todate,targetrange.modifieddate,employee.name,targetrange.id FROM targetrange,employee WHERE targetrange.updatedby = employee.id AND targetrange.delete = '0' AND targetrange.id != '1' AND targetrange.name LIKE '$term%' ORDER BY targetrange.name ",$con) or die(mysql_error());


?>
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th style="height: 20px">
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
		<th style="height: 20px">Target Range Name</th>
				<th style="height: 20px">From Date</th>
				<th style="height: 20px">To Date</th>	
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
		<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
		<span onclick="getModule('masters/targetrange/view','viewContent','manipulateContent','Cities')" style="cursor: pointer">
	<img alt="" src="images/back.png" style="vertical-align:middle; width: 6px;" /> 
	Back To List</span>

</div>


