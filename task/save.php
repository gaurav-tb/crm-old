<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
//Pranay Dongre*$*$*Subject*$*$*1*$*$*2012-10-17*$*$*3*$*$*5*$*$*null*$*$*1*$*$*null*$*$*1*$*$*desc
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
if($post[4] < 10)
{
$post[4]= "0".$post[4];
}
if($post[5]< 10)
{
$post[5]= "0".$post[5];
}

$toSavedate = $post[3]." ".$post[4].":".$post[5].":00"; 

mysql_query("INSERT INTO `task`(`id`, `owner`, `subject`, `status`, `reminddate`, `email`, `profile`, `popup`, `sms`, `description`, `createdate`, `modifieddate`, `updatedby`, `contactid`, `delete`) VALUES ('','$loggeduserid','$post[1]','$post[2]','$toSavedate','$post[6]','$post[7]','$post[8]','$post[9]','$post[10]','$datetime','$datetime','$loggeduserid','0','0')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT employee.name,task.subject,task.status,task.reminddate,task.modifieddate,task.id FROM task,employee WHERE employee.id = task.owner AND task.delete = '0' AND task.id = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>
<td style="width: 20px;">
		<input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $row[5];?>" /></td>
		<td class="blueSimpletext" onclick="getModule('task/edit?id=<?php echo $row[5];?>&amp;i=PUTGENERATEDIHERE','manipulateContent','viewContent','Fetching Data..')" style="width: 300px;">
		<?php echo $row[0];?></td>
		<td><?php echo $row[1]?></td>
		<td><?php if($row[2] == 0) echo open;
		else
		echo close;
		?></td>
		<td><?php echo $row[3]?></td>
