<?php
include("../include/conFig.php");
$cid = $_GET['cid'];
$name = $_GET['name'];
if(isset($_GET['subject']))
{
$subject = $_GET['subject'];
$subStr = "noteline.subject = '$subject'";
}
else
{
$subStr = "(1=1)";
}
$getData = mysql_query("SELECT noteline.subject,noteline.note,employee.name,noteline.createdate FROM noteline,employee WHERE noteline.cid = '$cid' AND noteline.updatedby = employee.id AND noteline.delete = '0' AND ".$subStr." ORDER BY noteline.id DESC",$con) or die(mysql_error());
$p=0;
$maxl=0;
$maxr=0;
while($row = mysql_fetch_array($getData))
{
$RArray[] .= $row[2]."brkline".$row[0]."brkline".$row[3]."brkline".$row[1];
$maxr++;
}
$maxr = $maxr;
?>

<script type="text/javascript">
</script>
</script>

<div class="moduleHeading">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="left" style="width: 30%">NoteLine For <?php echo $_GET['name'];?> &nbsp;
<input id="totalRight" name="Text1" style="display: none" type="text" value="0" />
<input id="totalLeft" name="Text1" style="display: none" type="text" value="<?php echo $maxr;?>" />
</td>
		</tr>
	</table>
</div>

<div style="height:650px;overflow:auto">
<div style="background:#E7EBF2 url('images/noteline-back.png') repeat-y scroll 25px;; padding: 10px;text-align:left">
	


	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			
			<td align="center" style="width: 4%" valign="top"><center>
			<div id="imgHere" style="position: relative">
				<img alt="" src="images/theDot.png" style="position: absolute; top: 40px; left: 35%" />
			</div>
			</center></td>
			<td align="left" style="width: 96%" valign="top">
			
                <div class="right" id="noteL0">
				<div style="float:left;margin-top:20px;margin-left:-8px;">
				
				<img src="images/ntarl.png" alt=""/>			</div>
				<div style="padding:10px;">
				<strong><span style="color:#3B5998">Add New Note</span></strong>
				<br/>
	
			<div style="padding:5px;background:#eee;">
			<!--<select name="req" class="input" style="width:20%" id="ntl0">
				<option value="Call">Call</option>
				<option value="Meeting">Meeting</option>
				<option value="Visit">Visit</option>
			</select> &nbsp;&nbsp; -->
			 <?php
			 $clock=date("H:i");
			 $time = time() + (60 * 60 * 24);
			 $tomorrow = date("Y-m-d",$time);
			 
			 $time = time() + (60 * 60 * 24 * 7);
			 $week1 = date("Y-m-d",$time);
			 
			 $time = time() + (60 * 60 * 24 * 15);
			 $week2 = date("Y-m-d",$time);
			 
			 $time = time() + (60 * 60 * 24 * 31);
			 $month = date("Y-m-d",$time);
			 
			 ?>
		     CallbackDate : <input class="input" style="width:200px" type="date" id="ntl2" name="req1" value="0">
			 &nbsp;&nbsp;
			 Callbacktime :
		<!--	 <input id="ntl3" name="req2" Onclick="TimePicker()" class="input" style="width:200px;cursor:pointer;" type="text" placeholder="HH:MM:PM">  --> 
		 <input id="ntl3" name="req2" type="time" class="input" style="width:200px;cursor:pointer;" type="text" placeholder="HH:MM:PM"> 
		
	<!-- Onclick="TimePicker()"  -->	  
<br/>

<div style="float:left;margin-bottom:5px">
&nbsp;&nbsp;&nbsp;
<input class="buttonBlue" name="Button1"  onclick="increaseTime('<?php echo $tomorrow ?>','<?php echo $clock ?>')" type="button" value="Tomorrow" style="width:100px;" />
&nbsp;
<input class="buttonBlue" name="Button1" onclick="increaseTime('<?php echo $week1 ?>','<?php echo $clock ?>')"  type="button" value="1 Week later" style="width:100px;" />
&nbsp;
<input class="buttonBlue" name="Button1" onclick="increaseTime('<?php echo $week2 ?>','<?php echo $clock ?>')" type="button" value="2 Week later" style="width:100px;" />
&nbsp;
<input class="buttonBlue" name="Button1" onclick="increaseTime('<?php echo $month?>','<?php echo $clock ?>')" type="button" value="Next Month" style="width:100px;" />
&nbsp;

<select id="ntl4" name="req3">


</select>
</div>



