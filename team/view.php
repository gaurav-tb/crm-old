<?php
include("../include/conFig.php");
$getData = mysql_query("SELECT team.name,team.modifieddate,employee.name,team.id,team.desc FROM team,employee WHERE team.leader= employee.id AND team.delete = '0' ORDER BY team.id DESC",$con) or die(mysql_error());
?>
<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Teams </td>
			<td align="right" style="width: 70%">

			<?php if(in_array('A_team',$thisPer))
			{
			?>
			<input class="buttonGreen" name="Button1" onclick="getModule('team/new','manipulateContent','viewContent','New Team')" type="button" value="+1 New" /><?php } ?>
			<?php if(in_array('D_team',$thisPer))
			{
			?>

			<input id="" class="buttonnegetive" name="Button1" onclick="deleteData('team','Teams')" type="button" value="Delete Selected" /><?php } ?>
			</td>
		</tr>
	</table>
</div>
<div id="directResult">
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th>
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
		
	    <th style="width: 200px">Team Name</th>
	    <th style="width: 200px">Team Leader</th>
		<th style="min-width: 400px">Description</th>
	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php echo 'Last Updated On '.date("d M,y h:i:s",strtotime($row[1]));?>">
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[3];?>" /></td>
		
	
		
		<td class="blueSimpletext" onclick="getModule('team/edit?id=<?php echo $row[3];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','Fetching Data..')">
		<?php echo $row[0];?></td>
<td>
<?php echo $row[2];?>	
</td>	
	<td id="details">
	<?php echo $row[4];?>		
		</td>
		
		<td>
<?php echo $row[3];?>	
</td>	
	</tr>
	<?php
$i++;
$Maxid = $row[3];
$MaxI = $i;

}
?>
</table>
<div style="display:none">
<div id="moreData">
</div>
<div class="moduleFoot">
<input name="Text1" type="text" value="<?php echo $sql;?>" id="tlview" style="display:none" />
<input name="Text1" type="text" value="<?php echo $list;?>" id="idList" style="display:none" />
<input name="Text1" type="text" value="1" id="uptoFetch" style="display:none" />

	<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
	<span id="moreButton">
	<div onclick="moreData('leads/fetchmore?sql='+document.getElementById('tlview').value+'&upto='+document.getElementById('uptoFetch').value,'moreData','');" style="cursor: pointer;padding-top:5px;" id="fetchingDone">
	<img alt="" src="images/more.png" style="vertical-align: middle; width: 6px;" /> 
	More <span id="fetching" style="display: none">Fetching..</span>

	</div>
		</span>
</div>
</div>

</div>

