<?php  
include("../../include/conFig.php");

if($_FILES[csv][size] > 0) 
{ 
$file = $_FILES[csv][tmp_name]; 
$handle = fopen($file,"r"); 
     
do { 

$str = addslashes($data[0])."--".addslashes($data[1])."--".addslashes($data[2]);

		
$clientcode[] .= trim(addslashes($data[0]));
$clientAmt[] .= trim(addslashes($data[1]));

}
while($data = fgetcsv($handle,1000,",","'"));  
     
$thisdate = $_POST['date'];

	
foreach($clientcode as $key => $val)
{
$result=mysql_query("UPDATE `customersupport` SET `LedgerBal`='$clientAmt[$key]' ,`FoutUploadingDate`='$thisdate' WHERE `tradingbellsid`='$clientcode[$key]'",$con) or die(mysql_error());
}


if($result)
{ ?>
<script>
setTimeout("window.close()",0);	
</script>	
<?php 
}
}	
?>

