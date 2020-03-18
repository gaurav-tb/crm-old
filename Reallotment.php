<?php 

include('include/conFig.php');


$clientid=$_GET['ClientID'];

$Empid=$_GET['Empid'];

$getData=mysql_query("SELECT * FROM `contact` WHERE `id`='$clientid' AND `ownerid`='1'",$con) or die(mysql_error());

if(mysql_num_rows($getData) > 0)
{
mysql_query("UPDATE `contact` SET `ownerid`='$Empid',`notified`='2' WHERE `id`='$clientid'",$con) or die(mysql_error());	

$row=mysql_fetch_array($getData);
?>

 <table class="fetch" style="width:100%">
 <tr onclick="getModule('leads/edit?id=<?php echo $row['id'];?>&i=0','manipulateContent','viewContent','NA');this.style.display ='none'">
 <td style="width:50%">
 <?php echo $row['fname'];?>
 </td>
 <td style="width:50%">
 <?php echo $row['mobile'];?>
 </td>
 </tr>    
 </table>
 
<?php 
}
else
{
echo 'NOTHINGFOUNDHERE';	
}   
	
mysql_close(); 


?>