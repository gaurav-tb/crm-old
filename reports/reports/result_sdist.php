<?php
include("../include/conFig.php");
$from = $_GET['from'];
$to = $_GET['to'];
$disp = $_GET['disp'];
$allitem = $_GET['item'];
$allitem = explode(",",$allitem);

if($disp == 'F')
{
$dispstr= "(billconfirm.dispatchby = 'F')";
}
else if($disp == 'C')
{
$dispstr= "(billconfirm.dispatchby = 'C')";
}
else
{
$dispstr= "(1=1)";

}



foreach($allitem as $tit)
{
$bit = explode("==",$tit);
$item[] .= $bit[0];
$itemcode[] .= $bit[1];
}
foreach($item as $delim)
{
$itstr .= $delim.",";
}
$itstr = substr($itstr,0,-1);
$itstr = "(client.item IN (".$itstr."))";

$already = array();

function nextLetter($tl)
{
$myalph = range('A','Z'); 
	foreach($myalph as $key=> $i)
	{
		if($i == $tl)
		{
			return $myalph[$key+1];
		}
	}
} 


$getData = mysql_query("SELECT state.name,client.entry,district.name,item.id,client.quantity,client.mapped,client.calltype,client.id,client.dispatchby FROM client,area,city,district,state,item WHERE (client.entry BETWEEN '$from' AND '$to') AND (client.area = area.id) AND (area.city = city.id) AND (city.district = district.id) AND (district.state = state.id) AND (client.item = item.id) AND (client.delete != '1') AND ".$itstr." ORDER BY state.name ASC,district.name ASC,client.entry ASC,client.item ASC",$con) or die(mysql_error());
while($row = mysql_fetch_array($getData))
{
$tot = $row[4];
	$thisDisp = $row[8];
	if($row[6] == '1')
	{
	$enq = 0;
	$pnq = $tot;
	}
	else
	{
	$enq = $tot;
	$pnq = 0;
	}
	
	if($row[5] == '1')
	{
	if($disp != 'A')
		{
			if($thisDisp != '')
			{
			if($disp == $thisDisp)
			{
				$mp = $tot;	
			}
			else
			{
				$mp = 0;	
			}
			}
			else
			{
				$mp = 0;	
			}
		}
		else
		{
			$mp = $tot;
		}

	}
	else 
	{
	$mp = 0;
	}
	
$allstr1= '';
$allstr2 = '';
$allstr3 = '';	
	
if(!array_key_exists($row[0],$already))
	{
		$already[$row[0]]['All'] = $tot.",".$enq.",";
			foreach($item as $val)
			{
				if($row[3] == $val)
				{
				$already[$row[0]]['All'] .= $pnq.",".$mp.",";
				}
				else
				{
				$already[$row[0]]['All'] .= "0,0,";
				}
			}
			

						
			
		$already[$row[0]][$row[2]] = $tot.",".$enq.",";
			foreach($item as $val)
			{
				if($row[3] == $val)
				{
				$already[$row[0]][$row[2]] .= $pnq.",".$mp.",";
				}
				else
				{
				$already[$row[0]][$row[2]] .= "0,0,";
				}
			}
		
	}
else
	{
		$temp1 = $already[$row[0]]['All'];
		$temp1 = explode(",",$temp1);
		$temp1[0] = $temp1[0] + $tot;	
		$temp1[1] = $temp1[1] + $enq;
		$i = 2;
		
		foreach($item as $val)
			{
				if($row[3] == $val)
				{
				$temp1[$i] = $temp1[$i] +$pnq;
				$temp1[$i+1] = $temp1[$i+1] +$mp;
				}
				$allstr1 .= $temp1[$i].",".$temp1[$i+1].",";
				$i = $i+2;
				
				
			}
		$already[$row[0]]['All'] = $temp1[0].",".$temp1[1].",".$allstr1;
		
										
					if($already[$row[0]][$row[2]])
					{
									$temp1 = $already[$row[0]][$row[2]];
									$temp1 = explode(",",$temp1);
									$temp1[0] = $temp1[0] + $tot;	
									$temp1[1] = $temp1[1] + $enq;
									$i = 2;
									
									foreach($item as $val)
										{
											if($row[3] == $val)
											{
											$temp1[$i] = $temp1[$i] +$pnq;
											$temp1[$i+1] = $temp1[$i+1] +$mp;
											}
											$allstr3 .= $temp1[$i].",".$temp1[$i+1].",";
											$i = $i+2;
							
							
										}
					$already[$row[0]][$row[2]] = $temp1[0].",".$temp1[1].",".$allstr3;

					
					}
					else
					{
							$already[$row[0]][$row[2]] = $tot.",".$enq.",";
							foreach($item as $val)
							{
								if($row[3] == $val)
								{
								$already[$row[0]][$row[2]] .= $pnq.",".$mp.",";
								}
								else
								{
								$already[$row[0]][$row[2]] .= "0,0,";
								}
							}

					}
	}
		


	//print_r($already);
	/*foreach($already as $key => $val)
	{
		$value = $val['All'];
		$var = explode(",",$value);
		echo $key."--All--".$value;
		echo "<br/>";
		foreach($val  as $newKey => $newVar)
		{
		if($newKey != 'All')
		{
		echo $key."--".$newKey."--".$newVar;
		echo "<br/>";
		}
		}
		
	//echo $val."<br/>";
	}*/
require_once '../analysis/Classes/PHPExcel.php';
$rowdimensiongap=0;
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Bjoern Karpenstein")
							 ->setLastModifiedBy("Bjoern Karpenstein")
							 ->setTitle("4Sight Report for country ".$_GET["country"])
							 ->setSubject("4Sight Report for country ".$_GET["country"])
							 ->setDescription("This report has been generated using 4Sight Reporting")
							 ->setKeywords("4Sight Reporting APO Bjoern Karpenstein Daniela Sennert")
							 ->setCategory("4Sight Report for country ".$_GET["country"]);

  $i=1;
  $outlinelevel=0;
$forname = $_POST['forname'];
$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, 'State');
$objPHPExcel->getActiveSheet()->setCellValue('B' . $i, 'District');
$objPHPExcel->getActiveSheet()->setCellValue('C' . $i, 'Total Orders');
$objPHPExcel->getActiveSheet()->setCellValue('D' . $i, 'Total Enquiry');
$curLetter = "D";
foreach($item as $frKey => $firstrow)
{
$myletter = nextLetter($curLetter);
$cellname = $myletter.$i;
$cellvalue = $itemcode[$frKey];
$objPHPExcel->getActiveSheet()->setCellValue($cellname, $cellvalue);

$myletter = nextLetter($myletter);
$cellname = $myletter.$i;
$objPHPExcel->getActiveSheet()->setCellValue($cellname, "Mapped");

$myletter = nextLetter($myletter);
$cellname = $myletter.$i;
$objPHPExcel->getActiveSheet()->setCellValue($cellname, "Mapped%");

$curLetter = $myletter;
}
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setOutlineLevel(1);
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setVisible(true);
$i++;

