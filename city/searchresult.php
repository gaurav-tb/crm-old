<?php
$term = $_GET['term'];
include("../../include/conFig.php");
$getData = mysql_query("SELECT city.name,city.modifieddate,employee.name,city.id ,state.name FROM city,employee,state WHERE city.updatedby = employee.id AND  city.state= state.id AND city.delete = '0' AND city.id != '1' AND city.name LIKE '$term%' ORDER BY city.name ",$con) or die(mysql_error());


?>
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th>
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
		<th>City Name</th>
				<th>State Name</th>

		<th>Details</th>
	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	<tr id="fetchRow<?php echo $i;?>">
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[3];?>" /></td>
		<td onclick="getModule('masters/city/edit?id=<?php echo $row[3];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','Fetching Data..')" style="width: 300px;">
		<?php echo $row[0];?></td>
		<td><?php echo $row[4]; ?></td>
		<td id="details" style="width: 400px;"><?php echo "Last Updated By ".$row[2]." on ".date("d-m-Y H:i:s",strtotime($row[1]));?>
		</td>
	</tr>
	<?php
$i++;
$Maxid = $row[3];
$MaxI = $i;

}
?>
</table>
<div id="moreData">
</div>
<div class="moduleFoot">
		<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
		<span onclick="getModule('masters/city/view','viewContent','manipulateContent','Cities')" style="cursor: pointer">
	<img alt="" src="images/back.png" style="vertical-align:middle; width: 6px;" /> 
	Back To List</span>

</div>


