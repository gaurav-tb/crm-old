<?php
include("../include/conFig.php");
$data = $_GET['data'];
$fc = $_GET['fc'];
$data = explode("--",$data);
//echo "SELECT employee.name,task.subject,task.status,task.reminddate,task.modifieddate,task.id FROM task,employee WHERE employee.id = task.owner AND task.owner = '$loggeduserid' AND task.delete = '0'  AND employee.id < '$data[0]' ORDER BY employee.id DESC LIMIT";
$getData = mysql_query("SELECT employee.name,task.subject,task.status,task.reminddate,task.modifieddate,task.id FROM task,employee WHERE employee.id = task.owner AND task.owner = '$loggeduserid' AND task.delete = '0'  AND task.id < '$data[0]' ORDER BY employee.id DESC LIMIT 100".$fc,$con) or die(mysql_error());
if(mysql_num_rows($getData) > 0)
{
?>
<table width="100%" cellpadding="0" cellspacing="0" class="fetch">
<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php echo "Last Updated By  ".$row[0]?>">
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[5];?>" /></td>
		<td class="blueSimpletext" onclick="getModule('task/edit?id=<?php echo $row[5];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','Task')" style="width: 300px;">
		<?php echo $row[0];?></td>
		<td><?php echo $row[1]?></td>
		<td><?php if($row[2] == 0) echo open;
		else
		echo close;
		?></td>
		<td><?php echo $row[3]?></td>
	</tr>
	<?php
$i++;
$Maxid = $row[5];
$MaxI = $i;
}
?>
</table>THISISUSEDTOBREAKSTRING
<?php echo $Maxid.'--'.$MaxI;?>
<?php
}
else
{
echo "FALSEDATA";
}
?>
