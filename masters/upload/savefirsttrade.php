

<?php  
include("../../include/conFig.php");
if($_FILES[csv][size] > 0) 
{ 
    $uploadtradetype=$_POST['uploadtradetype'];  
	$file = $_FILES[csv][tmp_name];
	$rfile=fopen($file,"r");
	$csv_records=array();
    $headercheck = fgetcsv($rfile, 0, ',');


    if($uploadtradetype=='2' && $headercheck[1]=='firsttradedate')
    {
    ?>
    <script type="text/javascript">
		setTimeout("window.close()",0);	
		alert("Please upload the csv with Last Trade Date.");
	</script>
    <?php 
    exit;
    }
    elseif($uploadtradetype=='1' && $headercheck[1]=='lasttradedate')
    {
    ?>
    <script type="text/javascript">
		setTimeout("window.close()",0);	
		alert("Please upload the csv with First Trade Date.");

	</script>

    <?php 
    exit;
    }
    else
    {
	$first=true;
	//echo $rfile;
	while(!feof($rfile))
	{
		$record=fgetcsv($rfile);

	     $clientcode=$record[0];
	     $firsttradedate= date('Y-m-d',strtotime($record[1]));
		
		
		if($clientcode!='')
		{	
        if($uploadtradetype==1)
        {
		$result=mysql_query("UPDATE `contact` SET `firstTradeDate`='$firsttradedate' WHERE `code`='$clientcode'",$con) or die(mysql_error());

		}	
		elseif($uploadtradetype==2) 
		{
			$result=mysql_query("UPDATE `customersupport` SET `lastTradeDate`='$firsttradedate' WHERE `tradingbellsid`='$clientcode'",$con) or die(mysql_error());
		}
		elseif($uploadtradetype==3) 
		{
			$result=mysql_query("UPDATE `customersupport` SET `fund_counted	`='1',`fund_counted_date`='$firsttradedate' WHERE `tradingbellsid`='$clientcode' AND `fund_counted	`='0',",$con) or die(mysql_error());
		}


		}
	}
    
   
    ?>
    <script type="text/javascript">
		setTimeout("window.close()",0);	
		alert("Data updated Successfully.");
	</script>

    <?php
    }
  
    }
	?>





