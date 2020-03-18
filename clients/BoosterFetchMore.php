<?php
include("../include/conFig.php");
$data = $_GET['data'];
$upto = $_GET['upto'];
//$fc = $_GET['fc'];
$fc = 100;
$data = explode("--",$data);

if($_GET['view'])
{
$sql = $_GET['sql'];
$sql = stripslashes($sql);
$addStr = " AND contact.id < '$data[0]' ORDER BY contact.id DESC LIMIT 50";
$sql = str_ireplace("ORDER BY contact.id DESC LIMIT 50",$addStr,$sql);
$getData = mysql_query($sql,$con) or die(mysql_error());
}
else
{
$sql=$_GET['sql'];
$sql=str_ireplace("\\"," ",$sql);
$sql=explode("LIMIT",$sql);
$fr=($_GET['upto']*50)+1;
$to=50;
$newsql=$sql[0]." LIMIT ".$fr.",".$to;
$getData = mysql_query($newsql,$con);
}
$countThis = mysql_num_rows($getData);
if(mysql_num_rows($getData) > 0)
{
?>
<table width="100%" cellpadding="0" cellspacing="0" class="fetch">
<?php

while($row = mysql_fetch_array($getData))
{
?>
        <tr <?php if($row['id'] == '0') echo "style='font-weight:bold'";   ?>  class="d<?php echo $i%2;?>"  id="fetchRow<?php echo $i;?>" <?php if($row['modifieddate']==$date) {?>   class="modified" <?php } else { ?>  class="level<?php echo $row['levelname'] ?>" <?php } ?> title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row['description']));?>">
		<td style="width:20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" />
		</td>
		<td style="width:110px"><?php echo $row['id'] ?></td>
		<td style="width:100px;"><?php echo $row['name']; ?> </td>
		<?php
		$toPassurl = 'clients/edit?id='.$row['id'].'&i='.$i;
		$toPassurl = base64_encode($toPassurl);
		$showid = base64_encode('manipulateContent');
		$hideid = base64_encode('viewContent');
		$title = base64_encode($row['fname']);
		$finalUrl = 'default.php#'.$toPassurl.'$$**$$'.$showid.'$$**$$'.$hideid.'$$**$$'.$finalUrl;
		?>
		
		<td style="width:100px" onclick="getModule('clients/edit?id=<?php echo $row['id'] ;?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo str_ireplace('"','',$row['fname']." ".$row['lname']);?>')" onmousedown="mouseDown(event,'<?php echo $finalUrl;?>')" class="blueSimpletext">
		<?php echo $row['fname'] ." ".$row['lname'];?>
		</td>
		
		<td style="width:100px"><a class="blueSimpletext clickto" href="callto:<?php echo $row['mobile']; ?>">Click to call</a></td><!-- LEVEL SUPPORT -->
	
	    <td style="width:100px"><?php echo $row['code'];?></td><!-- LEVEL SUPPORT -->
	
        <td style="width:100px"><?php echo date("d,M,Y", strtotime($row['StartDate']));?></td><!-- Start Date -->
	
	    <td style="width:100px"><?php echo date("d,M,Y", strtotime($row['EndDate']));?></td><!-- Ending Date -->

	    <td style="width:100px"><?php echo round($row['Activationamt']);?></td><!-- Activation Amount -->

		<td style="width:100px"><?php if($row['EmailReplied']==1) { echo  'Yes'; }  else  { echo  'No';  }  ?></td><!-- Email Replied -->
		
		<td style="width:100px"><?php if($row['FundDebited']==1) { echo 'Yes';  } else { echo  'No' ;  }  ?></td><!-- Fund Debited -->
		
		<td style="width:100px"><?php if($row['FundAvailable']==1) { echo 'Credit Balance';  } else if($row['FundAvailable']==2) { echo 'Excess Stocks With POA';  } else { echo  'Insufficient Fund' ;  } ?></td><!-- Callbackdate Date -->
	
	    <td>
		<img onclick="getModule('noteline/index?cid=<?php echo $row['id'];?>&name=<?php echo $row['fname']. " ".$row['lname'] ;?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo $row['id'];?>')" src="images/story.png" style="width:15px" title="Story For <?php echo $row['fname'] . " ". $row['lname'] ;?>" alt=""/>
		</td>
	
        </tr>

	<?php
$i++;
$Maxid = $row['id'];
$MaxI = $i;
}
?>
</table>
<?php
echo "STRINGUSEDTODETECTMAXID";
echo $Maxid;
echo "STRINGUSEDTODETECTMAXID";
echo $list;
echo "STRINGUSEDTODETECTMAXID";
echo $countThis;
}
else
{

?>
<table width="100%" cellpadding="0" cellspacing="0" class="fetch">
<tr class="<?php echo $i%2;?>">
<td colspan="10" style="font-size:24px;text-align:center;background:#eee;color:#aaa;" align="center">No More Data To Show!</td>
<!-- No More  -->
</tr>
</table>
<?php
}
?>
