<?php
Class Auth extends CI_Controller{
    protected  $_data;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Mauth');
        $this->load->model('Musers');
        $this->load->library('Globals');
    }

    /*
     * login
     */
    public function login(){
        $this->_data['page_title'] = 'Đăng nhập hệ thống';

        $this->form_validation->set_rules("email", "Email", "required|valid_email|trim");
        $this->form_validation->set_rules("password", "Mật khẩu", "required|trim");

        if ($this->form_validation->run() == TRUE)
        {
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));

            if ($this->Mauth->check_login($email, $password))
            {
                $user_info = $this->Mauth->get_user_info($email);
                $this->session->set_userdata('user_login', $email);
                $this->session->set_userdata('user_login_id', $user_info['id']);
                $this->session->set_userdata('user_login_name', $user_info['fullname']);
                $this->session->set_userdata('user_login_url', base_url());
                //redirect home
                redirect('home/index');
            }
            else
            {
                $this->session->set_flashdata('msg_login_warning', 'Tên đăng nhập hoặc mật khẩu không chính xác. Vui lòng đăng nhập lại.');
            }

        }
        //view
        $this->load->view('auth/login.php', $this->_data);

    }

    /*
     * logout
     */
    public function logout(){
        $this->session->unset_userdata('user_login');
        redirect('auth/login');
    }

    /*
     * forgot password
     *
     */
    public function forgot(){
        $this->_data['page_title'] = 'Quên mật khẩu';
        //check email
        if($this->input->post()){
            $this->form_validation->set_rules('email', 'Địa chỉ Email', 'required|valid_email');

            if($this->form_validation->run()){
                $email = $this->input->post('email');
                if($this->Musers->check_email($email)){
                    $forgot_code = uniqid();
                    $forgot_code_md5 = md5($forgot_code);
                    $data_forgot = array(
                        'password' => $forgot_code_md5
                    );

                    $this->session->set_flashdata('msg_forgot_success', 'Chúng tôi đã gửi 1 email kích hoạt tới email <b>'.$email.'</b>');

                    $subject = "PozaaTea - Khôi phục mật khẩu";

                    $content = "<p>Chào bạn, </p>";
                    $content.= "<p>Cảm ơn bạn đã đăng ký tài khoản tại Đây. Đây là mật khẩu mới của bạn:</p>";
                    $content.= "<p>$forgot_code</p>";
                    $content.= "<p>Support Team</p>";

                    //gui email
                    $this->globals->sendMail('balongfpt@gmail.com', $subject, $content);
                    //cap nhat mật khẩu
                    $this->Musers->update_forgot_code($email, $data_forgot);
                }else{
                    $this->session->set_flashdata('msg_forgot_warning', '<b>'.$email.'</b> Không tồn tại trong hệ thống');
                }
            }
        }


        $this->load->view('auth/forgot.php', $this->_data);
    }
}
?>