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
$lst = array();
$getlst = mysql_query("SELECT `id`,`name` FROM `leadstatus` WHERE `delete` = '0'",$con) or die(mysql_error());
$countlst = mysql_num_rows($getlst);
if($countlst == 0)
{
//
}
else
{
	while($rowlst = mysql_fetch_array($getlst))
	{
		$lst[$rowlst[0]] =  $rowlst[1];
	}
}

//print_r($lst);

if($_GET['sort'])
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

//////////////////////////////////Freetrail Leads

if($_GET['ftleads'])
{
$ftleads = $_GET['ftleads'];
$ftLeadsStr = " AND contact.id IN (SELECT `cid` FROM `servicecall` WHERE `type` = 'f' AND `approved` = '1' AND `delete` = '0')"; 
}
else
{
$ftLeadsStr = " AND (1=1)";
}

/////////////////////////////Todaysfollowup Leads

if($_GET['transleads'])
{
$transleads = $_GET['transleads'];
$transLeadsStr = " AND contact.callbackdate = '$date'"; 
}
else
{
$transLeadsStr = " AND (1=1)";
}

/////////////////////////////Interested Leads

if($_GET['intleads'])
{
$intleads = $_GET['intleads'];
$intLeadsStr = "  AND contact.latestresponse = '9'"; 
}
else
{
$intLeadsStr = " AND (1=1)";
}


if(in_array('VA_leads',$thisPer))
{
$sql = "SELECT employee.name, contact.fname, contact.mobile, contact.callbackdate,contact.id,leadresponse.name,contact.modifieddate,contact.mark,contact.read,contact.lname,contact.description,contact.product,contact.leadstatus,contact.createdate,contact.callbacktime FROM contact,employee,leadresponse WHERE contact.ownerid = employee.id AND contact.delete = '0' AND contact.converted= '0' AND contact.latestresponse = leadresponse.id".$leadstr." " .$intLeadsStr." ".$transLeadsStr." ".$ftLeadsStr." ".$sortstr;
$getData = mysql_query($sql,$con) or die(mysql_error());
}
else
{
$sql = "SELECT employee.name, contact.fname, contact.mobile, contact.callbackdate,contact.id,leadresponse.name,contact.modifieddate,contact.mark,contact.read,contact.lname,contact.description,contact.product,contact.leadstatus,contact.createdate,contact.callbacktime FROM contact,employee,leadresponse WHERE contact.ownerid = employee.id AND contact.delete = '0' AND contact.converted= '0' AND contact.latestresponse = leadresponse.id AND contact.ownerid = '$loggeduserid'".$leadstr." " .$intLeadsStr." ".$transLeadsStr." ".$ftLeadsStr." ".$sortstr;;
$getData = mysql_query($sql,$con) or die(mysql_error());
}

$countThis = mysql_num_rows($getData);

$tempsql = str_ireplace('LIMIT 100','',$sql);
$getCount = mysql_query($tempsql,$con) or die(mysql_error());
$countTotal = mysql_num_rows($getCount);
?>

<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 15%">Leads
		
	

				</td>	<td align="right" style="width: 85%">
				
