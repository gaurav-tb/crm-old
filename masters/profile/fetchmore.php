<?php
include("../../include/conFig.php");
$data = $_GET['data'];
$fc = $_GET['fc'];
$data = explode("--",$data);
//$getData = mysql_query("SELECT profile.name,profile.modifieddate,employee.name,profile.id FROM profile,employee WHERE profile.updatedby = employee.id AND profile.delete = '0' AND profile.id < '$data[0]' ORDER BY profile.id DESC LIMIT 1",$con) or die(mysql_error());

$getData = mysql_query("SELECT profile.name,profile.modifieddate,employee.name,profile.id,profile.description FROM profile,employee WHERE profile.updatedby = employee.id AND profile.delete = '0' AND profile.id < '$data[0]' ORDER BY profile.id DESC LIMIT ".$fc,$con) or die(mysql_error());
if(mysql_num_rows($getData) > 0)
{
?>
<table width="100%" cellpadding="0" cellspacing="0" class="fetch">
<?php
$i=$data[1];
while($row = mysql_fetch_array($getData))
{
?>
<tr id="fetchRow<?php echo $i;?>">
<td style="width:20px;"><input name="Checkbox1" type="checkbox" id="chBx<?php echo $i;?>" value="<?php echo $id;?>" /></td>
<td class="blueSimpletext" style="width:300px;" onclick="getModule('masters/profile/edit?id=<?php echo $row[3];?>&i=<?php echo $i;?>','manipulateContent','viewContent','Fetching Data..')"><?php echo $row[0];?></td>
		<td><?php echo substr($row[4],0,50)."..";?></td>
<td id="details" style="width:400px;"><?php echo "Last Updated By ".$row[2]." on ".date("d-m-Y H:i:s",strtotime($row[1]));?></td>
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
