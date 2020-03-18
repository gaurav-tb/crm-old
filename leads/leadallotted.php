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
	$sortstr = " ORDER BY employee.name ".$sortby." LIMIT 500";
	}
	else if($ftoSort == 'latestresponse')
	{
	$sortstr = " ORDER BY leadresponse.name ".$sortby." LIMIT 500";
	}
	else
	{
	$sortstr = " ORDER BY contact.".$ftoSort." ".$sortby." LIMIT 500";
	}
}
else
{
$sortstr = " ORDER BY contact.id DESC LIMIT 500";
}

//////////////////////////////////Freetrail Leads
/*
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
*/
/*
if(in_array('VA_leads',$thisPer))
{
echo "1";
$sql = "SELECT employee.name, contact.fname, contact.mobile, contact.callbackdate,contact.id,leadresponse.name,contact.modifieddate,contact.mark,contact.read,contact.lname,contact.description,contact.product,contact.leadstatus,contact.createdate,contact.callbacktime,alloted.to FROM contact,employee,leadresponse,alloted WHERE contact.ownerid = employee.id AND contact.delete = '0' AND contact.converted= '0' AND  alloted.to = contact.ownerid AND alloted.cid=contact.id AND contact.latestresponse = leadresponse.id".$leadstr." ".$sortstr;
$getData = mysql_query($sql,$con) or die(mysql_error());
}
else
{
echo "2";
$sql = "SELECT employee.name, contact.fname, contact.mobile, contact.callbackdate,contact.id,leadresponse.name,contact.modifieddate,contact.mark,contact.read,contact.lname,contact.description,contact.product,contact.leadstatus,contact.createdate,contact.callbacktime,alloted.to FROM contact,employee,leadresponse,alloted WHERE contact.ownerid = employee.id AND contact.delete = '0' AND contact.converted= '0' AND alloted.to = contact.ownerid AND alloted.cid=contact.id AND contact.latestresponse = leadresponse.id AND contact.ownerid = '$loggeduserid'".$leadstr." ".$sortstr;;
$getData = mysql_query($sql,$con) or die(mysql_error());
}
*/
$sql = "SELECT employee.name, contact.fname, contact.mobile, contact.callbackdate,contact.id,leadresponse.name,contact.modifieddate,contact.mark,contact.read,contact.lname,contact.description,contact.product,contact.leadstatus,contact.createdate,contact.callbacktime,alloted.to FROM contact,employee,leadresponse,alloted WHERE contact.ownerid = employee.id AND contact.delete = '0' AND contact.converted= '0' AND alloted.to = contact.ownerid AND alloted.cid=contact.id AND contact.latestresponse = leadresponse.id AND contact.ownerid = '$loggeduserid'".$leadstr." ".$sortstr;;
$getData = mysql_query($sql,$con) or die(mysql_error());

$countThis = mysql_num_rows($getData);

$tempsql = str_ireplace('LIMIT 500','',$sql);
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
			<!-- <div class="buttonGreen" style="display:inline-block;padding:5px;" onclick="$('#custViewBox').slideToggle('fast')" >Custom View&nbsp; <img src="images/more.png" alt=""/></div> -->
			<?php } ?>
			
			<!--<input id="" class="buttonnegetive" name="Button1" onclick="deleteData('leads','Leads')" type="button" value="Delete Selected" /> -->
			</td>
		</tr>
	</table>
	
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
		<th style="height: 20px" onclick="getModule('leads/view?sort=true&ftoSort=latestresponse&sortby=<?php if($ftoSort == 'latestresponse'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Leads')">Latest Response
				<?php if($ftoSort == 'latestresponse'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>

		</th>
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
//		$tempDesc = array_reverse($tempDesc);
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
 
 
<br/>
<br/>
<br/><br/><br/><br/><br/>
</div>
<!-- <div id="customContent"></div> -->




