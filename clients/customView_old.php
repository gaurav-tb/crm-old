<?php 
include("../include/conFig.php");
if($_GET['view'])
{
$view = $_GET['view'];
$getView = mysql_query("SELECT `sql` FROM `customview` WHERE `id` = '$view'",$con) or die(mysql_error());
$rowView = mysql_fetch_array($getView);
$sql = $rowView[0];
//$getdata=mysql_query($rowView[0],$con) or die(mysql_error());
}
else
{
$fromdate=$_GET['fromdate'];
$todate=$_GET['todate'];
$fdate = $fromdate." 00:00:00";
$tdate = $todate." 23:59:59";
$type=$_GET['type'];
$leadstatus=$_GET['status'];
$leadsource=$_GET['source'];
$leadresponse=$_GET['response'];
$leadowner=$_GET['owner'];
$product = $_GET['product'];
$mark = $_GET['read'];

if($_GET['ftoSort'])
{
$ftoSort = $_GET['ftoSort'];
$sortby = $_GET['sortby'];
$sortstr = " ORDER BY contact.".$ftoSort." ".$sortby." LIMIT 100";
}
else
{
$sortstr = " ORDER BY contact.id DESC LIMIT 100";
}




if(in_array('VA_clients',$thisPer) || in_array('CA_tclients',$thisPer))
{
$permStr = "(1=1)";
}
else
{
$permStr = "(contact.ownerid = '$loggeduserid')";
}

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
		if($leadstatus != $thisls)
		{
			$leadstr .= " AND contact.leadstatus NOT LIKE '%$thisls%' ";
		}
		else
		{
			$leadstr =" AND 1=1";
		}
	}
}

$sql = "SELECT employee.name,contact.fname,contact.lname,contact.mobile,contact.callbackdate,leadresponse.name,contact.id,contact.read FROM contact,employee,leadresponse WHERE contact.ownerid = employee.id AND contact.delete = '0' AND contact.converted= '1' AND contact.latestresponse = leadresponse.id".$leadstr;
	
	if($mark == 'TC')
	{
	$sql .= " AND contact.read = '0'";
	}
	if($mark == 'TR')
	{
	$sql .= " AND contact.transfrom != '0'";
	}
	if($mark == 'AC')
	{
	$sql .= " AND contact.id IN (SELECT `cid` FROM `servicecall` WHERE `type` = 'c' AND `approved` = '1' AND `delete` = '0' AND `fromdate` <= '$date' AND `todate` >= '$date')";
	}

if($fromdate != '' || $todate != '' )
{
	if($type == 'C1')
	{
	$sql .= " and contact.callbackdate BETWEEN '$fromdate' AND '$todate'";
	}
	if($type == 'C')
	{
	$sql .= " and contact.createdate BETWEEN '$fdate' AND '$tdate'";
	}
	if($type == 'M')
	{
	$sql .= " and contact.modifieddate BETWEEN '$fdate' AND '$tdate'";
	}
	else if($type == 'F')
	{
	$sql .= " and contact.id IN (SELECT `cid` FROM `servicecall` WHERE `type` = 'f' AND `createdate` BETWEEN '$fdate' AND '$tdate' AND `delete` = '0')";
	}

}
if($leadstatus != "")
{
$sql .= " and contact.leadstatus LIKE '%$leadstatus%'";
}

if($leadsource != "")
{
$sql .= " and contact.leadsource = '$leadsource'";
}

if($leadresponse != "")
{
$sql .= " and contact.latestresponse = '$leadresponse'";
}

if($leadowner != "")
{
$sql .= " and contact.ownerid = '$leadowner'";
}
if($product != "")
{
$p = "-".$product."-";
$sql .= " and contact.product LIKE '%$p%'";
}

else
{
	if(in_array('VA_leads',$thisPer))
	{
	$sql .= " AND (1=1)";
	}
	else
	{
		if(in_array('CA_tclients',$thisPer))
		{
			$getLead = mysql_query("SELECT COUNT(`id`) FROM `team` WHERE `leader` = '$loggeduserid'",$con) or die(mysql_error());
			$rowLead = mysql_fetch_array($getLead);
			if($rowLead[0] > 0)
			{
				$sql .= " and contact.ownerid IN (SELECT teamamtes.mateid FROM team,teamamtes WHERE team.leader = '".$loggeduserid."' AND teamamtes.teamid = team.id AND team.delete = '0') ";
			}
			else
			{
				$sql .= " and contact.ownerid = '$loggeduserid'";
			}
		}
		else
		{
		
				$sql .= " and contact.ownerid = '$loggeduserid'";
		}

	}
	
}

if(!$_GET['ftoSort'])
{
$sql .= " AND ".$permStr." ORDER BY contact.id DESC LIMIT 100";
//$sql .= " AND ".$permStr." ORDER BY ".$sortby." ".$order." LIMIT 100";
}
else
{
$sql .= " AND ".$permStr." ".$sortstr;
}



