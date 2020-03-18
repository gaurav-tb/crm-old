<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$getData = mysql_query("SELECT * FROM `product` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Edit Product
</td>
<td align="right" style="width:70%">
<?php
if(isset($_GET['type']) && $_GET['type'] == 'search')
{
?>
<input name="Button1" type="button" value="< Back To Search Results" class="button" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
<?php
}
else
{
?>
<input name="Button1" type="button" value="< Back To List" class="button" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
<?php
}
?>
</td>
</tr>
</table>
</div>
<div style="">
<table width="100%" cellpadding="0" cellspacing="10"  class="form">
<tr>
<td align="right">Service Category<span style="color:maroon">*</span></td><td align="left">

<select name="Select1" class="input" style="width:300px;" id="opt7">
<?php
$getCat = mysql_query("SELECT `name`,`id` FROM `category` WHERE `delete` = '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowCat = mysql_fetch_array($getCat))
{
?>
				<option <?php if($row['category'] == $rowCat[1]) echo "selected='selected'";  ?> value="<?php echo $rowCat[1];?>"><?php echo $rowCat[0];?></option>
				
<?php
}
?>				
			</select>
	
	
	</td>
</tr>

<tr>
<td align="right">Name<span style="color:maroon">*</span></td><td align="left">
	<input class="input" name="req" type="text" id="opt0" value="<?php echo $row['name'];?>" style="width: 384px"  /></td>
</tr>
<tr>
<td align="right">Code<span style="color:maroon">*</span></td><td align="left"><input class="input" name="req" type="text" id="opt1" value="<?php echo $row['code'];?>" style="width: 384px"  /></td>
</tr>
<tr>
<td align="right" valign="top">Description</td><td align="left">
<textarea name="TextArea1" id="opt2" class="input" style="width: 384px; height: 109px" ><?php echo $row['description'];?></textarea>
</td>
</tr>

<tr>
<td align="right">Amount<span style="color:maroon">*</span></td><td align="left"><input class="input" name="reqisnum" type="text" id="opt3" value="<?php echo $row['amount'];?>" /></td>
</tr>
<tr>
<td align="right">Unit<span style="color:maroon"></span></td><td align="left"><input class="input" name="unit" type="text" id="opt4" value="<?php echo $row['unit'];?>"  /></td>
</tr>
<tr>

<td align="right">Money Back<span style="color:maroon"></span></td><td align="left">
<select class="input" name="Select1" id="opt5" >
				<option <?php if($row['moneyback'] == 'No') echo "selected='selected'"; ?> value="No">No</option>
								<option <?php if($row['moneyback'] == 'Yes') echo "selected='selected'"; ?>  value="Yes">Yes</option>

			</select>
</td>
</tr>
<tr>
<td align="right">Quantity<span style="color:maroon"></span></td><td align="left"><input style="width: 384px"  class="input" name="isnum" type="text" id="opt6" value="<?php echo $row['quantity'];?>" /></td>
</tr>
<tr>
<td></td>
<td>
			<?php  if(in_array('U_product',$thisPer))
			{
			?>

<input name="Button1" type="button" value="Update" class="buttonGreen" onclick="SaveData('masters/product/update?id=<?php echo $id;?>&i=<?php echo $_GET['i'];?>','opt','8','<?php echo $_GET['i'];?>','','','2')" />&nbsp;&nbsp;<?php } ?>
<input name="Button1" type="button" value="Cancel" class="buttonnegetive" id="" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>

</div>
