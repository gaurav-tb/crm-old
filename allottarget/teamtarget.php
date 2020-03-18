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
&nbsp;
<select name="Select1" class="input" style="width: 390px" id="alt0" name="req">
			
<?php
$getProfile = mysql_query("SELECT `name`,`id` FROM `targetrange` WHERE `id` != '1'",$con) or die(mysql_error());
while($rowProfile= mysql_fetch_array($getProfile))
{
?>
	<option value="<?php echo $rowProfile[1];?>"><?php echo $rowProfile[0];?></option>
<?php
}
?>

			</select>&nbsp;&nbsp;
			<input name="Button1" type="button" value="Go" class="buttonBlue" onclick="getModule('allottarget/getTeams?range='+document.getElementById('alt0').value,'customResult','','Fetching Data')" />
			


</div>
<div id="customResult"></div>
<div id="moreData">
</div>
