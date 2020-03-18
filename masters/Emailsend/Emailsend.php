<?php
include("../../include/conFig.php");
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Send E-mail To all Clients
</td>
<td align="right" style="width:70%">
<input name="Button1" type="button" value="<Back To List" class="button" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td>
</tr>
</table>
</div>

<form action="masters/Emailsend/Mailsend.php" onsubmit="return Mailvalidation();"  method="post" target="_blank"  enctype="multipart/form-data">
<div class="form">
<table width="100%" cellpadding="0" cellspacing="10">
<tr>
    <td align="right">Email Categories</td>
	<td colspan="" align="left" style="width: 500px;">
    <select name="Categories" class="input" style="width: 200px" id="Categories" onchange="getModule('masters/Emailsend/getCategories?id=templateemailid&categories='+this.value,'getCategories','',document.title)">
	<option value="">Select Template Categories</option>			
    <?php
    $getCity = mysql_query("SELECT DISTINCT `name`,id FROM `emailcategories` WHERE `delete` = '0'",$con) or die(mysql_error()); 
    while($rowMailcat = mysql_fetch_array($getCity))
    {
    ?>
    <option value="<?php echo $rowMailcat[1];?>"><?php echo $rowMailcat[0];?></option>
    <?php } ?>
	</select>&nbsp;&nbsp;&nbsp;&nbsp;
	<span id="Categoriesmsg" style="color: red;"></span>
	</td>

</tr>
<tr>
    <td align="right">Email Template</td>
    <td><span id="getCategories" style="display:inline">
    <select name="" id="template" class="input">
    <option value="">Select E-mails Categories</option>
    </select>  
    </span><span id="templateemailid" style="color: red;"></span></td>
</tr>

<tr>
    <td align="right">CSV File</td>
    <td><input type="file" name="file" id="csvfile" value=""><span id="csvfilemsg" style="color: red;"></span></td>
</tr>

<tr>
    <td align="right">Send To All Clients</td>
    <td><input type="checkbox" name="allclients" id="allclients" value=""><span id="all_client_checkbox" style="color: red;"></span></td>
</tr>


<tr>
    <td align="right">Send To Non POA Clients </td>
    <td><input type="checkbox" name="nonpoaclients" id="nonpoaclients" value=""><span id="non_poa_clients" style="color: red;"></span></td>
</tr>

<tr>
    <td align="right"></td>
    <td></td>
</tr>
<tr>
    <td style="width: 59px"></td>
    <td style="width: 500px">
    <input name="import" type="submit" value="Send Mail" style="margin-left: 130px;" class="buttonGreen"/>&nbsp;&nbsp;
    </td>
</tr>
</table>
</div>
</form>
