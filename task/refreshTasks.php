<?php
include("../include/conFig.php");
$fromtime = $date." 00:00:00";
$totime = $date." 23:59:59";

$getTask = mysql_query("SELECT `subject`,`reminddate` FROM `task` WHERE `reminddate` BETWEEN '$fromtime' AND '$totime' AND `owner` = '$loggeduserid'  AND `status` = '0' AND `popup` = '1'",$con) or die(mysql_error());
while($rowTask = mysql_fetch_array($getTask))
{
$taskName[] .= $rowTask[0];
$taskTime = $rowTask[1];
$taskTime = explode(" ",$taskTime);
$actualTime[] .= $taskTime[1];
}
?>

<textarea name="TextArea1" cols="20" rows="2" id="taskNames"><?php echo implode(",",$taskName); ?></textarea>
<textarea name="TextArea1" cols="20" rows="2" id="taskTime"><?php echo implode(",",$actualTime); ?></textarea>
