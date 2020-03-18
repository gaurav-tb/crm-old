<?php
include("../include/conFig.php");
$id = $_GET['id'];
$cid = $_GET['cid'];
//echo $id;
$getData = mysql_query("SELECT * FROM `invoice` WHERE `id` = '$id' AND `delete` = '0'",$con) or die(mysql_error());
$rowData = mysql_fetch_array($getData);
?>
<div class="moduleHeading">
<span id="thisisbillupdate"></span>
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<th align="left" style="width: 30%">
<div class="buttonBlue" style="display:inline-block;float:right" onclick="getModule('invoice/generateinvoice?id=<?php echo $id;?>&i=<?php echo $i;?>','manipulatemoodleContent','viewmoodleContent','Fetching Data..')">View Invoice</div>
			<?php
			if($_GET['bill'])
			{
			?>
			
			<?php
			}
			else
			{
			?>
			Edit Bill: 
			<?php
			}
			?>
			</th>
		    </tr>
	        </table>
            </div>
            <div class="form">
	        <table id="abc" cellpadding="2" cellspacing="2" class="form" width="100%">
	     	<tr>
			<td><?php

?><select id="opt0" class="input" name="select1" onchange="addbillrow(this.value)" style="width: 244px">
<option value="">Please Select Product</option>
			<?php
		$gethata = mysql_query("SELECT * FROM  `product` where `delete` ='0' AND `id` != '1' ",$con) or die(mysql_error());
		while($row = mysql_fetch_array($gethata))
		{
		?>
			<option value="<?php echo $row['name'];?>*<?php echo $row['amount'];?>*<?php echo $row['id'];?>">
			<?php echo $row['name'];?></option>
			<?php
		}
		
		?></select></td>
		</tr>
	</table>
	<div style="height:300px;overflow-x:hidden;overflow-y:auto;">
	<table id="xyz" cellpadding="0" cellspacing="0" class="fetch" width="100%">
		<tr>
			<th id="opt1" style=" text-align: left;; width: 150px;">Product</th>
				<th id="opt4" style="text-align: left;width:215px;">From Date</th>
					<th id="opt5" style="text-align: left;width:215px;;">To Date</th>
			<th id="opt2" style="text-align: left;width:60px;">Amt</th>
			<th id="opt3" style="text-align: left;width:60px;">Qty</th>
			<th id="opt6" style="text-align: left;width:60px;">Sub</th>
			<th id="opt7" style="text-align: left;width:40px;;">X</th>		</tr>
			<?php
			$k=0;
			$transactionalid = $rowData['transactionalid'];
			$getService = mysql_query("SELECT product.name,servicecall.fromdate,servicecall.todate,product.amount,servicecall.product,servicecall.quantity,servicecall.subtotal FROM servicecall,product,category WHERE product.category = category.id AND  servicecall.transactionalid = '$transactionalid' AND servicecall.product = product.id",$con) or die(mysql_error());
			while($rowService = mysql_fetch_array($getService))
			{
			?>
			<tr onmouseover="ToggleBox('del<?php echo $k;?>','block','');" class="d1" onmouseout="ToggleBox('del<?php echo $k;?>','none','')" id="pro<?php echo $k;?>"><td align="left" style="width:150px;"><strong><?php echo $rowService[0];?></strong></td><td align="left" style="width:215px;"><input id="from<?php echo $k;?>" name="demo3" class="inputCalender" value="<?php echo $rowService[1];?>" onclick="openCalendar(this);" readonly="readonly" type="text"></td><td align="left" style="width:215px;"><input id="to<?php echo $k;?>" name="demo3" class="inputCalender" value="<?php echo $rowService[2];?>" onclick="openCalendar(this);" readonly="readonly" type="text"></td><td id="amt<?php echo $k;?>" align="left" style="width:60px;"><?php echo $rowService[3];?><input name="Text1" type="text" value="<?php echo $rowService[4];?>" style="display:none" id="pid<?php echo $k;?>"></td><td align="left" style="width:60px;"><input name="Text1" style="width:40px;" class="input" type="text" value="<?php echo $rowService[5];?>" id="qt<?php echo $k;?>" onkeyup="calc('<?php echo $k;?>');numbersonly('qt<?php echo $k;?>')"></td><td id="st<?php echo $k;?>" align="left" style="width:60px;"><?php echo $rowService[6];?></td><td align="left" style="width:40px;"><img src="images/delete.png" alt="" style="height: 9px; display: none;" id="del<?php echo $k;?>" onclick="deleteRow('<?php echo $k;?>')"></td></tr>
			<?php
			$k++;
			}
			?>
			
			
	</table>
	</div>
	<center>
	<table cellpadding="5" cellspacing="0" class="form" width="100%">
		<tr>
			<td align="right" style="width: 70%; font-weight: bold">Total Price</td>
			<td align="left" style="width: 30%">
			<input id="totalPrice" class="input" name="Text1" type="text" readonly="readonly" style="width: 200px" value="<?php echo $rowData['totalprice']?>" />
			</td>
		</tr>
		<tr>
			<td align="right" style="width: 70%; font-weight: bold">Discount</td>
			<td align="left" style="width: 30%">
			<input id="disCount" class="input" name="Text1" onkeyup="calculateAll();numbersonly('disCount')" type="text" style="width: 200px" value="<?php echo $rowData['discount']?>" />
			</td>
		</tr>
		<tr>
			<td align="right" style="width: 70%; font-weight: bold">Adjustment</td>
			<td align="left" style="width: 30%">
			<input id="adjustMent" class="input" name="Text1" onkeyup="calculateAll();numbersonly('adjustMent')" type="text" style="width: 200px" value="<?php echo $rowData['adjustment']?>" />
			</td>
		</tr>
		<tr>
			<td align="right" style="width: 70%; font-weight: bold">Net Payable 
			Amount</td>
			<td align="left" style="width: 30%">
			<input id="grandTotal" class="input" name="Text1"  readonly="readonly" type="text"  style="width: 200px" value="<?php echo $rowData['grandtotal']?>"/>
			</td>
		</tr>
		<tr>
			<td align="right" style="width: 70%; font-weight: bold">Payment Received Till Date</td>
			<td align="left" style="width: 30%">
			<input id="parPay" class="input" name="Text1" type="text" value="<?php echo $rowData['partialpayment']?>"  style="width: 200px" />
			</td>
		</tr>

	</table>
	<div class="moduleHeading" style="text-align:left">
	Payment Sheet
	</div>
	<table width="100%" cellpadding="10" cellspacing="0">	
	<tr>
	<td align="right" style="width: 286px">Deal Type</td>
	<td align="left">
	<select name="req" id="dealtype" class="input">
				<option <?php if($rowData['dealtype'] == 'New Deal'){echo 'selected == selected';}?> value="New Deal">New Deal</option>
				<option <?php if($rowData['dealtype'] == 'Renewal'){echo 'selected == selected';}?> value="Renewal">Renewal</option>
				<option <?php if($rowData['dealtype'] == 'Cross Selling'){echo 'selected == selected';}?> value="Cross Selling">Cross Selling</option>
				<option <?php if($rowData['dealtype'] == 'Updgradation'){echo 'selected == selected';}?> value="Upgradation">Updgradation</option>
	</select>
	</td>
	</tr>
	<tr>
	<td align="right" style="width: 286px">Is it an Offer</td>
	<td align="left">
	<select name="req" id="offer" class="input">
				<option <?php if($rowData['offer'] == '0') {echo 'selected == selected';}?> value="0">No</option>
				<option  <?php if($rowData['offer'] == '1') {echo 'selected == selected';}?> value="1">Yes</option>
			</select>
	</td>
	</tr>
	<tr>
	<td align="right" style="width: 286px">Term</td>
	<td align="left">
	<select name="req" id="term" class="input">
				<option <?php if($rowData['term'] == 'Monthly') {echo 'selected == selected';}?> value="Monthly">Monthly</option>
				<option <?php if($rowData['term'] == 'Quarterly') {echo 'selected == selected';}?> value="Quarterly">Quarterly</option>
				<option <?php if($rowData['term'] == 'Half Yearly') {echo 'selected == selected';}?> value="Half Yearly">Half Yearly</option>
				<option <?php if($rowData['term'] == 'Yearly') {echo 'selected == selected';}?> value="Yearly">Yearly</option>
				<option <?php if($rowData['term'] == 'Other') {echo 'selected == selected';}?> value="Other">Other</option>

			</select>
	</td>
	</tr>
	<tr>
	<td align="right" style="width: 286px">Way Of Communication</td>
	<td align="left">
