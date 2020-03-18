<?php 
include("../include/conFig.php");

$fromdate=$_GET['fdate'];
$todate=$_GET['tdate'];
$sort = $_GET['sort'];
$sname = $_GET['sname'];
$c = 0;
//print_r($_GET);
foreach($_GET as $key => $val)
{
	if($key != 'fdate' && $key != 'tdate' && $key != 'sort')
	{
		$temp = explode("-",$val);
		if($temp[1] == '1')
		{
		$serv = "-".$temp[0]."-"; 
		$servStr .= "`services` LIKE '%$serv%' OR ";
		$c++;
		}
	}
}
if($sname != "")
{
	$snameStr = " `sentby` = '$sname' ";
}
else
{
	$snameStr = " 1 = 1 ";
}
if($c == 0)
{
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<th align="left">Tips
<div class="button" style="display:inline-block;float:right;margin:5px;" onclick="ToggleBox('viewmoodleContent','none','');ToggleBox('manipulatemoodleContent','block','')"><img src="images/back.png" style="vertical-align:middle" alt="">&nbsp;&nbsp;Back To List </div> 
</th>
</tr>
</table>
</div>
<br/><br/>

<div class="buttonBlue" style="width:220px;height:25px; font-size:16px;" title="Click Here" onclick="ToggleBox('viewmoodleContent','none','');ToggleBox('manipulatemoodleContent','block','')">Please select atleast one service</div>

<?php
}
else
{


$servStr = substr($servStr ,0,-3);
$sql = "SELECT * FROM `tips` WHERE `date` BETWEEN '$fromdate' AND '$todate' AND ".$snameStr." AND (".$servStr.")  ORDER BY ".$sort;
$getdata=mysql_query($sql,$con) or die(mysql_error());


?>

<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<th align="left">Tips
<div class="button" style="display:inline-block;float:right;margin:5px;" onclick="ToggleBox('viewmoodleContent','none','');ToggleBox('manipulatemoodleContent','block','')"><img src="images/back.png" style="vertical-align:middle" alt="">&nbsp;&nbsp;Back To List </div> 
</th>
</tr>

</table>
</div>
<br/><br/><br/>
<div style="height:500px;overflow-x:hidden;overflow-y:auto">
<table cellpadding="5" cellspacing="0" width="100%">
<?php

while($row = mysql_fetch_array($getdata))
{
?>
	<tr>
		<td class="tip" style="line-height:180%;font-size:11px;font-weight:normal">
		<div style="float:right;color:#999;;font-weight:normal;font-size:11px;text-align:right">
		<?php 
		echo date("d M,Y",strtotime($row['date']))." ".$row['time'];
		echo "<br/><span style='color:#75AE5D'>".$row['servicename']."</span>";
		?>
		</div>
		<strong style="color:#000;"><?php echo $row['sentbyname'];?>:<br/></strong>
		<?php echo $row['tip'];?>
		</td>
		
		</tr>
		<?php  }?>
</table>
<br/><br/><br/><br/><br/>
</div>
<?php }?>