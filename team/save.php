<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}


mysql_query("INSERT INTO `team` (`name`, `leader`, `createdate`, `modifieddate`, `updatedby`, `delete`, `id`, `desc`) VALUES ('$post[0]', '$post[1]', '$datetime', '$datetime', '$loggeduserid', '0', '','$post[3]')",$con) or die(mysql_error());
$id = mysql_insert_id();


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

foreach($newMates as $tal)
{
mysql_query("INSERT INTO `teamamtes` (`teamid`, `mateid`, `id`) VALUES ('$id', '$tal', '')",$con) or  die(mysql_error());

mysql_query("UPDATE `spotlight` SET `spotlight`.`teamid`='$id' WHERE `spotlight`.`teamRMMateid`='$tal'",$con) or  die(mysql_error());

mysql_query("UPDATE `spotlightweek` SET `spotlightweek`.`teamid`='$id' WHERE `spotlightweek`.`teamRMMateid`='$tal'",$con) or  die(mysql_error());


}

$getData = mysql_query("SELECT team.name,team.modifieddate,employee.name,team.id,team.desc FROM team,employee WHERE team.leader= employee.id AND team.delete = '0' AND team.id = '$id' ORDER BY team.id",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php echo 'Last Updated On '.date("d M,y h:i:s",strtotime($row[1]));?>">
		<td style="width: 20px;">
		<input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $row[3];?>" /></td>
		<td class="blueSimpletext" onclick="getModule('team/edit?id=<?php echo $row[3];?>&amp;i=PUTGENERATEDIHERE','manipulateContent','viewContent','Edit Team')">
		<?php echo $row[0];?></td>
<td>
<?php echo $row[2];?>	
</td>	
	<td id="details">
	<?php echo $row[4];?>		
		</td>
	</tr>
