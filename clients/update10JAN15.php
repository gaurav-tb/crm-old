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

$post[1] = trim($post[1]);

if($post[1] != 'undefined')
{
$add = str_ireplace("'","",$post[12]);
$desc = str_ireplace("'","",$post[14]);

$c = count($post);
for($g=21;$g<=$c;$g++)
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
mysql_query("UPDATE `contact` SET `fname`='$post[1]',`lname`='$post[2]',`phone`='$post[3]',`mobile`='$post[4]',`email`='$post[5]',`website`='$post[6]',`leadstatus`='$post[7]',`leadsource`='$post[8]',`latestresponse`='$post[9]',`callbackdate`='$post[10]',`messengerid`='$post[11]',`address`='$add',`city`='$post[13]',`description`='$desc',`product`='$product',`modifieddate`='$datetime',`updatedby`='$loggeduserid',`delete`='0',`altemail`='$post[15]',`dob`='$post[16]',`traderprofile`='$post[17]',`experience`='$post[18]',`invamount`='$post[19]', `language` = '$post[20]' WHERE `id`= '$id'",$con)or die(mysql_error());

$getDate = mysql_query("SELECT `id`, `cid`, `callbackdate`, `ownerid` FROM `callbackdate` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getDate);
$count = mysql_num_rows($getDate);

if($count  > 1)
{
mysql_query("UPDATE `callbackdate` SET `callbackdate`='$post[10]',`updatedby`='$loggeduserid' WHERE  `id` = '$row[0]')",$con) or die(mysql_error());
}
else
{
mysql_query("INSERT INTO `callbackdate`(`cid`, `callbackdate`, `updatedby`, `id`, `ownerid`) VALUES ('$id','$post[10]','$loggeduserid','','$post[0]')",$con) or die(mysql_error());

}

$getData = mysql_query("SELECT employee.name, contact.fname, contact.mobile, contact.callbackdate, leadresponse.name,contact.id,contact.lname FROM contact,employee,leadresponse WHERE contact.ownerid = employee.id AND contact.latestresponse = leadresponse.id AND contact.delete = '0' AND contact.converted = '1' AND contact.id= '$id'".$sortstr,$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>


	<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[5];?>" /></td>
		<td style="width: 300px;">
		<?php echo $row[0];?></td>
		<td onclick="getModule('clients/edit?id=<?php echo $row[5];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo $row['fname'];?>')" class="blueSimpletext">
		<?php echo $row[1];?>
		</td>
		<td>
		<?php echo $row[6];?>
		</td>

		<td>
		<?php echo $row[2];?>
		</td>
				<td   style="width: 150px;">
		<?php
		 if($row[3] != '0000-00-00')
		 {
		 echo date("d,M Y", strtotime($row[3]));
			}
			else
			{
			 echo "--";
			}
		?>
		</td>
		<td><?php echo $row[4];?></td>	
			<td>
		<img onclick="getModule('noteline/index?cid=<?php echo $row[5];?>&name=<?php echo $row[1];?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo $row[0];?>')" src="images/story.png" style="width:15px" title="Story For <?php echo $row[0];?>" alt=""/>
		</td>

<?php
}
else
{
echo "THEREOCCUREDSOMEERRORFORHANGOVER";
}
?>