<input <?php if($rowData['sms'] == '1') {echo 'checked == checked';}?> name="Checkbox1" type="checkbox" id="sms" value="sms"/>&nbsp;&nbsp; &nbsp;SMS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input <?php if($rowData['call'] == '1') {echo 'checked == checked';}?> name="Checkbox1" type="checkbox" id="call" value="call"/>&nbsp;Call&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input <?php if($rowData['messenger'] == '1') {echo 'checked == checked';}?> name="Checkbox1" type="checkbox" id="messenger" value="messenger"/>&nbsp;Messenger
	</td>
	</tr>
	<tr>
			<td align="right" style="width: 286px">Bank</td><td>
			<select name="req" id="bank" class="input" style="width: 156px">
			<?php
			$getData = mysql_query("SELECT `name`, `id` FROM `bank` WHERE `delete` = '0'",$con) or die(mysql_error());
			while($rowBank = mysql_fetch_array($getData))
			{
			?>
				<option <?php if($rowBank [1] == $rowData['bank']) echo "selected='selected'"; ?> value="<?php echo $rowBank[1];?>"><?php echo $rowBank[0];?></option>
			<?php
			}
			?>
			</select>
			</td>
			</tr>
	<tr>
	<td align="right" valign="top" style="width: 286px">Payment Mode</td>
	<td align="left">
	<select name="req" id="paymode" class="input" onchange="document.getElementById('Cash').style.display = 'none';document.getElementById('Online Payment').style.display = 'none';document.getElementById('Cheque').style.display = 'none';document.getElementById('Payment Gateway').style.display = 'none';;document.getElementById(this.value).style.display = 'block';">
	<option <?php if($rowData['paymode'] == 'Cash') {echo 'selected == selected';}?> value="Cash">Cash</option>
	<option <?php if($rowData['paymode'] == 'Online Payment') {echo 'selected == selected';}?> value="Online Payment">Online Payment</option>
	<option <?php if($rowData['paymode'] == 'Cheque') {echo 'selected == selected';}?> value="Cheque">Cheque</option>
	<option <?php if($rowData['paymode'] == 'Payment Gateway') {echo 'selected == selected';}?> value="Payment Gateway">Payment Gateway</option>															
	</select>
		
			<div id="modeDetails" style="text-align:left">
	<div id="Cash">		
