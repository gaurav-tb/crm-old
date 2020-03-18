<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
<style type="text/css">
.inputCalender
{
	background:#fff url('images/calender.gif') no-repeat scroll right;
	border:1px #ccc solid;
-moz-border-radius: 2px;
	-webkit-border-radius: 2px;
	padding:3px;
	width:130px;
	font-family: 'Droid Sans',Tahoma,Verdana, Geneva, sans-serif;
	font-size:13px;
	cursor:pointer;

	
}
.calc td {
	font-family: 'Droid Sans',Tahoma,Verdana, Geneva, sans-serif;
	font-size: 11px;
	font-weight: bold;
	text-align: center;
	cursor: hand;
}
.calc th {
	font-family: 'Droid Sans',Tahoma,Verdana, Geneva, sans-serif;
	font-size:11px;
	text-align: center;
	cursor: default;
}

.calenderRow td
{
	background:#F7F1CC;
	color:#999;
}

.calenderRow td:hover
{
	background:#E68637;
	color:#fff;
}

.calendar {
	position: absolute;
	top: 100;
	left: 100;
		background-color: #fff;
		border:1px #ccc solid;
}
.hdr {
	font-family: 'Droid Sans',Tahoma,Verdana, Geneva, sans-serif;
	font-size:11px;
	color: white;
	text-align: center;
	cursor: hand;
	vertical-align: middle;
	background-color: #E68637;
	font-weight:bold;
}
.overlayDate {
	position: absolute;
	top: 0px;
	left: 0px;
	font-family: 'Droid Sans',Tahoma,Verdana, Geneva, sans-serif;
	font-size:11px;
	background-color: #E68637;
	color: #fff;
	z-index: 10;
	cursor: pointer;
	text-align: center;
	font-weight:bold;
}


</style>
<script src="scripts/calScript.js" type="text/javascript"></script>

</head>

<body>
<?php
include('calender/allCalender.php');
$date = date("Y-m-d");
?>
<input id="NewINV5" name="demo3" class="inputCalender" value="<?php echo $date;?>"  onclick="openCalendar(this);" readonly="readonly" style="width: 200px;" type="text"  />
&nbsp;&nbsp;&nbsp;
<input id="NewINV5" name="demo3" class="inputCalender" value="<?php echo $date;?>"  onclick="openCalendar(this);" readonly="readonly" style="width: 200px;" type="text"  />
&nbsp;&nbsp;&nbsp;
<input id="NewINV5" name="demo3" class="inputCalender" value="<?php echo $date;?>"  onclick="openCalendar(this);" readonly="readonly" style="width: 200px;" type="text"  />
&nbsp;&nbsp;&nbsp;
<input id="NewINV5" name="demo3" class="inputCalender" value="<?php echo $date;?>"  onclick="openCalendar(this);" readonly="readonly" style="width: 200px;" type="text"  />
&nbsp;&nbsp;&nbsp;
<input id="NewINV5" name="demo3" class="inputCalender" value="<?php echo $date;?>"  onclick="openCalendar(this);" readonly="readonly" style="width: 200px;" type="text"  />
</body>

</html>
