    <?php 
    include("include/conFig.php");
    $url ='http://www.bellseye.com/getPartnerleads.php?u=41';

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Host: www.bellseye.com", "Cache-Control: max-age=0", "Proxy-Connection: keep-alive","Upgrade-Insecure-Requests: 1","User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36"));
    $tuData = curl_exec($curl);
    $all = json_decode($tuData,true);
    curl_close($curl); 

    $email_partner=$all['email'];
    $temp=$all['data'];


    if(!empty($temp))
    {   
    $table="<table border='1' style='border-bottom:1px solid #ddd;width:100%;text-align:center;cursor:pointer'>";

    $table .="
    <tr>
    <td>S.No.</td>
    <td>Name</td>
    <td>Email Address</td>
    <td>Mobile</td>
    <td>Accepted/Rejected</td>
    <td>Status</td>
    </tr>";

    $i='1';
  

	foreach($temp as $val)
	{
    $name = ucwords((strtolower($val['name'])));
    $mobile_trim=str_replace(" ","",$val['number']);
    $mobile = substr($mobile_trim, -10);
    $email = $val['email'];
    $code = $val['code'];	
	

	$checkOld = mysql_query("SELECT * FROM `contact` WHERE `mobile` LIKE '%$mobile%' OR `phone` LIKE '%$mobile%'",$con) or die(mysql_error());
    

    if(mysql_num_rows($checkOld) == 0)
    {
    $table .=" 
    <tr>
    <td>".$i."</td>  
    <td>".$name."</td>
    <td>".$email."</td>
    <td>".$mobile."</td>
    <td>Accepted </td>
    <td>Accepted</td>
    </tr>";
    


    $result=mysql_query("SELECT ownerid from contact where code='$code'",$con) or die(    mysql_error());
    $rowOwner=mysql_fetch_array($result);
    $ownerID = $rowOwner['ownerid'];        


    mysql_query("INSERT INTO `contact` (`ownerid`, `fname`, `mobile`, `email`, `leadstatus`, `leadsource`, `latestresponse`, `contactstatus`, `callbackdate`,  `city`, `product`, `alloted`, `converted`, `mark`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`,`notified`,`inroducer`) VALUES ('$ownerID', '$name', '$mobile', '$email', '3', '57', '1', '1', '$date', '1', '1', '1', '0', '0', '', '$datetime', '$datetime', '$loggeduserid', '0','1','$code')",$con) or die(mysql_error());
      

    $thisid = mysql_insert_id();

    $note="New Lead created under the bussiness partner lead";

    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('Website', '$note', '$thisid', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());

    }


     else 
	 {
	 $rowOld = mysql_fetch_array($checkOld);
     $result=mysql_query("SELECT name FROM leadresponse WHERE id = '".$rowOld['latestresponse']."'",$con) or die(mysql_error());
     $leadname=mysql_fetch_row($result);
     $cid=$rowOld['id'];

    $note="Mobile number re-entered from the website under the bussiness partner lead";
	
    if($rowOld['latestresponse']=='1' || $rowOld['latestresponse']=='33' || $rowOld['latestresponse']=='53' || $rowOld['latestresponse']=='54' || $rowOld['latestresponse']=='55' || $rowOld['latestresponse']=='56' || $rowOld['latestresponse']=='2' || $rowOld['latestresponse']=='38' || $rowOld['latestresponse']=='37')
    {

    $result=mysql_query("SELECT ownerid from contact where code='$code'",$con) or die(    mysql_error());
    $rowOwner=mysql_fetch_array($result);
    $ownerID = $rowOwner['ownerid'];    

     mysql_query("UPDATE contact set ownerid='$ownerID',leadsource='57',latestresponse='1',description='',`inroducer`='$code' WHERE `contact`.`converted`='0' and `contact`.`id`='$cid'",$con) or die(mysql_error());

    }

   

    mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('Website', '$note', '$cid', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());


    $table .=" 
    <tr>
    <td>".$i."</td>  
    <td>".$rowOld['fname']."</td>
    <td>".$rowOld['email']."</td>
    <td>".$rowOld['mobile']."</td>
    <td> Rejected </td>
    <td>".$leadname[0]."</td>
    </tr>";
    }
    

    $i++;
    }


 

   $table .="</table>";

$params = Array();
$params['content'] = $table;
$params['recipients'] = $email_partner;
$params['subject'] = 'Partner Dashboard Lead Status';
$params['recipients_cc'] = '';
$params['bcc'] = '';
$params['from'] ='info@tradingbells.club';  //$fromEmail //info@tradingbells.in
$params['replytoid'] ='info@tradingbells.com';  //$replyToId
$params['fromname'] = 'TradingBells';
$params['api_key'] ="acd293ca5a3b70c6e958f65c495f1721";
$params['opentrack'] = "1";
$params['clicktrack'] ="1";
$params['X-APIHEADER'] = "1234";


$ch=curl_init();
curl_setopt($ch,CURLOPT_HTTPHEADER, array('Expect:'));  
curl_setopt($ch,CURLOPT_URL,"http://api.falconide.com/falconapi/web.send.rest");
curl_setopt($ch,CURLOPT_POST,"1");
curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$output=curl_exec($ch);
curl_close($ch);



}
else
{
 echo '0'; 
}

 mysql_query("DELETE FROM contact WHERE id IN (SELECT * FROM (SELECT id FROM contact where converted='0' and `latestresponse` NOT IN(13,17,34,36) GROUP BY mobile HAVING (COUNT(*) > 1)) AS A )",$con) or die(mysql_error());


// $result = mysql_query("SHOW FULL PROCESSLIST");
// while($row=mysql_fetch_array($result)) 
// {
//   $process_id=$row["Id"];
//   if ($row["Time"] > 200 ) {
//     $sql="KILL $process_id";
//     mysql_query($sql);
//   }
// }

  
?>