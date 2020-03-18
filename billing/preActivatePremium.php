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

$getPremium= mysql_query("SELECT * FROM `activatepremium` WHERE `cid` ='$cid'",$con) or die(mysql_error());

$rowPremium=mysql_fetch_array($getPremium);



?>



<div class="moduleHeading">
 <table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="left" style="width: 100%">Please fill below Details For Premium Plan Activation<span style="text-transform:capitalize"><?php echo $_GET['name'];?></span></td>
</td>
</tr>
</table> 
</div>
<div>
        <div class=form> 
	    <table width="100%" cellpadding="0" cellspacing="10">
		<tr>
		<td align="right" style="">
		Registered client name 
		</td>
		<td >
		<?php 
		echo $row['fname']  ." ".$row['lname'] ; 
		?>
		
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

		Client Code :-
	
     	&nbsp;&nbsp;
	    <?php  echo $row['code'] ?>
        </td>
		</tr>	
		
		<?php 
		$getData=mysql_query("SELECT * FROM `researchbooster` WHERE cid='$cid' AND `service`='2' AND `Approved`='2'",$con) or die(mysql_error());
     	$getCount=mysql_num_rows($getData);
		?>
		
		
        <tr>
		<td align="right" style="">
		Regular Brokerage Plan 
		</td>
		<td><input type="radio" id="optt0" name="research"  <?php  if($rowPremium['Plan']==1) { echo 'checked';	}  ?>  Onclick="CalculateBrokerage(this.value)"  value="1" />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Premium Brokerage Plan &nbsp;
		<input type="radio" id="optt1" name="research"  <?php      if($rowPremium['Plan']==2) { echo 'checked';	}  ?>  Onclick="CalculateBrokerage(this.value)" value="2" />
		&nbsp;&nbsp;&nbsp;&nbsp;<span id="PremiumBrokerage" style="font-size:9px;"></span>
		</td>
		</tr>	
			  			
	    <?php 
		$SegmentAmt = explode(",",$rowPremium['segmentAmt']);
		?>
		
		<tr>
		<td align="right" style="">
		Stock Delivery *  
		</td>
		<td>
		<input id='optt2' class="input"  name='req'  value="<?php echo $SegmentAmt[0]  ?>"  type="text" /> &nbsp;&nbsp;     <span id="StockDelivery"  style="font-size:12px;"></span>
		</td>
		</tr>
		
		<tr>
		<td align="right" style="">
		Stock Intraday * 
		</td>
		<td>
		<input id='optt3'  class="input"  name='req'  value="<?php echo $SegmentAmt[1] //." (Max Rupees 20 Per Order)"  ?>"  type="text" /> &nbsp;&nbsp; <span id="StockIntraday"  style="font-size:12px;"></span>
		</td>
		</tr>
		
		
		<tr>
		<td align="right" style="">
		Stock, Index and Currency Futures * 
		</td>
		<td>
		<input id='optt4' class="input"  name='req' value="<?php echo $SegmentAmt[2] //. " (Max)"  ?>"  type="text" /> &nbsp;&nbsp; <span id="CommodityFutures"  style="font-size:12px;"></span> 
 		</td> 
		</tr>
		
		
		<tr>
		<td align="right" style="">
		Stock, Index and Currency Options * 
		</td>
		<td>
		<input id='optt5'  class="input"  name='req' value="<?php echo $SegmentAmt[3]  ?>"   type="text" /> &nbsp;&nbsp;  <span id="CurrencyOptions"  style="font-size:12px;"></span> 
		</td>
		</tr>
		
		<tr>
		<td align="right" style="">
		Commodity Futures *
		</td>
		<td>
		<input id='optt6' class="input"  name='req' value="<?php echo $SegmentAmt[4] //." (Max)"  ?>"   type="text" /> &nbsp;&nbsp; <span id="CommodityFutures1"  style="font-size:12px;"></span>
		</td>
		</tr>
		
		<tr>
		<td align="right" style="">
		Commodity Options  * 
		</td>
		<td>
		<input id='optt7'  class="input"  name='req' value="<?php echo $SegmentAmt[5]  ?>"   type="text" /> &nbsp;&nbsp; <span id="CurrencyOptions1"  style="font-size:12px;"></span>
		</td>
		</tr>
       
		<tr>
		<td align="right" style="">
		Activation Date * 
		</td>
		<td><input id="optt8" name="fromdate" value="<?php echo $rowPremium['PremiumActivationDate'] ?>"  class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);"  readonly="readonly" type="text">
	    <span id="ActivationDate" title="Premium Activation Date" style="font-size:9px;"></span>
		</td>
		</tr>
			
			
		<tr>
		<td align="right" style="">
		Do You want to send the mail to client *  
		</td>
		
		<td> Yes &nbsp; <input type="radio" id="optt9" name="mail"  <?php // if($rowPremium['EmailSend']==1) { echo 'checked';	}  ?>   value="1" />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No &nbsp;
		<input type="radio" id="optt10" name="mail"  <?php // if($rowPremium['EmailSend']==2) { echo 'checked';	}  ?>  value="2" />
		&nbsp;&nbsp;&nbsp;&nbsp;<span id="SendMail" style="font-size:9px;"></span>
		</td>
		</tr>
		
		<tr>
		<td align="right" style="">
		</td>
		<td>
		<input name="Button2" id="optt11" type="button" value="Click to Activate" class="buttonGreen"  onclick="clicktoPremiumPlan('<?php  echo $cid;?>','11');" />
		</td>
		</tr>	
	    </table>
		</div>
        </div> 
