<?php
include("../../include/conFig.php");
    if(isset($_POST['submit']))
    {
    $faquestion = $_POST['faquestion'];
    $faqanswer = $_POST['faqanswer'];
    $faqcategory = $_POST['faqcategory'];
   
    $template = str_ireplace("'","\'",$template);
	if($faquestion == "" || $faqanswer == "" || $faqcategory == "")
	{
	$error = 'Please fill all the fields marked with *';
	}
	else
	{
	mysql_query("INSERT INTO `salesfaq` (`id`,`categories`,`questions`,`answers`,`contributedBy`,`createdate`,`modifieddate`,`updatedby`,`delete`) VALUES ('','$faqcategory','$faquestion','$faqanswer','$loggeduserid','$datetime','$datetime','$loggeduserid','0')",$con) or die(mysql_error());
	$success = 'Data Inserted Successfully';
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
Create New FAQ
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
<td align="right">FAQ Category <span style="color:maroon">*</span></td><td align="left">
	<select class="input" name="faqcategory" id="opt0" style="height:30px;width:300px">
	
	<?php 
	
    $getFAQsCategories=mysql_query("SELECT `faqcategories`.`categoriesName`,`faqcategories`.`id` FROM `faqcategories` WHERE `faqcategories`.`delete`='0' ORDER BY `faqcategories`.`categoriesName`",$con) or die(mysql_error());
	
    while($row=mysql_fetch_array($getFAQsCategories))
	{
	?>	
	<option value="<?php echo $row[1] ?>" ><?php echo $row[0] ?></option>	
	<?php 
	}
	?>
	
	
	</select>
	</td>
</tr>


<tr>
<td align="right">FAQ Question<span style="color:maroon">*</span></td><td align="left">
<textarea name="faquestion" id="opt1" class="input" style="width:1110px;height:71px"></textarea>	
</td>
</tr>



<tr>
<td align="right" style="vertical-align:top">FAQ Answer<span style="color:maroon">*</span></td>
<td align="left"><textarea id="opt2" cols="60" name="faqanswer" rows="10"></textarea>
<script type="text/javascript">
			//<![CDATA[

	CKEDITOR.replace( 'opt2',
	{
	skin : 'kama'
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
<input name="submit" type="submit" value="Save" class="buttonGreen" style="width: 70px"></td>
</tr>
</table>
</form>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
