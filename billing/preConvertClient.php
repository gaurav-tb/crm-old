<?php 
include("../include/conFig.php");
$cid = $_GET['clid'];

$getData = mysql_query("SELECT * FROM `contact` WHERE `id` = '$cid'",$con) or die(mysql_error());
$row = mysql_fetch_assoc($getData);

$chkAlready = mysql_query("SELECT `id` FROM `servicecall` WHERE `cid` = '$cid' AND `type` = 'c'",$con) or die(mysql_error());
$fname = '';
$email = '';
if(mysql_num_rows($chkAlready) > 0) 
{
	$fname = $row['fname'];
	$email = $row['email'];
}
?>
<div class="moduleHeading">
 <table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="left" style="width: 100%">Please fill below detail before conversion request<span style="text-transform:capitalize"><?php echo $_GET['name'];?></span></td>
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
			<input type='hidden'  value='<?php echo $row['fname'];?>' id='hiddename'>
			<input class="input" type='text' name='req' value="<?php echo $fname;?>" id='optt8' oncopy="return false" oncut="return false" onpaste="return false">	
			<span id="fnamevv" style="font-size:9px;"></span>
			</td>
		    </tr>		
		    <tr>
			<td align="right" style="">
			Registered client email address *
			</td>
			<td >
			<input type='hidden' value='<?php echo $row['email'];?>' id='hiddenemail'>
			<input class="input" type='text' name='req' value="<?php echo $email;?>" id='optt7' oncut="return false" onpaste="return false">	
			<span id="emailvv" title="Mobile Number" style="font-size:9px;"></span>
			</td>
		</tr>		
		<tr>
			<td align="right" style="">
				KYC Method *
			</td>
			<td >
				<select class="input" name="req" style="width: 130px" id="optt0">
					<option value="" >Please select </option>
					<option value="1" <?php if($row['kycmethod'] == 1) { echo 'selected';} ?>>Physical KYC </option>
					<option value="2" <?php if($row['kycmethod'] == 2) { echo 'selected';} ?>>E-KYC</option>
				</select>		
			</td>
		</tr>		
	<!-- 	<tr>
			<td align="right" style="">
				Demat account requied *
			</td>
			<td >
				<select class="input" name="req" style="width: 130px" id="optt1">
					<option value="" >Please select </option>
					<option value="1" <?php // if($row['demataccountrequied'] == 1) { echo 'selected';} ?>>Yes </option>
					<option value="2" <?php // if($row['demataccountrequied'] == 2) { echo 'selected';} ?>>No</option>
				</select>		
			</td>
		</tr>   -->		
		<tr>
			<td align="right" style="">
				Segment *
			</td>
			<td id="teamUsers">
				<?php
				$SegmentArray = array("1"=>"Equity","2"=>"Equity Derivatives","3"=>"Currency Derivatives","4"=>"Commodity Derivatives");
				?>
				<select name="req" class="input" onchange="addToteam(this.value,'optt1')">
					<option value="">Select Segment</option>
					<option value="1**Equity">Equity</option>
					<option value="2**Equity Derivatives">Equity Derivatives</option>
					<option value="3**Currency Derivatives">Currency Derivatives</option>
					<option value="4**Commodity Derivatives">Commodity Derivatives</option>
				    </select>&nbsp;&nbsp;
				    <span id="reselect"></span>	
				    <div style="padding:5px;;" id="selectTeam">			
					<?php
					$lst = $row['segment'];
					$lst = explode(",",$lst);
					foreach($lst as $val) 
					{
					if(!empty($val)) 
					{
					$valPut .= $val.",";
					$val = str_ireplace("-","",$val);
					$val = trim($val);
					if($val != '')
					{
					?>
					<div class="teamMate" id="team<?php echo $val;?>"><?php echo $SegmentArray[$val];?>&nbsp;&nbsp;&nbsp;<span style="cursor:pointer" onclick="removeTeam('<?php echo $val;?>','optt1')">x</span></div>
					<?php
					}
					}
					}		
					?>
				    </div>							
				    <input name="req" type="text" value="<?php echo $valPut;?>" id="optt1" style="display:none" />
		     	</td>
		        </tr>	
		         <tr>
			<td align="right" style="">
				In Person Verification *
			</td>
			<td >
				<select class="input" name="req" style="width: 130px" id="optt2">
					<option value="" >Please select </option>
					<option value="2" <?php if($row['personverification'] == 2) { echo 'selected';} ?>>Video </option>
					<option value="3" <?php if($row['personverification'] == 3) { echo 'selected';} ?>>KRA registered</option>
					<option value="4" <?php if($row['personverification'] == 4) { echo 'selected';} ?>>Face To Face </option>
				
				</select>		
			</td>
		</tr>
		
		 <tr>
		 <td align="right" style="">
		 Introducer Client Code
		 </td>
		 <td >
		 <input name="" class="input" style="width: 200px" type="text" id="optt3" value="<?php echo $row['inroducer'];?>" />
		 </td>
		 </tr>
		<tr>
		 <td align="right" style="">
		  Client Code
		 </td>
		 <td >
		 	<input name="" class="input" style="width: 200px" type="text" id="opt13" value="<?php echo $row['code'];?>" readOnly/>
		 	<span id="code" title="Client Code" style="font-size:9px;"></span>
		 </td>
		 </tr>
		<!-- <tr>
			<td align="right" style="">
				Software Required *
			</td>
			<td >
				<select class="input" name="req" style="width: 130px" id="optt5">
					<option value="" >Please select </option>
					<option value="1" <?php // if($row['softwarerequired'] == 1) { echo 'selected';} ?>>Net Net & TB mobile app</option>
					<option value="2" <?php // if($row['softwarerequired'] == 2) { echo 'selected';} ?>>Odin</option>
					<option value="3" <?php //if($row['softwarerequired'] == 3) { echo 'selected';} ?>>Iwin</option>
					<option value="4" <?php //if($row['softwarerequired'] == 4) { echo 'selected';} ?>>NOW</option>
				</select>		
			</td>
		</tr>   -->
		
	<!-- 	<tr>
			<td align="right" style="">
				Date of Birth *
			</td>
			<td><input name="req" class="input" style="width: 200px" type="date" id="optt6" value="<?php echo $row['dob'];?>" />
		</td>

		</tr>    
		
		<tr>
			<td align="right" style="">
				Account opening charges *
			</td>
			<td>
			<select class="input" name="req" style="width: 130px" id="optt9">
			<option value="" >Please select </option>
			<option value="1" <?php //if($row['accountopening'] == 1) { echo 'selected';} ?>>Paid</option>
			<option value="2" <?php //if($row['accountopening'] == 2) { echo 'selected';} ?>>To be cut from margin</option>
            <option value="3" <?php //if($row['accountopening'] == 3) { echo 'selected';} ?>>Discount Coupon</option>
			</select>
			</td>
		</tr> -->
		<tr>
		<td align="right" style="">
		Account opening charge amount *
		</td>
		<td>
		<input name="req" class="input" style="width: 200px" type="number" id="optt4" value="<?php echo $row['accountopeningamount'];?>" /><span id="amount" title="Amount" style="font-size:9px;"></span>
		</td>
		</tr>
		
		<tr>
		<td align="right" style="">
		Payment Method. *
		</td>
		<td >
		<select class="input" name="req" style="width:130px" onchange="Checkpaymethod(this.value)" id="optt5">
		<option value="" >Please select </option>
		<option value="1" <?php if($row['paymethod'] == 1) { echo 'selected';} ?>>PAYTM</option>
		<option value="2" <?php if($row['paymethod'] == 2) { echo 'selected';} ?>>IMPS</option>
		<option value="3" <?php if($row['paymethod'] == 3) { echo 'selected';} ?>>NEFT/RTGS</option>
		<option value="4" <?php if($row['paymethod'] == 4) { echo 'selected';} ?>>CHEQUE</option>
		<option value="5" <?php if($row['paymethod'] == 5) { echo 'selected';} ?>>RAZORPAY</option>
		<option value="6" <?php if($row['paymethod'] == 6) { echo 'selected';} ?>>Cut To Margin</option>
		</select>
        <span id="paymethod" title="Payment Method" style="font-size:9px;"></span>
        </td>
		</tr>
		
		<tr>
		<td align="right" style="">
		Account opening charge reference no. *
		</td>
		<td>
		<input name="req" class="input" style="width:200px" type="text" onblur="chkOrderID()" id="optt6" value="<?php if($row['accountopeningreffno']!='') { echo $row['accountopeningreffno']; }?>" />
		<span id="refervv" title="Referrence Number" style="font-size:9px;"></span>
        </td>
		</tr>

		<tr>
		<td align="right" style="">
		Pan Card No. *
		</td>
		<td>
		<input name="req" class="input" style="width:200px" type="text"  id="optt9" value="<?php echo $row['pancardnumber'];?>" />
		<span id="panvv" title="PAN Number" style="font-size:9px;"></span>
        </td>
		</tr>
		
	<!-- 	<tr>
		<td align="right" style="">
		UID No. *
		</td>
		<td>
		<input name="req" class="input" style="width:200px" type="text"  id="optt16" value="<?php echo $row['uidnumber'];?>" />
		<span id="uidvv" title="UID Number" style="font-size:9px;"></span>
        </td>
		</tr>   -->

		
		
		<tr>
		<td align="right" style="">
		Comments
		</td>
		<td >
		<textarea name="" id="optt10" class="input" style="width: 500px;height:110px;"><?php echo $row['comments']; ?></textarea>		
		</td>
		</tr>
		<tr>
		<td align="right" style="">
		</td>
		<td>
		<?php
		if(mysql_num_rows($chkAlready) > 0)
		{
		if($perm==12)
		{
		?>	
		<input name="Button2" type="button" value="Update" onclick="removeintroducer('<?php echo $cid;?>');" class="buttonGreen" />&nbsp;&nbsp;	
		<?php   } else {  ?>
 		<input name="Button2" type="button" value="Conversion request already sent" class="buttonGreen" />&nbsp;&nbsp;	
		<?php } } else { ?>
		<input name="Button2" id="optt15" type="button" value="Click to convert" class="buttonGreen"  onclick="return clicktoconvert('<?php echo $cid;?>','11');" />&nbsp;&nbsp;	
		<?php } ?>
		</td>
		</tr>	
	    </table>
        </div>
       </div> 
