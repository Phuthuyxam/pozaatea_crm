<?php
class Customers_sales extends CI_Controller{
    protected $_data;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Musers');
        $this->load->model('Mcustomers');
        $this->load->model('Msales_overview');
        $this->load->model('Msales_detail');
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
                $input[] = array(
                    'create_at >=' => $start_date,
                    'create_at <=' => $end_date
                );
            }
            //loc level
            $level_id = $this->input->post('level_id');
            if($level_id){
                $input[] = array(
                    'level_id = ' => $level_id
                );
            }
            //loc link tracking
            $link_tracking = $this->input->post('link_tracking');
            if($link_tracking){
                $input[] = array(
                    'link_tracking' => $link_tracking
                );
            }
            //loc thong tin ho ten, email, so dien thoai
            $key_world = $this->input->post('key_world');
            if($key_world){
                $input[] = array(
                    'name' => $key_world,
                    'email' => $key_world,
                    'phone' => $key_world,
                );
            }

            //loc nguon khach
            $source_id = $this->input->post('source_id');
            if($source_id){
                $input[] = array(
                    'source_id = ' => $source_id
                );
            }
            //loc trang thai care
            $status_care = $this->input->post('status_care_id');
            if($status_care){
                $input[] = array(
                    's.status_care_id = ' => $status_care
                );
            }
        }
        //----------------------------
        //kiem tra is_sale == 1, loc khach hang theo nhan vien sale
        if($user_info['is_sale'] == 1){
            $input[] = array(
                'c.telesale_id' => $user_info['id']
            );
        }
        //hien thi danh sach người dùng
        $list_customers = $this->Mcustomers->get_all_customers_filter_sales($input);
        $this->_data['list_customers'] = $list_customers;

        //view
        $this->load->view('customers_sales/index', $this->_data);
    }



    /*
     * them
     */
    public function add(){
        $this->_data['page_title'] = 'Thêm mới khách hàng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //hien thi danh sach attr_customers
        $list_attr_customers = $this->Mattr_customers->get_all_attr_customers();
        if($list_attr_customers){
            $this->_data['list_attr_customers'] = $list_attr_customers;
        }

        //thuc hien add
        if($this->input->post()){

            $this->form_validation->set_rules('name', 'Tên khách hàng', 'required');
            $this->form_validation->set_rules('email', 'Địa chỉ email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|min_length[10]');

            $this->form_validation->set_rules('level_id', 'Level', 'required|callback_check_level');
            $this->form_validation->set_message('check_level', 'Level bắt buộc phải chọn');

            $this->form_validation->set_rules('service_id', 'Level', 'required|callback_check_service');
            $this->form_validation->set_message('check_service', 'Dịch vụ bắt buộc phải chọn');


            $this->form_validation->set_rules('source_id', 'Marketer', 'required|callback_check_source');
            $this->form_validation->set_message('check_source', 'Source bắt buộc phải chọn');

            $this->form_validation->set_rules('status_care_id', 'Trạng thái', 'required|callback_check_status_care');
            $this->form_validation->set_message('check_status_care', 'Trạng thái bắt buộc phải chọn');


            $this->form_validation->set_rules('duration','Thời hạn','greater_than[0]|trim');
            $this->form_validation->set_rules('deposit','Tiền cọc','greater_than[0]|trim');


            $this->form_validation->set_rules("password","Mật khẩu","required|min_length[6]");
            $this->form_validation->set_rules("confirm_password","Xác nhận mật khẩu","required|matches[password]");


            if($this->form_validation->run()){
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $phone = $this->input->post('phone');
                $level_id = $this->input->post('level_id');
                $link_tracking = $this->input->post('link_tracking');
                $service_id = $this->input->post('service_id');
                $marketer_id = $this->input->post('marketer_id');
                $source_id = $this->input->post('source_id');
                $status_care_id = $this->input->post('status_care_id');
                $note = $this->input->post('note');
                $opening_date = date('Y-m-d',strtotime($this->input->post('opening_date')));
                $duration = $this->input->post('duration');
                $deposit = $this->input->post('deposit');
                $contract = $this->input->post('contract');
                $password = md5($this->input->post('password'));
                $create_at = date('Y-m-d', time());

                $data_insert = array(
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'level_id' => $level_id,
                    'link_tracking' => $link_tracking,
                    'service_id' => $service_id,
                    'marketer_id' => $marketer_id,
                    'source_id' => $source_id,
                    'status' => 2,
                    'telesale_id' =>$user_info['id'],
                    'password' => $password,
                    'create_at' =>$create_at

                );
                $data_sale = array(
                    'status_care_id' => $status_care_id,
                    'note' => $note,//
                    'opening_date' => $opening_date,
                    'duration' => $duration,
                    'deposit' => $deposit,
                    'contract' => $contract,
                    'create_at' => $create_at
                );
                //thuc hien
                //lay id insert new
                $insert_customer_id = $this->Mcustomers->insert($data_insert);
                if(!empty($insert_customer_id)){
                    $this->session->set_flashdata('msg_customers_success', 'Thêm mới khách hàng thành công');

                    //cap nhat du lieu vao bang sale_overview
                    $data_sale['customer_id'] = $insert_customer_id;
                    $insert_sale_id = $this->Msales_overview->insert($data_sale);

                    //kiem tra level , neu level cao nhat thi dong thoi chuyen
                    $info_level = $this->globals->get_level($level_id);
                    if($info_level['name'] == $this->globals->get_level_max() && !empty($insert_sale_id)){

                        //cap nhat bang care =========================
                        $data_care_overview = array(
                            'sale_id' => $insert_sale_id,
                            'create_at' => date('Y-m-d',time())
                        );
                        //kiem tra cap nhat overview thanh cong => detail
                        $insert_care_id = $this->Mcare_overview->insert($data_care_overview);

                        //cap nhat bang accountant =================
                        $data_acc_overview = array(
                            'sale_id' => $insert_sale_id,
                            'create_at' => date('Y-m-d',time())
                        );
                        //kiem tra cap nhat overview thanh cong => detail
                        $insert_acc_id = $this->Maccountant_overview->insert($data_acc_overview);

                        //cap nhat bang design ========================
                        $data_design_overview = array(
                            'sale_id' => $insert_sale_id,
                            'create_at' => date('Y-m-d',time())
                        );
                        //kiem tra cap nhat overview thanh cong => detail
                        $insert_design_id = $this->Mdesign_overview->insert($data_design_overview);

                        //cap nhat bang support =====================
                        $data_sp_overview = array(
                            'sale_id' => $insert_sale_id,
                            'create_at' => date('Y-m-d',time())
                        );
                        //kiem tra cap nhat overview thanh cong => detail
                        $insert_sp_id = $this->Msupport_overview->insert($data_sp_overview);

                        //--------------------------------------------------------
                    }

                    //thuc hien them du lieu meta_customers
                    //lay du lieu attr_customers
                    $arr_attr_customers = array();
                    foreach ($list_attr_customers as $item){
                        $arr_attr_customers['key'] = $item['key'];
                        $arr_attr_customers['value'] = $this->input->post($item['key']);
                        $arr_attr_customers['customer_id'] = $insert_customer_id;

                        //them du lieu meta
                        $this->Mmeta_customers->insert($arr_attr_customers);
                    }


                    //redirect
                    redirect(base_url().'customers_sales/index');
                }else{
                    $this->session->set_flashdata('msg_customers_error', 'Thêm mới khách hàng chưa thành công');
                }
            }
        }


        $this->load->view('customers_sales/add.php', $this->_data);

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
     * edit
     */
    public function edit(){
        $this->_data['page_title'] = 'Cập nhật người dùng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //hien thi thong tin de cap nhat
        $id = intval($this->uri->rsegment(3));
        if($id){
            //kiem tra is_sale
            if($user_info['is_sale'] == 1){
                //kiem tra id customers co ton tai trong danh sach is_sale
                @$cus_sale_arr = $this->globals->get_customers_is_sale($user_info['id']);

//                var_dump($cus_sale_arr);
                if(!in_array($id,$cus_sale_arr)){
                    redirect('customers_sales/index');
                }
            }

            $info = $this->Msales_overview->get_customer_sale($id);
            $this->_data['info'] = $info;
        }

        //hien thi danh sach attr_customers
        @$list_attr_customers = $this->Mattr_customers->get_all_attr_customers();
        if($list_attr_customers){
            $this->_data['list_attr_customers'] = $list_attr_customers;
        }

        //hien thi danh sach meta_customers
        $list_attr_meta_customers = $this->Mmeta_customers->get_meta_customers($id);
        if($list_attr_meta_customers){
            $this->_data['list_attr_meta_customers'] = $list_attr_meta_customers;
        }

        //thuc hien update
        if($this->input->post()){

            $this->form_validation->set_rules('name', 'Tên khách hàng', 'required');
            $this->form_validation->set_rules('email', 'Địa chỉ email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|min_length[10]');

            $this->form_validation->set_rules('level_id', 'Level', 'required|callback_check_level');
            $this->form_validation->set_message('check_level', 'Level bắt buộc phải chọn');

            $this->form_validation->set_rules('service_id', 'Level', 'required|callback_check_service');
            $this->form_validation->set_message('check_service', 'Dịch vụ bắt buộc phải chọn');


            $this->form_validation->set_rules('source_id', 'Marketer', 'required|callback_check_source');
            $this->form_validation->set_message('check_source', 'Source bắt buộc phải chọn');

            $this->form_validation->set_rules('status_care_id', 'Trạng thái', 'required|callback_check_status_care');
            $this->form_validation->set_message('check_status_care', 'Trạng thái bắt buộc phải chọn');

            $this->form_validation->set_rules('duration','Thời hạn','greater_than[0]|trim');
            $this->form_validation->set_rules('deposit','Tiền cọc','greater_than[0]|trim');



            //check  pass neu nhap thi moi kiem tra
            if($this->input->post('password')){
                $this->form_validation->set_rules("password","Mật khẩu","required|min_length[6]");
                $this->form_validation->set_rules("confirm_password","Xác nhận mật khẩu","required|matches[password]");

            }

            if($this->form_validation->run()){

                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $phone = $this->input->post('phone');
                $level_id = $this->input->post('level_id');
                $link_tracking = $this->input->post('link_tracking');
                $service_id = $this->input->post('service_id');
                $marketer_id = $this->input->post('marketer_id');
                $source_id = $this->input->post('source_id');
                $status_care_id = $this->input->post('status_care_id');
                $note = $this->input->post('note');
                $opening_date = date('Y-m-d',strtotime($this->input->post('opening_date')));
                $duration = $this->input->post('duration');
                $deposit = $this->input->post('deposit');
                $contract = $this->input->post('contract');
                $update_at = date('Y-m-d', time());

                $data_update = array(
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'level_id' => $level_id,
                    'link_tracking' => $link_tracking,
                    'service_id' => $service_id,
                    'marketer_id' => $marketer_id,
                    'source_id' => $source_id,
                    'update_at' =>$update_at

                );
                $data_sale = array(
                    'status_care_id' => $status_care_id,
                    'note' => $note,//
                    'opening_date' => $opening_date,
                    'duration' => $duration,
                    'deposit' => $deposit,
                    'contract' => $contract,
                    'update_at' => $update_at
                );

                if(!empty($this->input->post("password"))){
                    $data_update['password'] = md5($this->input->post("password"));
                }
                //thuc hien
                if($this->Mcustomers->update($id, $data_update)){
                    $this->session->set_flashdata('msg_customers_success', 'Cập nhật khách hàng thành công');

                    //cap nhat du lieu bang sales_overview
                    $insert_sale_id = $this->Msales_overview->update($id, $data_sale);
                    //kiem tra level dat cap cao nhat => chuyen sang cskh
                    //lay level name de so sang level_max
                    $info_level = $this->globals->get_level($level_id);
                    if($info_level['name'] == $this->globals->get_level_max()){

                        //cap nhat bang care_overview ---------------------------
                            //kiem tra xem sale_id da ton tai trong bang , neu chua them moi
                            if(!$this->Mcare_overview->check_sale_id_exit($info['id'])){
                                $data_care_overview = array(
                                    'sale_id' => $info['id'],
                                    'create_at' => date('Y-m-d',time())
                                );
                                //kiem tra cap nhat overview thanh cong => detail
                                $insert_care_id = $this->Mcare_overview->insert($data_care_overview);

                            }

                        //cap nhat bang accountant_overview ---------------------------
                        //kiem tra xem sale_id da ton tai trong bang , neu chua them moi
                        if(!$this->Maccountant_overview->check_sale_id_exit($info['id'])){
                            $data_acc_overview = array(
                                'sale_id' => $info['id'],
                                'create_at' => date('Y-m-d',time())
                            );
                            //kiem tra cap nhat overview thanh cong => detail
                            $insert_acc_id = $this->Maccountant_overview->insert($data_acc_overview);

                        }
                        //cap nhat bang design_overview ---------------------------
                        //kiem tra xem sale_id da ton tai trong bang , neu chua them moi
                        if(!$this->Mdesign_overview->check_sale_id_exit($info['id'])){
                            $data_design_overview = array(
                                'sale_id' => $info['id'],
                                'create_at' => date('Y-m-d',time())
                            );
                            //kiem tra cap nhat overview thanh cong => detail
                            $insert_design_id = $this->Mdesign_overview->insert($data_design_overview);

                        }

                        //cap nhat bang support_overview ---------------------------
                        //kiem tra xem sale_id da ton tai trong bang , neu chua them moi
                        if(!$this->Msupport_overview->check_sale_id_exit($info['id'])){
                            $data_sp_overview = array(
                                'sale_id' => $info['id'],
                                'create_at' => date('Y-m-d',time())
                            );
                            //kiem tra cap nhat overview thanh cong => detail
                            $insert_sp_id = $this->Msupport_overview->insert($data_sp_overview);

                        }


                            //-------------------------------------------------------
                    }

                    //kiem tra neu list_meta_attr_customers da ton tai chua
                    //neu ton tai thi thuc hien cap nhat
                    if($list_attr_meta_customers){
                        //lay du lieu attr_customers
                        $arr_meta_attr_customers = array();
                        foreach ($list_attr_meta_customers as $item){

                            $arr_meta_attr_customers['value'] = $this->input->post($item['key']);

                            //them du lieu meta_customers
                            $this->Mmeta_customers->update($item['key'],$id,$arr_meta_attr_customers);
                        }
                    }else{
                        //neu chua ton tai thi them moi du lieu
                        //lay du lieu attr_customers
                        $arr_attr_customers = array();
                        foreach ($list_attr_customers as $item){
                            $arr_attr_customers['key'] = $item['key'];
                            $arr_attr_customers['value'] = $this->input->post($item['key']);
                            $arr_attr_customers['customer_id'] = $id;

                            //them du lieu meta_customers
                            $this->Mmeta_customers->insert($arr_attr_customers);
                        }
                    }

                    //redirect

                    redirect(base_url().'customers_sales/index');
                }else{
                    $this->session->set_flashdata('msg_customers_error', 'Cập nhật khách hàng chưa thành công');
                }
            }
        }


        $this->load->view('customers_sales/edit', $this->_data);

    }



    /*
     * delete
     */
    public function del(){
        //kiem tra login
        $login = $this->session->get_userdata();
        $email = @$login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        //check group permission
        $arr_permission_check = $this->globals->get_group_permission($user_info['group_id'], 'sales');

        if(in_array("del", $arr_permission_check) == false) {
            redirect('home/index');
        }
        // end check permission group -->

        if($email){
            $id = intval($this->uri->rsegment(3));
            $sale_id = intval($this->uri->rsegment(4));
            //kiem tra is_sale
            if($user_info['is_sale'] == 1){
                //kiem tra id customers co ton tai trong danh sach is_sale
                @$cus_sale_arr = $this->globals->get_customers_is_sale($user_info['id']);

//                var_dump($cus_sale_arr);
                if(!in_array($id,$cus_sale_arr)){
                    redirect('customers_sales/index');
                }
            }
            //---------------------
            if($this->Mcustomers->delete_customer_sale($id)){
                //xoa du lieu meta_customers
                $this->Mmeta_customers->delete($id);
                //-------------------------------------------------
                //xoa du lieu bang sales_overview , detail
                // id chinh la id cua customers
                if($this->Msales_overview->delete($id)){
                    //xoa bang detail
                    $this->Msales_detail->delete($sale_id);
                }
                //xoa du lieu bang care_overview, detail
                $care_id = $this->globals->get_care_id($sale_id);
                if($this->Mcare_overview->delete($sale_id)){
                    //xoa bang care detail
                    $this->Mcare_detail->delete($care_id);
                }
                //xoa du lieu design overview, detail
                $design_id = $this->globals->get_design_id($sale_id);
                if($this->Mdesign_overview->delete($sale_id)){
                    //xoa bang detail
                    $this->Mdesign_detail->delete($design_id);
                }
                //xoa du lieu acc overview, detail
                $acc_id = $this->globals->get_accountant_id($sale_id);
                if($this->Maccountant_overview->delete($sale_id)){
                    //xoa bang detail
                    $this->Maccountant_detail->delete($acc_id);
                }
                //xoa du lieu sp overview, detail
                $sp_id = $this->globals->get_support_id($sale_id);
                if($this->Msupport_overview->delete($sale_id)){
                    //xoa bang detail
                    $this->Msupport_detail->delete($sp_id);
                }
                //-------------------------------------------------
                //thong bao
                $this->session->set_flashdata('msg_customers_success', 'Xóa thành công dữ liệu');
                redirect(base_url().'customers_sales/index');

            }else{
                $this->session->set_flashdata('msg_customers_error', 'Xóa chưa thành công dữ liệu');
                redirect(base_url().'customers_sales/index');
            }
        }else{
            redirect(base_url().'auth/login');
        }

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

        $this->load->view('customers_sales/export', $this->_data);
    }

    //========= phan danh cho detail =========================================
    public function detail(){
        $this->_data['page_title'] = 'Chăm sóc khách hàng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //hien thi thong tin chi tiet
        $sale_id = intval($this->uri->rsegment(3));
        if($sale_id){
            //kiem tra is_sale
            if($user_info['is_sale'] == 1){
                //kiem tra id customers co ton tai trong danh sach is_sale
                @$cus_sale_arr = $this->globals->get_customers_is_sale($user_info['id']);
                @$cus_id = $this->globals->get_customers_is_sale_detail($sale_id);
//                var_dump($cus_id);
                if(!in_array($cus_id,$cus_sale_arr)){
                    redirect('customers_sales/index');
                }
            }

            //-----------------------------------------
            $info = $this->Msales_detail->get_sale_detail($sale_id);
            $this->_data['info'] = $info;

            //hien thi danh sach detail => lay lich su cham soc
            $list_sales_detail = $this->Msales_detail->get_all_sales_detail($sale_id);
            $this->_data['list_sales_detail'] = $list_sales_detail;
        }
        //========================================== update_customers =================================================
        //cap nhat thong tin update customer
        if($this->input->post() && $this->input->post('action') == 'update_customer'){
            $this->form_validation->set_rules('name', 'Tên khách hàng', 'required');
            $this->form_validation->set_rules('email', 'Địa chỉ email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|min_length[10]');

            $this->form_validation->set_rules('level_id', 'Level', 'required|callback_check_level');
            $this->form_validation->set_message('check_level', 'Level bắt buộc phải chọn');

            $this->form_validation->set_rules('status_care_id', 'Trạng thái', 'required|callback_check_status_care');
            $this->form_validation->set_message('check_status_care', 'Trạng thái bắt buộc phải chọn');

            if($this->form_validation->run()) {

                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $phone = $this->input->post('phone');
                $phone2 = $this->input->post('phone2');
                $address = $this->input->post('address');
                $level_id = $this->input->post('level_id');
                $status_care_id = $this->input->post('status_care_id');
                $note_sale = $this->input->post('note_sale');
                $service_id = $this->input->post('service_id');
                $source_id = $this->input->post('source_id');
                $opening_date = date('Y-m-d',strtotime($this->input->post('opening_date')));
                $duration = $this->input->post('duration');
                $deposit = str_replace(',','',$this->input->post('deposit'));

                $data_customer = array(
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'phone2' => $phone2,
                    'address' => $address,
                    'level_id' => $level_id,
                    'service_id' => $service_id,
                    'source_id' => $source_id,

                );

                $data_sale = array(
                    'status_care_id' => $status_care_id,
                    'note' => $note_sale,
                    'opening_date' => $opening_date,
                    'duration' => $duration,
                    'deposit' => $deposit
                );

                //tien hanh cap nhat thong tin khach hang sau chinh sua
                //cap nhat bang customers
                if($this->Mcustomers->update($info['cus_id'], $data_customer)){
                    //chuyen sang thong sang care, acc, desgin, sp khi level max
                    //lay level name de so sang level_max
                    $info_level = $this->globals->get_level($level_id);
                    if($info_level['name'] == $this->globals->get_level_max()){

                        //cap nhat bang care_overview ---------------------------
                        //kiem tra xem sale_id da ton tai trong bang , neu chua them moi
                        if(!$this->Mcare_overview->check_sale_id_exit($info['sale_id'])){
                            $data_care_overview = array(
                                'sale_id' => $info['sale_id'],
                                'create_at' => date('Y-m-d',time())
                            );
                            //kiem tra cap nhat overview thanh cong => detail
                            $insert_care_id = $this->Mcare_overview->insert($data_care_overview);

                        }

                        //cap nhat bang accountant_overview ---------------------------
                        //kiem tra xem sale_id da ton tai trong bang , neu chua them moi
                        if(!$this->Maccountant_overview->check_sale_id_exit($info['sale_id'])){
                            $data_acc_overview = array(
                                'sale_id' => $info['sale_id'],
                                'create_at' => date('Y-m-d',time())
                            );
                            //kiem tra cap nhat overview thanh cong => detail
                            $insert_acc_id = $this->Maccountant_overview->insert($data_acc_overview);

                        }
                        //cap nhat bang design_overview ---------------------------
                        //kiem tra xem sale_id da ton tai trong bang , neu chua them moi
                        if(!$this->Mdesign_overview->check_sale_id_exit($info['sale_id'])){
                            $data_design_overview = array(
                                'sale_id' => $info['sale_id'],
                                'create_at' => date('Y-m-d',time())
                            );
                            //kiem tra cap nhat overview thanh cong => detail
                            $insert_design_id = $this->Mdesign_overview->insert($data_design_overview);

                        }

                        //cap nhat bang support_overview ---------------------------
                        //kiem tra xem sale_id da ton tai trong bang , neu chua them moi
                        if(!$this->Msupport_overview->check_sale_id_exit($info['sale_id'])){
                            $data_sp_overview = array(
                                'sale_id' => $info['sale_id'],
                                'create_at' => date('Y-m-d',time())
                            );
                            //kiem tra cap nhat overview thanh cong => detail
                            $insert_sp_id = $this->Msupport_overview->insert($data_sp_overview);

                        }


                        //-------------------------------------------------------
                    }
                    //cap nhat bang sale_overview
                        $this->Msales_overview->update($info['cus_id'], $data_sale);

                    //redirect
                         redirect(base_url('customers_sales/detail/'.$sale_id.'/#info_cus'));
                }
            }
        }
        //========================================== end update_customers =================================================
        //========================================== update_care =================================================
        //cap nhat thong tin update care detail
        if($this->input->post() && $this->input->post('action') == 'update_care'){
//            $this->form_validation->set_rules('time_callback', 'Thời gian gọi lại', 'required');

                $content = $this->input->post('content');
                $level_id = $this->input->post('level_id');
                $time_callback = ($this->input->post('time_callback'))?date('Y-m-d', strtotime($this->input->post('time_callback'))):'';
                $is_action = $this->input->post('is_action');
                $data_customer = array(
                    'level_id' => $level_id,

                );

                $data_detail = array(
                    'sale_id' => $sale_id,
                    'level_history' => $level_id,
                    'status_history' => $info['status_care_id'],
                    'content' => $content,
                    'time_callback' => $time_callback,
                    'is_action' => $is_action,
                    'create_at' => date('Y-m-d',time())
                );

                //tien hanh cap nhat thong tin khach hang sau chinh sua
                //cap nhat bang customers
                if($this->Mcustomers->update($info['cus_id'], $data_customer)){
                    //lay level name de so sang level_max
                    $info_level = $this->globals->get_level($level_id);
                    if($info_level['name'] == $this->globals->get_level_max()){

                        //cap nhat bang care_overview ---------------------------
                        //kiem tra xem sale_id da ton tai trong bang , neu chua them moi
                        if(!$this->Mcare_overview->check_sale_id_exit($info['sale_id'])){
                            $data_care_overview = array(
                                'sale_id' => $info['sale_id'],
                                'create_at' => date('Y-m-d',time())
                            );
                            //kiem tra cap nhat overview thanh cong => detail
                            $insert_care_id = $this->Mcare_overview->insert($data_care_overview);

                        }

                        //cap nhat bang accountant_overview ---------------------------
                        //kiem tra xem sale_id da ton tai trong bang , neu chua them moi
                        if(!$this->Maccountant_overview->check_sale_id_exit($info['sale_id'])){
                            $data_acc_overview = array(
                                'sale_id' => $info['sale_id'],
                                'create_at' => date('Y-m-d',time())
                            );
                            //kiem tra cap nhat overview thanh cong => detail
                            $insert_acc_id = $this->Maccountant_overview->insert($data_acc_overview);

                        }
                        //cap nhat bang design_overview ---------------------------
                        //kiem tra xem sale_id da ton tai trong bang , neu chua them moi
                        if(!$this->Mdesign_overview->check_sale_id_exit($info['sale_id'])){
                            $data_design_overview = array(
                                'sale_id' => $info['sale_id'],
                                'create_at' => date('Y-m-d',time())
                            );
                            //kiem tra cap nhat overview thanh cong => detail
                            $insert_design_id = $this->Mdesign_overview->insert($data_design_overview);

                        }

                        //cap nhat bang support_overview ---------------------------
                        //kiem tra xem sale_id da ton tai trong bang , neu chua them moi
                        if(!$this->Msupport_overview->check_sale_id_exit($info['sale_id'])){
                            $data_sp_overview = array(
                                'sale_id' => $info['sale_id'],
                                'create_at' => date('Y-m-d',time())
                            );
                            //kiem tra cap nhat overview thanh cong => detail
                            $insert_sp_id = $this->Msupport_overview->insert($data_sp_overview);

                        }


                        //-------------------------------------------------------
                    }
                }

                //cap nhat bang sale_detail
                $this->Msales_detail->insert($data_detail);
                //redirect
                redirect(base_url('customers_sales/detail/'.$sale_id.'#care_note'));


        }
        //========================================== end update_care =================================================

        //view
        $this->load->view('customers_sales/detail', $this->_data);
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


        if($email){
            $detail_id = $this->input->post('id');
            $input = array(
                'id' => $detail_id,
            );
            if($this->Msales_detail->delete_detail($input)){
                return 'success';
                //thong bao

            }else{
                return 'error';
            }
        }else{
            redirect(base_url().'auth/login');
        }

    }



}
