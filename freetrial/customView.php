<?php
include("../include/conFig.php");
$ftdate = $_GET['ftdate'];
$ftfulldate = $ftdate." 00:00:00";
$ftenddate = $ftdate." 23:59:59";
$ftoption = $_GET['ftoption'];
$sql = "SELECT employee.name, contact.fname, contact.lname, contact.mobile, product.name, servicecall.fromdate, servicecall.todate, contact.id,servicecall.id,category.id FROM employee,contact,servicecall,product,category WHERE product.category = category.id AND contact.ownerid = employee.id AND product.id = servicecall.product and servicecall.cid = contact.id AND servicecall.approved = '0' AND servicecall.type = 'f'";

if($ftoption == 'ftr')
{
$sql .= " AND servicecall.createdate BETWEEN '$ftfulldate' AND '$ftenddate'";
}
if($ftoption == 'ftsd')
{
$sql .= " AND servicecall.fromdate = '$ftdate'";
}
if($ftoption == 'fted')
{
$sql .= " AND servicecall.todate = '$ftdate'";
}

$sql .= " ORDER BY servicecall.createdate DESC";
$getData = mysql_query($sql,$con) or die(mysql_error());
?>

<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th style="height: 20px">
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
		<th style="height: 20px">nth</th>
		<th style="height: 20px">Lead Owner</th>
		<th style="height: 20px">Name</th>
		<th style="height: 20px">Mobile</th>
		<th style="height: 20px">Product</th>
		<th style="height: 20px">Start Date</th>
		<th style="height: 20px">End Date</th>
		
	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
$getCount = mysql_query("SELECT COUNT(`id`) FROM `servicecall` WHERE `product` = '$row[9]' AND `cid` = '$row[7]' AND `type` = 'f'",$con) or die(mysql_error());
$rowcount = mysql_fetch_array($getCount);

?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row[6]));?>">
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[8];?>" /></td>
		<td>
		<span class="blueSimple" style="color:#fff;font-weight:bold;font-size:10px;padding:3px;;font-weight:normal;border-radius:20px;">
		&nbsp;<?php echo $rowcount[0];?>&nbsp;</span>
		</td>
		<td  onclick="getModule('freetrial/clientDetails?id=<?php echo $row[7];?>&amp;i=<?php echo $i;?>&amp;name=<?php echo $row['fname'];?>','manipulatemoodleContent','viewmoodleContent','1')" style="width: 300px;">
		<?php echo $row[0];?></td>
		<td >
		<?php echo $row[1]." ".$row[2];?>
		</td>
		<td>
		<?php echo $row[3];?>
		</td>
		<td>
		<?php echo $row[4];?>
		</td>
		<td><?php echo $row[5];?>
		</td>
		<td><?php echo $row[6];?>
		</td>	
		
	
	</tr>
	<?php
$i++;
$Maxid = $row[8];
$MaxI = $i;
}
?>
</table>
<div id="moreData">
</div>
<div class="moduleFoot">
	<div style="float: right;">
		&nbsp;</div>
	<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
