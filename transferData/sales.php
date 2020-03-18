<?php

include('../include/connection.php');


$i=1;

$datetime = date("Y-m-d H:i:s");

$getData = mysql_query("SELECT * FROM `sales_order` WHERE `delete` = '0' ORDER BY `s_so_id` ASC",$con) or die(mysql_error());

while($row = mysql_fetch_array($getData))

{

$username = $row['s_owner'];

$leadStatus = $row['s_status'];

$leadSource = $row['s_source'];

$services = $row['s_services'];





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





$desc = $row[17]." ".$row[33];

$desc = addslashes($desc);



$moddate = $row[9]." 00:00:00";

$crdate = $row[10]." 00:00:00";

echo "INSERT INTO `contact` (`ownerid`, `fname`, `lname`, `phone`, `mobile`, `email`, `website`, `leadstatus`, `leadsource`, `latestresponse`, `contactstatus`, `callbackdate`, `revenue`, `conversiondate`, `messengerid`, `address`, `city`, `description`, `product`, `alloted`, `converted`, `mark`, `self`, `id`, `createdate`, `modifieddate`, `updatedby`, `altemail`, `dob`, `traderprofile`, `experience`, `invamount`, `genby`, `language`, `contacted`, `read`, `lotsize`, `delete`, `transfrom`)VALUES ('$userid', '$row[2]', '$row[1]', '$row[4]', '$row[5]', '$row[3]', '$row[6]', '$leadStatusId', '$leadSourceId', '$leadResponseId', '', '', '', '', '', '$row[14]', '1', '$desc', '$tosavestr', '1', '1', '1', '0','', '$crdate', '$moddate', '1', '', '', '', '', '', '', '', '', '1', '$row[26]', '', '')";
mysql_query("INSERT INTO `contact` (`ownerid`, `fname`, `lname`, `phone`, `mobile`, `email`, `website`, `leadstatus`, `leadsource`, `latestresponse`, `contactstatus`, `callbackdate`, `revenue`, `conversiondate`, `messengerid`, `address`, `city`, `description`, `product`, `alloted`, `converted`, `mark`, `self`, `id`, `createdate`, `modifieddate`, `updatedby`, `altemail`, `dob`, `traderprofile`, `experience`, `invamount`, `genby`, `language`, `contacted`, `read`, `lotsize`, `delete`, `transfrom`)VALUES ('$userid', '$row[2]', '$row[1]', '$row[4]', '$row[5]', '$row[3]', '$row[6]', '$leadStatusId', '$leadSourceId', '$leadResponseId', '', '', '', '', '', '$row[14]', '1', '$desc', '$tosavestr', '1', '1', '1', '0','', '$crdate', '$moddate', '1', '', '', '', '', '', '', '', '', '1', '$row[26]', '', '')",$con) or die(mysql_error());
/*
$thisIdtouse = mysql_insert_id($con);

$product = explode(",",$row['s_product']);

$quantity = explode(",",$row['s_quantity']);

$price = explode(",",$row['s_price']);

$start = $row['s_start_date'];

$enddate = $row['s_end_date'];

$discount = $row['s_discount'];

$adjustment = $row['s_adjustment'];

$amount = $row['s_amount'];

$approved = $row['s_approved'];

$totalPrice = 0;

foreach($price as $pal)

{

$totalPrice +=  $pal;

}

echo $thisIdtouse;

echo "<br/>";

mysql_query("INSERT INTO `invoice` (`cid`, `transactionalid`, `html`, `totalprice`, `discount`, `adjustment`, `grandtotal`, `id`, `approved`, `createdate`, `modifieddate`, `updatedby`, `dealtype`, `offer`, `term`, `sms`, `call`, `messenger`, `bank`, `paymode`, `paydetails`, `des`, `delete`, `partialpayment`) VALUES ('$thisIdtouse', '$thisIdtouse', '', '$totalPrice', '$discount', '$adjustment', '$amount', '', '$approved', '$crdate', '$moddate', '1', '', '', '', '1', '0', '1', '', '', '', '', '', '$amount')",$con) or die(mysql_error());



foreach($product as $key=> $tal)

{

$getPid = mysql_query("SELECT `id` FROM `product` WHERE `name` LIKE '%$tal%'",$con) or die(mysql_error());

$rwPid = mysql_fetch_array($getPid);

if($rwPid[0] != '1')

{

mysql_query("INSERT INTO `servicecall` (`cid`, `mobile`, `product`, `quantity`, `fromdate`, `todate`, `subtotal`, `transactionalid`, `type`, `approved`, `id`, `createdate`, `modifieddate`, `updatedby`, `sms`, `call`, `messenger`, `delete`, `alertexpiry`)VALUES ('$thisIdtouse', '$row[5]', '$rwPid[0]', '$quantity[$key]', '$start', '$enddate', '$price[$key]', '$thisIdtouse', 'c', '$approved', '', '$crdate', '$moddate', '1', '1', '0', '1', '', '')",$con) or die(mysql_error());

}

}
*/




$i++;

}
echo "<br/><br/>";
echo $i;

?>