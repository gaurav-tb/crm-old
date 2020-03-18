<?php
include("../include/conFig.php");
$getData = mysql_query("SELECT employee.name, contact.fname, contact.lname, contact.mobile, product.name, servicecall.fromdate, servicecall.todate, contact.id,servicecall.id,category.name FROM employee,contact,servicecall,product,category WHERE product.category = category.id AND contact.ownerid = employee.id AND product.id = servicecall.product and servicecall.cid = contact.id AND servicecall.approved = '0' AND servicecall.type = 'f' ORDER BY servicecall.createdate DESC",$con) or die(mysql_error());
?>
<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Asked Records For Free Trial</td>
			<td align="right" style="width: 70%">
			&nbsp;&nbsp;
			&nbsp;
			<input id="ftdate" name="ftdate" class="inputCalender" placeholder="Select Date" onclick="openCalendar(this);" readonly="readonly" type="text">
			&nbsp;&nbsp;
			<select name="Select1" class="input" id="ftoption">
				<option value="ftr">Free Trial Request Date</option>
				<option value="ftsd">Free Trial Start Date</option>
				<option value="fted">Free Trial End Date</option>
			</select>
			<div class="buttonGreen" style="width: 20px;display:inline-block;padding:5px;" onclick="getModule('freetrial/customView?ftdate='+document.getElementById('ftdate').value+'&ftoption='+document.getElementById('ftoption').value,'directResult','','Free Trial')">Go</div>
			&nbsp;&nbsp;&nbsp;
			<input id="" class="buttonGreen" name="Button1" onclick="approveData('servicecall','For Free Trial','1')" type="button" value="Approve Selected" />
			<input id="" class="buttonnegetive" name="Button1" onclick="approveData('servicecall','For Free Trial','2')" type="button" value="Deny Selected" />
			</td>
		</tr>
	</table>
</div>
<div id="directResult" class="form">
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th style="height: 20px">
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
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
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row[6]));?>">
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[8];?>" /></td>
		<td  style="width: 300px;">
		<?php echo $row[0];?></td>
		<td  onclick="getModule('freetrial/clientDetails?id=<?php echo $row[7];?>&amp;i=<?php echo $i;?>&amp;name=<?php echo $row['fname'];?>','manipulatemoodleContent','viewmoodleContent','Free Trial Requested')" class="blueSimpletext">
		<?php echo $row[1]." ".$row[2];?>
		</td>
		<td>
		<?php echo $row[3];?>
		</td>
		<td>
		<?php echo $row[9];?>
		</td>
		<td><?php echo date("d M,y",strtotime($row[5]));?>
		</td>
		<td><?php echo date("d M,y",strtotime($row[6]));?>
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
</div>
