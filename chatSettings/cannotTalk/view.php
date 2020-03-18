<?php
include("../../include/conFig.php");
$getData = mysql_query("SELECT cannottalkto.id,employee.name,cannottalkto.desc,cannottalkto.modifieddate FROM cannottalkto,employee WHERE cannottalkto.userid= employee.id AND cannottalkto.delete = '0' ORDER BY cannottalkto.id DESC",$con) or die(mysql_error());
?>
<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Details </td>
			<td align="right" style="width: 70%">
						<input class="input" name="Text2" placeholder="Search Users" type="text" id="subsearch" size="20" /><input class="buttonGreen" name="Button1" style="width: 40px;" type="button" value="Go" onclick="getModule('Chat/cannotTalk/searchresult?term='+document.getElementById('subsearch').value,'directResult','','Searching for '+document.getElementById('subsearch').value+'..')" />&nbsp;&nbsp;
			<?php if(in_array('A_cannottalkto',$thisPer))
			{
			?>
			<input class="buttonGreen" name="Button1" onclick="getModule('chatSettings/cannotTalk/new','manipulateContent','viewContent','Chat Settings')" type="button" value="+1 New" /><?php } ?>
			
						
			&nbsp;</td>
		</tr>
	</table>
</div>
<div id="directResult" class="form">
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th style="display:none">
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
		<th style="width: 200px">User</th>
		<th style="min-width: 400px">Description</th>
		<?php if(in_array('D_cannottalkto',$thisPer))
			{
			?>
		<th>Delete</th>
	<?php } ?>
	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php echo 'Last Updated On '.date("d M,y h:i:s",strtotime($row[3]));?>">
		<td style="width: 20px;display:none">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
		<td class="blueSimpletext" onclick="getModule('chatSettings/cannotTalk/edit?id=<?php echo $row[0];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','Edit Settings')">
		<?php echo $row[1];?></td>
<td>
<?php echo $row[2];?>	
</td>
<?php if(in_array('D_cannottalkto',$thisPer))
			{
			?>
<td>
<img style="height:15px" src="images/delete-can.png" onclick="var r=confirm('Are You Sure You Want To Allow <?php echo ucwords($row[1]);?> To Chat With Everyone?');if (r==true){ getModule('chatSettings/cannotTalk/delete?id=<?php echo $row[0];?>&amp;i=<?php echo $i;?>','','','Delete');document.getElementById('fetchRow<?php echo $i;?>').style.display='none'}">
</td>	
<?php } ?>
</tr>
	<?php
$i++;
$Maxid = $row[0];
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
<br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>

