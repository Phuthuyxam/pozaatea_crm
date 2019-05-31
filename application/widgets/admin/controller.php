<?php
class Admin_widget extends PVS_Widget
{
    function index()
    {
        $this->load->model('admin/Muser');
        $login = $this->session->get_userdata();
        $user_row = $this->Muser->get_user_info($login['customer_login']);

        $data['user_info'] = $user_row;

        $this->load->view('view', $data);
    }
}
?>