<?php
if($_GET['message'])
{
?>
<div style="display:inline-block;color:green;font-size:13px;" id="successMessage">

<div class="buttonGreen">
<?php
echo $_GET['message'];
?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="cursor:pointer;vertical-align:middle" onclick="document.getElementById('successMessage').style.display ='none'" src="images/close.png" alt=""/>
</div>
</div>


<?php
}
?>	
				
				
	&nbsp;&nbsp;&nbsp;
		
		<?php if(in_array('CO_leads',$thisPer) || in_array('D_leads',$thisPer) || in_array('ME_leads',$thisPer)){ ?>
		With Selected&nbsp;
					<select  class="input" name="Select1" id="action">
				 <?php if(in_array('CO_leads',$thisPer)){?><option value="l">Change Owner</option><?php } ?>
				<?php if(in_array('D_leads',$thisPer)){ ?><option value="contact:Leads">Delete</option><?php }?>
				<?php if(in_array('ME_leads',$thisPer)){ ?><option value="2">Mass Edit</option><?php }?>
			</select>&nbsp;<?php }
			if(in_array('CO_leads',$thisPer) || in_array('D_leads',$thisPer) || in_array('ME_leads',$thisPer)){ ?>
			<div class="buttonGreen" style="width: 20px;display:inline-block;padding:5px;" onclick="takeAction(document.getElementById('action').value)">Go</div>
			<?php } ?>	
			<?php if(in_array('A_leads',$thisPer)){ ?>&nbsp;&nbsp;<div class="buttonGreen" style="display:inline-block;padding:5px;" onclick="getModule('leads/new','manipulateContent','viewContent','New Lead')" >+1 New</div>
			<?php } 
			if(in_array('CV_leads',$thisPer)){ ?>
			<div class="buttonGreen" style="display:inline-block;padding:5px;" onclick="$('#custViewBox').slideToggle('fast')" >Custom View&nbsp; <img src="images/more.png" alt=""/></div>
			<?php } ?>
			
			<!--<input id="" class="buttonnegetive" name="Button1" onclick="deleteData('leads','Leads')" type="button" value="Delete Selected" /> -->
			</td>
		</tr>
	</table>
	<div style="background:#eee;padding:5px;display:none" id="custViewBox">
<table width="100%" cellpadding="5" cellspacing="0">
	<tr>
	<td style="border-bottom:1px #999 solid; height: 43px;">
		<div style="float:right">
	<img src="images/close-light.png" alt="" style="cursor:pointer" onclick="$('#custViewBox').slideToggle('fast')" />
	</div>

	Saved Views&nbsp;&nbsp;
				<?php
			$getView = mysql_query("SELECT `id`,`name` FROM `customview` WHERE `eid` = '$loggeduserid' AND `type` = 'l'",$con) or die(mysql_error());
			?>
			<select name="Select1" class="input" style="padding:3px 4px" id="savedView">
			<option value="">Select View</option>
				
			<?php
			while($rowView = mysql_fetch_array($getView))
			{
			?>
			<option value="<?php echo $rowView[0];?>"><?php echo $rowView[1];?></option>
			<?php
			}
			?>

			</select><div style="display:inline-block;padding:5px;" class="buttonGreen" onclick="getModule('leads/customView?view='+document.getElementById('savedView').value,'directResult','','Leads')">Go</div>
			<div style="float:right;margin-right:20px">
			<div class="buttonnegetive" style="display:inline-block" onclick="getModule('deleteView?id='+document.getElementById('savedView').value,'viewDeleted','','Leads');$('#custViewBox').slideToggle('fast')">Delete Selected View</div>
			<div id="viewDeleted"></div>
			</div>
			
	</td>
	</tr>
	<tr>
	<td>Create New View
	</td>
	</tr>
<tr>
	<td>
	<select class="input" name="leadstatus" style="width: 207px;" id="cstview1">
	<option value="">Lead Status</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `leadstatus` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="-<?php echo $rowCity[1];?>-"><?php echo $rowCity[0];?></option>
<?php
}
?>
	</select>
	&nbsp;&nbsp;
	<select class="input" name="leadsource" style="width: 207px" id="cstview2">
	<option value="">Lead Source</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `leadsource` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>
	&nbsp;&nbsp;	<select class="input" name="leadresponse" style="width: 207px" id="cstview3">
	<option value="">Lead Response</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `leadresponse` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>
	<?php

	?>
	&nbsp;&nbsp;	<select class="input" name="leadowner" style="width: 207px" id="cstview4">
	<option value="">Lead Owner</option>
	<option value="">Team Leads</option>		
	<option value="<?php echo $loggeduserid;?>">Self</option>	
<?php
if(in_array('VA_leads',$thisPer))
{
$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `status` = '1' ORDER BY `name` ASC",$con) or die(mysql_error()); 
}
else if(in_array('VA_tLeads',$thisPer))
{
	$getLead = mysql_query("SELECT COUNT(`id`) FROM `team` WHERE `leader` = '$loggeduserid'",$con) or die(mysql_error());
	$rowLead = mysql_fetch_array($getLead);
		if($rowLead[0] > 0)
		{
			$getCity = mysql_query("SELECT employee.name,teamamtes.mateid FROM employee,team,teamamtes WHERE team.leader = '$loggeduserid' AND teamamtes.mateid = employee.id AND teamamtes.teamid = team.id AND team.delete = '0' AND employee.delete = '0' ORDER BY employee.name ASC",$con) or die(mysql_error());
		}
		else
		{
			$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `id` = '$loggeduserid' ORDER BY `name` ASC",$con) or die(mysql_error()); 
		}
}
else
{
$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `id` = '$loggeduserid' ORDER BY `name` ASC",$con) or die(mysql_error()); 
}

