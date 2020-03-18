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
$add = str_ireplace("'","",$post[22]);
$desc = str_ireplace("'","",$post[23]);
$calback = $post[17].' '.$post[18];

$c = count($post);
for($g=25;$g<=$c;$g++)
{
$product .= "-".$post[$g]."-,";
}

$getprivousData = mysql_query("SELECT contact.BOPD,contact.TSPS,contact.bankmapping,contact.POA_Activation,contact.FO_Activation,contact.welcomemail,contact.softwaredemogiven,contact.mobile,contact.code FROM contact WHERE contact.id= '$id'",$con) or die(mysql_error());
$rowprivous = mysql_fetch_array($getprivousData);
$mobile=$rowprivous['mobile'];
$code=$rowprivous['code'];
$post34 = '';
$post35 = '';
$post36 = '';
//$post36 = '';

if(!empty($post[33]) && $rowprivous['welcomemail'] == '0')
{
	$post32 =", `welcomemail` = '$post[33]', `welcomemail_date` = '$datetime'";
}

$code = "";
if($post[3] != '') 
{
$code = "TB".$post[3];
}

mysql_query("UPDATE `customersupport` SET `BOClientOwner`='$post[2]',`customersupport`.`AlternativeMobile`='$post[34]' WHERE `clientid`= '$id'",$con)or die(mysql_error());

$first_name = ucwords((strtolower($post[1])));
$last_name = ucwords((strtolower($post[2])));


//,`latestresponse`='$post[16]'
mysql_query("UPDATE `contact` SET `fname`='$first_name',`lname`='',`mobile`='$post[5]',`email`='$post[6]',`phone`='$post[7]',`website`='$post[13]',`leadstatus`='$post[14]',`leadsource`='$post[15]',`callbackdate`='$calback',`messengerid`='$post[20]',`address`='$add',`description`='$desc',`product`='$product',`modifieddate`='$datetime',`updatedby`='$loggeduserid',`delete`='0',`altemail`='$post[8]',`phone`='$post[7]',`dob`='$post[9]',`traderprofile`='$post[10]',`experience`='$post[11]',`invamount`='$post[12]', `language` = '$post[19]', `callbacktime` = '$post[18]', `code` = '$code', `inroducer` = '$post[4]', `pancardnumber` = '$post[24]',`uidnumber`='$post[25]', `bankname` = '$post[26]', `bankbranchname` = '$post[27]', `bankaccounttype` = '$post[28]', `bankaccountnumber` = '$post[29]', `dpname` = '$post[30]', `dpid` = '$post[31]',`firstTradeDate`='$post[21]',`clientid` = '$post[32]'".$post32." WHERE `id`= '$id'",$con)or die(mysql_error());


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

$getData = mysql_query("SELECT employee.name , contact.fname, contact.mobile, contact.callbackdate, leadresponse.name,contact.id,contact.lname,contact.read,contact.conversiondate,contact.product,contact.description,contact.email,contact.code,contact.pancardnumber,contact.bankname,contact.bankbranchname,contact.bankaccounttype,contact.bankaccountnumber,contact.dpname,contact.dpid,contact.clientid,contact.address, employee.email as emp_email FROM contact,employee,leadresponse WHERE contact.ownerid = employee.id AND contact.latestresponse = leadresponse.id AND contact.delete = '0' AND contact.converted = '1' AND contact.id= '$id'".$sortstr,$con) or die(mysql_error());
$row = mysql_fetch_array($getData);


		
		
        /* Loops ends for Client drip mails */
		
		/* Condition ends for welcome mails */


		
		// after backoffice punching done

   /*     $getbopdTemplate = mysql_query("SELECT `subject` FROM  `sentemail` WHERE `cid` = '".$contid."' AND `subject` = 'short_welcome'",$con) or die(mysql_error());
        $rowbopdTemplate = mysql_fetch_array($getbopdTemplate);
        if(empty($rowbopdTemplate))
		{
	    if(!empty($post[34]) && $post[34] == 1)
		{  
		mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$id','14','0','$datetime','0000:00:00')",$con) or die(mysql_error());
		}
        }

        $getbankTemplate = mysql_query("SELECT `subject` FROM  `sentemail` WHERE `cid` = '".$contid."' AND `subject` = 'funds_transfer_using_neft'",$con) or die(mysql_error());
        $rowbankTemplate = mysql_fetch_array($getbankTemplate);
        if(empty($rowbankTemplate))
        {
        if(!empty($post[35]) && ($post[35] == 1 || $post[35] == 2))
	    {
	    mysql_query("INSERT INTO `email_queue`(`email_queue_id`,`cid`,`templateid`,`is_send`,`queue_up_date`,`send_date`) VALUES ('','$id','10','0','$datetime','0000:00:00')",$con) or die(mysql_error());
        }
        }	*/	 
	 



