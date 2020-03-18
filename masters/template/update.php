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

mysql_query("UPDATE `template` SET `name` = '$post[0]',`template` = '$post[1]', `messenger` = '$post[2]', `modifieddate` = '$datetime', `updatedby`  = '$loggeduserid' WHERE `id` = '$id'",$con);
$getData = mysql_query("SELECT template.name,template.modifieddate,employee.name,template.id,template.template,template.messenger FROM template,employee WHERE template.updatedby = employee.id AND template.delete = '0' AND template.id = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[3];?>" /></td>
		<td class="blueSimpletext" onclick="getModule('masters/template/edit?id=<?php echo $row[3];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','Fetching Data..')" style="width: 300px;">
		<?php echo $row[0];?></td>
		<td><?php echo $row[4];?></td>
		<td><?php if($row[5] == '1'){ echo 'Messenger Template'; } else echo 'SMS Template';?></td>
		<td id="details" style="width: 400px;"><?php echo "Last Updated By ".$row[2]." on ".date("d-m-Y H:i:s",strtotime($row[1]));?>
		</td>
