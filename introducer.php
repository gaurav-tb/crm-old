<?php
error_reporting(0);
include("include/conFig.php");
if($loggeduserid == 1) 
{
$getData=mysql_query("SELECT * FROM `introducer` WHERE `introducer`,`IsSend`='0'",$con) or die(mysql_error());
if(mysql_num_rows($getData)>0)
{
$row=mysql_fetch_array($getData);

$id=$row['id'];

$params = Array();
$params['introducer'] = $row['introducer'];
$params['code'] = $row['code'];
$params['%brokerage'] = 0;


$ch=curl_init();
curl_setopt($ch,CURLOPT_HTTPHEADER, array('Expect:'));	
curl_setopt($ch,CURLOPT_URL,"http://tradingbells.com/introducer.php");
curl_setopt($ch,CURLOPT_POST,"1");
curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$output=curl_exec($ch);
curl_close($ch);

mysql_query("UPDATE `introducer` SET `IsSend`='1' WHERE `id`='$id'",$con) or die(mysql_error());

}
else
{
echo "Invalid Request";
}

} 
else 
{
echo "Invalid Request";
} 

mysql_close(); 

?>
