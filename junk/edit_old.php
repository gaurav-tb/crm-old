<?php
include("../include/conFig.php");
$id = $_GET['id'];
$getData = mysql_query("SELECT * FROM `contact` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
<?php echo $row['fname']." ".$row['lname'];?>
</td>
<td align="right" style="width:70%">
<input name="Button1" type="button" value="< Back To List" class="button" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>
</div>
<div class="form">
<table width="100%" cellpadding="0" cellspacing="10">
<tr>
<td align="right" colspan="4">
<div style="float:left;text-align:left">
<div style="display:inline-block;width:50px;vertical-align:middle;height:50px;">
<img id="hotNot" title="Hot Lead" src="images/hot-lead.png" style="<?php if($row['mark'] == '0') { ?>display:none<?php  } ?>;height:40px;vertical-align:middle;padding-bottom:10px;" alt=""/>
<img id="coldNot" title="Cold Lead" src="images/cold-lead.png"  style="<?php if($row['mark'] == '1') { ?>display:none<?php  } ?>;height:40px;vertical-align:middle;padding-bottom:10px;" alt=""/>
</div>

<div <?php if($row['mark'] == '0') echo  "class='pulled'"; else echo "class='pushed'" ;?> id="hotBut" onclick="pushLead('hot','<?php echo $id;?>')">
<?php if($row['mark'] == '0')
{
echo "Hot It!!";
}
else
{
echo "Marked As Hot";
}
?>
</div><div <?php if($row['mark'] == '0') echo  "class='pushed'"; else echo "class='pulled'" ;?>  id="coldBut"  onclick="pushLead('cold','<?php echo $id;?>')">
<?php if($row['mark'] == '1')
{
echo "Cool It!!";
}
else
{
echo "Marked As Cold";
}
?>

</div>
</div>


<div class="buttonLeft" id="ft0" name="Button1" onclick="getModule('leads/viewtrials?cid=<?php echo $_GET['id']?>','viewmoodleContent','','Loading..')" style="position:relative;border-bottom:0px;" >Free Trial&nbsp;&nbsp;<img src="images/more.png" alt=""/>
<div style="position:absolute;top:18px;left:-1px;background:#eee;padding:10px;border:1px #999 solid;border-top:0px;">hello</div>
</div><div name="Button1" type="button" value="Request Free Trial" class="buttonStraight" onclick="getModule('leads/freetrial?cid=<?php echo $_GET['id']?>&mobile=<?php echo $row['mobile']?>','viewmoodleContent','','Loading Bill')" >Request Free Trial</div><div name="Button1" type="button" value="SMS" class="buttonStraight" >SMS</div><div name="Button1" type="button" value="Email" class="buttonStraight" >Emails</div><div class="buttonStraight" name="Button1" onclick="getModule('noteline/index','viewmoodleContent','','Loading..')" type="button" value="Noteline" >Noteline</div><div name="Button1" type="button" value="Add Task" class="buttonStraight" onclick="getModule('task/quickNew?cid=<?php echo $_GET['id']?>&mobile=<?php echo $row['mobile']?>','viewmoodleContent','','Loading Bill')" >Add A Task</div><div name="Button1" type="button" value="Convert To Client" class="buttonRight" onclick="getModule('billing/new?cid=<?php echo $_GET['id']?>&mobile=<?php echo $row['mobile']?>','viewmoodleContent','','Loading Bill')">Convert To Client</div>
</td>
</tr>
<tr>
	<td align="right" style="width: 213px">
	Lead Owner
	</td>
	<td style="width: 303px">
	<input name="Text1" type="text" id="opt0" class="inputDisabled" value="<?php echo $loggedname;?>" />
	</td>
</tr>
<tr>
<td align="right">First Name *</td><td style="width: 303px">
	<input class="input"  style="width: 200px" name="req" type="text" id="opt1" value="<?php echo $row['fname'];?>" /></td>
<td align="right" style="height: 32px; width: 208px;">Last Name *</td>
	<td align="left"><input class="input"  style="width: 200px" name="req" type="text" id="opt2" value="<?php echo $row['lname']?>" /></td>
</tr>
<tr>
	<td align="right" style="height: 32px">Phone</td>
	<td align="left" style="width: 303px; height: 32px;"><input class="input"  style="width: 200px" type="text" id="opt3" value="<?php echo $row['phone'];?>" /></td>
	<td align="right" style="height: 32px; width: 208px;">Mobile  *</td>
	<td align="left" style="height: 32px"><input class="input"  style="width: 200px" name="reqismob" type="text" id="opt4" value="<?php echo $row['mobile'];?>" /></td>

</tr>
<tr>
	<td align="right">Email</td><td align="left" style="width: 303px"><input class="input"  style="width: 200px" name="text1" type="text" id="opt5" value="<?php echo $row['email'];?>"/></td>
	<td align="right" style="width: 208px">Website</td><td align="left"><input class="input"  style="width: 200px" name="text1" type="text" id="opt6" value="<?php echo $row['website'];?>" /></td>

</tr>
<tr>
	<td align="right" style="height: 36px">Lead Status  *</td>
	<td align="left" style="height: 36px; width: 303px;">

<select class="input" name="req" style="width: 200px" id="opt7">
				
<?php
$getLeadStatus = mysql_query("SELECT `name`,`id` FROM `leadstatus` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowLeadStatus = mysql_fetch_array($getLeadStatus))
{
?>
<option <?php if($rowLeadStatus[1] == $row['leadstatus']) echo "selected='selected'"; ?> value="<?php echo $rowLeadStatus[1];?>"><?php echo $rowLeadStatus[0];?></option>
<?php
}
?>
			</select>

	</td>
	
	<td align="right" style="height: 36px; width: 208px;">Lead Source  *</td>
	<td align="left" style="height: 36px">

<select  class="input" name="req" style="width: 200px" id="opt8">
				
<?php
$getLeadSource = mysql_query("SELECT `name`,`id` FROM `leadsource` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowLeadSource = mysql_fetch_array($getLeadSource))
{
?>
<option <?php if($rowLeadSource[1] == $row['leadsource']) echo "selected='selected'"; ?> value="<?php echo $rowLeadSource[1];?>"><?php echo $rowLeadSource[0];?></option>
<?php
}
?>
			</select>

	</td>

</tr>

<tr>
	<td align="right" style="height: 36px">Latest Response  *</td>
	<td align="left" style="height: 36px; width: 303px;">

<select class="input" name="req" style="width: 200px" id="opt9">
				
<?php
$getLatestResponse = mysql_query("SELECT `name`,`id` FROM `leadresponse` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowLatestResponse = mysql_fetch_array($getLatestResponse))
{
?>
<option <?php if($rowLatestResponse[1] == $row['latestresponse']) echo "selected='selected'"; ?> value="<?php echo $rowLatestResponse[1];?>"><?php echo $rowLatestResponse[0];?></option>

<?php
}
?>
			</select>

	</td>
	<td align="right">Call Back Date</td><td align="left"><input class="inputCalender"  onclick="openCalendar(this);" readonly="readonly"  style="width: 200px" type="text" id="opt10" value="<?php echo $row['callbackdate'];?>" /></td>
	
	
</tr>

<tr>
	<td align="right" style="width: 208px; height: 32px;">Messenger ID  *</td>
	<td align="left" style="width: 303px; height: 32px;"><input class="input"  style="width: 200px" name="req" type="text" id="opt11" value="<?php echo $row['messengerid'];?>"/></td>

</tr>
<tr>
		<td align="right" valign="top" style="height: 31px">
		Services
		</td>
		<td colspan="3">

		<?php
		$h= 15;
		$product = $row['product'];
		$product = explode(",",$product);
		
$getProduct = mysql_query("SELECT `name`,`id` FROM `product` WHERE `delete` = '0' AND `id` != '1'",$con) or die(mysql_error()); 
while($rowproduct = mysql_fetch_array($getProduct ))
{
?>
<input name="Checkbox1" type="checkbox" <?php if(in_array($rowproduct[1],$product)) echo "checked='checked'" ;?> id="<?php echo 'opt'.$h;?>" value="<?php echo $rowproduct[1] ?>" /> <?php echo $rowproduct[0] ?>
<br/>
<?php
$h++;
}
?>

		
		

		
		</td>
		<td>
		
		
		</td>

</tr>
</table>
</div>
	<div class="moduleHeading">
	<table  width="100%" cellpadding="0" cellspacing="0">

<tr>
<td colspan="2" style="width:100%;">

	Address Details
	
	</td>
	<td></td>
</tr>
</table>
</div>
<div class="form">
<table  width="100%" cellpadding="0" cellspacing="10">
<tr>
<td align="right" valign="top" style="width: 169px; height: 29px;">Address</td>
<td>
<textarea name="TextArea2" id="opt12" class="input"  style="width: 700px;height:110px;"  ><?php echo $row['address'];?></textarea></td>


<tr>
<td align="right">City</td>
	<td align="left" style="width: 500px; height: 36px;">

<select name="Select1" class="input"  style="width: 200px" id="opt13">
				
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `city` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option <?php if($rowCity[1] == $row['city']) echo "selected='selected'"; ?> value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>

<?php
}
?>
			</select>

</td>

</tr>


<tr>
<td align="right" valign="top">Description</td>
<td>
<textarea name="TextArea2" id="opt14" class="input"  style="width: 700px;height: 101px;" ><?php echo $row['description'];?></textarea></td>


<tr>
<td style="width: 59px; height: 40px;"></td>
<td style="width: 500px; height: 40px;">
<input name="Button1" type="button" value="Update" class="buttonGreen" onclick="SaveData('leads/update?id=<?php echo $id;?>&i=<?php echo $_GET['i'];?>','opt','<?php echo $h;?>','<?php echo $_GET['i'];?>','','','2');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Cancel" class="buttonnegetive" id="negetive" />
</td>
</tr>
</table>
</div>


