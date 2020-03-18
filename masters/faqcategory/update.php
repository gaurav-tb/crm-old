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

mysql_query("UPDATE `faqcategories` SET `faqcategories`.`categoriesName`='$post[0]',`faqcategories`.`description`='$post[1]',`faqcategories`.`updatedby`='$loggeduserid',`faqcategories`.`modofieddate`='$datetime' WHERE `faqcategories`.`id` = '$id'",$con) or die(mysql_error());


$getData = mysql_query("SELECT faqcategories.categoriesName,faqcategories.description,employee.name,faqcategories.id,faqcategories.modofieddate,`faqcategories`.`createdate` FROM `faqcategories`,`employee` WHERE `faqcategories`.`updatedby` = `employee`.`id` AND `faqcategories`.`delete` = '0' AND `faqcategories`.`id`= '$id'",$con) or die(mysql_error());
$newRow = mysql_fetch_array($getData);
?>
<td style="width:20px;"><input name="Checkbox1" type="checkbox" id="chBx<?php echo $i;?>" value="<?php echo $id;?>" /></td>
<td class="blueSimpletext" style="width:300px;" onclick="getModule('masters/faqcategories/edit?id=<?php echo $id;?>&i=<?php echo $i;?>','manipulateContent','viewContent','Fetching Data..')"><?php echo $newRow['categoriesName'];?></td>
<td><?php echo $newRow['description'];?></td>
<td><?php echo date("d-m-Y H:i:s",strtotime($newRow['createdate'])) ;?></td>
<td id="details" style="width:400px;"><?php echo "Last Updated By ".$newRow['updatedby']." on ".date("d-m-Y H:i:s",strtotime($newRow['modofieddate']));?></td>
