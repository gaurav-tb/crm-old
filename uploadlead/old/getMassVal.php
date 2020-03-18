<?php
include("../include/conFig.php");
$value = $_GET['values'];
if($value == 'leadstatus')
{?>
<select name="Select1" title="isNotNull" id="" style="width:210px"  class="input" onchange="addToteam(this.value,'getBox')">
				<option value="">Select Lead Status</option>
			<?php
			$getProfile = mysql_query("SELECT `name`,`id` FROM `leadstatus` WHERE `delete` = '0'",$con) or die(mysql_error());
			while($rowProfile= mysql_fetch_array($getProfile))
			{
			?>
			<option value="<?php echo $rowProfile[1] ;?>**<?php echo $rowProfile[0] ;?>"><?php echo $rowProfile[0] ;?></option>
			<?php
			}
			?>
			
			</select>&nbsp;&nbsp;<span id="reselect"></span>
			<div style="padding:5px;" id="selectTeam">
						</div>
			<input name="Text1" type="text" value="" id="getBox" style="display:none" />
<?php }
if($value == 'callbackdate')
{
echo '<input  style="width: 200px" class="input" type="date" id="getBox1" placeholder = "Enter Call Back Date"/>';
}
