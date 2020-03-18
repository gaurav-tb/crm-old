<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `template` (`name`, `template`, `messenger`, `id`, `createdate`,  `updatedby`,  `delete`) VALUES ('$post[0]', '$post[1]', '$post[2]', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT template.name,template.modifieddate,employee.name,template.id,template.template,template.messenger FROM template,employee WHERE template.updatedby = employee.id AND template.delete = '0' AND template.id = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
	<td style="width: 20px;">
		<input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $row[3];?>" /></td>
		<td onclick="getModule('masters/template/edit?id=<?php echo $row[3];?>&amp;i=PUTGENERATEDIHERE','manipulateContent','viewContent','Fetching Data..')" style="width: 300px;">
		<?php echo $row[0];?></td>
		<td><?php echo $row[4];?></td>
		<td><?php if($row[5] == '1'){ echo 'Messenger Template'; } else echo 'SMS Template';?></td>
		<td id="details" style="width: 400px;"><?php echo "Last Updated By ".$row[2]." on ".date("d-m-Y H:i:s",strtotime($row[1]));?>
		</td>
