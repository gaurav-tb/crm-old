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
$fdate = $fromdate." "."00:00:01";
$tdate = $todate." "."23:59:59";
$type=$_GET['type'];
$leadstatus=$_GET['status'];
$leadsource=$_GET['source'];
$leadresponse=$_GET['response'];
$leadowner=$_GET['owner'];
$product = $_GET['product'];
$mark = $_GET['read'];
$supportowner = $_GET['supportowner'];
$level = $_GET['level'];
$RelationManager = $_GET['RelationManager'];
$introducer = $_GET['introducer'];
$brokerage_plan = $_GET['brokerage_plan'];
$fromdate_conversion = $_GET['fromdate_conversion']." "."00:00:01";
$todate_conversion = $_GET['todate_conversion']." "."23:59:59";
$fromdate_fund_payment = $_GET['fromdate_fund_payment'];
$todate_fund_payment = $_GET['todate_fund_payment'];
$fromdate_ftd = $_GET['fromdate_ftd'];
$todate_ftd = $_GET['todate_ftd'];
$fromdate_td = $_GET['fromdate_td'];
$todate_td = $_GET['todate_td'];

if($_GET['ftoSort'])
{
$ftoSort = $_GET['ftoSort'];
$sortby = $_GET['sortby'];
$sortstr = " ORDER BY contact.".$ftoSort." ".$sortby." LIMIT 50";
}
else
{
$sortstr = " ORDER BY contact.id DESC LIMIT 50";
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

$sqlData="SELECT customersupport.tradingbellsid,contact.fname,customersupport.callbackdate,teamamtes.mateid,contact.conversiondate,levelsupport.name as levelname,customersupport.description,customersupport.allotmentid,contact.id,customersupport.level,employee.name,customersupport.modifieddate,customersupport.ClosingDate FROM  
customersupport INNER JOIN contact ON customersupport.clientid=contact.id
 INNER JOIN teamamtes ON customersupport.allotmentid=teamamtes.mateid
 INNER JOIN employee ON customersupport.RMOwnerid=employee.id
 INNER JOIN  `activatepremium` ON  `contact`.`id` =  `activatepremium`.`cid`
 INNER JOIN levelsupport ON customersupport.level=levelsupport.id WHERE `contact`.`converted`='1' AND `customersupport`.`Npcpool`='0' and `contact`.`delete`='0'";


	
	if($mark == 'TC')
	{
	$sqlData .= " AND contact.read = '0'";
	}
	if($mark == 'TR')
	{
	$sqlData .= " AND contact.transfrom != '0'";
	}
	if($mark == 'AC')
	{
	$sqlData .="AND expensereport.UploadingDate='$fdate' AND '$tdate'";
	}
	
	if($level == 'L1')
	{
	$sqlData .= " AND  customersupport.level='1'";
	}
	
	if($level == 'L2')
	{
	$sqlData .= " and customersupport.level='2'";
	}
	
	if($level == 'L3')
	{
	$sqlData .= " and customersupport.level='3'";
	}
	
	if($level == 'LN')
	{
	$sqlData .= " and customersupport.level='4'";
	}
	

    if($fromdate != '' || $todate != '' )
    {
	if($type == 'C1')
	{
	$sqlData .= " and customersupport.callbackdate BETWEEN '$fromdate' AND '$todate'";
	}
	if($type == 'C')
	{
	$sqlData .= " and customersupport.conversiondate BETWEEN '$fdate' AND '$tdate'";
	}
	
	if($type == 'LC')
	{
	$sqlData .= " and customersupport.ClosingDate BETWEEN '$fdate' AND '$tdate'";
	}
	
	if($type == 'M')
	{
	$sqlData .= " and customersupport.modifieddate BETWEEN '$fdate' AND '$tdate'";
	
	}
	
	
	

	else if($type == 'F')
	{
	$sqlData .= " AND servicecall.type = 'f'  AND servicecall.createdate BETWEEN '$fdate' AND '$tdate' AND servicecall.delete = '0'";
	}

}



if($leadstatus != "")
{
$sqlData .= " and contact.leadstatus LIKE '%$leadstatus%'";
}

if($leadsource != "")
{
$sqlData .= " and contact.leadsource = '$leadsource'";
}

if($leadresponse != "")
{
$sqlData .= " and contact.latestresponse = '$leadresponse'";
}
if($introducer != "")
{
$sqlData .= " and contact.inroducer = '$introducer'";
}

if($leadowner != "")
{
$sqlData .= " and contact.ownerid = '$leadowner'";
}


if($product != "")
{
$p = "-".$product."-";
$sqlData .= " and contact.product LIKE '%$p%'";
}

if($supportowner!="")
{	
// $res=mysql_query("SELECT `id` FROM `teamamtes` WHERE `mateid`='$supportowner' AND `teamid`='6'");
// $row=mysql_fetch_array($res);
// $p =$row[0];	
$sqlData .= " and customersupport.allotmentid='$supportowner'";

}

if($RelationManager!="")
{	
 $sqlData .= " and customersupport.RMOwnerid = '$RelationManager'";
}   


// if($brokerage_plan!="")
// {	
//  $sqlData .= " and customersupport.RMOwnerid = '$RelationManager'";
// }   

if(!empty($_GET['fromdate_conversion']) && !empty($_GET['todate_conversion']))
{
 $sqlData .= " and contact.conversionrequestdate BETWEEN '".$fromdate_conversion."' AND '".$todate_conversion."' and converted='1'";
}

if(!empty($_GET['fromdate_ftd']) && !empty($_GET['todate_ftd']))
{
 $sqlData .= " and customersupport.`first_trade_date` BETWEEN '".$fromdate_ftd."' AND '".$todate_ftd." and `first_trade`='1'";
}

if(!empty($_GET['brokerage_plan']))
{
 $sqlData .= " and activatepremium.`Plan`='".$brokerage_plan."'";
}



// if(!empty($_GET['fromdate_fund_payment']) && !empty($_GET['todate_fund_payment']))
// {
//  $sqlData .= "and payinpayoutlogs.TradeDate BETWEEN '".$fromdate_fund_payment."' AND '".$todate_fund_payment."'";
// }

// if($_GET['fromdate_td']!='' && $_GET['todate_td']!='')
// {
//  $sqlData .= " and contact.conversionrequestdate BETWEEN '".$fromdate_td."' AND '".$todate_td."'";
// }


else
{
	if(in_array('VA_leads',$thisPer))
	{
	$sqlData .= " AND (1=1)";
	}
	else
	{
	if(in_array('CA_tclients',$thisPer))
	{
	$getLead = mysql_query("SELECT COUNT(`id`) FROM `team` WHERE `leader` = '$loggeduserid'",$con) or die(mysql_error());
	$rowLead = mysql_fetch_array($getLead);
	if($rowLead[0] > 0)
	{
	$sqlData .= " and contact.ownerid IN (SELECT teamamtes.mateid FROM team,teamamtes WHERE team.leader = '".$loggeduserid."' AND teamamtes.teamid = team.id AND team.delete = '0') ";
	}
	else
	{
	$sqlData .= " and contact.ownerid = '$loggeduserid'";
	}
	}
	else
	{
		
	$sqlData .= " and contact.ownerid = '$loggeduserid'";
	}
    }
	
}

if(!$_GET['ftoSort'])
{
$sqlData .= " AND ".$permStr." ORDER BY contact.id DESC LIMIT 50";
//$sql .= " AND ".$permStr." ORDER BY ".$sortby." ".$order." LIMIT 100";
}
else
{
$sqlData .= " AND ".$permStr." ".$sortstr;
}


if($_GET['future'])
{
$future = $_GET['future'];
$saveSql = str_ireplace("'","\'",$sqlData);
$future = str_ireplace("'","\'",$future); 
mysql_query("INSERT INTO `customview` (`name`, `sql`,`type`, `eid`, `createdate`, `id`) VALUES ('$future', '$saveSql','c', '$loggeduserid', '$datetime', '')",$con) or die(mysql_error());
}
}

