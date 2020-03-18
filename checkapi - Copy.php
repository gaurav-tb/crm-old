<?php
    include("include/connection.php");
    $url ='http://www.bellseye.com/getPartnerleads.php?u=41';

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Host: www.bellseye.com", "Cache-Control: max-age=0", "Proxy-Connection: keep-alive","Upgrade-Insecure-Requests: 1","User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36"));
    $tuData = curl_exec($curl);
    $all = json_decode($tuData,true);
    curl_close($curl); 

   print_r($all);  

?>