<?php
include("../include/conFig.php");
?>
<html>
<body>

<div class="moduleHeading">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Employee Manager mapping Report
</td>
<td align="right" style="width:70%">
&nbsp;</td>
</tr>
</table>
</div>
<form action="reports/generateemployeemanager.php" method="post" target="_blank">

<div class="form">
<table width="100%" cellpadding="0" cellspacing="10">
<tr>
	<td align="right" style="height: 36px">
	<strong>Select Teamleader</strong>
	</td>
	<td style="height: 36px">
   <select class="input" name="teamid" style="width: 200px" id="opt12">
  <option value="0">- All -</option>			
<?php
$getCity = mysql_query("SELECT  `name` ,  `id` 
FROM  `team` 
WHERE  `delete` =  '0'
ORDER BY name ASC",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
	</td>
	
    <td>
    </td>
	<td align="left">
	<input name="Submit1" type="submit" value="Export" class="buttonBlue" /></td>

</tr>

<!-- 
<tr>

	<td align="right" align="right">
	<strong>Lead Owner
	</strong>
	</td>
	<td style="width: 163px">
	<select class="input" name="leadowner" style="width: 200px" id="opt9">
	<option value="">-None-</option>			
<?php 
/*
$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
} */
?>
			</select>
	</td>

</tr> -->



</table>
</div>
</form>

</body>
</html>
