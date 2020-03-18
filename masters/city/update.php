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
mysql_query("UPDATE `city` SET `name` = '$post[0]',`state` = '$post[1]',`modifieddate` = '$datetime', `updatedby`  = '$loggeduserid' WHERE `id` = '$id'",$con);
$getData = mysql_query("SELECT city.name,city.modifieddate,employee.name,city.id,state.name FROM city,employee,state WHERE city.updatedby = employee.id AND city.state= state.id AND  city.delete = '0' AND city.id = '$id'",$con) or die(mysql_error());$newRow = mysql_fetch_array($getData);
?>
<td style="width:20px;"><input name="Checkbox1" type="checkbox" id="chBx<?php echo $i;?>" value="<?php echo $id;?>" /></td>
<td class="blueSimpletext" style="width:300px;" onclick="getModule('masters/city/edit?id=<?php echo $id;?>&i=<?php echo $i;?>','manipulateContent','viewContent','Fetching Data..')"><?php echo $newRow[0];?></td>
<td><?php echo $newRow[4];?></td>
<td id="details" style="width:400px;"><?php echo "Last Updated By ".$newRow[2]." on ".date("d-m-Y H:i:s",strtotime($newRow[1]));?></td>
