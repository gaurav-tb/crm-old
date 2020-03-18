<?php
include("../include/conFig.php");
$data = $_GET['data'];
$upto = $_GET['upto'];
$fc = 100;
$data = explode("--",$data);

if($_GET['view'])
{
$sql = $_GET['sql'];
$sql = stripslashes($sql);
$addStr = " AND contact.id < '$data[0]' ORDER BY contact.id DESC LIMIT 100";
$sql = str_ireplace("ORDER BY contact.id DESC LIMIT 100",$addStr,$sql);
$getData = mysql_query($sql,$con) or die(mysql_error());
}
else
{
$sql =  $_GET['sql'];
$sql = str_ireplace("\\"," ",$sql);

$sql = explode("LIMIT",$sql);
$fr = ($_GET['upto']*50)+1;
$to = 50;
$newsql = $sql[0]." LIMIT ".$fr.",".$to;
$getData = mysql_query($newsql,$con);

}

$countThis = mysql_num_rows($getData);
if(mysql_num_rows($getData) > 0)
{
?>
<table cellpadding="0" cellspacing="0" class="fetch" width="100%">
<?php
echo $getData;
exit;

while($row = mysql_fetch_array($getData))
{
?>
    <tr <?php if($row['id'] == '0') echo "style='font-weight:bold'"; ?>id="fetchRow<?php echo $i;?>"  class="d<?php echo $i%2;?>"   >
	<td style="width:4.5%">
	<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
	
        <td style="width:5%">
		<div style="height:12px;">
		<?php if($row['mark'] == '1') { ?> 

		<img src="images/hot.png" id="hot<?php echo $row['id'];?>" style="height:12px" alt=""  onclick="getModule('leads/markHot?id=<?php echo $row['id'];?>&todo=cold','','hot<?php echo $row['id'];?>','');document.getElementById('cold<?php echo $row['id'];?>').style.display='';"/> 
		<img src="images/cold.png" id="cold<?php echo $row['id'];?>" style="height:12px;display:none" alt="" onclick="getModule('leads/markHot?id=<?php echo $row['id'];?>&todo=hot','','cold<?php echo $row['id'];?>','');document.getElementById('hot<?php echo $row['id'];?>').style.display='';"/>  

		<?php 
		} 
		else 
		{
		?> 
		<img src="images/hot.png" id="hot<?php echo $row['id'];?>" style="height:12px;display:none" alt=""  onclick="getModule('leads/markHot?id=<?php echo $row['id'];?>&todo=cold','','hot<?php echo $row['id'];?>','');document.getElementById('cold<?php echo $row['id'];?>').style.display='';"/> 
		<img src="images/cold.png" id="cold<?php echo $row['id'];?>" style="height:12px" alt="" onclick="getModule('leads/markHot?id=<?php echo $row['id'];?>&todo=hot','','cold<?php echo $row['id'];?>','');document.getElementById('hot<?php echo $row['id'];?>').style.display='';"/>  
		<?php 
		} 
		?>
		</div>
		</td> 	
	

	<td style="width:12%"><?php echo $row['id']; ?> </td>

    <td style="width:10%"><?php echo $row['code'] ?></td>
	
	<?php
	$toPassurl = 'clients/edit?id='.$row['id'].'&i='.$i;
	$toPassurl = base64_encode($toPassurl);
	$showid = base64_encode('manipulateContent');
	$hideid = base64_encode('viewContent');
	$title = base64_encode($row['fname']);
	$finalUrl = 'default.php#'.$toPassurl.'$$**$$'.$showid.'$$**$$'.$hideid.'$$**$$'.$finalUrl;
	?>
		
	<td  style="width:15%;" onclick="getModule('clients/edit?id=<?php echo $row['id'] ;?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo str_ireplace('"','',$row['fname']);?>')" onmousedown="mouseDown(event,'<?php echo $finalUrl;?>')" class="blueSimpletext">
	<?php echo $row['fname'] ." ".$row['lname'];?>
	</td>
	
    
	<?php 
        $brokerageplan = ($row['brokerageplan']==1) ? 'Regular Plan' : 'Premium Plan';
		$ftd = ($row['FTD']!='0000-00-00') ? date("d-M-Y", strtotime($row['FTD'])) : 'NA';
		$ltd = ($row['LTD']!='0000-00-00') ? date("d-M-Y", strtotime($row['LTD'])) : 'NA';
	?>


	<td style="width:15.5%"><?php echo $brokerageplan; ?></td>
    <td><?php echo date("d-M-Y", strtotime($row['conversiondate']));?></td><!-- Approval Date -->
	<td><?php echo $ftd;?></td><!-- Modified Date Date -->
	<td><?php echo $ltd?></td><!-- Modified Date Date -->
	<td><?php echo $row['ledger_balance'];?></td><!-- Modified Date Date -->

	
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


