<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Shops extends CI_Controller {

    protected $_data;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Mshops');
        $this->load->model('Musers');
        $this->load->model('Mgroups');
        $this->load->model('Mcustomershop');
        $this->load->library('Globals');
    }
    

    public function index()
    {
        $this->_data['page_title'] = 'Danh sách cửa hàng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //hien thi danh sach
        $list_shops = $this->Mshops->get_all_shops();
        if($list_shops){
            $this->_data['list_shops'] = $list_shops;
        }


        $this->load->view('shops/index.php', $this->_data);
    }

    /*
     * add
     */
    public function add(){
        $this->_data['page_title'] = 'Thêm mới cửa hàng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //thuc hien them
        if($this->input->post()){            
            //kiem tra loi

            $this->form_validation->set_rules("shop_name","Tên cửa hàng","required|trim|is_unique[shops.name]");
            $this->form_validation->set_rules("shop_address","Địa chỉ cửa hàng","required|trim");

            if($this->form_validation->run() == true){
                $name = $this->input->post("shop_name");
                $address = $this->input->post("shop_address");
                $creat_at = date('Y-m-d', time());

                $data_insert = array(
                    'name' => $name,
                    'address' => $address,
                    'create_at' => $creat_at,
                );

                //thuc hien cap nhat du lieu
                $insert_id = $this->Mshops->insert($data_insert);
                if (!empty($insert_id)){
                    $this->session->set_flashdata("msg_users_success","Thêm mới cửa hàng thành công!");
                    //thuc hien them du lieu meta_users

                    //reidrect
                    redirect(base_url().'shops/index');
                }else{
                    $this->session->set_flashdata("msg_users_error","Thêm mới cửa hàng chưa thành công!");
                }

            }
        }

        //view
        $this->load->view('shops/add.php', $this->_data);
    }

    /*
     * delete user
     */
    public function del($id){
        //kiem tra login
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        // //check group permission
        $arr_permission_check = $this->globals->get_group_permission($user_info['group_id'], 'setup');

        if(in_array("del", $arr_permission_check) == false) {
            redirect('home/index');
        }
        // end check permission group -->

        if($login){
            $id = intval($this->uri->rsegment(3));
            // check customer in customer _ shop

            $list_customer_of_shop = $this->Mcustomershop->get_by_shop_id($id);

            if(empty($list_customer_of_shop)){
                if($this->Mshops->delete($id)){
                $this->session->set_flashdata('msg_users_success', 'Xóa thành công dữ liệu');

                //redirect
                redirect(base_url().'shops/index');
                }else{
                    $this->session->set_flashdata('msg_users_error', 'Xóa chưa thành công dữ liệu');
                    redirect(base_url().'shops/index');
                }

            }else{      

                $this->session->set_flashdata('msg_users_error', 'Tồn Tại Khách Hàng Thuộc Cửa Hàng. Thực Hiện Xóa Khách Hàng Trước Khi Xóa Cửa Hàng');
                redirect(base_url().'shops/index');
            }
        }
        
    }

    /*
     * edit user
     */
    public function edit(){
        $this->_data['page_title'] = 'Chỉnh sửa cửa hàng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //hien thi thong tin chinh sua
        $id = intval($this->uri->rsegment(3));
        $info_shop = $this->Mshops->get_shop($id);
        $this->_data['info'] = $info_shop;

        //thuc hien them
        if($this->input->post()){
            //kiem tra loi   
            $this->form_validation->set_rules("shop_address","Địa chỉ cửa hàng","required|trim");
            //check neu nhap thi moi kiem tra
            if($this->input->post('shop_name') != $info_shop['name'] ){
                $this->form_validation->set_rules("shop_name","Tên cửa hàng","required|trim|is_unique[shops.name]");
            }



            if($this->form_validation->run() == true){

                $name = $this->input->post("shop_name");
                $address = $this->input->post("shop_address");
                $update_at = date('Y-m-d', time());

                $data_insert = array(
                    'name' => $name,
                    'address' => $address,
                    'update_at' => $update_at,
                );
                //thuc hien cap nhat du lieu
                if ($this->Mshops->update($id, $data_insert)){

                    $this->session->set_flashdata("msg_users_success","Cập nhật cửa hàng thành công!");

                    redirect(base_url().'shops/index');
                }else{
                    $this->session->set_flashdata("msg_users_error","Cập nhật cửa hàng chưa thành công!");
                }

            }
        }

        //view
        $this->load->view('shops/edit.php', $this->_data);
    }


}

/* End of file Controllername.php */


?>