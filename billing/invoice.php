<?php
include("../include/conFig.php");

$id=$_GET['id'];
$sql="select * from `invoice` where `id` = '$id'";
$result=mysql_query($sql)or die(mysql_error());
$row=mysql_fetch_array($result);

?>

$html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Generate Invoice</title>
</head>
<body style="font-size: 12; font-family: Arial, Helvetica, sans-serif;background-color:#cccccc">

<center>
<table  cellpadding="0" cellspacing="0" width="800px">

<tr><td>
	<table  cellpadding="0" cellspacing="0" width="800px" style="background-color:#f4f4f4">
		<tr>
			<td align="left" style="padding-left: 30px;padding-top:25px;padding-bottom:25px;">
			<p><b>Invoice WBR '. $'id'</b><br /><?php echo date("d-M,y",strtotime($row['date']))?>
			</p>
			<h2 style="color:blue">Rs.<?php  echo $row['advance']?></h2>
			</td>
			<td align="right" width="50%" style="padding-right: 20px;padding-top:5px;padding-bottom:25px">
			<img alt="logo1" src="../images/webricks_logo (1).png" width="200px" style="float: right" /></td>
		</tr>
	</table>
	</td></tr>
	<tr><td>
	<table style="background-color:white;width:795px;border-top:5px #cccccc solid">
	<tr>
	<td>	
	<table  cellpadding="0" cellspacing="0" style="padding-top:5px" width="795px">
		<tr>
			<td align="left" style="padding-left: 30px;vertical-align:top" width="50%">
			<h4 style="margin:0px;padding:10px 0 0 0;">
			<?php
		$getClient=mysql_query("SELECT * FROM  `clientmaster` where `id` = '$row[0]' ",$con)or die(mysql_error());
		$fetchClient=mysql_fetch_array($getClient)
			
		?>		
