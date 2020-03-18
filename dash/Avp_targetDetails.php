<?php 
include("../include/conFig.php");
$empid=$_GET['empid'];
$empname=$_GET['empname'];

/*sales analysis barchart  start  */

$getLeadData = mysql_query("SELECT * FROM `contact` WHERE `ownerid` = '$empid'",$con) or die(mysql_error());
$rowLeadAll=mysql_num_rows($getLeadData);

$getLeadData = mysql_query("SELECT * FROM `contact` WHERE `ownerid` = '$empid' AND `latestresponse` != '1' AND `latestresponse` != '2' AND `latestresponse` != '33'",$con) or die(mysql_error());
$rowLeadCalled=mysql_num_rows($getLeadData);

$getLeadData = mysql_query("SELECT * FROM `contact` WHERE `ownerid` = '$empid' AND `latestresponse` = '34'",$con) or die(mysql_error());
$rowLeadPIInterest=mysql_num_rows($getLeadData);

$getLeadData = mysql_query("SELECT * FROM `contact` WHERE `ownerid` = '$empid' AND `latestresponse` = '9'",$con) or die(mysql_error());
$rowLeadInterest=mysql_num_rows($getLeadData);


$getLeadData = mysql_query("SELECT * FROM `contact` WHERE `ownerid` = '$empid' AND `converted` ='1'",$con) or die(mysql_error());
$rowLeadClient=mysql_num_rows($getLeadData);


/*sales analysis barchart end */


/*
$tar_month= mysql_query("SELECT * FROM `contact` WHERE converted = '1' AND `ownerid` ='$empid' AND conversiondate BETWEEN '$UpdateFrom' AND '$dateTo'",$con) or die(mysql_error());
$row_month=mysql_num_rows($tar_month);


$tar_week= mysql_query("SELECT `employee`.`target1`,`contact`.`ownerid`,`employee`.`target2`,`employee`.`target3`,`employee`.`target4` FROM `contact` INNER JOIN `employee` ON `contact`.`ownerid`=`employee`.`id` WHERE converted = '1' AND `ownerid` = '$empid' AND conversionrequestdate BETWEEN '2018-01-01' AND '2018-01-08'",$con) or die(mysql_error());
$row_week=mysql_num_rows($tar_week);
*/
?>

<div onclick="CloseDiv()" class="moduleHeading">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="left" style="width:100%;text-align:center;">
Performance Details For <span style="text-transform:capitalize"> <?php echo $empname;?></span></td>
</td>
</tr>
</table>
</div>
<div>
<script>
setInterval(function()
{
demo();
},10000);

function demo() 
{
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Sales Analysis"
	},
	axisY: {
		title: " No. of Leads"
	},
	data: [{        
	type: "column",  
	showInLegend: true, 
	legendMarkerColor: "grey",
		//legendText: "MMbbl = one million barrels",
	dataPoints:[      
	{ y:<?php echo $rowLeadAll ?>, label: "Total Leads" },
	{ y:<?php echo $rowLeadCalled ?>,  label: "Leads called" },
	{ y:<?php echo ($rowLeadInterest+$rowLeadPIInterest) ?>,  label: "Interested" },
	{ y:<?php echo $rowLeadClient ?>,  label: "Clients" }
	]
	}]
});
chart.render();

}
</script>

<div id="chartContainer" style="height:300px; width:70%;"></div>
</div>


