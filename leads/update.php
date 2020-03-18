<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$i = $_GET['i'];
$id = $_GET['id'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
if($post[1] != 'undefined')
{
$add = str_ireplace("'","",$post[12]);
$desc = str_ireplace("'","",$post[14]);
//$desc = $desc."<br/>".date("d,M Y H:i", strtotime($datetime));
$c = count($post);
$calback = $post[10];
$calbacktime = $post[23];
for($g=26;$g<=$c;$g++)
{
$product .= "-".$post[$g]."-,";
}

/*
$status = $_GET['lst'];
$status = explode(",",$status);
foreach($status as $tal)
{
if($tal != '')
{
$statusstr .= "-".$tal."-,"; 
}
}

*/

$statusstr = $post[7];

$getOldDesc = mysql_query("SELECT `description`,`latestresponse`,`leadstatus`,`createdate` FROM `contact` WHERE `id` = '$id'",$con) or die(mysql_error());
$rowOldDesc = mysql_fetch_array($getOldDesc);
$createdate = $rowOldDesc[3];
$createdate = date("Y-m-d",strtotime($createdate));
$oldDesc = $rowOldDesc[0];
$oldStatus = $rowOldDesc[2];
$oldResp = $rowOldDesc[1];
if($oldDesc != $desc)
{
$desc = "<br/>".$desc."  [ modified on: ".$datetime."]";
$descStoryString = "Description changed<br/>";
	
}
else
{
$descStoryString = "";
}

if($oldStatus != $statusstr)
{
$oldStNameArray= '';
$newStatusNameArray = '';
$StatusString = "";
$temp = str_ireplace("-","",$oldStatus);
$temp = explode(",",$temp);
	foreach($temp as $val)
	{
		if($val != '')
		{
				$getStatusName = mysql_query("SELECT `name` FROM `leadstatus` WHERE `id` = '$val'",$con) or die(mysql_error());
		$rowStatusName = mysql_fetch_array($getStatusName);
		$oldStNameArray .= $rowStatusName[0].", ";	
		}

	}
	 $oldStNameArray = trim($oldStNameArray);
	$oldStNameArray = substr($oldStNameArray,0,-1);

	$temp = str_ireplace("-","",$statusstr);
	$temp = explode(",",$temp);
	foreach($temp as $val)
	{
		if($val != '')
		{
		$getStatusName = mysql_query("SELECT `name` FROM `leadstatus` WHERE `id` = '$val'",$con) or die(mysql_error());
		$rowStatusName = mysql_fetch_array($getStatusName);
		$newStatusNameArray .= $rowStatusName[0].", ";
		}
	}
	$newStatusNameArray = trim($newStatusNameArray);
	$newStatusNameArray = substr($newStatusNameArray,0,-1);
	if($oldStNameArray != $newStatusNameArray)
	{
	$statusString = 'Leadstatus changed From <strong>['.$oldStNameArray.']</strong> to <strong>['.$newStatusNameArray.']</strong><br/>';		
	}
	else
	{
		$statusString = "";
	}


	
}
else{
	
	$statusString = "";
}



if($oldResp != $post[9])
{
	$oldRespNameArray= '';
	$newRespNameArray = '';
	$RespString = "";

		$getStatusName = mysql_query("SELECT `name` FROM `leadresponse` WHERE `id` = '$oldResp'",$con) or die(mysql_error());
		$rowStatusName = mysql_fetch_array($getStatusName);
		$oldRespNameArray = $rowStatusName[0];	

		$getStatusName = mysql_query("SELECT `name` FROM `leadresponse` WHERE `id` = '$post[9]'",$con) or die(mysql_error());
		$rowStatusName = mysql_fetch_array($getStatusName);
		$newRespNameArray = $rowStatusName[0];	
	
	$RespString = 'Latest Response changed From <strong>['.$oldRespNameArray.']</strong> to <strong>['.$newRespNameArray.']</strong><br/>';

	
}
else{
	
	$RespString = "";
}
//~ echo "<br/>";
//~ echo $post[10];
//~ echo "<br/>";
//~ echo $createdate;

if($post[10] != $createdate)
{
	$forcedChange = '1';	
}
else
{
	$forcedChange = '0';	
}
//~ echo "<br/>";
//~ echo $forcedChange;
$code = "";
if($post[26] != '') 
{
	$code = "TB".$post[26];
}

if($post[18] != '' && $post[18] !='TB' && $post[18] !='tb') 
{
	$brokerage = 10;
}else{
	$brokerage =0;
}

$getModified = mysql_query("SELECT `once_modified`,`email` FROM `contact` WHERE `id` = '$id' AND (`email`!='' || `email`!='NA' || `email`!='*')",$con) or die(mysql_error());
$rowModi=mysql_fetch_array($getModified);

if($rowModi[0]==0)
{
$params = Array();
$params['api_key'] ="3ef8a0d6-d597-4f04-a758-32545ab6b634";
$params['publicAccountID'] ="c8e5378a-f391-4a31-a27b-9b052b5dc841";
$params['listName'] ="CRM Leads";
$params['sendActivation'] ="false";
$params['email'] =$rowModi[1];

$ch=curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));	
curl_setopt($ch,CURLOPT_URL,"http://tracking.orbitmx.com/v2/contact/add");
curl_setopt($ch,CURLOPT_POST,"1");
curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$output=curl_exec($ch);
curl_close($ch);	
}

