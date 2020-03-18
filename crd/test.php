<?php
include("../include/conFig.php");

?>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:20%">
<div style="height:500px;overflow-y:scroll">
<table cellpadding="0" cellspacing="0">
<?php
$threedays = getCustomDate(3);
$getData = mysql_query("SELECT DISTINCT(contact.id),contact.fname,contact.lname,contact.mobile FROM contact,noteline WHERE contact.createdate <= '$threedays' AND noteline.cid = contact.id AND contact.converted = '1' AND noteline.id NOT IN (SELECT `id` FROM `noteline` WHERE `subject` = 'call' AND `createdate` >= '$threedays') AND contact.id NOT IN (SELECT `cid` FROM `noteline` WHERE `subject` = 'call' AND `createdate` >= '$threedays')",$con) or die(mysql_error());
while($row = mysql_fetch_array($getData))
{
?>

<tr><td class="form" style="">
<?php echo $row[1]." ".$row[2]?><br/>
<?php echo $row[3]?>
</td></tr>
<?php }?>
</table>
</div>
</td>
</tr>
</table>
