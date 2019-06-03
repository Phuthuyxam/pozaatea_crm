<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Leades extends CI_Controller {
        
        private $_data;
        public $current_user;
        public function __construct()
        {
            parent::__construct();
            $this->load->helper('url');
            $this->load->model('Mleades')
            $this->load->library('Globals');
        }
        public function isJson($string) {
            json_decode($string);
            return (json_last_error() == JSON_ERROR_NONE);
        }
        public function insert_leades($md5_customer_id,$customer_id,$your_name,$your_phone,$your_email,$your_content,$shop_id,$status)
        {   
            echo '<pre>';
            print_r("dâdadad");
            echo '</pre>';
            // $customer_id = $_SESSION['customer_login_id'];
            $md5 = md5($customer_id);

            if($md5_customer_id == $md5 ){
                // kiểm tra người dùng hợp lệ hay không 
                // if(isset($_POST)){
                //     if(isset($_POST['data'])){
                        
                //         $data = json_decode($_POST['data']);
                        

                //     }
                // }
                // if(isset($this->input->get('your_name'))){

                // }
                $creat_at = date('Y-m-d', time());
                $data_insert = array(
                    'your_name' => $your_name,
                    'your_phone' => $your_phone,
                    'your_email' => $your_email,
                    'your_content' => $your_content,
                    'shop_id' => $shop_id,
                    'status' => $status,
                    'create_at' => $create_at
                );

                $id = $this->Mleades->insert($data_insert);

                if($id > 0){
                    echo $id;
                }else{
                    echo "Error!";
                }


            }else{
                echo '<pre>';
                print_r("Bạn không có quyền truy nhập...");
                echo '</pre>';
            }



            
        }
    
    }
    
    /* End of file Controllername.php */
    
?>