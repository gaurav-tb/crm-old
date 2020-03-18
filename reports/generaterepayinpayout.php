<?php 
session_start();
ob_start();
include("../include/conFig.php");
$from=date_create($_POST['fromdate']);
//$fromdate=date_format($from,"Y-m-d 00:00:00");
$fromdate=date_format($from,"Y-m-d");
$to=date_create($_POST['todate']);
//$todate=date_format($to,"Y-m-d 23:59:59");
$todate=date_format($to,"Y-m-d");
$CheckFilter = $_POST['CheckFilter'];
$format = date('Y-m-d His');
$name ="PayIn PayOut Report_".$format.".xls";
//$name = "PayIn PayOut Report".$fromdate."_".$todate.".csv";
// header("Content-Disposition: attachment; filename=\"$name\"");
//header("Content-Type: application/vnd.ms-excel");
header("Content-Type: text/csv; charset=utf-8");
header('Expires: 0');
header('Cache-Control: must-revalidate');
header("Content-Description: File Transfer"); 
header("Content-Disposition: attachment; filename=\"$name\"");
header('Last-Modified: ' . date('D M j G:i:s T Y'));
?>

<?php 
$i=1;

if($CheckFilter=="DetailedReport")
{
	$file = fopen('php://output', 'w');
   	$header = array("S No.","Client Owner","RM Owner","Manager Owner","Client Code","Client Name","Bo Account Opening Date","Debit","Credit","Net Balance","ledger Balance","trade Date"); 
   fputcsv($file, $header);
   $i=0;
   //$getPayOut=mysql_query("SELECT `employee`.`name` AS ownerName,`contact`.`fname`,`contact`.`lname`,`payinpayoutlogs`.`Debit`,`payinpayoutlogs`.`Credit`,`payinpayoutlogs`.`code` FROM `payinpayoutlogs` INNER JOIN `contact` ON `payinpayoutlogs`.`code`=`contact`.`code` INNER JOIN employee ON `contact`.`ownerid`=`employee`.`id`   WHERE `payinpayoutlogs`.`TradeDate` BETWEEN '$from' AND '$to'",$con) or die(mysql_error());
   $getPayOut = mysql_query("SELECT `employee`.`name` AS ownerName,`contact`.`fname`,`contact`.`lname`,`payinpayoutlogs`.`Debit`,`payinpayoutlogs`.`Credit`,`payinpayoutlogs`.`code`,`payinpayoutlogs`.`TradeDate` FROM `payinpayoutlogs` INNER JOIN `contact` ON `payinpayoutlogs`.`code`=`contact`.`code` INNER JOIN employee ON `contact`.`ownerid`=`employee`.`id`   WHERE `payinpayoutlogs`.`TradeDate` BETWEEN '$fromdate' AND '$todate'",$con);
	while($row1 = mysql_fetch_array($getPayOut)){
		$code = $row1['code'];
		//$sqlDataManager=mysql_query("SELECT  `employee`.`name` FROM  `teamamtes` INNER JOIN  `contact` ON  `teamamtes`.`mateid` =  `contact`.`ownerid` INNER JOIN  `team` ON  `teamamtes`.`teamid` =  `team`.`id` INNER JOIN  `employee` ON  `team`.`leader` =  `employee`.`id` WHERE  `contact`.`code` =  '$code' AND `team`.`delete`='0' AND GROUP BY  `teamamtes`.`teamid`",$con);
		$sqlDataManager=mysql_query("SELECT  `employee`.`name` FROM  `teamamtes` INNER JOIN  `contact` ON  `teamamtes`.`mateid` =  `contact`.`ownerid` INNER JOIN  `team` ON  `teamamtes`.`teamid` =  `team`.`id` INNER JOIN  `employee` ON  `team`.`leader` =  `employee`.`id` WHERE  `contact`.`code` =  '$code' AND `team`.`delete`='0'",$con);
		$rowManager=mysql_fetch_array($sqlDataManager);
		$getRmowner=mysql_query("select `employee`.`name`,`customersupport`.`BOAccountOpeningDate`,`customersupport`.`LedgerBal` from customersupport inner join `employee` on `customersupport`.`RMOwnerid`=`employee`.`id` WHERE `customersupport`.`tradingbellsid`='$code'",$con) or die(mysql_error());
		$rowRm=mysql_fetch_array($getRmowner);	
		$i=$i+1;
		$row = array();
		$row["S NO."] = $i;
		$row["Client Owner"] = $row1['ownerName'];
		$row["RM Owner"] = $rowRm[0];
		$row["Manager Owner"] = $rowManager[0];
		$row["Client Code"] = $row1['code'];
		$row["Client Name"] = $row1['fname']." ".$row1['lname'];
		$row["Bo Account Opening Date"] = ($rowRm['BOAccountOpeningDate']=='0000-00-00' || $rowRm['BOAccountOpeningDate']=='')?'NA':date('d-M-Y',strtotime($rowRm['BOAccountOpeningDate']));
		$row["Debit"] = $row1['Debit'];
		$row["Credit"] = $row1['Credit'];
		$row["Net Balance"] = $row1['Credit']-$row1['Debit'];
		$row["ledger Balance"] = $rowRm['LedgerBal'];
		$row["trade Date"] =  ($row1['TradeDate']=='0000-00-00' || $row1['TradeDate']=='')?'NA':date('d-M-Y',strtotime($row1['TradeDate']));
	    fputcsv($file,$row); 
   }
   fclose($file); 
}else if($CheckFilter=="summaryReport")
{
echo 'need to develop';
}
?>	



