<?php
include("../../include/conFig.php");
$data = $_GET['data'];
$fc = $_GET['fc'];
$data = explode("--",$data);
//$getData = mysql_query("SELECT template.name,template.modifieddate,employee.name,template.id FROM template,employee WHERE template.updatedby = employee.id AND template.delete = '0' AND template.id < '$data[0]' ORDER BY template.id DESC LIMIT 1",$con) or die(mysql_error());

$getData = mysql_query("SELECT template.name,template.modifieddate,employee.name,template.id,template.template,template.messenger FROM template,employee WHERE template.updatedby = employee.id AND template.delete = '0' AND template.id != '1' AND template.id < '$data[0]' ORDER BY template.id DESC LIMIT ".$fc,$con) or die(mysql_error());
if(mysql_num_rows($getData) > 0)
{
?>
<table width="100%" cellpadding="0" cellspacing="0" class="fetch">
<?php
$i=$data[1];
while($row = mysql_fetch_array($getData))
{
?>
<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>">
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[3];?>" /></td>
		<td class="blueSimpletext" onclick="getModule('masters/template/edit?id=<?php echo $row[3];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','Fetching Data..')" style="width: 300px;">
		<?php echo $row[0];?></td>
		<td><?php echo $row[4];?></td>
		<td><?php if($row[5] == '1'){ echo 'Messenger Template'; } else echo 'SMS Template';?></td>
		<td id="details" style="width: 400px;"><?php echo "Last Updated By ".$row[2]." on ".date("d-m-Y H:i:s",strtotime($row[1]));?>
		</td>
	</tr>
<?php
$i++;
$Maxid = $row[3];
$MaxI = $i;
}
?>
</table>
THISISUSEDTOBREAKSTRING
<?php echo $Maxid.'--'.$MaxI;?>
<?php
}
else
{
echo "FALSEDATA";
}
?>
