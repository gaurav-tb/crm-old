<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$getData = mysql_query("SELECT * FROM `templateemail` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
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
	mysql_query("UPDATE `templateemail` SET `name`= '$name',`templateemail`= '$template', `modifieddate`= '$datetime',`updatedby`= '$loggeduserid',`subject`= '$subject',`templatefor`= '$templatefor'  WHERE `id` = '$id'",$con) or die(mysql_error());
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
Edit Email Template
</td>
<td align="right" style="width:70%"><div class="button" style="display:inline-block;float:right" onclick="window.top.window.ToggleBox('manipulateContent','none','');window.top.window.ToggleBox('viewContent','block','')"><img src="../../images/back.png" style="vertical-align:middle" alt=""/>&nbsp;&nbsp;Back To List </div>
</td>
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
<div class="form">
<form action="edit.php?id=<?php echo $_GET['id'];?>" method="post">
<table width="100%;" cellpadding="0" cellspacing="10">
<tr>
<td align="right">Template Name<span style="color:maroon">*</span></td><td align="left"><input value="<?php echo $row['name'];?>" class="input" name="name"/></td>
</tr>
<tr>
<td align="right">Template For<span style="color:maroon">*</span></td><td align="left"><input value="<?php echo $row['templatefor'];?>" class="input" name="templatefor"/></td>
</tr>
<tr>
<tr>
<td align="right">Template Subject<span style="color:maroon">*</span></td><td align="left"><input value="<?php echo $row['subject'];?>" class="input" name="subject"/></td>
</tr>
<tr>
<td align="right" valign="top">Template<span style="color:maroon">*</span></td>
<td align="left"><textarea id="editor_kama" cols="60" name="template" rows="10"><?php echo $row['templateemail']?></textarea>
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
</tr>
<tr>
<td></td>
<td>


<input name="submit" type="submit" value="Update" class="buttonGreen" style="width: 70px"></td>
</tr>

</table>
</form>
<br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
