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
$toSavedate = $post[3]." ".$post[4].":".$post[5].":00"; 

mysql_query("UPDATE `task` SET `subject` = '$post[1]', `status` = '$post[2]', `reminddate` = '$toSavedate', `email` = '$post[6]',`profile` = '$post[7]',  `popup` = '$post[8]',  `sms` = '$post[9]',  `description` = '$post[10]', `modifieddate` = '$datetime', `updatedby` = '$loggeduserid' WHERE `id` = '$id'",$con) or die(mysql_error()); 
$getData = mysql_query("SELECT employee.name,task.subject,task.status,task.reminddate,task.modifieddate,task.id FROM task,employee WHERE employee.id = task.owner AND task.delete = '0' AND task.id = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>
<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[5];?>" /></td>
		<td class="blueSimpletext" onclick="getModule('task/edit?id=<?php echo $row[5];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','Fetching Data..')" style="width: 300px;">
		<?php echo $row[0];?></td>
		<td><?php echo $row[1]?></td>
		<td><?php echo $row[2]?></td>
		<td><?php echo $row[3]?></td>
