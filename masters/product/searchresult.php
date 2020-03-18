<?php
$term = $_GET['term'];
include("../../include/conFig.php");
$getData = mysql_query("SELECT product.name,product.code,product.description,product.amount,product.unit,product.moneyback,product.quantity,product.modifieddate,employee.name,product.id FROM product,employee WHERE product.updatedby = employee.id AND product.delete = '0' AND product.id != '1' AND product.name LIKE '%$term%'",$con) or die(mysql_error());


?>
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th>
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
		<th>Product Name</th>
				<th>Code</th>
						<th>Amount</th>


		<th>Description</th>
		<th>Details</th>
	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	<tr id="fetchRow<?php echo $i;?>">
			<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[9];?>" /></td>
		<td class="blueSimpletext" onclick="getModule('masters/product/edit?id=<?php echo $row[9];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','Fetching Data..')" style="width: 300px;">
		<?php echo $row[0];?></td>
		<td><?php echo $row[1];?></td>

		<td><?php echo $row[3];?></td>

		<td><?php echo substr($row[2],0,50)."..";?></td>
		<td id="details" style="width: 400px;"><?php echo "Last Updated By ".$row[8]." on ".date("d-m-Y H:i:s",strtotime($row[7]));?>
		</td>
	</tr>
	<?php
$i++;
$Maxid = $row[9];
$MaxI = $i;

}
?>
</table>
<div id="moreData">
</div>
<div class="moduleFoot">
		<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
		<span onclick="getModule('masters/product/view','viewContent','manipulateContent','Product')" style="cursor: pointer">
	<img alt="" src="images/back.png" style="vertical-align:middle; width: 6px;" /> 
	Back To List</span>

</div>


