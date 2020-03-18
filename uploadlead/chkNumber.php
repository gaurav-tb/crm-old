<?php
$con = mysql_connect('localhost','root','');
if(!$con)
{
die();
}
else
{
mysql_select_db('crm',$con);
}

date_default_timezone_set('Asia/Calcutta');
$datetime = date("Y-m-d H:i:s");
$date = date("Y-m-d");

$t1 = time();
$getData = mysql_query("SELECT * FROM `uploadcontact` WHERE `delete` = '0' LIMIT 50",$con) or die(mysql_error());
while($row = mysql_fetch_array($getData))
{
$did[] .= $row['id'];
$mobile[] .= $row['mobile'];
$ls[] .= $row['leadsource'];
$fname[] .= $row['fname'];
$email[] .= $row['email'];
$desc[] .= $row['description'];
$chk[] .= $row['chk'];
}
foreach($mobile as $key => $val)
{
$val = trim($val);

	if($fname[$key] != '')
	{
	$insfname = $fname[$key];
	}
	else
	{
	$insfname = 'NA';
	}
	if($email[$key] != '')
	{
	$insemail = $email[$key];
	}
	else
	{
	$insemail = 'NA';
	}
	if($desc[$key] != '')
	{
	$insdesc = $desc[$key];
	}
	else
	{
	$insdesc = '-';
	}


 
 if(strlen($val) == '10') // phone number is valid
    {
   	$correctNo = 1;
    }
    else // phone number is not valid
    {
	$correctNo = 0;
	}

/*
if(strlen($val) == 10)
	{
		$chkcont = $val - 7000000000;
		if($chkcont>0)
		{
		$correctNo = 1;
		$val = $val;
		}
		else 
		{
		$correctNo = 0;
		}
	}
	else if(strlen($val) == 12)
	{
	$chkcont = $val - 917000000000;

		if($chkcont>0)
		{
		$correctNo = 1;
		$val = substr($val,2,12);
		}
		else 
		{
		$correctNo = 0;
		}

	}
	else  if(strlen($val) == 11 && substr($val,0,1) == '0' )
	{
		$newchk = substr($val,1,11);
		$chkcont = $newchk - 7000000000;
		if($chkcont>0)
		{
		$correctNo = 1;
		$val = substr($val,1,11);		
		}
		else 
		{
		$correctNo = 0;
		}
	}
*/	
if($correctNo == 1)
{
if($email[$key] == '')
{
$chkNum = mysql_query("SELECT `id` FROM `contact` WHERE (`mobile` = '$val') AND `delete` = '0'",$con) or die(mysql_error());
}
else
{
$chkNum = mysql_query("SELECT `id` FROM `contact` WHERE (`mobile` = '$val' OR `email` = '$email') AND `delete` = '0'",$con) or die(mysql_error());
}

		if(mysql_num_rows($chkNum) == 0)
		{
			mysql_query("INSERT INTO `contact` (`ownerid`, `fname`, `mobile`, `email`, `leadstatus`, `leadsource`, `latestresponse`, `contactstatus`, `callbackdate`,  `city`, `description`, `product`, `alloted`, `converted`, `mark`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('0', '$insfname', '$val', '$insemail', '-1-,', '$ls[$key]', '1', '1', '$datetime', '1','$insdesc', '1', '0', '0', '0', '', '$datetime', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());
			$ct++;
		}
		/*else
		{
				if($chk[$key] == 1)
				{
				$getpreid = mysql_query("SELECT `id` FROM `contact` WHERE `mobile` = '$val' AND `delete` = '0'",$con) or die(mysql_error());
				$rowpreid = mysql_fetch_array($getpreid);
				mysql_query("UPDATE `contact` SET `fname` = '$insfname', `mobile` = '$val', `email` = '$insemail' WHERE `id` = '$rowpreid[0]'",$con) or die(mysql_error());
				$note = "Entry overwritten by ".$loggedname;
				mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('overwrite', '$note', '$rowpreid[0]', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());			
				}
				$nt++;
				//$notAdded .= $val."****".$tosavename."****".$tosaveemail."<br/>";
		
		}*/
	
				

	}
	mysql_query("UPDATE `uploadcontact` SET `delete` = '1' WHERE `id` = '$did[$key]'",$con) or die(mysql_error());
}	
$t2 = time();
$time = ($t2 - $t1);
echo "Time taken: ".$time;
?>
<div class="moduleHeading" style="text-align:left">
Data Uploaded.
</div>
<br/>
<br/>
<div style="text-align:left;line-height:180%;padding:20px;">
Total <strong> <?php echo $ct;?> </strong>records added.<br/>
<?php
if($chk[$key] == 1)
{
$done = "Overwritten";
} 
else
{
$done = "Rejected";
}
?>
Total <strong> <?php echo $nt;?> </strong>records were <?php echo $done;?>. <span class="blueSimpletext" onclick="ToggleBox('viewList','block','')" style="cursor:pointer">View List</span><br/>
<div id="viewList" style="display:none;height:300px;overflow-x:hidden;overflow-y:scroll">
List Of Numbers
	<table class="fetch" width="100%" cellpadding="0" cellspacing="0">
	<tr>
<th>#</th><th>Number</th><th>Name</th><th>Email</th>
	</tr>
	<?php
	$notAdded = explode("<br/>",$notAdded);
	$i=1;
	foreach($notAdded as $val)
	{
	if($val != '')
	{
	$temp = explode("****",$val);
	?>
	<tr class="d<?php echo $i%2;?>">
	<td style="text-align:left" align="left">
	<?php echo $i;?>
	</td>
	<td style="text-align:left" align="left">
	<?php
	echo $temp[0];
	?>
	</td>
	<td style="text-align:left" align="left">
	<?php
	echo $temp[1];
	?>
	</td>
	<td style="text-align:left" align="left">
	<?php
	echo $temp[2];
	?>
	</td>
	</tr>
	<?php
	$i++;
	}
	}
	?>
	</table>
	<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
</div>
