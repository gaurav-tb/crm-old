<?php 
      include("include/conFig.php"); 
       
        $datetime = date('Y-m-d H:i:s');
        if(isset($_GET['cid']))
        {
        $cid = $_GET['cid'];
     	$code = $_GET['code'];
        $relationship = $_GET['relationship'];
      	$relative_name = $_GET['relative_name'];
     	
        $result= mysql_query("SELECT * FROM `ta_authorities` where cid='$cid'",$con) or die(mysql_error());

        if(mysql_fetch_array($result)==0)
        {
         mysql_query("INSERT INTO `ta_authorities` (`cid`,`code`,`relations`,`relative_name`
         	,`created_by`,`created_on`) VALUES ('$cid','$code','$relationship','$relative_name','$datetime','$loggeduserid')",$con) or die(mysql_error());
        }
        else
        {
        mysql_query("UPDATE `ta_authorities` set `relations`='$relationship',`relative_name`='$relative_name',`created_by`='$loggeduserid',`created_on`='$datetime'",$con) or die(mysql_error());

        }

        echo 1;	

        }	
        else
        {
        echo 0;
        }


		mysql_close(); 

?>
