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
	$first = 1;			
	$id = $_GET['id'];
		}
	}
	else
	{
	$first = 1;
	}
	}
}



	//$getData = mysql_query("SELECT contact.*,customersupport.* FROM `contact` INNER JOIN `customersupport` ON `contact`.`id`=`customersupport`.`clientid` WHERE `contact`.`id` = '$id'",$con) or die(mysql_error());

$getData = mysql_query("SELECT * from contact WHERE contact.`id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);


$getCallingExtesion = mysql_query("SELECT employee.callingextension from employee where id='$loggeduserid'",$con) or die(mysql_error());
$callingextension = mysql_fetch_array($getCallingExtesion);



$getData = mysql_query("SELECT * FROM `customersupport` WHERE `clientid` = '$id'",$con) or die(mysql_error());
$rowUid = mysql_fetch_array($getData);


if(in_array('UAC_clients',$thisPer))
{
$allowMenu = 1;
} 
else if(in_array('UTC_clients',$thisPer))
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
else if(in_array('U_clients',$thisPer))
{
if($row[0] == $loggeduserid)
{
$allowMenu = 1;
} 
}

?>
<div class="buttonBlue" id="sideStory" style="position:fixed;right:0px;cursor:pointer;padding:5px;z-index: 2000;
    top: 400px;" onclick="getModule('noteline/index?cid=<?php echo $id;?>&name=<?php echo str_ireplace('"','',$row['fname']);?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo str_ireplace('"','',$row['fname']);?>');document.getElementById('ModalCloseButton').style.display = 'none';">Story</div>


<div class="buttonnegetive" id="sideStory" style="position:fixed;right:0px;cursor:pointer;padding:5px;z-index:2000;top:450px;" onclick="getModule('clients/requestfundlist?cid=<?php echo $id;?>&name=<?php echo str_ireplace('"','',$row['fname']);?>','manipulatemoodleContent','viewmoodleContent','Fund Request Statement For <?php echo str_ireplace('"','',$row['fname']);?>')">Pay Request</div>

<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Edit Client</td>
<td align="right" style="width:70%">
<input name="Button1" type="button" value="< Back To List" class="button" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>
</div>
<div class="form">
<table width="100%" cellpadding="0" cellspacing="10">
<tr>
<td align="right" colspan="4" style="border:0px;">
<div style="float:left;text-align:left">
<div style="display:inline-block;width:20px;vertical-align:middle;height:20px;">
<img id="hotNot" title="Hot Lead" src="images/hot-lead.png" style="<?php if($row['mark'] == '0') { ?>display:none<?php  } ?>;height:20px;vertical-align:middle;" alt=""/>
<img id="coldNot" title="Cold Lead" src="images/cold-lead.png"  style="<?php if($row['mark'] == '1') { ?>display:none<?php  } ?>;height:20px;vertical-align:middle;" alt=""/>
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
</div>
<div <?php if($row['mark'] == '0') echo  "class='pushed'"; else echo "class='pulled'" ;?>  id="coldBut"  onclick="pushLead('cold','<?php echo $id;?>')">
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

if(in_array('CO_clients',$thisPer))
{
$show =1;

}
else if(in_array('CO_cteam',$thisPer))
{

	$owner = $row['ownerid'];
	$getTeam = mysql_query("SELECT teamamtes.mateid FROM teamamtes,team WHERE team.leader = '$loggeduserid' AND team.id = teamamtes.teamid AND team.delete = '0'",$con) or die(mysql_error());
	while($rowTeam = mysql_fetch_array($getTeam))
	{
	$team[] .=$rowTeam[0]; 
	}
	
	if($team[0])
	{
	$team[] .= $loggeduserid;
	}
	//print_r($team);
	
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
Change Approval Date
<select class="input" name="approvalDate" style="width:130px" id="approvalDate">		
<option value="1">Client Conversion Date</option>
<option value="2">Booster Approval Date</option>
<option value="3">Premium Approval Date</option>
</select>
</div>

<div style="display:inline-block" class="buttonGreen" onclick="getModule('billing/changeConversionDate?cid=<?php echo $id;?>&i=<?php echo $_GET['i'];?>&header=1;&approvalDate='+document.getElementById('approvalDate').value,'manipulateContent','viewContent','Conversion Date');">Go</div>
&nbsp;&nbsp;
	
<div style="display:inline-block">
Change Owner
<select class="input" name="leadowner" style="width: 130px" id="newOwner">		
<?php
if(in_array('VA_leads',$thisPer))
{
$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' order by name asc",$con) or die(mysql_error()); 
}
else if(in_array('VA_tLeads',$thisPer))
{
$getLead = mysql_query("SELECT COUNT(`id`) FROM `team` WHERE `leader` = '$loggeduserid'",$con) or die(mysql_error());
$rowLead = mysql_fetch_array($getLead);
if($rowLead[0] > 0)
{
$getCity = mysql_query("SELECT employee.name,teamamtes.mateid FROM employee,team,teamamtes WHERE team.leader = '$loggeduserid' AND teamamtes.mateid = employee.id AND teamamtes.teamid = team.id AND team.delete = '0' AND employee.delete = '0' order by employee.name asc",$con) or die(mysql_error());
}
		else
		{
			$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `id` = '$loggeduserid' order by `name` asc",$con) or die(mysql_error()); 
		}
}
else
{
$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `id` = '$loggeduserid' order by name asc",$con) or die(mysql_error()); 
}

while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
</select>
</div>
	</select><div style="display:inline-block" class="buttonGreen" onclick="getModule('changeOwner?cid=<?php echo $id;?>&i=<?php echo $_GET['i'];?>&header=1;&owner='+document.getElementById('newOwner').value,'manipulateContent','viewContent','Clients');">Go</div>
		
&nbsp;



<?php 
//in_array('COS_clients',$thisPer)
}
	if(in_array('COS_clients',$thisPer)) { ?>
	
Change Support Owner
&nbsp;
<select class="input" name="clientowner" style="width: 143px" id="newClientOwner">			
<?php
if(in_array('VA_clients',$thisPer))
{
$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `profile`='8'  order by name asc",$con) or die(mysql_error()); 
}
else if(in_array('CA_tclients',$thisPer))
{
	$getLead = mysql_query("SELECT COUNT(`id`) FROM `team` WHERE `leader` = '$loggeduserid' AND `team`.`id`='6' order by name asc",$con) or die(mysql_error());
	$rowLead = mysql_fetch_array($getLead);
	if($rowLead[0] > 0)
	{
	$getCity = mysql_query("SELECT employee.name,teamamtes.mateid FROM employee,team,teamamtes WHERE team.leader = '$loggeduserid' AND teamamtes.mateid = employee.id AND teamamtes.teamid = team.id AND `team`.`id`='6' AND team.delete = '0' AND employee.delete = '0' AND `employee`.`profile`='8' order by employee.name asc",$con) or die(mysql_error());
	}
	else
	{
	$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `id` = '$loggeduserid' AND `employee`.`profile`='8' order by employee.name asc",$con) or die(mysql_error()); 
	}
}

else
{
$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `id` = '$loggeduserid' AND `employee`.`profile`='8' order by employee.name asc",$con) or die(mysql_error()); 
}

while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
</select>
<div style="display:inline-block" class="buttonGreen" onclick="getModule('changeClientOwner?cid=<?php echo $id;?>&i=<?php echo $_GET['i'];?>&header=1;&owner='+document.getElementById('newClientOwner').value,'manipulateContent','viewContent','Clients');">Go</div>
&nbsp;
<?php	

}
?>
</br>
<?php 
if(in_array('CRMO_clients',$thisPer)) { ?>
	
Change Relationship Manager
&nbsp;
<select class="input" name="newRMOwner" style="width:143px" id="newRMOwner">			
<option value="1">Admin</option>

<?php

$getRMName = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `employee`.`status`='1' AND `employee`.`delete`='0' AND (`profile`='11' || `profile`='16' || `profile`='19' || `profile`='28' || `profile`='29' || `profile`='30') ORDER BY `name` ASC",$con) or die(mysql_error()); 

while($rowRm = mysql_fetch_array($getRMName))
{
?>
<option value="<?php echo $rowRm[1];?>"><?php echo $rowRm[0];?></option>
<?php
}
?>
</select>
<div style="display:inline-block" class="buttonGreen" onclick="getModule('changeRmOwner?cid=<?php echo $id;?>&i=<?php echo $_GET['i'];?>&header=1;&RMOwnerid='+document.getElementById('newRMOwner').value,'manipulateContent','viewContent','Clients');">Go</div>
&nbsp;


<?php	



}

if(in_array('RBI_clients',$thisPer))  { ?>
Activate  Booster
<select class="input" name="ActivateBooster" style="width:143px" id="ActivateBooster">		
	<option value="0">Choose Booster</option>

	<option value="1">Research Pack</option>
	<option value="2">One Invest Plan</option>
	<option value="3">Reduced Brokerage</option>
</select>

<div style="display:inline-block" name="Button1" type="button" value="Activate Research Booster" class="buttonGreen" onclick="ActivateBooster('<?php echo $id;?>')">Go</div>&nbsp;
<!-- <div name="Button1" type="button" value="Activate Research Booster" class="buttonRight" onclick="ActivateBooster('<?php echo $id;?>');document.getElementById('ModalCloseButton').style.display = 'block'">Activate Research Booster</div>&nbsp;
 -->
<?php }

/* if($allowMenu == 1)
{ */ ?>


 <?php 
 if(in_array('M_C_clients',$thisPer) || in_array('M_SI_clients',$thisPer)){ ?>

 <div name="Button1" type="button" value="Activate Premium Plan" class="buttonRight" onclick="ActivatePremiumPlan('<?php echo $id;?>');document.getElementById('ModalCloseButton').style.display = 'block'">Change Brokerage Plan</div>&nbsp

 
<div name="Button1" id="ft1" class="buttonStraight" onclick="mySubmenu('1','blueStraight')" style="position:relative;" >Messages&nbsp;&nbsp;<img src="images/more.png" style="height:6px;vertical-align:middle" alt=""/>
<div id="in1" class="in" style="left:0px;">
<ul>
<?php if(in_array('M_C_clients',$thisPer)){?>
<li onclick="getModule('sms/viewSMS?clid=<?php echo $id?>','manipulatemoodleContent','viewmoodleContent','SMS List')">SMS</li>

<?php }
if(in_array('M_SI_clients',$thisPer)){?>
<li onclick="getModule('email/prenewemail?clid=<?php echo $id?>&parameter=Clients','viewmoodleContent','manipulatemoodleContent','-New Email')">Email</li>
<?php } ?>
</ul>
</div>
</div>
<?php }
if(in_array('A_NT_clients',$thisPer) || in_array('A_AS_clients',$thisPer)){?>
<div name="Button1" id="ft2" class="buttonStraight" onclick="mySubmenu('2','blueStraight')" style="position:relative;" >Activity&nbsp;&nbsp;<img src="images/more.png" style="height:6px;vertical-align:middle" alt=""/>
<div id="in2" class="in" style="left:0px;">
<ul>
<?php if(in_array('A_NT_clients',$thisPer)){?>
<li onclick="getModule('task/quickNew?cid=<?php echo $id;?>&mobile=<?php echo $row['mobile']?>','manipulatemoodleContent','viewmoodleContent','Task  For <?php echo str_ireplace('"','',$row['fname']);?>')" >New Task</li>
<?php }
if(in_array('A_AS_clients',$thisPer)){?>
<li onclick="getModule('noteline/index?cid=<?php echo $id;?>&name=<?php echo str_ireplace('"','',$row['fname']);?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo str_ireplace('"','',$row['fname']);?>')">Story</li>
<?php } ?>
</ul>
</div>
</div><?php }
if(in_array('B_SD_clients',$thisPer) || in_array('B_BI_clients',$thisPer) || in_array('B_SIC_clients',$thisPer)){?>
<div name="Button1" id="ft3"  class="buttonStraight" onclick="mySubmenu('3','blueStraight')"  style="position:relative;display:none !important" >Billing&nbsp;&nbsp;<img src="images/more.png" style="height:6px;vertical-align:middle;" alt=""/>

<div id="in3" class="in" style="left:0px;width:170px;">
<ul>
<?php if(in_array('B_SD_clients',$thisPer)){?>
<li onclick="getModule('billing/servicedetails?cid=<?php echo $id;?>&mobile=<?php echo $row['mobile']?>&name=<?php echo str_ireplace('"','',$row['fname']);?>','viewmoodleContent','manipulatemoodleContent','<?php echo str_ireplace('"','',$row['fname']);?>-Subscription Details')" >Subscription Details</li>
<?php }
if(in_array('B_BI_clients',$thisPer)) {?>
<li onclick="getModule('billing/view?cid=<?php echo $id;?>&mobile=<?php echo $row['mobile']?>&name=<?php echo str_ireplace('"','',$row['fname']);?>','viewmoodleContent','manipulatemoodleContent','<?php echo str_ireplace('"','',$row['fname']);?>-Bills')" >Billing Information</li>
<?php }
if(in_array('B_SIC_clients',$thisPer)) {?>
<li onclick="getModule('invoice/sentInvoices?cid=<?php echo $id;?>&name=<?php echo str_ireplace('"','',$row['fname']);?>','viewmoodleContent','manipulatemoodleContent','Sent Invoices')">Sent Invoices</li>
<?php } ?>
</ul>
</div>
</div>
<?php }
if(in_array('MD_clients',$thisPer)) {?>
<div name="Button1" id="ft3"  class="buttonStraight" style="display:none !important" onclick="getModule('messenger/clientSettings?cid=<?php echo $id;?>&name=<?php echo str_ireplace('"','',$row['fname']);?>','manipulatemoodleContent','viewmoodleContent','Messenger Settings')" >Communication</div>
<?php } 
/* } */?>
<br/>
<div class="button leftRound" title="View Previous Lead Of Same View" style="display:inline-block;padding:0px 5px; <?php if($first) { ?> background:#ccc; <?php } ?>"   <?php if(!$first) { ?>  onclick="changePage('clients/edit?id=<?php echo $id;?>&i=<?php echo $i;?>&expiring=<?php echo $expiring;?>','p','<?php echo $sqlid;?>','<?php echo $listid;?>')" title="View Previous Lead Of Same View" <?php } else {?> title="Reached first record of selected view" <?php } ?>><img src="images/previous.png" alt="" style="cursor:pointer;height:25px"/></div><div class="button rightRound" style="display:inline-block;padding:0px 5px; <?php if($last) { ?> background:#ccc; <?php } ?>"   <?php if(!$last) { ?>  onclick="changePage('clients/edit?id=<?php echo $id;?>&i=<?php echo $i;?>&expiring=<?php echo $expiring;?>','n','<?php echo $sqlid;?>','<?php echo $listid;?>')" title="View Next Lead Of Same View" <?php } else {?> title="Reached last record of selected view" <?php } ?>><img src="images/next.png" alt="" style="cursor:pointer;height:25px"/></div>
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


