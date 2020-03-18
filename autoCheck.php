<?php
include("include/conFig.php");
$table = $_GET['table'];
$field = $_GET['field'];
$value = $_GET['value'];

$tab = explode("::",$table);
if(count($tab) > 0 && $tab[0] == 'contact')
{
$chkData = mysql_query("SELECT `$field`,`id`,`alloted` FROM `$tab[0]` WHERE `$field` = '$value' AND `id` != '$tab[1]' AND `delete` = '0'",$con) or die(mysql_error());
$fetch = mysql_fetch_array($chkData);		
		if(mysql_num_rows($chkData) > 0 && $fetch[2] == '1')
		{
		?>
		<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;'>Duplicate Entry!!</div>
		<?php
		}
		else if(mysql_num_rows($chkData) > 0)
		{
			if(in_array('UN_Merge',$thisPer))
			{
			?>
			<div onclick="getModule('leads/mergeUnalloted?id=<?php echo $fetch[1]?>','ccav0','','Merge')" title="Click To Overwrite" style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;cursor:pointer'>Exists in Unalloted Pool!</div>
			<?php
			}
			else
			{
			?>
			<div title="Ask Your Administrator To Get Overwritten" style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;cursor:pointer'>Exists in Unalloted Pool!</div>
			<?php
			}
		}
}		
else if(count($tab) > 0)
{
$chkData = mysql_query("SELECT `$field` FROM `$tab[0]` WHERE `$field` = '$value' AND `id` != '$tab[1]' AND `delete` = '0'",$con) or die(mysql_error());
		if(mysql_num_rows($chkData) > 0)
		{
		echo "<span style='color:#b82121;font-weight:bold' >Duplicate Entry!!</span>";
		}
	
}
else
{
$chkData = mysql_query("SELECT `$field` FROM `$table` WHERE `$field` = '$value' AND `delete` = '0'",$con) or die(mysql_error());
	if(mysql_num_rows($chkData) > 0)
		{
		echo '<span style="color:#b82121;font-weight:bold">Duplicate Entry!!</span>';
		}

}

?>
