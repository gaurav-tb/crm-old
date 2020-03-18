<?php
include("include/conFig.php");
$dx = $_GET['dx'];
$table = $_GET['table'];
$dx = explode(",",$dx);
foreach($dx as $val)
{
  if($val == 0){
    continue;
  }

$count1 = mysql_query("SELECT id FROM customersupport WHERE ownerid = '$val'",$con) or die(mysql_error());
$count2 = mysql_query("SELECT id FROM customersupport WHERE allotmentid='$val'",$con) or die(mysql_error());
$count3 = mysql_query("SELECT id FROM customersupport WHERE RMOwnerid='$val'",$con) or die(mysql_error());
$count4 = mysql_query("SELECT id FROM contact WHERE ownerid = '$val' and `delete`=0",$con) or die(mysql_error());

  $check1 = mysql_query("SELECT id FROM customersupport WHERE ownerid = '$val' OR allotmentid='$val' OR RMOwnerid='$val'",$con) or die(mysql_error());
  $check2 = mysql_query("SELECT id FROM contact WHERE ownerid = '$val' and `delete`=0",$con) or die(mysql_error());
 
$clientOwner = mysql_num_rows($count1);
$supportOwner = mysql_num_rows($count2);
$rmOwner = mysql_num_rows($count3);
$lead = mysql_num_rows($count4);

  if(mysql_num_rows($check1) > 0 || mysql_num_rows($check2)>0){
   
    echo "This employee is RM Owner of ".$rmOwner." ,Support Owner of ".$supportOwner." And Owner of ".$clientOwner." clients And Owner of ".$lead." leads.";
  }
  }?>