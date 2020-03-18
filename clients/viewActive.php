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

// This Query Used For Get Services(Category)
$service = array();
$getSer = mysql_query("SELECT `id`,`name` FROM `category` WHERE `delete` = '0'",$con) or die(mysql_error());
$getSerCount = mysql_num_rows($getSer);
if($getSerCount == 0)
{
//
}
else
{
while($rowSer = mysql_fetch_array($getSer))
{
$service[$rowSer[0]] =  $rowSer[1];
}
}
// End Service Query

if($_GET['sort'])
{
$sortby = $_GET['sortby'];
if($ftoSort=='LastTradeOccured')
{
$sortstr = "ORDER BY lasttradeddate.".$ftoSort." ".$sortby." LIMIT 50";
}


if($sortby=='TwoDaysInactive')
{
$Previous1Date=date('Y-m-d', strtotime('-1 day', strtotime($date)));
$Previous2Date=date('Y-m-d', strtotime('-2 day', strtotime($date)));

 $sortstr = "AND `lasttradeddate`.`LastTradeOccured` NOT BETWEEN  '$Previous1Date'
AND  '$date' AND  `lasttradeddate`.`LastTradeOccured` BETWEEN  '2016-01-01' AND '$Previous2Date' ORDER BY `lasttradeddate`.`LastTradeOccured` DESC"; 
}


if($sortby=='SevenInactive')
{
$Previous7Date=date('Y-m-d', strtotime('-7 day', strtotime($date)));
$Previous8Date=date('Y-m-d', strtotime('-8 day', strtotime($date)));

 $sortstr = "AND `lasttradeddate`.`LastTradeOccured` NOT BETWEEN  '$Previous7Date'
AND  '$date' AND  `lasttradeddate`.`LastTradeOccured` BETWEEN  '2016-01-01' AND '$Previous8Date' ORDER BY `lasttradeddate`.`LastTradeOccured` DESC"; 
}


 
if($sortby=='FifteenInactive')
{
$Previous15Date=date('Y-m-d', strtotime('-15 day', strtotime($date)));
$Previous16Date=date('Y-m-d', strtotime('-16 day', strtotime($date)));

 $sortstr = "AND `lasttradeddate`.`LastTradeOccured` NOT BETWEEN  '$Previous15Date'
AND  '$date' AND  `lasttradeddate`.`LastTradeOccured` BETWEEN  '2016-01-01' AND '$Previous16Date' ORDER BY `lasttradeddate`.`LastTradeOccured` DESC"; 
}

if($sortby=='ThirtyInactive')
{
$Previous30Date=date('Y-m-d', strtotime('-30 day', strtotime($date)));
$Previous31Date=date('Y-m-d', strtotime('-31 day', strtotime($date)));

 $sortstr = "AND `lasttradeddate`.`LastTradeOccured` NOT BETWEEN  '$Previous30Date'
AND  '$date' AND  `lasttradeddate`.`LastTradeOccured` BETWEEN  '2016-01-01' AND '$Previous31Date' ORDER BY `lasttradeddate`.`LastTradeOccured` DESC"; 
}


if($sortby=='NineteeInactive')
{
$Previous90Date=date('Y-m-d', strtotime('-90 day', strtotime($date)));
$Previous91Date=date('Y-m-d', strtotime('-91 day', strtotime($date)));

 $sortstr = "AND `lasttradeddate`.`LastTradeOccured` NOT BETWEEN  '$Previous90Date'
AND  '$date' AND  `lasttradeddate`.`LastTradeOccured` BETWEEN  '2016-01-01' AND '$Previous91Date' ORDER BY `lasttradeddate`.`LastTradeOccured` DESC"; 
}

if($sortby=='120Inactive')
{
$Previous120Date=date('Y-m-d', strtotime('-120 day', strtotime($date)));
$Previous121Date=date('Y-m-d', strtotime('-121 day', strtotime($date)));

 $sortstr = "AND `lasttradeddate`.`LastTradeOccured` NOT BETWEEN  '$Previous120Date'
AND  '$date' AND  `lasttradeddate`.`LastTradeOccured` BETWEEN  '2016-01-01' AND '$Previous121Date' ORDER BY `lasttradeddate`.`LastTradeOccured` DESC"; 
}


if($sortby=='180Inactive')
{
$Previous180Date=date('Y-m-d', strtotime('-180 day', strtotime($date)));
$Previous181Date=date('Y-m-d', strtotime('-181 day', strtotime($date)));

 $sortstr = "AND `lasttradeddate`.`LastTradeOccured` NOT BETWEEN  '$Previous180Date'
AND  '$date' AND  `lasttradeddate`.`LastTradeOccured` BETWEEN  '2016-01-01' AND '$Previous181Date' ORDER BY `lasttradeddate`.`LastTradeOccured` DESC"; 
}



if($sortby=='240Inactive')
{
$Previous240Date=date('Y-m-d', strtotime('-240 day', strtotime($date)));
$Previous241Date=date('Y-m-d', strtotime('-241 day', strtotime($date)));

 $sortstr = "AND `lasttradeddate`.`LastTradeOccured` NOT BETWEEN  '$Previous240Date'
AND  '$date' AND  `lasttradeddate`.`LastTradeOccured` BETWEEN  '2016-01-01' AND '$Previous241Date' ORDER BY `lasttradeddate`.`LastTradeOccured` DESC"; 
}


if($sortby=='NeverBeenActive')
{
 $sortstr = "AND `lasttradeddate`.`LastTradeOccured` IS NULL ORDER BY `lasttradeddate`.`LastTradeOccured` DESC"; 
}

}