<input class="input" name="req" type="text" id="paydetails" placeholder="Branch Name" value="<?php echo $rowData['paydetails']?>" />		</div>
			<div id="Online Payment" style="display:none">
<input class="input" name="Text1" type="text" placeholder="Enter Transaction Id" /></div>
			<div id="Payment Gateway" style="display:none">
<input class="input" name="Text1" type="text" placeholder="Enter Transaction Id" /></div>
<div id="Cheque" style="display:none">
<input class="input" name="Text1" type="text" placeholder="Enter Cheque No." /></div>
			</div>
	</td>
	</tr>
		<tr>
			<td align="right" valign="top" style="width: 286px">Description</td><td colspan="3">
			<textarea name="TextArea1" id="des" style="width: 500px; height: 83px"><?php echo $rowData['des']?></textarea>
			</td>
			</tr>
	</table>
	<table cellpadding="10" cellspacing="0" class="form" width="100%">
		<tr>
			<th>
			<b/>
			&nbsp;<input class="buttonGreen" name="Button2" onclick="saveBill('<?php echo $cid;?>', '<?php echo $id;?>');document.getElementById('aprtill<?php echo $id;?>').innerHTML = document.getElementById('parPay').value;"  type="button" value="Update"/>&nbsp;&nbsp;		
			<input id="negetive" class="buttonnegetive" name="Button1" type="button" value="Cancel"/>
			</th>
		</tr>
	</table>
	</center>
	<br/>	<br/>	<br/>	<br/>	<br/>	<br/>
	</div>
