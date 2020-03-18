<?php
include("../include/conFig.php");

?>

<div class="moduleHeading">Transfer Client's Owner</div>
<div class="form" style="background:#eee">

<table cellpadding="5" cellspacing="5" width="100%;" class="form">


	<tr>
	<td>
	<strong>Contact Status</strong>
	</td>
	<td>
		<select class="input" name="contactstatus" style="width: 200px" id="status">
		<option value="1">Client</option>
		
		</select>
		<span id="contactstatus" title="LeadSource" style="font-size:9px;"></span>		
	<td>
	
	
</tr>
<tr>
	<td>
	<strong>Transfer</strong>
	</td>
	<td>
		<select class="input" name="transfer" style="width: 200px" id="transfer">
		<option value="0">Choose Option</option>
		<option value="1">Transfer RM Owner</option>
        <option value="2">Transfer Support Owner</option>
		<option value="3">Transfer Clients Owner</option>
		</select>
		<span id="transfer" title="LeadSource" style="font-size:9px;"></span>	
	<td>
	</tr>
	<tr>
		<td >
		<span class="blueSimpletext" style="">From</span></td>
		<td align="left">
<!-- 		<select name="Select1" id="from1" class="input" style="width:208px" onchange="getModule('transfercontact/show?transType=0&ownerid='+this.value,'countLeadsVal','','Access Control')">
 -->		
		<select name="Select1" id="from1" class="input" style="width:208px" >

 <?php
		$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' ORDER BY `name` ASC",$con) or die(mysql_error()); 
			while($rowCity = mysql_fetch_array($getCity))
			{
			?>
			<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
			<?php
			}
			?>
			</select><span id="from" class="blueSimpletext"></span>
			</td>
			<td align="left">
		<span class="blueSimpletext" style="">To</span></td>
		<td align="left">
		<select name="Select1" id="to1" class="input" style="width:208px">
		<?php
		$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' ORDER BY `name` ASC",$con) or die(mysql_error()); 
			while($rowCity = mysql_fetch_array($getCity))
			{
			?>
			<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
			<?php
			}
			?>
			</select><span id="to" class="blueSimpletext"></span>
			</td>
	</tr>
	

<tr>
<td></td>
	<td align="left">
	<input name="Button1" type="button" value="Shift" class="buttonBlue" style="width:100px" onclick="return CheckTransferOwner();">
 	</td>
</tr>

</table>