<br/>
<br/>
<br/>

<div id="UpdateResult"></div>

<textarea name="req" onchange="SaveData('noteline/save?cid=<?php echo $cid;?>&name=<?php echo $_GET['name'];?>','ntl','5','','','','4');document.getElementById('ModalCloseButton').style.display = 'block';" cols="20" rows="2" style="width:98%;height:100px;" class="input" placeholder="kindly update the callbackdate,callbacktime and descrition to close the window." id="ntl1"></textarea>
<!-- <div style="float:left">updateLiveDesc();CallbackdateVerify();updateLiveDesc();
<input class="buttonBlue" name="Button1"  type="button" value="Add Note" style="width:100px;" />
</div> -->
<!--
<div style="float:right">
Show:&nbsp;&nbsp; 

<select name="Select1" class="input" id="subjectRequest">
				<option value="Call" <?php if($_GET['subject'] == 'Call') echo "selected='selected'";?>>Call</option>
				<option value="Bapproved" <?php if($_GET['subject'] == 'Bapproved') echo "selected='selected'";?>>Bill Approval</option>
				<option value="Crequest" <?php if($_GET['subject'] == 'Crequest') echo "selected='selected'";?>>Client Request</option>
				<option value="Fapproved" <?php if($_GET['subject'] == 'Fapproved') echo "selected='selected'";?>>Free Trial Approval</option>
				<option value="Frequest" <?php if($_GET['subject'] == 'Frequest') echo "selected='selected'";?>>Free Trial Requests</option>
				<option value="Meeting" <?php if($_GET['subject'] == 'Meeting') echo "selected='selected'";?>>Meetings</option>
				<option value="Oship" <?php if($_GET['subject'] == 'Oship') echo "selected='selected'";?>>Ownership Changes</option>
				<option value="Updation" <?php if($_GET['subject'] == 'Updation') echo "selected='selected'";?>>Updations</option>
				<option value="Visit" <?php if($_GET['subject'] == 'Visit') echo "selected='selected'";?>>Visits</option>
		
				
			</select>
<input name="Button1" type="button" value="Go" class="buttonBlue" onclick="getModule('noteline/index?cid=<?php echo $cid;?>&name=<?php echo $name;?>&subject='+document.getElementById('subjectRequest').value,'manipulatemoodleContent','viewmoodleContent','Noteline For <?php echo $name;?>')" />

