<?php

 
// Bước 2: Import thư viện phpexcel
require 'PHPExcel.php';
//require 'PHPExcel/Style.php';
//require 'general_helper.php';
require 'db.php';
// Bước 3: Khởi tạo đối tượng mới và xử lý
$PHPExcel = new PHPExcel();

$PHPExcel = PHPExcel_IOFactory::load("Vsem2019.xls");

// Bước 4: Chọn sheet - sheet bắt đầu từ 0
$PHPExcel->setActiveSheetIndex(0);
 
// Bước 5: Tạo tiêu đề cho sheet hiện tại
$PHPExcel->getActiveSheet()->setTitle('Vsem2019');
 
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



	$sql = "SELECT * FROM registration_registered order by id asc";
	$rep = @mysql_query($sql);
	$i=0;
	while ($rows = @mysql_fetch_array($rep)) {
		$i++;
		
		// A1, A2, A3, ...
		$PHPExcel->getActiveSheet()->setCellValue('A' . $rowNumber, $i); // NO		 

		
		$PHPExcel->getActiveSheet()->setCellValue('B' . $rowNumber, $rows['guest_code']); //ID
		$PHPExcel->getActiveSheet()->setCellValue('C' . $rowNumber, $rows['title']); //Title
		$PHPExcel->getActiveSheet()->setCellValue('D' . $rowNumber, $rows['fullname']); //Fullname
		$PHPExcel->getActiveSheet()->setCellValue('E' . $rowNumber, $rows['jobtitle']); //Country
		$PHPExcel->getActiveSheet()->setCellValue('F' . $rowNumber, $rows['department']); //Phone
		$PHPExcel->getActiveSheet()->setCellValue('G' . $rowNumber, $rows['country']); //Email
		$PHPExcel->getActiveSheet()->setCellValue('H' . $rowNumber, $rows['address']); //"Faculty/Department/School"
		$PHPExcel->getActiveSheet()->setCellValue('I' . $rowNumber, $rows['mobiphone']); //Affiliation
		$PHPExcel->getActiveSheet()->setCellValue('J' . $rowNumber, $rows['email']); //Field of research
		$PHPExcel->getActiveSheet()->setCellValue('K' . $rowNumber, $rows['conference_fees']); //Session Chair
		$PHPExcel->getActiveSheet()->setCellValue('L' . $rowNumber, $rows['total_fees']); //Are you presenting a paper or participating as an observer
		$PHPExcel->getActiveSheet()->setCellValue('M' . $rowNumber, $rows['payment_method']); //If you are presenting a paper, how many are you presenting
		$PHPExcel->getActiveSheet()->setCellValue('N' . $rowNumber, $rows['date_registered']); //Dietary
		$PHPExcel->getActiveSheet()->setCellValue('O' . $rowNumber, $rows['orderinfo']); //Conference Type
		$PHPExcel->getActiveSheet()->setCellValue('P' . $rowNumber, $rows['vpc_TransactionNo']); //Amount
		$PHPExcel->getActiveSheet()->setCellValue('Q' . $rowNumber, $rows["status"]); //Payment Status
        $PHPExcel->getActiveSheet()->setCellValue('R' . $rowNumber, $rows["txnResponseCode"]); //Payment Status
        $PHPExcel->getActiveSheet()->setCellValue('S' . $rowNumber, $rows["lang"]); //Payment Status
        $PHPExcel->getActiveSheet()->setCellValue('T' . $rowNumber, $rows["checkin"]); //Payment Status
		$PHPExcel->getActiveSheet()->setCellValue('U' . $rowNumber, $rows['deleted']); //Registered Date
		
		// Tăng row lên để khỏi bị lưu đè
		$rowNumber++;
	}
 
// Bước 8: Khởi tạo đối tượng Writer
$objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5');
 
// Bước 9: Trả file về cho client download
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Vsem2019.xls"');
header('Cache-Control: max-age=0');
if (isset($objWriter)) {
    $objWriter->save('php://output');
}




