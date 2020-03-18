<?php
include("../include/conFig.php");
?>
<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left">My Wall </td>
		</tr>
	</table>
</div>
<div style="background:#eee;padding:10px;" id="shareText">
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td>
<textarea name="TextArea1" class="input" style="width: 99%; height: 18px" id="myPost" onclick="resetTitle();this.style.height = '87px'" onfocus="this.style.height = '87px'" onblur="this.style.height = '18px'"></textarea>
</td>
</tr>
<tr align="left">
<td>
<input name="Button1" class="buttonGreen" type="button" value="Share :)" onclick="shareMyPost('<?php echo $loggedname;?>','<?php echo $loggeduserid;?>')" />
</td>
</tr>
</table>
</div>
<div id="wallContents" style="font-size:11px;line-height:180%;background:#fff;overflow-y:auto;height:400px;">
<?php
$i = 0;
$sql = "SELECT message.message,employee.name,message.createdate,userprofile.pic,message.id FROM employee,message,userprofile WHERE userprofile.userid = employee.id AND message.user = employee.id AND message.delete = '0' ORDER BY message.id DESC LIMIT 20";
$getData = mysql_query($sql,$con) or die(mysql_error());

$countThis = mysql_num_rows($getData);

$tempsql = str_ireplace('LIMIT 20','',$sql);
$getCount = mysql_query($tempsql,$con) or die(mysql_error());
$countTotal = mysql_num_rows($getCount);

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
	<div onclick="moreData('Wall/fetchmore?sql='+document.getElementById('tlview').value+'&upto='+document.getElementById('uptoFetch').value,'moreData','');" style="cursor: pointer;padding-top:5px;" id="fetchingDone">
	<img alt="" src="images/more.png" style="vertical-align: middle; width: 6px;" /> 
	More <span id="fetching" style="display: none">Fetching..</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="getCount" style="display:none"><?php echo $countThis;?></span> <span id="getTotal" style="display:none"><?php echo $countTotal;?></span>

	</div>
		
	</span>
</div>
<br/>
<br/>
<br/><br/><br/><br/><br/><br/>
</div>
<div id="customContent"></div>




