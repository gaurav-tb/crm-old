<?php
include("../include/conFig.php");
$getData = mysql_query("SELECT contact.converted,contact.conversiondate,contact.mobile,contact.fname,contact.lname,contact.code,`contact`.`inroducer`,`contact`.`pancardnumber`,`contact`.`segment`,`contact`.`personverification`,`contact`.`id`,`invoice`.`id`,`employee`.`id` as empid FROM contact,invoice,employee WHERE contact.ownerid = employee.id AND invoice.cid = contact.id AND invoice.approved = '0'  AND invoice.delete = '0' AND `contact`.`Level1Approval`='1' AND `contact`.`converted`='0'  ORDER BY invoice.id DESC",$con) or die(mysql_error());
?>
<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
	<td align="left" style="width: 30%"> Level 2 Approval</td>
	<td align="right" style="width: 70%">
	</td>
	</tr>
	</table>
</div>
<div id="directResult"  style="height:600px;overflow:auto">
<table id="viewbilltable" cellpadding="0" cellspacing="0" class="fetch" width="100%" style="padding-right:5px">
	    <tr>
		<th style="">Client Code</th>
		<th style="">Client Name</th>
		<th style="">RM EmpId</th>
		<th style="">Date Of Approve</th>
		<th style="">Mobile No</th>
		<th style="">Pan No.</th>
		<th style="">Segments</th>
		<th style="">Owner Name</th>
		<th style="">Inperson Verification</th>
		<th style="">Level 2 Approval</th>
		<th style="">Click To Call</th>
	    </tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
$empid = $row['empid'];
$getRmEmp = mysql_query("SELECT `employee`.`employee_code` from employee inner join customersupport on employee.id=customersupport.RMOwnerid where employee.id='".$empid."'",$con) or die(mysql_error());
$rowEmployeeCode=mysql_fetch_array($getRmEmp);

$segment = array("1"=>"Equity","2"=>"Equity Derivatives","3"=>"Currency Derivatives","4"=>"Commodity Derivatives");

$segmentlist = '';
$lst = explode(",",$row[8]);
foreach($lst as $val) 
{
$val = str_ireplace("-","",$val);
$val = trim($val);
if($val != '') 
{
$segmentlist .= $segment[$val].',';
}
}
$segmentlist = rtrim($segmentlist,",");
				

$getIntroducerName=mysql_query("select `employee`.`name` FROM `employee` INNER JOIN `contact` ON `employee`.`id`=`contact`.`ownerid` WHERE `contact`.`id`='$row[10]'",$con) or die(mysql_error());
$rowIntroducer=mysql_fetch_row($getIntroducerName);
$introducer=$rowIntroducer[0];
?>
	
	    <tr style="" id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php if($row[0] == '0') echo "Unapproved"; else echo "Approved"; ?>">
		<td><?php echo $row[5];?>	</td>
		<td><?php echo $row[3]." ". $row[4];?>	</td>
		<td><?php echo $rowEmployeeCode[0];?>	</td>
		<td><?php echo date('d M,Y', strtotime($row[1])); ?></td>
        <td><?php echo $row[2]?>	</td>
		<td><?php echo $row[7];?>	</td>
		<td><?php echo $segmentlist ;?>	</td>
		<td><?php echo $introducer ;?>	</td>
		<td><?php if($row[9] == 2) 
		{
		echo 'Video';
		}
		else if($row[9] == 3) 
		{
		echo 'KRA Registered';
		} 
		else if($row[9] == 4)
		{
		echo 'Face To Face';	
		}
		?>	
		</td>
		<td>
		<input name="Button1" type="button" value="Click To Approve" class="button" title="Click To Fill Payment" onclick="Level2Approval(<?php echo $row[10] ?>,<?php echo $row[11] ?>);$('#fetchRow<?php echo $i;?>').hide();" />

		
		
<td>
<a class="blueSimpletext clickto" href="callto:<?php echo $row[2]; ?>">Click to call  </a>
</td>
<?php
$i++;
}
?>
</tr>
</table>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<div id="moreData">
</div>
</div>



