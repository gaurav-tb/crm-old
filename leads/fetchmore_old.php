<?php
include("../include/conFig.php");
echo $_GET['sql'];
$data = $_GET['data'];
//$fc = $_GET['fc'];
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
	if(in_array('VA_leads',$thisPer))
	{
		$getData = mysql_query("SELECT employee.name, contact.fname, contact.mobile, contact.callbackdate,contact.id,leadresponse.name,contact.modifieddate,contact.mark FROM contact,employee,leadresponse WHERE contact.ownerid = employee.id AND contact.delete = '0' AND contact.converted= '0' AND contact.latestresponse = leadresponse.id AND contact.id < '$data[0]' ORDER BY contact.id DESC LIMIT ".$fc,$con) or die(mysql_error());
	}
	else
	{
		$getData = mysql_query("SELECT employee.name, contact.fname, contact.mobile, contact.callbackdate,contact.id,leadresponse.name,contact.modifieddate,contact.mark FROM contact,employee,leadresponse WHERE contact.ownerid = employee.id AND contact.delete = '0' AND contact.converted= '0' AND contact.latestresponse = leadresponse.id AND contact.id < '$data[0]' AND contact.ownerid = '$loggeduserid' ORDER BY contact.id DESC LIMIT ".$fc,$con) or die(mysql_error());
	}
}
if(mysql_num_rows($getData) > 0)
{
?>
<table width="100%" cellpadding="0" cellspacing="0" class="fetch">
<?php
$i=$data[1];
while($row = mysql_fetch_array($getData))
{
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row[6]));?>">
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[4];?>" /></td>

		<td style="width:15px;">
		<div style="height:12px;">
		<?php if($row[7] == '1') { ?> 

		<img src="images/hot.png" id="hot<?php echo $row[4];?>" style="height:12px" alt=""  onclick="getModule('leads/markHot?id=<?php echo $row[4];?>&todo=cold','','hot<?php echo $row[4];?>','');document.getElementById('cold<?php echo $row[4];?>').style.display='';"/> 
		<img src="images/cold.png" id="cold<?php echo $row[4];?>" style="height:12px;display:none" alt="" onclick="getModule('leads/markHot?id=<?php echo $row[4];?>&todo=hot','','cold<?php echo $row[4];?>','');document.getElementById('hot<?php echo $row[4];?>').style.display='';"/>  

		<?php 
		} 
		else 
		{
		?> 
		<img src="images/hot.png" id="hot<?php echo $row[4];?>" style="height:12px;display:none" alt=""  onclick="getModule('leads/markHot?id=<?php echo $row[4];?>&todo=cold','','hot<?php echo $row[4];?>','');document.getElementById('cold<?php echo $row[4];?>').style.display='';"/> 
		<img src="images/cold.png" id="cold<?php echo $row[4];?>" style="height:12px" alt="" onclick="getModule('leads/markHot?id=<?php echo $row[4];?>&todo=hot','','cold<?php echo $row[4];?>','');document.getElementById('hot<?php echo $row[4];?>').style.display='';"/>  
		<?php 
		} 
		?>
		</div>
		</td>
		<td style="width: 250px;">
		<?php echo $row[0];?></td>
		<td  <?php if(in_array('U_leads',$thisPer)){?>
onclick="getModule('leads/edit?id=<?php echo $row[4];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo $row[1];?>')" <?php } ?> class="blueSimpletext"  style="width: 200px;"><?php echo $row[1];?></td>
		<td   style="width: 100px;">
		<?php echo $row[2];?>
		</td>
				<td   style="width: 150px;">
		<?php
		 if($row[3] != '0000-00-00')
		 {
		 echo date("d,M Y", strtotime($row[3]));
			}
			else
			{
			 echo "--";
			}
		?>
		</td>
			<td   style="width: 200px;">
		<?php echo $row[5];?>
		</td>
		<td>
		<img onclick="getModule('noteline/index?cid=<?php echo $row[4];?>&name=<?php echo $row[1];?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo $row[0];?>')" src="images/story.png" style="width:15px" title="Story For <?php echo $row[0];?>" alt=""/>
		</td>

	</tr>
	
	<?php
$i++;
$Maxid = $row[4];
$MaxI = $i;
}
?>
</table>
THISISUSEDTOBREAKSTRING
<?php echo $Maxid.'--'.$MaxI;?>
<?php
}
else
{
echo "FALSEDATA";
}
?>