while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>
			<br/>
			
				<input id="cstview5" name="fromdate" class="inputCalender" placeholder="From Date" onclick="openCalendar(this);" readonly="readonly" type="text">&nbsp;
				<input id="cstview6" name="fromdate" class="inputCalender" placeholder="To Date" onclick="openCalendar(this);" readonly="readonly" type="text"> in 
				<select id="cstview7" name="Select1" class="input" style="width: 207px">
				<option value="Cl">Call Back Date</option>
				<option value="C">Create Date</option>
				<option value="M">Modified Date</option>
				<option value="F">Freetrial Request Date</option>
				<option value="FS">Freetrial Start Date</option>
				<option value="FE">Freetrial End Date</option>
				<option value="TO">Todays Freetrial</option>

			</select>
			&nbsp;&nbsp;
			<select id="cstview10" class="input" style="width:207">
			<option value="ALL">All Leads</option>
			<option value="HL">Hot Leads</option>
			<option value="CL">Cold Leads</option>
			<option value="UL">Unread Leads</option>
			<option value="RL">Read Leads</option>
			<option value="TR">Transferred Leads</option>
			</select>
			&nbsp;&nbsp;
	
				<select class="input" name="product" style="width: 207px" id="cstview11">
	<option value="">Segment</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `category` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>
			&nbsp;&nbsp;

			<select name="Select1" class="input" id="cstview12">
				<option value="">Contact Status (Any)</option>
				<option value="con">Contacted</option>
				<option value="notcon">Not Contacted</option>
			</select>

			
				
	</td>


</tr>
<tr>
	<td style="font-size:11px;">
	Sort By
		<select id="cstview8" name="Select2" class="input" style="width:214">
		<option value="contact.fname">Name</option>
		<option value="contact.callbackdate">Call Back Date</option>
		<option value="employee.name">Lead Owner</option>
		<option value="contact.modifieddate">Modified Date</option>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;
Order 		
			<select id="cstview9" name="Select1" class="input" style="width:214">
			<option value="ASC">Ascending</option>
				<option value="DESC">Descending</option>

			</select>

	
	</td>
</tr>
<tr>
	<td>
	<input name="Button1" class="buttonBlue" type="button" value="Create View For Now" onclick="getModule('leads/customView?ftleads=<?php echo $ftleads?>&transleads=<?php echo $transleads?>&intleads=<?php echo $intleads?>&status='+document.getElementById('cstview1').value+'&source='+document.getElementById('cstview2').value+'&response='+document.getElementById('cstview3').value+'&owner='+document.getElementById('cstview4').value+'&fromdate='+document.getElementById('cstview5').value+'&todate='+document.getElementById('cstview6').value+'&type='+document.getElementById('cstview7').value+'&sortby='+document.getElementById('cstview8').value+'&order='+document.getElementById('cstview9').value+'&mark='+document.getElementById('cstview10').value+'&product='+document.getElementById('cstview11').value+'&cnc='+document.getElementById('cstview12').value,'directResult','','Leads');$('#custViewBox').slideToggle('fast')" />&nbsp;&nbsp;Or&nbsp;&nbsp;<input id="viewName" placeholder="Save This View For Future Use" class="input" name="Text1" type="text" style="width: 187px" /><div style="display:inline-block" class="buttonGreen rightRound" onclick="getModule('leads/customView?status='+document.getElementById('cstview1').value+'&source='+document.getElementById('cstview2').value+'&response='+document.getElementById('cstview3').value+'&owner='+document.getElementById('cstview4').value+'&fromdate='+document.getElementById('cstview5').value+'&todate='+document.getElementById('cstview6').value+'&type='+document.getElementById('cstview7').value+'&sortby='+document.getElementById('cstview8').value+'&order='+document.getElementById('cstview9').value+'&mark='+document.getElementById('cstview10').value+'&product='+document.getElementById('cstview11').value+'&cnc='+document.getElementById('cstview12').value+'&future='+document.getElementById('viewName').value,'directResult','','Leads');$('#custViewBox').slideToggle('fast')">Save It!</div>	</td>
