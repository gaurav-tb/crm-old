<?php
include("../include/conFig.php");
$term = $_GET['term'];
//echo "SELECT employee.name, contact.fname, contact.mobile, contact.callbackdate, contact.id, leadresponse.name, contact.modifieddate,contact.mark FROM contact,employee,leadresponse WHERE contact.ownerid = employee.id AND contact.delete = '0' AND contact.converted= '0' AND contact.latestresponse = leadresponse.id  AND (contact.mobile LIKE '%$term%' OR contact.phone LIKE '%$term%' OR contact.fname LIKE '%$term%' OR contact.lname LIKE '%$term%' OR contact.email LIKE '%$term%' OR contact.website LIKE '%$term%' OR contact.description LIKE '%$term%' OR contact.address LIKE '%$term%') ORDER BY contact.id DESC";
$getData = mysql_query("SELECT employee.name, contact.fname, contact.mobile, contact.callbackdate, contact.id, leadresponse.name, contact.modifieddate,contact.mark,leadsource.name,contact.ownerid FROM contact,employee,leadresponse,leadsource WHERE leadsource.id=contact.leadsource AND contact.ownerid = employee.id AND contact.delete = '0' AND contact.converted= '0' AND contact.latestresponse = leadresponse.id  AND (contact.mobile LIKE '%$term%' OR contact.alternateMobile LIKE '%$term%' OR contact.phone LIKE '%$term%' OR contact.fname LIKE '%$term%' OR contact.lname LIKE '%$term%' OR contact.email LIKE '%$term%' OR contact.website LIKE '%$term%' OR contact.description LIKE '%$term%' OR contact.address LIKE '%$term%' OR contact.code LIKE '%$term%' OR contact.id LIKE '%$term%') ORDER BY contact.id DESC",$con) or die(mysql_error());
$num = mysql_num_rows($getData);
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
			<td align="left" style="width: 30%"><?php echo $num;?>
records found in Leads for <em><?php echo $term;?></em>
	
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
		<th style="height: 20px" >
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
		<th>Lead Number</th>
    	<th>Owner </th>
	    <th>Name</th>
		<th>Click to Call</th>
	    <th>Modified Date</th>
    	<th>Response</th>
	    <th>Source</th>
	    <th>Callback</th>
        <th>Description</th>
	    <th>Story</th>
        </tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	  <tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row[6]));?>">
		<td style="width:15px;">
		<?php if($row[7] == '1') { ?> <img src="images/hot-lead.png" style="height:16px" alt=""/> <?php } else {?> <img src="images/cold-lead.png" style="height:16px" alt=""/>  <?php } ?>
		</td>
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[4];?>" /></td>
		
		<td><?php echo $row[4];?></td>
		
		<td><?php echo $row[0];?></td>
		<td class="blueSimpletext" onclick="getModule('leads/edit?id=<?php echo $row[4];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','1')">
		<span><?php if($row[1] == '') echo "Not Available"; else echo $row[1];?></span>
		</td>
		
	    <td><a Onclick="getModule('noteline/index?cid=<?php echo $row[4];?>&name=<?php echo $row[1];?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo $row[1];?>');document.getElementById('ModalCloseButton').style.display = 'none';" class="blueSimpletext clickto"  href="callto:<?php echo $row[2]; ?>">Click to call</a></td>

		<td><?php echo date("d-m-y h:i A",strtotime($row[13])) ?></td>
		
		<td><?php echo $row[5] ; ?></td>
		
		<td><?php echo $row[8]; ?></td>
		
		<td>
		
		<?php
		if($row[3] != '0000-00-00 00:00:00')
		{
		$cb =date("d-m-y h:i A",strtotime($row[3]));
		echo str_ireplace("12:00 AM", '',$cb);
		}
		else
		{
		echo "--";
		}
		?>
		</td>
        <td  onclick="getModule('noteline/index?cid=<?php echo $row[4];?>&name=<?php echo $row[1];?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo $row[0];?>')">
		<?php $tempDesc  = $row[10];
		$tempDesc = explode("\r\n",$tempDesc);
//		$tempDesc = array_reverse($tempDesc);
		echo substr($tempDesc[0],0,50);
		echo "..";
		?>
		</td>
						
		<td>
		<img onclick="getModule('noteline/index?cid=<?php echo $row[4];?>&name=<?php echo $row[1];?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo $row[0];?>');document.getElementById('ModalCloseButton').style.display = 'none';" src="images/story.png" style="width:15px" title="Story For <?php echo $row[0];?>" alt=""/>
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
$getData = mysql_query("SELECT employee.name, contact.fname, contact.mobile, contact.callbackdate, leadresponse.name, contact.id FROM contact,employee,leadresponse,customersupport WHERE contact.ownerid = employee.id AND contact.latestresponse = leadresponse.id AND `contact`.`id`=`customersupport`.`clientid` AND contact.delete = '0' AND contact.converted = '1' AND (contact.mobile LIKE '%$term%' OR contact.phone LIKE '%$term%' OR contact.fname LIKE '%$term%' OR contact.lname LIKE '%$term%' OR contact.email LIKE '%$term%' OR contact.website LIKE '%$term%' OR contact.description LIKE '%$term%' OR contact.address LIKE '%$term%' OR contact.code LIKE '%$term%' OR `contact`.`alternateMobile` LIKE '%$term%' OR `customersupport`.`AlternativeMobile` LIKE '%$term%') ORDER BY contact.id DESC",$con) or die(mysql_error());
$num = mysql_num_rows($getData);
?>
<input name="Button1" class="buttonGreen" type="button" value="Search Results In Clients (<?php echo $num;?>) >>" onclick="getModule('search/client-result?term='+document.getElementById('mainSearch').value,'viewContent','manipulateContent','Search Results')" />
</div>
	<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</div>

<br/>
<br/>

