<?php
include("../../include/conFig.php");
$data = $_GET['data'];
$fc = $_GET['fc'];
$data = explode("--",$data);

$getData = mysql_query("SELECT allotmentrules.id, p1.name , p2.name FROM allotmentrules,profile AS p1,profile AS p2 WHERE p1.id = allotmentrules.from AND p2.id = allotmentrules.to AND allotmentrules.delete = '0' AND allotmentrules.id < '$data[0]' ORDER BY allotmentrules.id DESC LIMIT ".$fc,$con) or die(mysql_error());
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
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
		<td onclick="getModule('masters/allotmentrules/edit?id=<?php echo $row[5];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo $row[0]?>')" style="width: 300px;">
		<?php echo $row[1];?></td>
		<td><?php echo $row[2]; ?></td>
			</tr>
<?php
$i++;
$Maxid = $row[0];
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
