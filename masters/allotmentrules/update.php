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
mysql_query("UPDATE `allotmentrules` SET `from` = '$post[0]', `to` = '$post[1]' WHERE `id` = '$id'",$con);

$getData = mysql_query("SELECT profile.name,allotmentrules.to,allotmentrules.id FROM allotmentrules,profile  WHERE allotmentrules.from = profile.id AND allotmentrules.delete = '0' AND allotmentrules.id = '$id' ORDER BY allotmentrules.id DESC LIMIT 100",$con) or die(mysql_error());
while($row = mysql_fetch_array($getData))
{
$toProfile = explode(',',$row[1]);
$toPro = str_ireplace('-','',$toProfile);
$toProfiles = '';
	foreach($toPro as $val)
	{
		if($val != '')
		{
		$getToProfiles = mysql_query("SELECT `name` FROM `profile` WHERE `id` = '$val' AND `delete` = '0'",$con) or die(mysql_error()); 
		$rowTo =  mysql_fetch_array($getToProfiles);
		$toProfiles .= $rowTo[0].", ";
		}
	}
?><td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[2];?>" /></td>
		<td onclick="getModule('masters/allotmentrules/edit?id=<?php echo $row[2];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo $row[0]?>')" style="width: 300px;">
		<?php echo $row[0];?></td>
		<td><?php echo substr($toProfiles,0,-2); ?></td>
<?php 
}
?>