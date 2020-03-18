<?php
include("../include/conFig.php");
$id = $_GET['id'];
$i = $_GET['i'];

if($_GET['expiring'] == 1)
{
$sqlid = 'exptlview';
$listid = 'expidList';
$expiring=1;
}
else
{
$sqlid = 'tlview';
$listid = 'idList';
$expiring=0;
}



if($_GET['todo'])
{
$todo = $_GET['todo'];
	if($todo == 'n')
	{
	$idList = $_POST['idList'];
	$idList = explode(",",$idList);
	$getCurrnt = array_search($id,$idList);
	$newId = $idList[$getCurrnt+1]; 
	$id= $newId;
		if($id == '')
		{
			$last = 1;
			$id = $_GET['id'];
		}
	}
	else if($todo == 'p')
	{
	$idList = $_POST['idList'];
	$idList = explode(",",$idList);
	$getCurrnt = array_search($id,$idList);
	if($getCurrnt != 0)
	{
	$newId = $idList[$getCurrnt-1]; 
	$id= $newId;
		if($id == '')
		{
	$first = 1;			$id = $_GET['id'];
		}
	}
	else
	{
	$first = 1;
	}
	}
}


$getData = mysql_query("SELECT * FROM `contact` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

$owner = $row['ownerid'];
if($owner == $loggeduserid && $row['read'] == '0')
{
mysql_query("UPDATE `contact` SET `read` = '1' WHERE `id` = '$id'",$con) or die(mysql_error());
}
 
if(in_array('UAL_leads',$thisPer)){
$allowMenu = 1;
} 
else if(in_array('UTL_leads',$thisPer))
{
$getLead = mysql_query("SELECT COUNT(`id`) FROM `team` WHERE `leader` = '$loggeduserid'",$con) or die(mysql_error());
	$rowLead = mysql_fetch_array($getLead);
		if($rowLead[0] > 0)
		{
		$getTeam = mysql_query("SELECT `mateid` FROM `teamamtes` WHERE `teamid` IN (SELECT `id` FROM `team` WHERE `leader` = '$loggeduserid')",$con) or die(mysql_error());
		while($rTeam = mysql_fetch_array($getTeam))
		{
		$teamArr[] .= $rTeam[0];
		}
		$teamArr[] .= $loggeduserid;
		if(in_array($row['ownerid'],$teamArr))
		{
		
$allowMenu = 1;
	}

		}
}

else if(in_array('U_leads',$thisPer)){
if($row[0] == $loggeduserid)
{
$allowMenu = 1;
 } 
}










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
<div style="display:inline-block;width:20px;vertical-align:middle;height:20px;">
<img id="hotNot" title="Hot Lead" src="images/hot-lead.png" style="<?php if($row['mark'] == '0') { ?>display:none<?php  } ?>;height:20px;vertical-align:middle;" alt=""/>
<img id="coldNot" title="Cold Lead" src="images/cold-lead.png"  style="<?php if($row['mark'] == '1') { ?>display:none<?php  } ?>;height:20px;vertical-align:middle;" alt=""/>
</div>&nbsp;<div <?php if($row['mark'] == '0') echo  "class='pulled'"; else echo "class='pushed'" ;?> id="hotBut" onclick="pushLead('hot','<?php echo $id;?>')">
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
<?php

if(in_array('CO_leads',$thisPer))
{

$show =1;
}
else if(in_array('CO_team',$thisPer))
{
	$owner = $row['ownerid'];
	$getTeam = mysql_query("SELECT teamamtes.mateid FROM teamamtes,team WHERE team.leader = '$loggeduserid' AND team.id = teamamtes.teamid",$con) or die(mysql_error());
	while($rowTeam = mysql_fetch_array($getTeam))
	{
	$team[] .=$rowTeam[0]; 
	}

	$team[] .= $loggeduserid;
	
	
	if(in_array($owner,$team))
	{
	$show = 1;
	}
	else
	{
	$show = 0;
	}


}



if($show == 1)
{

?>
<div style="display:inline-block">
<select class="input" name="leadowner" style="width: 207px" id="newOwner">
	<option value="">Change Owner</option>			
<?php
if(in_array('VA_leads',$thisPer))
{
$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0'",$con) or die(mysql_error()); 
}
else if(in_array('VA_tLeads',$thisPer))
{
	$getLead = mysql_query("SELECT COUNT(`id`) FROM `team` WHERE `leader` = '$loggeduserid'",$con) or die(mysql_error());
	$rowLead = mysql_fetch_array($getLead);
		if($rowLead[0] > 0)
		{
			$getCity = mysql_query("SELECT employee.name,teamamtes.mateid FROM employee,team,teamamtes WHERE team.leader = '$loggeduserid' AND teamamtes.mateid = employee.id AND teamamtes.teamid = team.id AND team.delete = '0' AND employee.delete = '0'",$con) or die(mysql_error());
		}
		else
		{
			$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `id` = '$loggeduserid'",$con) or die(mysql_error()); 
		}
}
else
{
$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `id` = '$loggeduserid'",$con) or die(mysql_error()); 
}

while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select></div><div style="display:inline-block" class="buttonGreen" onclick="getModule('changeOwner?cid=<?php echo $id;?>&i=<?php echo $_GET['i'];?>&owner='+document.getElementById('newOwner').value,'manipulateContent','viewContent','Leads');">Go</div>
			&nbsp;
<?php	
}		
$getRule = mysql_query("SELECT allotmentrules.from,allotmentrules.to,profile.name FROM allotmentrules,profile WHERE allotmentrules.delete = '0' AND profile.delete = '0' AND allotmentrules.to = profile.id AND allotmentrules.from = '$perm' ORDER BY allotmentrules.id DESC LIMIT 1",$con) or die(mysql_error());
while($rowRule = mysql_fetch_array($getRule))
{
$fromRule[$rowRule[0]] = $rowRule[1]."---".$rowRule[2];
}

		if(array_key_exists($perm,$fromRule) && $row['ownerid'] == $loggeduserid)
		{
		$temp = $fromRule[$perm];
		$temp = explode("---",$temp);
		
	?>
			<div style="display:inline-block" class="buttonGreen" onclick="getModule('leads/allottoBDE?cid=<?php echo $id;?>&i=<?php echo $_GET['i'];?>&toprofile=<?php echo $temp[0];?>','manipulateContent','viewContent','Leads');">Allot to <?php echo $temp[1];?></div>
<?php
		}


if($allowMenu == 1)
{


 if(in_array('FT_RN_leads',$thisPer) || in_array('FT_VP_leads',$thisPer)){?>

<div class="buttonLeft" id="ft0" name="Button1" onclick="mySubmenu('0','blueLeft')" style="position:relative;" >Free Trial&nbsp;&nbsp;<img src="images/more.png" style="height:6px;vertical-align:middle" alt=""/>
<div id="in0" class="in" style="right:0px;">
<ul>
<?php if(in_array('FT_RN_leads',$thisPer)){?>
<li onclick="getModule('freetrial/request?cid=<?php echo $id;?>&mobile=<?php echo $row['mobile']?>&name=<?php echo $row['fname'];?>','manipulatemoodleContent','viewmoodleContent','Request Free Trial')">Request New</li>
 <?php } 
 if(in_array('FT_VP_leads',$thisPer)){?> 
<li onclick="getModule('freetrial/viewPrevious?cid=<?php echo $id;?>','viewmoodleContent','','Previous Free Trials')" >View Previous</li>
 <?php } ?>
</ul>

</div>
</div><?php }
 if(in_array('M_C_leads',$thisPer) || in_array('M_SI_leads',$thisPer)){?>
<div name="Button1" id="ft1" class="buttonStraight" onclick="mySubmenu('1','blueStraight')" style="position:relative;" >Messages&nbsp;&nbsp;<img src="images/more.png" style="height:6px;vertical-align:middle" alt=""/>
<div id="in1" class="in" style="left:0px;">
<ul>
<?php if(in_array('M_C_leads',$thisPer)){?>
<li onclick="getModule('sms/viewSMS?clid=<?php echo $id?>','manipulatemoodleContent','viewmoodleContent','SMS List')">SMS</li>
<?php }
if(in_array('M_SI_leads',$thisPer)){?>
<li  onclick="getModule('email/viewemail?clid=<?php echo $id?>','manipulatemoodleContent','viewmoodleContent','Email List')">Email</li>
<?php } ?>
</ul>
</div>
</div><?php }
if(in_array('A_NT_leads',$thisPer) || in_array('A_AS_leads',$thisPer)){?>
<div name="Button1" id="ft2" class="buttonStraight" onclick="mySubmenu('2','blueStraight')" style="position:relative;" >Activity&nbsp;&nbsp;<img src="images/more.png" style="height:6px;vertical-align:middle" alt=""/>
<div id="in2" class="in" style="left:0px;">
<ul>
<?php if(in_array('A_NT_leads',$thisPer)){?>
<li onclick="getModule('task/quickNew?cid=<?php echo $id;?>&mobile=<?php echo $row['mobile']?>&name=<?php echo $row['fname'];?>','manipulatemoodleContent','viewmoodleContent','Task  For <?php echo $row['fname'];?>')" >New Task</li>
<?php }
if(in_array('A_AS_leads',$thisPer)){?>
<li onclick="getModule('noteline/index?cid=<?php echo $id;?>&name=<?php echo $row['fname'];?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo $row['fname'];?>')">Story</li>
<?php } ?>
</ul>
</div>
</div>
<?php }
if(in_array('CTC_leads',$thisPer)){?>
<div name="Button1" type="button" value="Convert To Client" class="buttonRight" onclick="getModule('billing/new?cid=<?php echo $id;?>&mobile=<?php echo $row['mobile']?>&name=<?php echo $row['fname'];?>','viewmoodleContent','','<?php echo $row['fname'];?> - New Client')">Convert To Client</div>
<?php } 
}
?>
<br/><br/>
<div style="float:left;font-weight:bold">
Created On 
<?php
echo date("d M,Y h:i:s",strtotime($row['createdate']));
?>
</div>
<div style="font-weight:bold;display:inline-block;vertical-align:top">
Modified On 
<?php
echo date("d M,Y h:i:s",strtotime($row['modifieddate']));
?>
</div>

<div class="button leftRound" title="View Previous Lead Of Same View" style="display:inline-block;padding:0px 5px; <?php if($first) { ?> background:#ccc; <?php } ?>"   <?php if(!$first) { ?>  onclick="changePage('leads/edit?id=<?php echo $id;?>&i=<?php echo $i;?>&expiring=<?php echo $expiring;?>','p','<?php echo $sqlid;?>','<?php echo $listid;?>')" title="View Previous Lead Of Same View" <?php } else {?> title="Reached first record of selected view" <?php } ?>><img src="images/previous.png" alt="" style="cursor:pointer;height:25px"/></div><div class="button rightRound" style="display:inline-block;padding:0px 5px; <?php if($last) { ?> background:#ccc; <?php } ?>"   <?php if(!$last) { ?>  onclick="changePage('leads/edit?id=<?php echo $id;?>&i=<?php echo $i;?>&expiring=<?php echo $expiring;?>','n','<?php echo $sqlid;?>','<?php echo $listid;?>')" title="View Next Lead Of Same View" <?php } else {?> title="Reached last record of selected view" <?php } ?>><img src="images/next.png" alt="" style="cursor:pointer;height:25px"/></div>

</td>
</tr>
<tr>
	<td align="right" style="">
	Lead Owner
	</td>
	<td style="">
	<?php
	$getName = mysql_query("SELECT `name` FROM `employee` WHERE `id` = '$row[0]'",$con) or die(mysql_error());
	$rowName = mysql_fetch_array($getName);
	
	?>
	<input name="Text1" type="text" class="inputDisabled" value="<?php echo $rowName[0];?>" readonly="readonly" />

	<input name="Text1" type="text" id="opt0" style="display:none" class="inputDisabled" value="<?php echo $row[0];?>" readonly="readonly" />
	</td>
	<td align="right" style="">
	Lead Generator
	</td>
	<td style="">
	<?php
	$genby = $row['genby'];
	$getGName = mysql_query("SELECT `name` FROM `employee` WHERE `id` = '$genby'",$con) or die(mysql_error());
	$rowGName = mysql_fetch_array($getGName);
	
	?>
	<input name="Text1" type="text" class="inputDisabled" value="<?php echo $rowGName[0];?>" readonly="readonly" />


	</td>
</tr>
<tr>
<td align="right" style="">First Name *</td><td style="">
	<input class="input"  style="width: 200px" name="req" type="text" id="opt1" value="<?php echo $row['fname'];?>" /></td>
<td align="right" style=" width: 208px;">Last Name</td>
	<td align="left"><input class="input"  style="width: 200px" type="text" id="opt2" value="<?php echo $row['lname']?>" /></td>
</tr>
<tr>
	<td align="right" style=" ;">Phone</td>
	<td align="left" style="; "><input class="input"  style="width: 200px" type="text" id="opt3" value="<?php echo $row['phone'];?>" /></td>
	<td align="right" style=" width: 208px;">Mobile  *</td>
	<?php if(in_array('MNU_leads',$thisPer)){
	?>
	<td align="left" style=""><input class="input" style="width: 200px" name="req" maxlength="10" type="text" id="opt4" value="<?php echo $row['mobile'];?>" /></td>
	<?php }
	else
	{ ?>
	<td align="left" style=""><input class="input" style="width: 200px" name="req" maxlength="10" type="text" id="opt4" value="<?php echo $row['mobile'];?>" readonly="readonly" /></td>
	<?php 
	}
	?>
</tr>
<tr>
	<td align="right" style="; ">Email</td>
	<td align="left" style="; "><input class="input"  style="width: 200px" name="text1" type="text" id="opt5" value="<?php echo $row['email'];?>"/></td>
	<td align="right" style="width: 208px; ">Alternate Email</td>
	<td align="left" style=""><input class="input"  style="width: 200px" name="text1" type="text" id="opt17" value="<?php echo $row['altemail'];?>" />
	</td>

</tr>
<tr>
	<td align="right" style="">Date of Birth</td><td align="left"><input class="input" style="width: 200px" type="date" id="opt18" value="<?php echo $row['dob'];?>" /></td>

	<td align="right" style="width: 208px;">Trader Profile</td>
	<td align="left">

<select  class="input" style="width: 200px" id="opt19">
				
<?php
$getTraderprofile = mysql_query("SELECT `name`,`id` FROM `traderprofile` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowTraderprofile = mysql_fetch_array($getTraderprofile))
{
?>
<option <?php if($rowTraderprofile[1] == $row['traderprofile']) echo "selected='selected'"; ?> value="<?php echo $rowTraderprofile[1];?>"><?php echo $rowTraderprofile[0];?></option>
<?php
}
?>
			</select>
<div style="z-index:20000000000000000000;float:right">
<div class="buttonBlue" style="position:fixed;right:0px;cursor:pointer;padding:5px;" onclick="getModule('noteline/index?cid=<?php echo $id;?>&name=<?php echo $row['fname'];?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo $row['fname'];?>')">Story</div>
</div>
	</td>

</tr>

<tr>
	<td align="right" style=";">Trader's Experience</td>
	<td align="left" style=";">

<select class="input" name="" style="width: 200px" id="opt20">
				
<?php
$getTraderexp = mysql_query("SELECT `name`,`id` FROM `traderexp` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowTraderexp = mysql_fetch_array($getTraderexp))
{
?>
<option <?php if($rowTraderexp[1] == $row['experience']) echo "selected='selected'"; ?> value="<?php echo $rowTraderexp[1];?>"><?php echo $rowTraderexp[0];?></option>

<?php
}
?>
			</select>

	</td>
	<td align="right" style=";">Investment Amount</td>
	<td align="left" style=";">

<select class="input" name="" style="width: 200px" id="opt21">
				
<?php
$getTraderamt = mysql_query("SELECT `name`,`id` FROM `traderamt` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowTraderamt = mysql_fetch_array($getTraderamt))
{
?>
<option <?php if($rowTraderamt[1] == $row['invamount']) echo "selected='selected'"; ?> value="<?php echo $rowTraderamt[1];?>"><?php echo $rowTraderamt[0];?></option>

<?php
}
?>
			</select>

	</td>

	
</tr>
<tr>
	<td align="right" style="height: 36px; ;" valign="top">Website</td>
	<td align="left" style="height: 36px; ;" valign="top">
<input name="Text1" type="text" class="input" id="opt6" value="<?php echo $row['website'];?>" />

	</td>
	<td align="right" style=";" valign="top">Lead Status  *</td>
	<td id="teamUsers">
<select name="req" class="input" onchange="addToteam(this.value,'opt7')">
			<option value="">Select Lead Status</option>
			<?php
			$getProfile = mysql_query("SELECT `name`,`id` FROM `leadstatus` WHERE `delete` = '0'",$con) or die(mysql_error());
			while($rowProfile= mysql_fetch_array($getProfile))
			{
			$lstArray[$rowProfile[1]] = $rowProfile[0];
			?>
			<option value="<?php echo $rowProfile[1] ;?>**<?php echo $rowProfile[0] ;?>"><?php echo $rowProfile[0] ;?></option>
			<?php
			}
			?>
			
			</select>&nbsp;&nbsp;<span id="reselect"></span>
			<div style="padding:5px;;" id="selectTeam">
		<?php
		$lst = $row['leadstatus'];
		$lst = explode(",",$lst);
		foreach($lst as $val)
		{
		$valPut .= $val.",";
		$val = str_ireplace("-","",$val);
		$val = trim($val);
		if($val != '')
		{
?>
<div class="teamMate" id="team<?php echo $val;?>"><?php echo $lstArray[$val];?>&nbsp;&nbsp;&nbsp;<span style="cursor:pointer" onclick="removeTeam('<?php echo $val;?>','opt7')">x</span></div>
<?php
}
}		
?>				

		</div>
			<input name="req" type="text" value="<?php echo $valPut;?>" id="opt7" name="req" title="isNotNull" style="display:none" />

</td>
		
</tr>

<tr>
	<td align="right" style=";">Lead Source  *</td>
	<td align="left">

<select  class="input" name="req" title="isNotNull" style="width: 200px" id="opt8">
				
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
<td align="right" style=";">Latest Response  *</td>
	<td align="left" style=";">

<select class="input" name="req" title="isNotNull" style="width: 200px" id="opt9">
				
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

</tr>
<tr>
	<td align="right" style="">Call Back Date</td><td align="left"><input class="input" style="width: 200px" type="date" id="opt10" value="<?php echo $row['callbackdate'];?>" /></td>
	<td align="right" style="height: 36px; ;">Expeceted Revenue</td>
	<td align="left" style="height: 36px; ;">
<input name="Text1" type="text" class="input" id="opt15" value="<?php echo $row['revenue'];?>" />

	</td>
	
</tr>
<tr>
	<td align="right" style="">Expected Conversion Date</td><td align="left">
	<input  style="width: 200px;" class="input" type="date" id="opt16"  value="<?php echo $row['conversiondate'];?>"  />
	</td>
	<td align="right" style="; ">Messenger ID</td>
	<td align="left" style="; "><input class="input"  style="width: 200px" type="text" id="opt11" value="<?php echo $row['messengerid'];?>"/></td>

</tr>
<tr>
	<td align="right" style=";">Language</td>
	<td align="left">

<select  class="input" style="width: 200px" id="opt22">
				
<?php
$getTraderprofile = mysql_query("SELECT `name`,`id` FROM `language` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowTraderprofile = mysql_fetch_array($getTraderprofile))
{
?>
<option <?php if($rowTraderprofile[1] == $row['language']) echo "selected='selected'"; ?> value="<?php echo $rowTraderprofile[1];?>"><?php echo $rowTraderprofile[0];?></option>
<?php
}
?>
			</select>

	</td>

</tr>

<tr>
		<td align="right" valign="top" style="">
		Services
		</td>
		<td colspan="3" style="font-size:13px;">
<table cellpadding="0" cellspacing="5">
	<tr>
		<?php
		$h= 23;
		$g=0;

$products= $row['product'];
$temp= explode(",",$products);
foreach($temp as $val)
{
$product[] .= str_ireplace("-","",$val); 
}


$getProduct = mysql_query("SELECT `name`,`id` FROM `category` WHERE `delete` = '0' AND `id` != '1' ORDER BY `name` ASC",$con) or die(mysql_error()); 
while($rowproduct = mysql_fetch_array($getProduct))
{
?>

		<td>

<input name="Checkbox1" type="checkbox" <?php if(in_array($rowproduct[1],$product)) echo "checked='checked'" ;?> id="<?php echo 'opt'.$h;?>" value="<?php echo $rowproduct[1] ?>" /> <?php echo $rowproduct[0] ?>

<?php
if($g%2 != 0)
{
echo "</tr><tr>";
}
$g++;
$h++;
}
?>


		
		

		
		</td>
		<td>
		
		
		</td>

</tr>
</table>
</td>
</tr>
<tr>
<td colspan="4">


	<div class="moduleHeading">
	<table  width="100%" cellpadding="0" cellspacing="0">

<tr>
<td colspan="2" style="width:100%;border:0px;">

	Address Details
	
	</td>
	<td></td>
</tr>
</table>
</div>

<table  width="100%" cellpadding="0" cellspacing="10">
<tr>
<td align="right" valign="top" style="width:160px;">Address</td>
<td>
<textarea name="TextArea2" id="opt12" class="input"  style="width: 700px;height:110px;"  ><?php echo $row['address'];?></textarea></td>


<tr>
<td align="right">State</td>
	<td colspan="" align="left" style="width: 500px;">
	<?php
	$cityId = $row['city'];
	$getState = mysql_query("SELECT * FROM `city` WHERE `id` =  '$cityId'",$con) or die(mysql_error());
	$rowState = mysql_fetch_array($getState);
	$state = $rowState['state'];
	?>
	

<select name="Select1" class="input"  style="width: 200px" id="state" onchange="getModule('leads/getCity?id=opt13&state='+this.value,'getCity','',document.title)">
	<option value="">Select State</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `state` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option <?php if($rowCity[1] == $state) echo "selected='selected';" ?> value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>&nbsp;&nbsp;&nbsp;&nbsp;
			
</td>

</tr>
<tr>
<td align="right">
City
</td>
<td>
<span id="getCity" style="display:inline">
<select name="Select1" class="input"  style="width: 200px" id="opt13">
				
<?php

$getCity = mysql_query("SELECT `name`,`id` FROM `city` WHERE `delete` = '0' and `state` = '$state'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option <?php if($rowCity[1] == $row['city']) echo "selected='selected'"; ?> value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>

<?php
}
?>
			</select>
</span>

</td>

</tr>


<tr>
<td align="right" valign="top">Description</td>
<td>
<textarea name="TextArea2" id="opt14" class="input"  style="width: 700px;height: 101px;" ><?php echo str_ireplace("<br/>","\r\n",$row['description']);?></textarea></td>


<tr>
<td style="width: 59px;"></td>
<td style="width: 500px;">
<?php if(in_array('UAL_leads',$thisPer)){?>
<input name="Button1" type="button" value="Update" class="buttonGreen" onclick="SaveData('leads/update?id=<?php echo $id;?>&i=<?php echo $i;?>','opt','<?php echo $h;?>','<?php echo $i;?>','','','2');" />&nbsp;&nbsp;
<?php } 
else if(in_array('UTL_leads',$thisPer))
{
$getLead = mysql_query("SELECT COUNT(`id`) FROM `team` WHERE `leader` = '$loggeduserid'",$con) or die(mysql_error());
	$rowLead = mysql_fetch_array($getLead);
		if($rowLead[0] > 0)
		{
		$getTeam = mysql_query("SELECT `mateid` FROM `teamamtes` WHERE `teamid` IN (SELECT `id` FROM `team` WHERE `leader` = '$loggeduserid')",$con) or die(mysql_error());
		while($rTeam = mysql_fetch_array($getTeam))
		{
		$teamArr[] .= $rTeam[0];
		}
		$teamArr[] .= $loggeduserid;
		if(in_array($row['ownerid'],$teamArr))
		{
		
?>
	<input name="Button1" type="button" value="Update" class="buttonGreen" onclick="SaveData('leads/update?id=<?php echo $id;?>&i=<?php echo $i;?>','opt','<?php echo $h;?>','<?php echo $i;?>','','','2');" />&nbsp;&nbsp;
<?php
		}

		}
}

else if(in_array('U_leads',$thisPer)){
if($row[0] == $loggeduserid)
{
?>
<input name="Button1" type="button" value="Update" class="buttonGreen" onclick="SaveData('leads/update?id=<?php echo $id;?>&i=<?php echo $i;?>','opt','<?php echo $h;?>','<?php echo $i;?>','','','2');" />&nbsp;&nbsp;
<?php } 
}
?>
<input name="Button1" type="button" value="Cancel" class="buttonnegetive" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"/>
</td>
</tr>
</table>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

</div>


