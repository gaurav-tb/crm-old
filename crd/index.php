<?php
include("../include/conFig.php");
function getCustomDate($days)
{
$time = time();
$previous = $time - ($days * 24 * 60* 60);
$pDate = date("Y-m-d",$previous);
return $pDate;
}
?>
<div class="moduleHeading">Customer Relationship Division</div>
	<table style="" cellpadding="" cellspacing="2" width="100%">
	<tr>
<th style="width: 20%;color:#fff;padding:5px;font-weight:normal" class="blueSimple">Not Contacted Clients With More Than 3 days of Activation</th>
<th style="width: 20%;color:#fff;padding:5px;font-weight:normal" class="blueSimple">Not Contacted Clients With More Than 15 days of Activation</th>
<th style="width: 20%;color:#fff;padding:5px;font-weight:normal" class="blueSimple">Not Contacted Clients With More Than 30 days of Activation</th>
<th style="width: 20%;color:#fff;padding:5px;font-weight:normal" class="blueSimple">Not Contacted Clients With More Than 60 days of Activation</th>
<th style="width: 20%;color:#fff;padding:5px;font-weight:normal" class="blueSimple">Not Contacted Clients With More Than 90 days of Activation</th>
	</tr>
	<tr>
		<td style="width: 20%" valign="top">
			<div style="height:600px;overflow-x:hidden;overflow-y:auto">
				<table cellpadding="0" cellspacing="0" class="fetch" width="100%">
				<?php
				$i=0;
				$threedays = getCustomDate(3);
				$getData = mysql_query("SELECT DISTINCT(contact.id),contact.fname,contact.lname,contact.mobile FROM contact,noteline WHERE contact.createdate <= '$threedays' AND noteline.cid = contact.id AND contact.converted = '1' AND noteline.id NOT IN (SELECT `id` FROM `noteline` WHERE `subject` = 'call' AND `createdate` >= '$threedays') AND contact.id NOT IN (SELECT `cid` FROM `noteline` WHERE `subject` = 'call' AND `createdate` >= '$threedays')",$con) or die(mysql_error());
				while($row = mysql_fetch_array($getData))
				{
				?>
				<tr class="d<?php echo $i%2;?>">
					<td>
					<div style="padding:5px;;float:right">
						<img src="images/viewdetails.png" style="height:15px;cursor:pointer" title="View Details" alt=""   onclick="getModule('crd/clientDetails?id=<?php echo $row[0];?>&amp;i=<?php echo $i;?>&amp;name=<?php echo $row['fname'];?>','manipulatemoodleContent','viewmoodleContent','1')"/>
						<img src="images/story.png" style="height:15px;cursor:pointer" title="Story"  alt=""  onclick="getModule('noteline/index?cid=<?php echo $row[0];?>&name=<?php echo $row[1];?>&amp;i=<?php echo $i;?>','manipulatemoodleContent','viewmoodleContent','1')"/>
					</div>

					&nbsp;<?php echo $row[1]." ".$row[2]?><br/><em style="font-size:12px;"><?php echo $row[3]?></em>
						
					</td>
				</tr>
				<?php 
				$i++;
				}
				?>
				</table>
				<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
			</div>
		</td>
		<td style="width: 20%" valign="top">
			<div style="height:600px;overflow-x:hidden;overflow-y:auto">
				<table cellpadding="0" cellspacing="0" class="fetch" width="100%">
				<?php
				$i=0;
				$threedays = getCustomDate(15);
				$getData = mysql_query("SELECT DISTINCT(contact.id),contact.fname,contact.lname,contact.mobile FROM contact,noteline WHERE contact.createdate <= '$threedays' AND noteline.cid = contact.id AND contact.converted = '1' AND noteline.id NOT IN (SELECT `id` FROM `noteline` WHERE `subject` = 'call' AND `createdate` >= '$threedays') AND contact.id NOT IN (SELECT `cid` FROM `noteline` WHERE `subject` = 'call' AND `createdate` >= '$threedays')",$con) or die(mysql_error());
				while($row = mysql_fetch_array($getData))
				{
				?>
				<tr class="d<?php echo $i%2;?>">
					<td>
					<div style="padding:5px;;float:right">
						<img src="images/viewdetails.png" style="height:15px;cursor:pointer" title="View Details" alt=""   onclick="getModule('crd/clientDetails?id=<?php echo $row[0];?>&amp;i=<?php echo $i;?>&amp;name=<?php echo $row['fname'];?>','manipulatemoodleContent','viewmoodleContent','1')"/>
						<img src="images/story.png" style="height:15px;cursor:pointer" title="Story"  alt=""  onclick="getModule('noteline/index?cid=<?php echo $row[0];?>&name=<?php echo $row[1];?>&amp;i=<?php echo $i;?>','manipulatemoodleContent','viewmoodleContent','1')"/>
					</div>

						<?php echo $row[1]." ".$row[2]?><br/><em style="font-size:12px;"><?php echo $row[3]?></em>
					</td>
				</tr>
				<?php 
				$i++;
				}
				?>
				</table>
				<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
			</div>
		</td>
		<td style="width: 20%" valign="top">
			<div style="height:600px;overflow-x:hidden;overflow-y:auto">
				<table cellpadding="0" cellspacing="0" class="fetch" width="100%">
				<?php
				$i=0;
				$threedays = getCustomDate(30);
				$getData = mysql_query("SELECT DISTINCT(contact.id),contact.fname,contact.lname,contact.mobile FROM contact,noteline WHERE contact.createdate <= '$threedays' AND noteline.cid = contact.id AND contact.converted = '1' AND noteline.id NOT IN (SELECT `id` FROM `noteline` WHERE `subject` = 'call' AND `createdate` >= '$threedays') AND contact.id NOT IN (SELECT `cid` FROM `noteline` WHERE `subject` = 'call' AND `createdate` >= '$threedays')",$con) or die(mysql_error());
				while($row = mysql_fetch_array($getData))
				{
				?>
				<tr class="d<?php echo $i%2;?>">
					<td>
					<div style="padding:5px;;float:right">
						<img src="images/viewdetails.png" style="height:15px;cursor:pointer" title="View Details" alt=""   onclick="getModule('crd/clientDetails?id=<?php echo $row[0];?>&amp;i=<?php echo $i;?>&amp;name=<?php echo $row['fname'];?>','manipulatemoodleContent','viewmoodleContent','1')"/>
						<img src="images/story.png" style="height:15px;cursor:pointer" title="Story"  alt=""  onclick="getModule('noteline/index?cid=<?php echo $row[0];?>&name=<?php echo $row[1];?>&amp;i=<?php echo $i;?>','manipulatemoodleContent','viewmoodleContent','1')"/>
					</div>

					<?php echo $row[1]." ".$row[2]?><br/><em style="font-size:12px;"><?php echo $row[3]?></em>
					</td>
				</tr>
				<?php 
				$i++;
				}
				?>
				</table>
				<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
			</div>
		</td>
		<td style="width: 20%" valign="top">
			<div style="height:600px;overflow-x:hidden;overflow-y:auto">
				<table cellpadding="0" cellspacing="0" class="fetch" width="100%">
				<?php
				$i=0;
				$threedays = getCustomDate(60);
				$getData = mysql_query("SELECT DISTINCT(contact.id),contact.fname,contact.lname,contact.mobile FROM contact,noteline WHERE contact.createdate <= '$threedays' AND noteline.cid = contact.id AND contact.converted = '1' AND noteline.id NOT IN (SELECT `id` FROM `noteline` WHERE `subject` = 'call' AND `createdate` >= '$threedays') AND contact.id NOT IN (SELECT `cid` FROM `noteline` WHERE `subject` = 'call' AND `createdate` >= '$threedays')",$con) or die(mysql_error());
				while($row = mysql_fetch_array($getData))
				{
				?>
				<tr class="d<?php echo $i%2;?>">
					<td>
					<div style="padding:5px;;float:right">
						<img src="images/viewdetails.png" style="height:15px;cursor:pointer" title="View Details" alt=""   onclick="getModule('crd/clientDetails?id=<?php echo $row[0];?>&amp;i=<?php echo $i;?>&amp;name=<?php echo $row['fname'];?>','manipulatemoodleContent','viewmoodleContent','1')"/>
						<img src="images/story.png" style="height:15px;cursor:pointer" title="Story"  alt=""  onclick="getModule('noteline/index?cid=<?php echo $row[0];?>&name=<?php echo $row[1];?>&amp;i=<?php echo $i;?>','manipulatemoodleContent','viewmoodleContent','1')"/>
					</div>

						<?php echo $row[1]." ".$row[2]?><br/><em style="font-size:12px;"><?php echo $row[3]?></em>
					</td>
				</tr>
				<?php 
				$i++;
				}
				?>
				</table>
				<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
			</div>
		</td>
		<td style="width: 20%" valign="top">
			<div style="height:600px;overflow-x:hidden;overflow-y:auto">
				<table cellpadding="0" cellspacing="0" class="fetch" width="100%">
				<?php
				$i=0;
				$threedays = getCustomDate(90);
				$getData = mysql_query("SELECT DISTINCT(contact.id),contact.fname,contact.lname,contact.mobile FROM contact,noteline WHERE contact.createdate <= '$threedays' AND noteline.cid = contact.id AND contact.converted = '1' AND noteline.id NOT IN (SELECT `id` FROM `noteline` WHERE `subject` = 'call' AND `createdate` >= '$threedays') AND contact.id NOT IN (SELECT `cid` FROM `noteline` WHERE `subject` = 'call' AND `createdate` >= '$threedays')",$con) or die(mysql_error());
				while($row = mysql_fetch_array($getData))
				{
				?>
				<tr class="d<?php echo $i%2;?>">
					<td>
					<div style="padding:5px;;float:right">
						<img src="images/viewdetails.png" style="height:15px;cursor:pointer" title="View Details" alt=""   onclick="getModule('crd/clientDetails?id=<?php echo $row[0];?>&amp;i=<?php echo $i;?>&amp;name=<?php echo $row['fname'];?>','manipulatemoodleContent','viewmoodleContent','1')"/>
						<img src="images/story.png" style="height:15px;cursor:pointer" title="Story"  alt=""  onclick="getModule('noteline/index?cid=<?php echo $row[0];?>&name=<?php echo $row[1];?>&amp;i=<?php echo $i;?>','manipulatemoodleContent','viewmoodleContent','1')"/>
					</div>

						<?php echo $row[1]." ".$row[2]?><br/><em style="font-size:12px;"><?php echo $row[3]?></em>
					</td>
				</tr>
				<?php 
				$i++;
				}
				?>
				</table>
				<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
			</div>
		</td>
	</tr>
</table>
