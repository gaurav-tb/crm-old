<?php
include("../include/conFig.php");
$getData = mysql_query("SELECT employee.name, contact.fname, contact.lname, contact.mobile, product.name, servicecall.fromdate, servicecall.todate, contact.id,servicecall.id FROM employee,contact,servicecall,product WHERE contact.ownerid = employee.id AND product.id = servicecall.product and servicecall.cid = contact.id AND servicecall.delete='0' AND servicecall.approved = '2' ",$con) or die(mysql_error());
?>

<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th style="height: 20px">
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
		<th style="height: 20px">Lead Owner</th>
		<th style="height: 20px">Name</th>
		<th style="height: 20px">Mobile</th>
		<th style="height: 20px">Product</th>
		<th style="height: 20px">Start Date</th>
		<th style="height: 20px">End Date</th>
		
	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row[6]));?>">
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[8];?>" /></td>
		<td  onclick="getModule('clients/edit?id=<?php echo $row[8];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','Fetching Data..')" style="width: 300px;">
		<?php echo $row[0];?></td>
		<td >
		<?php echo $row[1]." ".$row[2];?>
		</td>
		<td>
		<?php echo $row[3];?>
		</td>
		<td>
		<?php echo $row[4];?>
		</td>
		<td><?php echo $row[5];?>
		</td>
		<td><?php echo $row[6];?>
		</td>	
		
	
	</tr>
	<?php
$i++;
$Maxid = $row[8];
$MaxI = $i;
}
?>
</table>
<div id="moreData">
</div>
<div class="moduleFoot">
	<div style="float: right;">
		<select id="fetchCount" style="vertical-align:middle" class="input" name="Select1" onchange="fetchMore('clients/fetchmore');">
		<option value="100">Fetch 100 Records</option>
		<option value="200">Fetch 200 Records</option>
		<option value="500">Fetch 500 Records</option>
		<option value="1000">Fetch 1000 Records</option>
		<option value="0">Fetch All Records</option>
		</select> </div>
	<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
	<div onclick="fetchMore('clients/fetchmore');" style="cursor: pointer;padding-top:5px;" id="fetchingDone">
	<img alt="" src="images/more.png" style="vertical-align: middle; width: 6px;" /> 
	More <span id="fetching" style="display: none">Fetching..</span></div>
</div>

