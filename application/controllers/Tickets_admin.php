<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets_admin extends CI_Controller {

    protected $_data = array(); 
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Mtickets');
        $this->load->model('Musers');
        $this->load->library('Globals');     
    }

    public function index()
    {
        $this->_data['page_title'] = 'Danh sách yêu cầu';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        $all_ticket = $this->Mtickets->get_all_tickets();

        $this->_data['all_ticket'] = $all_ticket;
        $this->load->view('ticket-admin/index',$this->_data);
    }

    public function view($id){
        // trả lời tin nhắn theo id 
        $this->_data['page_title'] = 'Chi tiết yêu cầu';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;
        $create_at = date('Y-m-d', time());
        $ticket_id = intval($this->uri->rsegment(3));   
        
        $ticket_info = $this->Mtickets->get_ticket($ticket_id);
        $all_ticket_by_customer = $this->Mtickets->get_all_tickets_by_customer_id($ticket_info['customer_id']);
        $this->_data['all_ticket'] = $all_ticket_by_customer;

        if($this->input->post()){
            $this->form_validation->set_rules("mess","Nội dung trả lời","required|trim");

            if($this->form_validation->run() == true){

                $mess_info = $this->input->post();
                $mess = $mess_info['mess'];

                $insert_arr = array(
                    'title' => 'reply '.$id,
                    'content' => $mess,
                    'customer_id' => $ticket_info['customer_id'],
                    'department' => 0,
                    'user_id' => $user_info['id'],
                    'parent_id' => $id,
                    'create_at' => $create_at,
                );

                $new_id = $this->Mtickets->insert($insert_arr);

                if($new_id){
                    //  sau khi trả lời update trạng thái của bình luận
                    $update_arr = array(
                        'status' => 1,
                    );

                    $this->Mtickets->update($id,$update_arr);
                    unset($_POST);
                
                    redirect('tickets_admin/view/'.$ticket_id);
                    

                }
            }
        }

        $this->load->view('ticket-admin/view', $this->_data);

        
    }

}

/* End of file Controllername.php */


?>