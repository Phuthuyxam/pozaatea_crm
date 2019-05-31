<?php
class Attr_customers extends CI_Controller{
    protected $_data;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
//        $this->load->model('Mcustomers');
        $this->load->model('Mattr_customers');
        $this->load->model('Musers');
        $this->load->library('Globals');
    }

    /*
     * ham index
     */
    public function index(){
        $this->_data['page_title'] = 'Danh sách trường dữ liệu khách hàng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        //hien thi danh sach
        $list_attr_customers = $this->Mattr_customers->get_all_attr_customers();

        if($list_attr_customers){
            $this->_data['list_attr_customers'] = $list_attr_customers;
        }

        //view
        $this->load->view('attr_customers/index', $this->_data);
    }

    /*
     * add
     */
    public function add(){
        $this->_data['page_title'] = 'Thêm trường dữ liệu khách hàng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        if($this->input->post()){
            $this->form_validation->set_rules('name', 'Tên trường', 'required');

            if($this->form_validation->run()){
                $name = $this->input->post('name');
                $key = ($this->input->post('key'))?$this->input->post('key'):$this->globals->to_slug($name);
                $description = ($this->input->post('description'))?$this->input->post('description'):'';
                $create_at = date('Y-m-d', time());

                //kiem tra cac truong attr custom co trung lap voi truong trong bang customers
                //tao mang truong co san
                $allow_type = array(
                    'name', 'email','password', 'phone', 'address', 'level_id', 'link_tracking', 'marketer_id',
                    'source_id', 'status', 'telesale_id','note', 'create_at', 'update_at',
                );

                if(@in_array($key,$allow_type)){
                    $this->session->set_flashdata('msg_attr_customers_error', 'Trường dữ liệu không được phép tạo!');
                    redirect(base_url().'attr_customers/index');
                }else{
                    //neu khong trung lap thi tao moi
                    $data_insert = array(
                        'key' => $key,
                        'name' =>$name,
                        'description' =>$description,
                        'create_at' => $create_at
                    );

                    //kiem tra attr da ton tai chua
                    if($this->Mattr_customers->check_attr_customers_exit($key) == 0 ){
                        $insert_id = $this->Mattr_customers->insert($data_insert);
                        if($insert_id){
                            $this->session->set_flashdata('msg_attr_customers_success', 'Thêm mới dữ liệu thành công!');

                            redirect(base_url().'attr_customers/index');
                        }else{
                            $this->session->set_flashdata('msg_attr_customers_error', 'Thêm mới dữ liệu chưa thành công!');
                            redirect(base_url().'attr_customers/index');
                        }
                    }else{
                        $this->session->set_flashdata('msg_attr_customers_error', 'Trường dữ liệu đã tồn tại!');
                        redirect(base_url().'attr_customers/index');
                    }
                }

            }
        }

        $this->load->view('attr_customers/add', $this->_data);
    }

    /*
     * edit
     */
    public function edit(){
        $this->_data['page_title'] = 'Cập nhật trường dữ liệu khách hàng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        //hien thi thong tin chinh sua
        $id = intval($this->uri->rsegment(3));
        if($id){
            $info = $this->Mattr_customers->get_attr_customer($id);
            $this->_data['info'] = $info;
        }

        //cap nhat
        if($this->input->post()){
            $this->form_validation->set_rules('name', 'Tên trường', 'required');

            if($this->form_validation->run()){
                $name = $this->input->post('name');
                $key = ($this->input->post('key'))?$this->input->post('key'):$this->globals->to_slug($name);
                $description = ($this->input->post('description'))?$this->input->post('description'):'';
                $update_at = date('Y-m-d', time());

                $data_update = array(
                    'key' => $key,
                    'name' =>$name,
                    'description' =>$description,
                    'update_at' => $update_at
                );

                if($this->Mattr_customers->update($id, $data_update)){
                    $this->session->set_flashdata('msg_attr_customers_success', 'Cập nhật dữ liệu thành công!');

                    //redirect
                    redirect(base_url().'attr_customers/index');
                }else{
                    $this->session->set_flashdata('msg_attr_customers_error', 'Cập nhật dữ liệu chưa thành công!');
                    redirect(base_url().'attr_customers/index');
                }

            }
        }

        $this->load->view('attr_customers/edit', $this->_data);
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
        //check permissions del
        $permissions = $this->globals->get_group_permission($user_info['group_id'],'setup');
        if($permissions){
            if(@in_array('del',$permissions)){
                //neu co quyen moi duoc xoa
                //check login
                if($login){
                    //lay id
                    $id = intval($this->uri->rsegment(3));
                    if($id){
                        //thuc hien delete
                        if($this->Mattr_customers->delete($id)){
                            $this->session->set_flashdata('msg_attr_customers_success', 'xóa dữ liệu thành công!');

                            //redirect
                            redirect(base_url().'attr_customers/index');
                        }else{
                            $this->session->set_flashdata('msg_attr_customers_error', 'Xóa dữ liệu chưa thành công!');
                            redirect(base_url().'attr_customers/index');
                        }
                    }
                }
            }else{
                die();
            }
        }



    }

}