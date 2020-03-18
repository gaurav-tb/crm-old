<?php
include("../include/conFig.php");

$id = $_GET['id'];
$i = $_GET['i'];

$getDetails = mysql_query("SELECT * FROM `contact` WHERE `id` = '$id'",$con) or die(mysql_error());
$rowDetails = mysql_fetch_array($getDetails);
		
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left">
Details of <?php echo $_GET['name'];?></td>
</tr>
</table>
</div>
<div  class="form" style="width:100%;height:600px;background:#ddd">
<table width="100%" cellpadding="5" cellspacing="5"  style="overflow-x:hidden;overflow-y:scroll;padding-left:5px">
<tr>
	<td style="width: 120px; ;">
	Client Owner
	</td>
	<?php
	//echo "SELECT `name` FROM `employee` WHERE `id` = '$rowDetails[0]'";
	$getName = mysql_query("SELECT `name` FROM `employee` WHERE `id` = '$rowDetails[0]'",$con) or die(mysql_error());
	$rowName = mysql_fetch_array($getName);
	?>
	<td colspan="3" style="">
	<?php echo $rowName[0]?>
	</td>
</tr>
<tr>
	<td style="width: 120px; ;">
	Name
	</td>
	<td align="left" style="width: 270px; ;">
	<strong>
	<?php echo $rowDetails['fname']." ".$rowDetails['lname']?>
	</strong>
	</td>
	<td style="width: 120px; ;">
	Mobile
	</td>
	<td style="">
	<strong>
	<?php echo $rowDetails['mobile']?>
	</strong>
	</td>

</tr>

<tr>
	<td style="width: 120px">
	Email
	</td>
	<td style="width: 270px">
	<?php echo $rowDetails['email']?>
	</td>
	<td style="width: 120px">
	Phone
	</td>
	<td>
	<?php echo $rowDetails['phone']?>
	</td>

</tr>
<tr>
	<td style="width: 120px">
	Lead Status 
	</td>
	<td style="width: 270px">
	<?php
	$leadStatus=$rowDetails['leadstatus'];
	$getLeadStatus = mysql_query("SELECT `name`,`id` FROM `leadstatus` WHERE `id` = '$leadStatus'",$con) or die(mysql_error()); 
	$rowLeadStatus = mysql_fetch_array($getLeadStatus);
	echo $rowLeadStatus[0];
	?>
	</td>
	<td style="width: 120px">
	Lead Source 
	</td>
	<td>
	<?php
	$leadSource=$rowDetails['leadsource'];
	$getLeadSource = mysql_query("SELECT `name`,`id` FROM `leadSource` WHERE `id` = '$leadSource'",$con) or die(mysql_error()); 
	$rowLeadSource = mysql_fetch_array($getLeadSource);
	echo $rowLeadStatus[0];
	?>
	</td>

</tr>
<tr>
	<td style="width: 120px">
	Lead Response 
	</td>
	<td style="width: 270px">
	<?php
	$latestResponse =$rowDetails['latestresponse'];
	$getLatestResponse = mysql_query("SELECT `name`,`id` FROM `leadresponse` WHERE `id` = '$leadSource'",$con) or die(mysql_error()); 
	$rowLatestResponse = mysql_fetch_array($getLatestResponse);
	echo $rowLeadStatus[0];
	?>
	</td>
	<td style="width: 120px">
	Call Back Date
	</td>
	<td>
	<?php echo $rowDetails['callbackdate']?>
	</td>

</tr>
<tr>
	<td style="width: 120px;vertical-align:top">
	Services
	</td>
	<td style="width: 270px">
	<?php 
		$p=0;
	$product = $rowDetails['product'];
	$getProduct = mysql_query("SELECT product.name FROM servicecall,product,contact WHERE servicecall.approved = '1' AND servicecall.type = 'c' AND servicecall.product= product.id AND servicecall.cid = '$id' and servicecall.cid= contact.id",$con) or die(mysql_error()); 
	while($rowproduct = mysql_fetch_array($getProduct))
	{
    echo $rowproduct[0]."<br/>";
	}
	$p++;
	?>
	</td>
	<td style="width: 120px">
	
	</td>
	<td>
	
	</td>

</tr>

</table>
</div>
