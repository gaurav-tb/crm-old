<?php
include("include/connection.php");
$str = 'Answered, not interested, try again***Did not answer***Filling KYC***Form Dispatched***Form Received. Onboarding***Form sent to HO***Interested***Junk Lead***Partially interested';
$id = '5###2###17###20###21###24###13###33###7';

$str = explode("***",$str);
$id = explode("###",$id);

$i=0;
foreach($str as $key => $val)
{
	if($val != '')
	{
		$tocheck = 'Description- '.$val;
		$toput = $id[$key];
		$getData  = mysql_query("SELECT * FROM `contact` WHERE `description` LIKE '%$tocheck%'",$con) or die(mysql_error());
		while($row = mysql_fetch_array($getData))
		{
			$thisId = $row['id'];
			echo $i." ";

			echo $sql = "UPDATE `contact` SET `latestresponse` = '$toput' WHERE `id` = '$thisId'";
			echo "<br/>";
			mysql_query($sql,$con);

			$i++;
		}	
	}
}