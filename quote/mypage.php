<?php
error_reporting(0);
$type = $_GET['type'];
if($type == "commodity")
{
$url = $_GET['url'];
//$url = "http://m.moneycontrol.com/".$_GET['url'];
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
//echo $html[1];				
$secExp = '<td style="padding:20px 0 30px 10px; border-bottom:#c5c5c5 1px solid;">';
$newHtml = explode($secExp,$html[1]);
//echo $newHtml[0];
$finalExp = 'style="font:11px Arial; color:#0000FF"';
$finalHtml = explode($finalExp,$newHtml[0]);
//echo $finalHtml[1];
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

//print_r($t1);
?>
<div id="<?php echo $headidName?>-myChild">
<br/>
<div style="color:#fff;text-align:left;padding:5px;text-transform:capitalize;cursor:pointer;margin-top:4px;" class="blueSimple">
<div style="float:right;color:#fff;margin:3px;vertical-align:middle" onclick="document.getElementById('floatMoodle').removeChild(document.getElementById('<?php echo $headidName?>-myChild'));">x</div>
<span onclick="$('#<?php echo $headidName?>-marketWatch').slideToggle('fast')">
<?php
echo $headName;
?>
</span>
</div>
<div style="padding:10px;border-bottom:2px #eee solid" id="<?php echo $headidName?>-marketWatch" >


<br/><br/><br/>

</div>
</div>
<?php
}
?>
***BREAKERSTRING***<?php echo $headidName;?>-myChild