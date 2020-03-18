<?php
error_reporting(0);
$permissions = "G_reports,S_reports,UP_reports";
$value = "General Report,Service Report,User Performance Report";

$permissions = explode(",",$permissions);
$value = explode(",",$value);

$html = '<tr>';
			
			$i=0;
	foreach($permissions as $key =>$val)
	{
	$j = $i+1;
	$html .=	'<td><input name="Checkbox1" type="checkbox" checked="checked"  style="vertical-align:middle;margin-bottom:7px;" id="lds'.$i.'" value="'.$val.'" />'.$value[$key].'</td>';
	if($j%4 == 0)
	{
	$html .= "</tr><tr>";
	}
	
	$i++;
	}
	
?>
&nbsp;<textarea name="TextArea1" style="width: 600px; height: 191px"><?php echo $html;?></textarea>