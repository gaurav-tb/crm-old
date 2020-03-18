<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}

mysql_query("INSERT INTO `rmslabMaster` (`id`,`slabName`,`incentive`,`slabrangeFrom`,`slabrangeTo`,`order`,`modifiedDate`) VALUES ('','$post[0]','$post[1]','$post[2]','$post[3]','$post[4]','$datetime')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT `rmslabMaster`.`id`,`rmslabMaster`.`slabName`,`rmslabMaster`.`slabrangeFrom`,`rmslabMaster`.`slabrangeTo`,`rmslabMaster`.`incentive`,`rmslabMaster`.`modifiedDate`,`rmslabMaster`.`order` FROM `rmslabMaster` WHERE `rmslabMaster`.`id`='$id'",$con) or die(mysql_error());
$newRow = mysql_fetch_array($getData);

?>
<td style="width:20px;"><input name="Checkbox1" type="checkbox" id="chBxPUTGENERATEDIHEREINNS" value="<?php echo $id;?>" /></td>
<td class="blueSimpletext" style="width:300px;" onclick="getModule('masters/rmslabmaster/edit?id=<?php echo $id;?>&i=PUTGENERATEDIHERE','manipulateContent','viewContent','Fetching Data..')"><?php echo $newRow[1];?></td>
<td><?php echo $newRow[2];?></td>
<td><?php echo $newRow[3];?></td>
<td><?php echo $newRow[4];?></td>
<td><?php echo $newRow[6];?></td>
<td id="details" style="width:400px;"><?php echo "Last Updated By on".date("d-m-Y H:i:s",strtotime($newRow[5]));?></td>
