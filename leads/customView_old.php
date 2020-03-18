<?php
include("../include/conFig.php");
echo $view = $_GET['view'];

if($view)
{
$view = $_GET['view'];
		if(in_array('VA_leads',$thisPer) && $view == 6)
		{
		$addTo = " AND (1=1) ";
		}
		else	
		{
		$addTo = " AND contact.ownerid = '$loggeduserid' ";
		}
		$getView = mysql_query("SELECT `sql` FROM `customview` WHERE `id` = '$view'",$con) or die(mysql_error());
		$rowView = mysql_fetch_array($getView);
		$sqlStr = $rowView[0];
		
		$sqlStr = explode("ORDER BY",$sqlStr);
		
		$sql = $sqlStr[0].$addTo;
		//echo $sql;
		if($_GET['ftoSort'])
		{
		$ftoSort = $_GET['ftoSort'];
		$sortby = $_GET['sortby'];
		if($ftoSort == 'owner')
		{
		$sortstr = " ORDER BY employee.name ".$sortby." LIMIT 100";
		}
		else
		{
		$sortstr = " ORDER BY contact.".$ftoSort." ".$sortby." LIMIT 100";
		}
		}
		else
		{
		$sortstr = " ORDER BY contact.id DESC LIMIT 100";
		}
		
		$sql .= $sortstr;

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
$sortby = $_GET['sortby'];
$order = $_GET['order'];
$mark = $_GET['mark'];
$product = $_GET['product'];
$cnc = $_GET['cnc'];
$ftview= $_GET['ftview'];
$feedback= $_GET['feedback'];


if($_GET['ftoSort'])
{
$ftoSort = $_GET['ftoSort'];
$sortby = $_GET['sortby'];
if($ftoSort == 'owner')
{
$sortstr = " ORDER BY employee.name ".$sortby." LIMIT 100";
}
else
{
$sortstr = " ORDER BY contact.".$ftoSort." ".$sortby." LIMIT 100";
}
}
else
{
$sortstr = " ORDER BY contact.id DESC LIMIT 100";
}




if(in_array('VA_leads',$thisPer) || in_array('VA_tLeads',$thisPer))
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
if($type == 'F' || $type == 'FS' || $type == 'FE' || $type == 'TO' || $_GET['ftleads'])
{
$sql = "SELECT employee.name, contact.fname, contact.mobile, contact.callbackdate,contact.id,leadresponse.name,contact.modifieddate,contact.mark,contact.read,contact.lname,contact.description,contact.product FROM contact,employee,leadresponse,servicecall WHERE contact.ownerid = employee.id AND contact.delete = '0' AND contact.converted= '0' AND contact.latestresponse = leadresponse.id AND contact.id = servicecall.cid ".$leadstr;
}
else
{
$sql = "SELECT employee.name, contact.fname, contact.mobile, contact.callbackdate,contact.id,leadresponse.name,contact.modifieddate,contact.mark,contact.read,contact.lname,contact.description,contact.product FROM contact,employee,leadresponse WHERE contact.ownerid = employee.id AND contact.delete = '0' AND contact.converted= '0' AND contact.latestresponse = leadresponse.id".$leadstr;
}	
	if($mark == 'HL')
	{
	$sql .= " AND contact.mark = '1'";
	}
	if($mark == 'CL')
	{
	$sql .= " AND contact.mark = '0'";
	}
	if($mark == 'UL')
	{
	$sql .= " AND contact.read = '0'";
	}
	if($mark == 'RL')
	{
	$sql .= " AND contact.read = '1'";
	}
	if($mark == 'TR')
	{
	$sql .= " AND contact.transfrom != '0'";
	}




if($fromdate != '' || $todate != '' )
{
	if($type == 'Cl')
	{
	$sql .= " and contact.callbackdate BETWEEN '$fromdate' AND '$todate'";
	}
	else if($type == 'C')
	{
	$sql .= " and contact.createdate BETWEEN '$fdate' AND '$tdate'";
	}
	else if($type == 'M')
	{
	$sql .= " and contact.modifieddate BETWEEN '$fdate' AND '$tdate'";
	}
	else if($type == 'F')

	{

	$sql .= " AND servicecall.type = 'f' AND servicecall.createdate BETWEEN '$fdate' AND '$tdate' AND servicecall.delete = '0'";

	}

	else if($type == 'FS')

	{

	$sql .= " AND servicecall.type = 'f' AND servicecall.fromdate BETWEEN '$fdate' AND '$tdate' AND servicecall.delete = '0'";

	}

	else if($type == 'FE')

	{

	$sql .= " AND servicecall.type = 'f' AND servicecall.todate BETWEEN '$fdate' AND '$tdate' AND servicecall.delete = '0'";

	}
}
if($type == 'TO')
	{
	$sql .= " AND servicecall.type = 'f' AND servicecall.approved = '1' AND (servicecall.fromdate <= '$date' AND servicecall.todate >= '$date') AND servicecall.delete = '0'";
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
if($feedback != "")
{
$sql .= " and contact.feedback = '$feedback'";
}
if($product != "")
{
$p = "-".$product."-";
$sql .= " and contact.product LIKE '%$p%'";
}

if($cnc != '')
{
	if($cnc == 'con')
	{
		$sql .= " AND contact.contacted = '1'";
	}
	else
	{
		$sql .= " AND contact.contacted = '0'";
	}
}

if($leadowner != "")
{
$sql .= " and contact.ownerid = '$leadowner'";
}
else
{
	if(in_array('VA_leads',$thisPer))
	{
	$sql .= " AND (1=1)";
	}
	else
	{
		if(in_array('VA_tLeads',$thisPer))
		{
			$getLead = mysql_query("SELECT COUNT(`id`) FROM `team` WHERE `leader` = '$loggeduserid'",$con) or die(mysql_error());
			$rowLead = mysql_fetch_array($getLead);
			if($rowLead[0] > 0)
			{
				$sql .= " and contact.ownerid IN (SELECT teamamtes.mateid FROM team,teamamtes WHERE team.leader = '$loggeduserid' AND teamamtes.teamid = team.id AND team.delete = '0') ";
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
//////for free trial custom view

if($_GET['ftleads'])
{
$sql .= " AND servicecall.type = 'f' AND servicecall.approved = '1' AND servicecall.delete = '0'";
}

//////for transferred leads custom view

if($_GET['transleads'])
{
$sql .= "AND contact.callbackdate = '$date'"; 
}

/////for interested leads (customized for pace)

if($_GET['intleads'])
{
$sql .= "  AND contact.latestresponse = '9'"; ///// customized for pace
}

if(!$_GET['ftoSort'])
{
$sql .= " AND ".$permStr." ORDER BY ".$sortby." ".$order." LIMIT 100";
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
mysql_query("INSERT INTO `customview` (`name`, `sql`,`type`, `eid`, `createdate`, `id`) VALUES ('$future', '$saveSql','l', '$loggeduserid', '$datetime', '')",$con) or die(mysql_error());
}
}
$getdata=mysql_query($sql,$con) or die(mysql_error());
$countThis = mysql_num_rows($getdata);
$tempsql = str_ireplace('LIMIT 100','',$sql);
$getCount = mysql_query($tempsql,$con) or die(mysql_error());
$countTotal = mysql_num_rows($getCount);

$toecho  = "status='+document.getElementById('cstview1').value+'&source='+document.getElementById('cstview2').value+'&response='+document.getElementById('cstview3').value+'&owner='+document.getElementById('cstview4').value+'&fromdate='+document.getElementById('cstview5').value+'&todate='+document.getElementById('cstview6').value+'&type='+document.getElementById('cstview7').value+'&sortby='+document.getElementById('cstview8').value+'&order='+document.getElementById('cstview9').value+'&mark='+document.getElementById('cstview10').value+'&product='+document.getElementById('cstview11').value+'&cnc='+document.getElementById('cstview12').value+'";
if(isset($_GET['view']))
{
$toecho .= "&view=".$_GET['view'];
}
?>

<div style="height:600px;overflow:scroll">
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
<tr>
		<th style="height: 20px" >
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
				<th>
				<img src="images/cold.png" alt="" style="height:12px"/>
				</th>
		<th style="height: 20px;cursor:pointer"  onclick="getModule('leads/customView?<?php echo $toecho;?>&sort=true&ftoSort=owner&sortby=<?php if($ftoSort == 'owner'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','directResult','','Leads')">Lead Owner
		&nbsp;&nbsp;<?php if($ftoSort == 'owner'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>
		
		</th>
		<th style="height: 20px;cursor:pointer" onclick="getModule('leads/customView?<?php echo $toecho;?>&sort=true&ftoSort=fname&sortby=<?php if($ftoSort == 'fname'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','directResult','','Leads')">
	First Name&nbsp;&nbsp;
		<?php if($ftoSort == 'fname'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?></th>
		<th>Services</th>
		<th style="height: 20px" >Mobile</th>
		<th style="height: 20px;cursor:pointer" onclick="getModule('leads/customView?<?php echo $toecho;?>&sort=true&ftoSort=callbackdate&sortby=<?php if($ftoSort == 'callbackdate'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','directResult','','Leads')">
		Callback&nbsp;&nbsp;
		<?php if($ftoSort == 'callbackdate'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>
		</th>
		<th style="height: 20px;cursor:pointer" onclick="getModule123('leads/customView?<?php echo $toecho;?>&sort=true&ftoSort=modifieddate&sortby=<?php if($ftoSort == 'modifieddate'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','directResult','','Leads')">
		Description
		</th>
		<th>Story</th>
	</tr>

<?php
$i=0;
while($row = mysql_fetch_array($getdata))
{
$serv = explode(',',$row[11]);
$services = str_ireplace('-','',$serv);
$proNames = '';

foreach($services as $pro)
{
		if($pro != 'null' && $pro != '')
		{
		//echo "SELECT `name` FROM `category` WHERE `id` = '$pro'";
		$getPro = mysql_query("SELECT `name` FROM `category` WHERE `id` = '$pro'",$con) or die(mysql_error());
			while($rowPro = mysql_fetch_array($getPro))
			{
			$proName = $rowPro[0];
			$proNames .= str_ireplace('None','',$proName).", ";
			}
		}
}

?>
	<tr <?php if($row[8] == '0') echo "style='font-weight:bold'"; ?>  id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row[6]));?>">
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[4];?>" /></td>

		<td style="width:15px;">
		<div style="height:12px;">
		<?php if($row[7] == '1') { ?> 

		<img src="images/hot.png" id="hot<?php echo $row[4];?>" style="height:12px" alt=""  onclick="getModule('leads/markHot?id=<?php echo $row[4];?>&todo=cold','','hot<?php echo $row[4];?>','');document.getElementById('cold<?php echo $row[4];?>').style.display='';"/> 
		<img src="images/cold.png" id="cold<?php echo $row[4];?>" style="height:12px;display:none" alt="" onclick="getModule('leads/markHot?id=<?php echo $row[4];?>&todo=hot','','cold<?php echo $row[4];?>','');document.getElementById('hot<?php echo $row[4];?>').style.display='';"/>  

		<?php 
		} 
		else 
		{
		?> 
		<img src="images/hot.png" id="hot<?php echo $row[4];?>" style="height:12px;display:none" alt=""  onclick="getModule('leads/markHot?id=<?php echo $row[4];?>&todo=cold','','hot<?php echo $row[4];?>','');document.getElementById('cold<?php echo $row[4];?>').style.display='';"/> 
		<img src="images/cold.png" id="cold<?php echo $row[4];?>" style="height:12px" alt="" onclick="getModule('leads/markHot?id=<?php echo $row[4];?>&todo=hot','','cold<?php echo $row[4];?>','');document.getElementById('hot<?php echo $row[4];?>').style.display='';"/>  
		<?php 
		} 
		?>
		</div>
		</td>
		<td  <?php if(in_array('U_leads',$thisPer)){?>
  style="width: 200px;">
		<?php echo $row[0];?></td>
		<?php
		$toPassurl = 'leads/edit?id='.$row[4].'&i='.$i;
		$toPassurl = base64_encode($toPassurl);
		$showid = base64_encode('manipulateContent');
		$hideid = base64_encode('viewContent');
		$title = base64_encode($row['fname']);
		$finalUrl = 'default.php#'.$toPassurl.'$$**$$'.$showid.'$$**$$'.$hideid.'$$**$$'.$finalUrl;
		?>
		<td onclick="getModule('leads/edit?id=<?php echo $row[4];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo $row[1];?>')" <?php } ?> class="blueSimpletext" onmousedown="mouseDown(event,'<?php echo $finalUrl;?>')"  style="width: 200px;"><?php echo $row[1];?></td>
		<td style="width:100px"><?php echo substr($proNames,0,-2);?></td>
		<td   style="width: 100px;">
		<?php echo $row[2];?>
		</td>
				<td   style="width: 150px;">
		<?php
		 if($row[3] != '0000-00-00')
		 {
		 echo date("d,M Y", strtotime($row[3]));
			}
			else
			{
			 echo "--";
			}
		?>
		</td>
	<td   style="width: 200px;" onclick="getModule('noteline/index?cid=<?php echo $row[4];?>&name=<?php echo $row[1];?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo $row[0];?>')">
		<?php $tempDesc  = $row[10];
		$tempDesc = explode("\r\n",$tempDesc);
		//$tempDesc = array_reverse($tempDesc);
		echo substr($tempDesc[0],0,50);
		echo "..";
		?>
		</td>
		<td>
		<img onclick="getModule('noteline/index?cid=<?php echo $row[4];?>&name=<?php echo $row[1];?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo $row[0];?>')" src="images/story.png" style="width:15px" title="Story For <?php echo $row[0];?>" alt=""/>
		</td>

	</tr>
	<?php
$i++;
$Maxid = $row[4];
$MaxI = $i;
$list .= $row[4].",";
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
	<div onclick="moreData('leads/fetchmore?sql='+document.getElementById('tlview').value+'&upto='+document.getElementById('uptoFetch').value,'moreData','');" style="cursor: pointer;padding-top:5px;" id="fetchingDone">
	<img alt="" src="images/more.png" style="vertical-align: middle; width: 6px;" /> 
	More <span id="fetching" style="display: none">Fetching..</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Showing <span id="getCount"><?php echo $countThis;?></span> of  <span id="getTotal"><?php echo $countTotal;?></span></div></span>
</div>
<br/>
<br/>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>


