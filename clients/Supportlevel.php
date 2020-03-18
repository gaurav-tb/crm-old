<?php 
include("../include/conFig.php");
$cid=$_GET['clid'];

$getName = mysql_query("SELECT `customersupport`.`ownerid`,`customersupport`.`ClosingDate`,`supportdetails`.*,`customersupport`.`ClosingDate`,`customersupport`.`level`,`levelsupport`.`name`,`customersupport`.`mobile` FROM `customersupport` INNER JOIN `supportdetails` on `customersupport`.`clientid`=`supportdetails`.`clientid`
INNER JOIN `levelsupport` on `customersupport`.`level`=`levelsupport`.`id`
 WHERE `customersupport`.`clientid`='$cid'",$con) or die(mysql_error());
$row = mysql_fetch_array($getName);
?>


<script>

	var countDownDate = new Date("Sep 5, 2018 15:37:25").getTime();
            
    var x = setInterval(function() 
	{

    var now = new Date().getTime();
    var distance = countDownDate - now;
    
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
             + minutes + "m " + seconds + "s ";
    
    if (distance < 0)
	{
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
    }
    }, 1000);
</script>

<div class="moduleHeading">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="left" style="width:100%"><?php echo $row['name'] ?> &nbsp;&nbsp;&nbsp;&nbsp; <a class="blueSimpletext clickto" href="callto:<?php echo $row['mobile']; ?>">Click to call</a>      </td>
</td>
</tr>
</table>
</div>

    <?php  if($row['level']==1) { ?>
    <div class="moduleHeading"> 
	<table  width="100%" cellpadding="0" cellspacing="0">
	<tr>
	<td colspan="3" style="width:50%;border:0px;text-align:center;"> <?php if($row['level']==1){ ?> Closure Time : <span style="color:red;text-align:center;" id="demo"> <?php echo $row['ClosingDate'];} ?></span></td>
	</tr>
	</table>
	</div>
	<div class="form">
	<table width="100%" cellpadding="0" cellspacing="10">
	<tr style="height:30px;">
    <td align="left">Mail YouTube All Demo Video </td>
	<td style="">
    <input name="Checkbox1" value="1" type="checkbox" id="optt4" <?php if($row['DemoVideo'] == 1) { echo "checked disabled"; }?>/>
    </td>
	</tr>	
	
	<tr style="height:30px;">
    <td align="left" style=" width:360px;">Overview Buy or sell software demo in NET NET or Mob. App.</td>
	<td align="left"><input name="Checkbox1" id="optt5"  type="checkbox" value="1" <?php if($row['SoftwareDemo'] == 1) { echo "checked disabled"; }?> />
    </td>
    </tr>

    <tr style="height:30px;">
    <td style="width:350px;" align="left">Fund Transfer Atom or Yes Bank Method.</td>
	<td align="left"><input name="Checkbox1" id="optt6"  type="checkbox"  value="1" <?php if($row['FundTransfer'] == 1) { echo "checked disabled"; }?> />
	</td>
	</tr>
	
	<tr style="height:30px;">
    <td align="left" style=" width: 208px;">Back office Login demo</td>
	<td align="left"><input name="Checkbox1" id="optt7" type="checkbox"  value="1" <?php if($row['BackOffice'] == 1) { echo "checked disabled"; }?> />
	</td>
    </tr>

    <tr  style="height:30px;">
	<td align="left" style=" ;">Client filter</td>
	<td align="left"><input name="Checkbox1" id="optt8" type="checkbox"  value="1" <?php if($row['ClientFilter'] == 1) { echo "checked disabled"; }?> />
	</td>
	</tr>
    
	<tr  style="height:30px;">
 	<td align="left">Telegram free research recommendations </td>
    <td align="left"><input name="Checkbox1" id="optt9" type="checkbox"  value="1" <?php if($row['TelegramTips'] == 1) { echo "checked disabled"; }?> />
	</td>
    </tr>

	<tr  style="height:30px;">
	<td align="left" style=";">POA Status and process</td>
	<td align="left"><input name="Checkbox1" id="optt10" type="checkbox"  value="1" <?php if($row['POAStatus1'] == 1) { echo "checked disabled"; }?> />
	</td>
	</tr>
    
	<tr  style="height:30px;">
	<td align="left">Segment details</td>
    <td align="left"><input name="Checkbox1"  id="optt11" type="checkbox"  value="1" <?php if($row['SegmentDetails'] == 1) { echo "checked disabled"; }?> />
	</td>
    </tr>
	<tr style="height:20px;">
	<td align="left">Latest Response</td>
	<td>
	<!-- <div style='margin-bottom:8px;width:255px'> -->
    <?php
    $getcurrentorder = mysql_query("SELECT `order` FROM `leadresponse` WHERE `id` = '".$row['latestresponse']."' limit 1",$con) or die(mysql_error());
    $rowcurrentorder = mysql_fetch_array($getcurrentorder);
    $valuecurrentorder = (!empty($rowcurrentorder[0])) ? $rowcurrentorder[0] : '0'; ;
    ?>
	

<select class="input" id="optt0"  title="isNotNull" >
<option value="">Please Select Lead Response</option>
<!-- onchange="if(this.value != 33 && this.value != '') ( getModule('noteline/index?cid=<?php //echo $row['id'];?>&name=<?php //echo $row['fname'];?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php // echo $row['fname'];?>') )" -->		
<?php
//
$getLatestResponse = mysql_query("SELECT `name`,`id` FROM `leadresponse` WHERE `delete` = '0' AND `display`='3' ORDER BY `order` ASC",$con) or die(mysql_error()); 
while($rowLatestResponse = mysql_fetch_array($getLatestResponse))
{ 
?>
<option <?php if($rowLatestResponse[1] == $row['latestresponse']) echo "selected='selected'"; ?> value="<?php echo $rowLatestResponse[1];?>"><?php echo $rowLatestResponse[0];?></option>
<?php
}  
?>
</select>
<!-- </div> -->

<div align="left"><span><?php echo 'NPC Count '.'<font color="red">'. $row['NpcCount'].'</font>' ?></span></div> 
</td>
</tr>

<tr>
<td>CallbackDate : <input class="input" style="width:200px" type="date" id="optt1"  value="0">	</td>	 &nbsp;&nbsp;
<td>Callbacktime : <input class="input" style="width:200px" type="time" id="optt2"  placeholder="HH:MM:PM"></td>
</tr>

	<tr style="height:30px;">
    <td colspan="2" align="left">
    Comments
	</td>
    </tr>
    <tr style="height:30px;">
    <td colspan="2" align="left">
    <textarea cols="20" rows="2" id="optt3" style="width:98%;height:100px;" class="input"></textarea>
	</td>
    </tr>
	
	<tr style="height:30px;">
	<td>
	<input name="Button2" type="button" value="Update" onclick="UpdateSupport('<?php echo $cid ;?>','11');" class="buttonGreen" />&nbsp;&nbsp;	
 	</td>
    </tr>
	</table>
    </div>
	<?php } ?>
	
    <?php  if($row['level']==2) { ?>
    <div class="moduleHeading">
	<table  width="100%" cellpadding="0" cellspacing="0">
	<tr>
	<td colspan="3" style="width:50%;border:0px;text-align:center;"> <?php if($row['level']==2){ ?> Closure Time : <span style="color:red;text-align:center;" id="demo"> <?php } ?></span></td>
	</tr>
	</table>
	</div>
 	<div class="form"> 
	<table width="100%" cellpadding="0" cellspacing="10">
	<tr style="height:40px;">
    <td align="left">1st Trade</td><td style="">
	<input name="Checkbox1" type="checkbox" id="optt4" <?php if($row['level']!=2){ ?> disabled <?php } ?>   value="1" <?php if($row['FirstTrade'] == 1) { echo "checked disabled"; }?> />
	</tr>
	<tr style="height:40px;">
    <td align="left" style=" width:360px;">SL demo </td>
	<td align="left"><input name="Checkbox1" id="optt5" <?php if($row['level']!=2){ ?> disabled <?php } ?> type="checkbox"   value="1" <?php if($row['SLDemo'] == 1) { echo "checked disabled"; }?> />
	</td>
    </tr>

    <tr style="height:40px;">
    <td style=" width:350px;" align="left">Margin-plus demo</td>
	<td align="left"><input name="Checkbox1" id="optt6" <?php if($row['level']!=2){ ?> disabled <?php } ?> type="checkbox"  value="1" <?php if($row['MarginPlusDemo'] == 1) { echo "checked disabled"; }?> />
	</td>
	</tr>
	<tr style="height:40px;">
	<td align="left" style=" width: 208px;">Power Of Attorney</td>
	<td align="left"><input name="Checkbox1" id="optt7" <?php if($row['level']!=2){ ?> disabled <?php } ?> type="checkbox"  value="1" <?php if($row['POA'] == 1) { echo "checked disabled"; }?> />
	</td>
    </tr>

    <tr style="height:40px;">
	<td align="left" style=" ;">Modification process or F&O & commodity a/c opening</td>
	<td align="left"><input name="Checkbox1" id="optt8" <?php if($row['level']!=2){ ?> disabled <?php } ?> type="checkbox"  value="1" <?php if($row['FAO'] == 1) { echo "checked disabled"; }?> />
	</td>
    </tr>
	
	<tr style="height:40px;">
	<td align="left"> IPO or MF online Apply process </td>
    <td align="left"><input name="Checkbox1" id="optt9" <?php if($row['level']!=2){ ?> disabled <?php } ?>  type="checkbox" value="1" <?php if($row['IPO'] == 1) { echo "checked disabled"; }?> />
	</td>
	</tr>
	
	<tr style="height:20px;">
	<td align="left">Latest Response</td>
	<td>
	<!-- <div style='margin-bottom:8px;width:255px'> -->
    

<select class="input" id="optt0"  title="isNotNull" >
<option value="">Please Select Lead Response</option>
<!-- onchange="if(this.value != 33 && this.value != '') ( getModule('noteline/index?cid=<?php //echo $row['id'];?>&name=<?php //echo $row['fname'];?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php // echo $row['fname'];?>') )" -->		
<?php
//
$getLatestResponse = mysql_query("SELECT `name`,`id` FROM `leadresponse` WHERE `delete` = '0' AND `display`='3' ORDER BY `order` ASC",$con) or die(mysql_error()); 
while($rowLatestResponse = mysql_fetch_array($getLatestResponse))
{ 
?>
<option <?php if($rowLatestResponse[1] == $row['latestresponse']) echo "selected='selected'"; ?> value="<?php echo $rowLatestResponse[1];?>"><?php echo $rowLatestResponse[0];?></option>
<?php
}  
?>
</select>
<!-- </div> -->

<div align="left"><span><?php echo 'NPC Count '.'<font color="red">'. $row['NpcCount'].'</font>' ?></span></div> 
</td>
</tr>

<tr>
<td>CallbackDate : <input class="input" style="width:200px" type="date" id="optt1"  value="0">	</td>	 &nbsp;&nbsp;
<td>Callbacktime : <input class="input" style="width:200px" type="time" id="optt2"  placeholder="HH:MM:PM"></td>
</tr>

	<tr style="height:30px;">
    <td colspan="2" align="left">
    Comments
	</td>
    </tr>
    <tr style="height:30px;">
    <td colspan="2" align="left">
    <textarea cols="20" rows="2" id="optt3" style="width:98%;height:100px;" class="input"></textarea>
	</td>
    </tr>
	
	<tr style="height:30px;">
	<td>
	<input name="Button2" type="button" value="Update" onclick="UpdateSupport('<?php echo $cid ;?>','10');" class="buttonGreen" />&nbsp;&nbsp;	
 	</td>
    </tr>
	</table>
    </div>   
	<?php } ?>
  
    <?php  if($row['level']==3) { ?>
    <div class="moduleHeading">
	<table  width="100%" cellpadding="0" cellspacing="0">
	<tr>
	<td colspan="3" style="width:50%;border:0px;text-align:center;"> <?php if($row['level']==3){ ?> Closure Time : <span style="color:red;text-align:center;" id="demo"> <?php } ?></span></td>
	</tr>
	</table>
	</div>
	<div class="form">
	<table width="100%" cellpadding="0" cellspacing="10">
	<tr style="height:40px;">
    <td align="left">Follow us on Facebook, twitter, Instagram</td><td style="">
	<input name="Checkbox1" id="optt4" type="checkbox" value="1" <?php if($row['SocialMedia'] == 1) { echo "checked disabled"; }?> />
	</tr>
	<tr style="height:40px;">
	<td align="left" style=" width:360px;">Referral policy </td>
	<td align="left"><input name="Checkbox1" id="optt5" type="checkbox"  value="1" <?php if($row['ReferralPolicy'] == 1) { echo "checked disabled"; }?> />
	</td>
    </tr>

    <tr style="height:40px;">
    <td style=" width:350px;" align="left">Benefit - Margin funding, IPO funding, NCL.</td>
	<td align="left"><input name="Checkbox1" id="optt6"  type="checkbox"  value="1" <?php if($row['NCL'] == 1) { echo "checked disabled"; }?> />
	</td>
	</tr>
	<tr style="height:40px;">
	<td align="left" style=" width: 208px;">Client doubt or issue</td>
	<td align="left"><input name="Checkbox1" id="optt7"  type="checkbox"  value="1" <?php if($row['ClientDoubt'] == 1) { echo "checked disabled"; }?> />
	</td>
    </tr>

    <tr  style="height:40px;">
	<td align="left" style="">POA Status and process</td>
	<td align="left"><input name="Checkbox1" id="optt8"  type="checkbox"  value="1" <?php if($row['POAStatus2'] == 1) { echo "checked disabled"; }?> />
	</td>
    </tr>
	
	<tr style="height:20px;">
	<td align="left">Latest Response</td>
	<td>
	<!-- <div style='margin-bottom:8px;width:255px'> -->
   
	

<select class="input" id="optt0"  title="isNotNull" >
<option value="">Please Select Lead Response</option>
<!-- onchange="if(this.value != 33 && this.value != '') ( getModule('noteline/index?cid=<?php //echo $row['id'];?>&name=<?php //echo $row['fname'];?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php // echo $row['fname'];?>') )" -->		
<?php
//
$getLatestResponse = mysql_query("SELECT `name`,`id` FROM `leadresponse` WHERE `delete` = '0' AND `display`='3' ORDER BY `order` ASC",$con) or die(mysql_error()); 
while($rowLatestResponse = mysql_fetch_array($getLatestResponse))
{ 
?>
<option <?php if($rowLatestResponse[1] == $row['latestresponse']) echo "selected='selected'"; ?> value="<?php echo $rowLatestResponse[1];?>"><?php echo $rowLatestResponse[0];?></option>
<?php
}  
?>
</select>
<!-- </div> -->

<div align="left"><span><?php echo 'NPC Count '.'<font color="red">'. $row['NpcCount'].'</font>' ?></span></div> 
</td>
</tr>

<tr>
<td>CallbackDate : <input class="input" style="width:200px" type="date" id="optt1"  value="0">	</td>	 &nbsp;&nbsp;
<td>Callbacktime : <input class="input" style="width:200px" type="time" id="optt2"  placeholder="HH:MM:PM"></td>
</tr>

	<tr style="height:30px;">
    <td colspan="2" align="left">
    Comments
	</td>
    </tr>
    <tr style="height:30px;">
    <td colspan="2" align="left">
    <textarea cols="20" rows="2" id="optt3" style="width:98%;height:100px;" class="input"></textarea>
	</td>
    </tr>
	
	<tr style="height:30px;">
	<td>
	<input name="Button2" type="button" value="Update" onclick="UpdateSupport('<?php echo $cid ;?>','9');" class="buttonGreen" />&nbsp;&nbsp;	
 	</td>
    </tr>
	</table>
    </div>
	<?php } ?>

    <?php  if($row['level']==4) { ?>
    <div class="moduleHeading">
	<table  width="100%" cellpadding="0" cellspacing="0">
	<tr>
	<td colspan="3" style="width:50%;border:0px;text-align:center;"> <?php if($row['level']==4){ ?> Closure Time : <span style="color:red;text-align:center;" id="demo"> <?php } ?></span></td>
	</tr>
	</table>
	</div>
	<div class="form">
	<table width="100%" cellpadding="0" cellspacing="10">
	<tr style="height:40px;">
    <td align="left">How is trading?</td><td style="">
	<input name="Checkbox1" type="checkbox" id="optt4" <?php if($row['level']!=4){?> disabled <?php } ?>    value="1" <?php if($row['HowTrading'] == 1) { echo "checked disabled"; }?> />
	</tr>
	
	<tr style="height:40px;">
    <td align="left" disabled  style=" width:360px;">Any doubts or problems </td>
	<td align="left"><input name="Checkbox1" id="optt5" <?php if($row['level']!=4){?> disabled <?php } ?> type="checkbox"  value="1" <?php if($row['AnyProblem'] == 1) { echo "checked disabled"; }?> />
	</tr>
	</td>
   
    <tr style="height:40px;">
    <td style="width:350px;" align="left">Mutuals Funds and IPO</td>
	<td align="left"><input name="Checkbox1" id="optt6" <?php if($row['level']!=4){?> disabled <?php } ?> type="checkbox"  value="1" <?php if($row['MF'] == 1) { echo "checked disabled"; }?> />
	</td>
	</tr>
	
	<tr style="height:40px;">
    <td align="left" disabled  style="width: 208px;">Research recommendations</td>
	<td align="left"><input name="Checkbox1" id="optt7" <?php if($row['level']!=4){?> disabled <?php } ?> type="checkbox"  value="1" <?php if($row['ResearchRecommandation'] == 1) { echo "checked disabled"; }?> />
	</td>
    </tr>
	
	<tr style="height:20px;">
	<td align="left">Latest Response</td>
	<td>
	<!-- <div style='margin-bottom:8px;width:255px'> -->
  
	

<select class="input" id="optt0"  title="isNotNull" >
<option value="">Please Select Lead Response</option>
<!-- onchange="if(this.value != 33 && this.value != '') ( getModule('noteline/index?cid=<?php //echo $row['id'];?>&name=<?php //echo $row['fname'];?>','manipulatemoodleContent','viewmoodleContent','Noteline For <?php // echo $row['fname'];?>') )" -->		
<?php
//
$getLatestResponse = mysql_query("SELECT `name`,`id` FROM `leadresponse` WHERE `delete` = '0' AND `display`='3' ORDER BY `order` ASC",$con) or die(mysql_error()); 
while($rowLatestResponse = mysql_fetch_array($getLatestResponse))
{ 
?>
<option <?php if($rowLatestResponse[1] == $row['latestresponse']) echo "selected='selected'"; ?> value="<?php echo $rowLatestResponse[1];?>"><?php echo $rowLatestResponse[0];?></option>
<?php
}  
?>
</select>
<!-- </div> -->

<div align="left"><span><?php echo 'NPC Count '.'<font color="red">'. $row['NpcCount'].'</font>' ?></span></div> 
</td>
</tr>

<tr>
<td>CallbackDate : <input class="input" style="width:200px" type="date" id="optt1"  value="0">	</td>	 &nbsp;&nbsp;
<td>Callbacktime : <input class="input" style="width:200px" type="time" id="optt2"  placeholder="HH:MM:PM"></td>
</tr>

	<tr style="height:30px;">
    <td colspan="2" align="left">
    Comments
	</td>
    </tr>
    <tr style="height:30px;">
    <td colspan="2" align="left">
    <textarea cols="20" rows="2" id="optt3" style="width:98%;height:100px;" class="input"></textarea>
	</td>
    </tr>
	
	<tr style="height:30px;">
	<td>
	<input name="Button2" type="button" value="Update" onclick="UpdateSupport('<?php echo $cid ;?>','8');" class="buttonGreen" />&nbsp;&nbsp;	
 	</td>
    </tr>
	</table>
	<?php } ?>
	</div>
	</div>
    </div>