$first_name = ucwords((strtolower($post[1])));
$last_name = ucwords((strtolower($post[2])));

mysql_query("UPDATE `contact` SET `forcedcallback` = '$forcedChange', `fname`='$first_name',`lname`='$last_name',`phone`='$post[3]',`mobile`='$post[4]',`email`='$post[5]',`website`='$post[6]',`leadstatus`='$statusstr',`leadsource`='$post[8]',`callbackdate`='$calback',`revenue` = '$post[15]',`conversiondate` = '$post[16]',`messengerid`='$post[11]',`description`='$desc',`product`='$product',`modifieddate`='$datetime',`updatedby`='$loggeduserid',`delete`='0', `altemail`='$post[17]',`traderprofile`='$post[19]',`experience`='$post[20]',`invamount`='$post[21]', `language` = '$post[22]', `callbacktime` = '$post[23]', `inroducer` = '$post[18]', `feedback` = '$post[25]',`once_modified`='1',`alternateMobile`='$post[12]',`%brokerage`='$brokerage',`code` = '$post[13]' WHERE `id`= '$id'",$con)or die(mysql_error());


$note = "New updations made by ".$loggedname."<br/><br/><div style=\'font-size:11px;color:#008299;line-height:20px;\'>".$descStoryString.$statusString.$RespString."</div>";
mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('Updation', '$note', '$id', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());

$getDate = mysql_query("SELECT `id` FROM `callbackdate` WHERE `callbackdate` = '$post[10]' AND `cid` = '$id' AND `ownerid` = '$post[0]'",$con) or die(mysql_error());
$count = mysql_num_rows($getDate);
if($count  > 0)
{
$row = mysql_fetch_array($getDate);
mysql_query("UPDATE `callbackdate` SET `callbackdate`='$post[10]',`updatedby`='$loggeduserid' WHERE  `id` = '$row[0]'",$con) or die(mysql_error());
}
else
{
mysql_query("INSERT INTO `callbackdate`(`cid`, `callbackdate`, `updatedby`, `id`, `ownerid`) VALUES ('$id','$post[10]','$loggeduserid','','$post[0]')",$con) or die(mysql_error());
}

