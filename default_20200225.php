
<?php
include("include/conFig.php");
$getPic = mysql_query("SELECT `pic` FROM `userprofile` WHERE `userid` = '$loggeduserid'",$con) or die(mysql_error());
$rowPic = mysql_fetch_array($getPic);

$getDes = mysql_query("SELECT profile.description,employee.username FROM profile,employee WHERE profile.id = employee.profile AND employee.id = '$loggeduserid'",$con) or die(mysql_error());
$rowDes = mysql_fetch_array($getDes);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Customer Relationship Mnagement System By Webricks</title>
<link rel="shortcut icon" href="images/favicon.png" />
 
<?php
$gettheme = mysql_query("SELECT `theme` FROM `employee` WHERE `id` = '$loggeduserid'",$con) or die(mysql_error());
$rowTheme = mysql_fetch_array($gettheme);
if($rowTheme == '')
{
$theme = 'css/style.css';
}
else
{
$theme =$rowTheme[0];
}
if(strpos($theme,'red'))
{
$borderColor = '#b82727';
}
else if(strpos($theme,'teal'))
{
$borderColor = '#008299';
}
else if(strpos($theme,'purple'))
{
$borderColor = '#9b4f96';
}
else if(strpos($theme,'orange'))
{
$borderColor = '#bf5a14';
}
else if(strpos($theme,'yellow'))
{
$borderColor = '#f6a822';
}
else
{
$borderColor = '#0072c6';
}
?>

<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $theme;?>" id="stylesheet" rel="stylesheet" type="text/css" />
<link href="css/common.css" rel="stylesheet" type="text/css" />
<link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="css/font_awesome.css" rel="stylesheet" type="text/css" />
<link href="TimePicker/css/timepicki.css" rel="stylesheet">
<style>

@import 'css/font_awesome.css';
</style> 


<script src="scripts/jquery.js" type="text/javascript"></script>
<script src="scripts/jquery-1.7.1.js" type="text/javascript"></script>
<script src="scripts/hashModule.js" type="text/javascript"></script>
<script src="scripts/misc.js" type="text/javascript"></script>
<script src="scripts/getModule.js" type="text/javascript"></script>
<script src="scripts/fetchMore.js" type="text/javascript"></script>
<script src="scripts/saveData.js" type="text/javascript"></script>
<script src="scripts/delete.js" type="text/javascript"></script>
<script src="scripts/shareMyPost.js" type="text/javascript"></script>
<script src="scripts/autoCheck.js" type="text/javascript"></script>
<script src="scripts/saveBill.js" type="text/javascript"></script>
<script src="scripts/calScript.js" type="text/javascript"></script>
<script src="scripts/saveFreeTrial.js" type="text/javascript"></script>
<script src="scripts/approveInvoice.js" type="text/javascript"></script>
<script src="scripts/approve.js" type="text/javascript"></script>
<script src="scripts/takeAction.js" type="text/javascript"></script>
<script src="scripts/changeOwner.js" type="text/javascript"></script>
<script src="scripts/sendtip.js" type="text/javascript"></script>
<script src="scripts/base64.js" type="text/javascript"></script>
<script src="scripts/stopFreetrial.js" type="text/javascript"></script>
<script src="scripts/getDrp.js" type="text/javascript"></script>
<script src="scripts/moreData.js" type="text/javascript"></script>
<script src="scripts/charCount.js" type="text/javascript"></script>
<script src="scripts/massUpdate.js" type="text/javascript"></script>
<script src="scripts/exportTip.js" type="text/javascript"></script>
<script src="scripts/getLatestTips.js" type="text/javascript"></script>
<script src="scripts/watchList.js" type="text/javascript"></script>
<script src="scripts/ticker.js" type="text/javascript"></script>
<script src="scripts/alertOff.js" type="text/javascript"></script>
<script src="scripts/jquery-1.11.1.min.js"></script>
<script src="scripts/jquery.canvasjs.min.js"></script>
<script src="scripts/callapi.js"></script>
<script src="TimePicker/js/jquery.min.js"></script>
<script src="TimePicker/js/timepicki.js"></script>
<script src="TimePicker/js/bootstrap.min.js"></script>
<script src="scripts/jquery-1.9.js"></script>


<?php if(in_array('D_control',$thisPer))
{
?>
<script src="scripts/validation.js" type="text/javascript"></script>
<?php } ?>

<script>

function RequestPermission(callback)
    {
        window.webkitNotifications.requestPermission(callback);
    }

	
function NullNotification()
    {       
     	 if (window.webkitNotifications.checkPermission() > 0)
		 {
            RequestPermission(NullNotification);
         }
        var icon  = '';
        var title = 'Desktop Notifications Enabled';
        var body   = 'Thank You For Enabling Notification';
        var popuptwo = window.webkitNotifications.createNotification(icon, title, body);
        popuptwo.show();
        setTimeout(function(){
        popuptwo.cancel();
        }, '15000');
        }
</script>
		
