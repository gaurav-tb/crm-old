<?php
include("../include/conFig.php");
$data = $_GET['data'];
$upto = $_GET['upto'];

//$fc = $_GET['fc'];
$fc = $_GET['count'];
$data = explode("--",$data);
if($_GET['view'])
{
$sql = $_GET['sql'];
$sql = stripslashes($sql);
$addStr = " AND message.id < '$data[0]' ORDER BY message.id DESC LIMIT";
$sql = str_ireplace("ORDER BY message.id DESC LIMIT",$addStr,$sql);
$getData = mysql_query($sql,$con) or die(mysql_error());
}
else
{
$sql =  $_GET['sql'];
$sql = str_ireplace("\\","",$sql);
$sql = explode("LIMIT",$sql);
//print_r($sql);
if($_GET['upto'] == 1)
{
$fr = ($_GET['upto']*20)+1;
}
else
{
$less = 100 + ($_GET['upto']-1)*$fc+1;
//$fr = ($_GET['upto']*$fc)+1;
$fr= $less; 
}
$to = $fc;
$newsql = $sql[0]." LIMIT ".$fr.",".$to;
//echo $newsql;
$getData = mysql_query($newsql,$con);
}
$countThis = mysql_num_rows($getData);

if($countThis > 0)
{
?>
<table width="100%" cellpadding="0" cellspacing="0" class="fetch">
<?php
$i=($fr-1);
while($row = mysql_fetch_array($getData))
{
?>
	<div style="border-bottom:1px #ccc solid;padding:25px 10px 5px 10px">
		<div style="float:right;font-style:italic;color:#888;font-size:10px;"><?php echo $row[2];?></div>
		<div style="float:left;padding:5px 10px 5px 5px;"><img src="<?php echo str_ireplace('../','',$row[3]);?>" height="27" width="27" alt="" style="border:2px #fff solid;-moz-box-shadow: 0 0 4px #222; -webkit-box-shadow: 0 0 4px #222;" /></div>
		<span style="font-weight:bold"><?php echo $row[1];?></span><br/>
	<?php echo $row[0];?>

	</div>
	
	<?php
$i++;
$Maxid = $row[4];
$MaxI = $i;
$list .= $row[4].",";
}
?>
</table>
<?php
echo "STRINGUSEDTODETECTMAXID";
echo $Maxid;
echo "STRINGUSEDTODETECTMAXID";
echo $list;
echo "STRINGUSEDTODETECTMAXID";
echo $countThis;
}
else
{
?>
<table width="100%" cellpadding="0" cellspacing="0" class="fetch">
<tr class="<?php echo $i%2;?>">
<td colspan="10" style="font-size:24px;text-align:center;background:#eee;color:#aaa;" align="center">No More Data To Show!</td>
</tr>
</table>
<?php
}
?>
