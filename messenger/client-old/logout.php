<?php
session_start();
ob_start();
$expire= time() - 60 ;
setCookie("lcusername",$username,$expire,"/");
setCookie("llcuserid",$loggedid,$expire,"/");
setCookie("lcname",$name,$expire,"/");
session_destroy();
header("location:index.php");

?>