<?php
session_start();
ob_start();
include("../include/conFig.php");
$from = $_GET['from'];
$to = $_GET['to'];
$transfer = $_GET['transfer'];
$status = $_GET['status'];


if($status==1)
{
	if($transfer==1)
	{
		// //echo "SELECT `profile` FROM `employee` WHERE `delete` = '0' AND `id` = '$from'";
		// $getEmp = mysql_query("SELECT `profile` FROM `employee` WHERE `delete` = '0' AND `id` = '$from'",$con) or die(mysql_error());
		// $rowEmp = mysql_fetch_row($getEmp);
		// //print_r($rowEmp);
		// $profile = $rowEmp[0];
		// if($profile == '16' || $profile == '19' || $profile == '30'|| $profile == '11'|| $profile == '28'|| $profile == '29'){
			//echo "UPDATE customersupport SET RMOwnerid = '$to' WHERE RMOwnerid = '$from'";
			$changeRM = mysql_query("UPDATE customersupport SET RMOwnerid = '$to' WHERE RMOwnerid = '$from'",$con) or die(mysql_error());

		//}

	}
	if($transfer == 2){
		// $getEmp = mysql_query("SELECT `profile` FROM `employee` WHERE `delete` = '0' AND `id` = '$from'",$con) or die(mysql_error());
		// $rowEmp = mysql_fetch_row($getEmp);
		// $profile = $rowEmp[0];
		// if($profile == '8' || $profile == '9'){
			mysql_query("UPDATE `customersupport` SET `allotmentid` = '$to'  WHERE `allotmentid` = '$from'",$con) or die(mysql_error());
		//}
	}
	if($transfer == 3){
		// $getEmp = mysql_query("SELECT id FROM `employee` WHERE `delete` = '0' AND `id` = '$to'",$con) or die(mysql_error());
		// $rowEmp = mysql_fetch_row($getEmp);
		// $id = $rowEmp[0];
		// if($id == '529'){
			mysql_query("UPDATE `customersupport` SET `ownerid` = '$to'  WHERE `ownerid` = '$from'",$con) or die(mysql_error());
			mysql_query("UPDATE `contact` SET `ownerid` = '$to'  WHERE `ownerid` = '$from' and `converted`=1",$con) or die(mysql_error());
		//}
	}
}else if($status == 2){
	if($transfer == 1){

	}
	if($transfer == 2){

	}
	if($transfer == 3){
		
	}
}else{

}



  


//header("location:transferView.php?message=Successfully Transferred");
?>
