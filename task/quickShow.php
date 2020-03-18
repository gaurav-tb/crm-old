<?php
include("../include/conFig.php");
$cid = $_GET['cid'];
$getData = mysql_query("SELECT employee.name,task.subject,task.status,task.reminddate,task.modifieddate,task.id FROM task,employee WHERE employee.id = task.owner AND task.owner = '$loggeduserid' AND task.delete = '0' AND task.contactid = '$cid' ORDER BY task.id DESC LIMIT 100",$con) or die(mysql_error());
?>
<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Previous Tasks For <?php echo $_GET['name'];?></td>
			<td align="right">
			<input name="Button1" type="button" value="<Back To List" class="button"  onclick="getModule('task/quickNew?cid=<?php echo $_GET['cid']?>&name=<?php echo $_GET['name'];?>&mobile=<?php echo $_GET['mobile'];?>','manipulatemoodleContent','viewmoodleContent','Task  For <?php echo $_GET['name'];?>')"/>
			</td>
		</tr>
	</table>
</div>
<div id="" class="form">
<table id="" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th>Task owner</th>
		<th>Subject</th>
		<th>Status</th>
		<th>Duedate</th>
	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php echo "Last Updated By  ".$row[0]?>">

		<td style="width: 300px;">
		<?php echo $row[0];?></td>
		<td><?php echo $row[1]?></td>
		<td><?php if($row[2] == 0) echo open;
		else
		echo close;
		?></td>
		<td><?php echo $row[3]?></td>
	</tr>
	<?php
}?>

</table>
<br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
