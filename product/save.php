<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `product` (`category`,`name`,`code` ,`description`,`amount`,`unit`,`moneyback`,`quantity`, `createdate`, `modifieddate`, `updatedby`, `id`, `delete`) VALUES ('$post[7]','$post[0]', '$post[1]','$post[2]','$post[3]','$post[4]','$post[5]','$post[6]' ,'$datetime', '$datetime', '$loggeduserid', '', '0')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT product.name,product.code,product.description,product.amount,product.unit,product.moneyback,product.quantity,product.modifieddate,employee.name,product.id FROM product,employee WHERE product.updatedby = employee.id AND product.delete = '0' AND product.id = '$id'",$con) or die(mysql_error());

$newRow = mysql_fetch_array($getData);

?>

		<td style="width: 20px;">
		<input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $newRow[9];?>" /></td>
		<td onclick="getModule('masters/product/edit?id=<?php echo $newRow[9];?>&amp;i=PUTGENERATEDIHERE','manipulateContent','viewContent','Fetching Data..')" style="width: 300px;">
		<?php echo $newRow[0];?></td>
		<td><?php echo $newRow[1];?></td>

		<td><?php echo $newRow[3];?></td>

		<td><?php echo substr($newRow[2],0,50)."..";?></td>
		<td id="details" style="width: 400px;"><?php echo "Last Updated By ".$newRow[8]." on ".date("d-m-Y H:i:s",strtotime($newRow[7]));?>
		</td>