</head>

 <body  onDrag="return false" <?php if(in_array('D_control',$thisPer)) { ?> style="-moz-user-select: none;cursor:pointer;<?php } ?>">
<!-- onclick="document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','')" -->
<div id="content" style="position:fixed;right:-590px;width:600px;;height:0px;top:-10px;background:transparent;z-index:999999999999999;display:none">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td class="strip" onclick="openChat('direct');" valign="top">
</td>
<td style="width:98%;background:transparent" valign="top" onclick="openChat('indirect');">
<div class="toolStrip" id="toolStrip">
</div>

<input name="Text1" type="text" id="todo" style="display:none" value="0" />
<!-- <iframe src="spreadChat/chat/default.php"  width="100%" frameborder="0" scrolling="no" name="frameName" id="chatFrame"></iframe>
 -->
</td>

</tr>
</table>
</div>

<input name="Text1" type="text" id="forHash" value="0" style="display:none"/>
<input name="Text1" type="text" id="myName" value="<?php echo $loggedname;?>" style="display:none"/>
<input name="Text1" type="text" id="myId" value="<?php echo $loggeduserid;?>" style="display:none" />
<input name="Text1" type="text" id="myPic" value="<?php echo str_ireplace("../","",$rowPic[0]);?>" style="display:none" />

<input name="Text1" type="text" id="t1" value="0" style="display:none"/>
<input name="Text1" type="text" id="t2" value="Customer Relationship Management System By Webricks" style="display:none" />
<input name="Text1" type="text" id="title1" value="" style="display:none" />
<input name="Text1" type="text" id="title2" value="" style="display:none" />
<input name="Text1" type="text" id="currT" value="0" style="display:none" />
<input name="Text1" type="text" id="rand" value="0" style="display:none" />

<?php
$getKey = mysql_query("SELECT * FROM `pubnub` WHERE `id` = '1'",$con) or die(mysql_error());
$rowKey = mysql_fetch_array($getKey);
?>
<div id="pubnub" pub-key="<?php echo $rowKey['pubkey']?>" sub-key="<?php echo $rowKey['subkey']?>" style="position: absolute; top: -1000px; "></div>

<!-- <script src="scripts/pubnub.js"></script>
 -->    <?php include('allHidden.php') ;?>
        <?php include('allCalender.php') ;?>
        <table cellpadding="0" cellspacing="0" style="width: 100%">
	    <tr>
		<td style="width:17%; ; padding: 5px;background:#fff" valign="top" class="blueSimple" onclick="checkCallbackalert()">
		<img src="images/logo.png" alt="" style="margin:2px;margin-left:50px;width:90px;"/>
		</td>
		<td align="right" valign="middle" style=";width:85%;color: #fff;cursor: pointer" class="blueSimple">
		<table width="100%" cellpadding="0" cellspacing="0" class="blueDiv">
		<tr>
		<td align="center" valign="top"  onclick="getModule('dash/index','viewContent','manipulateContent','Dashboard')">
		Dashboard</td>
		<td align="center" valign="top" style="position:relative">
		<div style="height:25px;position:relative" onclick="ToggleMenu('0')">
		Leads
		<div id="db0" class="sub">
		<ul>
		<?php if(in_array('A_leads',$thisPer)){?><li  onclick="getModule('leads/new','manipulateContent','viewContent','New Lead')">
		<a href="#<?php echo base64_encode('leads/new');?>$$**$$<?php echo base64_encode('manipulateContent');?>$$**$$<?php echo base64_encode('viewContent');?>$$**$$<?php echo base64_encode('Leads');?>">
		Add New Lead</a></li><?php } ?>
		<?php if(in_array('VO_leads',$thisPer)){?> <li  onclick="getModule('leads/view','viewContent','manipulateContent','Leads')">
		<a href="#<?php echo base64_encode('leads/view');?>$$**$$<?php echo base64_encode('viewContent');?>$$**$$<?php echo base64_encode('manipulateContent');?>$$**$$<?php echo base64_encode('Leads');?>">
		View All Leads</a></li><?php } ?>
		<?php if(in_array('FT_leads',$thisPer)){?> <?php } ?>
		<?php if(in_array('TR_leads',$thisPer)){?> <li  onclick="getModule('leads/view?transleads=1','viewContent','manipulateContent','Todays Followups')">
		<a href="#<?php echo base64_encode('leads/view?transleads=1');?>$$**$$<?php echo base64_encode('viewContent');?>$$**$$<?php echo base64_encode('manipulateContent');?>$$**$$<?php echo base64_encode('Todays Followups');?>">
		Todays Followups</a></li><?php } ?>
		<?php if(in_array('INT_leads',$thisPer)){?> <li  onclick="getModule('leads/view?intleads=1','viewContent','manipulateContent','Intersted Leads')">
		<a href="#<?php echo base64_encode('leads/view?intleads=1');?>$$**$$<?php echo base64_encode('viewContent');?>$$**$$<?php echo base64_encode('manipulateContent');?>$$**$$<?php echo base64_encode('Intersted Leads');?>">
		Interested Leads</a></li>				
					
		<?php } ?>
        <li  onclick="getModule('leads/not-contacted?nc=1','viewContent','manipulateContent','Not Contacted')">
		<a href="#<?php echo base64_encode('leads/not-contacted?nc=1');?>$$**$$<?php echo base64_encode('manipulateContent');?>$$**$$<?php echo base64_encode('viewContent');?>$$**$$<?php echo base64_encode('Leads');?>">
		Not Contacted Leads</a></li>
		
        <li  onclick="getModule('leads/view?unread=1','viewContent','manipulateContent','Not Contacted')">
		<a href="#<?php echo base64_encode('leads/view?unread=1');?>$$**$$<?php echo base64_encode('manipulateContent');?>$$**$$<?php echo base64_encode('viewContent');?>$$**$$<?php echo base64_encode('Leads');?>">
		Unread Leads</a></li>		

					
					
		<!-- <li  onclick="getModule('leads/leadallotted','viewContent','manipulateContent','Alloted Leads')">
		<a href="#<?php echo base64_encode('leads/leadallotted');?>$$**$$<?php echo base64_encode('viewContent');?>$$**$$<?php echo base64_encode('manipulateContent');?>$$**$$<?php echo base64_encode('Alloted Leads');?>">
		Test</a></li> -->
		</ul>
		</div>
		</div>
		
		</td>
		<td align="center" valign="top" >
		<div style="height:25px;position:relative" onclick="ToggleMenu('1')">
		Clients
		<div id="db1" class="sub">
		<ul>
		<?php if(in_array('VA_clients',$thisPer)){ ?> 
		<li onclick="getModule('clients/view','viewContent','manipulateContent','Clients')">
		<a href="#<?php echo base64_encode('clients/view');?>$$**$$<?php echo base64_encode('viewContent');?>$$**$$<?php echo base64_encode('manipulateContent');?>$$**$$<?php echo base64_encode('Clients');?>">
		View All Clients</a></li>
		<?php } ?>
		
		
		<?php if(in_array('VACT_clients',$thisPer)){ ?> 
		<li onclick="getModule('clients/viewActive','viewContent','manipulateContent','ActiveClients')">
		<a href="#<?php echo base64_encode('clients/viewActive');?>$$**$$<?php echo base64_encode('viewContent');?>$$**$$<?php echo base64_encode('manipulateContent');?>$$**$$<?php echo base64_encode('ActiveClients');?>">
		View Inactive Clients</a></li>
		
		<?php } ?>
		
		<?php if(in_array('VRM_clients',$thisPer)){ ?> 
		<li onclick="getModule('clients/viewRmClients','viewContent','manipulateContent','viewRmClients')">
		<a href="#<?php echo base64_encode('clients/viewRmClients');?>$$**$$<?php echo base64_encode('viewContent');?>$$**$$<?php echo base64_encode('manipulateContent');?>$$**$$<?php echo base64_encode('viewRmClients');?>">
		View RM Clients</a></li>
		<?php } ?>
		
		
		<?php if(in_array('VO_clients',$thisPer)){ ?> 
		<li onclick="getModule('clients/Salesview','viewContent','manipulateContent','Clients')">
		<a href="#<?php echo base64_encode('clients/Salesview');?>$$**$$<?php echo base64_encode('viewContent');?>$$**$$<?php echo base64_encode('manipulateContent');?>$$**$$<?php echo base64_encode('Clients');?>">
		View Own Clients</a></li>
		<?php } ?>
		
		
		
		<?php if(in_array('VO_clients',$thisPer)){ ?> 
		<li onclick="getModule('clients/BoosterView','viewContent','manipulateContent','Booster Clients')">
		<a href="#<?php echo base64_encode('clients/BoosterView');?>$$**$$<?php echo base64_encode('viewContent');?>$$**$$<?php echo base64_encode('manipulateContent');?>$$**$$<?php echo base64_encode('Clients');?>">
		Booster Pending Clients</a></li>
		<?php } ?>
		
		
		<?php if(in_array('CRD_clients',$thisPer)){?> 
			<li style="display:none" onclick="getModule('crd/index','viewContent','manipulateContent','')">Customer Relationship Division</li>
		<?php } ?>

		</ul>
		</div>
		</div>
		</td>
				<td align="center" valign="top"onclick="getModule('reports/index','viewContent','manipulateContent','Reports');resetTitle();">
				<div style="height:25px" onclick="ToggleMenu('2')">
				<a style="color:#fff;text-decoration:none" href="#<?php echo base64_encode('reports/index');?>$$**$$<?php echo base64_encode('viewContent');?>$$**$$<?php echo base64_encode('manipulateContent');?>$$**$$<?php echo base64_encode('Reports');?>">
		Reports</a></div>
</td>

		<?php if(in_array('TASK',$thisPer))
                       {
                       ?>
		<td align="center" valign="top"onclick="getModule('task/view','viewContent','manipulateContent','Tasks & Reminders')">
			<a style="color:#fff;text-decoration:none" href="#<?php echo base64_encode('task/view');?>$$**$$<?php echo base64_encode('viewContent');?>$$**$$<?php echo base64_encode('manipulateContent');?>$$**$$<?php echo base64_encode('Tasks $ Reminders');?>">
Tasks</a></td><?php } ?>
<?php if(in_array('W_BDCT',$thisPer))
                       {
                       ?> 	
		<td align="center"  style="display:none !important"  valign="top" onclick="getModule('Wall/index','viewContent','manipulateContent','Wall');resetTitle();">
<a style="color:#fff;text-decoration:none" href="#<?php echo base64_encode('Wall/index');?>$$**$$<?php echo base64_encode('viewContent');?>$$**$$<?php echo base64_encode('manipulateContent');?>$$**$$<?php echo base64_encode('Wall');?>">						
Wall

		</a></td><?php } ?>
		<?php if(in_array('MESS',$thisPer))
                       {
                       ?>
		<td align="center" style="display:none !important" valign="top"onclick="getModule('messenger/index','viewContent','manipulateContent','Messenger');resetTitle();">
		<a style="color:#fff;text-decoration:none" href="#<?php echo base64_encode('messenger/index');?>$$**$$<?php echo base64_encode('viewContent');?>$$**$$<?php echo base64_encode('manipulateContent');?>$$**$$<?php echo base64_encode('Messenger');?>">
		Messenger
		</a>
                       
		</td>
		<?php
                       }
                       ?>
		<td align="center" valign="top">
		<div style="height:25px;position:relative" onclick="getModule('masters/index','viewContent','manipulateContent','Setup')">
		<a style="color:#fff;text-decoration:none" href="#<?php echo base64_encode('masters/index');?>$$**$$<?php echo base64_encode('viewContent');?>$$**$$<?php echo base64_encode('manipulateContent');?>$$**$$<?php echo base64_encode('Setup');?>">
		Setup
		</a>
		<div id="db3" class="sub">
		
		</div>
		</div>
		</td>
		
		<td align="center" valign="top">
		<div style="height:25px;position:relative" onclick="getModule('faq/index','viewContent','manipulateContent','faq')">
		<a style="color:#fff;text-decoration:none" href="#<?php echo base64_encode('faq/index');?>$$**$$<?php echo base64_encode('viewContent');?>$$**$$<?php echo base64_encode('manipulateContent');?>$$**$$<?php echo base64_encode('faq');?>">
		FAQs
		</a>
		</div>
		</td>
	
		
		
		<td style="width:100px;" class="inactive">

		</td>

		<td align="center" valign="top"  onclick="ToggleMenu('4')">
		<div style="position:relative">
		
		<?php echo $loggedname;?>&nbsp;&nbsp;<img id="subPic" src="<?php echo str_ireplace("../","",$rowPic[0])?>" style="height:20px; width:20px; vertical-align:middle;border:0px;"  />
		<div id="db4" class="sub" style="width:300px;padding-left:10px;;left:-100px;">
	    <table style="width:300px" cellpadding="0" cellspacing="0" class="inactiveCol">
	    <tr>
	    <td valign="top" align="left" style="width:120px;">
	    <img src="<?php echo str_ireplace("../","",$rowPic[0])?>" style="width:100px;  height:100px;" alt=""  id="subPicBig" />
		<div class="blueSimpletext" style="font-size:12px;padding-top:10px;" onclick="getModule('userprofile/changePic','viewmoodleContent','','Change Profile Pic')">Change Profile Pic</div>
	    </td><td valign="top" align="left">
		<ul>
		<li style="border-bottom:1px #ccc solid" class="inactive">
		<table width="100%" cellpadding="1" cellspacing="3" class="theme">
			<tr><td style="background:#9b4f96;" onclick="document.getElementById('stylesheet').href = 'css/style-purple.css';getModule('theme/saveTheme?theme=css/style-purple.css','','','')" ></td>
			<td style="background:#b82121"  onclick="document.getElementById('stylesheet').href = 'css/style-red.css';getModule('theme/saveTheme?theme=css/style-red.css','','','')"> </td>
			<td style="background:#eaac01"  onclick="document.getElementById('stylesheet').href = 'css/style-yellow.css';getModule('theme/saveTheme?theme=css/style-yellow.css','','','')"></td></tr>
			<tr><td style="background:#bf5a14" onclick="document.getElementById('stylesheet').href = 'css/style-orange.css';getModule('theme/saveTheme?theme=css/style-orange.css','','','')"></td>
			<td style="background:#008299" onclick="document.getElementById('stylesheet').href = 'css/style-teal.css';getModule('theme/saveTheme?theme=css/style-teal.css','','','')"></td>
			<td style="background:#0072C6" onclick="document.getElementById('stylesheet').href = 'css/style.css';;getModule('theme/saveTheme?theme=css/style.css','','','')"></td>
			</tr>
			</table>
			</li>
			<li onclick="getModule('userprofile/view','manipulateContent','viewContent','My Profile')">My Profile</li>
			<li>
					    <a href="logout.php" style="color:inherit;text-decoration:none;font-size:13px;">
					    Logout&nbsp;[<?php echo $loggedname;?>]</a></li>
						</ul>

	</td>
	</tr>
	</table>
	</div>
	</div>	
    </td>
    <td style="width:10px;"></td>
		
	</tr>
	</table>
<span id="ebtbn" style="display:none"></span>		
	</td>
	</tr>
	<tr>
		<td style="width:100%;background:#e6e6e6" valign="top" colspan="2">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td style="width:17%;height: 650px;background:#e6e6e6 url('img/leftShadow.png') repeat-y scroll right top;padding-right:13px;" valign="top"><br/>
				<table width="95%" cellpadding="5" cellspacing="0">
				<tr>
				<td align="left">
				<img src="<?php echo str_ireplace("../","",$rowPic[0])?>" style="height:40px;width:40px;:0px;" id="mainPic"  />
				</td>
				<td align="left" valign="middle">
				<strong class="blueSimpletext">
				<?php echo ucwords($loggeduser);?>			
				</strong>	
				<br/>
				<span style="font-size:12px;">
				<?php echo substr($rowDes[0],0,50);?></span>	
				</td>
				</tr>
				</table>
				<div style="background:#e6e6e6;padding:15px 5px 5px 5px;width:195px;">
				<input name="Text1" type="text" class="input" style="width:190px;" placeholder="Search Here"  id="mainSearch" onkeypress="checkKey(event,'search')"/><div style="display:none;padding:5px;width:25px;" class="buttonBlue" onclick="getModule('search/index?term='+document.getElementById('mainSearch').value,'viewContent','manipulateContent','Search Results')" >Go</div>
				<div style="float:right;font-size:10px;cursor:pointer;" onclick="getModule('search/advanced','manipulatemoodleContent','viewmoodleContent','Advanced Search')">Advanced Search</div>
				<br/>
				<br/>
				<div style="background:#f7f7f7;padding:10px;">
				Next to call
				</div>
				<?php
					
				$after1mins = strtotime('+1 minutes');
				$after15mins = strtotime('+15 minutes');
				$dateafter1mins = date('H:i:s', $after1mins);
				$dateafter15mins = date('H:i:s', $after15mins);

				$query = "SELECT `id`,`fname`,`mobile` FROM `contact` WHERE `callbackdate` = '$date' AND `callbacktime` BETWEEN '$dateafter1mins' AND '$dateafter15mins' AND `ownerid` = '$loggeduserid' order by `callbackdate` desc limit 10";
				$getData = mysql_query($query,$con) or die(mysql_error());

				?>
                <table class="fetch" style="width:100%">
                <tr>
				<th style="width:50%">First Name</th>
				<th style="width:50%">Mobile</th>
				</tr>
				<?php if(mysql_num_rows($getData) > 0)
				{ 
				while($row = mysql_fetch_array($getData))
				{
				?>
				<tr>
				<td class="blueSimpletext" onclick="getModule('leads/edit?id='+<?php echo $row['id'];?>+'&amp;i=0','manipulateContent','viewContent','1')">
				<span><?php echo $row['fname'];?></span>
				</td>
				<td style="width:50%"><?php echo $row['mobile'];?></td>
				</tr>
				<?php } } ?>
				</table>
                <div id="newdataallotment">
				</div>
				<br/>
				<center>
                 <br/>
	<div class="blueSimple" style="color:#fff;text-align:left;padding:5px;display">Today's Tasks</div>

	<div style="text-align:left;overflow:hidden;height:150px;width:90%;display:none">
	<ul style="list-style:none;padding:0px;padding-left:5px;" id="todayTask">
	<?php
	
	$fromdate = date("Y-m-d")." 00:00:00";
	$todate = date("Y-m-d")." 23:59:59";	
	
	$getData = mysql_query("SELECT task.subject,task.id FROM task,contact WHERE  task.owner = '$loggeduserid' AND task.delete = '0' AND task.status = '0' AND task.profile = '1' AND task.contactid = contact.id AND task.reminddate BETWEEN '$fromdate' AND '$todate' ORDER BY task.id",$con) or die(mysql_error());
	while($row = mysql_fetch_array($getData))
	{
	?>
	<li id="tsk<?php echo $row[1];?>" onclick="getModule('task/edit?id=<?php echo $row[1];?>','manipulateContent','viewContent','Tasks');" style="text-transform:capitalize;cursor:pointer;color:#222;border-bottom:1px #eee solid;padding-top:5px;width:150px;padding-bottom:5px;"><?php echo $row[0];?></li>
	<?php
	
	}
	
	?>

	</ul>	
   </div>	
   
    </td>
    <td style="width: 85%;background:#fff;" valign="top">
	<div id="manipulateContent" onclick="ToggleMenu('')">
	</div>
	<div id="viewContent" onclick="ToggleMenu('')">
	<?php
	include("dash/index.php");
	?>
	</div>
	</td>
	</tr>
	</table>
	</td>
	</tr>
</table>
        <script>
        function getOnrefresh()
        {
        var hash = document.location.hash;
        //	var hash = document.getElementById('forHashVal').value;
	    if(hash != '')
	    {

		hash = hash.split('$$**$$');

	    hash[0]= decode64(hash[0]);
		hash[0] = hash[0].replace("#","");
		hash[1]= decode64(hash[1]);
		hash[2]= decode64(hash[2]);
		hash[3]= decode64(hash[3]);

		if(hash[1] == 'directResult')
		{
		hash[1] = 'viewContent';
		}
		if(hash[1] != 'manipulatemoodleContent' && hash[1] != 'viewmoodleContent')
		{
		ToggleBox('bigMoodle','none','');
		}
     	hashModule(hash[0],hash[1],hash[2],hash[3]);
	    }
        }
        getOnrefresh();
</script>
<script>


 
// // PUBNUB.publish() - SEND
// PUBNUB.subscribe({
//     channel  : "my_channel",

//     callback : function(message)
// 	{ 

// 	var message = message.split('thisisusedtobreak');
// 	var myId = document.getElementById('myId').value;
// 	if(myId != message[1])
// 	{		
// 			var mypost = message[0].split('says<i>');
// 		var myName = mypost[0].replace('<i>','');

// 		if(document.getElementById('wallContents'))
// 		{
		
// 		var toAdddiv = '<div style="border-bottom:1px #ccc solid;padding:25px 10px 5px 10px"><div style="float:right;font-style:italic;color:#888;font-size:10px;">Moments Ago</div><div style="float:left;padding:5px 10px 5px 5px;"><img src="images/mypic.jpg" alt="" style="border:2px #fff solid;-moz-box-shadow: 0 0 4px #222; -webkit-box-shadow: 0 0 4px #222;" /></div><span style="font-weight:bold">'+myName+'</span><br/>'+mypost[1]+'</div>';
// 		document.getElementById('wallContents').insertAdjacentHTML("afterBegin", toAdddiv);		
// 		}
// 		var rand = Math.floor((Math.random()*100000000)+1);

// 		var Clid = 'notification'+rand;
// 		var myNotifBox = '<br/><div class="notification" id="notification'+rand+'" style="font-weight:normal;display:none"><div class="notifClose" style="font-weight:bold;" onclick="ToggleBox(\''+Clid+'\',\'none\',\'\')"></div><div class="notifBox" id="notifBox'+rand+'" onclick="getModule(\'Wall/index\',\'manipulateContent\',\'viewContent\',\'Wall\')" ><strong><i id="notifName'+rand+'">'+myName+'</i></strong><br/> <span id="notifText'+rand+'">'+mypost[1]+'</span></div></div>'
// 	//	alert(rand);
// 		document.getElementById('notifBigBox').insertAdjacentHTML("beforeend",myNotifBox);		
// 	//	document.getElementById('notifName').innerHTML = myName;
// 	//	document.getElementById('notifText').innerHTML = mypost[1];
// //		alert(rand);
// 		$("#"+Clid).slideDown('slow');	
// 		setTimeout("$('#"+Clid+"').fadeOut('slow')",15000);
// 		notification(mypost[1],myName);
// 		setTitle(myName);		
	
// 		}
		
// 	}
// });



	function RequestPermission (callback)
    {
        window.webkitNotifications.requestPermission(callback);
    }

 function notification(tips,username)
    {     
        var x = Math.floor((Math.random() * 100) + 1);
		window.open ("popup.php?title="+tips,"Swastika Call"+x,"toolbar=0,location=0,status=0,menubar=0,scrollbars=0,resizable=0,width=150,height=100");  
        if (window.webkitNotifications.checkPermission() > 0) {RequestPermission(notification(tips,username));
        }
        var icon  = '<?php echo str_ireplace("../","",$rowPic[0])?>';
        var title = username;
        var body   = tips;
 
        
        var popup = window.webkitNotifications.createNotification(icon, title, body);
        popup.show();
        setTimeout(function(){
        popup.cancel();
        }, '15000000');
    }


</script>
<script>


function locationHashChanged() 
{
	var forHash = document.getElementById('forHash').value;
	if(forHash == '0')
	{
	document.getElementById('forHash').value = '1';
	}
	else
	{
	getOnrefresh();
	}
}

window.onhashchange = locationHashChanged;

titleInterval = setInterval("document.getElementById('t1').innerHTML = '0'",15000000);

</script>
<script>


// PUBNUB.subscribe({
//     channel  : "my_home_channel",
//     callback : function(message) 
// 	{
//    //  alert(message);
//     message = message.split("USEDTOBREAK");
//     document.getElementById('uptoTipCalc').value = message[3];
//     var html = '<div class="tip" style="color:#222;font-weight:normal;font-size:13px;">'+message[0]+'<br/><span class="blueSimpletext" style=";font-size:11px;font-weight:bold">'+message[2]+'&nbsp;&nbsp;at&nbsp;&nbsp;'+message[1]+'</span></div>';
//     document.getElementById('regularTips').insertAdjacentHTML('afterBegin',html);
//     notification(message[0],"New Tip");

//    }
// });


</script>
<div class="notifBigBox" id="notifBigBox">
<div class="notification" id="notification" style="font-weight:normal;display:none">
<div class="notifClose" style="font-weight:bold;" onclick="ToggleBox('notification','none','')"></div>
<div class="notifBox" id="notifBox">
<strong><i id="notifName">User Says:</i></strong><br/> <span id="notifText">
I have got an awesome news for all of you. This feature is going to replace the need of internal communication peripherals!! :) 
</span>
</div>
</div>
</div>
<?php
//include("whatsHappening/index.php");
?>
<script type="text/javascript">
function openChat(what)
{
if(what == 'direct')
{
	if(document.getElementById('todo').value == 0)
	{
		document.getElementById('todo').value = 1;
		$("#content").animate(
		            {"right": "+=590px"},
		            "slow");
	}
	else
	{
		document.getElementById('todo').value = 0;
		$("#content").animate(
		            {"right": "-=590px"},
		            "slow");
	}
}
else
{
	if(document.getElementById('todo').value == 0)
	{
	document.getElementById('todo').value = 1;
	$("#content").animate(
	{"right": "+=590px"},
	"slow");
	}


}
}




