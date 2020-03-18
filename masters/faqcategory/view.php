<?php
include("../../include/conFig.php");
$getData = mysql_query("SELECT * FROM `faqcategories` WHERE `faqcategories`.`delete`='0'",$con) or die(mysql_error());
?>
<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">FAQs Category Master</td>
			<td align="right" style="width: 70%">
			<input class="input" name="Text1" placeholder="Search FAQs Categories" type="text" id="subsearch" /><input class="buttonGreen" name="Button1" style="width: 40px;" type="button" value="Go" onclick="getModule('masters/faqcategory/searchresult?term='+document.getElementById('subsearch').value,'directResult','','Searching for '+document.getElementById('subsearch').value+'..')" />&nbsp;&nbsp;
		
			<input class="buttonGreen" name="Button1" onclick="getModule('masters/faqcategory/new','manipulateContent','viewContent','Lead Response')" type="button" value="+1 New" />
			
            <input id="" class="buttonnegetive" name="Button1" onclick="deleteData('faqcategories','Email Categories')" type="button" value="Delete Selected" />
			</td>
		</tr>
	</table>
</div>
<div id="directResult" class="form">
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
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>">
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
$Maxid = $row[3];
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
	<div onclick="fetchMore('masters/faqcategory/fetchmore');" style="cursor: pointer;padding-top:5px;" id="fetchingDone">
	<img alt="" src="images/more.png" style="vertical-align: middle; width: 6px;" /> 
	More <span id="fetching" style="display: none">Fetching..</span></div>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