else
{
$Previous1Date=date('Y-m-d', strtotime('-1 day', strtotime($date)));
$Previous2Date=date('Y-m-d', strtotime('-2 day', strtotime($date)));

$sortstr = "AND `lasttradeddate`.`LastTradeOccured` NOT 
BETWEEN  '$Previous1Date' AND '$date' AND `lasttradeddate`.`LastTradeOccured` 
BETWEEN  '2016-01-01' AND '$Previous2Date' ORDER BY `lasttradeddate`.`LastTradeOccured`DESC"; 
} 

if(in_array('VA_clients',$thisPer))
{
$sqlData="SELECT  `contact`.`id`,`employee`.`name`, `contact`.`fname` ,`contact`.`lname`,`contact`.`code` ,  `contact`.`conversiondate` ,  `lasttradeddate`.`LastTradeOccured` ,`contact`.`callbackdate`,`contact`.`description`,`contact`.`modifieddate`,`contact`.`mark`,`contact`.`mobile` FROM  `contact` 
INNER JOIN  `lasttradeddate` ON  `contact`.`code` =  `lasttradeddate`.`code` INNER JOIN `employee` ON `contact`.`ownerid`=`employee`.`id` WHERE `contact`.`converted`='1'". $sortstr." LIMIT 50";  

$getData = mysql_query($sqlData,$con) or die(mysql_error());
}
else
{
$sqlData ="SELECT  `contact`.`id`,`employee`.`name`, `contact`.`fname` ,`contact`.`lname`,`contact`.`code` ,  `contact`.`conversiondate` ,  `lasttradeddate`.`LastTradeOccured` ,`contact`.`callbackdate`,`contact`.`description`,`contact`.`modifieddate`,`contact`.`mark`,`contact`.`mobile` FROM  `contact` 
INNER JOIN  `lasttradeddate` ON  `contact`.`code` =  `lasttradeddate`.`code` INNER JOIN `employee` ON `contact`.`ownerid`=`employee`.`id` WHERE `contact`.`converted`='1' AND `contact`.`ownerid`='$loggeduserid'". $sortstr." LIMIT 50";  

$getData = mysql_query($sqlData,$con) or die(mysql_error());	
}

$countThis=mysql_num_rows($getData);

$tempsql = str_ireplace('LIMIT 50','',$sqlData);
$getCount = mysql_query($tempsql,$con) or die(mysql_error());
$countTotal = mysql_num_rows($getCount);