</td>
</tr>
<?php 
	$getPlan = mysql_query("SELECT `Plan` FROM `activatepremium` WHERE `cid`='$id'",$con) or die(mysql_error());
    $rowPlan = mysql_fetch_array($getPlan);
	
	if($rowPlan[0]==1)
	{
	$plan="Regular Plan";
	$style='style=height: 20px;font-size: 20px;padding-bottom: 10px;background:#f7e04a';	
	}
    else
    {
	$plan="Premium Plan";
	$style='style=height: 20px;font-size: 20px;padding-bottom: 10px;background:#3deb40';	
	}	

	?>
	<tr>

	<td colspan="4" align="center">
    <div style="<?php echo $style; ?>">
    <?php echo '<b>'.$plan.'</b>'; ?>
	</div>
   </td>
	</tr>
	
	

<tr>
	<td align="right"  style="width:208px">
	Client Owner
	</td>
	<td style="">
	<?php
	$getName = mysql_query("SELECT `name` FROM `employee` WHERE `id` = '$row[0]'",$con) or die(mysql_error());
	$rowName = mysql_fetch_array($getName);
	?>
	<input name="Text1" type="text" class="inputDisabled" value="<?php echo $rowName[0];?>" readonly="readonly" />

	<input name="Text1" type="text" id="opt0" style="display:none" class="inputDisabled" value="<?php echo $row[0];?>" readonly="readonly" />
    </td>
	
	
	
	<td align="right"  style="width:208px">
	Client Number 
	</td>
	<td style="">
	<input name="Text1" type="text" class="inputDisabled" value="<?php echo $id;?>" readonly="readonly" />
	
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	
	</td>
	
	
</tr>

