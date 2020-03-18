<?php
include("../../include/conFig.php");
$profile = $_GET['profile'];
?>
<select name="req" class="input" id="not0">
				<option value="">Select User</option>
			<?php
			$getProfile = mysql_query("SELECT `name`,`id` FROM employee WHERE `delete` = '0' AND id NOT IN (SELECT `userid` FROM `cannottalkto` WHERE `delete` = '0') AND `profile` = '$profile'",$con) or die(mysql_error());
			while($rowProfile= mysql_fetch_array($getProfile))
			{
			?>
			<option value="<?php echo $rowProfile[1] ;?>"><?php echo $rowProfile[0] ;?></option>
			<?php
			}
			?>
			
			</select>
