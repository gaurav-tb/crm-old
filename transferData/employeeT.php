<?php

include('../include/connection.php');

$getUsers = mysql_query("SELECT * FROM `user_details`",$con) or die(mysql_error());

while($row = mysql_fetch_array($getUsers))

{
mysql_query("INSERT INTO `employee`( `username`, `password`, `name`, `profile`, `status`, `email`, `phone`, `mobile`, `dob`, `address`, `city`, `state`, `comments`, `createdate`, `modifieddate`, `updatedby`) VALUES ('$row[0]','$row[1]','$row[2]','2','1','$row[5]','$row[6]','$row[7]','$row[8]','$row[9]','1','1','$row[12]','$row[13]','$row[14]','1')",$con) or die(mysql_error());
}



?>