</div>-->
<br/><br/><br/>
</div>
				
				</div></div>
			<?php
				$t=1;
			foreach($RArray as $val)
			{
				$temp = explode("brkline",$val);
				?>
			<div id="noteL<?php echo $t;?>" class="right">
				<div style="float: left; margin-top: 20px; margin-left: -8px;">
					<img alt="" src="images/ntarl.png" /> </div>
				<div style="padding: 10px;">
					<?php
				if($temp[1]=='Call')
				{
				?><img alt="" src="images/call.png" style="width: 15px; vertical-align: middle" />&nbsp;&nbsp;
				<strong><span style="color: #3B5998"><?php echo $temp[0];?>
					</span></strong>made a <strong><?php echo $temp[1];?>.
					</strong>
					<?php
				}
				else if($temp[1]=='Meeting')
				{
				?><img alt="" src="images/visit.png" style="width: 15px;; vertical-align: middle" />&nbsp;&nbsp;
				<strong><span style="color: #3B5998"><?php echo $temp[0];?>
					</span></strong>had a <strong><?php echo $temp[1];?>.
					</strong>
					<?php
				}
				else if($temp[1]=='Updation')
				{
				?><img alt="" src="images/task-icon-hover.png" style="width: 15px;; vertical-align: middle" />&nbsp;&nbsp;
				<strong><span style="color: #3B5998"><?php echo $temp[0];?>
					</span></strong>made some <strong>Updations.
					</strong>
					<?php
				}
				else if($temp[1]=='Crequest')
				{
				?><img alt="" src="images/converted-to-client.png" style="width: 15px;; vertical-align: middle" />&nbsp;&nbsp;
				<strong><span style="color: #3B5998;">Client conversion Requested
					</span></strong>				
					<?php
				}
				else if($temp[1]=='Canclerequest')
				{
				?><img alt="" src="images/converted-to-client.png" style="width: 15px;; vertical-align: middle" />&nbsp;&nbsp;
				<strong><span style="color: #3B5998;">Client conversion requested rejected
					</span></strong>				
					<?php
				}
				else if($temp[1]=='Frequest')
				{
				?><img alt="" src="images/freetrial-request.png" style="width: 20px;; vertical-align: middle" />&nbsp;&nbsp;
				<strong><span style="color: #3B5998;">Freetrial Requested.
					</span></strong>				
					<?php
				}
				else if($temp[1]=='Fapproved')
				{
				?><img alt="" src="images/freetrial-approved.png" style="width: 20px;; vertical-align: middle" />&nbsp;&nbsp;
				<strong><span style="color: #3B5998;">Freetrial Approved.
					</span></strong>				
					<?php
				}
				else if($temp[1]=='Fdenied')
				{
				?><img alt="" src="images/freetrial-denied.png" style="width: 20px;; vertical-align: middle" />&nbsp;&nbsp;
				<strong><span style="color: #3B5998;">Freetrial Denied.
					</span></strong>				
					<?php
				}
				else if($temp[1]=='Capproved')
				{
				?><img alt="" src="images/converted-to-client.png" style="width: 20px;; vertical-align: middle" />&nbsp;&nbsp;
				<strong><span style="color: #3B5998;">Client conversion Approved.
					</span></strong>				
					<?php
				}
				else if($temp[1]=='Brequest')
				{
				?><img alt="" src="images/billing-icon.png" style="width: 15px;; vertical-align: middle" />&nbsp;&nbsp;
				<strong><span style="color: #3B5998;">New Service Requested.
					</span></strong>				
					<?php
				}
				else if($temp[1]=='Bapproved')
				{
				?><img alt="" src="images/billing-icon-hover.png" style="width: 15px;; vertical-align: middle" />&nbsp;&nbsp;
				<strong><span style="color: #3B5998;">Services Approved.
					</span></strong>				
					<?php
				}
				else if($temp[1]=='Oship')
				{
				?><img alt="" src="images/oship.png" style="width: 15px;; vertical-align: middle" />&nbsp;&nbsp;
				<strong><span style="color: #3B5998;">Ownership Changed.
					</span></strong>				
					<?php
				}
				else if($temp[1]=='Request')
				{
				?><img alt="" src="images/freetrial-request.png" style="width: 20px;; vertical-align: middle" />&nbsp;&nbsp;
				<strong><span style="color: #3B5998;">Again Freetrial is Requested From Website.
					</span></strong>				
					<?php
				}
				else if($temp[1]=='Website')
				{
				?><img alt="" src="images/freetrial-request.png" style="width: 20px;; vertical-align: middle" />&nbsp;&nbsp;
				<strong><span style="color: #3B5998;">Number updated from website.
					</span></strong>				
					<?php
				}
				
			
				
				
				else if($temp[1]=='Salloted')
				{
				?><img alt="" src="images/support.png" style="width: 20px; vertical-align: middle" />&nbsp;&nbsp;
				<strong><span style="color: #3B5998;">Client Has Been Alloted For Support
				</span></strong>				
				<?php
				}
				
				
				else if($temp[1]=='PremiumRequest')
				{
				?><img alt="" src="images/support.png" style="width: 20px; vertical-align: middle" />&nbsp;&nbsp;
				<strong><span style="color: #3B5998;">Changes In The Brokerage Plan
				</span></strong>				
				<?php
				}
				
				else if($temp[1]=='CancleBooster')
				{
				?><img alt="" src="images/converted-to-client.png" style="width: 15px;; vertical-align: middle" />&nbsp;&nbsp;
				<strong><span style="color: #3B5998;">Booster activation request rejected
				</span></strong>				
				<?php
				}
				
				
				else if($temp[1]=='cancelPremium')
				{
				?><img alt="" src="images/converted-to-client.png" style="width: 15px;; vertical-align: middle" />&nbsp;&nbsp;
				<strong><span style="color: #3B5998;">Premium activation request rejected
				</span></strong>				
				<?php
				}
				

				?>
				<div style="float: right; font-size: 11px;; color: #888; font-style: italic">
						<?php echo $temp[2];?>
						<?php
						 if($temp[1]=='Capproved')
						 {
						 echo '&nbsp;&nbsp;<img src="images/hot-lead.png" style="height:20px;" alt=""/>';
						 }
						?>
						
						</div>
					<br />
					<div style="border-top: 1px #eee solid; padding-top: 10px; margin-top: 5px;">
						<?php echo $temp[3];?></div>
				</div>
			</div>
			<?php
				$t++;
			}
			?></td>
		</tr>
	</table>
	<br/><br/><br/><br/>
	</div>
</div>
