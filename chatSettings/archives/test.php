<?php
include("../include/conFig.php");
?>
<html>
<body>

<div class="moduleHeading">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%"><b>Tips Archives</b>
</td>
<td align="right" style="width:70%">
&nbsp;</td>
</tr>
</table>
</div>

<div class="form">
<form action="view.php" method="post">
<table width="100%" cellpadding="10" cellspacing="0">
<tr ><td style="text-align:right"><strong>Select Date Range</strong></td></tr>
<tr>
	<td align="right" style="width: 202px">
	From Date
	</td>
	<td style="">
	<input id="from" name="fdate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);"  type="text">
	</td></tr>
	<tr>
	<td align="right" style="; width: 202px; font-size:12px; height: 36px;">
	To Date
	</td>
	<td align="left">
	<input id="to" name="tdate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);"  type="text">
	</td>
</tr>
<tr>
		<td align="right" valign="top" style="height: 31px; width: 213px;"><b>
		Services</b></td>
		<td colspan="3" style="font-size:11px;">
		<?php
		$h= 15;
$getProduct = mysql_query("SELECT `name`,`id` FROM `category` WHERE `delete` = '0' AND `id` != '1'",$con) or die(mysql_error()); 
while($rowproduct = mysql_fetch_array($getProduct ))
{
?>
<input name="Checkbox1" type="checkbox" id="<?php echo 'opt'.$h;?>" value="<?php echo $rowproduct[1] ?>" /> <?php echo $rowproduct[0] ?>
<br/>
<?php
$h++;
}
?>
</td>

</tr>


<tr>
<td align="right"><b>Sorted By</b></td>

<td align="left"><select name="Select1">
				<option></option>
			</select></td>
<tr>
<td></td>
	<td colspan="4" align="left">
	<!--onclick="getModule('clients/customView?status='+document.getElementById('cstview1').value+'&source='+document.getElementById('cstview2').value+'&response='+document.getElementById('cstview3').value+'&owner='+document.getElementById('cstview4').value+'&fromdate='+document.getElementById('cstview5').value+'&todate='+document.getElementById('cstview6').value+'&type='+document.getElementById('cstview7').value,'directResult','','Clients')"-->
	<input name="submit" type="button" value="Get Tips"  class="buttonBlue" style="width: 100px; height: 26px" onclick="getModule('archives/view','manipulateContent','viewContent','Loading..')" />&nbsp;&nbsp;

		<input name="submit" type="submit" value="Export Tips" class="buttonBlue" style="width: 100px; height: 26px" />

	</td>
</tr>
	
</table>
</form>
</div>

</body>
</html>