if($_GET['future'])
{
$future = $_GET['future'];
$saveSql = str_ireplace("'","\'",$sql);
$future = str_ireplace("'","\'",$future); 
mysql_query("INSERT INTO `customview` (`name`, `sql`,`type`, `eid`, `createdate`, `id`) VALUES ('$future', '$saveSql','c', '$loggeduserid', '$datetime', '')",$con) or die(mysql_error());
}
}
$getdata=mysql_query($sql,$con) or die(mysql_error());
$countThis = mysql_num_rows($getdata);
$tempsql = str_ireplace('LIMIT 100','',$sql);
$getCount = mysql_query($tempsql,$con) or die(mysql_error());
$countTotal = mysql_num_rows($getCount);


$toecho  = "status='+document.getElementById('cstview1').value+'&source='+document.getElementById('cstview2').value+'&response='+document.getElementById('cstview3').value+'&owner='+document.getElementById('cstview4').value+'&fromdate='+document.getElementById('cstview5').value+'&todate='+document.getElementById('cstview6').value+'&type='+document.getElementById('cstview7').value+'&product='+document.getElementById('cstview8').value+'&read='+document.getElementById('cstview9').value+'"

?>


<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
<tr>
		<th style="height: 20px">
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
		<th style="height: 20px">Lead Owner</th>
		<th style="height: 20px;cursor:pointer" onclick="getModule('clients/customView?<?php echo $toecho;?>&sort=true&ftoSort=fname&sortby=<?php if($ftoSort == 'fname'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','directResult','','Clients')">
	First Name&nbsp;&nbsp;
		<?php if($ftoSort == 'fname'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?></th>
		<th>Last Name</th>
		<th style="height: 20px">Mobile</th>
		<th style="height: 20px;cursor:pointer" onclick="getModule('clients/customView?<?php echo $toecho;?>&sort=true&ftoSort=callbackdate&sortby=<?php if($ftoSort == 'callbackdate'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','directResult','','Clients')">
		Call Back Date&nbsp;&nbsp;
		<?php if($ftoSort == 'callbackdate'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>
		</th>
		<th style="height: 20px">Latest Response</th>
		<th>Story</th>

	</tr>

<?php
$i=0;
while($row = mysql_fetch_array($getdata))
{
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" <?php if($row[7] == '0') echo "style='font-weight:bold'"; ?>>
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[6];?>" /></td>
		<td   style="width: 300px;">
		<?php echo $row[0];?>
		</td>
		<?php
		$toPassurl = 'clients/edit?id='.$row[6].'&i='.$i;
		$toPassurl = base64_encode($toPassurl);
		$showid = base64_encode('manipulateContent');
		$hideid = base64_encode('viewContent');
		$title = base64_encode($row[1]);
		$finalUrl = 'default.php#'.$toPassurl.'$$**$$'.$showid.'$$**$$'.$hideid.'$$**$$'.$finalUrl;
		?>
		<td onclick="getModule('clients/edit?id=<?php echo $row[6];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo $row[1]?>')" onmousedown="mouseDown(event,'<?php echo $finalUrl;?>')" class="blueSimpletext">
		<?php echo $row[1];?>
		</td>
		<td style="width:100px">
		<?php echo $row[2];?>
		</td>

		<td>
		<?php echo $row[3];?>
		</td>
				<td   style="width: 150px;">
		<?php
		 if($row[4] != '0000-00-00')
		 {
		 echo date("d,M Y", strtotime($row[4]));
			}
			else
			{
			 echo "--";
			}
		?>
		</td>
		<td>
		<?php echo $row[5];?>
		</td>
		<td>
		<img onclick="getModule('noteline/index?cid=<?php echo $row[6];?>&name=<?php echo $row[1];?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo $row[0];?>')" src="images/story.png" style="width:15px" title="Story For <?php echo $row[0];?>" alt=""/>
		</td>
	
	</tr>
	<?php
$i++;
$Maxid = $row[6];
$MaxI = $i;
}
?>
</table>
<div id="moreData">
</div>
<div class="moduleFoot">
<div style="float:right">
	<select id="fetchPara" class="input">
	<option value="100">Get 100 Records</option>
	<option value="50">Get 50 Records</option>
	<option value="20">Get 20 Records</option>
	</select>
</div>
<input name="Text1" type="text" value="<?php echo $sql;?>" id="tlview" style="display:none" />
<input name="Text1" type="text" value="<?php echo $list;?>" id="idList" style="display:none" />
<input name="Text1" type="text" value="1" id="uptoFetch" style="display:none" />

	<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
		<span id="moreButton">
	<div onclick="moreData('clients/fetchmore?sql='+document.getElementById('tlview').value+'&upto='+document.getElementById('uptoFetch').value,'moreData','');" style="cursor: pointer;padding-top:5px;" id="fetchingDone">
	<img alt="" src="images/more.png" style="vertical-align: middle; width: 6px;" /> 
	More <span id="fetching" style="display: none">Fetching..</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Showing <span id="getCount"><?php echo $countThis;?></span> of <span id="getTotal"><?php echo $countTotal;?></span></div></span></div></span>
</div>

<br/><br/><br/><br/><br/><br/><br/>


