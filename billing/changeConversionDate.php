<?php
include("../include/conFig.php");
$type = $_GET['approvalDate'];
$cid = $_GET['cid'];

if($type==1)
{
$def="Client Conversion Date";	
$getData=mysql_query("SELECT `conversiondate` FROM `contact` WHERE `id` = '$cid'",$con) or die(mysql_error());
$row=mysql_fetch_array($getData);
}

else if($type==3)
{
$def="Plan Approval Date";	
$getData=mysql_query("SELECT `ApprovedDate` FROM `activatepremium` WHERE  `cid` =  '$cid' AND id = (SELECT MAX( id ) FROM  `activatepremium` WHERE cid ='$cid')",$con) or die(mysql_error());
$row=mysql_fetch_array($getData);	
}

else
{
$def="Booster Approval Date";	


$getData=mysql_query("SELECT `ApprovalDate` FROM `researchbooster` WHERE  `cid` =  '$cid' AND id = (SELECT MAX( id ) FROM  `researchbooster` WHERE cid ='$cid' )",$con) or die(mysql_error());
$row=mysql_fetch_array($getData);
}
?>
<center style="height:600px;;width:100%;background:#eee;">
<div class="moduleHeading" style="margin:0px;">
	
<table cellpadding="0" cellspacing="0" width="100%" class="fetch">
<tr>
<td align="left" style="width: 30%; height: 19px;">Change <?php echo $def ?></td>

</tr>


</table>
</div>
<br/><br/>
<div  style="padding:5px;width:550px;-moz-box-shadow: 0 0 20px #222; -webkit-box-shadow: 0 0 20px #222;" class="form">
<table width="500px" cellpadding="5" cellspacing="0">
<tr>
<td align="left">Please select the new Date</td>
</tr>
<tr>
<td style="width:163px;">
<input id="owner" name="leadowner" class="inputCalender" value="<?php echo $row[0] ?>" placeholder="YYYY-MM-DD" onclick="openCalendar(this);" readonly="readonly" type="text">
</td>
</tr>
<tr>
<td>
<input class="buttonBlue" name="Button1" style="width:149px;" type="button" onclick="changeConversionDate(document.getElementById('owner').value,'<?php echo $type;?>','<?php echo $cid;?>')" value="Change"/>
</td>
</tr>
<tr>
<td style="color:;font-weight:bold">
<div id="owresponse"></div>
</td>
</tr>
</table>
</div>
</center>