$getData = mysql_query("SELECT employee.name, contact.fname, contact.mobile, contact.callbackdate,contact.id,leadresponse.name,contact.modifieddate,contact.mark,contact.lname,contact.description,contact.product,contact.leadstatus,contact.createdate,contact.callbacktime FROM contact,employee,leadresponse WHERE contact.ownerid = employee.id AND contact.delete = '0' AND contact.converted= '0' AND contact.latestresponse = leadresponse.id AND contact.id = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

//// Below Query used For Get LeadStatus Name
$lst = array();
$getlst = mysql_query("SELECT `id`,`name` FROM `leadstatus` WHERE `delete` = '0'",$con) or die(mysql_error());
$countlst = mysql_num_rows($getlst);
if($countlst == 0)
{
//
}
else
{
	while($rowlst = mysql_fetch_array($getlst))
	{
		$lst[$rowlst[0]] =  $rowlst[1];
	}
}

//// Below Query used For Get Service Name

$serv = explode(',',$row[10]);
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
<table>
    <tr <?php if($row[8] == '0') echo "style='font-weight:bold'"; ?> id="fetchRow<?php echo $i;?>" class="e<?php echo $row[16] ?>" title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row[6]));?>">
		<td style="width:20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[4];?>" /></td>

		<td style="width:15px;">
		<div style="height:12px;">
		<?php if($row[7] == '1') { ?> 

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
        
        
        <td><?php echo $row[4] ?></td>
		<td><?php echo $row[0];?></td>
		
	    <?php
		$toPassurl = 'leads/edit?id='.$row[4].'&i='.$i;
		$toPassurl = base64_encode($toPassurl);
		$showid = base64_encode('manipulateContent');
		$hideid = base64_encode('viewContent');
		$title = base64_encode($row['fname']);
		$finalUrl = 'default.php#'.$toPassurl.'$$**$$'.$showid.'$$**$$'.$hideid.'$$**$$'.$finalUrl;
		?>
		<td onclick="getModule('leads/edit?id=<?php echo $row[4];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo str_ireplace('"','',$row[1]);?>')" onmousedown="mouseDown(event,'<?php echo $finalUrl;?>')"  class="blueSimpletext"><?php echo $row[1];?></td>
		
		<td><a class="blueSimpletext clickto" href="callto:<?php echo $row[2]; ?>">Click to call</a></td>
	
		
		
		<td><?php echo date("d-m-y h:i A",strtotime($row[13])) ?></td>
		
		<td style="position:relative">
			<span onclick="$('#editorlr<?php echo $row[4];?>').show();" id="spanlr<?php echo $row[4];?>">
				<?php echo $row[5]; 
				$valuecurrentorder = (!empty($row[17])) ? $row[17] : '0'; ;
				?>
			</span>
			<div class="editBoxTop" id="editorlr<?php echo $row[4];?>">
				<?php
				$getResponse = mysql_query("SELECT * FROM `leadresponse` WHERE `delete` = '0'AND `id` != '1'AND (`display` = '1' OR `display` = '0') AND `order` >= '$valuecurrentorder' ORDER BY `order` ASC",$con) or die(mysql_error());
				$lresp = array();
				while($rowResp = mysql_fetch_array($getResponse))
				{
				$lresp[$rowResp['id']] = $rowResp['name'];
				}
				?>
				<select id="<?php echo $row[4];?>lr" class="input" style="width:100px;">
				<option value="">Please Select Lead Response</option>
				<?php
				foreach($lresp as $rkey => $resval)
				{
				?>
				<option <?php if($row[5] == $resval) echo "selected='selected'";?> value="<?php echo $rkey;?>"><?php echo $resval;?></option>
				<?php
				}
				?>
				</select>
				<button class="buttonGreen" style="display:inline-block;padding:5px;" id="<?php echo $row[4];?>lrbutton" onclick="saveNewStatus('<?php echo $row[4];?>','lr')">Update</button>
				<button class="buttonnegetive" style="display:inline-block;padding:5px;" id="<?php echo $row[4];?>lrbutton" onclick="$('#editorlr<?php echo $row[4];?>').hide()">x</button>
			</div>
		</td>
		<!--<td>
	<span onclick="$('#editorls<?php echo $row[4];?>').show();" id="spanls<?php echo $row[4];?>">
		<?php 
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
		
		</span>
			<div class="editBoxTop" id="editorls<?php echo $row[4];?>">
		<select id="<?php echo $row[4];?>ls" class="input" style="width:100px;" multiple='multiple' size="4">
	<?php
foreach($lstat as $rkey => $resval)
{
?>
<option <?php if(in_array($rkey, $lstex)) echo "selected='selected'";?> value="<?php echo $rkey;?>"><?php echo $resval;?></option>
<?php
}
	?>
</select>
<button class="buttonGreen" style="display:inline-block;padding:5px;" id="<?php echo $row[4];?>lsbutton" onclick="saveNewStatus('<?php echo $row[4];?>','ls')">Update</button>	

<button class="buttonnegetive" style="display:inline-block;padding:5px;" id="<?php echo $row[4];?>lrbutton" onclick="$('#editorls<?php echo $row[4];?>').hide()">x</button>	

			</div>

		</td>-->
		<td>
		<?php echo $row[15]; ?>
		</td>
		<!--<td>
		<?php echo $row[2];?>
		</td>-->
		
		<td>
		
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
        <td  onclick="getModule('noteline/index?cid=<?php echo $row[4];?>&name=<?php echo $row[1];?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo $row[0];?>')">
		<?php $tempDesc  = $row[10];
		$tempDesc = explode("\r\n",$tempDesc);
//		$tempDesc = array_reverse($tempDesc);
		echo substr($tempDesc[0],0,50);
		echo "..";
		?>
		</td>
						
		<td>
		<img onclick="getModule('noteline/index?cid=<?php echo $row[4];?>&name=<?php echo $row[1];?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo $row[0];?>')" src="images/story.png" style="width:15px" title="Story For <?php echo $row[0];?>" alt=""/>
		</td>
	</tr>
	
</table>
<?php
}
else
{
echo "THEREOCCUREDSOMEERRORFORHANGOVER";
}

mysql_close();
?>			

	
