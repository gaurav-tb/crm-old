<?php
include("../include/conFig.php");
$post = $_GET['post'];

mysql_query("INSERT INTO `message` (`id`, `user`, `message`, `createdate`, `delete`) VALUES ('', '$loggeduserid', '$post', '$datetime', '0')",$con) or die(mysql_error());


?>

