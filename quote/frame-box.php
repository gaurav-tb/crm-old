<?php
error_reporting(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
<link href="../ css/style.css" rel="stylesheet" type="text/css" />
<meta http-equiv="refresh" content="300"/>
</head>

<body>

<?php
$type = $_GET['type'];
if($type == "commodity")
{
$url = $_GET['url'];
$str = "";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$str);
				$output = curl_exec($ch);
				$html = $output;
				//echo $html;
$firstExp = '<td align="center" class="ads" style="text-align: center;">';
$html = explode($firstExp,$html);
$secExp = '<td style="padding:20px 0 30px 10px; border-bottom:#c5c5c5 1px solid;">';
$newHtml = explode($secExp,$html[1]);
$finalExp = 'style="font:11px Arial; color:#0000FF"';
$finalHtml = explode($finalExp,$newHtml[0]);
$toPut = str_ireplace("<table","<table width='100%'",$finalHtml[1]);
$toPut = str_ireplace("244C91","b82121",$toPut);
$toPut = str_ireplace("2A4A8F","b82121",$toPut);
$toPut = str_ireplace("<b>","",$toPut);
$toPut = str_ireplace("</b>","",$toPut);
$temp8 = explode(">Watchlist",$toPut);
$t1= explode('<img src="',$toPut);
$t2 = explode("</font>",$t1[0]);
$t3 = explode("<font",$t2[0]);
$t4 = explode(">",$t3[1]);
$headName = substr($t4[1],0,40);
$headName = trim($headName);
$headidName = str_ireplace(" ","_",$headName);
$fin = explode('</strong>',$temp8[0]);
//$myFin = str_ireplace("-->","",$fin[1]);
?>
<div style="border-bottom:2px #eee solid;font-family:'Segoe UI', Tahoma, Geneva, Verdana;font-size:12px" id="<?php echo $headidName?>-marketWatch" >
<?php
echo $fin[1];
echo $temp8[2];
?>
<br/>
</div>
<?php
}
else if($type == "Stocks")
{
$url = "http://m.moneycontrol.com/".$_GET['url'];
$str = "";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$str);
				$output = curl_exec($ch);
				$html = $output;
$firstExp =  'class="ads" style="text-align: center;"';
$secExp = '</strong></a></td>';
$html = explode($firstExp,$html);
$html = explode($secExp,$html[1]);
$newHtml = explode("<table ",$html[0]);
$data = "<table ".$newHtml[1].$html[1];
$dataExp = '<td align="left" class="tdwidth100per" style="text-align: left;"><font color="#000000">';
$data = explode($dataExp,$data);
//print_r($data);
$str1 = 'NSE: Not traded in last';
$str2 = 'BSE: Not traded in last';
//echo $data[0];
	if(strpos($data[0],$str1) && strpos($data[0],$str2))
	{
	$finalExp = '<td class="tdwidth100per gry" align="center" >';
	$final = explode($finalExp,$data[0]);
	}
	else
	{
	$finalExp = '<td class="tdwidth100per gry" align="center" >';
	$thisFinal = explode($finalExp,$data[0]);
	$thisExp = ' <td colspan="2" class="paddingleft4px tdwidth100per">';
	$final = explode($thisExp,$thisFinal[0]); 
	}
?>

<?php

$toPut = str_ireplace("<table","<table width='100%'",$final[0]);
$toPut = str_ireplace("244C91","b82121",$toPut);
$toPut = str_ireplace("2A4A8F","b82121",$toPut);
$toPut = str_ireplace("<b>","",$toPut);
$toPut = str_ireplace("</b>","",$toPut);


$t1= explode('<img src="',$toPut);
$t2 = explode("</font>",$t1[0]);
$t3 = explode("<font",$t2[0]);
$t4 = explode(">",$t3[1]);
$headName = substr($t4[1],0,35);


if($headName == "NSE: Not traded in last 30 days")
{
$t1= explode('<img src="',$toPut);
$t2 = explode("</font>",$t1[0]);
if(count($t2) == 4)
{
$t3 = explode("<font",$t2[2]);
$t4 = explode(">",$t3[1]);
$headName = substr($t4[1],0,35);
}
else if(count($t2) == 3)
{
$t3 = explode("<font",$t2[1]);
$t4 = explode(">",$t3[1]);
$headName = substr($t4[1],0,35);

}
}
$headName = trim($headName);
$headidName = str_ireplace(" ","_",$headName);
//print_r($t1);
?>
<div style="border-bottom:2px #eee solid;font-family:'Segoe UI', Tahoma, Geneva, Verdana;font-size:12px" id="<?php echo $headidName?>-marketWatch" >
<?php
echo $toPut;
?>
<br/>
</div>
<?php
}

