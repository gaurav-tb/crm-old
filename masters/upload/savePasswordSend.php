
<?php  
include("../../include/conFig.php");


if($_FILES[csv][size] > 0) 
{ 
$file = $_FILES[csv][tmp_name]; 
 $handle = fopen($file,"r"); 
     
 do { 

$str =    addslashes($data[0])."--".addslashes($data[1])."--".addslashes($data[2])."--".addslashes($data[3]);
		
$clientcode[] .= trim(addslashes($data[0]));
$POAStatus[] .= trim(addslashes($data[1]));
$dpid[] .= trim(addslashes($data[2]));
$clientid[] .= trim(addslashes($data[3]));

}
while ($data = fgetcsv($handle,1000,",","'")); 
     
$thisdate = $_POST['date']." 00:00:00";
$type=$_POST['type'];

foreach($clientcode as $key => $val)
{
if($clientcode[$key]!='')	
{
if($type==1)
{
$getData=mysql_query("UPDATE `contact` SET `TSPS`='1',`TSPS_date`='$thisdate' WHERE `code`='$clientcode[$key]' AND `converted`='1'",$con) or die(mysql_error());
}	
else if($type==2)
{
$getData=mysql_query("UPDATE `contact` SET `dpname`='$POAStatus[$key]',`dpid`='$dpid[$key]',`clientid`='$clientid[$key]' WHERE `code`='$clientcode[$key]' AND `converted`='1'",$con) or die(mysql_error());
}	
else if($type==3)
{
$getData=mysql_query("UPDATE `contact` SET `POA_Activation`='$POAStatus[$key]',`POA_Activation_Date`='$thisdate' WHERE `code`='$clientcode[$key]' AND `converted`='1'",$con) or die(mysql_error());
}	

else if($type==4)
{
$getData=mysql_query("UPDATE `contact` SET `phone`='$POAStatus[$key]' WHERE `code`='$clientcode[$key]' AND `converted`='1'",$con) or die(mysql_error());
}

else if($type==5)
{
$getData=mysql_query("UPDATE `contact` SET `altemail`='$POAStatus[$key]' WHERE `code`='$clientcode[$key]' AND `converted`='1'",$con) or die(mysql_error());
}

else if($type==6)
{
$getData=mysql_query("UPDATE `contact` SET `%brokerage`='$POAStatus[$key]' WHERE `inroducer`='$clientcode[$key]' AND `converted`='1'",$con) or die(mysql_error());

}

else if($type==7)
{
$getData=mysql_query("UPDATE `contact` SET `pancardnumber`='$POAStatus[$key]' WHERE `code`='$clientcode[$key]' AND `converted`='1'",$con) or die(mysql_error());

}

else if($type==8)
{
$getData=mysql_query("UPDATE `customersupport` SET `customersupport`.`BOClientOwner`='$POAStatus[$key]' WHERE `tradingbellsid`='$clientcode[$key]'",$con) or die(mysql_error());
}

else if($type==9)
{
//,`%brokerage`='10'	
$getData=mysql_query("UPDATE `contact` SET `contact`.`inroducer`='$POAStatus[$key]',`%brokerage`='10' WHERE `code`='$clientcode[$key]'",$con) or die(mysql_error());
}

else if($type==10)
{
 $getData=mysql_query("UPDATE `customersupport` SET `customersupport`.`BoMobileNumber2`='$POAStatus[$key]' WHERE `tradingbellsid`='$clientcode[$key]'",$con) or die(mysql_error());
}

else if($type==11)
{
 $dateUpdate=date('Y-m-d', strtotime(str_replace('/', '-',$POAStatus[$key])));	
 $getData=mysql_query("UPDATE `contact` SET `contact`.`dob`='$dateUpdate' WHERE `code`='$clientcode[$key]'",$con) or die(mysql_error());
}

else if($type==12)
{
$dateUpdate=date('Y-m-d', strtotime(str_replace('/', '-',$POAStatus[$key])));	

$getData=mysql_query("UPDATE `customersupport` SET `customersupport`.`first_trade_date`='$dateUpdate' WHERE `customersupport`.`tradingbellsid`='$clientcode[$key]'",$con) or die(mysql_error());
}

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

	

?>
<script type="text/javascript">
/* window.top.window.document.getElementById('uploadStats').style.display = 'none';
window.top.window.document.getElementById('bigMoodle').style.display = 'block';
window.top.window.document.getElementById('manipulatemoodleContent').style.display = 'block';
window.top.window.document.getElementById('viewmoodleContent').style.display = 'block';
window.top.window.document.getElementById('manipulatemoodleContent').innerHTML ="Data Successfully Uploaded";   */
</script> 	


