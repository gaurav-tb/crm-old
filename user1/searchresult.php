<?php
include("../include/conFig.php");
$term = $_GET['term'];

$getData = mysql_query("SELECT employee.name, employee.mobile, employee.email, profile.name, employee.status, employee.modifieddate,employee.id FROM employee,profile WHERE  employee.profile = profile.id AND employee.delete = '0' AND employee.name LIKE '%$term%' ORDER BY employee.name",$con) or die(mysql_error());


?>
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th>
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
		<th>Name</th>
		<th>Contact</th>
		<th>Email</th>
		<th>Profile</th>
		<th>Status</th>

	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row[5]));?>">
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[6];?>" /></td>
		<td class="blueSimpletext" onclick="getModule('user/edit?id=<?php echo $row[6];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo $row[0]?>')" style="width: 300px;">
		<?php echo $row[0];?></td>
		<td>
		<?php echo $row[1];?>
		</td>
		<td>
		<?php echo $row[2];?>
		</td>
		
		<td><?php echo $row[3];?></td>
		<td><?php if($row[4] == '1') echo "Active"; else echo "Inactive"; ?></td>
	</tr>
	
	<?php
$i++;
$Maxid = $row[6];
$MaxI = $i;
}
?>
</table>
<div id="moreData">
</div>
<div class="moduleFoot">
		<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
		<span onclick="getModule('user/view','viewContent','manipulateContent','Users')" style="cursor: pointer">
	<img alt="" src="images/back.png" style="vertical-align:middle; width: 6px;" /> 
	Back To List</span>

</div>


