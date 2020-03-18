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
	<tr>
	<td align="right" style="width: 202px">
	<strong>From Date
	</strong>
	</td>
	<td style="">
	<input id="fdate" name="fdate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);"  type="text">
	</td></tr>
	<tr>
	<td align="right" style="width: 202px; font-size:12px; height: 36px;">
	<strong>To Date
	</strong>
	</td>
	<td align="left">
	<input id="tdate" name="tdate" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);"  type="text">
	</td>
</tr>
<tr>
		<td align="right" valign="top" style="height: 31px; width: 213px;"><b>
		Services</b></td>
		<td colspan="3" style="font-size:11px;">
		<?php
		$h=0;
		
$getProduct = mysql_query("SELECT `name`,`id` FROM `category` WHERE `delete` = '0' AND `id` != '1' AND `id` IN (SELECT `serviceid` FROM `tipsper` WHERE `userid` = '$loggeduserid')",$con) or die(mysql_error()); 
while($rowproduct = mysql_fetch_array($getProduct ))
{
?>
<input name="Checkbox1" type="checkbox" id="<?php echo 'arcServ'.$h;?>" value="<?php echo $rowproduct[1] ?>-0" onchange="if(this.value == '<?php echo $rowproduct[1]."-0";?>') this.value = '<?php echo $rowproduct[1]."-1";?>'; else this.value = '<?php echo $rowproduct[1]."-0";?>';"  /> <?php echo $rowproduct[0] ?>
<br/>
<?php
$getStr .= "&s".$h."='+document.getElementById('arcServ".$h."').value+'";
$h++;
}

$getStr = substr($getStr,0,-2);
?>
</td>

</tr>
<tr>
	<td align="right">Sender's Name
	</td>
	<td align="left">
	<select name="Select2" id="sname" class="input">
	<?php if(in_array("VAU_tips",$thisPer)) { ?>
	<option value="">All</option>
	<?php
	echo "SELECT DISTINCT `sentbyname`,`sentby` FROM `tips` ORDER BY `sentbyname` ASC";
	$getEmp = mysql_query("SELECT DISTINCT `sentbyname`,`sentby` FROM `tips` ORDER BY `sentbyname` ASC",$con) or die(mysql_error());
	while($rowEmp = mysql_fetch_array($getEmp))
	{
	?>
	<option value="<?php echo $rowEmp[1]?>"><?php echo $rowEmp[0]?></option>
	<?php
	}
	}
	else
	{
	$getEmp = mysql_query("SELECT DISTINCT `sentbyname`,`sentby` FROM `tips` WHERE `sentby` = '$loggeduserid'",$con) or die(mysql_error());
	$rowEmp = mysql_fetch_array($getEmp);?>
	<option value="<?php echo $rowEmp[1]?>"><?php echo $rowEmp[0]?></option>
	<?php }
	?>
	</select></td>
</tr>
<tr>
<td align="right"><b>Sorted By</b></td>

<td align="left"><select name="Select1" id="sort" class="input">
				<option value="`date` DESC,`time` DESC">Newest First</option>
				<option value="`date` ASC,`time` ASC">Oldest First</option>
				<option value="`sentbyname` ASC">Sent By User</option>
				<option value="`servicename` ASC">Services</option>
			
			</select></td>
<tr>
<td><input type="hidden" value="<?php echo $getStr;?>" id="services"/></td>
	<td colspan="4" align="left">
	<!--onclick="getModule('clients/customView?status='+document.getElementById('cstview1').value+'&source='+document.getElementById('cstview2').value+'&response='+document.getElementById('cstview3').value+'&owner='+document.getElementById('cstview4').value+'&fromdate='+document.getElementById('cstview5').value+'&todate='+document.getElementById('cstview6').value+'&type='+document.getElementById('cstview7').value,'directResult','','Clients')"-->

	<div class="button leftRound" style="display:inline-block" onclick="getModule('archives/view?fdate='+document.getElementById('fdate').value+'&tdate='+document.getElementById('tdate').value+'&sort='+document.getElementById('sort').value+'&sname='+document.getElementById('sname').value+'<?php echo $getStr;?>,'viewmoodleContent','manipulatemoodleContent','Tips Archive')" >View</div>
	&nbsp;&nbsp;&nbsp;<div  class="button rightRound" style="display:inline-block" onclick="exportTip('<?php echo $h?>')" >Export Tips</div>

	</td>
</tr>
	
</table>
</form>
</div>

</body>
</html>
