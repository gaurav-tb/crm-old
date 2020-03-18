<?php
include("../include/conFig.php");
$term = $_GET['term'];
$fromdate=$_GET['fromdate'];
$todate=$_GET['todate'];
$fdate = $fromdate." 00:00:00";
$tdate = $todate." 23:59:59";
$type=$_GET['type'];
$leadstatus=$_GET['status'];
$leadsource=$_GET['source'];
$leadresponse=$_GET['response'];
$leadowner=$_GET['owner'];
$mark = $_GET['mark'];
if(in_array('VA_leads',$thisPer) || in_array('VA_tLeads',$thisPer))
{
$permStr = "(1=1)";
}
else
{
$permStr = "(contact.ownerid = '$loggeduserid')";
}
$sql = "SELECT employee.name, contact.fname, contact.mobile, contact.callbackdate, contact.id, leadresponse.name, contact.modifieddate,contact.mark FROM contact,employee,leadresponse WHERE contact.ownerid = employee.id AND contact.delete = '0' AND contact.converted= '0' AND contact.latestresponse = leadresponse.id";
//$sql= "select employee.name,contact.fname,contact.lname,contact.mobile,contact.callbackdate,contact.id,leadresponse.name,contact.modifieddate,contact.mark from leadresponse,contact,leadstatus,leadsource,employee where contact.delete ='0' AND contact.converted ='0' and contact.ownerid = employee.id and leadresponse.id = contact.latestresponse and leadstatus.id= contact.leadstatus and leadsource.id = contact.leadsource";
	
	if($mark == 'HL')
	{
	$sql .= " AND contact.mark = '1'";
	}
	if($mark == 'CL')
	{
	$sql .= " AND contact.mark = '0'";
	}

if($fromdate != '' || $todate != '' )
{
	if($type == 'Cl')
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

}
if($leadstatus != "")
{
$sql .= " and contact.leadstatus = '$leadstatus'";
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


$sql .= " AND ".$permStr." AND (contact.mobile LIKE '%$term%' OR contact.phone LIKE '%$term%' OR contact.fname LIKE '%$term%' OR contact.lname LIKE '%$term%' OR contact.email LIKE '%$term%' OR contact.website LIKE '%$term%' OR contact.description LIKE '%$term%' OR contact.address LIKE '%$term%') ORDER BY contact.id DESC LIMIT 100";
$getdata=mysql_query($sql,$con) or die(mysql_error());
$num = mysql_num_rows($getdata);

?>


<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Search Results
	
			</td>
			<td align="right" style="width: 70%"> 
	
			</td>
		</tr>
	</table>

	
</div>
<br/>

<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%"><?php echo $num;?> records found in Leads for <em><?php echo $term;?></em>
	
			</td>
			<td align="right" style="width: 70%"> 
		<?php if(in_array('CO_leads',$thisPer) || in_array('D_leads',$thisPer)){ ?>
		With Selected&nbsp;
					<select  class="input" name="Select1" id="action" style="width: 260px;">
				 <?php if(in_array('CO_leads',$thisPer)){?><option value="sl">Change Owner</option><?php } ?>
				<?php if(in_array('D_leads',$thisPer)){ ?><option value="contact:Leads">Delete</option><?php }?>
			</select><?php } 
						if(in_array('CO_leads',$thisPer) || in_array('D_leads',$thisPer)){ ?><div class="buttonGreen" style="width: 20px;display:inline-block;padding:5px;" onclick="takeAction(document.getElementById('action').value)">Go</div>
			<?php } ?>				
			<!--<input id="" class="buttonnegetive" name="Button1" onclick="deleteData('leads','Leads')" type="button" value="Delete Selected" /> -->
			</td>
		</tr>
	</table>

	
</div>


<div id="directResult" style="height:400px;overflow:auto">
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th></th>
		<th style="" >
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
		<th style="" >Lead Owner</th>
		<th style="" >Name</th>
		<th style="" >Mobile</th>
		<th style="" >Call Back Date</th>
		<th style="">Latest Response</th>

	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getdata))
{
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row[6]));?>">
		<td style="width:15px;">
		<?php if($row[7] == '1') { ?> <img src="images/hot-lead.png" style="height:16px" alt=""/> <?php } else {?> <img src="images/cold-lead.png" style="height:16px" alt=""/>  <?php } ?>
		</td>
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[4];?>" /></td>
		<td  style="width: 300px;">
		<?php echo $row[0];?></td>
		<td class="blueSimpletext"  onclick="getModule('leads/edit?id=<?php echo $row[4];?>&amp;i=<?php echo $i;?>&storyfromsearch=1','manipulateContent','viewContent','<?php echo $row[1];?>')">
<?php if($row[1] == '') echo "Not Available"; else echo $row[1];?>
		</td>
		<td>
		<?php echo $row[2];?>
		</td>
				<td>
		<?php echo $row[3];?>
		</td>
			<td>
		<?php echo $row[5];?>
		</td>
	</tr>
	<?php
$i++;
$Maxid = $row[4];
$MaxI = $i;
}
?>
</table>
<br/>
<br/>
<div style="float:right">
<?php

$sql = str_ireplace(" AND contact.converted= '0' AND "," AND contact.converted= '1' AND ",$sql);
if(in_array('VA_clients',$thisPer))
{
$getdata=mysql_query($sql,$con) or die(mysql_error());
}
else
{
$getdata=mysql_query($sql,$con) or die(mysql_error());
}

$num = mysql_num_rows($getdata);
?>
<textarea name="TextArea1" cols="20" rows="2" id="sql" style="display:none"><?php echo $sql;?></textarea>
<input name="Button1" class="buttonGreen" type="button" value="Search Results In Clients (<?php echo $num;?>) >>" <?php if($num != 0) {?>onclick="getModule('search/cadvancedresult?sql='+document.getElementById('sql').value+'&term=<?php echo $term;?>','viewContent','manipulateContent','Search Results')" <?php } ?> />
</div>
	<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</div>

<br/>
<br/>
