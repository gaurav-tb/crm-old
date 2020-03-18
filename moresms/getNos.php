<?php
include("../include/conFig.php");
$category = $_GET['category'];
if($category != '')
{
$getData = mysql_query("SELECT `numbers` FROM `moresms` WHERE `serviceid` = '$category' AND `delete` = '0'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData); 
?>						
<table cellpadding="5" cellspacing="0" class="fetch" width="100%">
<tr>
	<td align="right" style="width:35%;vertical-align:top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Enter Numbers (Seperated with comma)
	</td>
	<td>
	<textarea name="TextArea1" id="nos" cols="20" rows="2" class="input" style="height:75px;width:375px"><?php echo $row[0];?></textarea>
	</td>
</tr>
<tr>
	<td>
	</td>
	<td>
	<input name="Button1" type="button" value="Save Numbers" class="buttonBlue" onclick="getModule('moresms/save?catid=<?php echo $category;?>&nos='+document.getElementById('nos').value,'addResult','','')" />
	</td>
</tr>
<?php
}
?>
<div id="addResult" style="color:green"> 
</div>				