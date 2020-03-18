<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `cannottalkto` (`userid`, `cannottalkto`, `desc`, `createdate`, `modifieddate`, `updatedby`) VALUES ('$post[0]', '$post[1]', '$post[2]', '$datetime', '$datetime', '$loggeduserid')",$con) or die(mysql_error());
$id = mysql_insert_id();

$users = explode('-',$post[1]);
$user = str_ireplace(',','',$users);
$cannottalkto = "-".$post[0]."-,";


foreach($user as $cannot)
{
	if($cannot != '')
	{
	$getCtt = mysql_query("SELECT * FROM `cannottalkto` WHERE 'cannottalkto' LIKE '%$cannot%'",$con) or die(mysql_error());
		if(mysql_num_rows($getCtt) > 0)
		{
		while($rowCtt = mysql_fetch_array($getCtt))
			{
			$subid = $rowCtt['id'];
			$newCtt = str_ireplace($cannot,"",$rowCtt['cannottalkto']);
			$newCannottalkto = $newCtt.$cannottalkto;
			mysql_query("UPDATE `cannottalkto` SET `cannottalkto` = '$newCannottalkto' WHERE `id` = '$subid'",$con) or die(mysql_error());
			}
		}
		else
		{
			mysql_query("INSERT INTO `cannottalkto` (`userid`, `cannottalkto`, `desc`, `createdate`, `modifieddate`, `updatedby`) VALUES ('$cannot', '$cannottalkto', '$post[2]', '$datetime', '$datetime', '$loggeduserid')",$con) or die(mysql_error());
		}
	}
}

$getData = mysql_query("SELECT cannottalkto.id,employee.name,cannottalkto.desc,cannottalkto.modifieddate FROM cannottalkto,employee WHERE cannottalkto.userid= employee.id AND cannottalkto.delete = '0' AND cannottalkto.id = '$id' ORDER BY cannottalkto.id DESC",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php echo 'Last Updated On '.date("d M,y h:i:s",strtotime($row[3]));?>">
		<td style="width: 20px;">
		<input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
		<td class="blueSimpletext" onclick="getModule('chatSettings/cannottalkto/edit?id=<?php echo $id;?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','Edit Settings')">
		<?php echo $row[1];?></td>
<td>
<?php echo $row[2];?>	
</td>	
</tr>
