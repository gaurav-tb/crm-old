<?php
include("../include/conFig.php");
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
$owner = $_POST['leadowner'];
$type = $_POST['ctype'];

if($owner == '')
{
$owstr = "(1=1)";
}
else
{
$owstr = "contact.ownerid = '$owner'";
}

if($type == '')
{
$tystr = "(1=1)";
}
else
{
$tystr = "contact.converted = ".$type;
}

$getData = mysql_query("SELECT contact.id,employee.name, contact.fname,contact.ownerid,contact.lname, contact.mobile, contact.phone,contact.email,contact.website,leadstatus.name,leadresponse.name,leadsource.name,contact.callbackdate,contact.modifieddate,city.name FROM contact,employee,city,leadstatus,leadresponse,leadsource WHERE contact.leadstatus = leadstatus.id AND  contact.leadsource = leadsource.id AND contact.latestresponse = leadresponse.id AND contact.leadstatus = leadstatus.id AND  contact.ownerid = employee.id AND contact.delete = '0' AND contact.city = city.id AND ".$owstr." AND ".$tystr." AND contact.createdate BETWEEN '$fromdate' AND '$todate' AND contact.alloted = '1' ORDER BY contact.id",$con) or die(mysql_error());
while($row = mysql_fetch_array($getData))
{
		$already[$row[0]]["All"] = $row[1]."THISISUSEDTOBRKFIRSTLOOP".$row[2]."THISISUSEDTOBRKFIRSTLOOP".$row[4]."THISISUSEDTOBRKFIRSTLOOP".$row[5]."THISISUSEDTOBRKFIRSTLOOP".$row[6]."THISISUSEDTOBRKFIRSTLOOP".$row[7]."THISISUSEDTOBRKFIRSTLOOP".$row[8]."THISISUSEDTOBRKFIRSTLOOP".$row[9]."THISISUSEDTOBRKFIRSTLOOP".$row[10]."THISISUSEDTOBRKFIRSTLOOP".$row[11]."THISISUSEDTOBRKFIRSTLOOP".$row[12]."THISISUSEDTOBRKFIRSTLOOP".$row[13]."THISISUSEDTOBRKFIRSTLOOP".$row[14];
		$getNote = mysql_query("SELECT noteline.subject,noteline.note,noteline.createdate,employee.name FROM noteline,employee WHERE noteline.cid = '$row[0]' AND noteline.updatedby = employee.id",$con) or die(mysql_error());
		$i=0;
		while($rowNote = mysql_fetch_array($getNote))
		{
			$already[$row[0]]["Note"] .= $rowNote[0].":::".$rowNote[1].":::".$rowNote[2].":::-Done By ".$rowNote[3]."THISISBREAKER";
			$i++;
		}
}

require_once '../Classes/PHPExcel.php';
$rowdimensiongap=0;
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Bjoern Karpenstein")
							 ->setLastModifiedBy("Bjoern Karpenstein")
							 ->setTitle("4Sight Report for country ".$_GET["country"])
							 ->setSubject("4Sight Report for country ".$_GET["country"])
							 ->setDescription("This report has been generated using 4Sight Reporting")
							 ->setKeywords("4Sight Reporting APO Bjoern Karpenstein Daniela Sennert")
							 ->setCategory("4Sight Report for country ".$_GET["country"]);
			
			
		$sheet = $objPHPExcel->getActiveSheet();	
			
			$default_border = array(
    'style' => PHPExcel_Style_Border::BORDER_THIN,
    'color' => array('rgb'=>'1006A3')
);
$style_header = array(
    'borders' => array(
        'bottom' => $default_border,
        'left' => $default_border,
        'top' => $default_border,
        'right' => $default_border,
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb'=>'E1E0F7'),
    ),
    'font' => array(
        'bold' => true,
    )
);

$style_courier = array(
    'borders' => array(
        'bottom' => $default_border,
        'left' => $default_border,
        'top' => $default_border,
        'right' => $default_border,
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb'=>'FF9999'),
    ),
    'font' => array(
        'bold' => true,
    )
);
$style_gpo = array(
    'borders' => array(
        'bottom' => $default_border,
        'left' => $default_border,
        'top' => $default_border,
        'right' => $default_border,
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb'=>'99FFCC'),
    ),
    'font' => array(
        'bold' => true,
    )
);

							 
							 
							 

  $i=1;
  $outlinelevel=0;
