<?php
include("../../include/conFig.php");
$data = $_GET['data'];
$fc = $_GET['fc'];
$data = explode("--",$data);
$getData = mysql_query("SELECT product.name,product.code,product.description,product.amount,product.unit,product.moneyback,product.quantity,product.modifieddate,employee.name,product.id FROM product,employee WHERE product.updatedby = employee.id AND product.delete = '0' AND product.id != '1' AND product.id < '$data[0]' ORDER BY product.id DESC LIMIT ".$fc,$con) or die(mysql_error());
if(mysql_num_rows($getData) > 0)
{
?>
<table width="100%" cellpadding="0" cellspacing="0" class="fetch">
<?php
$i=$data[1];
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
THISISUSEDTOBREAKSTRING
<?php echo $Maxid.'--'.$MaxI;?>
<?php
}
else
{
echo "FALSEDATA";
}
?>
