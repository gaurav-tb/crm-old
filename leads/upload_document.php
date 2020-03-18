
<?php
error_reporting(0);
include("../include/conFig.php");

$id=$_GET['id'];

$fetchdata=mysql_query("select * from document_uploads where clientid='$id'",$con) or die(mysql_error());
$rowData=mysql_fetch_array($fetchdata);

?>



<div class="buttonBlue" id="sideStory" style="position:fixed;right:0px;cursor:pointer;padding:5px;z-index: 2000;top:400px;" onclick="getModule('noteline/index?cid=<?php echo $id;?>&name=<?php echo str_ireplace('"','',$row['fname']);?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo str_ireplace('"','',$row['fname']);?>')">Story</div>

<div class="buttonnegetive" id="sideStory" style="position:fixed;right:0px;cursor:pointer;padding:5px;z-index:2000;top:450px;" onclick="getModule('clients/requestfundlist?cid=<?php echo $id;?>&name=<?php echo str_ireplace('"','',$row['fname']);?>','manipulatemoodleContent','viewmoodleContent','Fund Request Statement For <?php echo str_ireplace('"','',$row['fname']);?>')">Pay Request</div>

<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">Upload Documents </td>
<!-- <td align="right" style="width:70%">
<input name="Button1" type="button" value="< Back To List" class="button" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" />
</td> -->
</tr>
</table>
</div>
<div class="form">
<div class="moduleHeading">
<table  width="100%" cellpadding="0" cellspacing="0">
<tr>
<td colspan="2" style="width:100%;border:0px;">
Identity Proof (PAN Card ,Adhaar Card)
</td>
</tr>
</table>
</div>

<div class="moduleHeading">
<table  width="100%" cellpadding="0" cellspacing="10">
<tr><td colspan="2">Upload Adhaar Card</td></tr>
<tr>
<td>
<div class="DivAdhaar"><img src="./billing/uploads/<?php echo $rowData['Adaarfront'] ?>" class="AdhaarImg" id="output3"/></div>
<div style="background:lightgrey;width:584px;"><input type="file" class="AdhaarButton" id="AdhaarFront" name="Upload Financial Proof" accept="image/*" onchange="UploadImg(3)"></div>
</td>
<td>
<div class="DivAdhaar"><img src="./billing/uploads/<?php echo $rowData['AdhaarBack'] ?>" class="AdhaarImg" id="output4"/></div>
<div style="background:lightgrey;width:584px;"><input type="file" class="AdhaarButton" id="AdhaarBack" name="Upload Financial Proof" accept="image/*" onchange="UploadImg(4)"></div>
</td>
</tr>
<tr><td colspan="2">Upload PAN Card & Signature</td></tr>
<tr>
<td>
<div class="DivAdhaar"><img src="./billing/uploads/<?php echo $rowData['PanFront'] ?>" class="AdhaarImg" src="document_upload.jpg" id="output5"/></div>
<div style="background:lightgrey;width:584px;"><input type="file" class="AdhaarButton" id="PanFront" name="Upload Financial Proof" accept="image/*" onchange="UploadImg(5)"></div>
</td>
<td>
<div class="DivAdhaar"><img src="./billing/uploads/<?php echo $rowData['PanBack'] ?>" class="AdhaarImg" id="output6"/></div>
<div style="background:lightgrey;width:584px;"><input type="file" class="AdhaarButton" id="PanBack" name="Upload Financial Proof" accept="image/*" onchange="UploadImg(6)"></div>
</td>
</tr>
</table>
</div>

<div class="moduleHeading">
<table  width="100%" cellpadding="0" cellspacing="0">
<tr>
<td colspan="2" style="width:100%;border:0px;">
Upload Bank Proof(Financial Proof, Bank Proof)
</td>
</tr>
</table>
</div>

<div class="moduleHeading">
<table  width="100%" cellpadding="0" cellspacing="10">
<tr><td colspan="2">Upload Financial Proof</td></tr>
<tr>
<td>


<div class="DivFinancial">
<img src="./billing/uploads/<?php echo $rowData['Financialproof'] ?>" class="FinancialImg" id="output1"/></div>
<div style="background:lightgrey;"><input type="file" class="FinanacialButton" id="FinancialProof" name="Upload Financial Proof" accept="image/*" onchange="UploadImg(1)"></div>

</td>
</tr>
<tr><td colspan="2">Upload Bank Proof</td></tr>
<tr>
<td>
<div class="DivFinancial">
<img src="./billing/uploads/<?php echo $rowData['Bankproof'] ?>" class="FinancialImg" id="output2"/></div>
<div style="background:lightgrey;"><input type="file" id="BankProof" class="FinanacialButton" name="Upload Financial Proof" accept="image/*" onchange="UploadImg(2)"></div>
</td>
</tr>
<tr>
<td colspan="2" align="center">
<input name="Button1" type="button"  value="Submit" class="buttonGreen" onclick="documentUpload('<?php echo $id;?>','12');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','');" />&nbsp;&nbsp;
<input name="Button1" type="button" value="Cancel" class="buttonnegetive" id="negetive" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" /></td>
</tr>
</table>
</div>
</div>

