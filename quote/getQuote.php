<?php
error_reporting(0);
include("../include/conFig.php");
$getTheme = mysql_query("SELECT `theme` FROM `employee` WHERE `id` = '$loggeduserid'",$con) or die(mysql_error());
$rowTheme = mysql_fetch_array($getTheme);
$theme = $rowTheme[0];
$keyword = trim($_GET['cmp']);
$type = $_GET['type'];
				if($type == "fno")
				{
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
					$final = $preFinal; 
				}
				
				else
				{
				$url = "http://m.moneycontrol.com/search.php?keyword=".$keyword."&Submit=Go&type=".$type;
				$str = "";
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$str);
				$output = curl_exec($ch);
				$html = $output;

					$firstExp =  'td align="left" style="text-align: left;" class="paddingleft4px tdwidth100per"><b>';
					$secExp = '<table border="0" class="mm-table footerbgcolor"';
					$html = explode($firstExp,$html);
					$newHtml = explode($secExp,$html[1]);
					$urlExp1 = explode('<a href="',$newHtml[0]);
					foreach($urlExp1 as $val)
					{
					$temp = explode('"',$val);
					$newUrl = $temp[0];
					$page = "mypage.php?type=$type&url=$newUrl";
					$tickerList = "tickerList('','$page')";
					$temp1 = explode('</a>',$temp[1]);
					$putAnc = str_ireplace(">","",$temp1[0]);
					$final .=  "<div class='blueSimpletext swati' style='cursor:pointer;padding:10px;font-size:13px' onclick=".$tickerList.">".$putAnc."</div>";
					}
				}	
		
?>
<div id="<?php echo $keyword.$type;?>-main">
<div class="blueSimple" style="color:#fff;text-align:left;padding:5px;text-transform:capitalize;cursor:pointer;margin-top:4px;">
<div style="float:right;color:#fff;margin:3px;vertical-align:middle" onclick="document.getElementById('wlist').removeChild(document.getElementById('<?php echo $keyword.$type;?>-main'));">x</div>
<span  onclick="$('#<?php echo $keyword.$type;?>-wlist').slideToggle('faster')">
<?php echo $keyword;?></span></div>
<div style="color:#fff;text-align:left;padding:5px;text-transform:capitalize;cursor:pointer;margin-top:4px;" id="<?php echo $keyword.$type;?>-wlist">

<?php
$toPut = str_ireplace("<table","<table width='100%'",$final);
echo $toPut;
?>
</div>
</div>
