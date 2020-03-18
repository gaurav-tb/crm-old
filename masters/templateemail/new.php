<?php
include("../../include/conFig.php");
if(isset($_POST['submit']))
{
$name = $_POST['name'];

$template =$_POST['template'];
$template = str_ireplace("'","\'",$template);

   $subject = $_POST['subject'];
   $templatefor = $_POST['templatefor'];
	if($name == "" || $template == "" || $templatefor == "")
	{
	$error = 'Please fill all the fields marked with *';
	}
	else
	{
	mysql_query("INSERT INTO `templateemail` (`name`, `templateemail`,  `id`, `createdate`,  `updatedby`,  `delete`, `subject`, `templatefor`) VALUES ('$name', '$template', '', '$datetime', '$loggeduserid', '0','$subject','$templatefor')",$con) or die(mysql_error());
	$success = 'Data Sucessfully Updated';
	}
}
?>
<script src="../../ckeditor_3.6/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="../../ckeditor_3.6/ckeditor/_samples/sample.js" type="text/javascript"></script>
<link href="../../ckeditor_3.6/ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />

<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Add New Email Template
</td>
<td align="right" style="width:70%"><div class="button" style="display:inline-block;float:right" onclick="window.top.window.ToggleBox('manipulateContent','none','');window.top.window.ToggleBox('viewContent','block','')"><img src="../../images/back.png" style="vertical-align:middle" alt=""/>&nbsp;&nbsp;Back To List </div>
&nbsp;</td>
</tr>
</table>
</div>
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
}
?>

<div style="padding:20px;" class="form">
<form action="new.php" method="post">
<table width="100%" cellpadding="0" cellspacing="10">
<tr>
<td align="right">Template Name<span style="color:maroon">*</span></td><td align="left">
	<input class="input" name="name" type="text" id="opt0" style="width: 300px" value="<?php echo $_POST['name']?>" /></td>
</tr>
<tr>
<td align="right">Template For<span style="color:maroon">*</span></td><td align="left">
	<input class="input" name="templatefor" type="text" id="opt2" style="width: 300px" value="<?php echo $_POST['templatefor']?>" /></td>
</tr>
<tr>
<tr>
<td align="right">Template Subject<span style="color:maroon">*</span></td><td align="left">
	<input class="input" name="subject" type="text" id="opt1" style="width: 300px" value="<?php echo $_POST['subject']?>" /></td>
</tr>
<tr>
<td align="right" style="vertical-align:top">Template<span style="color:maroon">*</span></td>
<td align="left"><textarea id="editor_kama" cols="60" name="template" rows="10"><?php echo $_POST['template']?></textarea>
<script type="text/javascript">
			//<![CDATA[

   CKEDITOR.replace( 'editor_kama',
					{
						skin : 'kama',
						  enterMode : CKEDITOR.ENTER_BR,
                    shiftEnterMode: CKEDITOR.ENTER_P
						
					});  

			//]]>
			</script>
&nbsp;<script type="text/javascript">
			//<![CDATA[

				CKEDITOR.replace( 'editor_v2',
					{
						skin : 'v2'
					});

			//]]>
			</script>
		</td>
<tr>
<td></td>
<td>
<input name="submit" type="submit" value="Save" class="buttonGreen" style="width: 70px"></td>
</tr>
</table>
</form>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
