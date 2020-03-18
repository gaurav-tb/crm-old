<?php
include("include/conFig.php");
$id = $_GET['q'];
	$getTip = mysql_query("SELECT * FROM `tips` WHERE `id` > '$id' ORDER BY `id` DESC",$con) or die(mysql_error());
	if(mysql_num_rows($getTip) > 0)
	{
					while($rowTips = mysql_fetch_array($getTip))
					{
					?>
					<div class="tip" style="color:#222;font-weight:normal;font-size:13px;">
					<?php
					echo $rowTips['tip'];
					?><br/>
					<span class="blueSimpletext" style=";font-size:11px;font-weight:bold"><?php echo $rowTips['servicename'];?>&nbsp;&nbsp;at&nbsp;&nbsp;<?php echo $rowTips['time'];?> </span>
					</div>
					<?php
					$maxId[] = $rowTips['id'];					
					}
	echo "USETHISTOBREK";
	echo $maxId[0];			
	}
	else
	{
	echo "FALSEDATA";
	}

?>