$getdata=mysql_query($sqlData,$con) or die(mysql_error());
$countThis = mysql_num_rows($getdata);
$tempsql = str_ireplace('LIMIT 50','',$sqlData);
$getCount = mysql_query($tempsql,$con) or die(mysql_error());
$countTotal = mysql_num_rows($getCount);


$toecho  = "status='+document.getElementById('cstview1').value+'&source='+document.getElementById('cstview2').value+'&response='+document.getElementById('cstview3').value+'&owner='+document.getElementById('cstview4').value+'&fromdate='+document.getElementById('cstview5').value+'&todate='+document.getElementById('cstview6').value+'&type='+document.getElementById('cstview7').value+'&product='+document.getElementById('cstview8').value+'&read='+document.getElementById('cstview9').value+'"

?>


<table id="viewtable" style="text-align:center;" cellpadding="0" cellspacing="0" class="fetch" width="100%">
<tr>
	<tr>
	<th style="height:20px;width:3%">
	<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
	
	<th style="height:20px;width:3%">
	<img src="images/cold.png" alt="" style="height:12px"/>
	</th>
	
	
	<th style="height:20px;cursor:pointer;width:8%" onclick="getModule('clients/viewActive?sort=true&ftoSort=id&sortby=<?php if($ftoSort == 'id'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Clients')">
	Client Num. &nbsp;<?php if($ftoSort == 'id'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>&nbsp;
	</th>

    <th style="height:20px;width:6.5%">Client Code</th>
	
    <th style="height:20px;cursor:pointer;width:10%" onclick="getModule('clients/viewActive?sort=true&ftoSort=fname&sortby=<?php if($ftoSort == 'fname'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Clients')">
	Client Name &nbsp;<?php if($ftoSort == 'fname'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>&nbsp;
	</th>
	
		
	<th style="height:20px;width:10%">Brokerage Plan</th>
    <th style="height:20px;cursor:pointer;width:7%" onclick="getModule('clients/viewActive?sort=true&ftoSort=ConversionDate&sortby=<?php if($ftoSort == 'ConversionDate'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Clients')">
	Conversion Date &nbsp;
	<?php if($ftoSort == 'ConversionDate'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>
	</th>


	<th style="height:20px;cursor:pointer;width:7%" onclick="getModule('clients/viewActive?sort=true&ftoSort=callbackdate&sortby=<?php if($ftoSort == 'callbackdate'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Clients')">
	FTD &nbsp;
	<?php if($ftoSort == 'callbackdate'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>
	</th>


	<th style="height:20px;cursor:pointer;width:7%" onclick="getModule('clients/viewActive?sort=true&ftoSort=modifieddate&sortby=<?php if($ftoSort == 'modifieddate'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Clients')">
	LTD &nbsp;
	<?php if($ftoSort == 'modifieddate'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>
	</th>

	<th style="width:3%;">Ledger Balance</th>
 	
</tr>

<?php
$i=0;
while($row = mysql_fetch_array($getdata))
{
?>

	    <tr <?php if($row['id'] == '0') echo "style='font-weight:bold'"; ?>id="fetchRow<?php echo $i;?>" <?php if($row['modifieddate']==$date) {?>   class="modified" <?php } else if($row['modifieddate']=='0000-00-00'){ ?>   style="background:#ffffe0;"       <?php    } else if($row['modifieddate']!=$date && $row['modifieddate']!='0000-00-00') {  ?>>
	
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
		
		<?php 
        $brokerageplan = ($row['brokerageplan']==1) ? 'Regular Plan' : 'Premium Plan';
		$ftd = ($row['FTD']!='0000-00-00') ? date("d-M-Y", strtotime($row['FTD'])) : 'NA';
		$ltd = ($row['LTD']!='0000-00-00') ? date("d-M-Y", strtotime($row['LTD'])) : 'NA';
		?>


		<td><?php echo $brokerageplan; ?></td>
        <td><?php echo date("d-M-Y", strtotime($row['conversiondate']));?></td><!-- Approval Date -->
	    <td><?php echo $ftd;?></td><!-- Modified Date Date -->
	    <td><?php echo $ltd?></td><!-- Modified Date Date -->
	    <td><?php echo $row['ledger_balance'];?></td><!-- Modified Date Date -->
        </tr>
	    <?php
	
$i++;
$Maxid = $row[8];
$MaxI = $i;
$list .= $row[8].",";

}
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
<input name="Text1" type="text" value="<?php echo $sqlData;?>" id="tlview" style="display:none" />
<input name="Text1" type="text" value="<?php echo $list;?>" id="idList" style="display:none" />
<input name="Text1" type="text" value="1" id="uptoFetch" style="display:none" />

	<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
		<span id="moreButton">
	<div onclick="moreData('clients/fetchmore?sql='+document.getElementById('tlview').value+'&upto='+document.getElementById('uptoFetch').value,'moreData','');" style="cursor: pointer;padding-top:5px;" id="fetchingDone">
	<img alt="" src="images/more.png" style="vertical-align: middle; width: 6px;" /> 
	More <span id="fetching" style="display: none">Fetching..</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Showing <span id="getCount"><?php echo $countThis;?></span> of <span id="getTotal"><?php echo $countTotal;?></span></div></span></div></span>
</div>

<br/><br/><br/><br/><br/><br/><br/>


