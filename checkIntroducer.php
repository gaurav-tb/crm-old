<?php
include("include/conFig.php");
$value = $_GET['value'];
$cid = $_GET['cid'];
$chkData = mysql_query("SELECT `fname`,`code` FROM `contact` WHERE `code` = '$value' AND `id` != '$cid' AND `delete` = '0'",$con) or die(mysql_error());
$fetch = mysql_fetch_array($chkData);		
	if(mysql_num_rows($chkData) >0)
	{
	?>
		0***<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;' id="hidediv" onclick="$('#hidediv').fadeOut()"><?php echo $fetch[0]?> Introducer of this Client !!</div>
	<?php
	}
	else
	{
	?>
		1***<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;' id="hidediv" onclick="$('#hidediv').fadeOut()">Introducer Not Available for <?php echo $value;?></div>
	<?php
	}		
?>
