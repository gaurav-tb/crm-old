
<?php  
include("../../include/conFig.php");
if($_FILES[csv][size] > 0) 
{ 
	$file = $_FILES[csv][tmp_name];
	$rfile=fopen($file,"r");
	$csv_records=array();
	$first=true;

    $i=1;
	while(!feof($rfile))
	{
		$record=fgetcsv($rfile);
		if(empty($record)){
			if($first){
				break;
			}else{
			continue;
			}
		}
		if($first){
			$header=$record;
			$first=false;
			continue;
		}
	    $header = array_map('trim', $header);
	    
		$csv_records=$usermeta=array();
		$usermeta=$record;
		$csv_records=array_combine($header, $usermeta);
		$code=$csv_records['AccountCode'];
		$Tradecsvdate=$csv_records['TradeDate'];
		$Tradedate= date('Y-m-d', strtotime($Tradecsvdate));
		$Debit=$csv_records['Debit'];
		$Credit=$csv_records['Credit'];
		$VoucherNumber=$csv_records['Vr No.'];
		$ChequeNumber=$csv_records['Chq No'];
		$thisdate = date('Y-m-d', strtotime($_POST['date']));
        $cumulative=0;

	
		$getDuplicateVoucher=mysql_query("SELECT * FROM `payinpayoutlogs` WHERE `VoucherNumber`='$VoucherNumber' and code = '$code' and ChequeNumber = '$ChequeNumber'",$con) or die(mysql_error());
		if(mysql_num_rows($getDuplicateVoucher) > 0)
		{
			continue;
		}
		else
		{
	    $getClosingBalance=mysql_query("SELECT (SUM( Credit ) - SUM( Debit )) AS ClosingDate FROM payinpayoutlogs WHERE code = '$code'",$con) or die(mysql_error());
        $rowClosingBalance = mysql_fetch_array($getClosingBalance);	


	    $getLastCumulative=mysql_query("SELECT max(id),`cumulative` FROM payinpayoutlogs WHERE code = '$code'",$con) or die(mysql_error());

        if(mysql_num_rows($getLastCumulative)==0)
        {
        $cumulative += (($Credit-$Debit)+0);
        }
        else
        {
        $rowLastCumulative = mysql_fetch_array($getLastCumulative);	
		$cumulative += (($Credit-$Debit)+$rowLastCumulative[1]);
        }

        if($rowClosingBalance[0] >= 10000)
        {
        mysql_query("UPDATE customersupport set `fund_counted`='1',`fund_counted_date`='$date' WHERE `customersupport`.`fund_counted`='0' and `customersupport`.`tradingbellsid`='$code'",$con) or die(mysql_error());
        }

		$result=mysql_query("INSERT INTO `payinpayoutlogs` (`id`,`code`,`TradeDate`,`Debit`,`Credit`,`UploadingDate`,`VoucherNumber`,`ChequeNumber`,`cumulative`) VALUES ('','$code','$Tradedate','$Debit','$Credit','$thisdate','$VoucherNumber','$ChequeNumber','$cumulative')",$con) or die(mysql_error());
		}
		
		$i++;
	}
	?><script type="text/javascript">
		setTimeout("window.close()",0);	
		alert("Data Inserted Successfully.");
	</script>
	<?php
}	

?>



