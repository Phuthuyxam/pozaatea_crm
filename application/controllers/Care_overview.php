<?php
class Care_overview extends CI_Controller{
    protected $_data;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Musers');
        $this->load->model('Mcustomers');
        $this->load->model('Msales_overview');
        $this->load->model('Mcare_detail');
        $this->load->model('Mcare_overview');
        $this->load->model('Mcare_detail');
        $this->load->model('Maccountant_overview');
        $this->load->model('Maccountant_detail');
        $this->load->model('Mdesign_overview');
        $this->load->model('Mdesign_detail');
        $this->load->model('Msupport_overview');
        $this->load->model('Msupport_detail');
        $this->load->model('Mattr_customers');
        $this->load->model('Mmeta_customers');
        $this->load->library('Globals');
    }


    /*
     * ham index
     */
    public function index(){
        $this->_data['page_title'] = 'Danh sách khách hàng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        //hien thi danh sach attr_customers de cai dat
        $list_attr_customers = $this->Mattr_customers->get_all_attr_customers();

        //cai dat truong tuy chinh attr_customers theo user_id
        if(isset($_POST['submit_attr'])){

            //lay mang du lieu nguoi dung chon
            //kiem tra xem du lieu nguoi dung co chon hay khong
            $arr_attr_customers_show = array();
            if(!empty($_POST['attr_customers_show'])){
                @$arr_attr_customers_show = $_POST['attr_customers_show'];
            }

            //$arr_user_id = array();
            foreach ($list_attr_customers as $attr){
                //lay id attr_Agency
                $attr_id = $attr['id'];
                //kiem tra xem truong attr_Agency duoc chon
                if(in_array($attr_id, $arr_attr_customers_show)){
                    //neu ton tai thi goi mang user_id ra & cap nhat them
                    $row_show = $this->Mattr_customers->get_attr_customer($attr_id);
                    $arr_user_id = json_decode($row_show['user_id'], true);

                    //check xem user_id da ton tai chua
                    if(!in_array($user_info['id'],  $arr_user_id)){
                        $arr_user_id[] = $user_info['id'];
                    }
//                    echo '<pre>';
//                    print_r($arr_user_id);
                    $data_json = array(
                        'user_id' => json_encode($arr_user_id)
                    );
                    //luu lai thong tin
                    $this->Mattr_customers->update($attr_id, $data_json);
                }else{
                    //neu khach hang khong chon truong attr, thi unset user_id ra
                    //lay mang user_id ra
                    $row_show = $this->Mattr_customers->get_attr_customer($attr_id);
                    @$arr_user_id_2 = json_decode($row_show['user_id'], true);
                    foreach (@$arr_user_id_2 as $key=>$value){
                        //kiem tra neu luc truoc da ton tai thi unset ra khoi mang
                        if($user_info['id'] == $value){
                            unset($arr_user_id_2[$key]);
                        }
                    }

                    $data_json = array(
                        'user_id' => json_encode($arr_user_id_2)
                    );
                    //luu lai thong tin
                    $this->Mattr_customers->update($attr_id, $data_json);

                }

            }


        }

        //LAY DANH SACH ATTR_ID DA CHON DE SHOW ===================
        //hien thi danh sach attr_customers
        @$list_attr_customers = $this->Mattr_customers->get_all_attr_customers();
        if($list_attr_customers){
            $this->_data['list_attr_customers'] = $list_attr_customers;
        }

        //kiem tra xem user da chon attr_customers nao
        //  $arr_attr_id = array();
        foreach ($list_attr_customers as $row_attr){
            //lay ra mang user_id

            $list_user_id = json_decode($row_attr['user_id'], true);
            //luu vao mang moi

            if(@in_array($user_info['id'], $list_user_id)){
                //neu user chon attr nao thi luu lai attr_id vao mang $arr_attr_id
                $arr_attr_id[] = $row_attr['id'];

            }
            //dua du lieu mang view
            $this->_data['arr_attr_id'] = @$arr_attr_id;
        }

        // END SETTING ATTR_AGENCY =======================================================

        //loc khach hang ==================
        $input = array();
        if($this->input->post()){
            $start_date = date('Y-m-d', strtotime($this->input->post('start_date')));
            $end_date = date('Y-m-d', strtotime($this->input->post('end_date')));

            //kiem tra dieu kien
            if($end_date > $start_date){
                $input['where'] = array(
                    'care.create_at >=' => $start_date,
                    'care.create_at <=' => $end_date
                );
            }
            //loc level
            $level_id = $this->input->post('level_id');
            if($level_id){
                $input['where'] = array(
                    'level_id = ' => $level_id
                );
            }
            //loc link tracking
            $link_tracking = $this->input->post('link_tracking');
            if($link_tracking){
                $input['like'] = array(
                    'link_tracking' => $link_tracking
                );
            }
            //loc thong tin ho ten, email, so dien thoai
            $key_world = $this->input->post('key_world');
            if($key_world){
                $input['like'] = array(
                    'name' => $key_world,
                    'email' => $key_world,
                    'phone' => $key_world,
                );
            }

            //loc nguon khach
            $source_id = $this->input->post('source_id');
            if($source_id){
                $input['where'] = array(
                    'source_id = ' => $source_id
                );
            }
            //loc trang thai
            $status = $this->input->post('status_id');
            if($status){
                $input['where'] = array(
                    'status = ' => $status
                );
            }
        }
        //hien thi danh sach người dùng
        $list_customers = $this->Mcustomers->get_all_customers_filter_care($input);
        $this->_data['list_customers'] = $list_customers;

        //view
        $this->load->view('care_overview/index', $this->_data);
    }


    /*
     * ham check
     */
    public function check_level($id){
        return ($id == 0)?false:true;
    }
    public function check_service($id){
        return ($id == 0)?false:true;
    }
    public function check_marketer($id){
        return ($id == 0)?false:true;
    }
    public function check_source($id){
        return ($id == 0)?false:true;
    }
    public function check_status_care($id){
        return ($id == 0)?false:true;
    }
    public function check_user_care($id){
        return ($id == 0)?false:true;
    }

    /*
     * xuat du lieu excel
     */
    public function export(){

        //kiem tra login
        $login = $this->session->get_userdata();
        $user_email = @$login['user_login'];
        $user_info = $this->Musers->get_user_info($user_email);
        $this->_data['user_info'] = $user_info;

        //hien thi danh sach khach hang
        $list_customers = $this->Mcustomers->get_all_customers_filter_sales();
        if($list_customers){
            $this->_data['list_customers'] = $list_customers;
        }
        //hien thi danh sach attr_customers
        $list_attr_customers = $this->Mattr_customers->get_all_attr_customers();
        if($list_attr_customers){
            $this->_data['list_attr_customers'] = $list_attr_customers;
        }

        $this->load->view('care_overview/export', $this->_data);
    }

    //============================== phan detail =========================
    public function detail(){
        $this->_data['page_title'] = 'Chăm sóc khách hàng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $this->_data['user_info'] = $this->Musers->get_user_info($email);


        //hien thi thong tin chi tiet
        $sale_id = intval($this->uri->rsegment(3));
        if($sale_id){
            $info = $this->Mcare_detail->get_care_detail($sale_id);
            $this->_data['info'] = $info;

            //hien thi danh sach detail => lay lich su cham soc
            $list_care_detail = $this->Mcare_detail->get_all_care_detail($info['care_id']);
            $this->_data['list_care_detail'] = $list_care_detail;
        }
        //========================================== update_customers =================================================

        //========================================== end update_customers =================================================
        //========================================== update_care =================================================
        //cap nhat thong tin update care detail
        if($this->input->post() && $this->input->post('action') == 'add_action'){
//            $this->form_validation->set_rules('name_work', 'Tên công việc', 'required');
            if(true){
                $name = $this->input->post('name_work');
                $channel_id = $this->input->post('channel_id');
                $link = $this->input->post('link');
                $status_process = $this->input->post('status');
                $is_action = $this->input->post('is_action');

                $data_detail = array(
                    'care_id' => $info['care_id'],
                    'name' => $name,
                    'channel_id' => $channel_id,
                    'link' => $link,
                    'status' => $status_process,
                    'is_action' => $is_action,
                    'create_at' => date('Y-m-d',time())
                );

                //tien hanh cap nhat
                if($this->Mcare_detail->insert($data_detail)){

                    //redirect
                    redirect(base_url('care_overview/detail/'.$sale_id.'#todolist'));
                }
            }

        }
        //========================================== end update_care =================================================
        //========================================== update_todolist =================================================
        //cap nhat thong tin update care detail && $this->input->post('action') == 'update_todolist'
        if($this->input->post()){

                $detail_id = $this->input->post('id');
                $status_process = $this->input->post('status');

                $data_detail = array(
                    'status' => $status_process,
                    'update_at' => date('Y-m-d',time())
                );

                //tien hanh cap nhat
                if($this->Mcare_detail->update_detail($detail_id,$data_detail)){
                    //redirect
                    return 'success';
                }

        }
        //========================================== end update_care =================================================

        //view
        $this->load->view('care_overview/detail', $this->_data);
    }

    /*
     * delete
     */
    public function del_detail(){
        //kiem tra login
        $login = $this->session->get_userdata();
        $email = @$login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        //check group permission
        $arr_permission_check = $this->globals->get_group_permission($user_info['group_id'], 'care');

        if(in_array("del", $arr_permission_check) == false) {
            redirect('home/index');
        }
        // end check permission group -->

        if($email){
            if($this->input->post()){
                $detail_id = $this->input->post('id');
                $input = array(
                    'id' => $detail_id,
                );
                if($this->Mcare_detail->delete_detail($input)){
                    return 'success';
                }else{
                    return 'error';
                }
            }
        }else{
            redirect(base_url().'auth/login');
        }

    }
}
