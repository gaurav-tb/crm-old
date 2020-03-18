<?php
include("../include/conFig.php");
$twoMonths = time() -(60*60*24*60);
$twoMonths = date("Y-m-d",$twoMonths);
$getStatus = mysql_query("SELECT * FROM `leadstatus` WHERE `junk` = '1' AND `delete` = '0'",$con) or die(mysql_error());
$countJunk = mysql_num_rows($getStatus);
if($countJunk == 0)
{
$leadstr =" AND 1=1";
}
else
{
	while($rowJunk = mysql_fetch_array($getStatus))
	{
		$thisls = "-".$rowJunk['id']."-";
		$leadstr .= " AND contact.leadstatus NOT LIKE '%$thisls%' ";
	}
}
$from = "2015-01-01 00:00:00";
$to = $date." 23:00:00";
$sql = "SELECT contact.fname, contact.mobile, contact.callbackdate, contact.id, leadresponse.name, contact.modifieddate FROM contact,leadresponse WHERE contact.ownerid = '$loggeduserid' AND contact.delete = '0' AND contact.converted= '0' AND contact.latestresponse = leadresponse.id AND contact.callbackdate BETWEEN '$from' AND '$to' ".$leadstr."  AND (contact.latestresponse != '1' AND contact.latestresponse != '2' AND contact.latestresponse != '5' AND contact.latestresponse != '33') AND contact.leadstatus != '3'  AND contact.forcedcallback = '1' ORDER BY contact.callbackdate DESC";
$getData = mysql_query($sql,$con) or die(mysql_error());
?>
<table id="" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th style="" >Name</th>
		<th style="" >Mobile</th>
		<th style="" >Call Back Date</th>
		<th style="">Latest Response</th>
		<th>Story</th>

	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
if($row[2] == '0000-00-00')
{

}
else
{
?>
	<tr id="dashRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row[5]));?>">
		<td class="blueSimpletext" onclick="getModule('leads/edit?id=<?php echo $row[3];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo $row[1];?>')" style="width: 300px;">
		<?php echo $row[0];?></td>
		<td >
		<?php echo $row[1];?>
		</td>
		<td>
		<?php echo $row[2];?>
		</td>
				<td>
		<?php echo $row[4];?>
		</td>
		<td>
		<img onclick="getModule('noteline/index?cid=<?php echo $row[3];?>&name=<?php echo $row[0];?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo $row[0];?>')" src="images/story.png" style="width:15px" title="Story For <?php echo $row[0];?>" alt=""/>
		</td>
	</tr>
	<?php
$i++;
$list .= $row[3].",";
}
}
?>
</table>
<div class="moduleFoot" style="display:none">
<input name="Text1" type="text" value="<?php echo $sql;?>" id="tlview" style="display:none" />
<input name="Text1" type="text" value="<?php echo $list;?>" id="idList" style="display:none" />
	<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
	<div onclick="fetchMore('leads/fetchmore');" style="cursor: pointer;padding-top:5px;" id="fetchingDone">
	<img alt="" src="images/more.png" style="vertical-align: middle; width: 6px;" /> 
	More <span id="fetching" style="display: none">Fetching..</span></div>
</div>

<br/><br/><br/><br/><br/>

