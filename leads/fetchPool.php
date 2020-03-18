<?php
include("../include/conFig.php");
$getNum = mysql_query("SELECT `poolfetch`,`perfetch`,`poolfetchsource` FROM `employee` WHERE `id` = '$loggeduserid'",$con) or die(mysql_error());
$rowNum = mysql_fetch_array($getNum);
$count  = (!empty($rowNum[0])) ? $rowNum[0] : 0;
$limit = (!empty($rowNum[1])) ? $rowNum[1] :0;
$poolfetchsource = (!empty($rowNum[2])) ? $rowNum[2] :2;
$getCurrent = mysql_query("SELECT count(`id`) FROM `fetch` WHERE `userid` = '$loggeduserid' AND `date` = '$date'",$con) or die(mysql_error());
$rowCurrent = mysql_fetch_array($getCurrent);
$curCount = $rowCurrent[0];
if($curCount < $count)
{
	if($limit > ($count - $curCount))
	{
		$limit = $count - $curCount;
	}
  //  echo "SELECT `id`,`fname` FROM `contact` WHERE `ownerid` = '0' AND `alloted` = '0' AND `leadsource` = '".$poolfetchsource."' AND `converted` = '0' ORDER BY `id` DESC LIMIT ".$limit;
	
	//$getMore = mysql_query("SELECT `id`,`fname` FROM `contact` WHERE `ownerid` = '0' AND `alloted` = '0' AND `leadsource` = '".$poolfetchsource."' AND `converted` = '0' ORDER BY `id` DESC LIMIT ".$limit,$con) or die(mysql_error());
	$getMore = mysql_query("SELECT `id`,`fname` FROM `contact` WHERE `ownerid` = '0' AND `alloted` = '0' AND `leadsource` = '".$poolfetchsource."' AND `converted` = '0' ORDER BY `id` DESC LIMIT ".$limit,$con) or die(mysql_error());
	if(mysql_num_rows($getMore) > 0)
	{
	while($rowMore = mysql_fetch_array($getMore))
	{
	$cid = $rowMore[0];
	$cname = $rowMore[1];
		
    $datetime = date('Y-m-d H:i A');

	mysql_query("UPDATE `contact` SET `modifieddate`='$datetime',`ownerid` = '$loggeduserid',`alloted` = '1',`read`='0' WHERE `id` = '$cid'",$con) or die(mysql_error());
	mysql_query("INSERT INTO `fetch` (`cid`, `userid`, `date`, `id`) VALUES ('$cid', '$loggeduserid', '$date', '')",$con) or die(mysql_error());			
	}
		?>
	<span style="font-size:12px;cursor:pointer;color:blue;text-decoration:underline" onclick="getModule('leads/view?unread=1','manipulateContent','viewContent','Not Contacted')"><?php echo $limit;?> leads alloted.</span>
	<?php	
	}
	else
	{
		echo "<span style='font-size:12px;'>Pool is empty</span>";
	}
}
else
{
	echo "<span style='font-size:12px;'>More than ".$count." leads not allowed</span>";
}
?>
