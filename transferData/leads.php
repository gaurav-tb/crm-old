<?php

include('../include/connection.php');

$getData = mysql_query("SELECT * FROM `leads` WHERE `delete` = '0'",$con) or die(mysql_error());

while($row = mysql_fetch_array($getData))

{




$username = $row['l_owner'];

$leadStatus = $row['l_status'];

$leadSource = $row['l_source'];

$leadResponse = $row['l_response'];

$services = $row['l_services'];





$serviceArray = Array("8","9","4","7","6","5","2","3","10","11","12","13");

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







$getCat = mysql_query("SELECT `id` FROM `leadstatus` WHERE `name` = '$leadStatus'",$con) or die(mysql_error());

$rowCat = mysql_fetch_array($getCat);

$leadStatusId = "-".$rowCat[0]."-,";



$getCat = mysql_query("SELECT `id` FROM `leadsource` WHERE `name` = '$leadSource'",$con) or die(mysql_error());

$rowCat = mysql_fetch_array($getCat);

$leadSourceId= $rowCat[0];



$getCat = mysql_query("SELECT `id` FROM `leadresponse` WHERE `name` = '$leadResponse'",$con) or die(mysql_error());

$rowCat = mysql_fetch_array($getCat);

$leadResponseId= $rowCat[0];





$desc = $row[18]." ".$row[19];

$desc = addslashes($desc);




echo "INSERT INTO `contact` (`ownerid`, `fname`, `lname`, `phone`, `mobile`, `email`, `website`, `leadstatus`, `leadsource`, `latestresponse`, `contactstatus`, `callbackdate`, `revenue`, `conversiondate`, `messengerid`, `address`, `city`, `description`, `product`, `alloted`, `converted`, `mark`, `self`, `id`, `createdate`, `modifieddate`, `updatedby`, `altemail`, `dob`, `traderprofile`, `experience`, `invamount`, `genby`, `language`, `contacted`, `read`, `lotsize`, `delete`, `transfrom`,`callbacktime`)VALUES ('$userid', '$row[1]', '$row[2]', '$row[4]', '$row[5]', '$row[3]', '$row[6]', '$leadStatusId', '$leadSourceId', '$leadResponseId', '', '$row[11]', '', '', '$row[12]', '$row[15]', '1', '$desc', '$tosavestr', '1', '0', '0', '0','', '$row[27]', '$row[27]', '1', '', '', '', '', '', '', '', '', '', '$row[21]', '', '','')";
mysql_query("INSERT INTO `contact` (`ownerid`, `fname`, `lname`, `phone`, `mobile`, `email`, `website`, `leadstatus`, `leadsource`, `latestresponse`, `contactstatus`, `callbackdate`, `revenue`, `conversiondate`, `messengerid`, `address`, `city`, `description`, `product`, `alloted`, `converted`, `mark`, `self`, `id`, `createdate`, `modifieddate`, `updatedby`, `altemail`, `dob`, `traderprofile`, `experience`, `invamount`, `genby`, `language`, `contacted`, `read`, `lotsize`, `delete`, `transfrom`,`callbacktime`)VALUES ('$userid', '$row[1]', '$row[2]', '$row[4]', '$row[5]', '$row[3]', '$row[6]', '$leadStatusId', '$leadSourceId', '$leadResponseId', '', '$row[11]', '', '', '$row[12]', '$row[15]', '1', '$desc', '$tosavestr', '1', '0', '0', '0','', '$row[27]', '$row[27]', '1', '', '', '', '', '', '', '', '', '', '$row[21]', '', '','')",$con) or die(mysql_error());

}



?>