<?php
include("../../include/conFig.php");
$getData = mysql_query("SELECT `rmslabMaster`.`id`,`rmslabMaster`.`slabName`,`rmslabMaster`.`slabrangeFrom`,`rmslabMaster`.`slabrangeTo`,`rmslabMaster`.`incentive`,`rmslabMaster`.`modifiedDate`,`rmslabMaster`.`order` FROM 	`rmslabMaster` WHERE `rmslabMaster`.`delete`='0'",$con) or die(mysql_error());
?>
<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">RM Slab Master </td>
			<td align="right" style="width: 70%">
		    <input class="buttonGreen" name="Button1" onclick="getModule('masters/rmslabmaster/new','manipulateContent','viewContent','Slab Master')" type="button" value="+1 New Slab" />
			<input id="" class="buttonnegetive" name="Button1" onclick="deleteData('rmslabMaster','Slab Master')" type="button" value="Delete Selected" />
			</td>
		</tr>
	</table>
</div>
<div id="directResult" class="form">
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th>
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
		<th>Slab Range</th>
		<th>Slab Range From</th>
		<th>Slab Range To</th>
		<th>Incentive </th>
		<th>Order In Report </th>
		<th>Last Modifed On </th>

		</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>">
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
		<td class="blueSimpletext" onclick="getModule('masters/rmslabmaster/edit?id=<?php echo $row[0];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','Fetching Data..')" style="width: 300px;">
		<?php echo $row[1];?></td>
		<td><?php echo $row[2] ;?></td>
	    <td><?php echo $row[3] ;?></td>
		<td><?php echo $row[4] ;?></td>
		<td><?php echo $row[6] ;?></td>
	    <td id="details" style="width:400px;"><?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row[5]));?>
		</td>
	</tr>
	<?php
$i++;
$Maxid = $row[0];
$MaxI = $i;
}
?>
</table>
<div id="moreData">
</div>
<!-- <div class="moduleFoot">
	<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
	<div onclick="fetchMore('masters/leadsource/fetchmore');" style="cursor: pointer;padding-top:5px;" id="fetchingDone">
	<img alt="" src="images/more.png" style="vertical-align: middle; width: 6px;" /> 
	More <span id="fetching" style="display: none">Fetching..</span></div>
</div>  -->
<br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
