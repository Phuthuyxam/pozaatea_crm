<?php
Class Channel extends CI_Controller{
    protected  $_data;

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('Mchannel');
        $this->load->model('Musers');
        $this->load->library('Globals');
    }


    /*
    * index
    */
    public function index(){
        $this->_data['page_title'] = 'Quản lý kênh khách hàng';

        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //hien thi danh sach nhom
        $list_channel = $this->Mchannel->get_all_channel();
        $this->_data['list_channel'] = $list_channel;

        //view
        $this->load->view('channel/index', $this->_data);
    }

    /*
     * add
     */
    public function add(){

        $this->_data['page_title'] = 'Thêm mới kênh khách hàng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //thuc hien add
        if($this->input->post()){
            $this->form_validation->set_rules('name', 'Tên kênh', 'required');
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
                $insert_id = $this->Mchannel->insert($data_insert);
                if(!empty($insert_id)){
                    $this->session->set_flashdata('msg_channel_success', 'Thêm mới kênh thành công');

                    //redirect
                    redirect(base_url().'channel/index');
                }else{
                    $this->session->set_flashdata('msg_channel_error', 'Thêm mới kênh chưa thành công');
                }
            }
        }

        //view
        $this->load->view('channel/add.php', $this->_data);
    }


    /*
     * edit
     */
    public function edit(){
        $this->_data['page_title'] = 'Cập nhật kênh khách hàng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        //hien thi thong tin chinh sua
        $id = intval($this->uri->rsegment(3));
        if($id){
            $info_group = $this->Mchannel->get_channel($id);
            $this->_data['info'] = $info_group;
        }


        //thuc hien cap nhat
        if($this->input->post()){
            $this->form_validation->set_rules('name', 'Tên kênh', 'required');
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
                if($this->Mchannel->update($id, $data_insert)){
                    $this->session->set_flashdata('msg_channel_success', 'Cập nhật kênh thành công');

                    //redirect
                    redirect(base_url().'channel/index');
                }else{
                    $this->session->set_flashdata('msg_channel_error', 'Cập nhật kênh chưa thành công');
                }
            }
        }


        $this->load->view('channel/edit', $this->_data);

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
            if($this->Mchannel->delete($id)){
                $this->session->set_flashdata('msg_channel_success', 'Xóa thành công dữ liệu');
                //redirect
                redirect(base_url().'channel/index');
            }else{
                $this->session->set_flashdata('msg_channel_error', 'Xóa chưa thành công dữ liệu');
                redirect(base_url().'channel/index');
            }
        }

    }


}
?>