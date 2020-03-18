<?php
include("../include/conFig.php");
$id = $_GET['cid'];
$mobile = $_GET['mobile'];
$getC = mysql_query("SELECT * FROM `contact` WHERE `mobile` = '$mobile' AND `delete` = '0'",$con) or die(mysql_error());
$cnt = mysql_num_rows($getC);
if($cnt > 1)
{
?>
<div class="blueSimpletext" style="background:#eee;font-weight:bold;padding:10px;border-bottom:1px #fff solid">Tick the Contact having correct details</div>
<div class="form">
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
<tr>
	<th></th>
	<th>Lead Owner</th>
	<th>First Name</th>
	<th>Mobile</th>
	<th>Callback</th>
	<th>Modified</th>
	<th>Story</th>
</tr>
<?php
$i=0;
while($row = mysql_fetch_array($getC))
{
$owner = $row['ownerid'];
$getName = mysql_query("SELECT `name` FROM `employee` WHERE `id` = '$owner'",$con) or die(mysql_error());
$rowName = mysql_fetch_array($getName);
?>
	<tr  title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row['modifieddate']));?>">
		<td style="width: 20px;">
		<input id="merge<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" onclick="chkTck('merge<?php echo $i;?>')" /></td>

		<td  style="width: 200px;">
		<?php echo $rowName[0];?></td>
		<td class=""  style="width: 150px;"><?php echo $row[1];?></td>
		<td style="display:none" style="width:100px"><?php echo $row['lname'];?></td>
		<td   style="width: 150px;">
		<?php echo $row['mobile'];?>
		</td>
		
				<td   style="width: 150px;">
		<?php
		 if($row[3] != '0000-00-00')
		 {
		 echo date("d,M Y", strtotime($row['callbackdate']));
			}
			else
			{
			 echo "--";
			}
		?>
		</td>
			<td   style="width: 200px;">
		<?php echo date("d,M y H:i",strtotime($row[modifieddate]));?>
		</td>
		<td>
		<img onclick="getModule('noteline/index?cid=<?php echo $row['id'];?>&name=<?php echo $row['fname'];?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo $row['fname'];?>')" src="images/story.png" style="width:15px" title="Story For <?php echo $row[0];?>" alt=""/>
		</td>
	</tr>
<?php
$i++;
$Maxid = $row['id'];
$MaxI = $i;
}
?>
<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
<input id="chkvalue" name="Text1" style="display: none" type="text" value="" />

<tr>
	<td colspan="7"  style="text-align:center">
	<input class="buttonGreen" type="button" value="Merge Contacts"  onclick="chkBox()" />
	</td>
</tr>
</table>
</div>
<?php }
else
{
?>
<div align="center" style="padding:5px;width:550px;-moz-box-shadow: 0 0 20px #222; -webkit-box-shadow: 0 0 20px #222;color:maroon" class="form">
This is a Unique Contact
</div>

<?php }
?>
