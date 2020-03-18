<?php
error_reporting(0);
$cmp = $_GET['symbol'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>..::Market Watch <?php echo $cmp;?>::.</title>
<meta http-equiv="refresh" content="300;url=frame.php?<?php echo "id=".$_GET['id']."&opt=".$_GET['opt']."&cocode=".$_GET['cocode']."&symbol=".$_GET['symbol']; ?>"/>
</head>

<body>



<?php

$url = "http://swastika.co.in/Corporateinfo/ScripSearch.aspx?id=".$_GET['id']."&opt=".$_GET['opt']."&cocode=".$_GET['cocode']."&symbol=".$_GET['symbol']."";
$str = "";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$str);
				$output = curl_exec($ch);
				//echo $output;
				
				$temp = explode("<!--end-->",$output);
				$temp1 = explode("<!DOCTYPE html",$temp[1]);
				
				$html = '<table class="fetch" cellpadding="5" cellpadding= "5" style="margin:0px;padding:0px;background:#fff;font-size:10px;;font-family:"Segoe UI","Segoe UI Web Light","Segoe UI Light","Segoe UI Web Regular","Segoe UI Symbol",Estrangelo Edessa,"Helvetica Neue",Arial;font-size:13px;color:#222;"><tr><td> <table>'.$temp1[0].'</td></tr></table>';		
				$html = str_ireplace("../Style.css","http://demo.gocrm.co.in/css/style.css",$html);
				$html = str_ireplace("../images/smallup.gif","http://swastika.co.in/images/smallup.gif",$html);
				$html = str_ireplace("../images/smalldown.gif","http://swastika.co.in/images/smalldown.gif",$html);
								$html = str_ireplace("../images/eq.gif","http://swastika.co.in/images/eq.gif",$html);
								$html= str_ireplace("<td ","<td style='font-size:10px;' ",$html);
				echo $html;		
?>

</body>

</html>
