
<?php  
include("../../include/conFig.php");

if($_FILES[csv][size] > 0) 
{ 
$file = $_FILES[csv][tmp_name]; 
$handle = fopen($file,"r"); 
     
do { 

$str =    addslashes($data[0])."--".addslashes($data[1])."--".addslashes($data[2])."--".addslashes($data[5]);

		
$clientcode[] .= trim(addslashes($data[0]));
$clientName[] .= ucwords(strtolower(trim(addslashes($data[1]))));
$clientemail[] .= trim(addslashes($data[2]));
$clientmobile[] .= trim(addslashes($data[3]));
$clientState[] .= trim(addslashes($data[4]));
$clientCity[] .= $data[5];
$clientAccNo[] .= trim(addslashes($data[6]));
$clientAccType[] .= trim(addslashes($data[7]));
$clientBankName[] .= trim(addslashes($data[8]));
$clientDPID[] .= trim(addslashes($data[9]));
$clientDpName[] .= trim(addslashes($data[10]));
$clientid[] .= trim(addslashes($data[11]));
$clientAddress1[] .= trim(addslashes($data[12]));
$clientAddress2[] .= trim(addslashes($data[13]));
$clientAddress3[] .= trim(addslashes($data[14]));
$Bankbranch[] .= trim(addslashes($data[15]));
$Uidnumber[] .= trim(addslashes($data[16]));
$DOB[].=date('Y-m-d', strtotime(str_replace('/', '-', $data[17])));
$BOClientOwner[] .= trim(addslashes($data[18]));
$BOAccountOpeningDate[] .=date('Y-m-d', strtotime(str_replace('/', '-', $data[19])));
$PanCardNumber[] .= trim(addslashes($data[20]));




}
while($data = fgetcsv($handle,1000,",","'"));  
     
$thisdate = $_POST['date'];

	
foreach($clientcode as $key => $val)
{
if($clientcode[$key]!='')
{	

$result=mysql_query("UPDATE `contact` SET `fname`='$clientName[$key]',`lname`='',`clientid`='$clientid[$key]',`dpname`='$clientDpName[$key]',`bankname`='$clientBankName[$key]',`city`='$clientCity[$key]',`state`='$clientState[$key]',`address`='$clientAddress[$key]',`dpid`='$clientDPID[$key]',`dpname`='$clientDpName[$key]',`phone`='$clientmobile[$key]',`altemail`='$clientemail[$key]',`bankaccountnumber`='$clientAccNo[$key]',`bankaccountnumber`='$clientAccNo[$key]',`bankaccounttype`='$clientAccType[$key]',`bankbranchname`='$Bankbranch[$key]',`address`='$clientAddress1[$key]',`uidnumber`='$Uidnumber[$key]',`dob`='$DOB[$key]',`contact`.`pancardnumber`='$PanCardNumber[$key]' WHERE `contact`.`code`='$clientcode[$key]'",$con) or die(mysql_error());
mysql_query("UPDATE `customersupport` SET `address2`='$clientAddress2[$key]',`address3`='$clientAddress3[$key]',`BOClientOwner`='$BOClientOwner[$key]',`BOAccountOpeningDate`='$BOAccountOpeningDate[$key]' WHERE `tradingbellsid`='$clientcode[$key]'",$con) or die(mysql_error());



}
}
if($result)
{ ?>
<script>
setTimeout("window.close()",0);	
</script>		
<?php } }
?>
<script type="text/javascript">
window.top.window.document.getElementById('uploadStats').style.display = 'none';
window.top.window.document.getElementById('bigMoodle').style.display = 'block';
window.top.window.document.getElementById('manipulatemoodleContent').style.display = 'block';
window.top.window.document.getElementById('viewmoodleContent').style.display = 'block';
window.top.window.document.getElementById('manipulatemoodleContent').innerHTML ="Data Successfully Uploaded"

</script> 	

