<?php
error_reporting(0);
if(isset($_POST['Submit']))
{
$keyword = trim($_POST['keyword']);
$type = $_POST['type'];
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
					echo $finalHtml[0]; 
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
					$replaceHref = '<a href="';
					$myHref = '<a href="mypage.php?type='.$type.'&url=';
					$finalHtml = str_ireplace($replaceHref,$myHref,$newHtml[0]);
					echo $finalHtml;
				}	
		

}
?>
<form action="#" method="post">
<input type="text" class="input" placeholder="Get Quote" name="keyword" id="myCmp" style="width:150px" >
<input type="submit" value="Search" id="wlLoad" class="button" name="Submit">
<div  id="type" class="paddingleft8px gry_l tdwidth100per"><input   name="type" type="radio" value="Stocks" />
						Stock
						<input name="type" type="radio"   value="mf" />
						MF
						<input name="type" type="radio"   value="fno" />
						F&amp;O
						<input name="type"  type="radio" value="commodity" />
                        Commodity
</div>
</form>