function addCool(todo1,todo2,clientI)
{
var arrow1 = '<?php echo $arrowimg ?>';
var todo2 = todo2.replace(/arrow.png/g,arrow1);

if(document.getElementById('toolCall'+clientI))
{
document.getElementById('toolCallx'+clientI).innerHTML = todo1;
}
else
{
		//var toolCall  = '<div id="toolCall'+clientI+'" onclick="activate(\''+clientI+'\'); " class="toolCall" style="position:relative"><div style="position:absolute;right:-12px;top:7px;"><img src="images/arrow.png" width="12px" alt=""/></div><img class="toolCallImage" src="'+text[3]+'" style="height:20px;vertical-align:middle" alt=""/>&nbsp;&nbsp;&nbsp;<span id="toolCallx'+clientI+'"><span style="font-size:11px;">'+semiTalk+'..</span></span></div>';
document.getElementById('toolStrip').innerHTML += todo2;	
}
	
}





function toggleFtTicker()
{
var x = document.getElementById('ftTicker').style.left;
if(x == '-405px')
{
$("#ftTicker").animate({"left": "+=405"}, "slow");
if(document.getElementById('ftTickerContent').innerHTML == '')
{
getModule('reports/todaysFT','ftTickerContent','','')
}
//document.getElementById('ftTicker').style.left = '0px';
ToggleBox('bigMoodle','block','');
ToggleBox('moodle','none','');

}
else
{
$("#ftTicker").animate({"left": "-=405"}, "slow");
//document.getElementById('ftTicker').style.left = '-405px';
ToggleBox('bigMoodle','none','');
ToggleBox('moodle','none','');
}


}




