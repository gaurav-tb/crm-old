<?php
include("../../../include/conFigclient.php");

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
<td align="right" style="display:none"><b>Sorted By</b></td>

<td align="left"><select name="Select1" id="sort" style="display:none" class="input">
				<option value="`date` DESC,`time` DESC">Newest First</option>
				<option value="`date` ASC,`time` ASC">Oldest First</option>
							
			</select></td>
<tr>
<td><input type="hidden" value="<?php echo $getStr;?>" id="services"/></td>
	<td align="left">
	<!--onclick="getModule('clients/customView?status='+document.getElementById('cstview1').value+'&source='+document.getElementById('cstview2').value+'&response='+document.getElementById('cstview3').value+'&owner='+document.getElementById('cstview4').value+'&fromdate='+document.getElementById('cstview5').value+'&todate='+document.getElementById('cstview6').value+'&type='+document.getElementById('cstview7').value,'directResult','','Clients')"-->

	<div class="button leftRound" style="display:inline-block" onclick="getModule('client_archives/view?fdate='+document.getElementById('fdate').value+'&tdate='+document.getElementById('tdate').value+'&sort='+document.getElementById('sort').value,'viewmoodleContent','manipulatemoodleContent','Tips Archive')" >View</div>
	&nbsp;&nbsp;&nbsp;</td>
</tr>
	
</table>
</form>
</div>

</body>
</html>
