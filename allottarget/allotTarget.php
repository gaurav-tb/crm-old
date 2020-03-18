<?php
include("../include/conFig.php");
$rangeId = $_GET['range'];
$profile = $_GET['profile'];
if(isset($_GET['team'])) 
{
$team = $_GET['team'];
$getTarget = mysql_query("SELECT `target` FROM `teamtarget` WHERE `range` = '$rangeId' AND `teamid` = '$team'",$con) or die(mysql_error());
$rowT = mysql_fetch_array($getTarget);
$tg = $rowT[0]; 
$getData = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `id` IN (SELECT `mateid` FROM `teamamtes` WHERE `teamid` = '$team')",$con) or die(mysql_error());


}
else
{
$getData = mysql_query("SELECT employee.name, employee.id  FROM employee WHERE employee.delete = '0' AND employee.profile = '$profile' ORDER BY employee.name ASC",$con) or die(mysql_error());
}
?>
<div style="height:400px;overflow-x:hidden;overflow-y:auto">
<table width="100%" cellpadding="10" cellspacing="0" style="background:#f7f7f7;">
<?php
if(isset($_GET['team']))
{
?>
<tr>
<th align="left" colspan="2">Target Alloted To This Team: <span id="maxVal"><?php echo $tg;?></span> </th>
</tr>
<?php
}
?>
<?php
$getOld = mysql_query("SELECT `userid`,`target` FROM `target` WHERE `range` = '$rangeId'",$con) or die(mysql_error());
while($rowOld = mysql_fetch_array($getOld))
{
$already[$rowOld[0]] = $rowOld[1]; 
}
$g=1;
while($row= mysql_fetch_array($getData))
{
if($row[0] != '')
{
?>

<tr>
<td align="right" style="border-bottom:1px #ddd solid;font-size:14px;font-weight:bold"><?php echo $row[0];?>
<input style="display:none" name="Text1" type="text" value="<?php echo $row[1];?>" id="alt<?php echo $g;?>" />
</td>

<td align="left" style="border-bottom:1px #ddd solid">
<input name="Text1" type="text" onkeyup="" class="input" style="width: 493px" placeholder="Enter the expected target for <?php echo ucwords($row[0]);?>" id="alt<?php echo $g+1;?>" value="<?php echo $already[$row[1]];?>" />
</td>
<td></td>

</tr>

<?php
$g+= 2;
}
}
?>
<tr>
<td>
<input name="Text1" type="text" style="display:none" value="<?php echo $g;?>" id="userSum" />
</td>
<td colspan="" align="left">
<input name="Button1" type="button" value="Allot" class="buttonBlue" style="width: 180px" onclick="SaveData('allottarget/saveTarget?rangeId=<?php echo $_GET['rangeId'];?>','alt','<?php echo $g;?>','','','','3');"  />
</td>
</tr>
</table>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
</div>