var sendReq = '1';

<?php 
if($perm==4 || $perm==5 ||  $perm==21 || $perm==22 || $perm==23 || $perm==24 || $perm==25 || $perm==26 || $perm==27)
{ 
?>


// function checkNewAllotment()
// {
// var page = "fetchNewServer.php";
// $.ajax({type:"POST",url:page,data:{},success:function(result)
// {
// if(result != '0')
// {
// if(isNaN(result))
// {
// alert(result);	
// }
// else 
// {


// if(confirm("New Leads Alloted")== true)
// {
// var Empid='<?php echo $loggeduserid ?>';

// var page="Reallotment.php?Empid="+Empid+'&ClientID='+result;
	
// $.ajax({type:"POST",url:page,data:{},success:function(result)
// {
// if(result=='NOTHINGFOUNDHERE')
// {
// alert("Lead Has been Captured By Someone else");
// }
// else
// {
// alert("Lead Has been Alloted To you");
// document.getElementById('newdataallotment').insertAdjacentHTML('afterBegin',result);
// }	
// }
// });	


// }
// else
// {
// return false;	
	
// }



// }
// }

// }});
// }


// setInterval(function()
// {
// checkNewAllotment();	
// },120000);

<?php  } ?>


// function checkPartnerLeads()
// {
// var page = "fetchPartnerLeads.php";
// $.ajax({type:"POST",url:page,data:{},success:function(result)
// {
// }
// });
// }

