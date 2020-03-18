<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}

$c = count($post);
for($g=15;$g<=$c;$g++)
{
$product .= $post[$g].",";
}

mysql_query("INSERT INTO `contact`(`ownerid`, `fname`, `lname`, `phone`, `mobile`, `email`, `website`, `leadstatus`, `leadsource`, `latestresponse`, `callbackdate`, `messengerid`, `address`, `city`, `description`, `product`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('$loggeduserid','$post[1]','$post[2]','$post[3]','$post[4]','$post[5]','$post[6]','$post[7]','$post[8]','$post[9]','$post[10]','$post[11]','$post[12]','$post[13]','$post[14]', '$product','','$datetime','$datetime','$loggeduserid','0')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT employee.name, contact.fname, contact.mobile, contact.phone, city.name,contact.id FROM contact,employee,city WHERE contact.ownerid = employee.id AND contact.city = city.id AND contact.delete = '0' AND contact.id = '$id'",$con) or die(mysql_error());
$newRow = mysql_fetch_array($getData);
?>

		<td style="width: 20px;">
		<input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $newRow[5];?>" /></td>
		<td  style="width: 300px;">
		<?php echo $newRow[0];?></td>
		<td onclick="getModule('leads/edit?id=<?php echo $id;?>&amp;i=PUTGENERATEDIHERE','manipulateContent','viewContent','Fetching Data..')" class="blueSimpletext">
		<?php echo $newRow[1];?>
		</td>
		<td>
		<?php echo $newRow[2];?>
		</td>
				<td>
		<?php echo $newRow[3];?>
		</td>

		<td><?php echo $newRow[4];?></td>

