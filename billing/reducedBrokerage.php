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

//$getBooster= mysql_query("SELECT * FROM  `reduced_brokerage` WHERE  `cid` =  '$cid'AND (`Approved` =  '2' ||  `ActivationRequest` =  '1')AND id = ( SELECT MAX( id ) FROM  `reduced_brokerage` WHERE cid =  '$cid' ) AND  '$date' BETWEEN  `StartDate` AND  `EndDate`",$con) or die(mysql_error());
$getBooster= mysql_query("SELECT * FROM  `reduced_brokerage` WHERE  `cid` =  '$cid'
AND (`Approved` =  '1' ||  `ActivationRequest` =  '1')
AND id = ( SELECT MAX( id ) FROM  `reduced_brokerage` WHERE cid =  '$cid' ) 
",$con) or die(mysql_error());

$rowBooster=mysql_fetch_array($getBooster);



?>



<div class="moduleHeading">
 <table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="left" style="width: 100%">Please fill below Details For Reduced Brokerage Activation<span style="text-transform:capitalize"><?php echo $_GET['name'];?></span></td>
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
		<tr>
			<td align="right" style="">
				Brokerage Plan
			</td>
			<td>
				<select class="input" name='plan' id='optt1' onchange="getAmount()">
					<option value='0'>Choose Plan</option>
					<option value='1'>Silver Plan</option>
					<option value='2'>Gold Plan</option>
					<option value='3'>Diamond Plan</option>
					<option value='4'>Platinum Plan</option>
				</select>
			</td>
		</tr>

		
		<tr>
		<td align="right" style="">
		Total Amount
		</td>
		<td><input id='optt2' class="input"  value="<?php echo $rowBooster['Activationamt'] ?>" OnKeyup="CalculateGST()"  type="text" /> 
		&nbsp;&nbsp;  <span id="GstAmount" style="font-size:12px;color:red;"><?php echo "Amount with GST ".round($rowBooster['AmountWithGst'])."/-" ?></span>
    	</td></tr>
		
		<tr>
		<td align="right" style="">
		Brokerage Rate
		</td>
		<td id="brokerage_rate">
    	</td></tr>

    	<tr>
		<td align="right" style="">
		Validity in months
		</td>
		<td><input id='optt3' class="input" placeholder="validity in months" type="number" /> 
		&nbsp;&nbsp;</td></tr>

		<tr>

		<tr>
		<td align="right" style="">
		Bonus Amount *	
		</td>
		<td>
		<input id='optt6' class="input" placeholder="bonus amount" type="number" />   &nbsp;&nbsp;<span id="bonusamount" style="font-size:9px;"></span>
	    </td></tr> 


		<tr>
		<td align="right" style="">
		Starting Date *
		</td>

		<td>
	 	<input id="optt4" name="startdate" value="<?php echo $rowBooster['StartDate']  ?>" class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);document.getElementById('optt5').value=''"  readonly="readonly" type="text" >
	    &nbsp;&nbsp;<span id="startdate" style="font-size:9px;"></span>
	    </td></tr> 
	    
		
		<tr>
		<td align="right" style="">
		Ending Date *
		</td> <!-- CalculateEndDate(); -->
		<td><input id='optt5' class="inputCalender" value="<?php echo $rowBooster['EndDate']  ?>"  onclick="openCalendar(this);" placeholder="YYYY-MM-DD" name="enddate"  type="text"  />
		&nbsp;&nbsp;<span id="endingdate" style="font-size:9px;"></span>
		</td>
    	</tr>
  		<td align="right" style="">
		</td>
		<td>
		<?php
		$getMax = mysql_query("SELECT * FROM  `reduced_brokerage` WHERE  `cid` =  '$cid'
AND (`ActivationRequest` =  '1')
AND id = ( SELECT MAX( id ) FROM  `reduced_brokerage` WHERE cid =  '$cid' ) 
",$con) or die(mysql_error());
	
	$getApprove1 = mysql_query("SELECT * FROM  `reduced_brokerage` WHERE  `cid` =  '$cid'
AND (`Approved` !=  '2')
AND id = ( SELECT MAX( id ) FROM  `reduced_brokerage` WHERE cid =  '$cid' ) 
",$con) or die(mysql_error());

		if(mysql_num_rows($getMax) > 0)
		{
	
		?>	
		<input name="Button2" id="optt7" type="button" value="Click to Activate Reduced Brokerage" class="buttonGreen"  onclick="return reducedbrokerageactivate('<?php  echo $cid;?>','7');" />
		<!-- <input name="Button2" id="optt6" type="button" value="Reduced Brokerage Activation Request Already Sent" class="buttonGreen"   /> -->
		<!-- <input name="Button2" id="optt13" type="button" value="Click to reduced brokerage Activate" class="buttonGreen"  onclick="reducedbrokerageactivate('<?php  echo $cid;?>','13');" /> -->
		<?php    } 
		 
		else if(mysql_num_rows($getApprove1) > 0)
		{  ?>
			<input name="Button2" id="optt7" type="button" value="Reduced Brokerage Activation Request Already Sent" class="buttonGreen"   />
			<!-- <input name="Button2" id="optt6" type="button" value="Click to Activate Reduced Brokerage" class="buttonGreen"  onclick="return reducedbrokerageactivate('<?php  echo $cid;?>','6');" /> -->
	<!-- 	<input name="Button2" id="optt13" type="button" value="Reduced Brokerage Activation Request Already Sent" class="buttonGreen"   /> -->
		
		<?php  }else{?>
			<input name="Button2" id="optt7" type="button" value="Click to Activate Reduced Brokerage" class="buttonGreen"  onclick="return reducedbrokerageactivate('<?php  echo $cid;?>','6');" />
		<?php }   ?>
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
		<td><input   disabled type="checkbox" />
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
		<td ><input   disabled  type="checkbox" />
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