<tr>
	<td align="right"  style="width:208px">
    RM Owner
	</td>
	<td style="">
	<?php
	$getRMName = mysql_query("SELECT `employee`.`name` FROM `employee` INNER JOIN `customersupport` ON `employee`.`id`=`customersupport`.`RMOwnerid` WHERE `customersupport`.`clientid`='$id'",$con) or die(mysql_error());
	$rowRMName = mysql_fetch_array($getRMName);
	?>
	<input name="Text1" type="text" class="inputDisabled" value="<?php echo $rowRMName[0];?>" readonly="readonly" />

	<input name="Text1" type="text" id="opt0" style="display:none" class="inputDisabled" value="<?php echo $row[0];?>" readonly="readonly" />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</td>
	
	<td align="right"  style="width:208px">
	Support Owner
	</td>
	
	<td style="">
	<?php 
	$sqlSup=mysql_query("SELECT teamamtes.mateid, employee.name FROM  `customersupport` 
INNER JOIN teamamtes ON customersupport.allotmentid = teamamtes.mateid
INNER JOIN employee ON teamamtes.mateid = employee.id WHERE  `customersupport`.`clientid` =  '$id'");
	$rowSup=mysql_fetch_array($sqlSup);
	?>
	
	<input name="Text1" type="text" class="inputDisabled" value="<?php echo $rowSup[1];?>" readonly="readonly" />
	
	</td>
	
</tr>

<tr>
<td align="right">Full Name *</td><td style="">
	<input class="input"  style="width:200px" name="req" type="text" id="opt1" value="<?php echo str_ireplace('"','',$row['fname']." ".$row['lname']);?>" /></td>
<!-- <td align="right" style=" width: 208px;">Last Name</td>
	<td align="left"><input class="input"  style="width: 200px"  type="text" id="opt2" value="<?php // echo $row['lname']?>" /></td>   -->

	<td align="right">BO Client Owner</td>
    <td style="">
    <input class="input"  style="width:200px" type="text" id="opt2"  readonly value="<?php echo $rowUid['BOClientOwner']; ?>" />
	</td>
    </tr>

    <tr>
    <td align="right">Client Code *</td>
	<td style="">
	<?php $code = str_ireplace("TB","",$row['code']);?>
	<span class="clientcodeinput">TB<input type="text" readonly name="req" id="opt3" class="" value="<?php echo $code;?>" onKeyPress="if(this.value.length==5) return false;"></span>
	</td>
	<td align="right" style=" width:208px;">Introducer Client Code</td>
	<td align="left">
	<div style="position:relative">
	<input class="input introducerclientcode" readonly="readonly" style="width: 200px" name="text1"  type="text" id="opt4" onblur="CheckIntroducer('opt4','<?php echo $row['id'];?>','ccav01')" value="<?php echo $row['inroducer']?>" />
	<div id="ccav01" title="Mobile Number" style="position:absolute;top:30px;"></div>
	</div>
	</td>
</tr>


<?php if(in_array('show_mobile',$thisPer)) { ?>
<tr>
	<td align="right" style=" ;">Mobile  *</td>
	<?php if(in_array('MNU_clients',$thisPer))
	{
	?>
	<td align="left" style=""><input class="input"  style="width: 200px" name="req" maxlength="10" type="text" id="opt5" value="<?php echo substr($row['mobile'], 0, 0) . 'XXXXXXX' . substr($row['mobile'],  -3);?>" />  &nbsp;&nbsp;   <a Onclick="CallApi('<?php echo $callingextension[0] ?>','<?php echo $row["mobile"] ?>');" class="blueSimpletext clickto">Click to call</a>  </td>
	<?php } 
	else
	{
	?>
	<td align="left" style=""><input class="input"  style="width: 200px" name="req" maxlength="10" type="text" id="opt5" value="<?php echo substr($row['mobile'], 0, 0) . 'XXXXXXX' . substr($row['mobile'],  -3);?>" readonly="readonly" />   &nbsp;&nbsp;  <a Onclick="CallApi('<?php echo $callingextension[0] ?>','<?php echo $row["mobile"] ?>');" class="blueSimpletext clickto">Click to call</a>  </td>
	<?php
	}
	?>
	
	 <td align="right">Alternate Mobile </td>
     <td style="">
     <input class="input" style="width:200px" type="text" id="opt34" value="<?php echo substr($rowUid['AlternativeMobile'], 0, 0) . 'XXXXXXX' . substr($rowUid['AlternativeMobile'],  -3);?>"/> 
     </td> 
</tr>

<tr>
<td align="right">BO Mobile 1</td>
<td style="">
<input class="input"  style="width: 200px"  readonly type="text" id="opt7" value="<?php echo substr($row['phone'], 0, 0) . 'XXXXXXX' . substr($row['phone'],  -3);?>" /></td>

<td align="right" style=" width: 208px;">BO Mobile 2</td>
<td align="left"><input class="input"  style="width: 200px" readonly  type="text"  value="<?php echo substr($rowUid['BoMobileNumber2'], 0, 0) . 'XXXXXXX' . substr($rowUid['BoMobileNumber2'],  -3);?>
" /></td>

</tr> 
<?php } ?>


    <?php if(in_array('show_email',$thisPer)) { ?>

	<tr>
    <td align="right">Email *</td><td align="left" style="width: 303px"><input class="input"  style="width: 200px" name="REQ" type="text" id="opt6" value="<?php echo $row['email'];?>"/></td>
	<td align="right" style=" width: 208px;">BO Email</td>
    <td align="left"><input class="input"  style="width: 200px" readonly  type="text" id="opt8" value="<?php echo $row['altemail']?>" /></td>
    </tr>
    <?php } ?>
    <tr>

	<td align="right">BO Account Opening Date </td>
    <td style="">
    <input class="input"  style="width: 200px"  readonly type="text" id="" value="<?php echo date ('d/m/Y',strtotime($rowUid['BOAccountOpeningDate']));?>" />
    </td>
    </tr>
    <tr>
	<td align="right" style="">Date of Birth</td><td align="left"><input class="input" style="width: 200px" type="date" id="opt9" value="<?php echo $row['dob'];?>" /></td>

	<td align="right" style="display:none">Trader Profile</td>
	<td align="left" style="display:none">

<select  class="input" style="width: 200px" id="opt10">
				
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
<div class="buttonBlue" style="position:fixed;right:0px;cursor:pointer;padding:5px;" onclick="getModule('noteline/index?cid=<?php echo $id;?>&name=<?php echo str_ireplace('"','',$row['fname']);?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo str_ireplace('"','',$row['fname']);?>')">Story</div>
</div>


</td>
<td align="right" style="display:none">Trader's Experience</td>
<td align="left" style="width: 303px;display:none">

<select class="input" name="" style="width: 200px" id="opt11">
				
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
	<td align="right" style="display:none">Investment Amount</td>
	<td align="left" style="width: 303px;display:none">

<select class="input" name="" style="width: 200px" id="opt12">
				
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

	<td align="right" style="display:none" valign="top">Website</td><td align="left" valign="top" style="display:none"><input class="input"  style="width: 200px" name="text1" type="text" id="opt13" value="<?php echo $row['website'];?>" /></td>
    <td align="right" style="" valign="top">Status  *</td>
	<td id="teamUsers">
    <select style="width: 200px" name="req" title="isNotNull" class="input" onchange="addToteam(this.value,'opt14')">
			<option value="">Select Status</option>
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
			<div style="padding:5px;" id="selectTeam">
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
<div class="teamMate" id="team<?php echo $val;?>"><?php echo $lstArray[$val];?>&nbsp;&nbsp;&nbsp;<span style="cursor:pointer" onclick="removeTeam('<?php echo $val;?>','opt14')">x</span></div>
<?php
}
}		
?>				

		</div>
			<input name="Text1" type="text" value="<?php echo $valPut;?>" id="opt14" style="display:none" />

</td>
	</tr>
<tr>
	<td align="right" style="; ;">Source  *</td>
	<td align="left" style="">

<select  class="input leadsourcedropdown" name="req" title="isNotNull" style="width: 200px" id="opt15"  <?php if($perm != '1') echo "disabled"; ?>>
				
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
<td align="right" style="">Response  *</td>
	<td align="left" style="; width: 303px;">

<select class="input" name="req" title="isNotNull" style="width:200px" id="opt16">
				
