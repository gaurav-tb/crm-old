<?php
$invoice = file_get_contents("invoice.html");
$getCompany = mysql_query("SELECT * FROM `company` WHERE `id` = '1'",$con) or die(mysql_error());
$rowComp = mysql_fetch_array($getCompany);

$invno = "INV".$id;

$cosignee = $fetchData['fname']." ".$fetchData['lname']; 
$adstr	= $fetchData['address']; 
$contactstr	= $fetchData['mobile'].",".$fetchData['email']; 

		foreach($p as $key => $val)
		{
		if($val != '0')
			{
			$getProduct=mysql_query("select * from `product` where `id` = '$val'",$con)or die(mysql_error());
			$rowProduct = mysql_fetch_array($getProduct);
			$tlq = $q[$key];	
			$tls = $st[$key];			
			$brow .= '<tr><td style="text-align:left;border-right:1px #ccc solid"><b>'.$rowProduct['name'].'</b></td><td style="text-align:left;border-right:1px #ccc solid">'.$rowProduct['description'].'</td><td style="text-align:left;border-right:1px #ccc solid">'.$tlq.'</td><td style="text-align:right;">'.$tls.'</td></tr>';	
			}
		
		}
$getCity = ("SELECT `name` FROM `city` WHERE `id` = '$rowComp[3]'",$con) or die(mysql_error());
$rowCity = mysql_fetch_array($getCity);
//$cityName = $rowCity[0]; 
$getState = ("SELECT `name` FROM `state` WHERE `id` = '$rowComp[4]'",$con) or die(mysql_error());
$rowState = mysql_fetch_array($getState);

$logo = str_ireplace("../../","",$rowComp['logo']);
$logo = $rowComp['url'].$logo;
$brow .= '<tr><td style="border-right:1px #ccc solid"></td><td style="border-right:1px #ccc solid"></td><td style="border-right:1px #ccc solid;text-align:right">Discount</td><td style="text-align:right">'.$dc.'</td></tr>';
$brow .= '<tr><td style="border-right:1px #ccc solid"></td><td style="border-right:1px #ccc solid"></td><td style="border-right:1px #ccc solid;text-align:right">Adjustment</td><td style="text-align:right">'.$ad.'</td></tr>'; 
$mainrows = $brow;
$invdate = date("d/m/Y",strtotime($date));

$invoice = str_ireplace("{[##COMPANYNAME##]}",$rowComp['name'],$invoice);
$invoice = str_ireplace("{[##ADR1##]}",$rowComp['adr1'],$invoice);
$invoice = str_ireplace("{[##ADR2##]}",$rowComp['adr2'],$invoice);
$invoice = str_ireplace("{[##CITY##]}",$rowCity[0],$invoice);
$invoice = str_ireplace("{[##STATE##]}",$rowState[0],$invoice);
$invoice = str_ireplace("{[##PINCODE##]}",$rowComp['pincode'],$invoice);
$invoice = str_ireplace("{[##COMPANYLOGO##]}",$logo,$invoice);
$invoice = str_ireplace("{[##COMPEMAIL##]}",$rowComp['email'],$invoice);
$invoice = str_ireplace("{[##PANNO##]}",$rowComp['pan'],$invoice);
$invoice = str_ireplace("{[##FOOTNOTE##]}",$rowComp['footnote'],$invoice);
$invoice = str_ireplace("{[##INVOICENUMBER##]}",$invno,$invoice);
$invoice = str_ireplace("{[##DATE##]}",$invdate,$invoice);
$invoice = str_ireplace("{[##COSIGNEE##]}",$cosignee,$invoice);
$invoice = str_ireplace("{[##CONTACT##]}",$contactstr,$invoice);
$invoice = str_ireplace("{[##ADDRESS##]}",$adstr,$invoice);
$invoice = str_ireplace("{[##GRANDTOTAL##]}",$gt,$invoice);
$invoice = str_ireplace("{[##ROWS##]}",$mainrows,$invoice);


$html = $invoice;
echo $html;




?>