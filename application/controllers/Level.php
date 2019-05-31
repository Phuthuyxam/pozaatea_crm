<?php
Class Level extends CI_Controller{
    protected  $_data;

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('Mlevel');
        $this->load->model('Musers');
        $this->load->model('Mcustomers');
        $this->load->library('Globals');
    }


    /*
    * index
    */
    public function index(){
        $this->_data['page_title'] = 'Quản lý Cấp độ khách hàng';

        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //hien thi danh sach
        $list_level = $this->Mlevel->get_all_level();
        $this->_data['list_level'] = $list_level;

        //view
        $this->load->view('level/index', $this->_data);
    }

    /*
     * add
     */
    public function add(){

        $this->_data['page_title'] = 'Thêm mới Cấp độ khách hàng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //thuc hien add
        if($this->input->post()){
            $this->form_validation->set_rules('name', 'Tên cấp độ', 'required');

            if($this->form_validation->run()){
                $name = $this->input->post('name');

                $create_at = date('Y-m-d', time());

                $data_insert = array(
                    'name' => $name,
                    'create_at' =>$create_at

                );
                //thuc hien
                $insert_id = $this->Mlevel->insert($data_insert);
                if(!empty($insert_id)){
                    $this->session->set_flashdata('msg_level_success', 'Thêm mới cấp độ thành công');

                    //redirect
                    redirect(base_url().'level/index');
                }else{
                    $this->session->set_flashdata('msg_level_error', 'Thêm mới cấp độ chưa thành công');
                }
            }
        }

        //view
        $this->load->view('level/add.php', $this->_data);
    }


    /*
     * edit
     */
    public function edit(){
        $this->_data['page_title'] = 'Cập nhật cấp độ khách hàng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        //hien thi thong tin chinh sua
        $id = intval($this->uri->rsegment(3));
        if($id){
            $info_group = $this->Mlevel->get_level($id);
            $this->_data['info'] = $info_group;
        }


        //thuc hien cap nhat
        if($this->input->post()){
            $this->form_validation->set_rules('name', 'Tên cấp độ', 'required');
            //$this->form_validation->set_rules('description', 'Mô tả', 'required');

            if($this->form_validation->run()){
                $name = $this->input->post('name');
                $update_at = date('Y-m-d', time());

                $data_insert = array(
                    'name' => $name,
                    'update_at' =>$update_at

                );
                //thuc hien
                if($this->Mlevel->update($id, $data_insert)){
                    $this->session->set_flashdata('msg_level_success', 'Cập nhật cấp độ thành công');

                    //redirect
                    redirect(base_url().'level/index');
                }else{
                    $this->session->set_flashdata('msg_level_error', 'Cập nhật cấp độ chưa thành công');
                }
            }
        }


        $this->load->view('level/edit', $this->_data);

    }


    /*
     * delete
     */
    public function del(){
        //kiem tra login
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        //check group permission
        $arr_permission_check = $this->globals->get_group_permission($user_info['group_id'], 'setup');

        if(in_array("del", $arr_permission_check) == false) {
            redirect('home/index');
        }
        // end check permission group -->

        if($login){
            $id = intval($this->uri->rsegment(3));
            //check level_id in customers
            if($this->Mcustomers->check_before_delete(array('level_id' => $id))){
                if($this->Mlevel->delete($id)){
                    $this->session->set_flashdata('msg_level_success', 'Xóa thành công dữ liệu');
                    //redirect
                    redirect(base_url().'level/index');
                }else{
                    $this->session->set_flashdata('msg_level_error', 'Xóa chưa thành công dữ liệu');
                    redirect(base_url().'level/index');
                }
            }else{
                $this->session->set_flashdata('msg_level_error', 'Level đang được sử dụng. không được xóa');
                redirect(base_url().'level/index');
            }
        }

    }


}
?>