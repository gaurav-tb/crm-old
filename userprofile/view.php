<?php
include("../include/conFig.php");
$getData = mysql_query("SELECT * FROM employee WHERE id = '$loggeduserid'",$con) or die(mysql_error());

$row = mysql_fetch_array($getData);
$id=$row['id'];
?>
<html>
<body>
<form action="update.php" method="post" enctype="multipart/form-data">
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
My Profile
</td>
</tr>
</table>
</div>
<div style="background:#eee">
<table width="100%" cellpadding="0" cellspacing="10" class="form">
<tr>
<td align="right" style="width:294px;">Username </td><td style=""><input class="inputDisabled" name="req" type="text" id="opt0" readonly="readonly" value="<?php echo $row['username'];?>"/></td>
<td align="right" style="width:294px">Password </td>
	<td align="left" style=""><input class="input" name="req" type="text" id="opt1" value="<?php echo $row['password'];?>"  /></td>
</tr>
<tr>
<td align="right" style="">Name </td>
	<td align="left" style=""><input class="input" name="req" type="text" id="opt2"  value="<?php echo $row['name'];?>" />
	<input name="Text1" type="text" id="opt2" style="display:none" />
	</td>


	<td align="right" style="">Email</td>
	<td align="left" style="width: 500px; ;"><input class="input" type="text"  id="opt3"  value="<?php echo $row['email'];?>"/></td>

</tr>

<tr>

<td align="right" style="">Mobile </td>
	<td align="left" style="; width: 500px;"><input class="input" name="reqismob" type="text" id="opt4" value="<?php echo $row['mobile'];?>" /></td>

<td align="right" style="">Landing number 2</td>
	<td align="left" style="width: 500px; ;"><input class="input" type="text"  id="opt5"  value="<?php echo $row['landing_number_2'];?>"/></td>
</tr>


<tr>

<td align="right" style="">Landing number 3</td>
	<td align="left" style="width: 500px; ;"><input class="input" type="text"  id="opt6"  value="<?php echo $row['landing_number_3'];?>"/></td>

<td align="right" style="">Landing number 4</td>
	<td align="left" style="width: 500px; ;"><input class="input" type="text"  id="opt7"  value="<?php echo $row['landing_number_4'];?>"/></td>
	


</tr>

<tr>
<td></td>
<td><input name="Button1" type="button" value="Update" class="buttonGreen" onclick="SaveData('userprofile/update?id=<?php echo $id;?>&userid=<?php echo $id;?>','opt','8','<?php echo $_GET['i'];?>','','','3')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Cancel" class="buttonnegetive" id="negetive" />
</td>
</tr>
</table>
</div>
</form>
</body>
</html>

