<?php
include("../../include/conFig.php");
$getData = mysql_query("SELECT leadstatus.name,leadstatus.modifieddate,employee.name,leadstatus.id,leadstatus.description,leadstatus.junk FROM leadstatus,employee WHERE leadstatus.updatedby = employee.id AND leadstatus.delete = '0' AND leadstatus.id != '1' ORDER BY leadstatus.id DESC LIMIT 100",$con) or die(mysql_error());
?>
<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Lead Status Master </td>
			<td align="right" style="width: 70%">
			<input class="input" name="Text1" placeholder="Search Lead Status" type="text" id="subsearch" /><input class="buttonGreen" name="Button1" style="width: 40px;" type="button" value="Go" onclick="getModule('masters/leadstatus/searchresult?term='+document.getElementById('subsearch').value,'directResult','','Searching for '+document.getElementById('subsearch').value+'..')" />&nbsp;&nbsp;
			<?php  if(in_array('A_contact',$thisPer))
			{
			?>
			<input class="buttonGreen" name="Button1" onclick="getModule('masters/leadstatus/new','manipulateContent','viewContent','Lead Status')" type="button" value="+1 New" /><?php } ?>
			<?php  if(in_array('D_contact',$thisPer))
			{
			?>
 
			<input id="" class="buttonnegetive" name="Button1" onclick="deleteData('leadstatus','Lead Source')" type="button" value="Delete Selected" /><?php } ?>
			</td>
		</tr>
	</table>
</div>
<div id="directResult" class="form">
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th>
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
		<th>Id</th>
		<th>Lead Status Name</th>
		<th>Description</th>
		<th>Details</th>
	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>">
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[3];?>" /></td>
		<td><?php echo $row['id']; ?></td>
		<td class="blueSimpletext" onclick="getModule('masters/leadstatus/edit?id=<?php echo $row[3];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','Fetching Data..')" style="width: 300px;">
		<?php echo $row[0];?></td>
		<td><?php echo substr($row[4],0,50)."..";?></td>
		<td id="details" style="width: 400px;"><?php echo "Last Updated By ".$row[2]." on ".date("d-m-Y H:i:s",strtotime($row[1]));?>
		</td>
	</tr>
	<?php
$i++;
$Maxid = $row[3];
$MaxI = $i;
}
?>
</table>
<div id="moreData">
</div>
<div class="moduleFoot">
	<div style="float: right;">
		&nbsp;</div>
	<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
	<div onclick="fetchMore('masters/leadstatus/fetchmore');" style="cursor: pointer;padding-top:5px;" id="fetchingDone">
	<img alt="" src="images/more.png" style="vertical-align: middle; width: 6px;" /> 
	More <span id="fetching" style="display: none">Fetching..</span></div>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
