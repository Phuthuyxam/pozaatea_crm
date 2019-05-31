<?php
class Home extends CI_Controller
{
    protected $_data;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('partner/Mauth');
        $this->load->model('partner/Mhome');
        $this->load->library('Globals');
    }

    public function index()
    {
        $this->_data['page_title'] = 'Trang đại lý ủy quyền';
        $login = $this->session->get_userdata();
        $email = $login['customer_login'];
        $customer_info = $this->Mauth->get_customer_info($email);
        $this->_data['customer_info'] = $customer_info;

        //view
        $this->load->view('partner/home/index', $this->_data);
    }

    /*
     * profile
     */
    public function profile(){
        $this->_data['page_title'] = 'Thông tin cá nhân';
        //hien thi thong tin chinh sua
        $login = $this->session->get_userdata();
        $email = $login['customer_login'];
        $customer_info = $this->Mauth->get_customer_info($email);
        $this->_data['info'] = $customer_info;


        //thuc hien cap nhat thong tin
        if($this->input->post()){
            //kiem tra loi


            $this->form_validation->set_rules("phone","Số điện thoại","required|min_length[10]");
            $this->form_validation->set_rules("name","Họ tên","required|trim");


            //check  pass neu nhap thi moi kiem tra
            if($this->input->post('password')){
                $this->form_validation->set_rules("password","Mật khẩu","required|min_length[6]");
                $this->form_validation->set_rules("confirm_password","Xác nhận mật khẩu","required|matches[password]");

            }


            if($this->form_validation->run() == true){

                $phone = $this->input->post("phone");
                $name = $this->input->post("name");


                $data_insert = array(
                    'phone' => $phone,
                    'name' => $name,

                );
                if(!empty($this->input->post("password"))){
                    $data_insert['password'] = md5($this->input->post("password"));
                }

                //thuc hien cap nhat du lieu
                if ($this->Mhome->update($customer_info['id'], $data_insert)){
                    $this->session->set_flashdata("msg_customers_success","Cập nhật thông tin thành công!");
                    //reload page
                    redirect('partner/home/profile');
                }else{
                    $this->session->set_flashdata("msg_customers_error","Cập nhật thông tin chưa thành công!");
                }

            }
        }

        //view
        $this->load->view('partner/home/profile.php', $this->_data);
    }


}
?>