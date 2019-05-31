<?php
Class Groups extends CI_Controller{
    protected  $_data;

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('Mgroups');
        $this->load->model('Musers');
        $this->load->library('Globals');
    }


    /*
    * index
    */
    public function index(){
        $this->_data['page_title'] = 'Quản lý nhóm người dùng';

        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //hien thi danh sach nhom
        $list_groups = $this->Mgroups->get_all_groups();
        $this->_data['list_groups'] = $list_groups;

        //view
        $this->load->view('groups/index', $this->_data);
    }

    /*
     * add
     */
    public function add(){

        $this->_data['page_title'] = 'Thêm mới nhóm người dùng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //thuc hien add
        if($this->input->post()){
            $this->form_validation->set_rules('name', 'Tên nhóm', 'required');
            //$this->form_validation->set_rules('description', 'Mô tả', 'required');

            if($this->form_validation->run()){
                $name = $this->input->post('name');
                $description = $this->input->post('description');

                $create_at = date('Y-m-d', time());

                $data_insert = array(
                    'name' => $name,
                    'description' => ($description)?$description:'',
                    'create_at' =>$create_at

                );
                //thuc hien
                $insert_id = $this->Mgroups->insert($data_insert);
                if(!empty($insert_id)){
                    $this->session->set_flashdata('msg_groups_success', 'Thêm mới nhóm thành công');

                    //redirect
                    redirect(base_url().'groups/index');
                }else{
                    $this->session->set_flashdata('msg_groups_error', 'Thêm mới nhóm chưa thành công');
                }
            }
        }

        //view
        $this->load->view('groups/add.php', $this->_data);
    }


    /*
     * edit
     */
    public function edit(){
        $this->_data['page_title'] = 'Cập nhật nhóm người dùng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        //hien thi thong tin chinh sua
        $id = intval($this->uri->rsegment(3));
        if($id){
            $info_group = $this->Mgroups->get_group($id);
            $this->_data['info'] = $info_group;
        }


        //thuc hien cap nhat
        if($this->input->post()){
            $this->form_validation->set_rules('name', 'Tên nhóm', 'required');
            //$this->form_validation->set_rules('description', 'Mô tả', 'required');

            if($this->form_validation->run()){
                $name = $this->input->post('name');
                $description = $this->input->post('description');
                $update_at = date('Y-m-d', time());

                $data_insert = array(
                    'name' => $name,
                    'description' => ($description)?$description:'',
                    'update_at' =>$update_at

                );
                //thuc hien
                if($this->Mgroups->update($id, $data_insert)){
                    $this->session->set_flashdata('msg_groups_success', 'Cập nhật nhóm người dùng thành công');

                    //redirect
                    redirect(base_url().'groups/index');
                }else{
                    $this->session->set_flashdata('msg_groups_error', 'Cập nhật nhóm người dùng chưa thành công');
                }
            }
        }


        $this->load->view('groups/edit', $this->_data);

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
            if($this->Mgroups->check_user($id)){
                if($this->Mgroups->delete($id)){
                    $this->session->set_flashdata('msg_groups_success', 'Xóa thành công dữ liệu');
                    //redirect
                    redirect(base_url().'groups/index');
                }else{
                    $this->session->set_flashdata('msg_groups_error', 'Xóa chưa thành công dữ liệu');
                    redirect(base_url().'groups/index');
                }
            }else{
                $this->session->set_flashdata('msg_groups_error', 'Có người dùng thuộc nhóm, bạn phải xóa người dùng trước!');
                redirect(base_url().'groups/index');
            }
        }

    }


}
?>