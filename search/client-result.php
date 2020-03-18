<?php
include("../include/conFig.php");
$term = $_GET['term'];



$getData = mysql_query("SELECT contact.mark,customersupport.tradingbellsid,contact.fname,customersupport.callbackdate,teamamtes.mateid,contact.conversiondate,levelsupport.name as levelname,customersupport.description,customersupport.allotmentid,contact.id,customersupport.level,employee.name,customersupport.modifieddate,customersupport.ClosingDate,contact.mobile,contact.lname,customersupport.tradingbellsid FROM  
 customersupport INNER JOIN contact ON customersupport.clientid=contact.id
 INNER JOIN teamamtes ON customersupport.allotmentid=teamamtes.mateid
 INNER JOIN employee ON customersupport.RMOwnerid=employee.id
 INNER JOIN levelsupport ON customersupport.level=levelsupport.id WHERE `contact`.`converted`='1' AND `contact`.`delete`='0' AND (contact.mobile LIKE '%$term%' OR contact.phone LIKE '%$term%' OR contact.fname LIKE '%$term%' OR contact.lname LIKE '%$term%' OR contact.email LIKE '%$term%' OR contact.website LIKE '%$term%' OR contact.description LIKE '%$term%' OR contact.address LIKE '%$term%' OR contact.code LIKE '%$term%' OR contact.id LIKE '%$term%' OR customersupport.AlternativeMobile LIKE '%$term%' ) ORDER BY contact.id DESC",$con) or die(mysql_error());
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
	<th></th>
	    <th>
		<input id="mainChkDown" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
		<th>Client Number</th>
		<th>RM/SRM</th>
		<th>Client Name</th>
		<th>Client Code</th>
		<th>Click to Call</th>
		<th>Level</th>
		<th>Approval Date</th>
		<th>Closing Date</th>
        <th>Description</th>
      	<th>CallBack Date</th>
	    <th>ModifiedDate</th>
        <th>Revenue</th>
        <th>Status</th>
		<th>Support Owner</th>
		<th>Level Details</th>
		
	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	
	   <tr <?php if($row[9] == '0') echo "style='font-weight:bold'"; ?>id="fetchRow<?php echo $i;?>"   class="d<?php echo $i%2;?>"   >
	   
             
	    <td>
		<?php if($row[0] == '1') { ?> <img src="images/hot-lead.png" style="height:16px" alt=""/> <?php } else {?> <img src="images/cold-lead.png" style="height:16px" alt=""/>  <?php } ?>
		</td>
		 
			 
			 
	<td>
    <input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[9];?>" /></td>
	
	<td><?php echo $row[9]; ?> </td>
	
	<td><?php echo $row[11] ?></td>
		
	<td onclick="getModule('clients/edit?id=<?php echo $row[9] ;?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo str_ireplace('"','',$row[2]);?>')" onmousedown="mouseDown(event,'<?php echo $finalUrl;?>')" class="blueSimpletext">
	<?php echo $row[2] ." ".$row[15];?>
	</td>
	
	<td><?php echo $row[16] ?></td>
	
	<td><a Onclick="getModule('noteline/index?cid=<?php echo $row[9];?>&name=<?php echo $row[2];?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo $row[2];?>');document.getElementById('ModalCloseButton').style.display = 'none';" class="blueSimpletext clickto"  href="callto:<?php echo $row[14]; ?>">Click to call</a></td>

	<td><?php echo $row[6] ?></td><!-- Client Code -->
	
    <td><?php echo date("d,M,Y", strtotime($row[5]));?></td><!-- Approval Date -->
	
	<td><?php echo date("d,M,Y", strtotime($row[13]));?></td><!-- Closing Date -->
	
	<td><?php echo substr($row[7],0,20);?>..</td><!-- Description -->
		
	<td><?php echo date("d,M,Y", strtotime($row[3]));?></td><!-- Callbackdate Date -->
	
	
	<td><?php echo date("d,M,Y", strtotime($row[12]));?></td><!-- ModifiedDate Date -->
	
		
		
		
		<?php 
		$code=$row[16];
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
		<td><?php echo $revenue; ?></td><!-- revenue Generation -->
		
		
		<?php 
		$rowCount=mysql_num_rows($res); 
		if($rowCount>0)
		{
		?>
	   <td><img src="images/right.png" style="width:15px" alt=""/></td>
		<?php }
		if($rowCount==0)
		{
        $currentDate = strtotime($UpdateFrom);
        $futureDate = $currentDate-(2678400);
        $prevDate= date("Y-m-d H:i:s", $futureDate); 
  	
		$sql="SELECT * FROM `expensereport` WHERE `UploadingDate` BETWEEN '$prevDate' AND '$UpdateFrom' AND `Clientid`='$row[16]' GROUP BY Clientid";
		$rowPrev=mysql_num_rows($res);
 		
		if($rowPrev>0 )
		{  ?>
	      <td ><img src="images/exclame.png" style="width:15px" alt=""/></td>
		<?php   }
		if($rowPrev==0 )
		{
        $sql="SELECT * FROM `expensereport` WHERE `Clientid`='$row[16]' GROUP BY Clientid";
		$rowAll=mysql_num_rows($res);
		if($rowAll==0)
		{  ?>
		<td ><img src="images/delete.png" style="width:15px" alt=""/></td>
		<?php   }
 		}
		}
		
		$sql="SELECT `name` FROM `employee` WHERE `id`='$row[4]'";
		$res=mysql_query($sql,$con);
		$rowName=mysql_fetch_array($res);
		?>
		
		<td ><?php echo $rowName[0] ?></td>
		
		
	   <td>
	   <img onclick="SupportLevel('<?php echo $row[9] ;?>')"  src="images/story.png" style="width:15px" title="Story For <?php echo $row[9];?>" alt=""/>
	   </td>
       </tr>
	
	
	
	<?php
$i++;
$Maxid = $row[9];
$MaxI = $i;
}
?>
</table>
<br/>
<br/>
</div>





