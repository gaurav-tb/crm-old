    <?php
    include("../include/conFig.php");
    
    $valto = $_POST['valto'];
    $id = $_GET['id'];
	$inroducer= $_GET['inroducer'];
	
    $valto = explode("*$*$*",$valto);
	foreach($valto as $val)
	{
	$val = str_ireplace("'","\'",$val);
	$post[] .= $val;
	}
	
	mysql_query("UPDATE `contact` SET `inroducer`='$inroducer' WHERE `id`= '$id'",$con)or die(mysql_error());
	$note = "Client Introducer has been removed by<strong>".$loggedname."</strong>";
	mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('Crequest', '$note', '$id', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());
	
    ?>
