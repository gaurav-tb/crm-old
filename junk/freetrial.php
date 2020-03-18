<?php
include("../include/conFig.php");
?>
<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<th align="left" style="width: 30%">Free Trial Information </th>
		</tr>
	</table>
</div>
<div>
	<table id="abc" cellpadding="2" cellspacing="2" class="form" width="100%">
		<tr>
			<td>
			<input name="Text1" type="text" id="typeCheck" value="f" style="display:none" />
			<?php

?><select id="opt0" class="input" name="select1" onchange="addbillrow(this.value)" style="width: 244px">
<option value="">Please Select Product</option>
			<?php
		$gethata = mysql_query("SELECT * FROM  `product` where `delete` ='0' ",$con) or die(mysql_error());
		while($row = mysql_fetch_array($gethata))
		{
		?>
			<option value="<?php echo $row['name'];?>*<?php echo $row['amount'];?>*<?php echo $row['id'];?>">
			<?php echo $row[0];?></option>
			<?php
		}
		
		?></select></td>
		</tr>
	</table>
	<div style="height:300px;overflow-x:hidden;overflow-y:auto;">
	<table id="xyz" cellpadding="0" cellspacing="0" class="fetch" width="100%">
		<tr>
			<th id="opt1" style=" text-align: left;height:20px; width: 200px;">Product</th>
			<th id="opt2" style="text-align: left;height:20px; display:none">Amount</th>
			<th id="opt3" style="text-align: left;height:20px; display:none">Quantity</th>
			<th id="opt4" style="text-align: left;height:20px;">From</th>
			<th id="opt5" style="text-align: left;height:20px;">To</th>
			<th id="opt6" style="text-align: left;height:20px; display:none">SubTotal</th>
			<th id="opt7" style="text-align: left;height:20px;">Delete</th>		</tr>
	</table>
	</div>
	<center>
	

	<table cellpadding="5" cellspacing="0" class="form" width="100%" style="display:none">
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
	</table>

		<table cellpadding="10" cellspacing="0" class="form" width="100%">
		<tr>
			<th>
			<b/>
			&nbsp;<input class="buttonGreen" name="Button2" onclick="saveBill('<?php echo $_GET['cid'];?>', '<?php echo $_GET['mobile'];?>')"  type="button" value="Request" />&nbsp;&nbsp;		
			<input id="negetive" class="buttonnegetive" name="Button1" type="button" value="Cancel" />
			</th>
		</tr>
	</table>
	</center></div>
