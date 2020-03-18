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
$ftoSort = $_GET['ftoSort'];
$sortby = $_GET['sortby'];
$sortstr = "ORDER BY customersupport.".$ftoSort." ".$sortby." LIMIT 25";
// LIMIT 100   
}
else
{
$sortstr = "ORDER BY customersupport.callbackdate DESC LIMIT 25";
// LIMIT 100
}

if(in_array('VA_clients',$thisPer) && $perm==1)
{
$sqlData="SELECT customersupport.tradingbellsid,contact.fname,customersupport.callbackdate,teamamtes.mateid,contact.conversiondate,levelsupport.name as levelname,customersupport.description,customersupport.allotmentid,contact.id,customersupport.level,employee.name,customersupport.modifieddate,customersupport.ClosingDate,contact.mobile,employee.callingextension FROM  
 customersupport INNER JOIN contact ON customersupport.clientid=contact.id
 INNER JOIN teamamtes ON customersupport.allotmentid=teamamtes.mateid
 INNER JOIN employee ON customersupport.RMOwnerid=employee.id
 INNER JOIN levelsupport ON customersupport.level=levelsupport.id WHERE `contact`.`converted`='1' AND `customersupport`.`Npcpool`='0' and `contact`.`delete`='0' " . $sortstr . "";

$getData = mysql_query($sqlData,$con) or die(mysql_error());

}
else if(in_array('VA_clients',$thisPer) && $perm==8)
{
 $sqlData ="SELECT customersupport.tradingbellsid,contact.fname,customersupport.callbackdate,teamamtes.mateid,contact.conversiondate,levelsupport.name as levelname,customersupport.description,customersupport.allotmentid,contact.id,customersupport.level,employee.name,customersupport.modifieddate,customersupport.ClosingDate,contact.mobile,employee.callingextension FROM  
customersupport INNER JOIN contact ON customersupport.clientid=contact.id
 INNER JOIN teamamtes ON customersupport.allotmentid=teamamtes.mateid
 INNER JOIN employee ON customersupport.RMOwnerid=employee.id
 INNER JOIN levelsupport ON customersupport.level=levelsupport.id WHERE `contact`.`converted`='1' and `contact`.`delete`='0' AND `customersupport`.`Npcpool`='0'  AND `teamamtes`.`mateid`='$loggeduserid' " . $sortstr . "";

$getData = mysql_query($sqlData,$con) or die(mysql_error());

}
else
{
$sqlData ="SELECT customersupport.tradingbellsid,contact.fname,contact.callbackdate,contact.mobile,contact.conversiondate,levelsupport.name  as levelname,customersupport.description,customersupport.allotmentid,contact.id,customersupport.level,employee.name,customersupport.modifieddate,customersupport.ClosingDate,contact.mobile FROM  
customersupport INNER JOIN contact ON customersupport.clientid=contact.id
 INNER JOIN employee ON customersupport.RMOwnerid=employee.id
 INNER JOIN levelsupport ON customersupport.level=levelsupport.id WHERE `contact`.`ownerid`='$loggeduserid' AND `contact`.`converted`='1' AND `contact`.`delete`='0' " . $sortstr . "";

$getData = mysql_query($sqlData,$con) or die(mysql_error());	
}





$countThis=mysql_num_rows($getData);

$tempsql = str_ireplace('LIMIT 25','',$sqlData);
$getCount = mysql_query($tempsql,$con) or die(mysql_error());
$countTotal = mysql_num_rows($getCount);