$forname = "LeadTrackingReport";
$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, 'Owner');
$objPHPExcel->getActiveSheet()->setCellValue('B' . $i, 'First Name');
$objPHPExcel->getActiveSheet()->setCellValue('C' . $i, 'Last Name');
$objPHPExcel->getActiveSheet()->setCellValue('D' . $i, 'Mobile');
$objPHPExcel->getActiveSheet()->setCellValue('E' . $i, 'Phone');
$objPHPExcel->getActiveSheet()->setCellValue('F' . $i, 'Email');
$objPHPExcel->getActiveSheet()->setCellValue('G' . $i, 'Website');
$objPHPExcel->getActiveSheet()->setCellValue('H' . $i, 'Status');
$objPHPExcel->getActiveSheet()->setCellValue('I' . $i, 'Response');
$objPHPExcel->getActiveSheet()->setCellValue('J' . $i, 'Source');
$objPHPExcel->getActiveSheet()->setCellValue('K' . $i, 'Call Back Date');
$objPHPExcel->getActiveSheet()->setCellValue('L' . $i, 'Last Update Date');
$objPHPExcel->getActiveSheet()->setCellValue('M' . $i, 'City');

$curLetter = "M";
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setOutlineLevel(1);
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setVisible(true);
$i++;

foreach($already as $key => $temp)
{
$alltog = $temp["All"];
$alltog = explode("THISISUSEDTOBRKFIRSTLOOP",$alltog);
$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $alltog[0]);
$objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $alltog[1]);
$objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $alltog[2]);
$objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $alltog[3]);
$objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $alltog[4]);
$objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $alltog[5]);
$objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $alltog[6]);
$objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $alltog[7]);
$objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $alltog[8]);
$objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $alltog[9]);
$objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $alltog[10]);
$objPHPExcel->getActiveSheet()->setCellValue('L' . $i, $alltog[11]);
$objPHPExcel->getActiveSheet()->setCellValue('M' . $i, $alltog[12]);

$curLetter = "M";
$vv= 2;
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setOutlineLevel(1);
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setVisible(true);
$i++;
$item = $temp["Note"];
$item = explode("THISISBREAKER",$item);
	foreach($item as $wamp)
	{
			$intog = $wamp;
			$intog = explode(":::",$intog);
			if($intog[0] != '')
			{
 			$objPHPExcel->getActiveSheet()->setCellValue('B' . $i, "Story");
 			if($intog[0] == 'Oship')
 			{
 			$status = 'OwnerShip Changed';
 			}
 			else if($intog[0] == 'Updation')
 			{
 			$status = 'Modifications Made';
 			}
 			else if($intog[0] == 'Bapproved')
 			{
 			$status = 'Services Approved';
 			}
 			else if($intog[0] == 'Brequest')
 			{
 			$status = 'Service Request';
 			}
 			else if($intog[0] == 'Call')
 			{
 			$status = 'Made A Call';
 			}
 			else if($intog[0] == 'Crequset')
 			{
 			$status = 'Client Conversion';
 			}
 			else if($intog[0] == 'Fapproved')
 			{
 			$status = 'Freetrial Approval';
 			}
 			else if($intog[0] == 'Fdenied')
 			{
 			$status = 'Freetrial Denied';
 			}
 			else if($intog[0] == 'Frequest')
 			{
 			$status = 'Freetrial Requested';
 			}
 			else if($intog[0] == 'Meeting')
 			{
 			$status = 'Had A Meeting';
 			}
 			 
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $status);
			$text = strip_tags($intog[1]);
			$objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $text);
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $intog[2]);
			$objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $intog[3]);
			$sheet->getStyle('B'.$i)->applyFromArray( $style_header );
			$sheet->getStyle('C'.$i)->applyFromArray( $style_courier );
				$sheet->getStyle('D'.$i)->applyFromArray( $style_courier );
				$sheet->getStyle('E'.$i)->applyFromArray( $style_gpo );
				$sheet->getStyle('F'.$i)->applyFromArray( $style_gpo );
			$curLetter = "F";
			$vv= 2;
			$objPHPExcel->getActiveSheet()->getRowDimension($i)->setOutlineLevel(2);
			$objPHPExcel->getActiveSheet()->getRowDimension($i)->setVisible(false);
			$objPHPExcel->getActiveSheet()->setShowSummaryBelow(false);
			$i++;
			$objPHPExcel->getActiveSheet()->getRowDimension($i)->setCollapsed(true);	
		}
	}
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setCollapsed(true);
}
$objPHPExcel->getActiveSheet()->setTitle('Simple');
$objPHPExcel->setActiveSheetIndex(0);
$filename = "LeadTracking_".$fromdate."_".$todate;
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'_".xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

?>
