<?php  
include("../include/conFig.php");

print_r($_POST);

if($_FILES[csv][size] > 0) 
{ 
$file = $_FILES[csv][tmp_name]; 
$handle = fopen($file,"r"); 
     
 do { 

$str =    addslashes($data[0])."--";
		
$mobile[].= trim(addslashes($data[0]));



}
while ($data = fgetcsv($handle,1000,",","'")); 
     
$MsgBody=$_POST['body'];

	
foreach($mobile as $key => $val)
{ 
if($mobile[$key]!='0' && $mobile[$key]!='' && $mobile[$key]!='Mobile')
{
$result=mysql_query("INSERT INTO `whatsapplog`(`id`,`cid`,`mobile`,`body`,`status`,`createddate`,`updatedby`) VALUES ('','','$mobile[$key]','$MsgBody','0','$datetime','$loggeduserid')",$con)or die(mysql_error());
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


