<?php 
include("../include/conFig.php");
$cid=$_GET['clid'];

$getData = mysql_query("SELECT * FROM `contact` WHERE `id` = '$cid'",$con) or die(mysql_error());
$row = mysql_fetch_assoc($getData);

$chkAlready = mysql_query("SELECT `id` FROM `servicecall` WHERE `cid` = '$cid' AND `type` = 'RB' AND `approved`='0'",$con) or die(mysql_error());
$fname = '';
$email = '';
if(mysql_num_rows($chkAlready) > 0) 
{
	$fname = $row['fname'];
	$lname = $row['lname'];
	$mobile = $row['mobile'];
	
}

$getBooster= mysql_query("SELECT * FROM  `researchbooster` WHERE  `cid` =  '$cid'
AND (`Approved` =  '2' ||  `ActivationRequest` =  '1')
AND id = ( SELECT MAX( id ) FROM  `researchbooster` WHERE cid =  '$cid' ) 
AND  '$date' BETWEEN  `StartDate` AND  `EndDate`",$con) or die(mysql_error());

$rowBooster=mysql_fetch_array($getBooster);



?>



<div class="moduleHeading">
 <table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="left" style="width: 100%">Please fill below Details For Research Booster Activation<span style="text-transform:capitalize"><?php echo $_GET['name'];?></span></td>
</td>
</tr>
</table> 
</div>
<div>
        <div class=form> 
	    <table width="100%" cellpadding="0" cellspacing="10">
		<tr>
		<td align="right" style="">
		Registered client name *  
		</td>
		<td >
		<?php 
			
		echo $row['fname']  ." ".$row['lname'] ; 
		?>
		</td>
		</tr>	
		
		<?php 
		$getFreeTrial=mysql_query("SELECT * FROM `researchbooster` WHERE `cid`='$cid' AND `service`='2' AND `Approved`='2'",$con) or die(mysql_error());
     	$getCount=mysql_num_rows($getFreeTrial);
		?>
		
		<tr>
		<td align="right" style="">
		Free Trial (<b>FT</b>) &nbsp; Paid Services (<b>PS</b>) 
		</td>
		<td>
		<input type="button" value="FT" id="optt12" onclick="onoff();" style="cursor:pointer;width:110px;background:#e7e7e7;padding:3px 10px;">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php echo "<span style='color:red'>Free Trial Taken " . $getCount ." out of 2.</span> " ;  ?>
		</td>
		</tr>	

        <tr>
		<td align="right" style="">
		Research  
		</td>
		<td><input type="radio" id="optt0" name="research"  <?php if($rowBooster['ResearchPlus']==1) { echo 'checked disabled';	}  ?>  Onclick="CheckResearchBooster()"  value="1" />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Research + &nbsp;
		<input type="radio" id="optt1" name="research"  <?php if($rowBooster['ResearchPlus']==2) { echo 'checked disabled';	}  ?>  Onclick="CheckResearchBooster()" value="2" />
		&nbsp;&nbsp;&nbsp;&nbsp;<span id="ResearchPlus" style="font-size:9px;"></span>
		</td>
		</tr>	
			  			
		    

        <tr>
		<?php   
		$lst = explode(",",$rowBooster['Segments']);
        ?>
			
		<td align="right" style="">
		Segment * 
		</td>
		<td>Commodity <input type="checkbox"  id="optt2"  <?php  if(in_array('1',$lst)) { echo 'checked disabled';	}  ?> onclick="CalculateBoosterSum(this.value);CalculateGST()" value="1" />&nbsp;&nbsp;&nbsp; Future <input type="checkbox"  id="optt3"  <?php  if(in_array('2',$lst)) { echo 'checked disabled';	}  ?> onclick="CalculateBoosterSum(this.value);CalculateGST()" value="2" />&nbsp;&nbsp;&nbsp; Option <input type="checkbox"  id="optt4"  <?php  if(in_array('3',$lst)) { echo 'checked disabled';	}  ?> onclick="CalculateBoosterSum(this.value);CalculateGST()" value="3" /> &nbsp;&nbsp;&nbsp;  Equity <input type="checkbox" id="optt5"    <?php  if(in_array('4',$lst)) { echo 'checked disabled';	}  ?> onclick="CalculateBoosterSum(this.value);CalculateGST()" value="4" /> 
		&nbsp;&nbsp;&nbsp;&nbsp;<span id="fnamevv" style="font-size:9px;"></span></td>
		</tr>
			
			
		
		<tr>
		<td align="right" style="">
		Total Amount
		</td>
		<td><input id='optt6' class="input" readonly  value="<?php echo $rowBooster['Activationamt'] ?>" OnKeyup="CalculateGST()"  type="text" /> 
		&nbsp;&nbsp;  <span id="GstAmount" style="font-size:12px;color:red;"><?php echo "Amount with GST ".round($rowBooster['AmountWithGst'])."/-" ?></span>
    	</td></tr>
		
		<tr>
		<td align="right" style="">
		Mobile No To Be Added On Telegram *
		</td>
		<td ><input id='optt7'  class="input"  name='req' value="<?php echo $row['mobile'] ?>"  type="text" />
		&nbsp;&nbsp;<span id="telegrammobile" style="font-size:9px;"></span>
		</td></tr> 
		
		<tr>
		<td align="right" style="">
		Is Telegram Application Installed 
		</td>
		<td><input id='optt8' value="1" <?php if($rowBooster['Telegraminstalled']==1)   { echo  "checked disabled" ;  } ?> type="checkbox" />
		&nbsp;<span id="telegraminstall" style="font-size:9px;">
		</td></tr> 
	    
		
		<tr>
		<td align="right" style="">
		Starting Date *
		</td>
		<td>
	 	<input id="optt9" name="fromdate" value="<?php echo $rowBooster['StartDate']  ?>" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);document.getElementById('optt10').value=''"   readonly="readonly" type="text">
	    &nbsp;&nbsp;<span id="startdate" style="font-size:9px;"></span>
	    </td></tr> 
	    
		
		<tr>
		<td align="right" style="">
		Ending Date *
		</td>
		<td><input id='optt10' class="inputCalender" value="<?php echo $rowBooster['EndDate']  ?>"  onclick="CalculateResearchDate();" placeholder="YYYY-MM-DD" name="todate"  type="text" readonly />
		&nbsp;&nbsp;<span id="enddate" style="font-size:9px;"></span>
		</td>
		</tr> 
		
		
		
		<tr>
		<td align="right" style="">
		</td>
		<td>
		<?php
		$getMax = mysql_query("SELECT * FROM  `researchbooster` WHERE  `cid` =  '$cid'
AND (`Approved` =  '2' &&  `ActivationRequest` =  '1')
AND id = ( SELECT MAX( id ) FROM  `researchbooster` WHERE cid =  '$cid' ) 
AND  '$date' BETWEEN  `StartDate` AND  `EndDate`",$con) or die(mysql_error());
	
	
	
	
		//if(mysql_num_rows($getMax) > 0)
		//{
	
		?>	
		<!-- <input name="Button2" id="optt13" type="button" value="Booster Activation Request Already Sent" class="buttonGreen"   />  -->
		<?php //   } 
		 
		//else
		//{  ?>
		<input name="Button2" id="optt13" type="button" value="Click to Activate" class="buttonGreen"  onclick="clicktoactivate('<?php  echo $cid;?>','13');" />
		<?php // }   ?>
		</td>
		</tr>	
	    </table>
		
		
		<div class="moduleHeading">
        <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
        <td align="left" style="width:100%">Information To be Filled By KYC Team<span style="text-transform:capitalize"><?php echo $_GET['name'];?></span></td>
        </td>
        </tr>
        </table> 
        </div>
		
		<table width="100%" cellpadding="0" cellspacing="10">
		<tr>
		<td align="left" style="">
		Email Replied 
		</td>
		<td><input   <?php  if($rowBooster['EmailReplied']==1)   { echo  "checked disabled" ;  } ?>  type="checkbox" />
		</td>
		</tr>	
		
		<tr>
		<td align="left" style="">
		Date Email Received
		</td>
		<td ><input name="fromdate" disabled value="<?php echo $rowBooster['EmailRepliedDate']; ?>"  class="inputCalender" placeholder="YYYY-MM-DD"   readonly="readonly" type="text">
	    
		<tr>
		<td align="left" style="">
		Fund Debited 
		</td>
		<td ><input  <?php  if($rowBooster['FundDebited']==1)   { echo  "checked disabled" ;  } ?>  type="checkbox" />
		</td></tr>		

		<tr>
		<td align="left" style="">
		Fund Debited Date
		</td>
		<td ><input id="optt3" disabled name="fromdate" value="<?php echo $rowBooster['FundDebitedDate']; ?>"  class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);"  readonly="readonly" type="text">
	    </td></tr> 
		
		<tr>
		<td align="left" style="">
		Fund Available
		</td>
		<td >
		<select disabled class="input" >
		<option value="0">Select</option>
		<option <?php if ($rowBooster['FundAvailable']==1)  { echo "selected";   }?>  value="1">Credit Balance</option>
		<option <?php if ($rowBooster['FundAvailable']==2)  { echo "selected";   }?>  value="2">Excess Stocks With POA</option>
		<option <?php if ($rowBooster['FundAvailable']==3)  { echo "selected";   }?>  value="3">Insufficient Fund</option>
		</select>
		</td>
		</tr> 
		
		<tr>
		<td align="right" style="">
		Comments 
		</td>
		<td>
		<textarea name="" readonly class="input" style="width:500px;height:30px;"><?php echo $rowBooster['Comments']; ?></textarea>		
		</td>
		</tr> 
		</table>
		</div>
        </div> 
