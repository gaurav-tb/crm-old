<?php
include("../include/connection.php");
$cid = $_REQUEST['cid'];
$name = $_REQUEST['name'];
$getData = mysql_query("SELECT `code` FROM `contact` WHERE `id` = '$cid'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
$code = !empty($row['code']) ? $row['code'] : '' ;

//echo "SELECT * FROM `fundspayinrequest` WHERE `clientid` = '$code'";die;
$getFundRequest = mysql_query("SELECT * FROM `fundspayinrequest` WHERE `clientid` = '$code'",$con) or die(mysql_error());
?>
<div class="moduleHeading">
	
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="left" style="width: 30%">Fund Request Statement For <span style="text-transform:capitalize"><?php echo $_GET['name'];?></span></td>
			</td>
		</tr>
	</table>
</div>


<div style="height:650px;overflow:auto">
<table cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		
		<th style="width:10%;" align="left">S.No.</th>
		<th style="width:10%;" align="left">Amount</th>
		<th style="width:10%;" align="left">Amount Type</th>
		<th style="width:10%;" align="left">Reference No</th>
		<th style="width:10%;" align="left">Transfer Mode</th>
		<th style="width:10%;" align="left">Screenshot Proof</th>
		<th style="width:20%;" align="left">Requested Date</th>
		<th style="width:20%;" align="left">Request Type</th>
	</tr>
	<?php
$i=1;
while($rowFundRequest = mysql_fetch_array($getFundRequest)){
$amount = !empty($rowFundRequest['amount']) ? $rowFundRequest['amount'] : '0' ;
$amounttype = !empty($rowFundRequest['amounttype']) ? $rowFundRequest['amounttype'] : 'NA' ;
$referenceno = !empty($rowFundRequest['referenceno']) ? $rowFundRequest['referenceno'] : 'NA' ;
$transfermode = !empty($rowFundRequest['transfermode']) ? $rowFundRequest['transfermode'] : 'NA' ;
$filepath = !empty($rowFundRequest['filepath']) ? $rowFundRequest['filepath'] : '' ;
$created_date = !empty($rowFundRequest['created_date']) ? $rowFundRequest['created_date'] : 'NA' ;
$requesttype = !empty($rowFundRequest['requesttype']) ? $rowFundRequest['requesttype'] : '' ;
?>
	<tr id="fetchRow<?php echo $i;?>" class="d<?php echo $i%2;?>">
		
		<td align="left"> <?php echo $i;?> </td>
		<td align="left"> <?php echo $amount.' Rs.';?> </td>
		<td align="left"> <?php echo $amounttype;?> </td>
		<td align="left"> <?php echo $referenceno;?> </td>
		<td align="left"> <?php echo $transfermode;?> </td>
		<td align="left"> <?php if(!empty($filepath)) { ?><a href="<?php echo $filepath;?>" target="_black" title="click to open"><img style="height: 55px;" src='<?php echo $filepath;?>'></a> <?php } else { echo 'NA';} ?> </td>
		<td align="left"> <?php echo $created_date;?> </td>
		<td align="left"> <?php 
			if($requesttype == 1){
				echo 'Pay-In Request';
			} else if($requesttype == 2){
				echo 'Pay-Out Request';
			}
		?> </td>
	</tr>
	<?php
$i++;
}
?>
</table>
<div id="moreData">
</div>
<div class="moduleFoot">
</div>
</div>