// This Query Used For Get Services(Category)
$service = array();
$getSer = mysql_query("SELECT `id`,`name` FROM `category` WHERE `delete` = '0'",$con) or die(mysql_error());
$getSerCount = mysql_num_rows($getSer);
if($getSerCount == 0)
{
//
}
else
{
	while($rowSer = mysql_fetch_array($getSer))
	{
		$service[$rowSer[0]] =  $rowSer[1];
	}
}
// End Service Query

?>
        <table>
		<tr <?php if($row['id'] == '0') echo "style='font-weight:bold'"; ?>id="fetchRow<?php echo $i;?>" <?php if($row['modifieddate']==$date) {?>   class="modified" <?php } else { ?>  class="level<?php echo $row['levelname'] ?>" <?php } ?> title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row['description']));?>">
		<td style="width:20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
		<td style="width:100px;"><?php echo $row['name']; ?> </td>
		<?php
		$toPassurl = 'clients/edit?id='.$row['id'].'&i='.$i;
		$toPassurl = base64_encode($toPassurl);
		$showid = base64_encode('manipulateContent');
		$hideid = base64_encode('viewContent');
		$title = base64_encode($row['fname']);
		$finalUrl = 'default.php#'.$toPassurl.'$$**$$'.$showid.'$$**$$'.$hideid.'$$**$$'.$finalUrl;
		?>
		<td><?php echo $row['tradingbellsid'] ?></td>
		
		<td style="width:100px" onclick="getModule('clients/edit?id=<?php echo $row['id'] ;?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo str_ireplace('"','',$row['fname']);?>')" onmousedown="mouseDown(event,'<?php echo $finalUrl;?>')" class="blueSimpletext">
		<?php echo $row['fname'] ." ".$row['lname'];?>
		</td>
		
		<td><a class="blueSimpletext clickto" href="callto:<?php echo $row['mobile']; ?>">Click to call</a></td>
	   
	
		<td style="width:100px"><?php echo $row['levelname'];?></td><!-- LEVEL SUPPORT -->
	
        <td style="width:100px"><?php echo date("d,M,Y", strtotime($row['conversiondate']));?></td><!-- Approval Date -->
	
	    <td style="width:100px"><?php echo date("d,M,Y", strtotime($row['callbackdate']));?></td><!-- Call Back Date -->
		
		<td style="width:100px"><?php echo substr($row['description'],0,20);?>..</td><!-- Description -->
		
		<td style="width:100px"><?php echo date("d,M,Y", strtotime($row['callbackdate']));?></td><!-- Callbackdate Date -->
	
	    <td style="width:100px"><?php echo date("d,M,Y", strtotime($row['modifieddate']));?></td><!-- Modified Date Date -->
		
		
		
		<?php 
     	$sql="SELECT SUM(`RevenueGeneration`),SUM(`Turnover`) FROM `expensereport` WHERE `UploadingDate` BETWEEN '$UpdateFrom' AND '$dateTo' AND `Clientid`='$row[0]' GROUP BY Clientid";
        $res=mysql_query($sql,$con);
		$rowEx=mysql_fetch_array($res);
		?>
		
		
		<?php 
		if($rowEx[0]=='')
		{
		$revenue='0';	
		}
		else
		{
		$revenue=$rowEx['RevenueGeneration'];	
		}
		
		if($revenue<=999)
		{
		$n_format = number_format($revenue, 1);
		$suffix = 'Rs';
		$revenue=$n_format ." " . $suffix;
		}
		else if($revenue >= 999 && $revenue <= 99999)
		{
		$n_format = number_format($revenue/1000, 1);
		$suffix = 'K';
		$revenue=$n_format ." " . $suffix;	
		}
		
		else if($revenue >= 99999 && $revenue <= 9999999)
		{
		$n_format = number_format($revenue/100000, 1);
		$suffix = 'Lac';
		$revenue=$n_format ." " . $suffix;	
		}
		
		else if($revenue >= 9999999 && $revenue <= 999999999)
		{
		$n_format = number_format($revenue/10000000, 1);
		$suffix = 'Cr';
		$revenue=$n_format ." " . $suffix;	
		}
		
		
	    ?>
	
		<td style="width:100px"><?php echo $revenue;  ?></td><!-- revenue Generation -->
		
		
		<?php 
	/*	if($rowEx[1]=='')
		{
		$turnover='0';	
		}
		else
		{
		$turnover=$rowEx['Turnover'];	
		}
		
		if($turnover<=999)
		{
		$n_format = number_format($turnover, 1);
		$suffix = 'Rs';
		$turnover=$n_format ." " . $suffix;
		}
		else if($turnover >= 999 && $turnover <= 99999)
		{
		$n_format = number_format($turnover/1000, 1);
		$suffix = 'K';
		$turnover=$n_format ." " . $suffix;	
		}
		
		else if($turnover>= 99999 && $turnover <= 9999999)
		{
		$n_format = number_format($turnover/100000, 1);
		$suffix = 'Lac';
		$turnover=$n_format ." " . $suffix;	
		}
		
		else if($turnover >= 9999999 && $turnover <= 999999999)
		{
		$n_format = number_format($turnover/10000000, 1);
		$suffix = 'Cr';
		$turnover=$n_format ." " . $suffix;	
		}
		
		*/
		
	     ?>
		
		
	<!-- 	<td style="width:100px"><?php // echo $turnover; ?></td><!-- revenue Generation -->
		
		
		
		<?php 
		$rowCount=mysql_num_rows($res); 
		if($rowCount>0)
		{
		?>
	   <td style='width:100px'><img src="images/right.png" style="width:15px" alt=""/></td>
		<?php }
		if($rowCount==0)
		{
        $currentDate = strtotime($UpdateFrom);
        $futureDate = $currentDate-(2678400);
        $prevDate= date("Y-m-d H:i:s", $futureDate); 
  	
		$sql="SELECT * FROM `expensereport` WHERE `UploadingDate` BETWEEN '$prevDate' AND '$UpdateFrom' AND `Clientid`='$row[0]' GROUP BY Clientid";
		$rowPrev=mysql_num_rows($res);
 		
		if($rowPrev>0 )
		{  ?>
	      <td style='width:100px'><img src="images/exclame.png" style="width:15px" alt=""/></td>
		<?php   }
		if($rowPrev==0 )
		{
        $sql="SELECT * FROM `expensereport` WHERE `Clientid`='$row[0]' GROUP BY Clientid";
		$rowAll=mysql_num_rows($res);
		if($rowAll==0)
		{  ?>
		<td style='width:100px'><img src="images/delete.png" style="width:15px" alt=""/></td>
		<?php   }
 		}
		}
		
		$sql="SELECT `name` FROM `employee` WHERE `id`='$row[3]'";
		$res=mysql_query($sql,$con);
		$rowName=mysql_fetch_array($res);
		?>
		
		
		
		 
		<td style="width:100px"><?php echo ucfirst(strtolower($rowName['name']));?></td>
 
		<td>
<img onclick="SupportLevel('<?php echo $row['id'] ;?>')"  src="images/story.png" style="width:15px" title="Story For <?php echo $row[0];?>" alt=""/>
			
</td>
</tr>
</table>
<?php
}
else
{
echo "THEREOCCUREDSOMEERRORFORHANGOVER";
}

?>


