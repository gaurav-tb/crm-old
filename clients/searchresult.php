<?php
$term = $_GET['term'];
include("../include/conFig.php");
$getData = mysql_query("SELECT employee.name, contact.fname, contact.mobile, contact.phone, city.name, contact.id, contact.lname FROM contact,employee,city WHERE contact.ownerid = employee.id AND contact.city = city.id AND contact.delete = '0' AND contact.converted = '1' AND contact.fname LIKE '$term%' ORDER BY contact.fname" ,$con) or die(mysql_error());


?>
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th style="height: 20px">
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
		<th style="height: 20px">Lead Owner</th>
		<th style="height: 20px">First Name</th>
		<th style="height: 20px">Last Name</th>
		<th style="height: 20px">Mobile</th>
		<th style="height: 20px">Call Back Date</th>
		<th style="height: 20px">Latest Response</th>

	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row[6]));?>">
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[3];?>" /></td>
		<td  style="width: 300px;">
		<?php echo $row[0];?></td>
		<td onclick="getModule('leads/edit?id=<?php echo $row[5];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','Fetching Data..')" class="blueSimpletext">
		<?php echo $row[1];?>
		</td>
		<td style="width:100px">
		<?php echo $row[6];?>
		</td>

		<td>
		<?php echo $row[2];?>
		</td>
				<td>
		<?php echo $row[3];?>
		</td>
		<td><?php echo $row[4];?></td></tr>
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
		<span onclick="getModule('clients/view','viewContent','manipulateContent','Clients')" style="cursor: pointer">
	<img alt="" src="images/back.png" style="vertical-align:middle; width: 6px;" /> 
	Back To List</span>

</div>


