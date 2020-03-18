<?php
include("../include/conFig.php");
$value = $_GET['values'];
if($value == 'poolfetch')
{
echo '<input name="Text1" type="text" id="getBox" class = "input" placeholder = "Enter Pool fetch"/>';
}
if($value == 'perfetch')
{
echo '<input name="Text1" type="text" id="getBox" class = "input" placeholder = "Per Fetch Limit"/>';
}

if($value == 'poolfetchsource') {?>
<select class="input" title="isNotNull"  style="width: 210px" id="getBox">
				
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `leadsource` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity)) {
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>
<?php }
?>

