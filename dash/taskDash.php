<?php
include("../include/conFig.php");
$getTask = mysql_query("SELECT `subject`, `description`,`id`,`reminddate` FROM `task` WHERE `status` = '0' AND`profile` = '1' AND `owner` = '$loggeduserid' AND `delete` = '0' ORDER BY `reminddate` ASC",$con) or die(mysql_error());
$i=0;
while($row = mysql_fetch_array($getTask))
{
$remindDate = date('Y-m-d', strtotime($row[3]));
//echo "<br/>".$date;
if($remindDate > $date)
{
$color = "#444";
 }
else
{
	 if($remindDate == $date)
	{
$color = "#009900";
	}				
	else
	{
$color = "#b82121";
	}
}												
	?>
	<div style="border-bottom:1px #666 solid;padding:5px 5px;background:#fff;min-height:30px;"  id="taskRow<?php echo $i;?>">
<div style="padding:5px;;float:right">

						<img src="images/approved.png" style="height:15px;cursor:pointer" title="Mark As Done" alt=""   onclick="document.getElementById('taskRow<?php echo $i;?>').style.textDecoration='line-through';getModule('task/markdone?id=<?php echo $row[2]?>','','','');"/>
						<img src="images/delete-can.png" style="height:15px;cursor:pointer" title="Delete Task"  alt=""  onclick="getModule('task/deleteSingle?id=<?php echo $row[2]?>&table=task','','taskRow<?php echo $i;?>','')"/>
		</div>
	<span style="text-transform:capitalize;cursor:pointer;font-size:12px;color:<?php echo $color;?>" onclick="getModule('task/edit?id=<?php echo $row[2];?>','manipulateContent','viewContent','Task')"><strong><?php echo $row[0]?></strong></span><br/>
	<span style="font-size:11px;">
<?php echo $row[1]?>						
</span>
</div>
<?php
$i++;
$Maxid = $row[2];
$MaxI = $i;
}
?>
	<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />




