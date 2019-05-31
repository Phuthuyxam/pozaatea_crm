<?php
class Home extends CI_Controller
{
    protected $_data;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
		$this->load->model('Musers');
		$this->load->model('Mcustomers');
        $this->load->library('Globals');
    }

    public function index()
    {
        $this->_data['page_title'] = 'Trang quản trị - Admin';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //hien thi danh sach khach sap khai truong
        $list_customers = $this->Mcustomers->get_all_customers_filter_care();
        $this->_data['list_customers'] = $list_customers;
        //view
        $this->load->view('home/index', $this->_data);
    }


}
?>