// setInterval(function()
// {
// //checkPartnerLeads();	
// },120000);


	


var idleTime = 0;
$(document).ready(function () {
    //Increment the idle time counter every minute.
    var idleInterval = setInterval(timerIncrement, 60000); // 1 minute

    //Zero the idle timer on mouse movement.
    $(this).mousemove(function (e) {
        idleTime = 0;
		sendReq = '1';

    });
    $(this).keypress(function (e) {
        idleTime = 0;
		sendReq = '1';
    });
});

function timerIncrement() 
{
    idleTime = idleTime + 1;
    if (idleTime > 5) { // 15 minutes
        sendReq = '0';
		//window.location = 'logout.php';
}
/*
    if (idleTime > 30) { // 15 minutes
        //sendReq = 0;
		window.location = 'logout.php';
    }
	*/
}
	
	function checkBackLog()
{
	var page = "fetchNc.php";
	$.ajax({type:"POST",url:page,data:{},success:function(result)
	{

if(result != '0')
{
	<?php if($loggeduserid != 1) { ?>
	alert("Unattended Web Lead Found");
	<?php } ?>
}
}});
}


function runDataTransfer()
{
	var page = "uploadlead/chkNumber.php";
	$.ajax({type:"POST",url:page,data:{},success:function(result)
	{
	console.log('data run');
	}});
}

