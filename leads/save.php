<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
$add = str_ireplace("'","",$post[12]);
$desc = str_ireplace("'","",$post[14]);
$c = count($post);
for($g=25;$g<=$c;$g++)
{
$product .= "-".$post[$g]."-,";
}
if($post[23] != '' && $post[23] !='TB' && $post[23] !='tb') 
{
	$brokerage = 10;
}else{
	$brokerage =0;
}

/*$status = $_GET['lst'];
$status = explode(",",$status);
	foreach($status as $tal)
	{
		if($tal != '')
		{
		$statusstr .= "-".$tal."-,"; 
		}
	}
*/

//$mob_count=mysql_query("SELECT `mobile` from `contact` where `mobile`='$post[4]'",$con) or die(mysql_error());

$first_name = ucwords((strtolower($post[1])));
$last_name = ucwords((strtolower($post[2])));

mysql_query("INSERT INTO `contact`(`ownerid`, `fname`, `lname`, `phone`, `mobile`, `email`, `website`, `leadstatus`, `leadsource`, `latestresponse`, `callbackdate`,`revenue`,`conversiondate`, `messengerid`, `product`,`self`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`,`alloted`,`altemail`, `dob`, `traderprofile`, `experience`, `invamount`, `genby`, `language`, `inroducer`, `feedback`,`originalsource`,`%brokerage`) VALUES ('$loggeduserid','$first_name','$last_name','$post[3]','$post[4]','$post[5]','$post[6]','$post[7]','$post[8]','$post[9]','$post[10]','$post[15]','$post[16]','$post[11]','$product','1','','$datetime','$datetime','$loggeduserid','0','1','$post[17]','$post[18]','$post[19]','$post[20]','$post[21]','$loggeduserid', '$post[22]', '$post[23]','$post[24]','$post[8]','$brokerage')",$con) or die(mysql_error());
$id = mysql_insert_id();


$getData = mysql_query("SELECT employee.name, contact.fname, contact.mobile, contact.callbackdate,contact.id,leadresponse.name,contact.modifieddate,contact.mark,contact.read,contact.lname,contact.description,contact.product,contact.leadstatus,contact.modifieddate,contact.callbacktime,leadsource.name,contact.latestresponse,leadresponse.order FROM contact,employee,leadresponse,leadsource WHERE contact.leadsource = leadsource.id AND contact.ownerid = employee.id AND contact.delete = '0' AND contact.converted= '0' AND contact.latestresponse = leadresponse.id AND contact.id = '$id'",$con) or die(mysql_error());


//$getData = mysql_query("SELECT employee.name, contact.fname, contact.mobile, contact.callbackdate,contact.id,leadresponse.name,contact.modifieddate,contact.mark,contact.lname FROM contact,employee,leadresponse WHERE contact.ownerid = employee.id AND contact.converted= '0' AND contact.latestresponse = leadresponse.id AND contact.delete = '0' AND contact.id = '$id'",$con) or die(mysql_error());
$newRow = mysql_fetch_array($getData);
$row = $newRow;


$note = "Client has been alloted to <strong>" .$row[0]. "</strong>";

mysql_query("INSERT INTO `noteline`(`subject`,`note`,`cid`,`id`,`createdate`,`updatedby`,`delete`) values('Oship','$note','$row[4]','','$datetime','$loggeduserid','0')",$con)or die(mysql_error()); 


?>

		
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
		<td><?php echo $row[4];?></td>
		
		<td><?php echo $row[0];?></td>
		<td onclick="getModule('leads/edit?id=<?php echo $row[4];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo $row[1];?>')"  class="blueSimpletext" style="width: 200px;"><?php echo $row[1]." ".$row[8];?></td>
	
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
		
		<td>
		<?php echo $row[15]; ?>
		</td>
		
		<td style="width:200px;"><?php echo date("d-m-y h:i A",strtotime($row[6])) ?> </td>
		
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
	
