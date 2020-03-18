<?php
include("../include/conFig.php");

$getVal = $_GET['state'];
$id = $_GET['id'];

$getCity = mysql_query("SELECT `name`, `id` FROM `city` WHERE `state` = '$getVal'",$con) or die(mysql_error());
?>

<select name="req" class="input"  style="width: 200px" id="<?php echo $id;?>">
<option value="">Select City</option>
<?php
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1]?>"><?php echo $rowCity[0]?></option>
<?php
}
?>

			</select>

