<?php
include("../include/conFig.php");
?>
<html>
<body>

<div class="moduleHeading">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
G2M Upload Report:
</td>
<td align="right" style="width:70%">
&nbsp;</td>
</tr>
</table>
</div>
<form action="reports/generaterg2mreport.php" method="post" target="_blank">
<div class="form">
<table width="100%" cellpadding="0" cellspacing="10">
<tr>
<td>
	<strong>RM Owner</strong>
	</td>
	<td style="">
	<select class="input" name="relationshipmanager" style="width:200px" id="opt9">
	<option value="0">-None-</option>			
	<option value="1">Admin</option>			
<?php
$getRM = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `employee`.`status`='1' AND `employee`.`delete`='0' AND (`profile`='11' || `profile`='16' || `profile`='19' || `profile`='28' || `profile`='29' || `profile`='30') ORDER BY `name` ASC",$con) or die(mysql_error()); 
while($rowRM = mysql_fetch_array($getRM))
{
?>
<option value="<?php echo $rowRM[1];?>"><?php echo $rowRM[0];?></option>
<?php
}
?>
</select>
</td>	


<td>
	<strong>Select Plan</strong>
	</td>
	<td style="">

	<select class="input" name="brokerageplan" style="width:200px">
	<option value="3">All</option>			
    <option value="1">Regular Plan</option>			
	<option value="2">Premium Plan</option>			
</select>
</td>	

	
</tr>
<tr>
<td align="right" style="width: 90px; height: 40px; padding-right:72px"><input name="Submit1" type="submit" value="Export" class="buttonBlue" /></td>
</tr>



</table>
</div>
</form>
<br/>
<br/>
<br/>
<br/>
</body>
</html>

