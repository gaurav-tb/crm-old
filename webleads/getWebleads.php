<?php

$conold= mysql_connect("173.254.28.128","wricksc1_magnify","mktmagfy");
if (!$conold)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("wricksc1_magnify", $conold);

$con = mysql_connect('localhost','root','');
if(!$con){die(mysql_error());
}
else
{
mysql_select_db('marketmagnify',$con);
}
$datetime = date("Y-m-d H:i:s");

$time = time() - (60*60*24);
$yesterday = date("Y-m-d",$time);
$getwebL = mysql_query("SELECT * FROM `leads` WHERE `date` = '$yesterday'",$conold) or die(mysql_error());
while($row = mysql_fetch_array($getwebL))
{
$thisid = $row['id'];
$services = $row[6];

$serviceArray = Array("3","7","8","4","5","6","9","10","11");
$inwardArray = explode("-",$services);
$tosavestr = '';
$j=0;
foreach($inwardArray as $val)
{
if($val == 'true')
{
$tosavestr .= "-".$serviceArray[$j]."-,";
}
$j++;
}
mysql_query("INSERT INTO `webleads`(`f_name`, `l_name`, `mobile`, `email`, `city`, `messanger_id`, `services`, `start_date`, `end_date`, `un_id`, `reg_date`, `created_by`, `ft`, `shifted`) VALUES ('$row[0]', '$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row[5]', '$tosavestr', '$row[7]', '$row[8]', '', '$row[11]', '15', '', '0')",$con) or die(mysql_error());
mysql_query("UPDATE `leads` SET `shifted` = '1' WHERE `id` = '$thisid'",$conold) or die(mysql_error());
}
?>
