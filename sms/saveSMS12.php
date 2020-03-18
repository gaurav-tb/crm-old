<?php
/*
$url = "http://bulkpush.mytoday.com/BulkSms/SingleMsgApi?feedid=334479&username=9425902297&password=dwmpw&To=917828405804&Text=Hello%20check2350&time=";
echo $url;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($ch);
curl_close($ch);
//echo $output;
//print_r($output);

//$xml = simplexml_load_string($output);
//print_r($xml)
*/
$data='<!DOCTYPE REQ SYSTEM "http://bulkpush.mytoday.com/BulkSms/BulkSmsV1.00.dtd">
<REQ>
<VER>1.0</VER>
<USER>
        <USERNAME>9425902297</USERNAME>
        <PASSWORD>dwmpw</PASSWORD>
</USER>
<ACCOUNT>
        <ID>334479</ID>
</ACCOUNT>
<MESSAGE>
              <TAG>Uniqe tag 1</TAG>
               <TEXT>test</TEXT>                        
                     
        <MID>1</MID>               
                <SMS FROM="RESRCH" TO ="918602727992" INDEX="1" TIME=""></SMS>                
</MESSAGE>
</REQ>';

 
$apiUrl = "http://bulkpush.mytoday.com/BulkSms/SendSms";

$ch = curl_init($apiUrl);
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS, "UserRequest=".$data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
$output = curl_exec ($ch);
curl_close ($ch);
echo $output;
?>