function checkMytask()
{
var x = document.getElementById('taskTime').value;
var y = document.getElementById('taskNames').value;
y = y.split(",");
x = x.split(",");
var d = new Date();
var tochk = '';
var actual = d.getHours()+":"+d.getMinutes()+":00";
	for(t=0;t<=x.length;t++)
	{
	tochk = x[t];
	
	if(tochk == actual)
	{
	ShowError("<br/>You have a task scheduled at this time.<br/>"+y[t]);
	}
	}
    }

//setInterval("checkMytask()",60000);

</script>
<div id="todaysReminders">
<?php
$fromtime = $date." 00:00:00";
$totime = $date." 23:59:59";


$getTask = mysql_query("SELECT `subject`,`reminddate` FROM `task` WHERE `reminddate` BETWEEN '$fromtime' AND '$totime' AND `owner` = '$loggeduserid' AND `status` = '0' AND `popup` = '1'",$con) or die(mysql_error());
while($rowTask= mysql_fetch_array($getTask))
{
$taskName[] .= $rowTask[0];
$taskTime = $rowTask[1];
$taskTime = explode(" ",$taskTime);
$actualTime[] .= $taskTime[1];
}
?>

<textarea name="TextArea1" cols="20" rows="2" id="taskNames" style="display:none"><?php echo implode(",",$taskName); ?></textarea>
<textarea name="TextArea1" cols="20" rows="2" id="taskTime" style="display:none"><?php echo implode(",",$actualTime); ?></textarea>
</div>


