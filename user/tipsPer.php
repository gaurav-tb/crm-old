<?php
include("../include/conFig.php");
$userid = $_GET['id'];
$name = $_GET['name'];

?>
<div class="moduleHeading" align="left">Set Tips Permission for <?php echo $name;?>
</div>

<table width="100%" cellpadding="5" cellspacing="0">
<tr>
		<td align="center" style="font-size:16px;background:#eee" class="blueSimpletext">
		Select Services
		</td>
		
</tr>
<tr><td><span class="blueSimpletext" onclick="CheckedAll('tipChk',true);document.getElementById('tipsperm0').checked = true" style="cursor:pointer;padding-left:5px">Check All</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="blueSimpletext" style="cursor:pointer" onclick="CheckedAll('tipChk',false)">Uncheck All</span>
</td></tr>
<table cellpadding="0" cellspacing="5" class="form" width="100%" style="padding-top:7px;padding-left:20px" id="tipChk">
<input name="Checkbox1" type="checkbox" checked="checked" id="tipsperm0" value="0" style="display:none" />

<tr>

		<?php
		$h= 1;
		$g=0;
$getOld = mysql_query("SELECT * FROM `tipsper` WHERE `userid` = '$userid'",$con) or die(mysql_error());
while($rowOld = mysql_fetch_array($getOld))
{
$services[] .= $rowOld['serviceid']; 
}
$getProduct = mysql_query("SELECT `name`,`id` FROM `category` WHERE `delete` = '0' AND `id` != '1' ORDER BY `name` ASC",$con) or die(mysql_error()); 
while($rowproduct = mysql_fetch_array($getProduct))
{
?>
<td style="padding-right:70px" >
<input name="Checkbox1" onclick="document.getElementById('tipsperm0').checked = true" type="checkbox" <?php if(in_array($rowproduct[1],$services)) echo "checked='checked'" ;?> id="<?php echo 'tipsperm'.$h;?>" value="<?php echo $rowproduct[1] ?>" /> <?php echo $rowproduct[0] ?>
<?php
if($g%2 != 0)
{
echo "</tr><tr>";
}
$g++;
$h++;
}
?>
</td>
</tr>
</table>
<div style="padding-top:20px">
<input name="Button1" type="button" value="Save Permission" class="buttonBlue" onclick="SaveData('user/saveTipsPer?userid=<?php echo $userid;?>','tipsperm','<?php echo $h;?>','','','','3')" />
</div>