</tr>

</table>
</div>
<div id="directResult" style="height:600px;overflow:scroll">
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th style="height: 20px" >
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
				<th style="height: 20px">
				<img src="images/cold.png" alt="" style="height:12px"/>
				</th>
		<th style="height: 20px;cursor:pointer"  onclick="getModule('leads/view?sort=true&ftoSort=owner&sortby=<?php if($ftoSort == 'owner'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Leads')">Lead Owner
		&nbsp;<?php if($ftoSort == 'owner'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>
		
		</th>
		<th style="height: 20px;cursor:pointer" onclick="getModule('leads/view?sort=true&ftoSort=fname&sortby=<?php if($ftoSort == 'fname'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Leads')">
	First Name&nbsp;
		<?php if($ftoSort == 'fname'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?></th>
		<th style="height: 20px;cursor:pointer" onclick="getModule('leads/view?sort=true&ftoSort=createdate&sortby=<?php if($ftoSort == 'createdate'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Leads')">
		CreateDate
				<?php if($ftoSort == 'createdate'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?></th>

		<th style="height: 20px">Services</th>
		<th style="height: 20px">Latest Response</th>
		<th style="height: 20px">Lead Status</th>
		<th style="height: 20px" >Mobile</th>
		<th style="height: 20px;cursor:pointer" onclick="getModule('leads/view?sort=true&ftoSort=callbackdate&sortby=<?php if($ftoSort == 'callbackdate'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Leads')">
		Callback
		<?php if($ftoSort == 'callbackdate'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>
		</th>
		

		<th style="height: 20px;cursor:pointer" onclick="getModule123('leads/view?sort=true&ftoSort=modifieddate&sortby=<?php if($ftoSort == 'modifieddate'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Leads')">
		Description
		
		</th>
		<th style="height: 20px">Story</th>
	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
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
	<tr <?php if($row[8] == '0') echo "style='font-weight:bold'"; ?> id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row[6]));?>">
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
		<td  style="width: 200px;">
		<?php echo $row[0];?></td>
		
	<?php
		$toPassurl = 'leads/edit?id='.$row[4].'&i='.$i;
		$toPassurl = base64_encode($toPassurl);
		$showid = base64_encode('manipulateContent');
		$hideid = base64_encode('viewContent');
		$title = base64_encode($row['fname']);
		$finalUrl = 'default.php#'.$toPassurl.'$$**$$'.$showid.'$$**$$'.$hideid.'$$**$$'.$finalUrl;
		?>
		<td onclick="getModule('leads/edit?id=<?php echo $row[4];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo $row[1];?>')" onmousedown="mouseDown(event,'<?php echo $finalUrl;?>')"  class="blueSimpletext"  style="width: 200px;"><?php echo $row[1];?></td>
		<td style="width:100px"><?php echo $row[13] ?></td>
		<td style="width:100px"><?php echo substr($proNames,0,-2);?></td>
		<td style="width:100px"><?php echo $row[5]; ?></td>
		<td style="width:100px"><?php 
		$lststr = str_ireplace('-','',$row[12]);
		$lstex = explode(',',$lststr);
		//print_r($lstex);
		
		foreach($lstex as $val)
		{
			if($val != '')
			{
				echo $lst[$val].', ';
			}
		}
		
		//echo $row[12]; 
		?></td>
		<td   style="width: 100px;">
		<?php echo $row[2];?>
		</td>
		
				<td   style="width: 150px;">
		<?php
		 if($row[3] != '0000-00-00 00:00:00')
		 {
		 echo $row[3];
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
		$tempDesc = array_reverse($tempDesc);
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
	More <span id="fetching" style="display: none">Fetching..</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Showing <span id="getCount"><?php echo $countThis;?></span> of <span id="getTotal"><?php echo $countTotal;?></span>

	</div>
		
	</span>
</div>
<br/>
<br/>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
<div id="customContent"></div>




