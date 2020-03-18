<?php 
include("../../include/conFig.php");
   
$team_id = array(0=>21,1=>15,2=>12,3=>29,4=>20);

$count_ftd=mysql_query("SELECT teamid,COUNT( customersupport.id )
FROM teamamtes
LEFT JOIN customersupport ON teamamtes.mateid = customersupport.ownerid
WHERE fund_counted = '1'
AND fund_counted_date
BETWEEN '2020-03-01'
AND '2020-03-31'
GROUP BY teamid",$con) or die(mysql_error());

while($row_ftd = mysql_fetch_array($count_ftd))
{
$team_ftd = $row_ftd[0];
$counted_ftd = $row_ftd[1];

mysql_query("UPDATE dashboard_data SET `counted_ftd_10`='$counted_ftd' where `team_id`='$team_ftd'",$con) or die(mysql_error());

}

$get_accounts=mysql_query("SELECT COUNT( contact.id ) AS total_account, teamid
FROM teamamtes
LEFT JOIN contact ON teamamtes.mateid = contact.ownerid
WHERE contact.converted='1' and contact.conversionrequestdate
BETWEEN '2020-03-01 00:00:01'
AND '2020-03-31  23:59:59'
GROUP BY teamid",$con) or die(mysql_error());

while($row_accounts = mysql_fetch_array($get_accounts))
{
$total_accounts = $row_accounts[0];
$team_acc = $row_accounts[1];

mysql_query("UPDATE dashboard_data SET `total_account_opened`='$total_accounts' where `team_id`='$team_acc'",$con) or die(mysql_error());

}


$checksql=mysql_query("SELECT `fund_counted_date`,`first_trade_date`,`id`,`tradingbellsid` from customersupport where first_trade='1' and fund_counted='1' and `target_counted`='0'",$con) or die(mysql_error());

while($row = mysql_fetch_array($checksql))
{
 $counted_date = strtotime($row[0]);
 $first_trade = strtotime($row[1]);
 $id = $row[2];
 $code = $row[3];
 $result = (max($first_trade,$counted_date));
 $result_date = date('Y-m-d',$result);

$checkftdfund=mysql_query("SELECT max(id),`cumulative` FROM payinpayoutlogs WHERE code = '$code'",$con) or die(mysql_error());
if(mysql_num_rows($checkftdfund)==0)
{
$ftd_funds=0;
}
else
{
$rowfund=mysql_fetch_array($checkftdfund);
$ftd_funds=$rowfund[1];
}

 mysql_query("UPDATE customersupport SET target_count_date='$result_date',`target_counted`='1',`ftd_funds`='$ftd_funds' WHERE id='$id'",$con) or die(mysql_error());

}



echo '1';
         

?>