?>
<div class="moduleHeading">

	<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
	<td align="left" style="width: 30%">Inactive Clients</td>
	<td>
	<div id="exportButton" class="buttonGreen rightRound" style="width:70px;display:inline-block" onclick="getExportXls();document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','')">Export</div>
	</td>
	
	<td align="right" style="width: 70%">
  <select  class="input" name="Select1" id="action"  style="width: 180px;padding:2px">
  <option <?php if($sortby=='TwoDaysInactive') {     echo "selected=selected";  } ?> value="TwoDaysInactive">Inactive > 2 Days</option>
  <option <?php if($sortby=='SevenInactive') {       echo "selected=selected";  } ?> value="SevenInactive">Inactive > 7 Days</option>
  <option <?php if($sortby=='FifteenInactive') {     echo "selected=selected";  } ?> value="FifteenInactive">Inactive > 15 Days</option>
  <option <?php if($sortby=='ThirtyInactive') {      echo "selected=selected";  } ?>  value="ThirtyInactive">Inactive > 30 Days</option>
  <option <?php if($sortby=='NineteeInactive') {     echo "selected=selected";  } ?> value="NineteeInactive">Inactive > 90 Days</option>
  <option <?php if($sortby=='120Inactive') {     echo "selected=selected";  } ?> value="120Inactive">Inactive > 120 Days</option>
  <option <?php if($sortby=='180Inactive') {     echo "selected=selected";  } ?> value="180Inactive">Inactive > 180 Days</option>
  <option <?php if($sortby=='240Inactive') {     echo "selected=selected";  } ?> value="240Inactive">Inactive > 240 Days</option>
  <option <?php if($sortby=='NeverBeenActive') {     echo "selected=selected";  } ?> value="NeverBeenActive">Never Been Active</option>
  
    </select>
	<div class="buttonGreen rightRound" style="width: 20px;display:inline-block" onclick="getModule('clients/viewActive?sort=true&sortby='+document.getElementById('action').value,'viewContent','manipulateContent','Clients')">Go</div>

    &nbsp;&nbsp;
	<?php if(in_array('CV_clients',$thisPer)){ ?>
	<div class="buttonGreen" style="display:inline-block;text-shadow:0px 0px 0px white" onclick="$('#custViewBox').slideToggle('fast')"  >Custom View&nbsp;<img src="images/more.png" alt=""/></div>
	<?php }?>
	<!--<input id="" class="buttonnegetive" name="Button1" onclick="deleteData('leads','Leads')" type="button" value="Delete Selected" /> -->
	</td>
	</tr>
	
	</table>
	</div>
	<div style="background:#eee;padding:5px;display:none" id="custViewBox">
	<table width="100%" cellpadding="5" cellspacing="0">
    <tr>
	<td style="border-bottom:1px #999 solid">
	<div style="float:right">
	<img src="images/close-light.png" alt="" style="cursor:pointer" onclick="$('#custViewBox').slideToggle('fast')" />
	</div>

	Saved Views&nbsp;&nbsp;
	<?php
	$getView = mysql_query("SELECT `id`,`name` FROM `customview` WHERE `eid` = '$loggeduserid' AND `type` = 'c'",$con) or die(mysql_error());
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

	</select>
	<div style="display:inline-block" class="buttonBlue rightRound" onclick="getModule('clients/customView?view='+document.getElementById('savedView').value,'directResult','','Leads')">Go</div>
	<div style="float:right;margin-right:20px">
	<div class="buttonnegetive" style="display:inline-block" onclick="getModule('deleteView?id='+document.getElementById('savedView').value,'viewDeleted','','Leads');$('#custViewBox').slideToggle('fast')">Delete Selected View</div>
	<div id="viewDeleted"></div>
	</div>
	</td>
	</tr>
	
	<tr>
	<td>Please Create View
	</td>
	</tr>
