<?php 
session_start();
ob_start();
include("../include/conFig.php");
$from=date_create($_POST['fromdate']);
$fromdate=date_format($from,"Y-m-d 00:00:00");
$to=date_create($_POST['todate']);
$todate=date_format($to,"Y-m-d 23:59:59");
$CheckFilter = $_POST['CheckFilter'];

$name = "PayIn PayOut Report".$fromdate."_".$todate.".xls";
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");

?>



<?php 
$i=1;

if($CheckFilter=="DetailedReport")
{
?>	
<table style="text-align:center" border="1" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td>Client Owner</td>
<td>RM Owner </td>
<td>Manager Owner</td>
<td>Client Code</td>
<td>Client Name </td>
<td>Bo Account Opening Date</td>
<!-- <td>Last Trade Date</td>  -->
<td>Debit</td>
<td>Credit</td>
<td>Net Balance</td>
<td>ledger Balance</td>
<td>trade Date</td>

</tr>

<?php 

$getPayOut=mysql_query("SELECT * FROM payinpayoutlogs WHERE `payinpayoutlogs`.`TradeDate` BETWEEN '$fromdate' AND '$todate'",$con) or die(mysql_error());



while($row=mysql_fetch_array($getPayOut))
{
$code=$row['code'];	

$sqlother=mysql_query("SELECT `employee`.`name` AS ownerName,`contact`.`fname`,`contact`.`lname` FROM contact INNER JOIN employee ON `contact`.`ownerid`=`employee`.`id`   WHERE `contact`.`code`='$code'",$con);
$rowOther=mysql_fetch_array($sqlother);


$sqlDataManager=mysql_query("SELECT  `employee`.`name` 
FROM  `teamamtes` INNER JOIN  `contact` ON  `teamamtes`.`mateid` =  `contact`.`ownerid` 
INNER JOIN  `team` ON  `teamamtes`.`teamid` =  `team`.`id` 
INNER JOIN  `employee` ON  `team`.`leader` =  `employee`.`id` 
WHERE  `contact`.`code` =  '$code' AND `team`.`delete`='0' AND GROUP BY  `teamamtes`.`teamid`",$con);
$rowManager=mysql_fetch_array($sqlDataManager);

	
$getRmowner=mysql_query("select `employee`.`name`,`customersupport`.`BOAccountOpeningDate`,`customersupport`.`LedgerBal` from customersupport inner join `employee` on `customersupport`.`RMOwnerid`=`employee`.`id` WHERE `customersupport`.`tradingbellsid`='$code'",$con) or die(mysql_error());
$rowRm=mysql_fetch_array($getRmowner);	
?>
<tr>
<td><?php echo $rowOther['ownerName'] ?></td>
<td><?php echo $rowRm[0] ?></td>
<td><?php echo $rowManager[0] ?></td>
<td><?php echo $row['code'] ?></td>
<td><?php echo $rowOther['fname']." ".$rowOther['lname'] ?></td>
<td><?php echo date('d-m-Y',strtotime($rowRm['BOAccountOpeningDate'])) ?></td>
<td><?php echo $row['Debit'] ?></td>
<td><?php echo $row['Credit'] ?></td>
<td><?php echo ($row['Credit']-$row['Debit']) ?></td>
<td><?php echo $rowRm['LedgerBal'] ?></td>
<td><?php echo  date('d-m-Y',strtotime($row['TradeDate'])) ?></td>
</tr>
<?php 
}
?>
</table>
<?php 
	
}

else if($CheckFilter=="summaryReport")
{
echo 'need to develop';
}



	
?>