<?php
$getLatestResponse = mysql_query("SELECT `name`,`id` FROM `leadresponse` WHERE `delete` = '0' AND (`display` = '2' OR `display` = '0') ORDER BY `order` ASC",$con) or die(mysql_error()); 
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
	<td align="right" style="height: 32px">Call Back Date</td>
	<!-- <td align="left" style="height: 32px"><input class="input" style="width: 200px" type="date" id="opt17" value="<?php if($row['callbackdate']!='0000-00-00' || $row['callbackdate']!='1970-01-01') { echo date("Y-m-d", strtotime($row['callbackdate']));  } else {  echo date('Y-m-d') ; }?>" /></td> -->
	<td align="left" style="height: 32px"><input class="input" style="width: 200px" type="date" id="opt17" value="<?php if($row['callbackdate']=='0000-00-00' || $row['callbackdate']=='' || $row['callbackdate']=='1970-01-01') { echo date('Y-m-d');} else {  echo date("Y-m-d", strtotime($row['callbackdate']));}?>" /></td> 
	
	<td align="right" style="height: 32px">Call Back Time</td>
	<td align="left" style="height: 32px"><input class="input" style="width: 200px" type="time" id="opt18" value="<?php if($row['callbacktime'] != '00:00:00'){ echo $row['callbacktime']; } else { echo "00:00:00" ; } ?>" /></td>
</tr>
<tr>
	<td align="right" style=";display:none">Language</td>
	<td align="left" style="display:none">

<select  class="input" style="width: 200px" id="opt19">
				
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
	<td align="right" style="height: 32px;display:none">Messenger ID</td>
	<td align="left" style="width: 303px; height: 32px;display:none"><input class="input"  style="width: 200px" name="" type="text" id="opt20" value="<?php echo $row['messengerid'];?>"/></td>

</tr>
<tr>
		<td align="right" valign="top" style="height: 31px;display:none">
		Services
		</td>
		<td colspan="3" style="display:none">
      	<table cellpadding="0" cellspacing="5">
	    <tr>
		<?php
		$h=22;
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
<?php echo 'opt'.$h;?>
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
</table>
</td>
</tr>
<tr>
<td align="right" valign="top" style="height:21px;">
Ledger Balance</td>
<td>
<input name="Text1" type="text" class="inputDisabled" value="<?php echo $rowUid['LedgerBal'];   ?>" readonly="readonly" />
</td>

<td align="right" valign="top" style="height:21px;">
First Trade Date</td>&nbsp;
<td>
<?php if(in_array('AD_FTD',$thisPer)){?>	
<input name="Text" type="text"  value="<?php echo $row['firstTradeDate'];?>" id="opt21"  />
<?php }else{ ?>
<input name="Text" type="text"  value="<?php echo $row['firstTradeDate'];?>" id="opt21" readonly="readonly" />
<?php }?>
</td>
</tr>
</table>

            <!--  <div class="moduleHeading">
		    <table  width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="2" style="width:100%;border:0px;">
			    Brokerage Details
				</td>
				<td>
				</td>
			    </tr>
		        </table>
	            </div>  
			 -->	
			    <?php 
		     //    $code=$row['code'];
		     //    $getWeek=mysql_query("SELECT * FROM `expensereport` WHERE `Clientid`='$code' AND `UploadingDate` BETWEEN '$initial' AND '$final'",$con) or die(mysql_error());
		     //    $weekCount=mysql_num_rows($getWeek);
			    // ?>
				
			 	<!-- <tr>
				<table border="1" align="center" height="auto" style="text-align:center;border-collapse: collapse;border: 1px solid #ddd;"  width="1170px">
				<tr height="50px"><td colspan='26' align="center"><b>Current Week Brokerage (<?php echo date("d M, Y",strtotime($initial)) ." To ".date("d M, Y",strtotime($final)) ?>) </b></td></tr>
				<tr height="30px"> 	
				<?php 
			    while($rowWeek=mysql_fetch_array($getWeek))
			    {  ?>
                <td><b><?php echo date("d M, Y",strtotime($rowWeek['UploadingDate']))  ?></b></td>
				<?php  	 }   ?>
				<?PHP if($weekCount==0) {  echo "<td colspan='8'></td>"; }    ?>
				</tr>
				
				
				<tr height="20px">
				<?php 
				$getWeek=mysql_query("SELECT * FROM `expensereport` WHERE `Clientid`='$code' AND `UploadingDate` BETWEEN '$initial' AND '$final'",$con) or die(mysql_error());
			    while($rowWeekBro=mysql_fetch_array($getWeek))
			    {  ?>
				<td><?php echo ($rowWeekBro['RevenueGeneration']+$rowWeekBro['BrokeragePremium'])  ?></td>
				
				<?php  	 }   ?>
				<?PHP if($weekCount==0) {  echo "<td colspan='8'> Inactive In Current Week </td>";       }   ?>
				</tr>
				
				
				<?php  
				$getCurrWeek=mysql_query("SELECT (SUM(RevenueGeneration)+SUM(BrokeragePremium)) as `totalbrokerage` FROM `expensereport` WHERE `Clientid`='$code' AND `UploadingDate` BETWEEN '$initial' AND '$final'",$con) or die(mysql_error());
				$CurrweekCount=mysql_fetch_array($getCurrWeek);
				
				
				$initialWeek1 = date("Y-m-d 00:00:00", strtotime("-7 day",strtotime($initial)));	
                $finalWeek1 = date("Y-m-d 23:59:59", strtotime("-7 day",strtotime($final)));	
				
				$getCurrWeek1=mysql_query("SELECT (SUM(RevenueGeneration)+SUM(BrokeragePremium)) as `totalbrokerage` FROM `expensereport` WHERE `Clientid`='$code' AND `UploadingDate` BETWEEN '$initialWeek1' AND '$finalWeek1'",$con) or die(mysql_error());
				$CurrweekCount1=mysql_fetch_array($getCurrWeek1);
				
				
				$initialWeek2 = date("Y-m-d 00:00:00", strtotime("-14 day",strtotime($initial)));	
                $finalWeek2 = date("Y-m-d 23:59:59", strtotime("-14 day",strtotime($final)));	
				
				$getCurrWeek2=mysql_query("SELECT (SUM(RevenueGeneration)+SUM(BrokeragePremium)) as `totalbrokerage` FROM `expensereport` WHERE `Clientid`='$code' AND `UploadingDate` BETWEEN '$initialWeek2' AND '$finalWeek2'",$con) or die(mysql_error());
				$CurrweekCount2=mysql_fetch_array($getCurrWeek2);
				
				
				$initialWeek3 = date("Y-m-d 00:00:00", strtotime("-21 day",strtotime($initial)));	
                $finalWeek3 = date("Y-m-d 23:59:59", strtotime("-21 day",strtotime($final)));

                $getCurrWeek3=mysql_query("SELECT (SUM(RevenueGeneration)+SUM(BrokeragePremium)) as `totalbrokerage` FROM `expensereport` WHERE `Clientid`='$code' AND `UploadingDate` BETWEEN '$initialWeek3' AND '$finalWeek3'",$con) or die(mysql_error());
				$CurrweekCount3=mysql_fetch_array($getCurrWeek3);
								

				?>
				
				<tr height="50px"><td colspan='8' align="center"><b>Previous Four Week Brokerage</b></td></tr>
				<tr height="30px"><th><?php echo date("d M, Y",strtotime($initial)) ." To ".date("d M, Y",strtotime($final)) ?> </th><th><?php echo date("d M, Y",strtotime($initialWeek1)) ." To ".date("d M, Y",strtotime($finalWeek1)) ?></th><th><?php echo date("d M, Y",strtotime($initialWeek2)) ." To ".date("d M, Y",strtotime($finalWeek2)) ?></th><th><?php echo date("d M, Y",strtotime($initialWeek3)) ." To ".date("d M, Y",strtotime($finalWeek3)) ?></th><th>Sum</th></tr>
                <tr height="20px"><td><?php echo round($CurrweekCount[0]) ?></td><td><?php echo round($CurrweekCount1[0])  ?></td><td><?php echo round($CurrweekCount2[0])  ?></td><td><?php echo round($CurrweekCount3[0])  ?></td><td><b><?php echo round($CurrweekCount[0]+$CurrweekCount1[0]+$CurrweekCount2[0]+$CurrweekCount3[0]) ?></b></td></tr>               
                
				
				<?php 
				$getMon=mysql_query("SELECT (SUM(RevenueGeneration)+SUM(BrokeragePremium)) as `totalbrokerage` FROM `expensereport` WHERE `Clientid`='$code' AND `UploadingDate` BETWEEN '$initialmon' AND '$finalmon'",$con) or die(mysql_error());
				$CurrMonCount=mysql_fetch_array($getMon);
				
				
				$initialMon1 = date("Y-m-d", strtotime("-26 day",strtotime($initialmon)));	
                
				$getMonthDate1=mysql_query("SELECT `fromdate`,`todate` FROM `targetrange` WHERE '$initialMon1' BETWEEN `fromdate` AND `todate`",$con) or die(mysql_error());
				$rowMonthDate1=mysql_fetch_array($getMonthDate1);
				
				$getMon1=mysql_query("SELECT (SUM(RevenueGeneration)+SUM(BrokeragePremium)) as `totalbrokerage` FROM `expensereport` WHERE `Clientid`='$code' AND `UploadingDate` BETWEEN '$rowMonthDate1[0]' AND '$rowMonthDate1[1]'",$con) or die(mysql_error());
				$CurrMonCount1=mysql_fetch_array($getMon1);
				
				$initialMon2 = date("Y-m-d", strtotime("-55 day",strtotime($initialmon)));	
              
				$getMonthDate2=mysql_query("SELECT `fromdate`,`todate` FROM `targetrange` WHERE '$initialMon2' BETWEEN `fromdate` AND `todate`",$con) or die(mysql_error());
				$rowMonthDate2=mysql_fetch_array($getMonthDate2);
			
			  
				$getMon2=mysql_query("SELECT (SUM(RevenueGeneration)+SUM(BrokeragePremium)) as `totalbrokerage` FROM `expensereport` WHERE `Clientid`='$code' AND `UploadingDate` BETWEEN '$rowMonthDate2[0]' AND '$rowMonthDate2[1]'",$con) or die(mysql_error());
				$CurrMonCount2=mysql_fetch_array($getMon2);
				
				
				?>
				
				
				<tr height="50px"><td colspan='8' align="center"><b>Last Three Month Brokerage</b></td></tr>
				<tr height="30px"><th><?php echo date("d M, Y",strtotime($initialmon)) ." To ".date("d M, Y",strtotime($finalmon)) ?></th><th><?php echo date("d M, Y",strtotime($rowMonthDate1[0])) ." To ".date("d M, Y",strtotime($rowMonthDate1[1])) ?></th><th><?php echo date("d M, Y",strtotime($rowMonthDate2[0])) ." To ".date("d M, Y",strtotime($rowMonthDate2[1])) ?></th><th colspan="2">Sum</th></tr>
                <tr height="20px" ><td><?php echo round($CurrMonCount[0]) ?></td><td><?php echo round($CurrMonCount1[0]) ?></td><td><?php echo round($CurrMonCount2[0]) ?></td><td colspan="2"><b><?php echo round($CurrMonCount[0]+$CurrMonCount1[0]+$CurrMonCount2[0]) ?></b></td></tr>               
                  
				<?php 
				$getData=mysql_query("SELECT `noteline`.`createdate`,max(`noteline`.`id`) FROM `contact` INNER JOIN `noteline` ON `contact`.`id`=`noteline`.`cid` WHERE `contact`.`code`='$code' AND `noteline`.`subject`='Oship' AND `noteline`.`RandomAssignments`='1'",$con) or die(mysql_error());
                $rowDate=mysql_fetch_array($getData);

                if($rowDate[0]=='')
				{
				$AllotedDate=strtotime($datetime);	
				}
                else
				{					
				$AllotedDate=strtotime($rowDate[0]);	
		        } 		

		        $FirstMonth=$AllotedDate+2592000;
				$SecondMonth=$AllotedDate+5184000;
				$ThirdMonth=$AllotedDate+7776000;  
				?>
				
				
				</table>				
				</tr>
				 -->
				
