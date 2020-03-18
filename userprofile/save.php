<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}


mysql_query("INSERT INTO `employee`(`id`, `username`, `password`, `name`, `profile`, `status`, `email`, `phone`, `mobile`, `dob`, `address`, `city`, `comments`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('','$post[0]', '$post[1]', '$post[2]', '$post[3]','$post[4]','$post[5]','$post[6]','$post[7]','$post[8]','$post[9]','$post[10]','$post[11]','$datetime','$datetime','$loggeduserid','0')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT employee.name, employee.mobile, employee.email, city.name, employee.profile, employee.status, employee.modifieddate FROM employee,city WHERE employee.city = city.id AND employee.delete = '0' AND employee.id = '$id'",$con) or die(mysql_error());
$newRow = mysql_fetch_array($getData);

?>

		<td style="width: 20px;">
		<input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $newRow[3];?>" /></td>
		<td onclick="getModule('user/edit?id=<?php echo $id;?>&amp;i=PUTGENERATEDIHERE','manipulateContent','viewContent','Fetching Data..')" style="width: 300px;">
		<?php echo $newRow[0];?></td>
		<td>
		<?php echo $newRow[1];?>
		</td>
		<td>
		<?php echo $newRow[2];?>
		</td>
				<td>
		<?php echo $newRow[3];?>
		</td>

		<td><?php echo $newRow[4];?></td>
		<td><?php if($newRow[5] == '0') echo "Active"; else echo "Inactive"; ?></td>

