<?php  
include("../../include/conFig.php");

if($_FILES[csv][size] > 0) 
{ 
$file = $_FILES[csv][tmp_name]; 
$handle = fopen($file,"r"); 
     
do { 

$str =    addslashes($data[0])."--".addslashes($data[1])."--".addslashes($data[7])."--".addslashes($data[8]);
		
$uploadingDate[] .= trim(addslashes($data[0]));
$empExtension[] .= trim(addslashes($data[1]));
$mobile[] .= trim(addslashes($data[3]));
$callStatus[] .= trim(addslashes($data[7]));
$callingdetail= trim(addslashes($data[8]));
$callingHour[]  =substr($callingdetail, 0, strpos($callingdetail,'s'));
}

while($data = fgetcsv($handle,1000,",","'")); 
{ 
foreach($empExtension as $key => $val)
{
$uploadingDate[$key]=date("Y-m-d H:i:s", strtotime($uploadingDate[$key]) );	

if($callStatus[$key]=='BUSY')
{
$statusid=3;	
}
else if($callStatus[$key]=='ANSWERED')
{
$statusid=1;
}
else if($callStatus[$key]=='NO ANSWER')
{
$statusid=2;
}
else if($callStatus[$key]=='FAILED')
{
$statusid=4;
	
}
	
$res=mysql_query("SELECT * FROM `callinghours` WHERE `uploadingtime`='$uploadingDate[$key]' AND `extension`='$empExtension[$key]'",$con) or die(mysql_error());
	
if(mysql_num_rows($res)>0)
{
$result=mysql_query("UPDATE `callinghours` SET `callstatus`='$statusid' AND `callingtime`='$callingHour[$key]' WHERE `uploadingtime`='$uploadingDate[$key]' AND `extension`='$empExtension[$key]'",$con) or die(mysql_error());
}	
else
{
$result=mysql_query("INSERT INTO `callinghours`(`id`,`extension`,`mobile`,`callstatus`,`callingtime`,`uploadingtime`) VALUES ('','$empExtension[$key]','$mobile[$key]','$statusid','$callingHour[$key]','$uploadingDate[$key]')",$con) or die(mysql_error());
}

}
if($result)
{  ?>
<script>
setTimeout("window.close()",0);	
</script>		
<?php }  ?>


<?php }

}	
?>
<script type="text/javascript">
window.top.window.document.getElementById('uploadStats').style.display = 'none';
window.top.window.document.getElementById('bigMoodle').style.display = 'block';
window.top.window.document.getElementById('manipulatemoodleContent').style.display = 'block';
window.top.window.document.getElementById('viewmoodleContent').style.display = 'block';
window.top.window.document.getElementById('manipulatemoodleContent').innerHTML ="Data Successfully Uploaded"

</script> 	

