<?php
include("../include/conFig.php");

$Ownerid = $_GET['from1'];
$id = $_GET['id'];

$getCity = mysql_query("SELECT `leadresponse`.`name`,`contact`.`latestresponse`,count(`latestresponse`) from `contact` INNER JOIN `leadresponse` ON `contact`.`latestresponse`=`leadresponse`.`id` WHERE `contact`.`ownerid`='$Ownerid' GROUP BY `contact`.`latestresponse`",$con) or die(mysql_error());
?>

<select name="req" class="input"  style="width:200px" onchange="getModule('transfercontact/show?transType='+0+'&LatestResponse='+this.value+'&Ownerid='+document.getElementById('from1').value
,'countLeadsVal','','Access Control')" id="<?php echo $id;?>">
<option value="">Select Responses</option>
<?php
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1]?>"><?php echo $rowCity[0]; ?></option>
<?php
}
?>
</select>

