<?php

 
// Bước 2: Import thư viện phpexcel
require 'PHPExcel.php';
//require 'PHPExcel/Style.php';
//require 'general_helper.php';
require '../db.php';
// Bước 3: Khởi tạo đối tượng mới và xử lý
$PHPExcel = new PHPExcel();

$PHPExcel = PHPExcel_IOFactory::load("Vicif-2018.xls");

// Bước 4: Chọn sheet - sheet bắt đầu từ 0
$PHPExcel->setActiveSheetIndex(0);
 
// Bước 5: Tạo tiêu đề cho sheet hiện tại
$PHPExcel->getActiveSheet()->setTitle('VICIF 2018');
 
// Bước 6: Tạo tiêu đề cho từng cell excel, 
// Các cell của từng row bắt đầu từ A1 B1 C1 ...
//$PHPExcel->getActiveSheet()->setCellValue('A1', 'STT');
//$PHPExcel->getActiveSheet()->setCellValue('B1', 'Email');
//$PHPExcel->getActiveSheet()->setCellValue('C1', 'Fullname');
 
// Bước 7: Lặp data và gán vào file
// Vì row đầu tiên là tiêu đề rồi nên những row tiếp theo bắt đầu từ 2
$rowNumber = 2;
$baseFont = array (
                    'font'=>array(
                    'name'=>'Arial Cyr',
                    'size'=>'10',
                    'bold'=>false
                    )
                );
$center = array(
    'alignment'=>array(
        'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        'vertical'=>PHPExcel_Style_Alignment::VERTICAL_TOP
    )
);



	$sql = "SELECT * FROM vicif_2018 order by id asc";
	$rep = @mysql_query($sql);
	$i=0;
	while ($rows = @mysql_fetch_array($rep)) {
		$i++;
		
		// A1, A2, A3, ...
		$PHPExcel->getActiveSheet()->setCellValue('A' . $rowNumber, $i); // NO		 
			$new_chuoi='';
		$mang = explode(',',$rows['fee_type']);
		$j=0;
		foreach($mang as $k => $v)
		{
			$j++;
			if($v=='1_1'){
		    	$new_chuoi.='[(Before May 18th 2018) | PhD Candidates | 150 USD] ';
			}
			else if($v=='1_2'){
				$new_chuoi.='[(After May 18th 2018) | PhD Candidates | 200 USD] ';
			}
			else if($v=='2_1'){
				$new_chuoi.='[(Before May 18th 2018) | Professionals | 250 USD] ';
			}
			else if($v=='2_2'){
				$new_chuoi.='[(After May 18th 2018) | Professionals | 300 USD] ';
			}
		}
		
		$str_title='';
		if($rows['title_other']!=''){
			$str_title=$rows['title_other'];	
		}else{
			$str_title=$rows['title'];	
		}
		$str_requirements='';
		if($rows['requirements']!='0'){
			$str_requirements='NO';	
		}else{
			$str_requirements='YES - '.$rows['requirements_specify'];	
		}
		
		$PHPExcel->getActiveSheet()->setCellValue('B' . $rowNumber, $rows['orderinfo']); //ID		
		$PHPExcel->getActiveSheet()->setCellValue('C' . $rowNumber, $str_title); //Title
		$PHPExcel->getActiveSheet()->setCellValue('D' . $rowNumber, $rows['firstname'].' '.$rows['lastname']); //Fullname
		$PHPExcel->getActiveSheet()->setCellValue('E' . $rowNumber, $rows['country']); //Country
		$PHPExcel->getActiveSheet()->setCellValue('F' . $rowNumber, $rows['phone']); //Phone
		$PHPExcel->getActiveSheet()->setCellValue('G' . $rowNumber, $rows['email']); //Email
		$PHPExcel->getActiveSheet()->setCellValue('H' . $rowNumber, $rows['faculty_department_school']); //"Faculty/Department/School"
		$PHPExcel->getActiveSheet()->setCellValue('I' . $rowNumber, $rows['affiliation']); //Affiliation
		$PHPExcel->getActiveSheet()->setCellValue('J' . $rowNumber, $rows['fieldofresearch']); //Field of research
		$PHPExcel->getActiveSheet()->setCellValue('K' . $rowNumber, $rows['session_chair']); //Session Chair
		$PHPExcel->getActiveSheet()->setCellValue('L' . $rowNumber, $rows['observer']); //Are you presenting a paper or participating as an observer
		$PHPExcel->getActiveSheet()->setCellValue('M' . $rowNumber, $rows['presenting']); //If you are presenting a paper, how many are you presenting
		$PHPExcel->getActiveSheet()->setCellValue('N' . $rowNumber, $str_requirements); //Dietary 
		$PHPExcel->getActiveSheet()->setCellValue('O' . $rowNumber, $new_chuoi); //Conference Type
		$PHPExcel->getActiveSheet()->setCellValue('P' . $rowNumber, $rows['fee']); //Amount
		$PHPExcel->getActiveSheet()->setCellValue('Q' . $rowNumber, $rows["responseDes"]); //Payment Status
		$PHPExcel->getActiveSheet()->setCellValue('R' . $rowNumber, $rows['create_date']); //Registered Date
		
		// Tăng row lên để khỏi bị lưu đè
		$rowNumber++;
	}
 
// Bước 8: Khởi tạo đối tượng Writer
$objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5');
 
// Bước 9: Trả file về cho client download
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Vicif-2018.xls"');
header('Cache-Control: max-age=0');
if (isset($objWriter)) {
    $objWriter->save('php://output');
}




