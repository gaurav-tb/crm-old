<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `emailcategories` (`name`, `description`, `createdate`, `modifieddate`, `updatedby`, `id`, `delete`,`order`,`display`) VALUES ('$post[0]', '$post[1]', '$datetime', '$datetime', '$loggeduserid', '', '0','$post[2]','$post[3]')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT emailcategories.name,emailcategories.modifieddate,employee.name,emailcategories.id,emailcategories.description FROM emailcategories,employee WHERE emailcategories.updatedby = employee.id AND emailcategories.delete = '0' AND emailcategories.id = '$id'",$con) or die(mysql_error());
$newRow = mysql_fetch_array($getData);

?>
<td style="width:20px;"><input name="Checkbox1" type="checkbox" id="chBxPUTGENERATEDIHEREINNS" value="<?php echo $id;?>" /></td>
<td class="blueSimpletext" style="width:300px;" onclick="getModule('masters/leadresponse/edit?id=<?php echo $id;?>&i=PUTGENERATEDIHERE','manipulateContent','viewContent','Fetching Data..')"><?php echo $newRow[0];?></td>
<td><?php echo substr($newRow[4],0,50)."..";?></td>
<td id="details" style="width:400px;"><?php echo "Last Updated By ".$newRow[2]." on ".date("d-m-Y H:i:s",strtotime($newRow[1]));?></td>
