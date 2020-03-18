<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$i = $_GET['i'];
$id = $_GET['id'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("UPDATE `product` SET `category` = '$post[7]',`name` = '$post[0]',`code` = '$post[1]',`description` = '$post[2]',`amount` = '$post[3]',`unit` = '$post[4]',`moneyback` = '$post[5]',`quantity` = '$post[6]',`modifieddate` = '$datetime', `updatedby`  = '$loggeduserid' WHERE `id` = '$id'",$con);
$getData = mysql_query("SELECT product.name,product.code,product.description,product.amount,product.unit,product.moneyback,product.quantity,product.modifieddate,employee.name,product.id FROM product,employee WHERE product.updatedby = employee.id AND product.delete = '0' AND product.id = '$id'",$con) or die(mysql_error());
$newRow = mysql_fetch_array($getData);
?>
	<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $newRow[9];?>" /></td>
		<td onclick="getModule('masters/product/edit?id=<?php echo $newRow[9];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','Fetching Data..')" style="width: 300px;">
		<?php echo $newRow[0];?></td>
		<td><?php echo $newRow[1];?></td>

		<td><?php echo $newRow[3];?></td>

		<td><?php echo substr($newRow[2],0,50)."..";?></td>
		<td id="details" style="width: 400px;"><?php echo "Last Updated By ".$newRow[8]." on ".date("d-m-Y H:i:s",strtotime($newRow[7]));?>
		</td>
