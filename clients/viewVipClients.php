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
}
else
{
while($rowSer = mysql_fetch_array($getSer))
{
$service[$rowSer[0]] =  $rowSer[1];
}
}

if($_GET['sort'])
{
$sortby = $_GET['sortby'];
}



$sqlData="SELECT `contact`.`id`,`contact`.`fname`,  `contact`.`lname`, `contact`.`code` ,`contact`.`mark` ,  `contact`.`conversionrequestdate`,reduced_brokerage.`activationAmount`,reduced_brokerage.`BonusAmount`,reduced_brokerage.`reversal_amt`,reduced_brokerage.`expired_amt`,reduced_brokerage.`remaining_amt` FROM `contact` INNER JOIN  `customersupport` ON  `contact`.`id` = `customersupport`.`clientid` INNER JOIN reduced_brokerage ON contact.id=reduced_brokerage.cid LIMIT 50";  



$countThis=mysql_num_rows($getData);

$tempsql = str_ireplace('LIMIT 50','',$sqlData);
$getCount = mysql_query($tempsql,$con) or die(mysql_error());
$countTotal = mysql_num_rows($getCount);


?>
<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
	<td align="left" style="width: 30%">RM Clients</td>
	<td align="right" style="width: 70%">
    <?php if(in_array('CV_clients',$thisPer)){ ?>
	 <div class="buttonGreen" style="display:inline-block;text-shadow:0px 0px 0px white" onclick="$('#custViewBox').slideToggle('fast')"  >Custom View&nbsp;<img src="images/more.png" alt=""/></div> 
	<?php }?>
	<!--<input id="" class="buttonnegetive" name="Button1" onclick="deleteData('leads','Leads')" type="button" value="Delete Selected" /> -->
	</td>
	</tr>
	</table>
	</div>

    <div style="background:#eee;padding:5px;" id="custViewBox">
	<table width="100%" cellpadding="5" cellspacing="0">

<tr>
	<td>
	<table>	
	<tr>
	<td>	
	<b>Select Brokerage Plan</b>	&nbsp;&nbsp;
	<select class="input" name="brokerage_plan" style="width: 207px;" id="cstview1">
	<option value="">Brokerage Plan</option>			
    <option value="2">Discount Plan</option>			
    <option value="3">Premium Plan</option>			
    </select>
   </td>
   <td>
   <b>Select Leadresponse</b>	&nbsp;&nbsp;
   <select class="input" name="leadresponse" style="width: 207px" id="cstview2">

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
</td>
</tr>
<tr>
<td>
<b>Conversion Date</b>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!--  onclick="SetCalender(this,'cstview4');"
 -->
<input id="cstview3" name="fromdate_conversion" class="inputCalender" placeholder="From Date" onclick="openCalendar(this);" readonly="readonly" type="text">&nbsp;&nbsp;
<input id="cstview4" name="todate_conversion" class="inputCalender" placeholder="To Date" onclick="openCalendar(this);" readonly="readonly" type="text"> 
</td>
<td>
<b>Funds Payment Date</b>	&nbsp;&nbsp;
<input id="cstview5" name="fromdate_fund_payment" class="inputCalender" placeholder="From Date" onchange="SetCalender(this,'cstview6');" onclick="openCalendar(this);" readonly="readonly" type="text">&nbsp;&nbsp;
<input id="cstview6" name="todate_fund_payment" class="inputCalender" placeholder="To Date" onclick="openCalendar(this);" readonly="readonly" type="text"> 
</td>
</tr>
<tr>
<td>
<b>First Trade Date  </b>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input id="cstview7" name="fromdate_ftd" class="inputCalender" placeholder="From Date" onchange="SetCalender(this,'cstview8');" onclick="openCalendar(this);" readonly="readonly" type="text">&nbsp;&nbsp;
<input id="cstview8" name="todate_ftd" class="inputCalender" placeholder="To Date" onclick="openCalendar(this);" readonly="readonly" type="text"> 
</td>
<td>
<b>Traded Date</b>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input id="cstview9" name="fromdate_td" class="inputCalender" placeholder="From Date" onchange="SetCalender(this,'cstview10');" onclick="openCalendar(this);" readonly="readonly" type="text">&nbsp;&nbsp;
<input id="cstview10" name="todate_td" class="inputCalender" placeholder="To Date" onclick="openCalendar(this);" readonly="readonly" type="text"> 
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td>


