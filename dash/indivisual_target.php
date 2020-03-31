<?php 
include("../include/conFig.php");
$emp_id = $_GET['emp_id'];
$ownername = $_GET['ownername'];

if($_GET['sort'])
{
$ftoSort = $_GET['ftoSort'];
$sortby = $_GET['sortby'];
$sortstr = "ORDER BY contact.conversionrequestdate .".$ftoSort." ".$sortby."";
}
else
{
$sortstr = "ORDER BY contact.conversionrequestdate ASC";
}

$getData = mysql_query("SELECT code,fname,lname,conversionrequestdate,Level1Approval,pending,converted FROM `contact` WHERE `ownerid` = '$emp_id' AND conversionrequestdate BETWEEN '2020-03-01' AND '2020-03-31' ".$sortstr,$con) or die(mysql_error());

?>
<div class="moduleHeading">
 <table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="left" style="width: 100%">Details For <?php echo "<b>".$ownername."</b>"; ?> (1st Mar 2020 To 31st Mar 2020)<span style="text-transform:capitalize"><?php echo $_GET['name'];?></span></td>
</td>
</tr>
</table> 
</div>
<div>
        <div class=form> 
	    <table style="text-align:center;" width="100%" cellpadding="0" cellspacing="10">
		<tr>
		<th>Client Code</th>	
		<th>Client Name</th>	
		<th>Owner Name</th>	
		<th style="cursor:pointer" onclick="getModule('dash/indivisual_target?sort=true&ftoSort=conversionrequestdate&sortby=<?php if($ftoSort == 'conversionrequestdate'){ if($sortby == 'DESC'){ echo "ASC";} else {echo "DESC";}} else echo "DESC"; ?>','viewContent','manipulateContent','Clients')">
	     Conversion Date &nbsp;
	    <?php if($ftoSort == 'conversionrequestdate'){ if($sortby == 'DESC'){ echo "<img src='images/asc.png' alt='' />";} else {echo "<img src='images/more.png' alt='' />";}} else echo "<img src='images/more.png' alt='' />"; ?>
    	</th>
		<th>Status</th>	
		</tr>

		<?php 

        while($row = mysql_fetch_array($getData))
        {
         if($row['pending']==1 && $row['converted']==0)
         {
         $status = 'Pending at level 1';
         } 
         else if($row['pending']==0 && $row['Level1Approval']==1 && $row['converted']==0)
         {
         $status = 'At Level 2';
         }
         else if($row['pending']==0 && $row['Level1Approval']==0 && $row['converted']==0)
         {
         $status = 'At Level 1';
         }
         else if($row['converted']==1)
         {
         $status = 'Converted To Client';
         }

		echo "<tr>";
		echo "<td>".$row['code']."</td>"; 
		echo "<td>".$row['fname']." ".$row['lname']."</td>"; 
		echo "<td>".$ownername."</td>"; 
		echo "<td>".date('d/M/Y',strtotime($row['conversionrequestdate']))."</td>"; 
		echo "<td>".$status."</td>"; 
		echo "</tr>";
		}
		?>
		</table>
        </div>
       </div> 
