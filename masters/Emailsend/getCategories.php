<?php
include ("../../include/conFig.php");
$id = $_GET['id'];
$categories = $_GET['categories'];
$getMail = mysql_query("SELECT DISTINCT `templatefor`,`name`,`id` FROM `templateemail` WHERE `delete` = '0' AND `templatecategory` = '$categories'", $con) or die(mysql_error());
?>
<select name="Template" class="input"   style="width:200px" id="<?php
echo $id; ?>">
<option value="">Select Template E-mails</option>
<?php
while ($rowmail = mysql_fetch_array($getMail))
{
?>
<option value="<?php echo $rowmail[2] ?>"><?php echo $rowmail[1] ?></option>
<?php
}
?>
</select>
<span id="template" style="color: red;"></span>
