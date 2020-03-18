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
mysql_query("UPDATE `rmslabMaster` SET `rmslabMaster`.`slabName`='$post[0]',`rmslabMaster`.`incentive`='$post[1]',`rmslabMaster`.`slabrangeFrom`='$post[2]',`rmslabMaster`.`slabrangeTo`='$post[3]',`rmslabMaster`.`order`='$post[4]',`rmslabMaster`.`modifiedDate`='$datetime' WHERE `rmslabMaster`.`id`='$id'",$con);
$getData = mysql_query("SELECT `rmslabMaster`.`id`,`rmslabMaster`.`slabName`,`rmslabMaster`.`slabrangeFrom`,`rmslabMaster`.`slabrangeTo`,`rmslabMaster`.`incentive`,`rmslabMaster`.`modifiedDate`,`rmslabMaster`.`order` FROM `rmslabMaster` WHERE `rmslabMaster`.`id`='$id'",$con) or die(mysql_error());
$newRow = mysql_fetch_array($getData);
?>
<td style="width:20px;"><input name="Checkbox1" type="checkbox" id="chBxPUTGENERATEDIHEREINNS" value="<?php echo $id;?>" /></td>
<td class="blueSimpletext" style="width:300px;" onclick="getModule('masters/rmslabmaster/edit?id=<?php echo $id;?>&i=PUTGENERATEDIHERE','manipulateContent','viewContent','Fetching Data..')"><?php echo $newRow[1];?></td>
<td><?php echo $newRow[2];?></td>
<td><?php echo $newRow[3];?></td>
<td><?php echo $newRow[4] ;?></td>
<td><?php echo $newRow[6];?></td>
<td id="details" style="width:400px;"><?php echo "Last Updated By on".date("d-m-Y H:i:s",strtotime($newRow[5]));?></td>
