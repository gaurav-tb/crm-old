
<?php  
include("../../include/conFig.php");


if($_FILES[csv][size] > 0) 
{ 
$file = $_FILES[csv][tmp_name]; 
 $handle = fopen($file,"r"); 
     
 do { 

$str =    addslashes($data[0])."--".addslashes($data[1])."--".addslashes($data[2])."--".addslashes($data[3]);
		
$code[] .= trim(addslashes($data[0]));
$Tradedate[].=date('Y-m-d', strtotime($data[4]));
$VoucherNumber[] .= trim(addslashes($data[5]));
$Debit[] .= trim(addslashes($data[10]));
$Credit[] .= trim(addslashes($data[11]));


}
while ($data = fgetcsv($handle,1000,",","'")); 
     
$thisdate = $_POST['date'];

foreach($code as $key => $val)
{
if($code[$key]!='')	
{
	
$getDuplicateVoucher=mysql_query("SELECT * FROM `payinpayoutlogs` WHERE `payinpayoutlogs`.`VoucherNumber`='$VoucherNumber[$key]'",$con) or die(mysql_error());


	
if(mysql_num_rows($getDuplicateVoucher) == 0)
{
$result=mysql_query("INSERT INTO `payinpayoutlogs` (`id`,`code`,`TradeDate`,`Debit`,`Credit`,`UploadingDate`,`VoucherNumber`) VALUES ('','$code[$key]','$Tradedate[$key]','$Debit[$key]','$Credit[$key]','$thisdate','$VoucherNumber[$key]')",$con) or die(mysql_error());
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


