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
$teamid = $post[$i];
$target = $post[$i+1];
$target = trim($target);
	$getData = mysql_query("SELECT * FROM `teamtarget` WHERE `range` = '$post[0]' AND `teamid` = '$teamid'",$con) or die(mysql_error());
	if(mysql_num_rows($getData) > 0)
	{
		$row = mysql_fetch_array($getData);
		$id = $row['id'];
		
			mysql_query("UPDATE `teamtarget` SET `target`='$target' WHERE `id`='$id'",$con) or die(mysql_error());
	}
	else
	{
			mysql_query("INSERT INTO `teamtarget`(`range`, `teamid`, `target`, `id`) VALUES ('$post[0]','$teamid','$target','')",$con) or die(mysql_error());
	}


$i++;
}

?>
DONOTSHOW