foreach($already as $key => $temp)
{
$alltog = $temp['All'];
$alltog = explode(",",$alltog);

$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $key);
$objPHPExcel->getActiveSheet()->setCellValue('B' . $i, 'All Districts');
$objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $alltog[0]);
$objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $alltog[1]);

$curLetter = "D";
$vv= 2;
foreach($item as $frKey => $firstrow)
{
$myletter = nextLetter($curLetter);
$cellname = $myletter.$i;
$cellvalue = $alltog[$vv];
$objPHPExcel->getActiveSheet()->setCellValue($cellname, $cellvalue);
$Looptotal = $alltog[$vv];
$vv++;

$myletter = nextLetter($myletter);
$cellname = $myletter.$i;
$cellvalue = $alltog[$vv];
$objPHPExcel->getActiveSheet()->setCellValue($cellname, $cellvalue);


$myletter = nextLetter($myletter);
$cellname = $myletter.$i;
if($Looptotal != 0)
{
$cellvalue = round(($alltog[$vv]/$Looptotal)*100)."%";
}
else
{
$cellvalue = "-";
}
$objPHPExcel->getActiveSheet()->setCellValue($cellname, $cellvalue);

$curLetter = $myletter;
$vv++;
}


$objPHPExcel->getActiveSheet()->getRowDimension($i)->setOutlineLevel(1);
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setVisible(true);
$i++;
	foreach($temp as $inkey => $wamp)
	{
		if($inkey != 'All')
		{
			$intog = $temp[$inkey];
			$intog = explode(",",$intog);
 
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $inkey);
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $intog[0]);
			$objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $intog[1]);
			$curLetter = "D";
			$vv= 2;
			foreach($item as $frKey => $firstrow)
			{
			$myletter = nextLetter($curLetter);
			$cellname = $myletter.$i;
			$cellvalue = $intog[$vv];
			$objPHPExcel->getActiveSheet()->setCellValue($cellname, $cellvalue);
			$thisLooptotal = $intog[$vv];
                        $vv++;
			
			$myletter = nextLetter($myletter);
			$cellname = $myletter.$i;
			$cellvalue = $intog[$vv];
			$objPHPExcel->getActiveSheet()->setCellValue($cellname, $cellvalue);
			
			
			$myletter = nextLetter($myletter);
			$cellname = $myletter.$i;
                        if($thisLooptotal != 0)
					{
					$cellvalue = round(($intog[$vv]/$thisLooptotal)*100)."%";
					}
					else
					{
					$cellvalue = "-";
					}
			
			$objPHPExcel->getActiveSheet()->setCellValue($cellname, $cellvalue);
			
			$curLetter = $myletter;
			$vv++;
			}
			$objPHPExcel->getActiveSheet()->getRowDimension($i)->setOutlineLevel(2);
			$objPHPExcel->getActiveSheet()->getRowDimension($i)->setVisible(false);
			$objPHPExcel->getActiveSheet()->setShowSummaryBelow(false);
			$i++;
			
					
		}		
	$objPHPExcel->getActiveSheet()->getRowDimension($i)->setCollapsed(true);	
	}
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setCollapsed(true);
}
$objPHPExcel->getActiveSheet()->setTitle('Simple');
$objPHPExcel->setActiveSheetIndex(0);
$filename = "OrderProjection_".$from."_".$to;
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'_".xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

}
?>