else if($type == 'fno')
{
$keyword = trim($_GET['cmp']);

				$url = "http://m.moneycontrol.com/future_quotes.php?fnCode=".strtoupper($keyword);
				$str = "";
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$str);
				$output = curl_exec($ch);
				$html = $output;
				
					
					$firstExp =  'style="background-color: #FFFFFF; text-align: left;" class="tdwidth100per paddingleft4px">';
					$secExp = '<table border="0" class="mm-table footerbgcolor"';
					$html = explode($firstExp,$html);
					$newHtml = explode($secExp,$html[1]);
					$replaceHref = '<a href="';
					$myHref = '<a href="mypage.php?type='.$type.'&url=';
					$repHtml = str_ireplace($replaceHref,$myHref,$newHtml[0]);
					$newStr = '<td style="padding:5px 0 10px 10px;">';
					$finalHtml = explode($newStr,$repHtml);
					$preFinal = str_ireplace('class="red"','style="color:#b82727"',$finalHtml[0]);
					$toPut = str_ireplace("<table","<table width='100%'",$preFinal);
					//echo $toPut;
$toPut = str_ireplace("244C91","b82121",$toPut);
$toPut = str_ireplace("2A4A8F","b82121",$toPut);
$toPut = str_ireplace("<b>","",$toPut);
$toPut = str_ireplace("</b>","",$toPut);
$temp8 = explode(">Watchlist",$toPut);
$t1= explode('<img src="',$toPut);
$t2 = explode("</font>",$t1[0]);
$t3 = explode("<font",$t2[0]);
$t4 = explode(">",$t3[1]);
$headName = substr($t4[1],0,40);
$headName = trim($headName);
$headidName = str_ireplace(" ","_",$headName);
$toPut =  $temp8[1]; 
?>
<div style="border-bottom:2px #eee solid;font-family:'Segoe UI', Tahoma, Geneva, Verdana;font-size:12px" id="<?php echo $headidName?>-marketWatch" >

<?php
echo $toPut;
?>

<br/>
</div>

<?php					
					
}


else
{
$url = "http://m.moneycontrol.com/".$_GET['url'];
$str = "";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$str);
				$output = curl_exec($ch);
				$html = $output;
$firstExp =  'class="ads" style="text-align: center;"';
$secExp = '</strong></a></td>';
$html = explode($firstExp,$html);
$html = explode($secExp,$html[1]);
$newHtml = explode("<table ",$html[0]);
$data = "<table ".$newHtml[1].$html[1];
$dataExp = '<td align="left" class="tdwidth100per" style="text-align: left;"><font color="#000000">';
$data = explode($dataExp,$data);
//echo $data[0];
//echo $newHtml[0];
/*$replaceHref = '<a href="';
$myHref = '<a href="mypage.php?url=';
$finalHtml = str_ireplace($replaceHref,$myHref,$newHtml[0]);
echo $finalHtml;	
*/;

$toPut = str_ireplace("<table","<table width='100%'",$data[0]);
$toPut = str_ireplace("244C91","b82121",$toPut);
$toPut = str_ireplace("2A4A8F","b82121",$toPut);
$toPut = str_ireplace("<b>","",$toPut);
$toPut = str_ireplace("</b>","",$toPut);
$toPut = str_ireplace("images/","http://m.moneycontrol.com/images/",$toPut);

?>
<div style="border-bottom:2px #eee solid;font-family:'Segoe UI', Tahoma, Geneva, Verdana;font-size:12px" id="<?php echo $headidName?>-marketWatch" >

<?php
echo $toPut;
?>

<br/>
</div>
<?php
}
?>
</body>

</html>
<?php
$chkHt = strlen($toPut);
//echo strlen($toPut);
if($chkHt < 2000)
{
$ht = '100px';
}
else if(($chkHt > 2000) && ($chkHt < 6000))
{
$ht = '200px';
}
else if(($chkHt > 6000) && ($chkHt < 9000))
{
$ht = '200px';
}
else if(($chkHt > 9000) && ($chkHt < 12000))
{
$ht = '300px';
}
else
{
$ht = '500px';
}
?>
<script type="text/javascript">

var j = document.getElementById('<?php echo $headidName?>-marketWatch').clientHeight;
j = j+'px';
if(window.top.window.document.getElementById('<?php echo $headidName?>-watchFrame'))
{
window.top.window.document.getElementById('<?php echo $headidName?>-watchFrame').style.height = j;
}

</script>