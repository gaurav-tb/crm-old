<?php
include("../include/conFig.php");
$getData = mysql_query("SELECT employee.name,task.subject,task.status,task.reminddate,task.modifieddate,task.id FROM task,employee WHERE employee.id = task.owner AND task.owner = '$loggeduserid' AND task.delete = '0' ORDER BY task.id DESC LIMIT 100",$con) or die(mysql_error());
?>
<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Tasks</td>
			<td align="right" style="width: 70%">
			<input class="input" name="Text1" placeholder="Search Tasks" type="text" id="subsearch" /><input class="buttonGreen" name="Button1" style="width: 40px;" type="button" value="Go" onclick="getModule('task/searchresult?term='+document.getElementById('subsearch').value,'directResult','','Searching for '+document.getElementById('subsearch').value+'..')" />&nbsp;&nbsp;
			<input class="buttonGreen" name="Button1" onclick="getModule('task/new','manipulateContent','viewContent','New Task')" type="button" value="+1 Add New Task" />
			<input id="" class="buttonnegetive" name="Button1" onclick="deleteData('task','Task')" type="button" value="Delete Selected" />
			</td>
		</tr>
	</table>
</div>
<div id="directResult" class="form">
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th>
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
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
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[5];?>" /></td>
		<td class="blueSimpletext" onclick="getModule('task/edit?id=<?php echo $row[5];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','Task')" style="width: 300px;">
		<?php echo $row[0];?></td>
		<td><?php echo $row[1]?></td>
		<td><?php if($row[2] == 0) echo open;
		else
		echo close;
		?></td>
		<td><?php echo $row[3]?></td>
	</tr>
	<?php
$i++;
$Maxid = $row[5];
$MaxI = $i;
}
?>
</table>
<div id="moreData">
</div>
<div class="moduleFoot">
	<div style="float: right;">
</div>
	<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
	<div onclick="fetchMore('task/fetchmore');" style="cursor: pointer;padding-top:5px;" id="fetchingDone">
	<img alt="" src="images/more.png" style="vertical-align: middle; width: 6px;" /> 
	More <span id="fetching" style="display: none">Fetching..</span></div>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
