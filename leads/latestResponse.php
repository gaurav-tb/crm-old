     <?php
    include("../include/conFig.php");
 	if(isset($_GET['LatestID']))
	{
    $LatestID=$_GET['LatestID'];
	$ClientID=$_GET['ClientID'];
	
    $res=mysql_query("update `contact` set `latestresponse`='$LatestID' where `id`='$ClientID'",$con) or die(mysql_error());
	
    if($res) 
	{
	/*  Start Sending of Data to website */
  	$getLeadSource = mysql_query("SELECT `latestresponse`,`mobile` FROM `contact` WHERE `id` = '$ClientID'",$con) or die(mysql_error());
    $rowLeadSource = mysql_fetch_array($getLeadSource);	

	if($rowLeadSource[0]==7 || $rowLeadSource[0]==13 || $rowLeadSource[0]==36) 
	{
	$type='Inprogress';	
	$note='Account Opening is in progress';
	}
	if($rowLeadSource[0]==33 || $rowLeadSource[0]==38)
	{
	$type='Notinterested';	
	$note='Not Interested';
	}
	
    $params = Array();
    $params['mobile'] = $rowLeadSource[1];
    $params['type'] = $type;
    $params['notes'] = $note;



    $ch=curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));	
    curl_setopt($ch,CURLOPT_URL,"http://www.bellseye.com/fetchClientStatus.php");
    curl_setopt($ch,CURLOPT_POST,"1");
    curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $output=curl_exec($ch);
    curl_close($ch);
	
   /*  End Sending of Data to website */
    echo '1';
    }
    }

?>