<!-- 			    <div class="moduleHeading">
		        <table  width="100%" cellpadding="0" cellspacing="0">
			    <tr>
				<td colspan="2" style="width:100%;border:0px;">
			    Booster Details
				</td>
				<td>
				</td>
			    </tr>
		        </table>
	            </div>
	            </br></br>
				
				
	        	<tr>
				<table border="1" align="center" height="auto" style="text-align:center;border-collapse: collapse;border: 1px solid #ddd;"  width="1170px">
				<tr height="50px"><td colspan="7" align="center"><b>Booster Activation Details </b></td></tr>
				<tr height="30px">
				<th>Segments</th>
				<th>Amount Paid</th>
				<th>Research/Research+</th>
				<th>Start Date</th>
				<th>End Date</th>
	         	<th>Date Of Activation</th>
				<th>Service </th>
				</tr>
				<?php 
				

				
				$getBooster=mysql_query("SELECT Segments,Activationamt,ResearchPlus,StartDate,EndDate,ApprovalDate,service FROM `researchbooster` WHERE `cid`='$id' AND `Approved`='2'",$con) or die(mysql_error()); 
				if(mysql_num_rows($getBooster)>0)
				{
				while($rowBooster=mysql_fetch_array($getBooster))
				{
				$segment = array('1'=>'Commodity','2'=>'Future','3'=>'Option','4'=>'Equity');
				
				$segmentlist = '';
                $lst = explode(",",$rowBooster['Segments']);
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
				?>
			    <tr height='20px'>
				<td><?php echo  $segmentlist ?></td>
				<td><?php echo  $rowBooster[1] ?></td> 
				<td><?php if($rowBooster[2]==1){  echo 'Research'; } else {  echo 'Research+';   }  ?></td>
				<td><?php echo date('d M, Y', strtotime($rowBooster[3])); ?></td>
				<td><?php echo date('d M, Y', strtotime($rowBooster[4])); ?></td>
				<td><?php echo date('d M, Y', strtotime($rowBooster[5])); ?></td>
				<td><?php if($rowBooster[6]==1){  echo 'Premium Service'; } else {  echo 'FREE Trail';   } ?></td>
				</tr>  
				
			    <?php
				}
				}
				else
				{
				echo "<tr height='50px'><td colspan='7' align='center'> No Details Has Been Found </td></tr>";	
				}
				?>
				
				</table>				
				</tr>
 -->
                

                <div class="moduleHeading">
		        <table  width="100%" cellpadding="0" cellspacing="0">
			    <tr>
				<td colspan="2" style="width:100%;border:0px;">
			    Reduced Brokerage Details
				</td>
				<td>
				</td>
			    </tr>
		        </table>
	            </div>
	            <br>
                <br>
	            

				<tr>
				<table border="1" align="center" height="auto" style="text-align:center;border-collapse: collapse;border: 1px solid #ddd;"  width="1170px">
				<tr height="50px"><td colspan="7" align="center"><b>Reduced Brokerage Details </b></td></tr>
				<tr height="30px">
                <th> Activation Amount</th> 
                <th>Bonus Amount</th>
                <th>Validity</th> 
                <th>Start Date</th>
                <th>End Date</th>
                <th>Approved Date</th>
				</tr>
				<?php 
				

				
				$getreducedBooster=mysql_query("SELECT activationAmount,BonusAmount,validity,StartDate,EndDate,ApprovalDate FROM `reduced_brokerage` WHERE `cid`='$id' AND `Approved`='2'",$con) or die(mysql_error()); 
				if(mysql_num_rows($getreducedBooster)>0)
				{
				while($rowreducedBrokerage=mysql_fetch_array($getreducedBooster))
				{
				?>
			    <tr height='20px'>
				<td><?php echo $rowreducedBrokerage[0]; ?></td>
				<td><?php echo $rowreducedBrokerage[1]; ?></td> 
				<td><?php echo $rowreducedBrokerage[2]; ?></td>
				<td><?php echo date('d M, Y', strtotime($rowreducedBrokerage[3])); ?></td>
				<td><?php echo date('d M, Y', strtotime($rowreducedBrokerage[4])); ?></td>
				<td><?php echo date('d M, Y', strtotime($rowreducedBrokerage[5])); ?></td>
				</tr>  
				
			    <?php
				}
				}
				else
				{
				echo "<tr height='50px'><td colspan='7' align='center'> No Details Has Been Found </td></tr>";	
				}
				?>
				
				</table>				
				</tr>	
				

                <div class="moduleHeading">
		        <table  width="100%" cellpadding="0" cellspacing="0">
			    <tr>
				<td colspan="2" style="width:100%;border:0px;">
			    
				</td>
				<td>
				</td>
			    </tr>
		        </table>
	            </div>
	            <br>
                <br>
	            

				<tr>
				<table border="1" align="center" height="auto" style="text-align:center;border-collapse: collapse;border: 1px solid #ddd;"  width="1170px">
				<tr height="50px"><td colspan="7" align="center"><b>Funds Pay In Pay Out Details </b></td></tr>
				<tr height="30px">
                <th>Date</th> 
                <th>Debit</th>
                <th>Credit</th>
                <th>Net Funds</th>
                <th>Cumulative Balance</th>
			    <!-- 	
			   <th>Cummulative</th>
			    -->
			   </tr>
				<?php 
				
