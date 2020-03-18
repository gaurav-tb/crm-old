<?php
error_reporting(0);
$con = mysql_connect('localhost','root','');
if(!$con)
{
die();
}
else
{
mysql_select_db('crm',$con);
}
$datetime = date("Y-m-d H:i:s");

$valto = $_POST['valto'];

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
//echo strlen($val).'--';
if(strlen($val) == 10)
	{
		$chkcont = $val - 6000000000;
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
	 $chkcont = $val - 916000000000;
		//echo $chkcont.'<br/>';
		if($chkcont>0)
		{
		echo $correctNo = 1;
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
		$chkcont = $newchk - 6000000000;
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

$correctNo = 1;
if($correctNo == 1)
{
$chequery = "SELECT * FROM  `contact` WHERE (`mobile` =  '$val' ||  `alternateMobile` =  '$val' ||  `phone` =  '$val')";

// AND `delete` = '0' AND `alloted`='1' and `converted`='0'
$chkNum = mysql_query($chequery,$con) or die(mysql_error());
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

$tosavename = ucwords((strtolower($tosavename)));


mysql_query("INSERT INTO `contact` (`ownerid`, `fname`, `mobile`, `email`, `leadstatus`, `leadsource`, `latestresponse`, `contactstatus`, `callbackdate`,  `city`, `product`, `alloted`, `converted`, `mark`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`,`originalsource`) VALUES ('0', '$tosavename', '$val', '$tosaveemail', '1', '$post[3]', '1', '1', '$datetime', '1', '1', '0', '0', '0', '', '$datetime', '$datetime', '$loggeduserid', '0','$post[3]')",$con) or die(mysql_error());
$ct++;
}
else
{
//modified date implement 2020-

$datetime = date('Y-m-d H:i:s', strtotime('-1 month'));


$chequery1 = "SELECT `id` FROM `contact` WHERE (`mobile` =  '$val' ||  `alternateMobile` =  '$val' ||  `phone` =  '$val') AND `alloted`='1' and `converted`='0' and `contact`.`modifieddate` < '$datetime'  and `latestresponse` IN(1,33,53,54,55,56,2,37,38,5)";

			$chkNum1 = mysql_query($chequery1,$con) or die(mysql_error());

			if(mysql_num_rows($chkNum1)>0)
			{
				$rowdata = mysql_fetch_array($chkNum1);
                $tosavename = ucwords((strtolower($tosavename)));



				mysql_query("UPDATE `contact` SET `fname` = '$tosavename', `mobile` = '$val', `email` = '$tosaveemail',`leadsource`='$post[3]',`contact`.`delete`='0',`contact`.`ownerid`='0',`contact`.`alloted`='0',`contact`.`description`='',`contact`.`read`='0',contact.latestresponse='1' WHERE `id` = '$rowdata[0]'",$con) or die(mysql_error());
				$note = "Entry overwritten by ".$loggedname;

				mysql_query("delete from noteline where cid='$rowdata[0]'",$con) or die(mysql_error());

				mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('overwrite', '$note', '$rowpreid[0]', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());
			}
				if($chk == 1)
				{
				$getphreid = mysql_query("SELECT `id` FROM `contact` WHERE `mobile` = '$val' AND `delete` = '0' AND `contact`.`converted`='0'",$con) or die(mysql_error());
				
				if(mysql_num_rows($getpreid) > 0)
				{
				$tosavename = ucwords((strtolower($tosavename)));
				$rowpreid = mysql_fetch_array($getpreid);
				mysql_query("UPDATE `contact` SET `fname` = '$tosavename', `mobile` = '$val', `email` = '$tosaveemail',`leadsource`='$post[3]',`contact`.`delete`='0',`contact`.`ownerid`='0',`contact`.`alloted`='0',`contact`.`read`='0' WHERE `id` = '$rowpreid[0]'",$con) or die(mysql_error());
				$note = "Entry overwritten by ".$loggedname;
				mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('overwrite', '$note', '$rowpreid[0]', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());			
				}
				}
				// if($chkEmail == 1)
				// {
				// $getpreid = mysql_query("SELECT `id` FROM `contact` WHERE `email` = '$tosaveemail' AND `delete` = '0' AND `contact`.`converted`='0'",$con) or die(mysql_error());
				// if(mysql_num_rows($getpreid) > 0)
				// {
				// $rowpreid = mysql_fetch_array($getpreid);
				// mysql_query("UPDATE `contact` SET `fname` = '$tosavename', `mobile` = '$val', `email` = '$tosaveemail',`leadsource`='$post[3]',`contact`.`delete`='0',`contact`.`ownerid`='0',`contact`.`alloted`='0',`contact`.`read`='0' WHERE `id` = '$rowpreid[0]'",$con) or die(mysql_error());
				// $note = "Entry overwritten by ".$loggedname;
				// mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('overwrite', '$note', '$rowpreid[0]', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());			
				// }
				// }
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
//|| $chkEmail == 1 
if($chk == 1 || mysql_num_rows($chkNum1)>0)
{
$done = "Overwritten";
} 
else
{
$done = "Rejected";
}
?>
<?php // echo $done;?>
Total <strong> <?php echo $nt;?> </strong>records were rejected. <span class="blueSimpletext" onclick="ToggleBox('viewList','block','')" style="cursor:pointer">View List</span><br/>
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
