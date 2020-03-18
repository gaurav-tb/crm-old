<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}



mysql_query("INSERT INTO `employee`(`id`, `username`, `password`, `name`, `profile`, `status`, `email`, `phone`, `mobile`, `dob`, `address`, `city`, `comments`, `createdate`, `modifieddate`, `updatedby`, `delete`, `IPper`) VALUES ('','$post[0]', '$post[1]', '$post[2]', '$post[3]','$post[4]','$post[5]','$post[6]','$post[7]','$post[8]','$post[9]','$post[10]','$post[11]','$datetime','$datetime','$loggeduserid','0','$post[12]')",$con) or die(mysql_error());
$id = mysql_insert_id();
mysql_query("INSERT INTO `userprofile`(`userid`, `displayname`, `status`, `mobile`, `email`, `pic`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('$id','$post[2]','','$post[7]','$post[5]','','','$datetime','$datetime','$loggeduserid','0')",$con) or die(mysql_error());


if($post[3] == '4')
{
	mysql_query("INSERT INTO `totalallotment` (`id`, `userid`, `alloted`) VALUES (NULL, '$id', '0')",$con) or die(mysql_error());
}


////////////for chat user
mysql_query("INSERT INTO `user`(`id`, `username`, `password`, `name`,`status`) VALUES ('$id','$post[0]','$post[1]','$post[2]','$post[4]')",$con) or die(mysql_error());

$getData = mysql_query("SELECT employee.name, employee.mobile, employee.email, profile.name, employee.status, employee.modifieddate,employee.id FROM employee,city,profile WHERE  employee.profile = profile.id AND employee.delete = '0' AND employee.id = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>		<td style="width: 20px;">
		<input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $row[6];?>" /></td>
		<td class="blueSimpletext" onclick="getModule('user/edit?id=<?php echo $row[6];?>&amp;i=PUTGENERATEDIHERE','manipulateContent','viewContent','<?php echo $row[0]?>')" style="width: 300px;">
		<?php echo $row[0];?></td>
		<td>
		<?php echo $row[1];?>
		</td>
		<td>
		<?php echo $row[2];?>
		</td>
		
		<td><?php echo $row[3];?></td>
		<td><?php if($row[4] == '1') echo "Active"; else echo "Inactive"; ?></td>