<input name="Button1" class="buttonBlue" type="button" value="Create View For Now" onclick="getModule('clients/customViewRm?brokerage_plan='+document.getElementById('cstview1').value+'&leadresponse='+document.getElementById('cstview2').value+'&fromdate_conversion='+document.getElementById('cstview3').value+'&todate_conversion='+document.getElementById('cstview4').value+'&fromdate_fund_payment='+document.getElementById('cstview5').value+'&todate_fund_payment='+document.getElementById('cstview6').value+'&fromdate_ftd='+document.getElementById('cstview7').value+'&todate_ftd='+document.getElementById('cstview8').value+'&fromdate_td='+document.getElementById('cstview9').value+'&todate_td='+document.getElementById('cstview10').value,'directResult','','Clients');$('#custViewBox').slideToggle('fast')" />&nbsp;&nbsp;<!-- Or -->&nbsp;&nbsp; <!--<input id="viewName" placeholder="Save This View For Future Use" class="input" name="Text1" type="text" style="width: 187px" /> <div style="display:inline-block" class="buttonGreen rightRound" onclick="getModule('clients/customView?brokerage_plan='+document.getElementById('cstview1').value+'&response='+document.getElementById('cstview2').value+'&response='+document.getElementById('cstview3').value+'&owner='+document.getElementById('cstview4').value+'&fromdate='+document.getElementById('cstview5').value+'&todate='+document.getElementById('cstview6').value+'&type='+document.getElementById('cstview7').value+'&product='+document.getElementById('cstview8').value+'&fromdate_td='+document.getElementById('cstview9').value+'&level='+document.getElementById('cstview11').value+'&todate_td='+document.getElementById('cstview10').value+'&future='+document.getElementById('viewName').value,'directResult','','Clients');$('#custViewBox').slideToggle('fast')">Save It!</div> -->
</td>
</tr>

</table>
</div>


	
<div id="directResult" style="height:600px;overflow:scroll">
<table id="viewtable" style="text-align:center;" cellpadding="0" cellspacing="0" class="fetch" width="100%">
   
	<tr>
	<th><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
	<th><img src="images/cold.png" alt=""/></th>
	<th>Client Name</th>
    <th>Client Code</th>
    <th>Conversion Date</th>
    <th>Activation Amount</th>
    <th>Bonus Amount</th>
    <th>Remaining Amount</th>
    <th>Reversal Amount</th>
    <th>Expired Amount</th>
    </tr>
	

    <?php
    $i=0;
    while($row=mysql_fetch_array($getData))
    {
    ?>
		
	   <tr <?php if($row['id'] == '0') echo "style='font-weight:bold'"; ?> id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" <?php if($row['modifieddate']==$date) {?>   class="modified" <?php } else if($row['modifieddate']=='0000-00-00'){ ?>   style="background:#ffffe0;"       <?php    } else if($row['modifieddate']!=$date && $row['modifieddate']!='0000-00-00') {  ?>  class="level<?php echo $row['level'] ?>" <?php } ?>   title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row['description']));?>">
		<td>		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
        
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
		<td><?php echo $row['code'] ?></td>
        <td><?php echo date('d-m-Y',strtotime('conversionrequestdate')); ?></td>
        <td><?php echo number_format($row['activationAmount'], 0, ".", ","); ?></td>
        <td><?php echo number_format($row['BonusAmount'], 0, ".", ","); ?></td>
        <td><?php echo number_format($row['remaining_amt'], 0, ".", ","); ?></td>
		<td><?php echo number_format($row['reversal_amt'], 0, ".", ","); ?></td>
        <td><?php echo number_format($row['expired_amt'], 0, ".", ","); ?></td>

</tr>
<?php
$i++;
$Maxid = $row['id'];
$MaxI = $i;
$list .= $row['id'].",";
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

<?php // echo $sqlData;?>
<input name="Text1" type="text" value="<?php echo $sqlData;?>" id="tlview" style="display:none" />
<input name="Text1" type="text" value="<?php echo $list;?>" id="idList" style="display:none" />
<input name="Text1" type="text" value="1" id="uptoFetch" style="display:none" />

<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
<span id="moreButton">
<div style="cursor:pointer;" onclick="moreData('clients/RmFetchMore?sql='+document.getElementById('tlview').value+'&upto='+document.getElementById('uptoFetch').value,'moreData','');" id="fetchingDone">
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
