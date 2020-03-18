<?php
include("../include/conFig.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />

</head>

<body>


<div class="form" style="height:200px;width:99%;text-align:left;padding:10px;">
<?php
$getLeader = mysql_query("SELECT `leader`,`name` FROM `team` WHERE `delete` = '0'",$con) or die(mysql_error());
while($rowLeader = mysql_fetch_array($getLeader))
{
?>
<div style="width:95%;padding:5px;">
<?php
$name = $rowLeader[1];
$teamleader = $rowLeader[0];
include("progress-list.php");
?>
</div>
<?php
}
?>
<br/><br/><br/><br/><br/>
</div>
</body>

</html>