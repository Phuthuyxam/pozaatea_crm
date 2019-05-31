<?php
Class Sources extends CI_Controller{
    protected  $_data;

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('Msources');
        $this->load->model('Musers');
        $this->load->library('Globals');
    }


    /*
    * index
    */
    public function index(){
        $this->_data['page_title'] = 'Quản lý nguồn khách hàng';

        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //hien thi danh sach
        $list_sources = $this->Msources->get_all_sources();
        $this->_data['list_sources'] = $list_sources;

        //view
        $this->load->view('sources/index', $this->_data);
    }

    /*
     * add
     */
    public function add(){

        $this->_data['page_title'] = 'Thêm mới nguồn khách hàng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //thuc hien add
        if($this->input->post()){
            $this->form_validation->set_rules('name', 'Tên nguồn', 'required');
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
                $insert_id = $this->Msources->insert($data_insert);
                if(!empty($insert_id)){
                    $this->session->set_flashdata('msg_sources_success', 'Thêm mới nguồn thành công');

                    //redirect
                    redirect(base_url().'sources/index');
                }else{
                    $this->session->set_flashdata('msg_sources_error', 'Thêm mới nguồn chưa thành công');
                }
            }
        }

        //view
        $this->load->view('sources/add.php', $this->_data);
    }


    /*
     * edit
     */
    public function edit(){
        $this->_data['page_title'] = 'Cập nhật nguồn khách hàng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        //hien thi thong tin chinh sua
        $id = intval($this->uri->rsegment(3));
        if($id){
            $info_group = $this->Msources->get_source($id);
            $this->_data['info'] = $info_group;
        }


        //thuc hien cap nhat
        if($this->input->post()){
            $this->form_validation->set_rules('name', 'Tên nguồn', 'required');
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
                if($this->Msources->update($id, $data_insert)){
                    $this->session->set_flashdata('msg_sources_success', 'Cập nhật nguồn thành công');

                    //redirect
                    redirect(base_url().'sources/index');
                }else{
                    $this->session->set_flashdata('msg_sources_error', 'Cập nhật nguồn chưa thành công');
                }
            }
        }


        $this->load->view('sources/edit', $this->_data);

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
            if($this->Msources->delete($id)){
                $this->session->set_flashdata('msg_sources_success', 'Xóa thành công dữ liệu');
                //redirect
                redirect(base_url().'sources/index');
            }else{
                $this->session->set_flashdata('msg_sources_error', 'Xóa chưa thành công dữ liệu');
                redirect(base_url().'sources/index');
            }
        }

    }


}
?>