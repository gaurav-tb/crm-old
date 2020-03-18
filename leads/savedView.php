<?php
include("../include/conFig.php");
$view = $_GET['view'];
$getView = mysql_query("SELECT `sql` FROM `customview` WHERE `id` = '$view'",$con) or die(mysql_error());
$rowView = mysql_fetch_array($getView);
$getdata=mysql_query($rowView[0],$con) or die(mysql_error());
?>


<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th style="">
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
		<th style="">Lead Owner</th>
		<th style="">Name</th>
		<th style="">Mobile</th>
		<th style="">Phone</th>
		<th style="">City</th>

	</tr>

<?php
$i=0;
while($row = mysql_fetch_array($getdata))
{
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>">
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[5];?>" /></td>
		<td  onclick="getModule('leads/edit?id=<?php echo $row[5];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','Fetching Data..')" style="width: 300px;">
		<?php echo $row[0];?>
		</td>
		<td>
		<?php echo $row[1]."".$row[2];?>
		</td>
		<td>
		<?php echo $row[3];?>
		</td>
		<td>
		<?php echo $row[4];?>
		</td>
		<td>
		<?php echo $row[6];?>
		</td>	
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
<input name="Text1" type="text" value="<?php echo $rowView[0];?>" id="tlview" />	<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
	<div onclick="fetchMore('leads/fetchmore');" style="cursor: pointer;padding-top:5px;" id="fetchingDone">
	<img alt="" src="images/more.png" style="vertical-align: middle; width: 6px;" /> 
	More <span id="fetching" style="display: none">Fetching..</span></div>
</div>


