<?php
include("../include/conFig.php");

$valto = $_POST['valto'];
//Pranay Dongre*$*$*Subject*$*$*1*$*$*2012-10-17*$*$*3*$*$*5*$*$*null*$*$*1*$*$*null*$*$*1*$*$*desc
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
$fname = explode("<br/>",$post[0]);
$mobile = explode("<br/>",$post[1]);
$email = explode("<br/>",$post[2]); 
$ct = 0;
$nt = 0;
$chk = $post[4];
$chkEmail = $post[5];
foreach($mobile as $val)
{

		$val = trim($val);

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
$key = array_search($val,$mobile);  
$tosavename = $fname[$key];
$tosaveemail = $email[$key];
$tosaveemail= trim($tosaveemail);
if($correctNo == 1)
{
if($tosaveemail == '')
{
$chkNum = mysql_query("SELECT `id` FROM `contact` WHERE (`mobile` = '$val') AND `delete` = '0'",$con) or die(mysql_error());
}
else
{
$chkNum = mysql_query("SELECT `id` FROM `contact` WHERE (`mobile` = '$val' OR `email` = '$tosaveemail') AND `delete` = '0'",$con) or die(mysql_error());
}

		if(mysql_num_rows($chkNum) == 0)
		{
		if($tosavename == '')
			{
				$tosavename = 'Not Given';
			}
			if($tosaveemail == '')
			{
				$tosaveemail = 'Not Given';
			}

			mysql_query("INSERT INTO `contact` (`ownerid`, `fname`, `mobile`, `email`, `leadstatus`, `leadsource`, `latestresponse`, `contactstatus`, `callbackdate`,  `city`, `product`, `alloted`, `converted`, `mark`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('0', '$tosavename', '$val', '$tosaveemail', '1', '$post[3]', '1', '1', '$datetime', '1', '1', '0', '0', '0', '', '$datetime', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());
			$ct++;
		}
		else
		{
				if($chk == 1)
				{
				$getpreid = mysql_query("SELECT `id` FROM `contact` WHERE `mobile` = '$val' AND `delete` = '0'",$con) or die(mysql_error());
				$rowpreid = mysql_fetch_array($getpreid);
				mysql_query("UPDATE `contact` SET `fname` = '$tosavename', `mobile` = '$val', `email` = '$tosaveemail' WHERE `id` = '$rowpreid[0]'",$con) or die(mysql_error());
				$note = "Entry overwritten by ".$loggedname;
				mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('overwrite', '$note', '$rowpreid[0]', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());			
				}
				if($chkEmail == 1)
				{
				$getpreid = mysql_query("SELECT `id` FROM `contact` WHERE `email` = '$tosaveemail' AND `delete` = '0'",$con) or die(mysql_error());
				$rowpreid = mysql_fetch_array($getpreid);
				mysql_query("UPDATE `contact` SET `fname` = '$tosavename', `mobile` = '$val', `email` = '$tosaveemail' WHERE `id` = '$rowpreid[0]'",$con) or die(mysql_error());
				$note = "Entry overwritten by ".$loggedname;
				mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('overwrite', '$note', '$rowpreid[0]', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());			
				}
				$nt++;
				$notAdded .= $val."****".$tosavename."****".$tosaveemail."<br/>";
		
		}
	
				

	}
}
?>
<div class="moduleHeading" style="text-align:left">
Data Uploaded.
</div>
<br/>
<br/>
<div style="text-align:left;line-height:180%;padding:20px;">
Total <strong> <?php echo $ct;?> </strong>records added.<br/>
<?php
if($chk == 1 || $chkEmail == 1)
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