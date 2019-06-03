<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Leades extends CI_Controller {
        
        private $_data;
        public $current_user;
        public function __construct()
        {
            parent::__construct();
            $this->load->helper('url');
            $this->load->library('Globals');
        }
        public function isJson($string) {
            json_decode($string);
            return (json_last_error() == JSON_ERROR_NONE);
        }
        public function insert_leades($md5_customer_id)
        {
            $customer_id = $_SESSION['customer_login_id'];
            $md5 = md5($customer_id);

            if($md5_customer_id == $md5 ){
                // kiểm tra người dùng hợp lệ hay không 
                
                echo '<pre>';
                print_r($data);
                echo '</pre>';

                $data_arr = json_decode($data);

                

                // if(isset($this->input->get('your_name'))){

                // }

                // $data_insert = array(

                    

                // );

            }else{
                echo '<pre>';
                print_r("Bạn không có quyền truy nhập...");
                echo '</pre>';
            }



            
        }
    
    }
    
    /* End of file Controllername.php */
    
?>