</h4>			
				<p style="color:gray;margin:0px;padding:5px 0 0 0;"><b><?php echo $fetchClient[0] ?></b> 
				<br/><?php echo $fetchClient[5] ?></p>
			
			</td>
		<td align="right" style="padding-right:30px;vertical-align:top" width="50%">
			<h4 style="margin:0px;padding:10px 0 0 0;"> Webricks Services</h4>
			<p style="color:gray;margin:0px;padding:5px 0 0 0;">3-G, BCM City.<br/>Navlakha Square,<br/>Indore- 452001<br/>hello@webricks.com<br/>(0731)-4060313</p></td>
		</tr>
	</table>
	</td>
	</tr>
	<tr >
	<td style="padding-left:30px">
	<table  cellpadding="0" cellspacing="0" style="margin-top:50px;background-color:#e5e5e5" width="750px">
		
		<tr  style="background-color:#4e6fa4;color:white;">
			<td style="text-align:left;padding-left:10px; height: 25px;">Product</td>
		<td style="text-align:right;padding-right:20px; height: 25px;">Amount</td>
		</tr><br/>
				<tr>
		<td style="text-align:left;padding-left:10px;padding-top:10px"><span><b><?php  echo $row['p1name']?></b></span>
		<br/>
	
		<span style="text-align:left;font-size:11px;padding-left:12px; height: 20px;"><?php  echo $row['p1description']?></span></td>
		<td style="text-align:right;padding-right:20px; height: 20px;"><?php  echo $row['p1amount']?></td>
		
		</tr>
		<tr>
		<td style="text-align:left;padding-left:10px;padding-top:10px"><span><b><?php  echo $row['p2name']?></b></span>
		<br/>
	
		<span style="text-align:left;font-size:11px;padding-left:12px; height: 20px;"><?php  echo $row['p2description']?></span></td>
		<td style="text-align:right;padding-right:20px; height: 20px;"><?php  echo $row['p2amount']?></td>
		
		</tr>
		<?php 
		if($row['p3name'] != "")
		{
		?>
<tr>
		<td style="text-align:left;padding-left:10px;padding-top:10px"><span><b><?php  echo $row['p3name']?></b></span>
		<br/>
	
		<span style="text-align:left;font-size:11px;padding-left:12px; height: 20px;"><?php  echo $row['p3description']?></span></td>
		<td style="text-align:right;padding-right:20px; height: 20px;"><?php  echo $row['p3amount']?></td>
		
		</tr>
<?php
}
if($row['p4name'] != "")
		{
		?>



		<tr>
		<td style="text-align:left;padding-left:10px;padding-top:10px"><span><b><?php  echo $row['p4name']?></b></span>
		<br/>
	
		<span style="text-align:left;font-size:11px;padding-left:12px; height: 20px;"><?php  echo $row['p4description']?></span></td>
		<td style="text-align:right;padding-right:20px; height: 20px;"><?php  echo $row['p4amount']?></td>
		
		</tr>
	<?php 
	}
	if($row['p5name'] != "")
	{
	?>
	<tr>
		<td style="text-align:left;padding-left:10px;padding-top:10px"><span><b><?php  echo $row['p5name']?></b></span>
		<br/>
	
		<span style="text-align:left;font-size:11px;padding-left:12px; height: 20px;"><?php  echo $row['p5description']?></span></td>
		<td style="text-align:right;padding-right:20px; height: 20px;"><?php  echo $row['p5amount']?></td>
		
		</tr>
	
	<?php  
	}
	?>	
		

	</table>
	</td></tr>
	<tr><td style="padding-left:30px">
	<table cellpadding="0" cellspacing="0" style="margin-top:150px;width:750px" >
	<tr><td style="text-align:left;width:500px"></td>
	<td style="text-align:right;padding-top:10px;padding-right:5px"><b/>Total Amount </td>
	<td style="text-align:right;padding-top:10px;padding-right:20px"><?php  echo $row['total']?></td>
	</tr>
	<tr><td style="text-align:left;width:500px; height: 32px;"></td>
	<td style="text-align:right;padding-top:10px;padding-right:5px; height: 32px;"><b/>Discount </td>
	<td style="text-align:right;padding-top:10px;padding-right:20px; height: 32px;"><?php  echo $row['Discount']?></td>
	</tr>
	<tr><td style="text-align:left;width:400px; height: 29px;"></td>
	<td style="text-align:right;padding-top:10px;padding-right:5px; height: 29px;"><b/>Grand Total </td>
	<td style="text-align:right;padding-top:10px;padding-right:20px; height: 29px;"><?php  echo $row['grandtotal']?></td>
	</tr>
	<tr><td style="text-align:left;padding-left:20px;width:350px;border-bottom:2px #cccccc solid;border-top:2px #cccccc solid"></td>
	<td style="text-align:right;padding-top:10px;padding-right:5px;width:400px;color:red;border-bottom:2px #cccccc solid;border-top:2px #cccccc solid"><b/>Net Payable Amount(Initial Advance) </td>
	<td style="text-align:right;padding-top:10px;padding-right:20px;width:125px;border-bottom:2px #cccccc solid;border-top:2px #cccccc solid"><?php  echo $row['advance']?>
</td>
	</tr>
	</table>
	</td></tr>	
	<tr>
	<td>
	<table cellpadding="0" cellspacing="0" style="width:800px;" >
	
	<tr>
	<td style="font-size:11px;text-align:left;padding-left:20px;height:150px;vertical-align:top;">
	<br />
	<br />
	Please Note, that this invoice is used as a reciept for the initial advance payment for the application. 
    <br/>Next payment will be expected after the complete installment of the application.
	</td></tr>
	<tr><td style="text-align:left;padding-left:30px;width:750px;border-top:2px #cccccc solid;height:40px;"></td>
	<td style="text-align:right;padding-top:10px;padding-right:20px;width:400px;color:gray;border-top:2px #cccccc solid;font-size:12px"><i/>Registration No:- 2533/IND/CE/NEW </td>
	</tr>
	
	</table>
	</td></tr>
		


	
		</table>
		</td></tr>
	
	</table>
</center>

</body>

</html>'
<?php
ob_flush();
?>