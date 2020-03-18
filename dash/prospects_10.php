<?php
include("../include/conFig.php");

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

$sql = "SELECT contact.fname,contact.mark,contact.callbackdate,contact.id,leadresponse.name,contact.modifieddate, contact.callbacktime FROM contact,leadresponse WHERE contact.converted='0' AND contact.ownerid='$loggeduserid' GROUP BY mobile ORDER BY contact.mark DESC LIMIT 0 ,10";
$getData = mysql_query($sql,$con) or die(mysql_error());
?>
<table style="width:100%;" cellpadding="0" cellspacing="0">
<tr>
<td style="width:50%">


<table id="" cellpadding="0" cellspacing="0" class="fetch" width="100%">
<tr>
<th colspan="4">Leads</th>
</tr>

<tr>
<th style="" >Name</th>
<th style="" >Mark</th>

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
<?php echo $row[1];?>
</td>

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

