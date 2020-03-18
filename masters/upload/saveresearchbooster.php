
<?php  
include("../../include/conFig.php");

if($_FILES[csv][size] > 0) 
{ 
$file = $_FILES[csv][tmp_name]; 
$handle = fopen($file,"r"); 
     
do { 

$str =    addslashes($data[0])."--".addslashes($data[1])."--".addslashes($data[2]);

		
$clientcode[] .= trim(addslashes($data[0]));
$clientAmt[] .= trim(addslashes($data[1]));
$paydate[].= date('Y-m-d',strtotime($data[2]));




}
while($data = fgetcsv($handle,1000,",","'"));  
     
$thisdate = $_POST['date'];

	
foreach($clientcode as $key => $val)
{
/*	
$res=mysql_query("SELECT * FROM `researchbooster` WHERE `clientcode`='$clientcode[$key]' AND `PayDate`='$paydate[$key]'",$con) or die(mysql_error());

if(mysql_num_rows($res)==0)
{  */


$result=mysql_query("INSERT INTO `researchbooster`(`id`,`clientcode`,`clientamount`,`PayDate`,`UploadingDate`) VALUES('','$clientcode[$key]','$clientAmt[$key]','$paydate[$key]','$thisdate')",$con) or die(mysql_error());


/* }   */
}

if($result)
{  ?>
<script>
setTimeout("window.close()",0);	
</script>		
	
<?php  }
}	
?>
<script type="text/javascript">
window.top.window.document.getElementById('uploadStats').style.display = 'none';
window.top.window.document.getElementById('bigMoodle').style.display = 'block';
window.top.window.document.getElementById('manipulatemoodleContent').style.display = 'block';
window.top.window.document.getElementById('viewmoodleContent').style.display = 'block';
window.top.window.document.getElementById('manipulatemoodleContent').innerHTML ="Data Successfully Uploaded"

</script> 	

