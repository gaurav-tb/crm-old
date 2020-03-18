<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$id = $_GET['id'];
$i=$_GET['i'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("UPDATE `team` SET `name` = '$post[0]', `leader` = '$post[1]', `modifieddate` = '$datetime', `updatedby` = '$loggeduserid', `delete` = '0', `desc` = '$post[3]' WHERE `id` = '$id'",$con) or die(mysql_error());

$mates = $post[2];
$mates = explode(",",$mates);
foreach($mates as $val)
{
if($val != '')
{
$temp = str_ireplace("-","",$val);
$newMates[] .= $temp;
}
}

mysql_query("DELETE FROM `teamamtes` WHERE `teamid` = '$id'",$con) or die(mysql_error());

foreach($newMates as $tal)
{
mysql_query("INSERT INTO `teamamtes` (`teamid`, `mateid`, `id`) VALUES ('$id', '$tal', '')",$con) or  die(mysql_error());

mysql_query("UPDATE `spotlight` SET `spotlight`.`teamid`='$id' WHERE `spotlight`.`teamRMMateid`='$tal'",$con) or  die(mysql_error());

mysql_query("UPDATE `spotlightweek` SET `spotlightweek`.`teamid`='$id' WHERE `spotlightweek`.`teamRMMateid`='$tal'",$con) or  die(mysql_error());

}

$getData = mysql_query("SELECT team.name,team.modifieddate,employee.name,team.id,team.desc FROM team,employee WHERE team.leader= employee.id AND team.delete = '0' AND team.id = '$id' ORDER BY team.id",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[3];?>" /></td>
		<td class="blueSimpletext" onclick="getModule('team/edit?id=<?php echo $row[3];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','Edit Team')">
		<?php echo $row[0];?></td>
<td>
<?php echo $row[2];?>	
</td>	
	<td id="details">
	<?php echo $row[4];?>		
		</td>


