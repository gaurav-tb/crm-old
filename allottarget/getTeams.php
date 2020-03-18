<?php
include("../include/conFig.php");
$rangeId = $_GET['range'];
$getData = mysql_query("SELECT team.name, team.id  FROM team WHERE team.delete = '0' ORDER BY team.name ASC",$con) or die(mysql_error());
?>

<table width="100%" cellpadding="10" cellspacing="0" style="background:#f7f7f7;">
<?php
$getOld = mysql_query("SELECT `teamid`,`target` FROM `teamtarget` WHERE `range` = '$rangeId'",$con) or die(mysql_error());
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
<input name="Text1" type="text" class="input" style="width: 493px" placeholder="Enter the expected target for <?php echo ucwords($row[0]);?>" id="alt<?php echo $g+1;?>" value="<?php echo $already[$row[1]];?>" />
</td>
<td align="left">
<?php
if($already[$row[1]] != '')
{
$getTeam = mysql_query("SELECT SUM(target.target) FROM target WHERE target.range = '$rangeId' AND target.userid IN (SELECT teamamtes.mateid FROM teamamtes WHERE  teamamtes.teamid = '$row[1]')",$con) or die(mysql_error());
$rowTeam = mysql_fetch_array($getTeam);
if($rowTeam[0] == '')
{
$alt = 0;
}
else
{
$alt = $rowTeam[0];

}
echo $alt." Alloted to downline";
}
else
{
 echo "--";
}
?>

</td>

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
<input name="Button1" type="button" value="Allot" class="buttonBlue" style="width: 180px" onclick="SaveData('allottarget/saveteamTarget?rangeId=<?php echo $_GET['rangeId'];?>','alt','<?php echo $g;?>','','','','3');"  />
</td>
</tr>
</table>
