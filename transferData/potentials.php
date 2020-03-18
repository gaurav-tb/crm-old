<?php

include('../include/connection.php');


$i=1;

$datetime = date("Y-m-d H:i:s");

$getData = mysql_query("SELECT * FROM `potentials` WHERE `delete` = '0' ORDER BY `p_pot_id` ASC",$con) or die(mysql_error());

while($row = mysql_fetch_array($getData))

{

$username = $row['p_owner'];

$leadStatus = $row['p_stage'];

$leadSource = $row['p_source'];

$services = $row['p_service'];



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







$getCat = mysql_query("SELECT `id` FROM `leadstatus` WHERE `name` LIKE '%$leadStatus%'",$con) or die(mysql_error());

$rowCat = mysql_fetch_array($getCat);

$leadStatusId = "-".$rowCat[0]."-,";



$getCat = mysql_query("SELECT `id` FROM `leadsource` WHERE `name` LIKE '%$leadSource%'",$con) or die(mysql_error());

$rowCat = mysql_fetch_array($getCat);

$leadSourceId= $rowCat[0];



$leadResponseId= '1';





$desc = $row[23]." ".$row[24];

$desc = addslashes($desc);



$moddate = $row[9]." 00:00:00";

$crdate = $row[10]." 00:00:00";

echo "INSERT INTO `contact` (`ownerid`, `fname`, `lname`, `phone`, `mobile`, `email`, `website`, `leadstatus`, `leadsource`, `latestresponse`, `contactstatus`, `callbackdate`, `revenue`, `conversiondate`, `messengerid`, `address`, `city`, `description`, `product`, `alloted`, `converted`, `mark`, `self`, `id`, `createdate`, `modifieddate`, `updatedby`, `altemail`, `dob`, `traderprofile`, `experience`, `invamount`, `genby`, `language`, `contacted`, `read`, `lotsize`, `delete`, `transfrom`) VALUES('$userid', '$row[2]', '$row[1]', '$row[17]', '$row[16]', '$row[15]', '$row[22]', '$leadStatusId', '$leadSourceId', '$leadResponseId', '', '$row[13]', '$row[7]', '', '$row[11]', '$row[19]', '1', '$desc', '$tosavestr', '1', '0', '1', '0','', '$crdate', '$moddate', '1', '', '', '', '', '', '', '', '', '$row[31]', '$row[25]', '', '')";
mysql_query("INSERT INTO `contact` (`ownerid`, `fname`, `lname`, `phone`, `mobile`, `email`, `website`, `leadstatus`, `leadsource`, `latestresponse`, `contactstatus`, `callbackdate`, `revenue`, `conversiondate`, `messengerid`, `address`, `city`, `description`, `product`, `alloted`, `converted`, `mark`, `self`, `id`, `createdate`, `modifieddate`, `updatedby`, `altemail`, `dob`, `traderprofile`, `experience`, `invamount`, `genby`, `language`, `contacted`, `read`, `lotsize`, `delete`, `transfrom`) VALUES('$userid', '$row[2]', '$row[1]', '$row[17]', '$row[16]', '$row[15]', '$row[22]', '$leadStatusId', '$leadSourceId', '$leadResponseId', '', '$row[13]', '$row[7]', '', '$row[11]', '$row[19]', '1', '$desc', '$tosavestr', '1', '0', '1', '0','', '$crdate', '$moddate', '1', '', '', '', '', '', '', '', '', '$row[31]', '$row[25]', '', '')",$con) or die(mysql_error());


$i++;

echo $i;

}



?>