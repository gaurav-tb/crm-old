<?php
include("../include/conFig.php");
$term = $_GET['term'];
$sql = $_GET['sql'];
$sql = str_ireplace("\\","",$sql);
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
		<input id="mainChkDown" name="Checkbox1" onclick="chkAll('chBxDown','mainChkDown')" type="checkbox" /></th>
		<th style="height: 20px" >Lead Owner</th>
		<th style="height: 20px" >Name</th>
		<th style="height: 20px" >Mobile</th>
		<th style="height: 20px" >Call Back Date</th>
		<th style="height: 20px">Latest Response</th>

	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getdata))
{
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row[6]));?>">
		<td style="width: 20px;">
		<input id="chBxDown<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[5];?>" /></td>
		<td style="width: 300px;">
		<?php echo $row[0];?></td>
		<td style="height: 20px" class="blueSimpletext" onclick="getModule('clients/edit?id=<?php echo $row[4];?>&amp;i=<?php echo $i;?>&storyfromsearch=1','manipulateContent','viewContent','<?php echo $row[1];?>')">
		<?php if($row[1] == '') echo "Not Available"; else echo $row[1];?>

		</td>
		<td style="height: 20px">
		<?php echo $row[2];?>
		</td>
				<td style="height: 20px">
		<?php echo $row[3];?>
		</td>
		<td style="height: 20px"><?php echo $row[5];?></td>	
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





