<?php 
include("../include/conFig.php");
$cid=$_GET['clid'];

$getData = mysql_query("SELECT * FROM `contact` WHERE `id` = '$cid'",$con) or die(mysql_error());
$rowContact = mysql_fetch_assoc($getData);

$chkAlready = mysql_query("SELECT `id` FROM `servicecall` WHERE `cid` = '$cid' AND `type` = 'c'",$con) or die(mysql_error());
$fname = '';
$email = '';
if(mysql_num_rows($chkAlready) > 0) 
{
$fname = $rowContact['fname'];
$lname = $rowContact['lname'];
}

$getPremium= mysql_query("SELECT * FROM `activatepremium` WHERE `activatepremium`.`cid`='$cid'",$con) or die(mysql_error());
$rowPremium=mysql_fetch_array($getPremium);


?>
<div class="moduleHeading">
 <table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="left" style="width: 100%">Please fill below Details For Changing Brokerage Plan <span style="text-transform:capitalize"><?php echo $_GET['name'];?></span></td>
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
    <?php  echo ($fname ." ".$lname) ?>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	Client Code 
	
	&nbsp;&nbsp;
	<?php  echo $rowContact['code'] ?>
	</td>
	</tr>		
	
	    <tr>
	    <td align="right" style="">
	    Email Replied *
	    </td>
	    <td><input id='optt0' value="1"   type="checkbox" />
	    <span id="Emailreplied" title="Email replied" style="font-size:9px;"></span>
    	</td>
		</tr>		
			
		<tr>
		<td align="right" style="">
		Date Email Received *
		</td>
		<td ><input id="optt1" name="fromdate"  class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);"  readonly="readonly" type="text">
	    <span id="EmailReceivedDate" title="Email Received Date" style="font-size:9px;"></span>
		</td></tr> 
		
		<tr>
		<td align="right" style="">
		Comments *
		</td>
		<td>
		<textarea name="" id="optt2" class="input" style="width: 500px;height:30px;"></textarea>		
		</td>
		</tr> 
		
		<tr>
		<td align="right" style="">
		</td>
		<td>
		<input name="Button2" id="optt3" type="button" value="Click to Approve" class="buttonGreen"  onclick="UpdateBrokerageApproval('<?php echo $cid;?>','3');" />
		</td>
		</tr>	
		
		
		</table>
		<div class="moduleHeading">
        <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
        <td align="left" style="width: 100%">Information Filled By Client Owner<span style="text-transform:capitalize"><?php echo $_GET['name'];?></span></td>
        </td>
        </tr>
        </table> 
        </div>
		
		<table width="100%" cellpadding="0" cellspacing="10">
		
		<tr>
		<td align="right" style="">
		Regular Brokerage Plan  
		</td>
		<td><input type="radio" disabled  <?php  if($rowPremium['Plan']==1) { echo 'checked';	}  ?>  />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Premium Brokerage Plan &nbsp;
		<input type="radio"  disabled     <?php      if($rowPremium['Plan']==2) { echo 'checked';	}  ?> />
		&nbsp;&nbsp;&nbsp;&nbsp;</span>
		</td>
		</tr>	
		
		<?php 
		$SegmentAmt = explode(",",$rowPremium['segmentAmt']);
		?>
		
		
		<tr>
		<td align="right" style="">
		Stock Delivery  
		</td>
		<td>
		<input  class="input"  name='req' readonly  value="<?php echo $SegmentAmt[0]  ?>"  type="text" /> &nbsp;&nbsp; Paisa
		</td>
		</tr>
		
		<tr>
		<td align="right" style="">
		Stock Intraday 
		</td>
		<td>
		<input  class="input"  name='req' readonly value="<?php echo $SegmentAmt[1]  ?>"  type="text" /> &nbsp;&nbsp; Paisa
		</td>
		</tr>
		
		
		<tr>
		<td align="right" style="">
		Stock, Index and Currency Futures 
		</td>
		<td>
		<input class="input"  name='req' readonly value="<?php echo $SegmentAmt[2]  ?>"  type="text" /> &nbsp;&nbsp; Paisa
		</td> 
		</tr>
		
		
		<tr>
		<td align="right" style="">
		Stock, Index and Currency Options 
		</td>
		<td>
		<input class="input"  name='req' readonly value="<?php echo $SegmentAmt[3]  ?>"   type="text" /> &nbsp;&nbsp; Paisa
		</td>
		</tr>
		
		<tr>
		<td align="right" style="">
		Commodity Futures 
		</td>
		<td>
		<input class="input"  name='req' readonly value="<?php echo $SegmentAmt[4]  ?>"   type="text" /> &nbsp;&nbsp; Paisa
		</td>
		</tr>
		
		<tr>
		<td align="right" style="">
		Commodity Options  
		</td>
		<td>
		<input class="input"  name='req' readonly value="<?php echo $SegmentAmt[5]  ?>"   type="text" /> &nbsp;&nbsp; Paisa
		</td>
		</tr>
		
		
		<tr>
		<td align="right" style="">
		Activation Date 
		</td>
		<td><input value="<?php echo $rowPremium['PremiumActivationDate'] ?>"  class="inputCalender" placeholder="YYYY-MM-DD" readonly="readonly" type="text">
	    </td>
		</tr>
		
		<tr>
		<td align="right" style="">
		Mail Sent To Client
		</td>
		<td> Yes &nbsp; <input type="radio"   <?php  if($rowPremium['EmailSend']==1) { echo 'checked disabled';	}  ?>  Onclick=""  value="1" />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No &nbsp;
		<input type="radio"   <?php  if($rowPremium['EmailSend']==0) { echo 'checked disabled';	}  ?>  Onclick="" value="2" />
		</td>
		</tr>
		
		</table>

		
        </div>
       </div> 