<script type="text/javascript">

<?php
if($perm == '1')
{
	?>
	//28052019
// 	setInterval(function()
// 	{

// 	checkBackLog();		


// },300000);
<?php
}
if($loggeduserid == '1')
{
?>


	
<?php
}
?>

// setInterval(function()
// {
// fetchConversionrequest();
// OnboardingCheck();
// },120000);


    function checkCallbackalert()
    {
	var page = "checkCallbackalert.php";
	$.ajax({type:"POST",url:page,data:{},success:function(result)
	{
	if(result.indexOf('NOTHINGFOUNDHERE') == -1)
	{
    <?php  if($loggeduserid != 1) 	{ ?>
	alert("You have call(s) in next 10 minutes.\r\n"+result);
	<?php    }  ?>
	location.reload();
	}
	}
    });
    }



    function checkCallbacksupport()
    {
	var page = "CallbackSupport.php";
	$.ajax({type:"POST",url:page,data:{},success:function(result)
	{
	
	
	if(result.indexOf('NOTHINGFOUNDHERE') == -1)
	{
    <?php  if($loggeduserid != 1) 	{ ?>
	alert("You have call(s) in next 10 minutes.\r\n"+result);
	<?php    }  ?>
	location.reload();
	}
	}
    });
    }
	

function OnboardingCheck()
{
var page ="checkonboarding.php";
$.ajax({
type:"POST",
url:page,
data:{},
success:function(result)
{
	
<?php  if($loggeduserid == 1) { ?>
//alert(result);
<?php } ?>
console.log(result);
}
});	
}




