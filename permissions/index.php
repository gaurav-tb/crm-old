<?php
include("../include/conFig.php");
?>
<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Access Control</td>
			<td align="right">Profile&nbsp;&nbsp; 
		</td>

		</tr>
</table>		
</div>
<div style="background:#eee;padding:10px;line-height:180%">
Please Select Profile<br/>
<select class="input" name="Select1"  style="width: 390px" onchange="getModule('permissions/profileData?profile='+this.value,'profileData','','Access Control')">
		<option value="">Please Select Profile</option>
		<?php
		$getProfile  =mysql_query("SELECT `name`,`id` FROM `profile` WHERE `delete` = '0' ORDER BY `name` ASC",$con) or die(mysql_error());
		while($rowProfile = mysql_fetch_array($getProfile))
		{
		?>
		<option value="<?php echo $rowProfile[1];?>"><?php echo $rowProfile[0];?></option>
		
		<?php
		}
		?>

		</select>
</div>

				
	
	
		
	

<div id="directResult">
<div id="profileData" style="height: 550px; width: 98%; overflow: auto; background: #FFFFFF; padding: 5px 0px 5px 20px; -moz-box-shadow: inset 0 0 3px 2px #ccc; -webkit-box-shadow: inset 0 0 3px 2px #ccc; box-shadow: inset 0 0 10px 2px #ccc;">
		</div>

	</div>

