
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Import_Excel extends CI_Controller {
    protected  $_data;

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('Musers');
        $this->load->library('Globals');
        $this->load->model('Mimport_excel');
    }


    public function index(){
        $this->_data['page_title'] = 'Import dữ liệu';

        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        $this->load->view('import_excel/index',$this->_data);
    }
    public function uploadData(){

        $this->_data['page_title'] = 'Import dữ liệu';

        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        if ($this->input->post('submit')) {

            $path = 'uploads/';
            require_once APPPATH . "/libraries/PHPExcel.php";
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls';
            $config['remove_spaces'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('uploadFile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
            }
            if(empty($error)){
                if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                } else {
                    $import_xls_file = 0;
                }
                $inputFileName = $path . $import_xls_file;

                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    $flag = true;
                    $i=0;
                    foreach ($allDataInSheet as $value) {
                        if($flag){
                            $flag =false;
                            continue;
                        }
                        $data_import[$i]['name'] = $value['A'];
                        $data_import[$i]['email'] = $value['B'];
                        $data_import[$i]['phone'] = (!empty($value['C']))?'0'.$value['C']:'';
                        $data_import[$i]['phone2'] = (!empty($value['D']))?'0'.$value['C']:'';
                        $data_import[$i]['address'] = $value['E'];
                        $data_import[$i]['link_tracking'] = $value['F'];
                        //default value custom
                        $data_import[$i]['status'] = 1;
                        $data_import[$i]['level_id'] = 0;
                        $data_import[$i]['create_at'] = date('Y-m-d',time());
                        $data_import[$i]['marketer_id'] = $user_info['id'];
                        $i++;
                    }

                //thuc hien overview du lieu truoc khi import
                $this->_data['data_import'] = $data_import;
                //thuc hien import data
                    if($this->Mimport_excel->importData($data_import)){
                        $this->session->set_flashdata('msg_import_success','Đã import dữ liệu thành công!');
                    }else{
                        $this->session->set_flashdata('msg_import_error','Import dữ liệu chưa thành công!');
                    }
                } catch (Exception $e) {
                    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' .$e->getMessage());
                }
            }else{
                echo $error['error'];
            }


        }
        $this->load->view('import_excel/index', $this->_data);
    }


}
?>
