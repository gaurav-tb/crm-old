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
mysql_query("UPDATE `leadresponse` SET `name` = '$post[0]',`description` = '$post[1]',`modifieddate` = '$datetime', `updatedby`  = '$loggeduserid', `order` = '$post[2]',`display` = '$post[3]' WHERE `id` = '$id'",$con);
$getData = mysql_query("SELECT leadresponse.name,leadresponse.modifieddate,employee.name,leadresponse.id,leadresponse.description FROM leadresponse,employee WHERE leadresponse.updatedby = employee.id AND leadresponse.delete = '0' AND leadresponse.id = '$id'",$con) or die(mysql_error());$newRow = mysql_fetch_array($getData);
?>
<td style="width:20px;"><input name="Checkbox1" type="checkbox" id="chBx<?php echo $i;?>" value="<?php echo $id;?>" /></td>
<td class="blueSimpletext" style="width:300px;" onclick="getModule('masters/leadresponse/edit?id=<?php echo $id;?>&i=<?php echo $i;?>','manipulateContent','viewContent','Fetching Data..')"><?php echo $newRow[0];?></td>
<td><?php echo substr($newRow[4],0,100)."..";?></td>
<td id="details" style="width:400px;"><?php echo "Last Updated By ".$newRow[2]." on ".date("d-m-Y H:i:s",strtotime($newRow[1]));?></td>
