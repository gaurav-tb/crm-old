<?php
include("../include/conFig.php");
$term = $_GET['term'];

$getData = mysql_query("SELECT employee.name, contact.fname, contact.mobile, contact.callbackdate, leadresponse.name, contact.id FROM contact,employee,leadresponse WHERE contact.ownerid = employee.id AND contact.latestresponse = leadresponse.id AND contact.delete = '0' AND contact.converted = '1' AND (contact.mobile LIKE '%$term%' OR contact.phone LIKE '%$term%' OR contact.fname LIKE '%$term%' OR contact.lname LIKE '%$term%' OR contact.email LIKE '%$term%' OR contact.website LIKE '%$term%' OR contact.description LIKE '%$term%' OR contact.address LIKE '%$term%') ORDER BY contact.id DESC",$con) or die(mysql_error());

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
			<td align="left" style="width: 30%"><?php echo $num;?> records found in Clients for <em><?php echo $term;?></em>
	
			</td>
			<td align="right" style="width: 70%"> 
		<?php if(in_array('CO_leads',$thisPer) || in_array('D_leads',$thisPer)){ ?>
		With Selected&nbsp;
					<select  class="input" name="Select1" id="action" style="width: 260px;">
				 <?php if(in_array('CO_leads',$thisPer)){?><option value="sc">Change Owner</option><?php } ?>
				<?php if(in_array('D_leads',$thisPer)){ ?><option value="contact:Leads">Delete</option><?php }?>
			</select><?php }
						if(in_array('CO_leads',$thisPer) || in_array('D_leads',$thisPer)){ ?><div class="buttonGreen" style="width: 20px;display:inline-block;padding:5px;" onclick="takeAction(document.getElementById('action').value)">Go</div>
			<?php } ?>	

			</td>
		</tr>
	</table>

	
</div>


<div id="directResult" style="height:200px;overflow:auto">
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th style="height: 20px" >
		<input id="mainChkDown" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
		<th style="height: 20px" >Lead Owner</th>
		<th style="height: 20px" >Name</th>
		<th style="height: 20px" >Mobile</th>
		<th style="height: 20px" >Call Back Date</th>
		<th style="height: 20px">Latest Response</th>

	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row[6]));?>">
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[5];?>" /></td>
		<td style="width: 300px;">
		<?php echo $row[0];?></td>
		<td class="blueSimpletext" style="height: 20px" onclick="getModule('clients/edit?id=<?php echo $row[5];?>&amp;i=<?php echo $i;?>&storyfromsearch=1','manipulateContent','viewContent','<?php echo $row[1];?>')" >
		<span><?php if($row[1] == '') echo "Not Available"; else echo $row[1];?></span>
		
		</td>
		<td style="height: 20px">
		<?php echo $row[2];?>
		</td>
				<td style="height: 20px">
		<?php echo $row[3];?>
		</td>
		<td style="height: 20px"><?php echo $row[4];?></td>	
	</tr>
	<?php
$i++;
$Maxid = $row[5];
$MaxI = $i;
}
?>
</table>
<br/>
<br/>
</div>





