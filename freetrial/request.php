<?php
include("../include/conFig.php");
?>
<div class="moduleHeading">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<th align="left" style="width: 30%">Free Trial Request For <?php echo $_GET['name'];?> </th>
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
		$gethata = mysql_query("SELECT product.name,product.id,category.name FROM  product,category WHERE product.delete ='0' AND product.id != '1' AND product.category = category.id GROUP BY category.name",$con) or die(mysql_error());
		while($row = mysql_fetch_array($gethata))
		{
		?>
			<option value="<?php echo $row[2];?>*0*<?php echo $row[1];?>">
			<?php echo $row[2];?></option>
			<?php
		}
		
		?></select></td>
		</tr>
	</table>
	<div style="height:300px;overflow-x:hidden;overflow-y:auto;">
	<table id="xyz" cellpadding="0" cellspacing="0" class="fetch" width="100%">
		<tr>
			<th id="opt1" style=" text-align: left;; width: 250px;">Product</th>
			<th id="opt2" style="text-align: left;; display:none">Amount</th>
			<th id="opt3" style="text-align: left;; display:none">Quantity</th>
			<th id="opt4" style="text-align: left;width:250px;;">From Date</th>
			<th id="opt5" style="text-align: left;width:250px;;">To Date</th>
			<th id="opt6" style="text-align: left;; display:none; ">SubTotal</th>
			<th id="opt7" style="text-align: left;width:50px;;">X</th>		</tr>
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
		<tr>
			<td align="left" style="width: 30%" style="display:none" >
			<input id="parPay" class="input" name="Text1" type="text"  style="width: 200px" />
			</td>
		</tr>

	</table>

		<table cellpadding="10" cellspacing="0" class="form" width="100%">
		<tr>
		<td align="left">
	
		<input class="buttonGreen" name="Button2" onclick="saveBill('<?php echo $_GET['cid'];?>', '<?php echo $_GET['mobile'];?>')"  type="button" value="Send Request" style="width: 163px" />&nbsp;&nbsp;&nbsp;
			
			</td>
		
	<td align="right"><strong>Way of Communication</strong>&nbsp;&nbsp; &nbsp;
<input name="Checkbox1" type="checkbox" id="sms" value="sms"/>&nbsp;SMS&nbsp;&nbsp;&nbsp;
<input name="Checkbox1" type="checkbox" id="call" value="call"/>&nbsp;Call&nbsp;&nbsp;&nbsp;
<input name="Checkbox1" type="checkbox" id="messenger" value="messenger"/>&nbsp;Messenger
	</td>

		</tr>
	</table>
	</center></div>
