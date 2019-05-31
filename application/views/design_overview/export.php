<?php
$login = $this->session->get_userdata();
$this->session->set_userdata('_current_link', current_url());
if (!isset($login['user_login']) || !isset($login['user_login_url']) || $login['user_login_url']!=base_url())
{
    redirect('auth/login');
}

?>
<?php
// Bước 1:
// Lấy dữ liệu từ database

// Bước 2: Import thư viện phpexcel
require_once(APPPATH.'/libraries/PHPExcel.php');

// Bước 3: Khởi tạo đối tượng mới và xử lý
$PHPExcel = new PHPExcel();

// Bước 4: Chọn sheet - sheet bắt đầu từ 0
$PHPExcel->setActiveSheetIndex(0);

// Bước 5: Tạo tiêu đề cho sheet hiện tại
$PHPExcel->getActiveSheet()->setTitle('Danh sách khách hàng');

// Bước 6: Tạo tiêu đề cho từng cell excel,
// Các cell của từng row bắt đầu từ A1 B1 C1 ...
$PHPExcel->getActiveSheet()->setCellValue('A1', 'STT');
$PHPExcel->getActiveSheet()->setCellValue('B1', 'Ngày đăng ký');
$PHPExcel->getActiveSheet()->setCellValue('C1', 'Tên khách hàng');
$PHPExcel->getActiveSheet()->setCellValue('D1', 'Email');
$PHPExcel->getActiveSheet()->setCellValue('E1', 'Số điện thoại');
$PHPExcel->getActiveSheet()->setCellValue('F1', 'level');
$PHPExcel->getActiveSheet()->setCellValue('G1', 'Link tracking');
$PHPExcel->getActiveSheet()->setCellValue('H1', 'Dịch vụ');
$PHPExcel->getActiveSheet()->setCellValue('I1', 'Marketer');
$PHPExcel->getActiveSheet()->setCellValue('J1', 'Contact source');
$PHPExcel->getActiveSheet()->setCellValue('K1', 'Trạng thái');
$PHPExcel->getActiveSheet()->setCellValue('L1', 'Telesale');

//them attr
if(@$list_attr_customers){
    $col = 12;
    $row = 1;
    foreach ($list_attr_customers as $attr){
        $PHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $attr['name']);
        $col++;
    }
}
//end attr

// Bước 7: Lặp data và gán vào file
// Vì row đầu tiên là tiêu đề rồi nên những row tiếp theo bắt đầu từ 2

$rowNumber = 2;
$index= 1;
if($list_customers){

    foreach($list_customers as $item){

        // A1, A2, A3, ...
        $PHPExcel->getActiveSheet()->setCellValue('A' . $rowNumber, $index);

        // B1, B2, B3, ...
        $PHPExcel->getActiveSheet()->setCellValue('B' . $rowNumber, $item['create_at'] );

        // C1, C2, C3, ...
        $PHPExcel->getActiveSheet()->setCellValue('C' . $rowNumber, $item['name']);

        // D1, D2, D3, ...
        $PHPExcel->getActiveSheet()->setCellValue('D' . $rowNumber, $item['email']);

        // E1, E2, E3, ...
        $PHPExcel->getActiveSheet()->setCellValue('E' . $rowNumber, $item['phone']);

        // F1, F2, F3, ...
        $level = $this->globals->get_service($item['level_id']);
        $PHPExcel->getActiveSheet()->setCellValue('F' . $rowNumber, $level['name']);

        //link tracking
        $PHPExcel->getActiveSheet()->setCellValue('G' . $rowNumber, $level['link_tracking']);

        //
        $service = $this->globals->get_service($item['service_id']);
        $PHPExcel->getActiveSheet()->setCellValue('H' . $rowNumber, $service['name']);

        //marketer
        $marketer = $this->globals->get_user($item['marketer_id']);
        $PHPExcel->getActiveSheet()->setCellValue('I' . $rowNumber, $marketer['fullname']);

        //source
        $source = $this->globals->get_source($item['source_id']);
        $PHPExcel->getActiveSheet()->setCellValue('J' . $rowNumber, $source['name']);

        //status
        $status = ($item['status'] == 1)?'Chưa xuất kho':'Đã Xuất kho';
        $PHPExcel->getActiveSheet()->setCellValue('K' . $rowNumber, $status);

        //telesale
        $telesale = $this->globals->get_user($item['telesale_id']);
        $PHPExcel->getActiveSheet()->setCellValue('L' . $rowNumber, $telesale['fullname']);



        //===========================================================
        //them meta  value
        if(@$list_attr_customers){
            $col_content = 12;
            foreach ($list_attr_customers as $attr){
                //lay du lieu
                @$meta_customer = $this->globals->get_meta_value_customers($attr['key'], $item['id']);
                //kiem tra  co gia tri hay khong
                if(@$meta_customer){
                    $PHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col_content, $rowNumber, $meta_customer);
                }else{
                    $PHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col_content, $rowNumber, "");
                }

                //tang col
                $col_content++;


            }
        }
//        //end meta  value

        // Tăng row lên để khỏi bị lưu đè
        $rowNumber++;
        $index++;
    }


}


// Bước 8: Khởi tạo đối tượng Writer
$objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
ob_end_clean();
// Bước 9: Trả file về cho client download
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="danh_sach_khach_hang.xlsx"');
header('Cache-Control: max-age=0');

if (isset($objWriter)) {
    $objWriter->save('php://output');
}

?>