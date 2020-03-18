 
<?php
$guid="500a588146923e0f4c000003";//Request of delivery report
$seqid="10136"; //sequence id 
$url="http://vtermination.com/api/check_delivery.php";

//format of xml api , pass one parameter either guid or seqid
$data=urlencode('<REQUEST><username>username</username><password>password</password>
<guid>'.$guid.'</guid><seqid>'.$seqid.'</seqid></REQUEST>
');


$data='xml=1&data='.urlencode($data);
		$objURL = curl_init($url);
		curl_setopt($objURL, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($objURL,CURLOPT_POST,1);
		curl_setopt($objURL, CURLOPT_POSTFIELDS,$data);
		$response = trim(curl_exec($objURL));
		curl_close($objURL);
echo $response;
//save the response in a text file to view
?>
