<?php
include("../../include/conFig.php");
$data = $_GET['data'];
$fc = $_GET['fc'];
$data = explode("--",$data);
//$getData = mysql_query("SELECT targetrange.name,targetrange.modifieddate,employee.name,targetrange.id FROM targetrange,employee WHERE targetrange.updatedby = employee.id AND targetrange.delete = '0' AND targetrange.id < '$data[0]' ORDER BY targetrange.id DESC LIMIT 1",$con) or die(mysql_error());

$getData = mysql_query("SELECT targetrange.name,targetrange.fromdate,targetrange.todate,targetrange.modifieddate,employee.name,targetrange.id FROM targetrange,employee WHERE targetrange.updatedby = employee.id AND targetrange.delete = '0' AND targetrange.id != '1' AND targetrange.id < '$data[0]' ORDER BY targetrange.id DESC LIMIT ".$fc,$con) or die(mysql_error());
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
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[5];?>" /></td>
		<td class="blueSimpletext" onclick="getModule('masters/targetrange/edit?id=<?php echo $row[5];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo $row[0]?>')" style="width: 300px;">
		<?php echo $row[0];?></td>
		<td><?php echo $row[1]; ?></td>
		<td><?php echo $row[2]; ?></td>
		<td id="details" style="width: 400px;"><?php echo "Last Updated By ".$row[4]." on ".date("d-m-Y H:i:s",strtotime($row[3]));?>
		</td>
	</tr>
<?php
$i++;
$Maxid = $row[5];
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
