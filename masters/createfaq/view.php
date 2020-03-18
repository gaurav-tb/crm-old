<?php
include("../../include/conFig.php");
$getData = mysql_query("SELECT `salesfaq`.`id`,`faqcategories`.`categoriesName`,`salesfaq`.`questions`,`employee`.`name`,`salesfaq`.`createdate`,`salesfaq`.`modifieddate` FROM `salesfaq` INNER JOIN `faqcategories` ON `salesfaq`.`categories`=`faqcategories`.`id` INNER JOIN `employee` ON `salesfaq`.`contributedBy`=`employee`.`id` WHERE `salesfaq`.`delete`='0' ORDER BY `salesfaq`.`createdate`",$con) or die(mysql_error());
?>
<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">FAQ Master </td>
			<td align="right" style="width: 70%">
			&nbsp;&nbsp;
			<input class="buttonGreen" name="Button1" onclick="getModule('masters/createfaq/prenew?chk=chk','manipulateContent','viewContent','FAQ')" type="button" value="+1 New" />
			<?php  if(in_array('D_templateemail',$thisPer))
			{
			?>
 
			<input id="" class="buttonnegetive" name="Button1" onclick="deleteData('salesfaq','FAQ')" type="button" value="Delete Selected" /><?php } ?>
			</td>
		</tr>
	</table>
</div>
<div id="directResult" class="form">
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th>
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
		<th>FAQ Number </th>
		<th>FAQ Question </th>
	    <th>FAQ Category </th>
		<th>Contributed By </th>
		<th>Create Date</th>
		<th>Details</th>
	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	    <tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>">
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
		<td><?php echo $row['id']  ?></td>
		<td class="blueSimpletext" onclick="getModule('masters/createfaq/prenew?id=<?php echo $row['id'];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','Modify FAQs')" style="width: 300px;">
		<?php echo $row['questions'];?></td>
		
	    <td><?php echo $row['categoriesName']  ?></td>
	   
        <td><?php echo $row['name']  ?></td>	   
	   
	    <td><?php echo date("d-m-Y H:i:s",strtotime($row['createdate']));  ?></td>	   
		
		<td id="details" style="width: 400px;"><?php echo "Last Updated By ".$row['updaterName']." on ".date("d-m-Y H:i:s",strtotime($row['modifieddate']));?>
		</td>
	    </tr>
	
	    
	<?php
$i++;
$Maxid = $row['id'];
$MaxI = $i;
}
?>
</table>
<div id="moreData">
</div>
<div class="moduleFoot">
	<div style="float: right;">
		&nbsp;</div>
	<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
	</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
