<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);


foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `targetrange` (`name`, `fromdate`, `todate`,`weeks`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('$post[0]', '$post[1]', '$post[2]','$post[3]', '', '$datetime', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT targetrange.name,targetrange.fromdate,targetrange.todate,targetrange.modifieddate,employee.name,targetrange.id FROM targetrange,employee WHERE targetrange.updatedby = employee.id AND targetrange.delete = '0' AND targetrange.id = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[5];?>" /></td>
		<td class="blueSimpletext" onclick="getModule('masters/targetrange/edit?id=<?php echo $row[5];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo $row[0]?>')" style="width: 300px;">
		<?php echo $row[0];?></td>
		<td><?php echo $row[1]; ?></td>
		<td><?php echo $row[2]; ?></td>
		<td id="details" style="width: 400px;"><?php echo "Last Updated By ".$row[4]." on ".date("d-m-Y H:i:s",strtotime($row[3]));?>
		</td>
