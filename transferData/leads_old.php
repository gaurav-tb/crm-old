<?php
include('../include/connection.php');

$conOld = mysql_connect("localhost","marketma_mmcrm","mktmagfy");
if (!$conOld)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("marketma_mmcrm", $conOld);

$i=1;
$datetime = date("Y-m-d H:i:s");
$getData = mysql_query("SELECT * FROM `leads` WHERE `delete` = '0' ORDER BY `l_lead_id` ASC",$conOld) or die(mysql_error());
while($row = mysql_fetch_array($getData))
{
echo $i;
echo "<br/>";
$username = $row['l_owner'];
$leadStatus = $row['l_status'];
$leadSource = $row['l_source'];
$leadResponse = $row['l_response'];
$services = $row['l_services'];


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





$getCat = mysql_query("SELECT `id` FROM `employee` WHERE `username` = '$username'",$con) or die(mysql_error());
$rowCat = mysql_fetch_array($getCat);
$userid = $rowCat[0];



$getCat = mysql_query("SELECT `id` FROM `leadstatus` WHERE `name` LIKE '%$leadStatus%'",$con) or die(mysql_error());
$rowCat = mysql_fetch_array($getCat);
$leadStatusId = "-".$rowCat[0]."-,";

$getCat = mysql_query("SELECT `id` FROM `leadsource` WHERE `name` LIKE '%$leadSource%'",$con) or die(mysql_error());
$rowCat = mysql_fetch_array($getCat);
$leadSourceId= $rowCat[0];

$getCat = mysql_query("SELECT `id` FROM `leadresponse` WHERE `name` LIKE '%$leadResponse%'",$con) or die(mysql_error());
$rowCat = mysql_fetch_array($getCat);
$leadResponseId= $rowCat[0];


$desc = $row[17]." ".$row[18];
$desc = addslashes($desc);
$crtdate = $row[24]." 00:00:00";
$moddate = $row[24]." 00:00:00";

mysql_query("INSERT INTO `contact` (`ownerid`, `fname`, `lname`, `phone`, `mobile`, `email`, `website`, `leadstatus`, `leadsource`, `latestresponse`, `contactstatus`, `callbackdate`, `revenue`, `conversiondate`, `messengerid`, `address`, `city`, `description`, `product`, `alloted`, `converted`, `mark`, `self`, `id`, `createdate`, `modifieddate`, `updatedby`, `altemail`, `dob`, `traderprofile`, `experience`, `invamount`, `genby`, `language`, `contacted`, `read`, `lotsize`, `delete`, `transfrom`)VALUES ('$userid', '$row[1]', '$row[2]', '$row[4]', '$row[5]', '$row[3]', '$row[6]', '$leadStatusId', '$leadSourceId', '$leadResponseId', '', '$row[11]', '', '', '$row[12]', '$row[14]', '1', '$desc', '$tosavestr', '1', '0', '0', '0','', '$row[24]', '$row[25]', '1', '', '', '', '', '', '', '', '', '$row[27]', '$row[20]', '', '')",$con) or die(mysql_error());
$i++;
}

?>