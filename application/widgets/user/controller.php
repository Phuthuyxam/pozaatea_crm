<?php
class User_widget extends PVS_Widget
{
    function index()
    {
        $this->load->model('Muser');
        $login = $this->session->get_userdata();
        $user_row = $this->Muser->get_customer($login['customer_login']);

        $data['user_info'] = $user_row;

        $this->load->view('view', $data);
    }
}
?>