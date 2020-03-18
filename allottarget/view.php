<?php
include("../include/conFig.php");


?>
<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Allot Target</td>
			
	</table>
</div>
<div id="directResult">
<div style="background:#eee;padding:20px;">
Please select the range.	<br/>

<select name="Select1" class="input" style="width: 390px" id="alt0">
			

<?php
$getProfile = mysql_query("SELECT `name`,`id` FROM `targetrange` WHERE `delete` = '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowProfile= mysql_fetch_array($getProfile))
{
?>
	<option value="<?php echo $rowProfile[1];?>"><?php echo $rowProfile[0];?></option>
<?php
}
?>

			</select>&nbsp;&nbsp;
			
<br/><br/>
<?php
if(in_array("VA_clients",$thisPer))
{
?>
Please Select a Profile.	<br/>

<select name="Select1" class="input" style="width: 390px" id="proalt">
<?php
$getProfile = mysql_query("SELECT `name`,`id` FROM `profile` WHERE `delete` = '0'",$con) or die(mysql_error());
while($rowProfile= mysql_fetch_array($getProfile))
{
?>
<option value="<?php echo $rowProfile[1];?>"><?php echo $rowProfile[0];?></option>
<?php
}
?>

			</select>&nbsp;&nbsp;<br/>

			
			<input name="Button1" type="button" value="Go" class="buttonBlue" onclick="getModule('allottarget/allotTarget?range='+document.getElementById('alt0').value+'&profile='+document.getElementById('proalt').value,'customResult','','Fetching Data')" />
			
<?php
}
else
{
?>
Please Select a Team.	<br/>



<select name="Select1" class="input" style="width: 390px" id="teamalt" disabled="disabled">
<?php
$getProfile = mysql_query("SELECT `name`,`id`,`leader` FROM `team` WHERE `delete` = '0'",$con) or die(mysql_error());
while($rowProfile= mysql_fetch_array($getProfile))
{
?>
<option <?php if($rowProfile[2] == $loggeduserid) echo "selected='selected'"; ?> value="<?php echo $rowProfile[1];?>"><?php echo $rowProfile[0];?></option>
<?php
}
?>
<input name="Button1" type="button" value="Go" class="buttonBlue" onclick="getModule('allottarget/allotTarget?range='+document.getElementById('alt0').value+'&team='+document.getElementById('teamalt').value,'customResult','','Fetching Data')" />

<?php
}
?>

</div>
<div id="customResult"></div>
<div id="moreData">
</div>
