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
$from = $date." 00:00:00";
$to = $date." 23:00:00";

$after1mins = strtotime('+1 minutes');
$after15mins = strtotime('+15 minutes');
			 	
$sql = "SELECT contact.fname, contact.mobile, contact.callbackdate, contact.id, leadresponse.name, contact.modifieddate, contact.callbacktime FROM contact,leadresponse WHERE contact.ownerid = '$loggeduserid' AND contact.delete = '0' AND contact.converted= '0' AND contact.latestresponse = leadresponse.id AND contact.callbackdate BETWEEN '$from' AND '$to' ".$leadstr." AND (contact.latestresponse !='1' AND contact.latestresponse != '2' AND contact.latestresponse!= '5' AND contact.latestresponse != '33') AND contact.leadstatus != '3' AND contact.forcedcallback = '1' ORDER BY contact.callbacktime ASC";
$getData = mysql_query($sql,$con) or die(mysql_error());
?>
<table class="table" style="width:100%;" cellpadding="0" cellspacing="0">
<tr>
<td style="width:50%" valign="top">


<table cellpadding="0" cellspacing="0" class="table" width="100%">
<tr>
<th colspan="4"><span class="badge badge-info badge-dark" style="font-size:14px">Leads</span></th>
</tr>

<tr>
<th style="" >Name</th>
<th style="" >Call Back Date</th>
<th style="" >Call Back Time</th>
</tr>
	<?php
$i=0;
while($row=mysql_fetch_array($getData))
{
if($row[2] == '0000-00-00')
{

}
else
{
?>
<tr id="dashRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row[5]));?>">
<td class="blueSimpletext" onclick="getModule('leads/edit?id=<?php echo $row[3];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo $row[1];?>')">
<?php echo $row[0];?></td>

<td>
<?php echo $row[2];?>
</td>
 <td>
<?php echo date('h:i:s A',strtotime($row[6]));?>
</td> 
</tr>
<?php
$i++;
$list .= $row[3].",";
}
}
?>
</table>

</td>
<td style="width:50%" valign="top">
<?php
$from = "2015-01-01 00:00:00";
$to = $date." 23:00:00";
$sql = "SELECT contact.fname, contact.mobile, contact.callbackdate, contact.id, leadresponse.name, contact.modifieddate, contact.callbacktime FROM contact,leadresponse WHERE contact.ownerid = '$loggeduserid' AND contact.delete = '0' AND contact.converted= '1' AND contact.latestresponse = leadresponse.id AND contact.callbackdate BETWEEN '$from' AND '$to' ".$leadstr."  AND (contact.latestresponse != '1' AND contact.latestresponse != '2' AND contact.latestresponse != '5' AND contact.latestresponse != '33') AND contact.leadstatus != '3'  AND contact.forcedcallback = '1' ORDER BY contact.callbacktime ASC";
$getData = mysql_query($sql,$con) or die(mysql_error());
?>

<table cellpadding="0" cellspacing="0" class="table" width="100%">
<tr>
<th colspan="4"> <span class="badge badge-info badge-dark" style="font-size:14px">Clients</span></th>
</tr>
<tr>
<th style="" >Name</th>
<th style="" >Call Back Date</th>
<th style="" >Call Back Time</th>
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
		<td class="blueSimpletext" onclick="getModule('clients/edit?id=<?php echo $row[3];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo $row[1];?>')">
		<?php echo $row[0];?></td>
<!--		<td >
		<?php //echo $row[1];?>
		</td> -->
		<td>
		<?php echo $row[2];?>
		</td>
 		<td>
		<?php echo date('h:i:s A',strtotime($row[6]));?>
		</td> 
	</tr>
	<?php
$i++;
$list .= $row[3].",";
}
}
?>
</table>
</td>
</tr>
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

