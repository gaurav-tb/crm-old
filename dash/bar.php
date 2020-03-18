<?php
include("../include/conFig.php");
function getNextDate($current)
{
$time = strtotime($current);
$time = $time + (24*60*60);
return date("Y-m-d",$time);
}
$sevenDays = $date;
$time = time();
$time = $time - (7*24*60*60);
$current = date("Y-m-d",$time);

while($current <= $sevenDays)
{
$day = date("D",strtotime($current));
	if($day != 'Sun')
	{
		$dayStr .= "'".$day."',";
		$range[] .= $current;
	}
$current = getNextDate($current);
}

foreach($range as $val)
{
$from = $val." 00:00:00";
$to = $val." 23:59:59";

$getCalls = mysql_query("SELECT COUNT(`id`) FROM `noteline` WHERE `subject` = 'Call' AND `updatedby` = '$loggeduserid' AND `createdate` BETWEEN  '$from' AND '$to'",$con) or die(mysql_error());
$rowCalls = mysql_fetch_array($getCalls);
$count = $rowCalls[0];
//$count = $count*100; 
$countstr .= $count.",";
}
$countstr = substr($countstr,0,-1);
$dayStr= substr($dayStr,0,-1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "xhtml11.dtd">
<html debug="true">
<head>
<title>.::Supply Chain Management System::.</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../../favicon.ico"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
jQuery.noConflict();
</script>
<script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript" src="http://www.highcharts.com/js/modules/exporting.js"></script>
<script type="text/javascript" src="http://www.highcharts.com/highslide/highslide-full.min.js"></script>
<script type="text/javascript" src="http://www.highcharts.com/highslide/highslide.config.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="http://www.highcharts.com/highslide/highslide.css" />
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="http://www.highcharts.com/highslide/highslide-ie6.css" />
<![endif]-->
<script type="text/javascript">

var example = 'column-basic',

	theme = 'default';

</script>
<script type="text/javascript" src="http://www.highcharts.com/demo/scripts.js"></script>
<script type="text/javascript">

	Highcharts.theme = { colors: ['#4572A7'] };// prevent errors in default theme

	var highchartsOptions = Highcharts.getOptions(); 

</script>

<link rel="stylesheet" href="http://www.highcharts.com/templates/yoo_symphony/css/template.css" type="text/css" />
<link rel="stylesheet" href="http://www.highcharts.com/templates/yoo_symphony/css/variations/brown.css" type="text/css" />
<link href="http://www.highcharts.com/demo/demo.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
		var chart;
		jQuery(document).ready(function() {
			chart = new Highcharts.Chart({
				chart: {
					renderTo: 'container',
					defaultSeriesType: 'column'
				},
				title: {
					text: 'Weekly Statistics'
				},
	
				xAxis: {
					categories: [<?php echo $dayStr;?>]
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Calls'
					}
				},
	
				tooltip: {
					formatter: function() {
						return ''+
							this.series.name +': '+ this.y +' calls';
					}
				},
				legend: {
					layout: 'vertical',
					backgroundColor: Highcharts.theme.legendBackgroundColor || '#FFFFFF',
					align: 'left',
					verticalAlign: 'top',
					x: -100,
					y: -100,
					floating: true,
					shadow: true
				},
				plotOptions: {
					column: {
						pointPadding: 0.2,
						borderWidth: 0
					}
				},
			        series: [{
					name: 'Calls',
					data: [<?php echo $countstr;?>]
			
				}]
			});
			
			
		});</script>
</head>

<body>
	<div id="container" class="highcharts-container" style="height:200px; margin: 0 2em; clear:both; width: 450px;display:none">

	</div>	
	<div id="LoadingChart">
	<center>
	<img src="../images/loading.gif" style=" width:30px;padding-top:75px" alt=""/>
	</center>
	</div>
	<script type="text/javascript">
	setTimeout("cleanify()",3000);
	
	function cleanify()
	{
		var x= document.getElementById('container').innerHTML;
		x = x.replace('<tspan x="440">Highcharts.com</tspan>','');
		document.getElementById('container').innerHTML= x;
		document.getElementById('container').style.display='block';
	} 
	</script>
</body>
</html>
