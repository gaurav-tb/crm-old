<?php
$term = $_GET['term'];
include("../../include/conFig.php");
//echo "SELECT country.name,country.modifieddate,employee.name,country.id FROM country,employee WHERE country.updatedby = employee.id AND country.delete = '0' AND country.name LIKE '$term%' ORDER BY country.name";
$getData = mysql_query("SELECT country.name,country.modifieddate,employee.name,country.id FROM country,employee WHERE country.updatedby = employee.id AND country.delete = '0' AND country.id != '1' AND country.name LIKE '$term%' ORDER BY country.name",$con) or die(mysql_error());


?>

<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th>
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
		<th>Country Name</th>
		<th>Update By</th>
	
	</tr>
		<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>

	<tr id="fetchRow<?php echo $i;?>">
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[3];?>" /></td>
		<td class="blueSimpletext" onclick="getModule('masters/country/edit?id=<?php echo $row[3];?>&i=<?php echo $i;?>&type=search','manipulateContent','viewContent','Fetching Data..')" style="width: 300px;">
		<?php echo $row[0];?>
		</td>
	
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
		<span onclick="getModule('masters/country/view','viewContent','manipulateContent','Countries')" style="cursor: pointer">
	<img alt="" src="../leadsource/images/back.png" style="vertical-align:middle; width: 6px;" /> 
	Back To List</span>

</div>


