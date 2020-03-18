<?php
include("../include/conFig.php");
$rangeId= $_GET['rangeId'];
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);


foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
print_r($post);
$c = count($post);
echo $c;

for($i=1;$i<$c;$i++)
{
$userid = $post[$i];
$target = $post[$i+1];
$target = trim($target);
	$getData = mysql_query("SELECT * FROM `target` WHERE `range` = '$post[0]' AND `userid` = '$userid'",$con) or die(mysql_error());
	if(mysql_num_rows($getData) > 0)
	{
		$row = mysql_fetch_array($getData);
		$id = $row['id'];
		
			mysql_query("UPDATE `target` SET `target`='$target' WHERE `id`='$id'",$con) or die(mysql_error());
	}
	else
	{
			mysql_query("INSERT INTO `target`(`range`, `userid`, `target`, `id`) VALUES ('$post[0]','$userid','$target','')",$con) or die(mysql_error());
	}


$i++;
}

?>
DONOTSHOW