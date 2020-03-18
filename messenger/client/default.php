<?php
include("../../include/conFigclient.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Messenger</title>
<link href="../../css/common.css" rel="stylesheet" type="text/css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<script src="scripts/jquery.js" type="text/javascript"></script>
<script src="../../scripts/hashModule.js" type="text/javascript"></script>
<script src="../../scripts/misc.js" type="text/javascript"></script>
<script src="../../scripts/getModule.js" type="text/javascript"></script>
<script src="../../scripts/base64.js" type="text/javascript"></script>


		
</head>

<body>
<?php
$getCompanyPic = mysql_query("SELECT `logo` FROM `company` WHERE `id` = '1'",$con) or die(mysql_error());
$rowCpic = mysql_fetch_array($getCompanyPic);
?>


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
<?php include('../../allHidden.php') ;?>
<?php
$getSubs = mysql_query("SELECT category.id FROM category,servicecall,product WHERE category.id = product.category AND servicecall.product = product.id AND servicecall.cid = '$loggeduserid' AND servicecall.messenger= '1' AND servicecall.fromdate <= '$date' AND servicecall.todate >= '$date' AND servicecall.approved = '1'",$con) or die(mysql_error());
$numB = mysql_num_rows($getSubs);
	while($rowSub = mysql_fetch_array($getSubs))
	{
		if(!in_array($rowSub[0],$already))
		{
			$thisP = "-".$rowSub[0]."-";
			$pstr .= $thisP.",";
			$already[] .= $rowSub[0];
		}
	}
?>



<?php
$getKey = mysql_query("SELECT * FROM `pubnub` WHERE `id` = '1'",$con) or die(mysql_error());
$rowKey = mysql_fetch_array($getKey);
?>
<div id="pubnub" pub-key="<?php echo $rowKey['pubkey']?>" sub-key="<?php echo $rowKey['subkey']?>" style="position: absolute; top: -1000px; "></div>

<script src="../../scripts/pubnub.js"></script>
<table cellpadding="0" cellspacing="0" style="width: 100%">
	<tr>
		<td style="width: 15%; ; padding: 5px;" valign="top" class="blueSimple">
		<img src="../../images/logo.png" alt="" style="margin:5px;height:20px;"/>
		</td>
		<td align="right" valign="top"class="blueSimple" style="width:70%;color: #fff; padding-right: 10px; cursor: pointer">
		<br/>
		<span id="ebtbn"></span>
		
			<a href="logout.php" style="color:inherit;text-decoration:none;font-size:11px;">
			
			Logout [<?php echo $loggedname;?>]</a>
		</td>
	</tr>
	<tr>
		<td style="width: 100%;background:#e6e6e6" valign="top" colspan="2">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td style="width: 15%;height: 650px;background:#e6e6e6 url('../../img/leftShadow.png') repeat-y scroll right top;padding-right:5px;" valign="top">
				<br/>
				<div style="width:100%">
				<ul class="menu" style="font-weight:bold">
				<li class="leads" onclick="getModule('tips','viewContent','manipulateContent','Tips')">Tips
				</li>
				<li class="billing" onclick="getModule('changePassword','viewmoodleContent','manipulatemoodleContent','Change Password')">Change Password</li>
				</ul>
				</div>
				<br/>
					<br/></td>
<td style="width: 85%;padding:5px;" valign="top">
				<div id="manipulateContent">
				
				</div>
				<div id="viewContent"></div>
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
		hash[0] = hash[0].replace("#","");
		var chkQ = hash[0].indexOf('?');
			if(chkQ == -1)
			{
			//hash[0] = hash[0]+"?refresh=1";
			}
			else
			{
			//hash[0] = hash[0]+"&refresh=1";
			}
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


 
// PUBNUB.publish() - SEND
PUBNUB.subscribe({
    channel  : "my_tips_channel",
    callback : function(message) {
   var subs = "<?php echo $pstr;?>";
    message = message.split("USEDTOBREAK");
    var inc = message[3].split(',');
    z=0;
    for(t=0;t<inc.length;t++)
    {
    thisStr = "-"+inc[t]+"-";
    x = subs.indexOf(thisStr);
	    if(x != -1)
	    {
	    	z++;
	    }
    }
	    if(z > 0)
	    {
		    if(document.getElementById('todaysTips'))
		    {
		   	 document.getElementById('todaysTips').innerHTML += '<div class="tipUnread" onclick="this.className=\'tip\'"><div style="float: right; font-size: 11px; font-weight: normal; color: #999; text-align: right">Today, '+message[1]+'<br /><span style="color: #73AD59; font-style: normal">'+message[2]+'</span></div>'+message[0]+'<br /><br /></div>';
			 document.getElementById("todaysTips").scrollTop = document.getElementById("todaysTips").scrollHeight;   
		 	}
			notification(message[0],'Capital Builder Call');
		} 
   }
});

	function RequestPermission (callback)
    {
        window.webkitNotifications.requestPermission(callback);
    }

 function notification(tips,username)
    {       
        if (window.webkitNotifications.checkPermission() > 0) {RequestPermission(notification(tips,username));
        }
        var icon  = '<?php echo $rowCpic[0];?>';
        var title = username;
        var body   = tips;
 
        
        var popup = window.webkitNotifications.createNotification(icon, title, body);
        popup.show();
        setTimeout(function(){
        popup.cancel();
        }, '15000');
    }


</script>
<script>


function locationHashChanged() {
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
<div class="notifBigBox" id="notifBigBox">
<div class="notification" id="notification" style="font-weight:normal;display:none">
<div class="notifClose" style="font-weight:bold;" onclick="ToggleBox('notification','none','')"></div>
<div class="notifBox" id="notifBox">
<strong><i id="notifName">Pranay Says:</i></strong><br/> 
<span id="notifText">
I have got an awesome news for all of you. This feature is going to replace the need of internal communication peripherals!! :) 
</span>
</div>
</div>
</div>
</body>
</html>
