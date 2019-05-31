<?php
Class Services extends CI_Controller{
    protected  $_data;

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('Mservices');
        $this->load->model('Musers');
        $this->load->library('Globals');
    }


    /*
    * index
    */
    public function index(){
        $this->_data['page_title'] = 'Quản lý dịch vụ';

        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //hien thi danh sach
        $list_services = $this->Mservices->get_all_services();
        $this->_data['list_services'] = $list_services;

        //view
        $this->load->view('services/index', $this->_data);
    }

    /*
     * add
     */
    public function add(){

        $this->_data['page_title'] = 'Thêm mới dịch vụ';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //thuc hien add
        if($this->input->post()){
            $this->form_validation->set_rules('name', 'Tên dịch vụ', 'required');
            $this->form_validation->set_rules('fee', 'Phí dịch vụ', 'required|numeric');
            //$this->form_validation->set_rules('description', 'Mô tả', 'required');

            if($this->form_validation->run()){
                $name = $this->input->post('name');
                $fee = $this->input->post('fee');
                $description = $this->input->post('description');

                $create_at = date('Y-m-d', time());

                $data_insert = array(
                    'name' => $name,
                    'fee' => $fee,
                    'description' => ($description)?$description:'',
                    'create_at' =>$create_at

                );
                //thuc hien
                $insert_id = $this->Mservices->insert($data_insert);
                if(!empty($insert_id)){
                    $this->session->set_flashdata('msg_services_success', 'Thêm mới dịch vụ thành công');

                    //redirect
                    redirect(base_url().'services/index');
                }else{
                    $this->session->set_flashdata('msg_services_error', 'Thêm mới dịch vụ chưa thành công');
                }
            }
        }

        //view
        $this->load->view('services/add.php', $this->_data);
    }


    /*
     * edit
     */
    public function edit(){
        $this->_data['page_title'] = 'Cập nhật dịch vụ';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        //hien thi thong tin chinh sua
        $id = intval($this->uri->rsegment(3));
        if($id){
            $info_group = $this->Mservices->get_service($id);
            $this->_data['info'] = $info_group;
        }


        //thuc hien cap nhat
        if($this->input->post()){
            $this->form_validation->set_rules('name', 'Tên dịch vụ', 'required');
            $this->form_validation->set_rules('fee', 'phí dịch vụ', 'required|numeric');
            //$this->form_validation->set_rules('description', 'Mô tả', 'required');

            if($this->form_validation->run()){
                $name = $this->input->post('name');
                $fee = $this->input->post('fee');
                $description = $this->input->post('description');
                $update_at = date('Y-m-d', time());

                $data_insert = array(
                    'name' => $name,
                    'fee' => $fee,
                    'description' => ($description)?$description:'',
                    'update_at' =>$update_at

                );
                //thuc hien
                if($this->Mservices->update($id, $data_insert)){
                    $this->session->set_flashdata('msg_services_success', 'Cập nhật dịch vụ thành công');

                    //redirect
                    redirect(base_url().'services/index');
                }else{
                    $this->session->set_flashdata('msg_services_error', 'Cập nhật dịch vụ chưa thành công');
                }
            }
        }


        $this->load->view('services/edit', $this->_data);

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
            if($this->Mservices->delete($id)){
                $this->session->set_flashdata('msg_services_success', 'Xóa thành công dữ liệu');
                //redirect
                redirect(base_url().'services/index');
            }else{
                $this->session->set_flashdata('msg_services_error', 'Xóa chưa thành công dữ liệu');
                redirect(base_url().'services/index');
            }
        }

    }


}
?>