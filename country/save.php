<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `country` (`name`, `createdate`, `modifieddate`, `updatedby`, `id`, `delete`) VALUES ('$post[0]', '$datetime', '$datetime', '$loggeduserid', '', '0')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT country.name,country.modifieddate,employee.name,country.id FROM country,employee WHERE country.updatedby = employee.id AND country.delete = '0' AND country.id = '$id'",$con) or die(mysql_error());
$newRow = mysql_fetch_array($getData);

?>
<td style="width:20px;"><input name="Checkbox1" type="checkbox" id="chBxPUTGENERATEDIHEREINNS" value="<?php echo $id;?>" /></td>
<td style="width:300px;" onclick="getModule('masters/country/edit?id=<?php echo $id;?>&i=PUTGENERATEDIHERE','manipulateContent','viewContent','Fetching Data..')"><?php echo $newRow[0];?></td>

<td id="details" style="width:400px;"><?php echo "Last Updated By ".$newRow[2]." on ".date("d-m-Y H:i:s",strtotime($newRow[1]));?></td>
