<?php
include("../include/conFig.php");
$id = $_GET['id'];
$todo = $_GET['todo'];
$i = $_GET['i'];
mysql_query("UPDATE `servicecall` SET `alertexpiry` = '$todo' WHERE `id` = '$id'",$con) or die(mysql_error());
if($todo == '1')
		{
		?>
				<input name="Button1" id="off<?php echo $i?>" type="button" value="OFF" class="buttonnegetive" onclick="getModule('freetrial/alertOff?id=<?php echo $id;?>&todo=0','alert<?php echo $i;?>','','')"/>
		<?php
		
		}
		else
		{
			?>
	<input name="Button1" id="off<?php echo $i?>" type="button" value="ON" class="buttonGreen" onclick="getModule('freetrial/alertOff?id=<?php echo $id;?>&todo=1','alert<?php echo $i;?>','','')"/>		
	<?php
	
		}
		
		?>	

