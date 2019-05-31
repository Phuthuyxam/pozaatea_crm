<?php
Class Users extends CI_Controller{
    protected $_data;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Musers');
        $this->load->model('Mgroups');
        $this->load->library('Globals');
    }

    public function index()
    {
        $this->_data['page_title'] = 'Danh sách người dùng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //hien thi danh sach
        $list_users = $this->Musers->get_all_users();
        if($list_users){
            $this->_data['list_users'] = $list_users;
        }


        $this->load->view('users/index.php', $this->_data);
    }

    /*
     * add
     */
    public function add(){
        $this->_data['page_title'] = 'Thêm mới người dùng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //thuc hien them
        if($this->input->post()){
            //kiem tra loi

            $this->form_validation->set_rules("email","Email","required|trim|valid_email|is_unique[users.email]");
            $this->form_validation->set_rules("fullname","Họ tên","required|trim");
            $this->form_validation->set_rules("phone","Số điện thoại","required|min_length[10]");
            $this->form_validation->set_rules("group_id","Nhóm tài khoản","required|callback_check_group_id");
            $this->form_validation->set_message('check_group_id',"Vui lòng chọn nhóm tài khoản");

            $this->form_validation->set_rules("password","Mật khẩu","required|min_length[6]");
            $this->form_validation->set_rules("confirm_password","Xác nhận mật khẩu","required|matches[password]");


            if($this->form_validation->run() == true){
                $email = $this->input->post("email");
                $fullname = $this->input->post("fullname");
                $phone = $this->input->post("phone");
                $group_id = $this->input->post("group_id");
                $is_sale = $this->input->post("is_sale");
                $password = md5($this->input->post("password"));
                $creat_at = date('Y-m-d', time());

                $data_insert = array(
                    'email' => $email,
                    'fullname' => $fullname,
                    'phone' => $phone,
                    'group_id' => $group_id,
                    'is_sale' => $is_sale,
                    'password' => $password,
                    'create_at' => $creat_at,
                );

                //thuc hien cap nhat du lieu
                $insert_id = $this->Musers->insert($data_insert);
                if (!empty($insert_id)){
                    $this->session->set_flashdata("msg_users_success","Thêm mới người dùng thành công!");
                    //thuc hien them du lieu meta_users

                    //reidrect
                    redirect(base_url().'users/index');
                }else{
                    $this->session->set_flashdata("msg_users_error","Thêm mới người dùng chưa thành công!");
                }

            }
        }

        //view
        $this->load->view('users/add.php', $this->_data);
    }


    /*
     * ham check group_id
     */
    public function check_group_id($group_id){
        if($group_id == '0'){
            return false;
        }else{
            return true;
        }
    }


    /*
     * edit user
     */
    public function edit(){
        $this->_data['page_title'] = 'Chỉnh sửa người dùng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //hien thi thong tin chinh sua
        $id = intval($this->uri->rsegment(3));
        $info_user = $this->Musers->get_user($id);
        $this->_data['info'] = $info_user;

        //thuc hien them
        if($this->input->post()){
            //kiem tra loi
            $this->form_validation->set_rules("email","Email","required|trim|valid_email|callback_check_email_by_edit");
            $this->form_validation->set_message('check_email_by_edit',"Email đã tồn tại trong hệ thống");
            $this->form_validation->set_rules("fullname","Họ tên","required|trim");
            $this->form_validation->set_rules("phone","Số điện thoại","required|min_length[10]");
            $this->form_validation->set_rules("group_id","Nhóm tài khoản","required|callback_check_group_id");
            $this->form_validation->set_message('check_group_id',"Vui lòng chọn nhóm tài khoản");

            //check  pass neu nhap thi moi kiem tra
            if($this->input->post('password')){
                $this->form_validation->set_rules("password","Mật khẩu","required|min_length[6]");
                $this->form_validation->set_rules("confirm_password","Xác nhận mật khẩu","required|matches[password]");

            }


            if($this->form_validation->run() == true){

                $email = $this->input->post("email");
                $fullname = $this->input->post("fullname");
                $phone = $this->input->post("phone");
                $group_id = $this->input->post('group_id');
                $is_sale = $this->input->post('is_sale');
                $update_at = date('Y-m-d', time());

                $data_insert = array(
                    'email' => $email,
                    'fullname' => $fullname,
                    'phone' => $phone,
                    'group_id' => $group_id,
                    'is_sale' => $is_sale,
                    'update_at' => $update_at,
                );
                if(!empty($this->input->post("password"))){
                    $data_insert['password'] = md5($this->input->post("password"));
                }

                //thuc hien cap nhat du lieu
                if ($this->Musers->update($id, $data_insert)){

                    $this->session->set_flashdata("msg_users_success","Cập nhật người dùng thành công!");

                    redirect(base_url().'users/index');
                }else{
                    $this->session->set_flashdata("msg_users_error","Cập nhật người dùng chưa thành công!");
                }

            }
        }

        //view
        $this->load->view('users/edit.php', $this->_data);
    }

    /*
     * check email by edit user
     */
    public function check_email_by_edit($email){
        $id = intval($this->uri->rsegment(3));
        if($this->Musers->check_email_by_edit($email, $id) == true){
            return true;
        }else{
            return false;
        }
    }


    /*
     * delete user
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
            if($this->Musers->delete($id, $email)){
                $this->session->set_flashdata('msg_users_success', 'Xóa thành công dữ liệu');

                //redirect
                redirect(base_url().'users/index');
            }else{
                $this->session->set_flashdata('msg_users_error', 'Xóa chưa thành công dữ liệu');
                redirect(base_url().'users/index');
            }
        }

    }

    /*
     * profile
     */
    public function profile(){
        $this->_data['page_title'] = 'Thông tin cá nhân';
        //hien thi thong tin chinh sua
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['info'] = $user_info;


        //thuc hien cap nhat thong tin
        if($this->input->post()){
            //kiem tra loi

            $this->form_validation->set_rules("email","Email","required|trim|valid_email|callback_check_email_profile");
            $this->form_validation->set_message('check_email_profile',"Email đã tồn tại trong hệ thống");

            $this->form_validation->set_rules("phone","Số điện thoại","required|min_length[10]");
            $this->form_validation->set_rules("fullname","Họ tên","required|trim");


            //check  pass neu nhap thi moi kiem tra
            if($this->input->post('password')){
                $this->form_validation->set_rules("password","Mật khẩu","required|min_length[6]");
                $this->form_validation->set_rules("confirm_password","Xác nhận mật khẩu","required|matches[password]");

            }


            if($this->form_validation->run() == true){

                $email = $this->input->post("email");
                $phone = $this->input->post("phone");
                $fullname = $this->input->post("fullname");

                $update_at = date('Y-m-d', time());

                $data_insert = array(
                    'email' => $email,
                    'phone' => $phone,
                    'fullname' => $fullname,
                    'update_at' => $update_at

                );
                if(!empty($this->input->post("password"))){
                    $data_insert['password'] = md5($this->input->post("password"));
                }

                //thuc hien cap nhat du lieu
                if ($this->Musers->update($user_info['id'], $data_insert)){
                    $this->session->set_flashdata("msg_users_success","Cập nhật thông tin thành công!");

                }else{
                    $this->session->set_flashdata("msg_users_error","Cập nhật thông tin chưa thành công!");
                }

            }
        }

        //view
        $this->load->view('users/profile.php', $this->_data);
    }

    /*
     * ham check email
     */

    public function check_email_profile($email_profile){
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        if($this->Musers->check_email_by_edit($user_info['id'], $email_profile) == true){
            return true;
        }else{
            return false;
        }
    }


    /*
     * get api
     */
    public function get_api(){
        $this->_data['page_title'] = 'Lấy thông tin API';
        $login = $this->session->get_userdata();
        $username = $login['user_login'];
        $user_info = $this->Musers->get_user_info($username);
        $this->_data['user_info'] = $user_info;

        if($this->input->post()){
                $this->form_validation->set_rules('api_secret','Mã secret api','required|trim');

                if($this->form_validation->run() == true){
                    $api_secret = $this->input->post('api_secret');
                    $api_key = $user_info['username'];
                    $data = array(
                        'api_secret' => $api_secret
                    );

                    //thuc hien

                    if($this->Musers->update($user_info['id'], $data)){
                        $this->_data['api_key'] = $api_key;
                        $this->_data['api_secret'] = $api_secret;
                        $this->session->set_flashdata('msg_api_success','Tạo thành công mã API');
                    }else{
                        $this->session->set_flashdata('msg_api_error','Quá trình tạo API có lỗi!');
                    }

                }
        }

        //view
        $this->load->view('users/api.php', $this->_data);

    }


}
?>