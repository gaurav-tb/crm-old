<?php
include("../include/conFig.php");
$cid = $_GET['cid'];
if($_GET['bill'] == 'new')
{
$count = 0;
}
else
{
$getC = mysql_query("SELECT * FROM `servicecall` WHERE `type` = 'c' AND `cid` = '$cid' AND `approved` = '0'",$con) or die(mysql_error());
$count = mysql_num_rows($getC);
}
?> 
<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<th align="left" style="width: 30%">
			<?php
			if($_GET['bill'])
			{
			?>
			Add a new bill for <?php echo $_GET['name'];?>.
			<div style="float:right">
			<div class="button" style="display:inline-block" onclick="ToggleBox('viewmoodleContent','block','');ToggleBox('manipulatemoodleContent','none','');"><img src="images/back.png" />&nbsp;&nbsp;Back To Bills</div>
			</div>
			<?php
			}
			else
			{
			?>
			Convert <?php echo $_GET['name'];?> to client. 
			<?php
			}
			?>
			
			</th>
		</tr>
	</table>
</div>
<?php

if($count == 0)
{

?>
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
	</table>
	</div>
	<center>
	<table cellpadding="5" cellspacing="0" class="form" width="100%">
		<tr>
			<td align="right" style="width: 70%; font-weight: bold">Total Price</td>
			<td align="left" style="width: 30%">
			<input id="totalPrice" class="input" name="Text1" readonly="readonly" type="text" style="width: 200px" />
			</td>
		</tr>
		<tr>
			<td align="right" style="width: 70%; font-weight: bold">Discount</td>
			<td align="left" style="width: 30%">
			<input id="disCount" class="input" name="Text1" onkeyup="calculateAll();numbersonly('disCount')" type="text" style="width: 200px"  />
			</td>
		</tr>
		<tr>
			<td align="right" style="width: 70%; font-weight: bold">Adjustment</td>
			<td align="left" style="width: 30%">
			<input id="adjustMent" class="input" name="Text1" onkeyup="calculateAll();numbersonly('adjustMent')" type="text" style="width: 200px"  />
			</td>
		</tr>
		<tr>
			<td align="right" style="width: 70%; font-weight: bold">Net Payable 
			Amount</td>
			<td align="left" style="width: 30%">
			<input id="grandTotal" class="input" name="Text1"  readonly="readonly" type="text"  style="width: 200px" />
			</td>
		</tr>
		<tr>
			<td align="right" style="width: 70%; font-weight: bold">Payment Received Till Date</td>
			<td align="left" style="width: 30%">
			<input id="parPay" class="input" name="Text1" type="text"  style="width: 200px" />
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
				<option value="New Deal">New Deal</option>
				<option value="Renewal">Renewal</option>
				<option value="Cross Selling">Cross Selling</option>
				<option value="Updgradation">Updgradation</option>
			</select>
	</td>
	</tr>
	<tr>
	<td align="right" style="width: 286px">Is it an Offer</td>
	<td align="left">
	<select name="req" id="offer" class="input">
				<option value="0">No</option>
				<option value="1">Yes</option>
			</select>
	</td>
	</tr>
	<tr>
	<td align="right" style="width: 286px">Term</td>
	<td align="left">
	<select name="req" id="term" class="input">
				<option value="Monthly">Monthly</option>
				<option value="Quarterly">Quarterly</option>
				<option value="Half Yearly">Half Yearly</option>
				<option value="Yearly">Yearly</option>
				<option value="Other">Other</option>

			</select>
	</td>
	</tr>
	<tr>
	<td align="right" style="width: 286px">Way Of Communication</td>
	<td align="left">
<input name="Checkbox1" type="checkbox" id="sms" value="sms"/>&nbsp;&nbsp; &nbsp;SMS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="Checkbox1" type="checkbox" id="call" value="call"/>&nbsp;Call&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="Checkbox1" type="checkbox" id="messenger" value="messenger"/>&nbsp;Messenger
	</td>
	</tr>
	<tr>
			<td align="right" style="width: 286px">Bank</td><td>
			<select name="req" id="bank" class="input" style="width: 156px">
			<?php
			$getData = mysql_query("SELECT `name`, `id` FROM `bank` WHERE `delete` = '0' ORDER BY `name` DESC",$con) or die(mysql_error());
			while($rowBank = mysql_fetch_array($getData))
			{
			?>
				<option value="<?php echo $rowBank[1];?>"><?php echo $rowBank[0];?></option>
			<?php
			}
			?>
			</select>
			</td>
			</tr>
	<tr>
	<td align="right" valign="top" style="width: 286px">Payment Mode</td>
	<td align="left">
	<select name="req" id="paymode" class="input">
	<option value="Cash">Cash</option>
	<option value="Online Payment">Online Payment</option>
	<option value="Cheque">Cheque</option>
	<option value="Payment Gateway">Payment Gateway</option>															
			</select>
		
			<div id="modeDetails" style="text-align:left">
	<div id="Cash">		
<input class="input" name="req" type="text" id="paydetails" placeholder="Payment Details" />		</div></div>
				</td>
	</tr>
		<tr>
			<td align="right" valign="top" style="width: 286px">Description</td><td colspan="3">
			<textarea name="TextArea1" id="des" style="width: 500px; height: 83px"></textarea>
			</td>
			</tr>
	</table>
	
	<table cellpadding="10" cellspacing="0" class="form" width="100%">
		<tr>
			<th>
			<b/>
			&nbsp;<input class="buttonGreen" name="Button2" type="button" value="Convert" onclick="saveBill('<?php echo $cid;?>', '<?php echo $_GET['mobile'];?>');" />&nbsp;&nbsp;		
			<input id="negetive" class="buttonnegetive" name="Button1" type="button" value="Cancel" />
			</th>
		</tr>
	</table>
	</center>
	<br/>	<br/>	<br/>	<br/>	<br/>	<br/>
	</div>
	<?php
	}
	else
	{
	?>
	<div style="padding-top:100px; color:maroon">A conversion request has already generated for this Lead.</div>
	<?php
	}
	?>
