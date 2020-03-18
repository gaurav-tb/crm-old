<?php
include("../include/conFig.php");
$id = $_GET['id'];
$getData = mysql_query("SELECT * FROM `country` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Edit Country Name
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
<form method="post" action="whatsapp/whatsapp.php" target="targetFrame" enctype="multipart/form-data">
<div style="padding:20px;" class="form"><table width="100%" cellpadding="0" cellspacing="10">

<!-- 
<tr>
<td align="right" style="height: 36px">Send To<span style="color:maroon">*</span></td>
<td align="left" style="height: 36px">
<select class="input" id="opt0"> 
<option value="1">Leads</option>
<option value="2">Clients</option>
<option value="3">Both</option>
</select>
</td>
</tr>-->

<tr>
<td align="right" style="height: 36px">Mobile Numbers<span style="color:maroon">*</span></td>
<td align="left" style="height: 36px">
<input type="file"  name="csv"/>
</td>
</tr>   

<tr>
<td align="right" style="height: 36px">Message Body<span style="color:maroon">*</span></td>
<td align="left" style="height: 36px">
<textarea name="body" id="opt1" class="input" style="width:500px;height:70px;"><?php echo $row['Comments']; ?></textarea>		
</td>
</tr>


<tr>
<td style="height:40px"></td>
<td style="height:40px">
<?php if(in_array('U_country',$thisPer))
{
?>
<input type="submit"  class="buttonGreen" value="Submit"/>

<!-- <input name="Button1" type="button" value="Send" class="buttonGreen" onclick="WhatsappSend();" />&nbsp;&nbsp;
-->
<?php } ?>
<input name="Button1" type="button" value="Cancel" class="buttonnegetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>
</div>
</form>