?>
<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
	<td align="left" style="width: 30%">Clients</td>
	<td align="right" style="width: 70%">
	<?php if(in_array('CO_clients',$thisPer) || in_array('D_clients',$thisPer)){ ?>
	<select  class="input" name="Select1" id="action"  style="width: 180px;padding:2px">
	<?php if(in_array('CO_clients',$thisPer)){?><option value="c">Change Owner</option><?php }?>
	<?php if(in_array('CO_clients',$thisPer)){?><option value="co">Change Support Owner</option><?php }?>
	
	<?php if(in_array('D_clients',$thisPer)){ ?><option value="contact:Clients">Delete</option><?php }?>
	<?php if(in_array('ME_clients',$thisPer)){ ?><option value="3">Mass Edit</option><?php }?>
	</select>
	<?php }
	if(in_array('CO_clients',$thisPer) || in_array('D_clients',$thisPer)){ ?>
	<div class="buttonGreen rightRound" style="width: 20px;display:inline-block" onclick="takeAction(document.getElementById('action').value)">Go</div>
	<?php } ?>	&nbsp;&nbsp;
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

			</select><div style="display:inline-block" class="buttonBlue rightRound" onclick="getModule('clients/customView?view='+document.getElementById('savedView').value,'directResult','','Leads')">Go</div>
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
	<option value="">Lead Status</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `leadstatus` WHERE `delete` = '0' order by `name` ASC",$con) or die(mysql_error()); 
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
$getCity = mysql_query("SELECT `name`,`id` FROM `leadsource` WHERE `delete` = '0' order by `name` ASC",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
</select>
&nbsp;&nbsp;<select class="input" name="leadresponse" style="width: 207px" id="cstview3">
<option value="">Lead Response</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `leadresponse` WHERE `delete` = '0' order by `order` ASC",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
</select>
&nbsp;&nbsp;<select class="input" name="leadowner" style="width: 207px" id="cstview4">
<option value="">Lead Owner</option>
<option value="<?php echo $loggeduserid;?>">Self</option>	

<?php

if(in_array('VA_clients',$thisPer))
{
$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `status` = '1' ORDER BY `name` ASC",$con) or die(mysql_error()); 
}
else if(in_array('CA_tclients',$thisPer))
{
$getLead = mysql_query("SELECT COUNT(`id`) FROM `team` WHERE `leader` = '$loggeduserid'",$con) or die(mysql_error());
$rowLead = mysql_fetch_array($getLead);
if($rowLead[0] > 0)
{
$sql="SELECT customersupport.tradingbellsid,contact.fname,customersupport.callbackdate,teamamtes.mateid,contact.conversiondate,levelsupport.name  as levelname,customersupport.description,customersupport.allotmentid,contact.id,customersupport.level as levelname,employee.name,customersupport.ClosingDate,contact.mobile FROM  
customersupport INNER JOIN contact ON customersupport.clientid=contact.id
 INNER JOIN teamamtes ON customersupport.allotmentid=teamamtes.mateid
 INNER JOIN employee ON customersupport.ownerid=employee.id
 INNER JOIN levelsupport ON customersupport.level=levelsupport.id GROUP BY expensereport.Clientid  AND contact.delete= '0' AND contact.converted = '1' " . $sortstr . " ";
$getData = mysql_query($sql,$con) or die(mysql_error());
}
else
{
$sql="SELECT customersupport.tradingbellsid,contact.fname,customersupport.callbackdate,teamamtes.mateid,contact.conversiondate,levelsupport.name as levelname,customersupport.description,customersupport.allotmentid,contact.id,customersupport.level as levelname,employee.name,customersupport.ClosingDate,contact.mobile FROM  
customersupport INNER JOIN contact ON customersupport.clientid=contact.id
 INNER JOIN teamamtes ON customersupport.allotmentid=teamamtes.mateid
 INNER JOIN employee ON customersupport.ownerid=employee.id
 INNER JOIN levelsupport ON customersupport.level=levelsupport.id WHERE contact.delete = '0' AND contact.converted ='1' AND teamamtes.mateid= '$loggeduserid' " . $sortstr . ""; 

// ".$leadstr." ".$sortstr
$getData = mysql_query($sql,$con) or die(mysql_error());
}
}
else
{
$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `id` = '$loggeduserid' order by `name` ASC",$con) or die(mysql_error()); 
}
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
</select>
&nbsp;&nbsp;<select class="input" name="relationshipmanager" style="width:207px" id="cstview15">
<option value="">Relationship Manager</option>		
<option value="1">Admin</option>		
	
<?php
$getRelationManager = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `status`='1' AND `employee`.`delete`='0' AND (`profile` = '16' || `profile` = '19' || `profile` = '30'|| `profile` = '11'|| `profile` = '28'|| `profile` = '29') ORDER BY `name` ASC",$con) or die(mysql_error()); 
while($rowRelationShip = mysql_fetch_array($getRelationManager))
{
?>
<option value="<?php echo $rowRelationShip[1];?>"><?php echo $rowRelationShip[0];?></option>
<?php
}
?>
</select>

&nbsp;&nbsp;<select class="input" name="clientowner" style="width:165px" id="cstview10">			
	<option value="">Support Client Owner</option>
	<option value="1">Admin</option>

<?php
if(in_array('VA_clients',$thisPer))
{   
$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND (`profile`='8' || `profile`='9')  order by name asc",$con) or die(mysql_error()); 
}
else if(in_array('CA_tclients',$thisPer))
{  
	$getLead = mysql_query("SELECT COUNT(`id`) FROM `team` WHERE `leader` = '$loggeduserid' AND `team`.`id`='6' order by name asc",$con) or die(mysql_error());
	$rowLead = mysql_fetch_array($getLead);
	if($rowLead[0] > 0)
	{
	$getCity = mysql_query("SELECT employee.name,teamamtes.mateid FROM employee,team,teamamtes WHERE team.leader = '$loggeduserid' AND teamamtes.mateid = employee.id AND teamamtes.teamid = team.id AND `team`.`id`='6' AND team.delete = '0' AND employee.delete = '0' AND `employee`.`profile`='8' order by employee.name asc",$con) or die(mysql_error());
	}
	else
	{
	$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `id` = '$loggeduserid' AND (`employee`.`profile`='8' || `employee`.`profile`='9') order by employee.name asc",$con) or die(mysql_error()); 
	}
 }   
else
{
$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `id` = '$loggeduserid' AND (`employee`.`profile`='8' || `employee`.`profile`='9') order by employee.name asc",$con) or die(mysql_error()); 
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
<option value="C">Approval Date</option>
<option value="M">Modified Date</option>
<option value="LC">Level Closing Date</option>

<!-- <option value="F">Fretrial Request Date</option>   -->

</select>
&nbsp;&nbsp;
<select class="input" name="product" style="width: 207px" id="cstview8">
<option value="">Segment</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `category` WHERE `delete` = '0' order by `name` ASC",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
</select>
</tr>
<tr>
<td>
<select id="cstview9" class="input" style="width:207">
<option value="ALL">All Clients</option>
<option value="TR">Transferred Clients</option>
<option value="AC">Active Clients</option>
</select>
&nbsp;&nbsp;
<select id="cstview11" class="input" style="width:207">
<option value="">Select level</option>
<option value="L1">level-1</option>
<option value="L2">level-2</option>
<option value="L3">level-3</option>
<option value="LN">level-N</option>

</select>
&nbsp;&nbsp;
<input id="cstview16" name="introducer" class="input" placeholder="Introducer"  type="text">
</td>

</tr>


<tr>
<td>
<input name="Button1" class="buttonBlue" type="button" value="Create View For Now" onclick="getModule('clients/customView?status='+document.getElementById('cstview1').value+'&source='+document.getElementById('cstview2').value+'&response='+document.getElementById('cstview3').value+'&owner='+document.getElementById('cstview4').value+'&fromdate='+document.getElementById('cstview5').value+'&todate='+document.getElementById('cstview6').value+'&type='+document.getElementById('cstview7').value+'&product='+document.getElementById('cstview8').value+'&read='+document.getElementById('cstview9').value+'&level='+document.getElementById('cstview11').value+'&supportowner='+document.getElementById('cstview10').value+'&future='+document.getElementById('viewName').value+'&RelationManager='+document.getElementById('cstview15').value+'&introducer='+document.getElementById('cstview16').value,'directResult','','Clients');$('#custViewBox').slideToggle('fast')" />&nbsp;&nbsp;Or&nbsp;&nbsp;<input id="viewName" placeholder="Save This View For Future Use" class="input" name="Text1" type="text" style="width: 187px" /><div style="display:inline-block" class="buttonGreen rightRound" onclick="getModule('clients/customView?status='+document.getElementById('cstview1').value+'&source='+document.getElementById('cstview2').value+'&response='+document.getElementById('cstview3').value+'&owner='+document.getElementById('cstview4').value+'&fromdate='+document.getElementById('cstview5').value+'&todate='+document.getElementById('cstview6').value+'&type='+document.getElementById('cstview7').value+'&product='+document.getElementById('cstview8').value+'&read='+document.getElementById('cstview9').value+'&level='+document.getElementById('cstview11').value+'&supportowner='+document.getElementById('cstview10').value+'&future='+document.getElementById('viewName').value+'&RelationManager='+document.getElementById('cstview15').value+'&introducer='+document.getElementById('cstview16').value,'directResult','','Clients');$('#custViewBox').slideToggle('fast')">Save It!</div>
</td>
</tr>

</table>
</div>
<div id="directResult" style="height:600px;overflow:scroll">
<table id="viewtable" style="text-align:center;" cellpadding="0" cellspacing="0" class="fetch" width="100%">
   
	<tr>
	<th style="height:20px">
	<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
	
	<th style="height:20px;">
	<img src="images/cold.png" alt="" style="height:12px"/>
	</th>
	
	<th style="height:20px;cursor:pointer" onclick="getModule('clients/view?sort=true&ftoSort=id&sortby=<?php if($ftoSort == 'id'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Clients')">
	Client Number &nbsp;<?php if($ftoSort == 'id'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>&nbsp;
	</th>
	
	<th style="height:20px">RM/SRM </th>

	
	<th style="height:20px">Client ID</th>
	<th style="height:20px;cursor:pointer" onclick="getModule('clients/view?sort=true&ftoSort=fname&sortby=<?php if($ftoSort == 'fname'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Clients')">
	Client Name &nbsp;<?php if($ftoSort == 'fname'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>&nbsp;
	</th>
	
	
	<th style="height:20px;cursor:pointer;width:180px;" >Click To Call </th>
		
	
	<th style="height:20px;cursor:pointer" onclick="getModule('clients/view?sort=true&ftoSort=level&sortby=<?php if($ftoSort == 'level'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Clients')">
	Level &nbsp;<?php if($ftoSort == 'level'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>&nbsp;
	</th>
	
	<th style="height:20px;cursor:pointer" onclick="getModule('clients/view?sort=true&ftoSort=conversiondate&sortby=<?php if($ftoSort == 'conversiondate'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Clients')">Approval Date&nbsp;
	<?php if($ftoSort == 'conversiondate'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>
	</th>
	
	<th style="height:20px;cursor:pointer" onclick="getModule('clients/view?sort=true&ftoSort=ClosingDate&sortby=<?php if($ftoSort == 'ClosingDate'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Clients')">
	ClosingDate &nbsp;
	<?php if($ftoSort == 'ClosingDate'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>
	</th>
	<th style="height:20px">Description</th>
	<th style="height:20px;cursor:pointer" onclick="getModule('clients/view?sort=true&ftoSort=callbackdate&sortby=<?php if($ftoSort == 'callbackdate'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Clients')">
	CallBackDate&nbsp;
	<?php if($ftoSort == 'callbackdate'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>
	</th>
	<th style="height:20px;cursor:pointer" onclick="getModule('clients/view?sort=true&ftoSort=modifieddate&sortby=<?php if($ftoSort == 'modifieddate'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Clients')">
	ModificationDate&nbsp;
	<?php if($ftoSort == 'modifieddate'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>
	</th>
    <th style="height:20px">Revenue</th>
<!-- <th style="height:20px">Turnover</th>   -->
	<th style="height:20px">Status</th>
	<th style="height:20px">Support Owner</th>
	<th>Level Details</th>
    </tr>

    <?php
    $i=0;
    while($row=mysql_fetch_array($getData))
    {
    ?>
		
		
		
	    <tr <?php if($row['id'] == '0') echo "style='font-weight:bold'"; ?>id="fetchRow<?php echo $i;?>" <?php if($row['modifieddate']==$date) {?>   class="modified" <?php } else if($row['modifieddate']=='0000-00-00'){ ?>   style="background:#ffffe0;"       <?php    } else if($row['modifieddate']!=$date && $row['modifieddate']!='0000-00-00') {  ?>  class="level<?php echo $row['level'] ?>" <?php } ?>   title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row['description']));?>">
		<td style="width:20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
        
        <td style="width:15px;">
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
    		
		<td style="width:100px;"><?php echo $row['id']; ?> </td>
		<td style="width:100px;"><?php echo $row['name']; ?> </td>
		
	
		
		<?php
		$toPassurl = 'clients/edit?id='.$row['id'].'&i='.$i;
		$toPassurl = base64_encode($toPassurl);
		$showid = base64_encode('manipulateContent');
		$hideid = base64_encode('viewContent');
		$title = base64_encode($row['fname']);
		$finalUrl = 'default.php#'.$toPassurl.'$$**$$'.$showid.'$$**$$'.$hideid.'$$**$$'.$finalUrl;
		?>
		<td><?php echo $row['tradingbellsid'] ?></td>
		
		<td style="width:100px" onclick="getModule('clients/edit?id=<?php echo $row['id'] ;?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo str_ireplace('"','',$row['fname']);?>')" onmousedown="mouseDown(event,'<?php echo $finalUrl;?>')" class="blueSimpletext">
		<?php echo $row['fname'] ." ".$row['lname'];?></td>
		
		<td><a Onclick="CallApi('<?php echo $row["callingextension"] ?>','<?php echo $row["mobile"] ?>');getModule('noteline/index?cid=<?php echo $row['id'];?>&name=<?php echo $row['fname'];?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo $row['fname'];?>');document.getElementById('ModalCloseButton').style.display = 'none';" class="blueSimpletext clickto" >Click to call</a></td>
	
    	<td style="width:100px"><?php echo $row['levelname'];?></td><!-- LEVEL SUPPORT -->
	
        <td style="width:100px"><?php echo date("d,M,Y", strtotime($row['conversiondate']));?></td><!-- Approval Date -->
	
	    <td style="width:100px"><?php echo date("d,M,Y", strtotime($row['ClosingDate']));?></td><!-- Call Back Date -->
		
		<td style="width:100px"><?php echo substr($row['description'],0,20);?>..</td><!-- Description -->
		
		<td style="width:100px">
		<?php 
		if($row['callbackdate'] != '0000-00-00'){
			echo date("d,M,Y", strtotime($row['callbackdate']));	
		}else{
			echo date("d,M,Y");
		}
		?>
			
		</td><!-- Callbackdate Date -->
	
	    <td style="width:100px"><?php echo date("d,M,Y", strtotime($row['modifieddate']));?></td><!-- Modified Date Date -->
		
		
		
		<?php
		$code=$row['tradingbellsid'];
     	$sql="SELECT (SUM(`RevenueGeneration`)+SUM(`BrokeragePremium`)) as TotalBrokerage,SUM(`Turnover`) FROM `expensereport` WHERE `Clientid`='$code' GROUP BY Clientid";
        $res=mysql_query($sql,$con);
		$rowEx=mysql_fetch_array($res);
	
		?>
		
		
		<?php 
		if($rowEx['TotalBrokerage']=='')
		{
		$revenue='0';	
		}
		else
		{
		$revenue=$rowEx['TotalBrokerage'];	
		}
		
		if($revenue<=999)
		{
		$n_format = number_format($revenue, 1);
		$suffix = 'Rs';
		$revenue=$n_format ." " . $suffix;
		}
		else if($revenue >= 999 && $revenue <= 99999)
		{
		$n_format = number_format($revenue/1000, 1);
		$suffix = 'K';
		$revenue=$n_format ." " . $suffix;	
		}
		
		else if($revenue >= 99999 && $revenue <= 9999999)
		{
		$n_format = number_format($revenue/100000, 1);
		$suffix = 'Lac';
		$revenue=$n_format ." " . $suffix;	
		}
		
		else if($revenue >= 9999999 && $revenue <= 999999999)
		{
		$n_format = number_format($revenue/10000000, 1);
		$suffix = 'Cr';
		$revenue=$n_format ." " . $suffix;	
		}
		
		
	    ?>
	
		<td style="width:100px"><?php echo $revenue; ?></td><!-- revenue Generation -->
		
		
		<?php 
	/*	if($rowEx[1]=='')
		{
		$turnover='0';	
		}
		else
		{
		$turnover=$rowEx['Turnover'];	
		}
		
		if($turnover<=999)
		{
		$n_format = number_format($turnover, 1);
		$suffix = 'Rs';
		$turnover=$n_format ." " . $suffix;
		}
		else if($turnover >= 999 && $turnover <= 99999)
		{
		$n_format = number_format($turnover/1000, 1);
		$suffix = 'K';
		$turnover=$n_format ." " . $suffix;	
		}
		
		else if($turnover>= 99999 && $turnover <= 9999999)
		{
		$n_format = number_format($turnover/100000, 1);
		$suffix = 'Lac';
		$turnover=$n_format ." " . $suffix;	
		}
		
		else if($turnover >= 9999999 && $turnover <= 999999999)
		{
		$n_format = number_format($turnover/10000000, 1);
		$suffix = 'Cr';
		$turnover=$n_format ." " . $suffix;	
		}
		
		*/
		
	     ?>
		
		
	<!-- 	<td style="width:100px"><?php // echo $turnover; ?></td><!-- revenue Generation -->
		
		
		
		<?php 
	    
		if(mysql_num_rows($res) > 0 )
		{
		?>
	    <td style='width:100px'><img src="images/right.png" style="width:15px" alt=""/></td>
		<?php }
		else if(mysql_num_rows($res)==0)
		{
        $currentDate = strtotime($datetime);
        $futureDate = $currentDate-(2678400);
        $prevDate= date("Y-m-d H:i:s", $futureDate); 
  	
		$resPrev="SELECT * FROM `expensereport` WHERE `UploadingDate` BETWEEN '$prevDate' AND '$datetime' AND `Clientid`='$row[0]' GROUP BY Clientid";
		$rowPrev=mysql_num_rows($resPrev);
 		
		if($rowPrev>0 )
		{  ?>
	    <td style='width:100px'><img src="images/exclame.png" style="width:15px" alt=""/></td>
		<?php   }
		if($rowPrev==0 )
		{
        $sqlDetails="SELECT * FROM `expensereport` WHERE `Clientid`='".$row['id']."' GROUP BY Clientid";
		$rowAll=mysql_num_rows($sqlDetails);
		if($rowAll==0)
		{  ?>
		<td style='width:100px'><img src="images/delete.png" style="width:15px" alt=""/></td>
		<?php   }
 		}
		}
		
		$sql="SELECT `name` FROM `employee` WHERE `id`='$row[3]'";
		$res=mysql_query($sql,$con);
		$rowName=mysql_fetch_array($res);
		?>
		
		
		
		 
		<td style="width:100px"><?php echo $rowName[0];?></td>
 
		<td>
<img onclick="SupportLevel('<?php echo $row['id'] ;?>')"  src="images/story.png" style="width:15px" title="Story For <?php echo $row[0];?>" alt=""/>
			
</td>
</tr>
<?php
$i++;
$Maxid = $row[8];
$MaxI = $i;
$list .= $row[8].",";
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

<?php // echo $list;?>
<input name="Text1" type="text" value="<?php echo $sqlData;?>" id="tlview" style="display:none" />
<input name="Text1" type="text" value="<?php echo $list;?>" id="idList" style="display:none" />
<input name="Text1" type="text" value="1" id="uptoFetch" style="display:none" />

<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
<span id="moreButton">
<div onclick="moreData('clients/fetchmore?sql='+document.getElementById('tlview').value+'&upto='+document.getElementById('uptoFetch').value,'moreData','');" style="cursor: pointer;padding-top:5px;" id="fetchingDone">
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
