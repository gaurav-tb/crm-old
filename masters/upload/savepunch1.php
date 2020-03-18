<?php  
include("../../include/conFig.php");

if($_FILES[csv][size] > 0) 
{ 
$file = $_FILES[csv][tmp_name]; 
$handle = fopen($file,"r"); 
     
do { 

$str =    addslashes($data[0])."--".addslashes($data[1]);

$code[] .= trim(addslashes($data[0]));
$RMOwnerid[] .= trim(addslashes($data[1]));

}

while($data = fgetcsv($handle,1000,",","'"));  
     
$OverwriteRule=$_POST['OverwriteRM'];
$type=$_POST['type'];

	
foreach($code as $key => $val)
{
if($code[$key]!='')
{
	
/* start here */
 
if($type==1)
{
if($OverwriteRule=='') /* start of OverwriteRule */
{	
$getRMOwner=mysql_query("SELECT * FROM `customersupport` WHERE `customersupport`.`RMOwnerid`='1' AND `customersupport`.`tradingbellsid`='$code[$key]'",$con) or die(mysql_error());

if(mysql_num_rows($getRMOwner)==1)
{
mysql_query("UPDATE `customersupport` SET `customersupport`.`RMOwnerid`='$RMOwnerid[$key]' WHERE `customersupport`.`tradingbellsid`='$code[$key]'",$con) or die(mysql_error());

$res=mysql_query("SELECT `name` FROM `employee` WHERE `id`='$RMOwnerid[$key]'",$con) or die(mysql_error());
$row=mysql_fetch_array($res);

$getCid=mysql_query("SELECT `id` FROM `contact` WHERE `contact`.`code`='$code[$key]'",$con) or die(mysql_error());
$rowCid=mysql_fetch_array($getCid);

$note = "RM Ownership has been changed to <strong>" .$row[0]. "</strong> changed by <strong>".$logged."</strong>";

mysql_query("INSERT INTO `noteline`(`subject`,`note`,`cid`,`id`,`createdate`,`updatedby`,`delete`) values('Oship','$note','$rowCid[0]','','$datetime','$loggeduserid','0')",$con)or die(mysql_error()); 
mysql_query("UPDATE `customersupport` SET `customersupport`.`LastRMOwnerChangeDate`='$datetime' WHERE `customersupport`.`tradingbellsid`='$code[$key]'",$con) or die(mysql_error());

	
}
else 
{
/* start of report */
$getRMOwner=mysql_query("SELECT `employee`.`name`,`customersupport`.`RMOwnerid` FROM `customersupport` INNER JOIN `employee` ON `customersupport`.`RMOwnerid`=`employee`.`id` WHERE `customersupport`.`tradingbellsid`='$code[$key]'",$con) or die(mysql_error());

$rowReport=mysql_fetch_array($getRMOwner);

echo "<ul> <li>$code[$key] Already Assigned To $rowReport[0] </li>  </ul>";

/* end of report  */	
}
} /* end of OverwriteRule */
else 
{
mysql_query("UPDATE `customersupport` SET `customersupport`.`RMOwnerid`='$RMOwnerid[$key]' WHERE `customersupport`.`tradingbellsid`='$code[$key]'",$con) or die(mysql_error());

$res=mysql_query("SELECT `name` FROM `employee` WHERE `id`='$RMOwnerid[$key]'",$con) or die(mysql_error());
$row=mysql_fetch_array($res);

$getCid=mysql_query("SELECT `id` FROM `contact` WHERE `contact`.`code`='$code[$key]'",$con) or die(mysql_error());
$rowCid=mysql_fetch_array($getCid);

$note = "Client Relationship Manager has been changed to <strong>" .$row[0]. "</strong> <strong> Changed By ".$loggedname."</strong>";

mysql_query("INSERT INTO `noteline`(`subject`,`note`,`cid`,`id`,`createdate`,`updatedby`,`delete`) values('Oship','$note','$rowCid[0]','','$datetime','$loggeduserid','0')",$con)or die(mysql_error()); 
mysql_query("UPDATE `customersupport` SET `customersupport`.`LastRMOwnerChangeDate`='$datetime' WHERE `customersupport`.`tradingbellsid`='$code[$key]'",$con) or die(mysql_error());	
}
}
/*  ends here  */ 


/* start here */
 
if($type==2)
{

mysql_query("UPDATE `customersupport` SET `customersupport`.`ownerid`='$RMOwnerid[$key]' WHERE `customersupport`.`tradingbellsid`='$code[$key]'",$con) or die(mysql_error());

mysql_query("UPDATE `contact` SET `contact`.`ownerid`='$RMOwnerid[$key]' WHERE `contact`.`code`='$code[$key]' AND `contact`.`converted`='1'",$con) or die(mysql_error());


$res=mysql_query("SELECT `name` FROM `employee` WHERE `id`='$RMOwnerid[$key]'",$con) or die(mysql_error());
$row=mysql_fetch_array($res);

$getCid=mysql_query("SELECT `id` FROM `contact` WHERE `contact`.`code`='$code[$key]'",$con) or die(mysql_error());
$rowCid=mysql_fetch_array($getCid);

$note = "Client Ownership has been changed to <strong>" .$row[0]. "</strong> changed by <strong>".$logged."</strong>";

mysql_query("INSERT INTO `noteline`(`subject`,`note`,`cid`,`id`,`createdate`,`updatedby`,`delete`) values('Oship','$note','$rowCid[0]','','$datetime','$loggeduserid','0')",$con)or die(mysql_error()); 

}
/*  ends here  */ 

/* start here */
 
if($type==3)
{
$getTeamMateid=mysql_query("SELECT `id` FROM `teamamtes` WHERE `teamamtes`.`mateid`='$RMOwnerid[$key]'",$con) or die(mysql_error());
$rowTeamMateid=mysql_fetch_array($getTeamMateid);


mysql_query("UPDATE `customersupport` SET `customersupport`.`allotmentid`='$rowTeamMateid[0]' WHERE `customersupport`.`tradingbellsid`='$code[$key]'",$con) or die(mysql_error());



$res=mysql_query("SELECT `name` FROM `employee` WHERE `id`='$RMOwnerid[$key]'",$con) or die(mysql_error());
$row=mysql_fetch_array($res);

$getCid=mysql_query("SELECT `id` FROM `contact` WHERE `contact`.`code`='$code[$key]'",$con) or die(mysql_error());
$rowCid=mysql_fetch_array($getCid);

$note = "Support Ownership has been changed to <strong>" .$row[0]. "</strong> changed by <strong>".$logged."</strong>" ;

mysql_query("INSERT INTO `noteline`(`subject`,`note`,`cid`,`id`,`createdate`,`updatedby`,`delete`) values('Oship','$note','$rowCid[0]','','$datetime','$loggeduserid','0')",$con)or die(mysql_error()); 
}
/*  ends here  */ 

} 
}
}
	
?>
<script type="text/javascript">
window.top.window.document.getElementById('uploadStats').style.display = 'none';
window.top.window.document.getElementById('bigMoodle').style.display = 'block';
window.top.window.document.getElementById('manipulatemoodleContent').style.display = 'block';
window.top.window.document.getElementById('viewmoodleContent').style.display = 'block';
window.top.window.document.getElementById('manipulatemoodleContent').innerHTML ="Data Successfully Uploaded"

</script> 	

