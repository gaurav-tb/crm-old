<?php
include("../include/conFig.php");
if($_GET['sortby'] != "")
{
$sortby = $_GET['sortby'];
$sorttype = $_GET['sorttype'];
$sql = "SELECT employee.name, employee.mobile, employee.email, profile.name, employee.status, employee.modifieddate,employee.id,employee.joiningdate FROM employee,profile WHERE  employee.profile = profile.id AND employee.delete = '0' ORDER BY ".$sortby." ".$sorttype;
//." LIMIT 100"ste
}
else
{
$sql = "SELECT employee.name, employee.mobile, employee.email, profile.name, employee.status, employee.modifieddate,employee.id,employee.TargetBucket,employee.joiningdate FROM employee,profile WHERE  employee.profile = profile.id AND employee.delete = '0' ORDER BY employee.name ";
}

$getData = mysql_query($sql,$con) or die(mysql_error());
//$getData = mysql_query("SELECT employee.name, employee.mobile, employee.email, employee.city, employee.profile, employee.status, employee.name, employee.updatedby, employee.modifieddate FROM user,employee WHERE employee.updatedby = employee.id AND employee.delete = '0' ORDER BY employee.id DESC LIMIT 100",$con) or die(mysql_error());
?>
<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 10%">Users</td>
			<td align="right" style="width: 90%">
			<span style="font-size:12px" class="blueSimpletext">Sort By</span>
		<select id="sortby" name="Select1" class="input" style="width:91px">
		<option <?php if($_GET['sortby'] == 'employee.name'){echo 'selected = selected';}?> value="employee.name">Name</option>
		<option <?php if($_GET['sortby'] == 'profile.name'){echo 'selected = selected';}?> value="profile.name">Profile</option>
		</select>&nbsp;
			<select id="sorttype" name="Select2" class="input" style="width:108px">
			<option <?php if($_GET['sorttype'] == 'ASC'){echo 'selected = selected';}?> value="ASC">Ascending</option>
			<option <?php if($_GET['sorttype'] == 'DESC'){echo 'selected = selected';}?> value="DESC">Descending</option>

			</select>
			<input class="buttonGreen" name="Button1" style="width: 40px;" type="button" value="Go" onclick="getModule('user/view?sortby='+document.getElementById('sortby').value+'&sorttype='+document.getElementById('sorttype').value,'viewContent','','')" />
			&nbsp;&nbsp;
			<input class="buttonGreen" name="Button1" style="width: 8%;" type="button" value="Mass Edit" onclick="getModule('user/massEdit?type=2','manipulatemoodleContent','viewmoodleContent','Mass Edit')" />
			&nbsp;&nbsp;
			<input class="input" name="Text1" placeholder="Search Users" type="text" id="subsearch" /><input class="buttonGreen" name="Button1" style="width: 40px;" type="button" value="Go" onclick="getModule('user/searchresult?term='+document.getElementById('subsearch').value,'directResult','','Searching for '+document.getElementById('subsearch').value+'..')" />&nbsp;&nbsp;
			<input class="buttonGreen" name="Button1" onclick="getModule('user/new','manipulateContent','viewContent','New User')" type="button" value="+1 New" />
			
			<!-- <input id="" class="buttonnegetive" name="Button1" onclick="deleteData('employee','User')" type="button" value="Delete Selected" /> -->
			<input id="" class="buttonnegetive" name="Button1" onclick="deleteUser('employee','User')" type="button" value="Delete Selected" />

			</td>
		</tr>
	</table>
</div>
<div id="directResult" class="form">
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th>
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
		<th>Employee Id</th>
		<th>Name</th>
		<th>Contact</th>
		<th>Email</th>
		<th>Date of joining </th>
		<th>Profile</th>
		<th>Status</th>

	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>" title="<?php echo "Last Updated on ".date("d-m-Y H:i:s",strtotime($row[5]));?>">
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[6];?>" /></td>
		
		<td><?php echo $row[6];?></td>
		<td class="blueSimpletext" onclick="getModule('user/edit?id=<?php echo $row[6];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo $row[0]?>')" style="width: 300px;">
		<?php echo $row[0];?></td>
		<td>
		<?php echo $row[1];?>
		</td>
		<td>
		<?php echo $row[2];?>
		</td>
		
		<td>
		<?php echo date('d/m/Y',strtotime($row['joiningdate']));?>
		</td>
		
		
		<td><?php echo $row[3];?></td>
		<td><?php if($row[4] == '1') echo "Active"; else echo "Inactive"; ?></td>
	</tr>
	<?php
$i++;
$Maxid = $row[6];
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
	<div style="cursor: pointer;padding-top:5px;" id="fetchingDone">
	<img alt="" src="images/more.png" style="vertical-align: middle; width: 6px;" /> 
	<span id="fetching" style="display: none">Fetching..</span></div>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