<tr>
	<td>
	<select class="input" name="leadstatus" style="width: 207px;" id="cstview1">
	<option value="">Brokerage Reduced By 80% </option>			

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
&nbsp;&nbsp;
<select class="input" name="leadowner" style="width: 207px" id="cstview4">
<option value="">Lead Owner</option>
<option value="<?php echo $loggeduserid;?>">Self</option>	

<?php

if(in_array('VA_clients',$thisPer))
{
$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `status` = '1'",$con) or die(mysql_error()); 
}
else if(in_array('CA_tclients',$thisPer))
{
$getLead = mysql_query("SELECT COUNT(`id`) FROM `team` WHERE `leader` = '$loggeduserid'",$con) or die(mysql_error());
$rowLead = mysql_fetch_array($getLead);
if($rowLead[0] > 0)
{
$sql="SELECT  `contact`.`id`,`employee`.`name`, `contact`.`fname` ,`contact`.`lname`,`contact`.`code` ,  `contact`.`conversiondate` ,  `lasttradeddate`.`LastTradeOccured` ,`contact`.`callbackdate`,`contact`.`description`,`contact`.`modifieddate`,`contact`.`mark`,`contact`.`mobile` FROM  `contact` 
INNER JOIN  `lasttradeddate` ON  `contact`.`code` =  `lasttradeddate`.`code` INNER JOIN `employee` ON `contact`.`ownerid`=`employee`.`id` WHERE `contact`.`converted`='1'". $sortstr." LIMIT 50";
$getData = mysql_query($sql,$con) or die(mysql_error());
}
else
{
$sql="SELECT  `contact`.`id`,`employee`.`name`, `contact`.`fname` ,`contact`.`lname`,`contact`.`code` ,  `contact`.`conversiondate` ,  `lasttradeddate`.`LastTradeOccured` ,`contact`.`callbackdate`,`contact`.`description`,`contact`.`modifieddate`,`contact`.`mark`,`contact`.`mobile` FROM  `contact` 
INNER JOIN  `lasttradeddate` ON  `contact`.`code` =  `lasttradeddate`.`code` INNER JOIN `employee` ON `contact`.`ownerid`=`employee`.`id` WHERE `contact`.`converted`='1' AND `contact`.`ownerid`='$loggeduserid'". $sortstr." LIMIT 50"; 

// ".$leadstr." ".$sortstr
$getData = mysql_query($sql,$con) or die(mysql_error());
}
}
else
{
$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `id` = '$loggeduserid'",$con) or die(mysql_error()); 
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
			
<input id="cstview5" name="fromdate" class="inputCalender" placeholder="From Date" onclick="openCalendar(this);" readonly="readonly" type="text">&nbsp;&nbsp;
<input id="cstview6" name="fromdate" class="inputCalender" placeholder="To Date" onclick="openCalendar(this);" readonly="readonly" type="text"> in 
<select id="cstview7" name="Select1" class="input" style="width: 214px">
<option value="C1">Call Back Date</option>
<option value="C">Create Date</option>
<option value="M">Modified Date</option>
<option value="F">Last Traded Date</option>



</select>
&nbsp;&nbsp;
<input id="cstview8" name="introducer" class="input" placeholder="Introducer"  type="text">

</tr>
<tr>
<td>
<input name="Button1" class="buttonBlue" type="button" value="Create View For Now" onclick="getModule('clients/customViewActive?status='+document.getElementById('cstview1').value+'&source='+document.getElementById('cstview2').value+'&owner='+document.getElementById('cstview4').value+'&fromdate='+document.getElementById('cstview5').value+'&todate='+document.getElementById('cstview6').value+'&type='+document.getElementById('cstview7').value+'&introducer='+document.getElementById('cstview8').value,'directResult','','Clients');$('#custViewBox').slideToggle('fast')" />&nbsp;&nbsp;Or&nbsp;&nbsp;<input id="viewName" placeholder="Save This View For Future Use" class="input" name="Text1" type="text" style="width: 187px" /><div style="display:inline-block" class="buttonGreen rightRound" onclick="getModule('clients/customViewActive?status='+document.getElementById('cstview1').value+'&source='+document.getElementById('cstview2').value+'&owner='+document.getElementById('cstview4').value+'&fromdate='+document.getElementById('cstview5').value+'&todate='+document.getElementById('cstview6').value+'&type='+document.getElementById('cstview7').value+'&introducer='+document.getElementById('cstview8').value,'directResult','','Clients');$('#custViewBox').slideToggle('fast')">Save It!</div>
</td>
</tr>

</table>
</div>
<div id="directResult" style="height:600px;overflow:scroll">

<table id="viewtable" style="text-align:center;" cellpadding="0" cellspacing="0" class="fetch" width="100%">
   
	<tr>
	<th style="height:20px;width:3%">
	<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
	
	<th style="height:20px;width:3%">
	<img src="images/cold.png" alt="" style="height:12px"/>
	</th>
	
	
	<th style="height:20px;cursor:pointer;width:8%" onclick="getModule('clients/viewActive?sort=true&ftoSort=id&sortby=<?php if($ftoSort == 'id'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Clients')">
	Client Num. &nbsp;<?php if($ftoSort == 'id'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>&nbsp;
	</th>


    <th style="height:20px;width:8%">Client Owner</th>	

    <th style="height:20px;width:6.5%">Client Code</th>
	
    <th style="height:20px;cursor:pointer;width:16.5%" onclick="getModule('clients/viewActive?sort=true&ftoSort=fname&sortby=<?php if($ftoSort == 'fname'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Clients')">
	Client Name &nbsp;<?php if($ftoSort == 'fname'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>&nbsp;
	</th>
	
	<th style="height:20px;cursor:pointer;width:8%" >Click To Call </th>
		
	<th style="height:20px;width:16%">Description</th>

    <th style="height:20px;cursor:pointer;width:7%" onclick="getModule('clients/viewActive?sort=true&ftoSort=ConversionDate&sortby=<?php if($ftoSort == 'ConversionDate'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Clients')">
	ConversionDate &nbsp;
	<?php if($ftoSort == 'ConversionDate'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>
	</th>


	<th style="height:20px;cursor:pointer;width:7%" onclick="getModule('clients/viewActive?sort=true&ftoSort=callbackdate&sortby=<?php if($ftoSort == 'callbackdate'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Clients')">
	CallBackDate&nbsp;
	<?php if($ftoSort == 'callbackdate'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>
	</th>


	<th style="height:20px;cursor:pointer;width:7%" onclick="getModule('clients/viewActive?sort=true&ftoSort=modifieddate&sortby=<?php if($ftoSort == 'modifieddate'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Clients')">
	ModificationDate&nbsp;
	<?php if($ftoSort == 'modifieddate'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>
	</th>

	<th style="height:20px;cursor:pointer;width:7%" onclick="getModule('clients/viewActive?sort=true&ftoSort=LastTradeOccured&sortby=<?php if($ftoSort == 'LastTradeOccured'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Clients')">
	Last Trade On&nbsp;
	<?php if($ftoSort == 'LastTradeOccured'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>
	</th>

	<th style="width:3%;">Story</th>
    </tr>

    <?php
    $i=0;
    while($row=mysql_fetch_array($getData))
    {
    ?>
		
	   <tr <?php if($row['id'] == '0') echo "style='font-weight:bold'"; ?> id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" <?php if($row['modifieddate']==$date) {?>   class="modified" <?php } else if($row['modifieddate']=='0000-00-00'){ ?>   style="background:#ffffe0;"       <?php    } else if($row['modifieddate']!=$date && $row['modifieddate']!='0000-00-00') {  ?>  class="level<?php echo $row['level'] ?>" <?php } ?>   title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row['description']));?>">
		<td>
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
        
        <td>
		<div style="height:12px;">
		<?php if($row['mark'] == '1') { ?> 

		<img src="images/hot.png" id="hot<?php echo $row['id'];?>" style="height:12px" alt=""  onclick="getModule('leads/markHot?id=<?php echo $row['id'];?>&todo=cold','','hot<?php echo $row['id'];?>','');document.getElementById('cold<?php echo $row['id'];?>').style.display='';"/> 
		<img src="images/cold.png" id="cold<?php echo $row['id'];?>" style="height:12px;display:none" alt="" onclick="getModule('leads/markHot?id=<?php echo $row['id'];?>&todo=hot','','cold<?php echo $row['id'];?>','');document.getElementById('hot<?php echo $row['id'];?>').style.display='';"/>  

		<?php 
		} 
		else 
		{
		?> 
		<img src="images/hot.png" id="hot<?php echo $row['id'];?>" style="height:12px;display:none" alt=""  onclick="getModule('leads/markHot?id=<?php echo $row['id'];?>&todo=cold','','hot<?php echo $row['id'];?>','');document.getElementById('cold<?php echo $row['id'];?>').style.display='';"/> 
		<img src="images/cold.png" id="cold<?php echo $row['id'];?>" style="height:12px" alt="" onclick="getModule('leads/markHot?id=<?php echo $row['id'];?>&todo=hot','','cold<?php echo $row['id'];?>','');document.getElementById('hot<?php echo $row['id'];?>').style.display='';"/>  
		<?php 
		} 
		?>
		</div>
		</td>

    	

		<td><?php echo $row['id']; ?> </td>
		
		<td><?php echo $row['name']; ?> </td>
		
		<td><?php echo $row['code'] ?></td>



    	<?php
		$toPassurl = 'clients/edit?id='.$row['id'].'&i='.$i;
		$toPassurl = base64_encode($toPassurl);
		$showid = base64_encode('manipulateContent');
		$hideid = base64_encode('viewContent');
		$title = base64_encode($row['fname']);
		$finalUrl = 'default.php#'.$toPassurl.'$$**$$'.$showid.'$$**$$'.$hideid.'$$**$$'.$finalUrl;
		?>
		
		<td  onclick="getModule('clients/edit?id=<?php echo $row['id'] ;?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo str_ireplace('"','',$row['fname']);?>')" onmousedown="mouseDown(event,'<?php echo $finalUrl;?>')" class="blueSimpletext">
		<?php echo $row['fname'] ." ".$row['lname'];?></td>
		
		<td><a Onclick="getModule('noteline/index?cid=<?php echo $row['id'];?>&name=<?php echo $row['fname'];?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo $row['fname'];?>');document.getElementById('ModalCloseButton').style.display = 'none';" class="blueSimpletext clickto"  href="callto:<?php echo $row['mobile']; ?>">Click to call</a></td>

		
		<td style="width:16%" onclick="getModule('noteline/index?cid=<?php echo $row['id'];?>&name=<?php echo $row[1]." ".$row[2];?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo $row[1]." ".$row[2];?>')"><?php echo substr($row['description'],0,20);?>..</td><!-- Description -->
	
	
        <td><?php echo date("d,M,Y", strtotime($row['conversiondate']));?></td><!-- Approval Date -->
	
		<td><?php 
		//echo date("d,M,Y", strtotime($row['callbackdate']));
		if($row['callbackdate'] == '0000-00-00' || $row['callbackdate'] == '1970-01-01' || $row['callbackdate'] == ''){
			echo date('d,M,Y');
		}else{
			echo date("d,M,Y", strtotime($row['callbackdate']));
		}
		
		?></td><!-- Callbackdate Date -->
	
	    <td><?php echo date("d,M,Y", strtotime($row['modifieddate']));?></td><!-- Modified Date Date -->

       <td><?php echo date("d,M,Y", strtotime($row['LastTradeOccured']));?></td><!-- Modified Date Date -->

	    

       <td>
          <img onclick="getModule('noteline/index?cid=<?php echo $row['id'];?>&name=<?php echo $row['fname']. " ".$row['lname'] ;?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo $row['id'];?>')" src="images/story.png" style="width:15px" title="Story For <?php echo $row['fname'] . " ". $row['lname'] ;?>" alt=""/>
	   </td>
</tr>
<?php
$i++;
$Maxid = $row['id'];
$MaxI = $i;
$list .= $row['id'].",";
}
?>
</table>



    <div id="tableWrap">
	<table border="1" style="text-align:center;display:none;">
    <thead>
    <th>Client Number</th>
    <th>Client Owner</th>
    <th>Client Code</th>
    <th>Client Name</th>
    <th>Description</th>
    <th>Conversion Date</th>
    <th>Callback Date</th>
    <th>Modification Date</th>
    <th>Last Trade On</th>
    </thead>
    <tbody>

    <?php 
if(in_array('VA_clients',$thisPer))
{
$sqlInExcel="SELECT  `contact`.`id`,`employee`.`name`, `contact`.`fname` ,`contact`.`lname`,`contact`.`code` ,  `contact`.`conversiondate` ,  `lasttradeddate`.`LastTradeOccured` ,`contact`.`callbackdate`,`contact`.`description`,`contact`.`modifieddate`,`contact`.`mark`,`contact`.`mobile` FROM  `contact` 
INNER JOIN  `lasttradeddate` ON  `contact`.`code` =  `lasttradeddate`.`code` INNER JOIN `employee` ON `contact`.`ownerid`=`employee`.`id` WHERE `contact`.`converted`='1'". $sortstr;  

$getExcelData = mysql_query($sqlInExcel,$con) or die(mysql_error());
}
else
{
$sqlInExcel ="SELECT  `contact`.`id`,`employee`.`name`, `contact`.`fname` ,`contact`.`lname`,`contact`.`code` ,  `contact`.`conversiondate` ,  `lasttradeddate`.`LastTradeOccured` ,`contact`.`callbackdate`,`contact`.`description`,`contact`.`modifieddate`,`contact`.`mark`,`contact`.`mobile` FROM  `contact` 
INNER JOIN  `lasttradeddate` ON  `contact`.`code` =  `lasttradeddate`.`code` INNER JOIN `employee` ON `contact`.`ownerid`=`employee`.`id` WHERE `contact`.`converted`='1' AND `contact`.`ownerid`='$loggeduserid'". $sortstr;  

$getExcelData = mysql_query($sqlInExcel,$con) or die(mysql_error());	
}
 
 
while($rowExcel=mysql_fetch_array($getExcelData))
{
?>
 <tr>
 <td><?php echo $rowExcel['id']; ?> </td>
 <td><?php echo $rowExcel['name']; ?> </td>
 <td><?php echo $rowExcel['code']; ?> </td>
 <td><?php echo $rowExcel['fname'] ." ".$rowExcel['lname'];?></td>
 <td><?php echo substr($rowExcel['description'],0,20);?></td><!-- Description -->
 <td><?php echo date("d,M,Y", strtotime($rowExcel['conversiondate']));?></td><!-- Approval Date -->
 <td>
 	<?php
 	if($rowExcel['callbackdate'] != '0000-00-00'){
			echo date("d,M,Y", strtotime($row['callbackdate']));	
		}else{
			echo date("d,M,Y");
		}
 	?>
 		
 	</td><!-- Callbackdate Date -->
 <td><?php echo date("d,M,Y", strtotime($rowExcel['modifieddate']));?></td><!-- Modified Date Date -->
 <td><?php echo date("d,M,Y", strtotime($rowExcel['LastTradeOccured']));?></td><!-- Modified Date Date -->
 </tr>

<?php 
}
?>

    </tbody>
    </table>
	</div>
  

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

<?php // echo $sqlData;?>
<input name="Text1" type="text" value="<?php echo $sqlData;?>" id="tlview" style="display:none" />
<input name="Text1" type="text" value="<?php echo $list;?>" id="idList" style="display:none" />
<input name="Text1" type="text" value="1" id="uptoFetch" style="display:none" />

<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
<span id="moreButton">
<div style="cursor:pointer;" onclick="moreData('clients/ActiveFetchMore?sql='+document.getElementById('tlview').value+'&upto='+document.getElementById('uptoFetch').value,'moreData','');" id="fetchingDone">
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
