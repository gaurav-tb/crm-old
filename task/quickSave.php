<?php
include("../include/conFig.php");
$name = $_GET['name'];
$mobile = $_GET['mobile'];
$valto = $_POST['valto'];
//Pranay Dongre*$*$*Subject*$*$*1*$*$*2012-10-17*$*$*3*$*$*5*$*$*null*$*$*1*$*$*null*$*$*1*$*$*desc
$valto = explode("*$*$*",$valto);

foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
if($post[4] < 10)
{
$post[4]= "0".$post[4];
}
if($post[5]< 10)
{
$post[5]= "0".$post[5];
}

$toSavedate = $post[3]." ".$post[4].":".$post[5].":00"; 
//echo "INSERT INTO `task`(`id`, `owner`, `subject`, `status`, `reminddate`, `email`, `profile`, `popup`, `sms`, `description`, `createdate`, `modifieddate`, `updatedby`, `contactid`, `delete`) VALUES ('','$loggeduserid','$post[1]','$post[2]','$toSavedate','$post[6]','$post[7]','$post[8]','$post[9]','$post[10]','$datetime','$datetime','$loggeduserid','0','0'";
mysql_query("INSERT INTO `task`(`id`, `owner`, `subject`, `status`, `reminddate`, `email`, `profile`, `popup`, `sms`, `description`, `createdate`, `modifieddate`, `updatedby`, `contactid`, `delete`) VALUES ('','$loggeduserid','$post[1]','$post[2]','$toSavedate','$post[6]','$post[7]','$post[8]','$post[9]','$post[10]','$datetime','$datetime','$loggeduserid','$post[11]','0')",$con) or die(mysql_error());
$id = mysql_insert_id();
echo $id;
?>
