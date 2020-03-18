<?php
include("../include/conFig.php");
$data = $_GET['data'];
$fc = $_GET['fc'];
$data = explode("--",$data);
//$getData = mysql_query("SELECT leadsource.name,leadsource.modifieddate,employee.name,leadsource.id FROM leadsource,employee WHERE leadsource.updatedby = employee.id AND leadsource.delete = '0' AND leadsource.id < '$data[0]' ORDER BY leadsource.id DESC LIMIT 1",$con) or die(mysql_error());
//echo "SELECT employee.name, employee.mobile, employee.email, city.name, employee.profile, employee.status, employee.modifieddate,employee.id FROM employee,city WHERE employee.city = city.id AND employee.delete = '0'  AND employee.id < '$data[0]' ORDER BY employee.id DESC LIMIT 1";
$getData = mysql_query("SELECT employee.name, employee.mobile, employee.email, profile.name, employee.status, employee.modifieddate,employee.id FROM employee,city,profile WHERE  employee.profile = profile.id AND employee.delete = '0'  AND employee.id < '$data[0]' ORDER BY employee.id DESC LIMIT 100",$con) or die(mysql_error());
if(mysql_num_rows($getData) > 0)
{
?>
<table width="100%" cellpadding="0" cellspacing="0" class="fetch">
<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row[5]));?>">
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
	</tr>
	
	<?php
$i++;
$Maxid = $row[6];
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
