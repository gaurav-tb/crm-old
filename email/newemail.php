<?php
include("../include/conFig.php");
$cid=$_GET['cid'];
$parameter=$_GET['parameter'];

if(isset($_POST['submit']))
{
$email=$_POST['email'];
$subject=$_POST['subject'];
$html=$_POST['html'];
$templateid=$_POST['templateno'];

$html = str_ireplace("'","\'",$html);
if($email == "")
{
$error = 'Please fill email address';
}
if($templateid=="")
{
$error = 'Please select Email Template .';
}

else
{
$to = $_POST['email'];
$subject = $_POST['subject'];
$txt = $_POST['html'];
$headers = "From: Trading Bells <info@tradingbells.com>" . "\r\n" ;
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
/*
if(!mail($to,$subject,$txt,$headers))
{
echo 'Unable to send email';
die();
}
*/

mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$cid','$templateid','0','$datetime','0000:00:00')",$con) or die(mysql_error());

mysql_query("INSERT INTO `emailmergetags` (`id`,`to_email`,`FromName`,`mobile`,`cid`,`templateid`,`empid`) VALUES ('','$loggedemail','$loggedname','$loggedmobile','$cid','$templateid','$loggeduserid')",$con) or die(mysql_error());


$success = 'Your Email has been successfully sent. You can now close the window.';
}
}



$getData = mysql_query("SELECT `email`,`converted` FROM `contact` WHERE `id` = '$cid'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<script src="../ckeditor_3.6/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="../ckeditor_3.6/ckeditor/_samples/sample.js" type="text/javascript"></script>
<link href="../ckeditor_3.6/ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script src="../scripts/getModule.js" type="text/javascript"></script>
<script src="../scripts/misc.js" type="text/javascript"></script>

<script>
function getTemplate(id,cid)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
  else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState<4)
    {
		document.getElementById('templateLoad').innerHTML = 'Fetching..'
    }

     if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
	  var response = xmlhttp.responseText;
	  var resp = response.split("###");
	  document.getElementById('templateLoad').innerHTML = ''
	  document.getElementById('templateView').innerHTML = resp[0];
	  document.getElementById('viewsubject').value = resp[1];
	  document.getElementById('templateid').value = resp[2];
	  
  	  CKEDITOR.instances.editor_kama.setData(resp[0]);
 	}
  }
xmlhttp.open("GET","getTemplate.php?id="+id+"&cid="+cid,true);
xmlhttp.send();
} 
</script>
<div class="moduleHeading">
	
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="left" style="width: 30%">Send Email </td>
<td>
<div class="buttonGreen" onclick="getModule('email/viewemail?clid=<?php echo $cid?>','manipulatemoodleContent','viewmoodleContent','Email List')" style="display:inline-block;float:right" >View Sent Emails</div>
<!--    -->
</td>
</tr>
</table>
</div>
<div class="form" style="height:600px;background:#eee;">
<?php
if($success)
{
?>
<center style="padding-top:20px;">
<div class="buttonGreen" style="display:inline-block"><?php echo $success;?></div>
</center>
<?php
}
else
{
if($error)
{
?>
<center style="padding-top:20px;">
<div class="buttonNegetive" style="display:inline-block"><?php echo $error;?></div>
</center>
<?php
}
?>
<form Onsubmit="SendEmailsValidate();" action="newemail.php?cid=<?php echo $cid;?>" method="post">
<table id="form" cellpadding="5" cellspacing="0" width="100%" style="font-size:12px;">
<tr>
<td style=" " align="right" >Email
</td>
<td style="height:26px">
<input name="email" type="text" readOnly class="input" value="<?php echo $row[0];?>"  style="width:300px;height:25px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span>
<select id="tememail" name="Select1" onchange="getTemplate(this.value,'<?php echo $cid; ?>')" class="input" style="width:300px;height:25px">
<option value="">Select Template </option>
				
<?php

if($parameter=="Leads")
{
$SubStr="AND ( `emailcategories`.`display`='0' || `emailcategories`.`display`='1')"	;
}
else if($parameter=="Clients")
{
$SubStr="AND ( `emailcategories`.`display`='0' || `emailcategories`.`display`='2')"	;
}	
	
	
$getCity = mysql_query("SELECT `templateemail`.`templatefor`,`templateemail`.`name`,`templateemail`.`id` FROM `templateemail` INNER JOIN `emailcategories` ON `templateemail`.`templatecategory`=`emailcategories`.`id` WHERE `templateemail`.`delete` = '0'".$SubStr." ORDER BY `templateemail`.`name` ASC",$con) or die(mysql_error()); 
//AND `templatecategory`='3' AND `id` != '1' 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[0];?>"><?php echo $rowCity[1];?></option>
<?php
}	


?>
</select>&nbsp;&nbsp;
<span id="templateLoad">
</span>
</span>
</td>	
</tr>
<tr>
<td style=" " align="right" >Subject
</td>
<td style="height: 26px">
<input name="subject" type="text" class="input" id="viewsubject" style="width:300px;height:25px" value="<?php echo $_POST['subject']?>" readonly>
<input name="templateno" type="text" class="input" id="templateid" style="width:300px;height:25px;display:none" value="<?php echo $_POST['templateid']?>" readonly>

</td>	

<td align="left"><input name="submit" type="submit" class="buttonBlue" value="Send Email" style="width:124px" /></td>
</tr>
		
<tr><td valign="top" align="right">Message</td>
<?php
if(in_array('EMAIL_type',$thisPer))
{
$writeStr = "display:block";
$readstr = "display:none";
}
else
{
$writeStr = "display:none";
$readstr = "display:block";
}
?>
	
<td style="text-align:left;"  align="center" colspan="4">
<div style="<?php echo $writeStr;?>">
<textarea id="editor_kama" cols="60" name="html" rows="10"><?php echo $_POST['html']?></textarea>
<script type="text/javascript">

  CKEDITOR.replace( 'editor_kama',
					{
						skin : 'kama',
						  enterMode : CKEDITOR.ENTER_BR,
                    shiftEnterMode: CKEDITOR.ENTER_P
						
					});  
</script>
<br/>
</div>
<div style="<?php echo $readstr;?>;min-height:400px;overflow:auto;background:#fff;padding:5px;" id="templateView">
</div>
<input name="submit" type="submit" class="buttonBlue" value="Send Email" style="width:124px" />
</td>
</tr>
</table>
</form>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/>
</div>
<?php
}
?>
	
