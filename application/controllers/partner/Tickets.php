<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller {

    protected $_data = array();
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Mcustomers');
        $this->load->model('Mtickets');
        $this->load->model('Musers');
        $this->load->library('Globals');
    }

    
    public function create(){
        
        $this->_data['page_title'] = "Tạo yêu cầu";
        $login = $this->session->get_userdata();
        $email = $login['customer_login'];
        $user_info = $this->Mcustomers->get_customer($login['customer_login_id']);
        $this->_data['user_info'] = $user_info;
        $customer_id = $user_info['id'];
        if($this->input->post()){
            $this->form_validation->set_rules("ticket_title","Tiêu đề yêu cầu","required|trim");
            $this->form_validation->set_rules("ticket_content","Nội dung yêu cầu","required|trim");
            $this->form_validation->set_rules("department","Phòng ban hỗ trợ","required");
            if($this->form_validation->run() == true){

                $title = $this->input->post('ticket_title');
                $content = $this->input->post('ticket_content');
                $department = $this->input->post('department');
                $create_at = date('Y-m-d', time());

                $insert_arr = array(
                    'title' => $title,
                    'content' => $content,
                    'customer_id' => $customer_id,
                    'department' => $department,
                    'status' => 0,
                    'parent_id' => 0,
                    'create_at' => $create_at
                );

                //thuc hien cap nhat du lieu
                $insert_id = $this->Mtickets->insert($insert_arr);
                if (!empty($insert_id)){
                    $this->session->set_flashdata("msg_users_success","Thêm yêu cầu thành công!");
                    //thuc hien them du lieu meta_users

                    //reidrect
                    redirect(base_url().'partner');
                }else{
                    $this->session->set_flashdata("msg_users_error","Thêm mới yêu cầu chưa thành công!");
                }

            }
        }

        $this->load->view('partner/tickets/index',$this->_data);

    }

    public function view(){
        $this->_data['page_title'] = "Yêu cầu đã gửi";
        $login = $this->session->get_userdata();
        $email = $login['customer_login'];
        $user_info = $this->Mcustomers->get_customer($login['customer_login_id']);
        $this->_data['user_info'] = $user_info;
        $customer_id = $user_info['id'];

        $all_ticket_by_customer = $this->Mtickets->get_all_tickets_by_customer_id($customer_id);
        $this->_data['all_ticket'] = $all_ticket_by_customer;


        $parent_id = $this->globals->get_last_child_ticket($customer_id);
        if($this->input->post()){
            $this->form_validation->set_rules("mess","Nội dung trả lời","required|trim");

            if($this->form_validation->run() == true){

                $mess_info = $this->input->post();
                $mess = $mess_info['mess'];
                $ticket_info = $this->Mtickets->get_tickets_by_customer_id($customer_id);
                $create_at = date('Y-m-d', time());
                $insert_arr = array(
                    'title' => $ticket_info['title'],
                    'content' => $mess,
                    'customer_id' => $customer_id,
                    'department' => $ticket_info['department'],
                    'parent_id' => $parent_id,
                    'create_at' => $create_at,
                );

               $new_id = $this->Mtickets->insert($insert_arr);

                if($new_id){
                    //  sau khi trả lời update trạng thái của bình luận
                    $update_arr = array(
                        'status' => 0,
                    );

                    $this->Mtickets->update($ticket_info['id'],$update_arr);
                    unset($_POST);
                    
                    redirect('partner/tickets/view','refresh');
                    

                }
            
            }

        }

        $this->load->view('partner/tickets/view', $this->_data);
        
    }

}

/* End of file Controllername.php */

?>