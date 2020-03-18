<?php 
include("../include/conFig.php");
$cid=$_GET['clid'];
$researchid=$_GET['researchid'];


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
// echo "SELECT * FROM  `reduced_brokerage` WHERE  `cid` =  '$cid' AND `reduced_brokerage`.`id`='$researchid' AND id = (SELECT MAX( id ) FROM  `reduced_brokerage` WHERE cid =  '$cid";exit;
$getBooster = mysql_query("SELECT * FROM  `reduced_brokerage` WHERE  `cid` =  '$cid' AND `reduced_brokerage`.`id`='$researchid'",$con) or die(mysql_error());
$row=mysql_fetch_array($getBooster);

?>
<div class="moduleHeading">
 <table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="left" style="width: 100%">Please fill below Details For Reduced Brokerage Approval<span style="text-transform:capitalize"><?php echo $_GET['name'];?></span></td>
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
	
		<?php 
		//if($row['service']==1)
       // {
	    ?>
	    		
	    <tr>
		<td align="right" style="">
		Email Replied *
		</td>
		<td ><input id='optt0' value="1"  <?php  if($row['EmailReplied']==1)   { echo  "checked disabled" ;  } ?>  type="checkbox" />
		<span id="Emailreplied" title="Email replied" style="font-size:9px;"></span>
		</td></tr>		
			
		<tr>
		<td align="right" style="">
		Date Email Received *
		</td>
		<td ><input id="optt1" name="fromdate" value="<?php echo $row['EmailRepliedDate']; ?>"  class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);"  readonly="readonly" type="text">
	    <span id="EmailReceivedDate" title="Email Received Date" style="font-size:9px;"></span>
		
		</td></tr> 
		
		<tr>
		<td align="right" style="">
		Fund Debited *
		</td>
		<td ><input id='optt2' value="1"  <?php  if($row['FundDebited']==1)   { echo  "checked disabled" ;  } ?>  type="checkbox" />
		<span id="FundDebited" title="Fund Debited" style="font-size:9px;"></span>
		
		</td></tr>		

		<tr>
		<td align="right" style="">
		Fund Debited Date *
		</td>
		<td ><input id="optt3" name="fromdate" value="<?php echo $row['FundDebitedDate']; ?>"  class="inputCalender" placeholder="YYYY-MM-DD" onclick="openCalendar(this);"  readonly="readonly" type="text">
	    <span id="FundDebitedDate" title="Fund Debited Date" style="font-size:9px;"></span>
		
		</td></tr> 
		
		<tr>
		<td align="right" style="">
		Fund Available *
		</td>
		<td >
		<select id='optt4' class="input" onchange="getClearDate()">
		<option  value="0">Select</option>
		<option <?php if ($row['FundAvailable']==1)  { echo 'Selected';   }?>  value="1">Credit Balance</option>
	<!--<option <?php // if ($row['FundAvailable']==2)  { echo 'Selected';   }?> value="2">Excess Stocks With POA</option>  -->
		<option <?php if ($row['FundAvailable']==3)  { echo 'Selected';   }?> value="3">Insufficient Fund</option>
		</select>
		
		<span id="FundAvailable" title="Fund Available" style="font-size:9px;"></span>
		
		</td>
		</tr> 
		
		
		<?php  
  //       $getMax = mysql_query("SELECT * FROM  `reduced_brokerage` WHERE  `cid` =  '$cid' AND (`Approved`='1' && `ActivationRequest`='0') AND id = (SELECT MAX( id ) FROM  `reduced_brokerage` WHERE cid =  '$cid' )",$con) or die(mysql_error());
		// if(mysql_num_rows($getMax) > 0)
		// {
     	?>
		<tr>
		<td align="right" style="display: none" id='fundtd'>
		Fund Clear Date 
		</td>
		<td><input id='optt5' class="inputCalender" value=""  onclick="openCalendar(this);"  placeholder="YYYY-MM-DD"   type="text"  style="display: none" />
		</td>
		</tr> 
		<?php //} ?>
		
		<?php
		//}
		?>
		
		<tr>
		<td align="right" style="">
		Comments *
		</td>
		<td>
		<textarea name="" id="optt6" class="input" style="width: 500px;height:30px;"><?php echo $row['Comments']; ?></textarea>		
		</td>
		</tr> 
					
		<tr>
		<td align="right" style="">
		</td>
		<td>
		<input name="Button2" id="optt7" type="button" value="Approve Reduced Brokerage" class="buttonGreen"  onclick="return UpdateReducedApproval('<?php  echo $cid;?>','<?php  echo $researchid;?>','6');" />
		</td>
		</tr>	
		
         <?php  //  }  		?>     </table>
		
		<div class="moduleHeading">
        <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
        <td align="left" style="width: 100%">Information Filled By Client Owner<span style="text-transform:capitalize"><?php echo $_GET['name'];?></span></td>
        </td>
        </tr>
        </table> 
        </div>
		
		<table width="100%" cellpadding="0" cellspacing="10">
		
		<?php 
		
		//$getCount=mysql_query("SELECT * FROM `reduced_brokerage` WHERE cid='$cid' AND `service`='2' AND `Approved`='2'",$con) or die(mysql_error());
		$getCount=mysql_query("SELECT * FROM `reduced_brokerage` WHERE cid='$cid' AND `Approved`='2'",$con) or die(mysql_error());
     	$rowCount=mysql_num_rows($getCount);
	
        
		?>
		
		<!-- <tr>
		<td align="left" style="">
		Service
		</td>
		<td><?php if($row['service'] ==1 ){  echo 'Premium Services'; } else {  echo 'Free Trial';  }  ?>
		&nbsp;&nbsp;&nbsp;    <?php echo "<span style='color:red'>Free Trials Taken ".$rowCount." out of 2.</span> " ;  ?>
		</td>
		</tr>	
		
 -->		
		
		<?php   
		//$lst = explode(",",$row['Segments']);
		?>
			
			
		
	<!-- 	<tr>
		<td align="left" style=""> Segments </td>
		<td>Commodity <input type="checkbox"  id="optt0"  <?php  if(in_array('1',$lst)) { echo 'checked disabled';	}  ?> onclick="CalculateBoosterSum(this.value)" value="1" />&nbsp;&nbsp;&nbsp; Future <input type="checkbox"  id="optt1"  <?php  if(in_array('2',$lst)) { echo 'checked disabled';	}  ?> onclick="CalculateBoosterSum(this.value)" value="2" />&nbsp;&nbsp;&nbsp; Option <input type="checkbox"  id="optt2"  <?php  if(in_array('3',$lst)) { echo 'checked disabled';	}  ?> onclick="CalculateBoosterSum(this.value)" value="3" /> &nbsp;&nbsp;&nbsp;  Equity <input type="checkbox" id="optt3"    <?php  if(in_array('4',$lst)) { echo 'checked disabled';	}  ?> onclick="CalculateBoosterSum(this.value)" value="4" /> 
		</td>
		
		</tr> -->
		
		<tr>
		<td align="left" style="">
		Activation Amount
		</td>
		<td><input class="input" readonly  value="<?php echo $row['activationAmount']?>"  type="text" /></td>
		</tr>
		
		
		<tr>
		<td align="left" style="">
		Amount With GST 
		</td>
		<td><input class="input" readonly  value="<?php echo round($row['amountWithGst'])?>"  type="text" /></td>
		</tr>


		<tr>
		<td align="left" style="">
        BonusAmount	
		</td>
		<td><input class="input" readonly  value="<?php echo $row['BonusAmount']?>"  type="text" /></td>
		</tr>



		<tr>
		<td align="left" style="">
		Validity in months
		</td>
		<td><input class="input" readonly  value="<?php echo $row['validity']?>"  type="text" /></td>
		</tr>
		
		
		
		<tr>
		<td align="left" style="">
		Start Date
		</td>
		<td><input class="input" readonly  value="<?php echo $row['StartDate']?>"  type="text" /></td>
		</tr>
		
		<tr>
		<td align="left" style="">
		End Date
		</td>
		<td><input class="input" readonly  value="<?php echo $row['EndDate']?>"  type="text" /></td>
		</tr>
		
		