//                 SELECT TradeDate, SUM( Credit ) AS credit, SUM( Debit ) AS debit,COALESCE( (
// SUM(Credit) - SUM(Debit)),0) AS netfunds,((credit - debit)+ netfunds) AS cummulite
// FROM payinpayoutlogs
// WHERE code = 'TB0017'
// GROUP BY TradeDate
				
				$cumulative=0;
				$i=1;
				$getPayInPayoutdetails=mysql_query("SELECT TradeDate, SUM( Credit ) AS credit, SUM( Debit ) AS debit, (SUM( Credit ) - SUM( Debit )) AS netfunds,cumulative
FROM payinpayoutlogs WHERE code = '".$row['code']."' GROUP BY TradeDate",$con) or die(mysql_error()); 
				if(mysql_num_rows($getPayInPayoutdetails) > 0)
				{
				while($PayInPayoutdetails=mysql_fetch_array($getPayInPayoutdetails))
				{
				$credit= $PayInPayoutdetails[1];
				$debit = $PayInPayoutdetails[2];
                
                if($i==1)
                {
				$cumulative += (($credit-$debit)+0);
                }
                else
                {
				$cumulative += (($credit-$debit)+$PayInPayoutdetails[3]);
                } 
				?>
			    <tr <?php if($PayInPayoutdetails[3] < 0) { echo 'style="color:red"';} ?>
			    height='20px'>
				<td><?php  echo date('d-M-Y',strtotime($PayInPayoutdetails[0])); ?></td>
				<td><?php  echo number_format($PayInPayoutdetails[2], 0, ".", ","); ?></td>
				<td><?php  echo number_format($PayInPayoutdetails[1], 0, ".", ","); ?></td>
				<td><?php  echo number_format($PayInPayoutdetails[3], 0, ".", ","); ?></td>
        		<td><?php  echo number_format($cumulative, 0, ".", ",");  ?></td>
        		</tr>  
				
			    <?php
				}
				$i++;
				}
				else
				{
				echo "<tr height='50px'><td colspan='7' align='center'> No Details Has Been Found </td></tr>";	
				}
				?>
				
				</table>				
				</tr>	

<!-- <div class="moduleHeading">
	<table  width="100%" cellpadding="0" cellspacing="0">
	<tr>
	<td colspan="2" style="width:100%;border:0px;">
		Pay In Pay Out
	</td>
	<td>
	</td>
	</tr>
	</table>
	</div>
	</br></br>

	<tr>
	<table border="1" align="center" height="auto" style="text-align:center;border-collapse: collapse;border: 1px solid #ddd;"  width="1170px">
	<tr height="50px"><td colspan="12" align="center"><b>Pay In Pay Out Details </b></td></tr>
	<tr height="30px">
		<th>Trade Date</th>
		<th>Pay In/ Pay Out</th>
		<th>Amount</th>
	</tr>
	<?php 
$getPayOut = mysql_query("SELECT `payinpayoutlogs`.`TradeDate`,`payinpayoutlogs`.`Credit`,`payinpayoutlogs`.`Debit`,`payinpayoutlogs`.`code` FROM `payinpayoutlogs` INNER JOIN `contact` ON `payinpayoutlogs`.`code`=`contact`.`code` WHERE contact.id = '$id' order by `payinpayoutlogs`.`TradeDate` desc limit 10");
//$getPayOut=mysql_query("SELECT `employee`.`name` AS ownerName,`contact`.`fname`,`contact`.`lname` FROM `contact` INNER JOIN employee ON `contact`.`ownerid`=`employee`.`id` where contact.id = $id",$con) or die(mysql_error());

while($row1=mysql_fetch_array($getPayOut))
{
$code=$row1['code'];	
$debit = $row1['Debit'];
$credit = $row1['Credit'];
	
?>
<tr>
<td><?php echo $row1['TradeDate'] ?></td>
<td><?php if($debit != 0){
	echo "PayOut";
}else if($credit != 0){
	echo "PayIn";
}?></td>
<td><?php if($debit != 0){
	echo $row1['Debit'];
}else if($credit != 0){
	echo $row1['Credit'];
}?></td>
</tr>
<?php 
}
	?>

	</table>				
	</tr> -->


 <div class="moduleHeading">
		<table  width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="2" style="width:100%;border:0px;">
					Address Details
				</td>
				<td>
				</td>
			</tr>
		</table>
	</div>
<table  width="100%" cellpadding="0" cellspacing="10">
<tr>
	<td align="right" valign="top" style="width:208px">Address *</td>
	<td>
		<?php
		$add = str_ireplace("<br/>","\r\n",$row['address']);
		?>
		
	<textarea name="req" id="<?php echo 'opt'.$h;?>" class="input"  style="width: 700px;height:35px;"><?php echo str_ireplace("\\","'",$add);?></textarea>
	<?php $h++ ;?>
	</td>
</tr>
<tr>
	<td align="right" valign="top" style="width:208px">Address Optional -1</td>
	<td>
		<?php
		$add = str_ireplace("<br/>","\r\n",$rowUid['address2']);
		?>
		<textarea name="req" id="" class="input"  style="width: 700px;height:35px;"><?php echo str_ireplace("\\","'",$add);?></textarea>
	</td>
</tr>

<tr>
	<td align="right" valign="top" style="width:208px">Address Optional -2</td>
	<td>
		<?php
		$add = str_ireplace("<br/>","\r\n",$rowUid['address3']);
		?>
		<textarea name="req" id="" class="input"  style="width: 700px;height:35px;"><?php echo str_ireplace("\\","'",$add);?></textarea>
	</td>
</tr>

<tr>
<td align="right">State</td>
<td colspan="" align="left" style="">
<input type="text" class="input" readonly id="state" class="input" value="<?php echo $row['state']; ?>" >
</td>

</tr>
<tr>
<td align="right">
City
</td>
<td>
<input type="text" class="input" readonly id="state" class="input" value="<?php echo $row['city']; ?>" >
</td>
</tr>




	<tr>
	<td align="right" valign="top" style="">Description</td>
	<td>
	<?php 
	$desc = str_ireplace("<br/>","\r\n",$row['description']);
	?>
	<textarea name="TextArea2" id="<?php echo 'opt'.$h;?>" class="input"  style="width: 700px;height:110px;" ><?php echo str_ireplace("\\","'",$desc);?></textarea>
    <?php $h++ ;?>
	
	</td>
	</tr>
</table>
	<div class="moduleHeading">
		<table  width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="2" style="width:100%;border:0px;">
					Bank Information
				</td>
				<td>
					<?php //echo '<pre>';print_r($row);die;?>
				</td>
			</tr>
		</table>
	</div>
		<table  width="100%" cellpadding="0" cellspacing="10">
		<tr>
			<td align="right" style="">
				PAN Card Number *
			</td>
			<td >
			<input type="text" name="req" id="<?php echo 'opt'.$h;?>" class="input" value="<?php echo $row['pancardnumber']; ?>" >
			<?php $h++ ;?>
	
			</td>
			
			<td align="right" style="">
			Uid Number *
			</td>
			<td >
			<input type="text" name="req" id="<?php echo 'opt'.$h;?>" class="input" value="<?php echo $row['uidnumber']; ?>" >
	        <?php $h++ ;?>
		    </td>
				
			
			
		</tr>
		<tr>
			<td align="right" style="">
				Bank Name *
			</td>
			<td >
			
				<input type="text" name="req" id="<?php echo 'opt'.$h;?>" class="input" value="<?php echo $row['bankname']; ?>">
				<?php $h++ ;?>
			</td>
			<td align="right" style="">
				Bank Branch Name *
			</td>
			<td >
				<input type="text" name="req" id="<?php echo 'opt'.$h;?>" class="input" value="<?php echo $row['bankbranchname']; ?>">
            	<?php $h++ ;?>
      		
		</td>
		</tr>
		
		<tr>
			<td align="right" style="">
				Account Type *
			</td>
			<td >
				<input type="text" name="req" id="<?php echo 'opt'.$h;?>" class="input" value="<?php echo $row['bankaccounttype']; ?>">		
			<?php $h++ ;?>
			</td>
			<td align="right" style="">
				Account Number *
			</td>
			<td >
				<input type="text" name="req" id="<?php echo 'opt'.$h++;?>" class="input" value="<?php echo $row['bankaccountnumber']; ?>">		
			</td>
		</tr>		
		
	
	</table>

	<div class="moduleHeading">
		<table  width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="2" style="width:100%;border:0px;">
					NSE DP Information
				</td>
				<td>
				</td>
			</tr>
		</table>
	</div>
		<table  width="100%" cellpadding="0" cellspacing="10">
		
		<tr>
			<td align="right" style="">
				DP Name *
			</td>
			<td >
				<input type="text" name="req" id="<?php echo 'opt'.$h;?>" class="input" value="<?php echo $row['dpname']; ?>">
				<?php $h++ ;?>
			</td>
			<td align="right" style="">
				DP ID *
			</td>
			<td >
				<input type="text" name="req" id="<?php echo 'opt'.$h;?>" class="input" value="<?php echo $row['dpid']; ?>">
			<?php $h++ ;?>
			</td>
		</tr>
		
		<tr>
			<td align="right" style="">
				Client ID *
			</td>
			<td >
				<input type="text" name="req" id="<?php echo 'opt'.$h;?>" class="input" value="<?php echo $row['clientid']; ?>">		
			<?php $h++ ;?>
			</td>
			
		
		</tr>		
		
	
	</table>

	<div class="moduleHeading">
		<table  width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="2" style="width:100%;border:0px;">
					Client conversion detail
				</td>
				<td>
				</td>
			</tr>
		</table>
	</div>
	<table  width="100%" cellpadding="0" cellspacing="10">
		<tr>
			<td align="right" style="">
				Comments *
			</td>
			<td >
				<textarea name="" id="" class="input" style="width: 500px;height:110px;" disabled>
				<?php echo trim($row['comments']); ?>
				</textarea>		
			</td>
		</tr>
		<tr>
			<td align="right" style="">
				KYC Method *
			</td>
			<td >
				<select class="input" name="" style="width: 130px" id="" disabled>
					<option value="0" <?php if($row['kycmethod'] == 0) { echo "selected";}?>>Please select </option>
					<option value="1" <?php if($row['kycmethod'] == 1) { echo "selected";}?>>Physical KYC </option>
					<option value="2" <?php if($row['kycmethod'] == 2) { echo "selected";}?>>E-KYC</option>
				</select>		
			</td>
		</tr>
		<tr>
			<td align="right" style="">
				Demat account requied *
			</td>
			<td >
				<select class="input" name="" style="width: 130px" id="" disabled>
					<option value="0" <?php if($row['demataccountrequied'] == 0) { echo "selected";}?>>Please select </option>
					<option value="1" <?php if($row['demataccountrequied'] == 1) { echo "selected";}?>>Yes </option>
					<option value="2" <?php if($row['demataccountrequied'] == 2) { echo "selected";}?>>No</option>
				</select>		
			</td>
		</tr>		
		<tr>
			<td align="right" style="">
				Segment *
			</td>
			<td id="teamUsers">
				<?php
				$SegmentArray = array("1"=>"Equity","2"=>"Equity Derivatives","3"=>"Currency Derivatives","4"=>"Commodity Derivatives");
				?>
				<!--select name="req" class="input" onchange="addToteam(this.value,'')" disabled>
					<option value="">Select Segment</option>
					<option value="1**Equity">Equity</option>
					<option value="2**Equity Derivatives">Equity Derivatives</option>
					<option value="3**Currency Derivatives">Currency Derivatives</option>
					<option value="4**Commodity Derivatives">Commodity Derivatives</option>
				</select>
				<span id="reselect"></span-->
				<div style="padding:5px;" id="selectTeam">
					<?php
					$lst = $row['segment'];
					$lst = explode(",",$lst);
					foreach($lst as $val) {
						$valPut .= $val.",";
						$val = str_ireplace("-","",$val);
						$val = trim($val);
						if($val != '') {
						?>
							<div class="teamMate" id="team<?php echo $val;?>"><?php echo $SegmentArray[$val];?>&nbsp;&nbsp;&nbsp;</div>
						<?php
						}
					}		
					?>				

				</div>						
				<input name="" type="text" value="" id="" style="display:none" />
			</td>
		</tr>	
		<tr>
			<td align="right" style="">
				Account opening charges  *
			</td>
			<td >
				<select class="input" name="" style="width: 215px" id="" disabled>
					<option value="1" <?php if($row['accountopening'] == 1) { echo "selected";}?>>Paid </option>
					<option value="2" <?php if($row['accountopening'] == 2) { echo "selected";}?>>To be cut from margin </option>
				</select>		
			</td>
		</tr>
		<tr>
			<td align="right" style="">
				Account opening charge amount *
			</td>
			<td >
				<input type="text" name="" id="" class="input" value="<?php echo $row['accountopeningamount']; ?>" disabled>		
			</td>
			
		
		</tr>
		<tr>
			<td align="right" style="">
				Account opening charge reffernce no. *
			</td>
			<td >
				<input type="text" name="" id="" class="input" value="<?php echo $row['accountopeningreffno']; ?>" disabled>		
			</td>
			
		
		</tr>
		<tr>
			<td align="right" style="">
				In Person Verification
			</td>
			<td >
				<select class="input" name="req" style="width: 215px" id="" <?php if($row['personverification'] > 1) {?> disabled <?php } ?>>
					<option value="0" <?php if($row['personverification'] == 0) { echo "selected";}?>>Please select </option>
					<!--<option value="1" <?php if($row['personverification'] == 1) { echo "selected";}?>>Not done </option>-->
					<option value="2" <?php if($row['personverification'] == 2) { echo "selected";}?>>Done </option>
					<option value="3" <?php if($row['personverification'] == 3) { echo "selected";}?>>Not required as KRA registered</option>
				</select>		
			</td>
		</tr>
		
		<?php // if($row['personverification'] > 1) { ?>
		<!--	<tr>
				<td align="right" style="">
					Back office punching done ?
				</td>
				<td>
				<input name="Checkbox1" type="checkbox" id="<?php // echo 'opt'.$h;?>" value="1" <?php  // if($row['BOPD'] == 1) { echo "checked disabled"; }?> /> -->
				<!--</td>
			</tr>   -->
				<?php // if($row['BOPD'] == 1) { ?>
				<!--	<tr>
						<td align="right" style="">
							Trading software password sent ? * <?php echo $h;?>
						</td>
						<td>
							<input name="Checkbox1" type="checkbox" id="<?php echo 'opt'.$h;?>" value="1" <?php // if($row['TSPS'] == 1) { echo "checked disabled"; }?> /> -->
				<!--</td>
					</tr>  -->
					 <?php // if($row['TSPS'] == 1) { ?>
					<!--	<tr>
							<td align="right" style="">
								Bank Mapping *	 					</td>
							<td>
								<select class="input" name="req" style="width: 100px" id="<?php echo 'opt'.$h;?>" <?php if($row['bankmapping'] > 0) {?> disabled <?php } ?>>
									<option value="0" <?php if($row['bankmapping'] == 0) { echo "selected";}?>>Please select </option>
									<option value="1" <?php if($row['bankmapping'] == 1) { echo "selected";}?>>Yes </option>
									<option value="2" <?php if($row['bankmapping'] == 2) { echo "selected";}?>>No </option>
								</select>  -->	
					<!-- </td>
						 </tr>   -->
						<?php // if($row['bankmapping'] > 0) { ?>
						<tr>
						<td align="right" style="">
							Send welcome mail *  
						</td>
						<td>
						<input onclick="SendWelcomeMail(<?php echo $row['id']; ?>);ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','');" name="Checkbox1" type="checkbox" id="<?php echo 'opt'.$h;?>" value="1" <?php if($row['welcomemail'] == 1) { echo "checked disabled"; }?> />
						<?php $h++;?>
						</td>
						</tr>
						
						
						
						
					<tr>
					<td align="right" style="">
						Trading software password sent ?
					</td>
					<td>
	                	<input name="Checkbox1" type="checkbox" id="<?php echo 'opt'.$h;?>" value="1" <?php  if($row['TSPS'] == 1) { echo "checked";  }?>  disabled /> &nbsp;&nbsp;&nbsp;  <?php if($row['TSPS'] == 1) {  echo  "<i>Sent on ".date("Y-m-d",strtotime($row['TSPS_date']))."</i>"; } else { echo '<i>  Not Sent Yet </i>'; }  ?>
				 				
				    </td>
					</tr> 
					
					<?php $h++;?>
				<!--	<tr>
						<td align="right" style="">Bank mapping done for Atom (website)	</td>
						<td>	<input name="Checkbox1" type="checkbox" id="<?php echo 'opt'.$h;?>" value="1" <?php  if($row['bankmapping'] == 1) { echo "checked";  }?>  disabled /> &nbsp;&nbsp;&nbsp;  <?php if($row['bankmapping'] == 1) {  echo  "<i>Done on ".date("Y-m-d",strtotime($row['bankmapping_date']))."</i>"; } else { echo '<i> Not Mapped Yet </i>'; }  ?>
				        </td>
					</tr>   -->
						 
						 
					<tr>
						<td align="right" style="">POA Received </td>
						<td>	
				        <select class="input" name='POAReceived' id='POAReceived' disabled>
						<option <?php if($row['POA_Activation'] == 1) { echo "selected";  }  ?>>Yes</option>
                    	<option <?php if($row['POA_Activation'] == 2) { echo "selected";  }  ?>>No</option>
					    <option <?php if($row['POA_Activation'] == 3) { echo "selected";  }  ?>>Not Required Demat with us </option>
					    </select>
						</td>
					</tr>  	 
					
                    <?php 
                     $getTAdata = mysql_query("SELECT relations,relative_name from ta_authorities where cid='$id'",$con) or die(mysql_error());

                     if(mysql_num_rows($getTAdata)==0)
                     {
                      $rows=0;	
                      $relations = 0;  
                      $relative_name = '';  
                     }
                     else
                     {
                      $rowTa = mysql_fetch_array($getTAdata);
                      $relations = $rowTa[0];  
                      $relative_name = $rowTa[1];  
                      $rows=1;	
                      }
                   
                    ?>   

					<tr>
						<td align="right" style="">Trading Authority (TA) </td>
						<td>	
				        <input type="checkbox" <?php echo ($rows==1 ? 'checked disabled' : '');?> name="ta_authority" onclick="trading_authority();" id="ta_authority"/>
				        &nbsp;&nbsp;&nbsp;

                        <div id="ta_authority_table" <?php if ($rows==1){ echo 'style="display:block;"'; } else { echo 'style="display:none;"'; } ?>  class="moduleHeading">
                        <table style="width:410px;text-align:center;border-collapse: collapse;border: 1px solid #ddd;" >
                        <tr>
                        <td align="left" style="">Select Relationship* </td>
                        <td align="right" style="">
             <select width="100%" class="input" name="ta_relation" id="ta_relation">
             <option <?php if($relations==0){ echo 'selected="selected"'; } ?> value="0"> Select Relative	</option>
             <option <?php if($relations==1){ echo 'selected="selected"'; } ?> value="1">Father	</option>
             <option <?php if($relations==2){ echo 'selected="selected"'; } ?> value="2">Husband</option>
             <option <?php if($relations==3){ echo 'selected="selected"'; } ?> value="3">Wife</option>
             <option <?php if($relations==4){ echo 'selected="selected"'; } ?> value="4">Sister	</option>
                        <option <?php if($relations==5){ echo 'selected="selected"'; } ?> value="5">Spouse	</option>
                        <option <?php if($relations==6){ echo 'selected="selected"'; } ?> value="6">Child</option>
                        </select> </td>
                        </tr>  
				        <tr>
                        <td align="left" style="">Relative Name* </td>
                        <td align="right" style=""><input value="<?php echo $relative_name; ?>" class="input" type="text" name="relative_name" id="relative_name"/></td>

                        </tr>  
                        <tr>
                        <td style="height:30px;" colspan="2" align="left" style=""><input class="buttonGreen" type="button" name="update_ta" onclick="SaveTaUpdate('<?php echo $row['id']; ?>','<?php echo $row['code']; ?>');" id="update_ta" value="Save"/></td>
                        </tr>
				        </table>
                        </div>
				        </td>
                           

					</tr>  	 
						 
						<?php  // }?>
						<?php if($row['welcomemail'] > 0) { ?>
						<!-- <tr>
							<td align="right" style="">
								Is software demo given ? *
							</td>
							<td>
								<input name="Checkbox1" type="checkbox" id="" value="1" <?php if($row['softwaredemogiven'] == 1) { echo "checked disabled"; }?> />  -->
						
					<!-- </td>
						 </tr>   -->
						<?php }?>
					   <?php // } ?>
				       <?php // } ?>
	                 	<?php // }?>
		
				<!-- <tr>
				<td align="right" style="">
				F&O Activation * 
				</td>
				<td>
				<input name="Checkbox1" type="checkbox" id="" value="1" <?php if($row['FO_Activation'] == 1) { echo "checked disabled"; }?> />
				</td>
				</tr>   -->
						
						
				<!--  <tr>
				<td align="right" style="">
				POA Activation * 
				</td>
				<td>
				<input name="Checkbox1" type="checkbox" id="" value="1" <?php if($row['POA_Activation'] == 1) { echo "checked disabled"; }?> />
				</td>
				</tr> -->
				<?php if($perm==8 || $perm==1) { ?>
				<tr>
				<?php
                $sql=mysql_query("SELECT `level` FROM `customersupport` WHERE `Clientid`='$id'",$con) or die(mysql_error());		
                $rowLevel=mysql_fetch_array($sql);						
				?>
						
				<td align="right" style="">
                Levels            
               	</td>
	            <td>
				<input name="radio1" type="radio" onclick="SupportLevel('<?php echo $id ;?>')" value="1" <?php if($rowLevel[0] == 2 || $rowLevel[0] == 3 || $rowLevel[0] == 4) { echo " disabled"; }?> />
                <input name="radio1" type="radio" onclick="SupportLevel('<?php echo $id ;?>')" value="1" <?php  if($rowLevel[0] == 1 ||$rowLevel[0] == 3 ||  $rowLevel[0]== 4) { echo " disabled"; }?>
				 />
	            <input name="radio1" type="radio" onclick="SupportLevel('<?php echo $id ;?>')" value="1" <?php  if($rowLevel[0] == 2 ||$rowLevel[0] == 1 || $rowLevel[0]== 4) { echo " disabled"; }?> />
	            <input name="radio1" type="radio" onclick="SupportLevel('<?php echo $id ;?>')" value="1" <?php  if($rowLevel[0] == 1 ||$rowLevel[0] == 2 || $rowLevel[0] == 3) { echo " disabled"; }?> />
	            </td>
				
			   </tr>
				<?php } ?>
				
			    
	
				
	
        <?php $h++;?>
       	
					
		<tr>
		<td style="width:"></td>
		<td style="">
		&nbsp;&nbsp;
		<?php if(in_array('UAC_clients',$thisPer))
		{
		if($expiring == 1)
		{
		$addRow = 3;
		}
		else
		{
		$addRow = 2;
		}
		}
		?>
		<?php if(in_array('UAC_clients',$thisPer))
		{?>
		<input name="Button2" type="button" value="Update" class="buttonGreen" onclick="SaveData('clients/update?id=<?php echo $id;?>&i=<?php echo $i;?>','opt','<?php echo $h;?>','<?php echo $i;?>','','','<?php echo $addRow;?>');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','');" />&nbsp;&nbsp;
		<?php } 
		else if(in_array('UTC_clients',$thisPer))
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
			<input name="Button1" type="button" value="Update" class="buttonGreen" onclick="SaveData('clients/update?id=<?php echo $id;?>&i=<?php echo $i;?>','opt','<?php echo $h;?>','<?php echo $i;?>','','','<?php echo $addRow;?>');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','');" />&nbsp;&nbsp;
		<?php
				}

				}
		}

		else if(in_array('U_clients',$thisPer))
		{
		if($row[0] == $loggeduserid)
		{
		?>
		<input name="Button1" type="button" value="Update" class="buttonGreen" onclick="SaveData('clients/update?id=<?php echo $id;?>&i=<?php echo $i;?>','opt','<?php echo $h;?>','<?php echo $i;?>','','','<?php echo $addRow;?>');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','');" />&nbsp;&nbsp;
		<?php
		} 
		}

		?>
		<input name="Button1" type="button" value="Cancel" class="buttonnegetive" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
		</td>
	</tr>
	</table>

<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>

