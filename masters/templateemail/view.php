<?php
include("../../include/conFig.php");
$getData = mysql_query("SELECT templateemail.name,templateemail.modifieddate,employee.name,templateemail.id,templateemail.templateemail,templateemail.onboardingdays,templateemail.templatecategory FROM templateemail,employee WHERE templateemail.updatedby = employee.id AND templateemail.delete = '0' AND templateemail.id != '1' ORDER BY templateemail.id DESC LIMIT 100",$con) or die(mysql_error());
?>
<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Template Master </td>
			<td align="right" style="width: 70%">
			&nbsp;&nbsp;
			<?php  if(in_array('A_templateemail',$thisPer))
			{
			?>
			<input class="buttonGreen" name="Button1" onclick="getModule('masters/templateemail/Templatetext','manipulateContent','viewContent','Template')" type="button" value="Template Merge Text" /><?php } ?>
			<?php  if(in_array('A_templateemail',$thisPer))
			{
			?>
			<input class="buttonGreen" name="Button1" onclick="getModule('masters/templateemail/prenew?chk=chk','manipulateContent','viewContent','Template')" type="button" value="+1 New" /><?php } ?>
			<?php  if(in_array('D_templateemail',$thisPer))
			{
			?>
 
			<input id="" class="buttonnegetive" name="Button1" onclick="deleteData('templateemail','Template')" type="button" value="Delete Selected" /><?php } ?>
			</td>
		</tr>
	</table>
</div>
<div id="directResult" class="form">
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th>
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
		<th>Template Id</th>
		<th>Template Name</th>
	    <th>Days After Welcome Mail</strong></th>
		<th>Email Category</strong></th>
		<th>Details</th>
	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	    <tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>">
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[3];?>" /></td>
		<td><?php echo $row['id']  ?></td>
		<td class="blueSimpletext" onclick="getModule('masters/templateemail/prenew?id=<?php echo $row[3];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','Email Template')" style="width: 300px;">
		<?php echo $row[0];?></td>
		
	    <!-- <td  style="width:400px;"><?php // echo $row[5]." " ."Days";?></td>  -->
		
	    <td id="onboarding" >
		<span onclick="$('#editorlr<?php echo $row[3];?>').show();" id="spanlr<?php echo $row[3];?>">
		<?php echo $row[5]; ?>
		</span>
		<div class="editBoxTop" id="editorlr<?php echo $row[3];?>">
		<input id="<?php echo $row[3];?>lr" value="<?php echo $row[5]; ?>" class="input" style="width:100px;">
		<button class="buttonGreen" style="display:inline-block;padding:5px;" id="<?php echo $row[3];?>lrbutton" onclick="saveOnboading('<?php echo $row[3];?>','lr')">Update</button>
		<button class="buttonnegetive" style="display:inline-block;padding:5px;" id="<?php echo $row[3];?>lrbutton" onclick="$('#editorlr<?php echo $row[3];?>').hide()">x</button>
		</div>
		</td>
	   
	    <td id="category" >
	 	<span onclick="$('#editormc<?php echo $row[3];?>').show();" id="spanmc<?php echo $row[3];?>">
		<?php 
		$sqlTemplate=mysql_query("SELECT `id`,`name` FROM `emailcategories` WHERE emailcategories.delete='0' ORDER BY `emailcategories`.`order`");
		while($rowTemp=mysql_fetch_array($sqlTemplate))
		{
		?>
		<?php if($row[6]==$rowTemp[0]) 
		{
		echo $rowTemp[1];  
		}
		?>
		<?php } ?>
		
		</span>
		<div class="editBoxTop" id="editormc<?php echo $row[3];?>">
		<select id="<?php echo $row[3];?>mc" class="input" style="width:100px;">
		<option value="0">Please Select The Email Category</option>
		<option <?php if($row[6] == 0) echo "selected='selected'";?> value="0"><?php echo 'None' ?></option>
		
		<?php 
		$sqlTemplate=mysql_query("SELECT `id`,`name` FROM `emailcategories` WHERE emailcategories.delete='0' ORDER BY `emailcategories`.`order`");
		while($rowTemp=mysql_fetch_array($sqlTemplate))
		{
		?>
		<option <?php if($row[6] == $rowTemp[0]) echo "selected='selected'";?> value="<?php echo $rowTemp[0] ?>"><?php echo $rowTemp[1] ?></option>
		<?php } ?>
		</select>
		
		
		
		<button class="buttonGreen" style="display:inline-block;padding:5px;" id="<?php echo $row[3];?>mcbutton" onclick="saveNewCategory('<?php echo $row[3];?>','mc')">Update</button>
		<button class="buttonnegetive" style="display:inline-block;padding:5px;" id="<?php echo $row[3];?>mcbutton" onclick="$('#editormc<?php echo $row[3];?>').hide()">x</button>
		</div> 
		</td>
	   

     	<td id="details" style="width: 400px;"><?php echo "Last Updated By ".$row[2]." on ".date("d-m-Y H:i:s",strtotime($row[1]));?>
		</td>
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
	</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
