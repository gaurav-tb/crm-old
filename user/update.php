
<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$i = $_GET['i'];
$id = $_GET['id'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);

$post[] .= $val;
}


$dateofjoining=date('Y-m-d',strtotime($post[9]));

$first_name = ucwords((strtolower($post[2])));


mysql_query("UPDATE `employee` SET `username`='$post[0]',`password`='$post[1]',`name`='$first_name',`profile`='$post[3]',`status`='$post[4]',`email`='$post[5]',`phone`='$post[6]',`mobile`='$post[7]',`dob`='$post[8]',`modifieddate`='$datetime',`updatedby`='$loggeduserid',`delete`='0',`IPper` = '$post[12]',`poolfetch` = '$post[13]',`employee_code`='$post[17]',`perfetch` = '$post[15]',`salary` = '$post[14]' ,`poolfetchsource` = '$post[16]' ,`joiningdate` = '$dateofjoining',`callingextension`='$post[17]',`landing_number_2`='$post[8]',`landing_number_3`='$post[11]',`landing_number_4`='$post[10]',`joiningdate`='$dateofjoining' WHERE `id`= '$id'",$con)or die(mysql_error());


if($post[3] == '4')
{
	$getAlready = mysql_query("SELECT * FROM `totalallotment` WHERE `userid` = '$id'",$con) or die(mysql_error());
	if(mysql_num_rows($getAlready) == 0)
	{
	mysql_query("INSERT INTO `totalallotment` (`id`, `userid`, `alloted`) VALUES (NULL, '$id', '0')",$con) or die(mysql_error());	
	}
}


////////////for chat user

mysql_query("UPDATE `user` SET `username`='$post[0]',`password`='$post[1]',`name`='$first_name',`status` = '$post[4]' WHERE `id`= '$id'",$con) or die(mysql_error());

$getData = mysql_query("SELECT employee.name, employee.mobile, employee.email, profile.name, employee.status, employee.modifieddate,employee.id FROM employee,city,profile WHERE employee.profile = profile.id AND employee.delete = '0' AND employee.id = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>
<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[6];?>" /></td>


		<td class="blueSimpletext" onclick="getModule('user/edit?id=<?php echo $row[6];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo $row[0]?>')" style="width: 300px;">
		<?php echo $row[0];?></td>
		<td>
		<?php echo $row[1];?>
		</td>
		<td>
		<?php echo $row[2];?>
		</td>
		
		<td><?php echo $row[3];?></td>
		<td><?php if($row[4] == '1') echo "Active"; else echo "Inactive"; ?></td>
	
