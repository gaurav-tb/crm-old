<?php
include("../../include/conFig.php");
if($_GET['sortby'] != "")
{
$sortby = $_GET['sortby'];
$sorttype = $_GET['sorttype'];
$sql = "SELECT product.name,product.code,product.description,product.amount,product.unit,product.moneyback,product.quantity,product.modifieddate,employee.name,product.id FROM product,employee WHERE product.updatedby = employee.id AND product.delete = '0' AND product.id != '1' ORDER BY ".$sortby." ".$sorttype." LIMIT 100";
}
else
{
$sql = "SELECT product.name,product.code,product.description,product.amount,product.unit,product.moneyback,product.quantity,product.modifieddate,employee.name,product.id FROM product,employee WHERE product.updatedby = employee.id AND product.delete = '0' AND product.id != '1' ORDER BY product.id DESC LIMIT 100";
}
$getData = mysql_query($sql,$con) or die(mysql_error());

?>
<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 15%">Product Master </td>
			<td align="right" style="width: 85%">
			<span style="font-size:12px" class="blueSimpletext">Sort By</span>
		<select id="sortby" name="Select1" class="input" style="width:100px">
		<option <?php if($_GET['sortby'] == 'product.name'){echo 'selected = selected';}?> value="product.name">Name</option>
		<option <?php if($_GET['sortby'] == 'product.description'){echo 'selected = selected';}?> value="product.description">Description</option>
		</select>&nbsp;
			<select id="sorttype" name="Select2" class="input" style="width:108px">
			<option <?php if($_GET['sorttype'] == 'ASC'){echo 'selected = selected';}?> value="ASC">Ascending</option>
				<option <?php if($_GET['sorttype'] == 'DESC'){echo 'selected = selected';}?> value="DESC">Descending</option>

			</select>
			<input class="buttonGreen" name="Button1" style="width: 40px;" type="button" value="Go" onclick="getModule('masters/product/view?sortby='+document.getElementById('sortby').value+'&sorttype='+document.getElementById('sorttype').value,'viewContent','','')" />
&nbsp;&nbsp;
			<input class="input" name="Text1" placeholder="Search Product" type="text" id="subsearch" /><input class="buttonGreen" name="Button1" style="width: 40px;" type="button" value="Go" onclick="getModule('masters/product/searchresult?term='+document.getElementById('subsearch').value,'directResult','','Searching for '+document.getElementById('subsearch').value+'..')" />&nbsp;&nbsp;
			<?php  if(in_array('A_product',$thisPer))
			{
			?>

			<input class="buttonGreen" name="Button1" onclick="getModule('masters/product/new','manipulateContent','viewContent','Product')" type="button" value="+1 New" /><?php } ?>

			
			<?php  if(in_array('D_product',$thisPer))
			{
			?>
			<input id="" class="buttonnegetive" name="Button1" onclick="deleteData('product','Product')" type="button" value="Delete Selected" /><?php } ?>
			</td>
		</tr>
	</table>
</div>
<div id="directResult" class="form">
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
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>">
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
	<div style="float: right;">
		&nbsp;</div>
	<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
	<div onclick="fetchMore('masters/product/fetchmore');" style="cursor: pointer;padding-top:5px;" id="fetchingDone">
	<img alt="" src="images/more.png" style="vertical-align: middle; width: 6px;" /> 
	More <span id="fetching" style="display: none">Fetching..</span></div>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
