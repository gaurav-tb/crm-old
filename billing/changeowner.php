<?php
include("../include/conFig.php");
$type = $_GET['type'];
?>
<center style="height:600px;;width:100%;background:#eee;">
<div class="moduleHeading" style="margin:0px;">
	
	<table cellpadding="0" cellspacing="0" width="100%" class="fetch">
		<tr>
			<td align="left" style="width: 30%; height: 19px;">Change Owner</td></tr>
			</table>
</div>
<br/><br/>
<div  style="padding:5px;width:550px;-moz-box-shadow: 0 0 20px #222; -webkit-box-shadow: 0 0 20px #222;" class="form">
<table width="500px" cellpadding="5" cellspacing="0">
<tr>
<td align="left">Please select the new owner</td>
</tr>
<tr>
	<td style="width: 163px;">
	<select class="input" name="leadowner" style="width: 344px;height:30px;" id="owner">
	<option value="null">-Select Owner-</option>			
<?php
	// $getLead = mysql_query("SELECT COUNT(`id`) FROM `team` WHERE `leader` = '$loggeduserid'",$con) or die(mysql_error());
	// $rowLead = mysql_fetch_array($getLead);
	// 	if($rowLead[0] > 0)
	// 	{
	// 		$getCity = mysql_query("SELECT employee.name,teamamtes.mateid FROM employee,team,teamamtes WHERE teamamtes.mateid = employee.id AND teamamtes.teamid = team.id AND team.delete = '0' AND employee.delete = '0' ORDER BY employee.name ASC",$con) or die(mysql_error());
	// 	}
	// 	else
	// 	{
			$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' ORDER BY `name` ASC",$con) or die(mysql_error()); 
		//}


while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>
</td>
	</tr>
	<tr>
	<td>
	<input class="buttonBlue" name="Button1" style="width: 149px;" type="button" value="Change" onclick="if(document.getElementById('owner').value == 'null'){ ShowError('<br/>Please Select The New Owner'); } else {changeOwner(document.getElementById('owner').value,'<?php echo $type;?>');}" />
	</td>
	
	</tr>
	<tr>
	<td style="color:;font-weight:bold">
	<div id="owresponse"></div>
	</td>
	</tr>
</table>
</div>
</center>