<?php
include("../include/conFig.php");
$TeamId = $_GET['TeamId'];
// $getData = mysql_query("SELECT employee.name, employee.id  FROM employee WHERE employee.delete = '0' AND employee.status = '1' AND employee.profile = '$profile' ORDER BY employee.name ASC",$con) or die(mysql_error());


$getData = mysql_query("SELECT employee.name,employee.id from employee inner join teamamtes on employee.id=teamamtes.mateid where teamid='$TeamId' and employee.delete='0' and employee.status='1' order by employee.name ASC",$con) or die(mysql_error());



$count = mysql_num_rows($getData);
?>
<div class="form" style="height:400px;">
<table width="100%" cellpadding="10" cellspacing="0" style="background:#f7f7f7;">
<?php
if($count == 0)
{
?>
<tr>
<td>
</td>
<td align="left" class="blueSimpletext" style="font-size:14px">No Users in the selected Team
</td>
</tr>
<?php
}
$g=0;
while($row= mysql_fetch_array($getData))
{
if($row[0] != '')
{
?>

<tr>
<td align="right" style="border-bottom:1px #ddd solid;font-size:14px;font-weight:bold"><?php echo $row['name'];?>
<input style="display:none" name="Text1" type="text" value="<?php echo $row[1];?>" id="alt<?php echo $g;?>" />
</td>

<td align="left" style="border-bottom:1px #ddd solid">
<input name="Text1" type="text" class="input" style="width: 493px" placeholder="Enter number of leads to be alloted to <?php echo ucwords($row[0]);?>" id="alt<?php echo $g+1;?>" onkeyup="countAllot('<?php echo $g+1;?>')" />
</td>
<td></td>

</tr>

<?php
$g+= 2;
}
}
if($count >= 1)
{
?>
<tr>
	<td align="right" style="border-bottom:1px #ddd solid;font-size:14px;font-weight:bold;vertical-align:top">Mass Update Lead Status</td>
	<td>
	
<select name="Select1" title="isNotNull" id="leadstatus" style="width:210px"  class="input">
		<!-- 	<option value="">Select Lead Status</option> -->
			<?php
			$getProfile = mysql_query("SELECT `name`,`id` FROM `leadstatus` WHERE `delete` = '0'",$con) or die(mysql_error());
			while($rowProfile= mysql_fetch_array($getProfile))
			{
			?>
			<option <?php if($rowProfile[1]==10) {  echo 'selected';   } ?> value="-<?php echo $rowProfile[1] ;?>-"><?php echo $rowProfile[0] ;?></option>
			<?php
			}
			?>
			
			</select>
	</td>
</tr>
<tr>
	<td align="right" style="border-bottom:1px #ddd solid;font-size:14px;font-weight:bold;vertical-align:top">Mass Update Call Back Date

    
	</td>
	<td><input  style="width: 200px" class="input" type="date" id="callbackdate" value="<?php echo $date; ?>"/></td>
</tr>
<?php } 
if($count >= 1)
{
?>
<tr>
<td>
<input name="Text1" type="text" style="display:none" value="<?php echo $g;?>" id="userSum" />
</td>
<td colspan="" align="left">
<input name="Button1" type="button" value="Allot" class="buttonBlue" style="width: 180px" onclick="SaveData('uploadlead/allot?leadstatus='+document.getElementById('leadstatus').value+'&callbackdate='+document.getElementById('callbackdate').value+'&lsid=<?php echo $_GET['lsid'];?>','alt','<?php echo $g;?>','','','','3');"  />
</td>
</tr>
<?php } ?>
</table>
<br/><br/><br/><br/><br/><br/>
</div>