function Introducer()
{
var page ="introducer.php";
$.ajax({
type:"POST",
url:page,
data:{},
success:function(result)
{
<?php  if($loggeduserid == 1) 	{ ?>
//alert(result)
<?php } ?>
//console.log(result);
}
});
}


function CheckWhatsapp()
{
var page ="checkWhatsapp.php";
$.ajax({
type:"POST",
url:page,
data:{},
success:function(result)
{
	
<?php  if($loggeduserid == 1) 	{ ?>
//alert(result)
<?php } ?>
console.log(result);
}
});
}


   function TransferMananger()
    { 
	var page = "TransferManager.php";
	$.ajax({type:"POST",url:page,data:{},success:function(result)
	{
	
	if(result.indexOf('NOTHINGFOUNDHERE') == -1)
	{
	}
	}});
    }


function fetchpayrequest() 
{
var page = "fetchPayRequest.php";
$.ajax({
type:"POST",
url:page,
data:{},
success:function(result) 
{
<?php  if($loggeduserid == 1) { ?>
//alert(result);
<?php } ?>
console.log(result);
}
});
}

function fetchConversionrequest() 
{
var page = "fetchConversionRequest.php";
$.ajax({
type:"POST",
url:page,
data:{},
success:function(result) 
{
<?php  if($loggeduserid == 1) { ?>
//alert(result);
<?php } ?>
}
});
}



 // setInterval(function()
 // {
 // sendemail();
 // },120000);

function sendemail()
{
var page ="sendemail.php";
$.ajax({
type:"POST",
url:page,
data:{},
success:function(result)
{
}
});
}

function getDimension() 
{
  var width = 0, height = 0;
  if( typeof( window.innerWidth ) == 'number' )
	  {
    height = window.innerHeight;
    width = window.innerWidth;
  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
    height = document.documentElement.clientHeight;
    width = document.documentElement.clientWidth;
  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
    height = document.body.clientHeight;
    width = document.body.clientWidth;
  }
height = height+20;
setSize(height);
}

getDimension();

function setSize(height)
{
document.getElementById('content').style.height  = height+'px';
document.getElementById('chatFrame').style.height  = height+'px';
}



</script>
</body>
</html>

