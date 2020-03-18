<?php  
include("../../include/conFig.php");


if($_FILES[csv][size] > 0) 
{ 
$file = $_FILES[csv][tmp_name]; 
 $handle = fopen($file,"r"); 
     
 do { 

$str = addslashes($data[0])."--".addslashes($data[1])."--".addslashes($data[2])."--".addslashes($data[3]);
		
$clientcode[] .= trim(addslashes($data[0]));
$symbol[] .= trim(addslashes($data[1]));
$ProductType[] .= trim(addslashes($data[2]));
$Quantity[] .= trim(addslashes($data[3]));
$Price[] .= trim(addslashes($data[4]));
$TradeNo[] .= trim(addslashes($data[5]));
$Lots[]= trim(addslashes($data[6]));


}
while ($data = fgetcsv($handle,1000,",","'")); 
     
$thisdate = $_POST['date'];

	
foreach($clientcode as $key => $val)
{
if($clientcode[$key]!='')	
{
$getExist=mysql_query("SELECT * FROM `traderreport` WHERE `traderreport`.`UploadingDate`='$thisdate' and `traderreport`.`code`='$clientcode[$key]'",$con);	
if(mysql_num_rows($getExist) > 0)
{
$result=mysql_query("UPDATE `traderreport` SET `Symbol`='$symbol[$key]',`ProductType`='$ProductType[$key]',`Quantity`='$Quantity[$key]',`price`='$Price[$key]',`TrderNo`='$TradeNo[$key]',`Lots`='$Lots[$key]' WHERE `traderreport`.`code`='$clientcode[$key]' and `traderreport`.`UploadingDate`='$thisdate'") or die(mysql_error());
}	
else
{	
$result=mysql_query("INSERT INTO `traderreport`(`id`,`code`,`Symbol`,`ProductType`,`Quantity`,`price`,`TrderNo`,`Lots`,`UploadingDate`) VALUES('','$clientcode[$key]','$symbol[$key]','$ProductType[$key]','$Quantity[$key]','$Price[$key]','$TradeNo[$key]','$Lots[$key]','$thisdate')",$con) or die(mysql_error());
}
}	
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
<script type="text/javascript">
/* window.top.window.document.getElementById('uploadStats').style.display = 'none';
window.top.window.document.getElementById('bigMoodle').style.display = 'block';
window.top.window.document.getElementById('manipulatemoodleContent').style.display = 'block';
window.top.window.document.getElementById('viewmoodleContent').style.display = 'block';
window.top.window.document.getElementById('manipulatemoodleContent').innerHTML ="Data Successfully Uploaded";   */
</script> 	


