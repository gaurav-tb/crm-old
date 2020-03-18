<?php
include("../include/conFig.php");
$lsid=$_GET['lsid'];

$getFullCount = mysql_query("SELECT COUNT(`id`) FROM `contact` WHERE `alloted` = '0' AND `delete` = '0' AND `self` = '0'",$con) or die(mysql_error());
$rowFc = mysql_fetch_array($getFullCount);

if($lsid)
{
$getSemiCount = mysql_query("SELECT COUNT(`id`) FROM `contact` WHERE `alloted` = '0' AND `leadsource` = '$lsid' AND `delete` = '0' AND `self` = '0'",$con) or die(mysql_error());
$rowSc = mysql_fetch_array($getSemiCount);
}

$getData = mysql_query("SELECT contact.fname, contact.mobile, contact.email, contact.createdate,contact.id FROM contact WHERE contact.delete = '0' AND contact.leadsource = '$lsid' AND contact.ownerid = '0' AND contact.alloted = '0'  ORDER BY contact.id DESC LIMIT 100",$con) or die(mysql_error());
?>
<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Allot Leads</td>
			
	</table>
</div>
<div id="directResult">
<div style="background:#eee;padding:20px;">
Please select lead source.	<br/>
<select name="Select1" id="lsid" class="input" style="width: 246px">
<option value="">Select Source</option>
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `leadsource` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
$getCount = mysql_query("SELECT COUNT(`id`) FROM `contact` WHERE `leadsource` = '$rowCity[1]' AND `alloted` = '0' AND `delete` = '0'",$con) or die(mysql_error());
$rwCount = mysql_fetch_array($getCount);


?>
<option <?php if($lsid == $rowCity[1]) echo "selected='selected'"; ?> value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0]." has ".$rwCount[0]." records";?></option>
<?php
}
?>
			</select>
			<input id="" class="button" name="Button1" onclick="getModule('uploadlead/view?lsid='+document.getElementById('lsid').value,'viewContent','manipulateContent','')" value="Get It!" style="width: 69px" />
			
			<div class="blueSimpletext" style="float:right;;font-family:Georgia, 'Times New Roman', Times, serif;text-align:right;line-height:160%">
			<strong><?php echo $rowFc[0];?></strong>: Total Unalloted Leads<br/>
			<?php 
			if($rowSc[0])
			{
			?>
			<strong id="leadTotal"><?php echo $rowSc[0];?> </strong>: Total Unalloted Leads From Selected Source.<input style="display:none" value="<?php echo $rowSc[0];?>" id="totalVal" name="Text1" type="text" />
<br/>
			<?php
			}
			?>
			<input style="display:none" name="Button1" class="buttonBlue" type="button" value="+1 Add More" onclick="getModule('uploadlead/new','manipulateContent','viewContent','Upload Leads')" />
			
	
			</div>
			


</div>
<div style="background:#fff;padding:10px 0px 10px 20px;-moz-box-shadow: inset 0 0 5px 2px #888;-webkit-box-shadow: inset 0 0 5px 2px #888;box-shadow: inset 0 0 5px 2px #888;">
<select name="Select1" class="input" style="width: 390px" id="profileId">
			
<option value="">Select User Profile</option>
<?php
$getProfile = mysql_query("SELECT `name`,`id` FROM `profile` WHERE `delete` = '0'",$con) or die(mysql_error());
while($rowProfile= mysql_fetch_array($getProfile))
{
?>
	<option value="<?php echo $rowProfile[1];?>"><?php echo $rowProfile[0];?></option>
<?php
}
?>

			</select>&nbsp;&nbsp;
			<input name="Button1" type="button" value="Get Users" class="buttonBlue" onclick="getModule('uploadlead/customView?profile='+document.getElementById('profileId').value+'&lsid=<?php echo $lsid;?>','customResult','','Fetching Data')" />
			
</div>
<div id="customResult"></div>
<div class="form">
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
	<th style="padding-left:10px">Name</th>
	<th>Mobile</th>
	<th>Email</th>
	<th>CreateDate</th>
		</tr>
	
		


	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	<tr id="allotRow<?php echo $i;?>" class="d<?php echo $i%2;?>">
		<td style="width: 300px;padding-left:10px">
		<?php echo $row[0];?></td>
		<td>
		<?php echo $row[1];?>
		</td>
		<td>
		<?php echo $row[2];?>
		</td>
				<td>
		<?php echo date('d,M',strtotime($row[3]));?>
		</td>
	</tr>
	<?php
$i++;
$Maxid = $row[7];
$MaxI = $i;
}
?>
</table>
<div id="moreData">
</div>
<div class="moduleFoot">
	<div style="float: right;"></div>
	<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
	</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>