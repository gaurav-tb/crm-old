<?php
include("../../include/conFig.php");
$data = $_GET['data'];
$upto = $_GET['upto'];

//$fc = $_GET['fc'];
$fc = $_GET['count'];
$data = explode("--",$data);
if($_GET['view'])
{
$sql = $_GET['sql'];
$sql = stripslashes($sql);
$addStr = " AND chat.id < '$data[0]' ORDER BY chat.id DESC LIMIT";
$sql = str_ireplace("ORDER BY chat.id DESC LIMIT",$addStr,$sql);
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
$less = 20 + ($_GET['upto']-1)*$fc+1;
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
$i=($fr-1);
while($row = mysql_fetch_array($getData))
	{
	$getPicture = mysql_query("SELECT `pic` FROM `userprofile` WHERE `userid` = '$row[6]'",$con) or die(mysql_error());
	$fetchPic = mysql_fetch_array($getPicture);
		if(!in_array($row[4],$already))
		{
			if($fetchPic[0] == "")
			{
			$fetchPic[0] = "spreadChat/chat/images/1.png";
			}
			$already[] = $row[4];
			$minId =$row[4]; 
			$myArr[] .= "http://research4u.co.in/gocrm/".str_ireplace('../','',$fetchPic[0])."//??BREAKER^^^^BREAKER//??".$row[3]."//??BREAKER^^^^BREAKER//??".$row[0]."//??BREAKER^^^^BREAKER//??".$row[5]."//??BREAKER^^^^BREAKER//??".$row[3]."//??BREAKER^^^^BREAKER//??".$row[7];
		}
		$i++;
	$Maxid = $row[4];
	$MaxI = $i;
	$list .= $row[4].",";

	}
$myArr = array_reverse($myArr);
//print_r($myArr);
foreach($myArr as $val)
{
$row = explode("//??BREAKER^^^^BREAKER//??",$val);
$name = explode(' ',$row[4]);
?>
<table cellpadding='0' cellspacing='5' width='67%'><tr><td valign='top' style='width:40px;' align='left'><img class='chatImg' height="30px" src='<?php echo $row[0];?>' title='<?php echo $row[1];?>' style='width:30px;' alt='' /><span style="float:left;font-size:12px;font-family:'candara'" class="blueSimpletext"><?php echo $name[0];?></span></td><td><?php echo $row[2];?></td><td valign='top' align='left' style='padding-top:4px;padding-left:10px;width:95px'><span style="float:right;font-size:12px;font-family:'candara';width:" class="blueSimpletext"><?php echo date("d, M y / H:i",strtotime($row[5]));?></span></td></tr></table>
<?php
}
	
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


