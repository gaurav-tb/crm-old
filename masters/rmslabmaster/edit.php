<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$getData = mysql_query("SELECT * FROM `rmslabMaster` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Edit Slab Range
</td>
<td align="right" style="width:70%">
<?php
if(isset($_GET['type']) && $_GET['type'] == 'search')
{
?>
<input name="Button1" type="button" value="< Back To Search Results" class="button" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
<?php
}
else if(isset($_GET['refresh']) && $_GET['refresh'] == '1')
{
?>
<input name="Button1" type="button" value="< Back To List" class="button" onclick="getModule('masters/leadsource/view','viewContent','manipulateContent','Lead Source')" />
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
<div style="padding:20px;" class="form"><table width="100%" cellpadding="0" cellspacing="10">

<tr>
<td align="right">Slab Range<span style="color:maroon">*</span></td>
<td align="left">
<input class="input" name="req" type="text" id="opt0"  value="<?php echo $row['slabName'] ?>" style="width: 320px" />
</td>
<td align="right">Incentives On Slab<span style="color:maroon">*</span></td>
<td align="left">
<input class="input" name="req" type="text" id="opt1" value="<?php echo $row['incentive'] ?>" style="width:320px" />
</td>

</tr>

<tr>
<td align="right">Slab Range From<span style="color:maroon">*</span></td>
<td align="left">
<input class="input" name="req" type="text" id="opt2" value="<?php echo $row['slabrangeFrom'] ?>" style="width: 320px" />
</td>

<td align="right">Slab Range To<span style="color:maroon">*</span></td>
<td align="left">
<input class="input" name="req" type="text" id="opt3" value="<?php echo $row['slabrangeTo'] ?>" style="width: 320px" />
</td>
</tr>

<tr>
<td align="right">Order In Report <span style="color:maroon">*</span></td>
<td align="left">
<select id="opt4" class="input"  name="req" style="width:320px" >
<option>Select Order</option>
<?php 
for($j=1;$j<=50;$j++)
{
?>	
<option  <?php if($j==$row['order']) { echo  "SELECTED";  }  ?> value="<?php echo $j; ?>"><?php echo $j; ?></option>	
<?php
}
?>
</select>
</td>
</tr>




<tr>
<td></td>
<td>

<input name="Button1" type="button" value="Update" class="buttonGreen" onclick="SaveData('masters/rmslabmaster/update?id=<?php echo $id;?>&i=<?php echo $_GET['i'];?>','opt','5','<?php echo $_GET['i'];?>','','','2')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Cancel" class="button" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>
</div>
