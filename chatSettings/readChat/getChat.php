<?php
include("../../include/conFig.php");
$me = $_GET['from'];
$other = $_GET['to'];
if($me != '' && $other != '')
{
 $i = 0;
 
    $sql = "SELECT chat.message,chat.time,user.pic,user.name,chat.id,chat.from,user.id,chat.time FROM chat,user WHERE user.id = chat.from AND ((chat.from = '$me' AND chat.to = '$other') OR (chat.from  = '$other' AND chat.to  = '$me')) AND chat.delete= '0' ORDER BY chat.id DESC LIMIT 20";
	$getData = mysql_query($sql,$con) or die(mysql_error());
	$countThis = mysql_num_rows($getData);
	$tempsql = str_ireplace('LIMIT 20','',$sql);
	$getCount = mysql_query($tempsql,$con) or die(mysql_error());
	$countTotal = mysql_num_rows($getCount);

	$already = array();
?>
<div style="height:500px">

<?php	
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
}	
		$myArr = array_reverse($myArr);




	foreach($myArr as $val)
{
$row = explode("//??BREAKER^^^^BREAKER//??",$val);
$name = explode(' ',$row[4]);
?>
<div style='padding:10px 0px' id="left">
<table cellpadding='0' cellspacing='5' width='67%'><tr><td valign='top' style='width:40px;' align='left'><img class='chatImg' height="30px" src='<?php echo $row[0];?>' title='<?php echo $row[1];?>' style='width:30px;' alt='' /><span style="float:left;font-size:12px;font-family:'candara'" class="blueSimpletext"><?php echo $name[0];?></span></td><td style="line-height:18px"><?php echo $row[2];?></td><td valign='top' align='left' style='padding-top:4px;padding-left:10px;width:95px'><span style="float:right;font-size:12px;font-family:'candara';width:" class="blueSimpletext"><?php echo date("d, M y / H:i",strtotime($row[5]));?></span></td></tr></table>
</div>
<?php
}
?>
<div id="moreData">
</div>
<div class="moduleFoot">
<div style="float:right;display:none">
	<select id="fetchPara" class="input">
	<option value="20">Get 20 Records</option>
	<option value="50">Get 50 Records</option>
	<option value="100">Get 100 Records</option>
	</select>
</div>
<input name="Text1" type="text" value="<?php echo $sql;?>" id="tlview" style="display:none" />
<input name="Text1" type="text" value="<?php echo $list;?>" id="idList" style="display:none" />
<input name="Text1" type="text" value="1" id="uptoFetch" style="display:none" />

	<input id="fetchData" name="Text1" style="display:none " type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
	<span id="moreButton">
	<div onclick="moreData('chatSettings/readChat/fetchmore?sql='+document.getElementById('tlview').value+'&upto='+document.getElementById('uptoFetch').value,'moreData','');" style="cursor: pointer;padding-top:5px;" id="fetchingDone">
	<img alt="" src="images/more.png" style="vertical-align: middle; width: 6px;" /> 
	More <span id="fetching" style="display: none">Fetching..</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="getCount" style="display:none"><?php echo $countThis;?></span> <span id="getTotal" style="display:none"><?php echo $countTotal;?></span>

	</div>
		
	</span>
</div>

<br/><br/><br/><br/><br/><br/>
</div>	


		
			
						
			
			
			
			
