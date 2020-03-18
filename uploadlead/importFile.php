<?php  
include("../include/conFig.php");
print_r($_POST);

if ($_FILES[csv][size] > 0) 
{ 

  //get the csv file 
    $file = $_FILES[csv][tmp_name]; 
    $handle = fopen($file,"r"); 
     
    //loop through the csv file and insert into database 
do { 
if ($data[0] != 'name') 
{ 
$str =    addslashes($data[0])."--".addslashes($data[1])."--".addslashes($data[2])."--".addslashes($data[5]);
		
$fname[] .=ucwords((strtolower($data[0])));
$mobile[] .= trim(addslashes($data[1]));
$city[] .= trim(addslashes($data[2]));
$email[] .= trim(addslashes($data[3])); 
$profile[] .= trim(addslashes($data[4]));
$description[] .= trim(addslashes($data[5]));
$ct = 0;
$nt = 0;
} 
} while ($data = fgetcsv($handle,1000,",","'")); 
	
    // 

    //redirect 
   // header('Location: import.php?success=1'); die; 
$leadsource = $_POST['leadsource'];
$chk = $_POST['mobile'];
//$chkemail = $_POST['email'];	
	
	
foreach($mobile as $key => $val)
{
if($profile[$key] != '' && $description[$key] != '')
{
$desc = "Profile- ".$profile[$key]."<br/>Description- ".$description[$key];
}
else if($profile[$key] != '')
{
$desc = "Profile- ".$profile[$key];
}
else if($description[$key] != '')
{
$desc = "Description- ".$description[$key];
}
else
{
$desc = '-';
}


$val = trim($val);
//echo "INSERT INTO `uploadcontact` (`ownerid`, `fname`, `mobile`, `email`, `leadstatus`, `leadsource`, `latestresponse`, `contactstatus`, `callbackdate`,  `city`, `description`, `product`, `alloted`, `converted`, `mark`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`, `chk`) VALUES ('0', '$fname[$key]', '$val', '$email[$key]', '-1-,', '$leadsource', '1', '1', '$datetime', '1', '$desc', '1', '0', '0', '0', '', '$datetime', '$datetime', '$loggeduserid', '0', '$chk')";
//mysql_query("INSERT INTO `uploadcontact` (`ownerid`, `fname`, `mobile`, `email`, `leadstatus`, `leadsource`, `latestresponse`, `contactstatus`, `callbackdate`,  `city`, `description`, `product`, `alloted`, `converted`, `mark`, `id`, `createdate`, `modifieddate`, `updatedby`, `delete`, `chk`) VALUES ('0', '$fname[$key]', '$val', '$email[$key]', '-1-,', '$leadsource', '1', '1', '$datetime', '1', '$desc', '1', '0', '0', '0', '', '$datetime', '$datetime', '$loggeduserid', '0', '$chk')",$con) or die(mysql_error());
mysql_query("UPDATE `contact` SET `fname`='$fname[$key]' WHERE `mobile`='$mobile[$key]'",$con) or die(mysql_error());		
		
}	
}
?>
<script type="text/javascript">
window.top.window.document.getElementById('uploadStats').style.display = 'none';
window.top.window.document.getElementById('bigMoodle').style.display = 'block';
window.top.window.document.getElementById('manipulatemoodleContent').style.display = 'block';
window.top.window.document.getElementById('viewmoodleContent').style.display = 'block';
window.top.window.document.getElementById('manipulatemoodleContent').innerHTML ="Data Successfully Uploaded"

</script> 	