<!-- 		<tr>
		<td align="left" style="">
		Mobile No To Be Added On Telegram 
		</td>
		<td ><input class="input" readonly value="<?php echo $row['TelegramMobile'] ?>"  type="text" /></td></tr> 
		
		
		<tr> -->
		<!-- <td align="right" style="">
		Research  
		</td>
		<td><input type="radio"  name="research" disabled <?php if($row['ResearchPlus']==1) { echo ' checked';	}  ?> />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Research + &nbsp;
		<input type="radio"      name="research" disabled <?php if($row['ResearchPlus']==2) { echo ' checked';	}  ?> />
		&nbsp;&nbsp;&nbsp;&nbsp;<span id="ResearchPlus" style="font-size:9px;"></span>
		</td>
		</tr> -->	
		
	<!-- 	<tr>
		<td align="left" style="">
		Is Telegram Application Installed 
		</td>
		<td><input value="1" <?php if($row['Telegraminstalled']==1)   { echo  "checked disabled" ;  } ?> type="checkbox" /></td></tr>  -->
		
		<!-- <?php 
		if($row['FundClearDate']!='0000:00:00')
		{	
		?>
		<tr>
		<td align="left" style="">
		Fund Clear Date
		</td>
		<td><input class="input" readonly  value="<?php echo $row['FundClearDate']?>"  type="text" /></td>
		</tr>
		<?php } ?> -->
		
		</table>
        </div>
        </div> 
