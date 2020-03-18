<?php
$term = $_GET['term'];
include("../../include/conFig.php");
$getData = mysql_query("SELECT `faqcategories`.`id`,faqcategories.categoriesName,faqcategories.createdate,faqcategories.modofieddate,employee.name, faqcategories.id FROM faqcategories,employee WHERE  faqcategories.updatedby = employee.id AND  faqcategories.delete = '0'  AND  faqcategories.categoriesName LIKE '$term%' ORDER BY  faqcategories.categoriesName",$con) or die(mysql_error());
?>

<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th>
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
		<th> Category Name </th>
		<th> Details </th>
		<th> Create Date</th>
		<th> Modified Date </th>
	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	<tr id="fetchRow<?php echo $i;?>">
	<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
		<td class="blueSimpletext"  onclick="getModule('masters/faqcategory/edit?id=<?php echo $row['id'];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','Fetching Data')"  style="width:300px;">
		<?php echo $row['categoriesName'];?></td>
		<td><?php echo $row['description'] ?> </td>
		<td id="details" style="width: 400px;"><?php echo  date("d-m-Y H:i:s",strtotime($row['createdate'])) ?></td>
		<td id="details" style="width: 400px;"><?php echo "Last Modified on ".date("d-m-Y H:i:s",strtotime($row['modofieddate']));?></td>
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
		<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
		<span onclick="getModule('masters/emailcategory/view','viewContent','manipulateContent','Email Category')" style="cursor: pointer">
	<img alt="" src="images/back.png" style="vertical-align:middle; width: 6px;" /> 
	Back To List</span>

</div>


