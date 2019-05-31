<?php
Class status_care extends CI_Controller{
    protected  $_data;

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('Mstatus_care');
        $this->load->model('Musers');
        $this->load->library('Globals');
    }


    /*
    * index
    */
    public function index(){
        $this->_data['page_title'] = 'Quản lý trạng thái chăm sóc';

        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //hien thi danh sach
        $list_status_care = $this->Mstatus_care->get_all_status_care();
        $this->_data['list_status_care'] = $list_status_care;

        //view
        $this->load->view('status_care/index', $this->_data);
    }

    /*
     * add
     */
    public function add(){

        $this->_data['page_title'] = 'Thêm mới trạng thái chăm sóc';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //thuc hien add
        if($this->input->post()){
            $this->form_validation->set_rules('name', 'Tên trạng thái', 'required');

            if($this->form_validation->run()){
                $name = $this->input->post('name');

                $create_at = date('Y-m-d', time());

                $data_insert = array(
                    'name' => $name,
                    'create_at' =>$create_at

                );
                //thuc hien
                $insert_id = $this->Mstatus_care->insert($data_insert);
                if(!empty($insert_id)){
                    $this->session->set_flashdata('msg_status_care_success', 'Thêm mới trạng thái thành công');

                    //redirect
                    redirect(base_url().'status_care/index');
                }else{
                    $this->session->set_flashdata('msg_status_care_error', 'Thêm mới trạng thái chưa thành công');
                }
            }
        }

        //view
        $this->load->view('status_care/add.php', $this->_data);
    }


    /*
     * edit
     */
    public function edit(){
        $this->_data['page_title'] = 'Cập nhật trạng thái chăm sóc';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        //hien thi thong tin chinh sua
        $id = intval($this->uri->rsegment(3));
        if($id){
            $info_group = $this->Mstatus_care->get_status_care($id);
            $this->_data['info'] = $info_group;
        }


        //thuc hien cap nhat
        if($this->input->post()){
            $this->form_validation->set_rules('name', 'Tên trạng thái', 'required');
            //$this->form_validation->set_rules('description', 'Mô tả', 'required');

            if($this->form_validation->run()){
                $name = $this->input->post('name');
                $update_at = date('Y-m-d', time());

                $data_insert = array(
                    'name' => $name,
                    'update_at' =>$update_at

                );
                //thuc hien
                if($this->Mstatus_care->update($id, $data_insert)){
                    $this->session->set_flashdata('msg_status_care_success', 'Cập nhật trạng thái thành công');

                    //redirect
                    redirect(base_url().'status_care/index');
                }else{
                    $this->session->set_flashdata('msg_status_care_error', 'Cập nhật trạng thái chưa thành công');
                }
            }
        }


        $this->load->view('status_care/edit', $this->_data);

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
            if($this->Mstatus_care->delete($id)){
                $this->session->set_flashdata('msg_status_care_success', 'Xóa thành công dữ liệu');
                //redirect
                redirect(base_url().'status_care/index');
            }else{
                $this->session->set_flashdata('msg_status_care_error', 'Xóa chưa thành công dữ liệu');
                redirect(base_url().'status_care/index');
            }
        }

    }


}
?>