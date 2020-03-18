<?php
include("../include/conFig.php");
$trans = rand(100,10000);
$trans = $trans.time();

  $cid= $_GET['cid'];

  $chkAlreadyAcc= mysql_query("SELECT * FROM `contact` WHERE `accountopeningreffno`='$cid'",$con) or die(mysql_error());

  if(mysql_num_rows($chkAlreadyAcc) > 0)   
  {
   echo "already";
  } 



/*
$cid= $_GET['cid'];
$chkAlready = mysql_query("SELECT `id` FROM `servicecall` WHERE `cid` = '$cid' AND `type` = 'c'",$con) or die(mysql_error());
if(mysql_num_rows($chkAlready) > 0)
{
echo "already";
} 
else
{
/*
$note = "Client conversion requested by <strong>".$loggedname."</strong>";
mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('Crequest', '$note', '$cid', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());
mysql_query("INSERT INTO `servicecall` (`cid`, `type`, `approved`, `id`, `createdate`, `modifieddate`, `updatedby`,`transactionalid`) VALUES ('$cid', 'c', '0', '', '$datetime', '$datetime', '$loggeduserid','$trans')",$con) or die(mysql_error());
	
mysql_query("INSERT INTO `invoice`(`cid`, `transactionalid`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`,`approved`) VALUES ('$cid','$trans','','$datetime','$datetime','$loggeduserid','0','0')",$con) or die(mysql_error());

 }   */


 

?>
