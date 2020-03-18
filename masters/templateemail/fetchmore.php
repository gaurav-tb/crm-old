<?php
include("../../include/conFig.php");
$data = $_GET['data'];
$fc = $_GET['fc'];
$data = explode("--",$data);
//$getData = mysql_query("SELECT templateemail.name,templateemail.modifieddate,employee.name,templateemail.id FROM templateemail,employee WHERE templateemail.updatedby = employee.id AND templateemail.delete = '0' AND templateemail.id < '$data[0]' ORDER BY templateemail.id DESC LIMIT 1",$con) or die(mysql_error());

$getData = mysql_query("SELECT templateemail.name,templateemail.modifieddate,employee.name,templateemail.id,templateemail.templateemail FROM templateemail,employee WHERE templateemail.updatedby = employee.id AND templateemail.delete = '0' AND templateemail.id != '1' AND templateemail.id < '$data[0]' ORDER BY templateemail.id DESC LIMIT ".$fc,$con) or die(mysql_error());
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
		<td class="blueSimpletext" onclick="getModule('masters/templateemail/edit?id=<?php echo $row[3];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','Fetching Data..')" style="width: 300px;">
		<?php echo $row[0];?></td>
		
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
