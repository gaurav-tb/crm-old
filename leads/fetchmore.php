<?php
include("../include/conFig.php");
$lst = array();
$getlst = mysql_query("SELECT `id`,`name` FROM `leadstatus` WHERE `delete` = '0'",$con) or die(mysql_error());
$countlst = mysql_num_rows($getlst);

if($countlst == 0)
{

}
else
{
while($rowlst = mysql_fetch_array($getlst))
{
$lst[$rowlst[0]] =  $rowlst[1];
}
}

$data = $_GET['data'];
$upto = $_GET['upto'];

//$fc = $_GET['fc'];
$fc = $_GET['count'];

$data = explode("--",$data);
if($_GET['view'])
{
$sql = $_GET['sql'];
$sql = stripslashes($sql);
$addStr = " AND contact.id < '$data[0]' ORDER BY contact.id DESC LIMIT";
$sql = str_ireplace("ORDER BY contact.id DESC LIMIT",$addStr,$sql);
$getData = mysql_query($sql,$con) or die(mysql_error());
}
else
{
$sql =  $_GET['sql'];
$sql = str_ireplace("\\","",$sql);
$sql = explode("LIMIT",$sql);
if($_GET['upto'] == 1)
{
$fr = ($_GET['upto']*100)+1;
}
else
{
$less = 100 + ($_GET['upto']-1)*$fc+1;
//$fr = ($_GET['upto']*$fc)+1;
$fr= $less;
}
$to = $fc;
$newsql = $sql[0]." LIMIT ".$fr.",".$to;
$getData = mysql_query($newsql,$con);
}
$countThis = mysql_num_rows($getData);

if($countThis > 0)
{
?>
<table cellpadding="0" cellspacing="0" class="fetch">
<?php

$i=($fr-1);
while($row = mysql_fetch_array($getData))
{
$serv = explode(',',$row[11]);
$services = str_ireplace('-','',$serv);
$proNames = '';

foreach($services as $pro)
{
if($pro != 'null' && $pro != '')
{
		//echo "SELECT `name` FROM `category` WHERE `id` = '$pro'";
$getPro = mysql_query("SELECT `name` FROM `category` WHERE `id` = '$pro'",$con) or die(mysql_error());
while($rowPro = mysql_fetch_array($getPro))
{
$proName = $rowPro[0];
$proNames .= str_ireplace('None','',$proName).", ";
}
}
}
?>
	    <tr <?php if($row[8] == '0') echo "style='font-weight:bold'"; ?>  id="fetchRow<?php echo $i;?>" class="e<?php echo $row[16] ?>" title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row[6]));?>">
		<td> <!--  style="width: 20px;"-->
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[4];?>" />
        </td>
    
        <td>
		<div style="height:12px;">
		<?php if($row['mark'] == '1') { ?> 

		<img src="images/hot.png" id="hot<?php echo $row[4];?>" style="height:12px" alt=""  onclick="getModule('leads/markHot?id=<?php echo $row[4];?>&todo=cold','','hot<?php echo $row[4];?>','');document.getElementById('cold<?php echo $row[4];?>').style.display='';"/> 
		<img src="images/cold.png" id="cold<?php echo $row[4];?>" style="height:12px;display:none" alt="" onclick="getModule('leads/markHot?id=<?php echo $row[4];?>&todo=hot','','cold<?php echo $row[4];?>','');document.getElementById('hot<?php echo $row[4];?>').style.display='';"/>  

		<?php 
		} 
		else 
		{
		?> 
		<img src="images/hot.png" id="hot<?php echo $row[4];?>" style="height:12px;display:none" alt=""  onclick="getModule('leads/markHot?id=<?php echo $row[4];?>&todo=cold','','hot<?php echo $row[4];?>','');document.getElementById('cold<?php echo $row[4];?>').style.display='';"/> 
		<img src="images/cold.png" id="cold<?php echo $row[4];?>" style="height:12px" alt="" onclick="getModule('leads/markHot?id=<?php echo $row[4];?>&todo=hot','','cold<?php echo $row[4];?>','');document.getElementById('hot<?php echo $row[4];?>').style.display='';"/>  
		<?php 
		} 
		?>
		</div>
		</td> 

        
        <td style="width:164px"><?php echo $row[4];?></td>
		<td style="width:122px"><?php echo $row[0];?></td>
		
		
		<?php
		$toPassurl = 'leads/edit?id='.$row[4].'&i='.$i;
		$toPassurl = base64_encode($toPassurl);
		$showid = base64_encode('manipulateContent');
		$hideid = base64_encode('viewContent');
		$title = base64_encode($row['fname']);
		$finalUrl = 'default.php#'.$toPassurl.'$$**$$'.$showid.'$$**$$'.$hideid.'$$**$$'.$finalUrl;
		?>

		<td style="width:223px" onclick="getModule('leads/edit?id=<?php echo $row[4];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo $row[1];?>')" onmousedown="mouseDown(event,'<?php echo $finalUrl;?>')" class="blueSimpletext"><?php echo $row[1];?></td>
		<td style="width:120px"><a class="blueSimpletext clickto" href="callto:<?php echo $row[2]; ?>">Click to call</a></td>
    	<td style="width:120px"><?php echo date("d-m-y h:i A",strtotime($row[13])) ?></td>
    	<td style="width:116px"><?php echo $row[5]; ?></td>
		<td style="width:85px"><?php echo $row['name']; ?></td>
		<!--<td style="width:100px"><?php 
		$lststr = str_ireplace('-','',$row[12]);
		$lstex = explode(',',$lststr);
		//print_r($lstex);
		
		foreach($lstex as $val)
		{
		if($val != '')
		{
		echo $lst[$val].', ';
		}
		}
		?>
		<?php echo $row[2];?>
		</td>-->
		<td style="width:122px">
		<?php
		 if($row[3] != '0000-00-00 00:00:00')
		 {
		 $cb =  date("d-m-y h:i A",strtotime($row[3]));
		 echo str_ireplace("12:00 AM", '',$cb);
		 }
		 else
		 {
		 echo "--";
		 }
		?>
		</td>
		<td style="width:325px" onclick="getModule('noteline/index?cid=<?php echo $row[4];?>&name=<?php echo $row[1];?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo $row[0];?>')">
		<?php $tempDesc  = $row[10];
		$tempDesc = explode("\r\n",$tempDesc);
		$tempDesc = array_reverse($tempDesc);
		echo substr($tempDesc[0],0,50);
		echo "..";
		?>
		</td>
		<td style="width:29px;">
		<img onclick="getModule('noteline/index?cid=<?php echo $row[4];?>&name=<?php echo $row[1];?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo $row[0];?>')" src="images/story.png" style="width:15px" title="Story For <?php echo $row[0];?>" alt=""/>
		</td> 

	</tr>
	
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
