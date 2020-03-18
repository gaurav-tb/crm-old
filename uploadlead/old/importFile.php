<?php  
include("../include/conFig.php");
print_r($_POST);

if ($_FILES[csv][size] > 0) { 

    //get the csv file 
    $file = $_FILES[csv][tmp_name]; 
    $handle = fopen($file,"r"); 
     
    //loop through the csv file and insert into database 
    do { 
        if ($data[0] != 'name') { 
		$str =    addslashes($data[0])."--".addslashes($data[1])."--".addslashes($data[2])."--".addslashes($data[5]);
		
$fname[] .= trim(addslashes($data[0]));
$mobile[] .= trim(addslashes($data[1]));
$city[] .= trim(addslashes($data[2]));
$email[] .= trim(addslashes($data[3])); 
$profile[] .= trim(addslashes($data[4]));
$description[] .= trim(addslashes($data[5]));
$ct = 0;
$nt = 0;

		
		
        
        
        
        /*
            mysql_query("INSERT INTO contacts (contact_first, contact_last, contact_email) VALUES 
                ( 
                    '".addslashes($data[0])."', 
                    '".addslashes($data[1])."', 
                    '".addslashes($data[2])."' 
                ) 
            "); 
        
        */
        } 
    } while ($data = fgetcsv($handle,1000,",","'")); 
    // 

    //redirect 
   // header('Location: import.php?success=1'); die; 
$leadsource = $_POST['leadsource'];
	
	
	
	
	
	foreach($mobile as $val)
{
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
		$tosaveCity = trim($city[$key]);
				$tosaveprofile= trim($profile[$key]);
				$tosave= trim($description[$key]);

				$getCity = mysql_query("SELECT `id` FROM `city` WHERE `name` = '$tosaveCity'",$con) or die(mysql_error());
				$rowCity = mysql_fetch_array($getCity);
				$cityid =$rowCity[0];
				if($cityid == '')
				{
				$cityid = '1';
				} 
				
				$getCity = mysql_query("SELECT `id` FROM `traderprofile` WHERE `name` = '$tosaveprofile'",$con) or die(mysql_error());
				$rowCity = mysql_fetch_array($getCity);
				$profileid =$rowCity[0];
				if($profileid == '')
				{
				$profileid = '1';
				} 
				
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

					mysql_query("INSERT INTO `contact` (`ownerid`, `fname`, `mobile`, `email`, `leadstatus`, `leadsource`, `latestresponse`, `contactstatus`, `callbackdate`,  `city`, `description`, `product`, `alloted`, `converted`, `mark`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`,`traderprofile`) VALUES ('0', '$tosavename', '$val', '$tosaveemail ', '1', '$leadsource', '1', '1', '$datetime', '$cityid', '$tosave', '1', '0', '0', '0', '', '$datetime', '$datetime', '$loggeduserid', '0','$profileid')",$con) or die(mysql_error());
			$ct++;
		}
		else
		{
				if($_POST['mobile'])
				{
				$getpreid = mysql_query("SELECT `id` FROM `contact` WHERE `mobile` = '$val' AND `delete` = '0'",$con) or die(mysql_error());
				$rowpreid = mysql_fetch_array($getpreid);
				mysql_query("UPDATE `contact` SET `fname` = '$tosavename', `mobile` = '$val', `email` = '$tosaveemail',`city` = '$cityid', `description` = '$tosave', `traderprofile` = '$profileid' WHERE `id` = '$rowpreid[0]'",$con) or die(mysql_error());
				$note = "Entry overwritten by ".$loggedname;
				mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('overwrite', '$note', '$rowpreid[0]', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());			
				}
				if($_POST['email'])
				{
				$getpreid = mysql_query("SELECT `id` FROM `contact` WHERE `email` = '$tosaveemail' AND `delete` = '0'",$con) or die(mysql_error());
				$rowpreid = mysql_fetch_array($getpreid);
				mysql_query("UPDATE `contact` SET `fname` = '$tosavename', `mobile` = '$val', `email` = '$tosaveemail',`city` = '$cityid', `description` = '$tosave', `traderprofile` = '$profileid'  WHERE `id` = '$rowpreid[0]'",$con) or die(mysql_error());
				$note = "Entry overwritten by ".$loggedname;
				mysql_query("INSERT INTO `noteline` (`subject`, `note`, `cid`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('overwrite', '$note', '$rowpreid[0]', '', '$datetime', '$loggeduserid', '0')",$con) or die(mysql_error());			
				}
				$nt++;
				$notAdded .= $val."****".$tosavename."****".$tosaveemail."<br/>";
		
		}
	
				


}

	
	
	
	
}



if($_POST['mobile'] || $_POST['email'])
{
$done = "Overwritten";
echo $done;
} 
else
{
$done = "Rejected";
echo $done;

}




	$notAdded = explode("<br/>",$notAdded);
	$i=1;
	foreach($notAdded as $val)
	{
	if($val != '')
	{
	$temp = explode("****",$val);
	$substr .='
	<tr class="d'.($i%2).'">
	<td style="text-align:left" align="left">
	'.$i.'
	</td>
	<td style="text-align:left" align="left">
	'.$temp[0].'
	</td>
	<td style="text-align:left" align="left">
'.$temp[1].'

	</td>
	<td style="text-align:left" align="left">
'.$temp[2].'
	</td>
	</tr>';

	$i++;
	}
	}

}	




$response ='

<div class="moduleHeading" style="text-align:left">
Data Uploaded.
</div>
<br/>
<br/>
<div class="form">
<div style="text-align:left;line-height:180%;padding:20px;">
Total <strong>'.$ct.' </strong>numbers added.<br/>
Total <strong>'.$nt.'</strong>numbers were '.$done.'. <span class="blueSimpletext" onclick="ToggleBox(\'viewList\',\'block\',\'\')">View List</span><br/>
<div id="viewList" style="display:none">
List Of Not Added Numbers
<table class="fetch" width="100%" cellpadding="0" cellspacing="0">
	<tr>
<th>#</th><th>Number</th><th>Name</th><th>Email</th>
	</tr>

'.$substr.'
</table>
</div>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>';
?>
<textarea name="TextArea1" cols="20" rows="2" id="idiot"><?php echo $response;?></textarea>
<script type="text/javascript">
window.top.window.document.getElementById('uploadStats').style.display = 'none';
window.top.window.document.getElementById('bigMoodle').style.display = 'block';
window.top.window.document.getElementById('manipulatemoodleContent').style.display = 'block';
window.top.window.document.getElementById('viewmoodleContent').style.display = 'block';
window.top.window.document.getElementById('manipulatemoodleContent').innerHTML = document.getElementById('idiot').value;

</script> 