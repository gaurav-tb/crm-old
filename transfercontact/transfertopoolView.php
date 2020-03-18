<?php
include("../include/conFig.php");
?>

<div class="moduleHeading">Transfer Lead to Pool</div>
<div class="form" style="background:#eee">

<table cellpadding="5" cellspacing="5" width="100%;" class="form">

<tr>
		<td align="right">
		<span class="blueSimpletext" style="">From</span></td>
		<td align="left">
		<select name="Select1" id="from1" class="input" style="width:208px" onchange="getModule('transfercontact/show?transType=0&ownerid='+this.value,'countLeadsVal','','Access Control')">
		<?php
		$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' ORDER BY `name` ASC",$con) or die(mysql_error()); 
			while($rowCity = mysql_fetch_array($getCity))
			{
			?>
			<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
			<?php
			}
			?>
			</select><span id="countLeadsVal" class="blueSimpletext"></span>
			</td>
			
			
			<td align="right" style=";">Lead Source  *</td>
	<td align="left" style=";">

<select class="input leadsourcedropdown"  name="req" style="width: 200px" id="LeadSource">
	 <option value="">Select Lead Source</option>
	 <option value="0">None</option> 
	
<?php
if($perm==1)
{
$getCity = mysql_query("SELECT `name`,`id` FROM `leadsource` WHERE `delete` = '0'",$con) or die(mysql_error()); 
}
else
{
$getCity = mysql_query("SELECT `name`,`id` FROM `leadsource` WHERE `delete` = '0' and `disp`= '1'",$con) or die(mysql_error()); 
}

while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
</select>

<span id="LeadSourceResult" title="LeadSource" style="font-size:9px;"></span>		
</td>

			
</tr>
<tr>
	<td align="right">
	<span class="blueSimpletext"  style="">Select Lead Response</span>
	</td>
	<td align="left">
	<select id="LeadResponse" style="width:210px" name="LeadResponse" Onchange="getModule('transfercontact/showLeadResponses?transType=0&ownerid='+document.getElementById('from1').value+'&Leadsource='+document.getElementById('LeadSource').value+'&LeadResponse='+this.value,'countLeadsResponse','','Access Control')" title="countLeadsResponse" class="input">
	<option value="">Select Lead Response</option>
	<!-- <option value="0">None</option> -->
	<?php
    $getCity = mysql_query("SELECT `name`,`id` FROM `leadresponse` WHERE `delete` = '0'",$con) or die(mysql_error()); 
    while($rowCity = mysql_fetch_array($getCity))
    {
    ?>
    <option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
    <?php
    }
    ?>
	</select>

	
	<span id="countLeadsResponse" class="blueSimpletext"></span>
	<span id="LeadResponseResult" title="Lead Response" style="font-size:9px;"></span>	
	</td>
	
	
	<td align="right">
		<span class="blueSimpletext" style="">Shift</span></td><td align="left">
		<input placeholder="Enter no. of Records" name="Text1" id="shift1" type="text" class="input">
		<span id="shiftResult" title="Shift" style="font-size:9px;"></span>
	</td>
	
</tr>


<tr>
<td></td>
	<td align="left">
	<input name="Button1" type="button" value="Shift" class="buttonBlue" style="width:100px" onclick="CheckTransferCondition();">
 	</td>
</tr>

</table>

