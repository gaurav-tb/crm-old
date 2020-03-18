<?php
// $params = Array();
// $params['content'] = 'Hello';
// $params['recipients'] = '7singhgaurav1992@gmail.com';
// $params['subject'] = 'testing';
// $params['recipients_cc'] = '';
// $params['bcc'] ='';
// $params['from'] ='info@tradingbells.com';  //$fromEmail
// $params['replytoid'] ='info@tradingbells.com';  //$replyToId
// $params['fromname'] = 'Tradingbells';
// $params['api_key'] ="acd293ca5a3b70c6e958f65c495f1721";
// $params['opentrack'] = "1";
// $params['clicktrack'] ="1";
// $params['X-APIHEADER'] = "1234";




// $ch=curl_init();
// curl_setopt($ch,CURLOPT_HTTPHEADER, array('Expect:'));	
// curl_setopt($ch,CURLOPT_URL,"http://api.falconide.com/falconapi/web.send.rest");
// curl_setopt($ch,CURLOPT_POST,"1");
// curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
// curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
// $output=curl_exec($ch);
// curl_close($ch);


// print_r($output);



$url = "http://bulkpush.mytoday.com/BulkSms/SingleMsgApi?feedid=360855&username=9177022699&password=mjttt&To=919399685872&Text=Hello";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$curl_scraped_page = curl_exec($ch);
curl_close($ch);

print_r($curl_scraped_page);
?>