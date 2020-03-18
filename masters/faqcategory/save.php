<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}

mysql_query("INSERT INTO `faqcategories` (`id`,`categoriesName`,`description`,`createdate`,`modofieddate`,`updatedby`) VALUES ('','$post[0]','$post[1]','$datetime','$datetime','$loggeduserid')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT faqcategories.categoriesName,faqcategories.description,employee.name,faqcategories.id,faqcategories.modofieddate,`faqcategories`.`createdate` FROM `faqcategories`,`employee` WHERE `faqcategories`.`updatedby` = `employee`.`id` AND `faqcategories`.`delete` = '0' AND `faqcategories`.`id`= '$id'",$con) or die(mysql_error());
$newRow = mysql_fetch_array($getData);

?>
<td style="width:20px;"><input name="Checkbox1" type="checkbox" id="chBx<?php echo $i;?>" value="<?php echo $id;?>" /></td>
<td class="blueSimpletext" style="width:300px;" onclick="getModule('masters/faqcategories/edit?id=<?php echo $id;?>&i=<?php echo $i;?>','manipulateContent','viewContent','Fetching Data..')"><?php echo $newRow['categoriesName'];?></td>
<td><?php echo $newRow['description'];?></td>
<td><?php echo date("d-m-Y H:i:s",strtotime($newRow['createdate'])) ;?></td>
<td id="details" style="width:400px;"><?php echo "Last Updated By ".$newRow['updatedby']." on ".date("d-m-Y H:i:s",strtotime($newRow['modofieddate']));?></td>
