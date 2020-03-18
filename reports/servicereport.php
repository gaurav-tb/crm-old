<?php
include("../include/conFig.php");
?>
<html>
<body>

<div class="moduleHeading">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Service/Freetrial Report
</td>
<td align="right" style="width:70%">
&nbsp;</td>
</tr>
</table>
</div>
<form action="reports/generateservice.php" method="post">
<div class="form">
<table width="100%" cellpadding="10" cellspacing="0">
<tr>
	<td align="right" style="width: 202px">
	From Date
	</td>
	<td style="">
	<input id="from0" name="fromdate" class="inputCalender" value="<?php echo $date;?>"  onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
	<td align="right" style="; width: 202px; font-size:12px; height: 36px;">
	To Date
	</td>
	<td align="left">
	<input id="to0" name="todate" class="inputCalender" value="<?php echo $date;?>"   onclick="openCalendar(this);" readonly="readonly" type="text">
	</td>
</tr>
<tr>
<td align="right">Type	</td>

<td align="left">
<select name="type" class="input">
				<option value="">Any</option>

				<option value="C">Service Call</option>
				<option value="F">Free Trial</option>

			</select></td>


			


</tr>


<tr>
<td align="right">Product	
</td>

<td align="left">
<select  class="input" name="product" onchange="addbillrow(this.value)" style="width: 200px">
<option value="">Any</option>
			<?php
		$gethata = mysql_query("SELECT * FROM  `product` where `delete` ='0' AND `id` != '1' ",$con) or die(mysql_error());
		while($row = mysql_fetch_array($gethata))
		{
		?>
			<option value="<?php echo $row['name'];?>*<?php echo $row['amount'];?>*<?php echo $row['id'];?>">
			<?php echo $row['name'];?></option>
			<?php
		}
		
		?></select>


</td>
<td align="right" style="width: 202px">Owner</td>
<td>

<select class="input" name="leadowner" style="width: 200px" id="opt9">
	<option value="">Any</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>


</td>
</tr>
<tr>
<td align="right">Approved</td>
<td align="left">

<select class="input" name="approved" style="width: 200px" id="opt9">
	<option value="">Any</option>			
<option value="1">Yes</option>
<option value="0">No</option>

			</select>


</td>

</tr>
<tr>
<td></td>
	<td colspan="4" align="left">
	<input name="submit" type="submit" value="Export" class="buttonBlue" style="width: 130px; height: 26px" /></td>
</tr>
	
</table>
</div>
</form>

</body>
</html>
