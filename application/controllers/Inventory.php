<?php
class Inventory extends CI_Controller
{
    protected $_data;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Musers');
        $this->load->model('Mcustomers');
        $this->load->model('Minventory');
        $this->load->library('Globals');
    }

    public function index()
    {
        $this->_data['page_title'] = 'Danh sách hàng tồn kho - Admin';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //hien thi danh sach
        $list_inventory = $this->Minventory->get_all_inventory();
        $this->_data['list_inventory'] = $list_inventory;
        //view
        $this->load->view('inventory/index', $this->_data);
    }


}
?>