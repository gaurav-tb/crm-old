<?php

include("../include/connection.php");
$getData = mysql_query("SELECT * FROM `servicecall` WHERE `type` = 'c'",$con) or die(mysql_error());
$already=Array(); 
while($row = mysql_fetch_array($getData))
{
$cid = $row['cid'];
$tid = $row['transactionalid'];
if(array_key_exists($tid,$already))
{
$val = $already[$tid];
if($val != $cid)
{
echo $tid;
echo "<br/>";
}
}
else
{
$already[$tid] = $cid;
}

}

?>
