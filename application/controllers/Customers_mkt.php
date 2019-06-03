<?php
class Customers_mkt extends CI_Controller{
    protected $_data;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Musers');
        $this->load->model('Mcustomers');
        $this->load->model('Mmkt_detail');
        $this->load->model('Msales_overview');
        $this->load->model('Msales_detail');
        $this->load->model('Mattr_customers');
        $this->load->model('Mmeta_customers');
        $this->load->model('Mcustomershop');
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
                    if(!@in_array($user_info['id'],  $arr_user_id)){
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
                    'create_at >=' => $start_date,
                    'create_at <=' => $end_date
                );
            }
            //loc level
            $level_id = $this->input->post('level_id');
            if($level_id){
                $input['where'] = array(
                  'level_id =' => $level_id
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
        $list_customers = $this->Mcustomers->get_all_customers_filter_mkt($input);
        $this->_data['list_customers'] = $list_customers;

        //view
        $this->load->view('customers_mkt/index', $this->_data);
    }



    /*
     * them
     */
    public function add(){
        $this->_data['page_title'] = 'Thêm mới khách hàng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $this->_data['user_info'] = $this->Musers->get_user_info($email);



        //hien thi danh sach attr_customers
        @$list_attr_customers = $this->Mattr_customers->get_all_attr_customers();
        if($list_attr_customers){
            $this->_data['list_attr_customers'] = $list_attr_customers;
        }

        //thuc hien add
        if($this->input->post()){
            $this->form_validation->set_rules('name', 'Tên khách hàng', 'required');
            $this->form_validation->set_rules('email', 'Địa chỉ email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|min_length[10]');


            $this->form_validation->set_rules('marketer_id', 'Marketer', 'required|callback_check_marketer');
            $this->form_validation->set_message('check_marketer', 'Marketer bắt buộc phải chọn');

            $this->form_validation->set_rules('source_id', 'Marketer', 'required|callback_check_source');
            $this->form_validation->set_message('check_source', 'Source bắt buộc phải chọn');

            $this->form_validation->set_rules('type', 'Marketer', 'required|callback_check_type');
            $this->form_validation->set_message('check_type', 'Đại lý bắt buộc phải chọn');

            if($this->form_validation->run()){
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $phone = $this->input->post('phone');
                $level_id = 0;
                $type = $this->input->post('type');
                $link_tracking = $this->input->post('link_tracking');
                $service_id = 0;
                $marketer_id = $this->input->post('marketer_id');
                $source_id = $this->input->post('source_id');
                $status = 1; // mac dinh trang thai chua xuat kho
                $telesale_id = $this->input->post('telesale_id');
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
                    'status' => $status,
                    'telesale_id' => $telesale_id,
                    'type'  => $type,
                    'create_at' =>$create_at

                );

                

                //thuc hien
                //lay id insert new
                $insert_customer_id = $this->Mcustomers->insert($data_insert);
                if(!empty($insert_customer_id)){
                    $this->session->set_flashdata('msg_customers_success', 'Thêm mới khách hàng thành công');

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

                    // Thêm dữ liệu bảng customer shop
                    // get daa
                    $shop_ids = $this->input->post('shop_id');
                    $shop_customer_arr = array();
                    if(isset($shop_ids) && !empty($shop_ids)){
                        foreach ($shop_ids as $key => $item){
                            $shop_customer_arr['customer_id'] = $insert_customer_id;
                            $shop_customer_arr['shop_id'] = $item;
                            $shop_customer_arr['create_at'] = $create_at;

                            // insert data 
                            $this->Mcustomershop->insert($shop_customer_arr);
                        }
                    }
                    //redirect
                    redirect(base_url().'customers_mkt/index');
                }else{
                    $this->session->set_flashdata('msg_customers_error', 'Thêm mới khách hàng chưa thành công');
                }
            }
        }
        $this->load->view('customers_mkt/add.php', $this->_data);

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
    public function check_telesale($id){
        return ($id == 0)?false:true;
    }

    // check function 

    public function check_type($id){
        return ($id == 0)?false:true;
    }

    /*
     * edit
     */
    public function edit(){
        $this->_data['page_title'] = 'Cập nhật người dùng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $this->_data['user_info'] = $this->Musers->get_user_info($email);


        //hien thi thong tin de cap nhat
        $id = intval($this->uri->rsegment(3));
        if($id){
            $info = $this->Mcustomers->get_customer($id);
            $this->_data['info'] = $info;
        }

        //hien thi danh sach attr_customers
        @$list_attr_customers = $this->Mattr_customers->get_all_attr_customers();
        if($list_attr_customers){
            $this->_data['list_attr_customers'] = $list_attr_customers;
        }

        //hien thi danh sach meta_customers
        @$list_attr_meta_customers = $this->Mmeta_customers->get_meta_customers($id);
        if($list_attr_meta_customers){
            $this->_data['list_attr_meta_customers'] = $list_attr_meta_customers;
        }

        //thuc hien update
        if($this->input->post()){
            $this->form_validation->set_rules('name', 'Tên khách hàng', 'required');
            $this->form_validation->set_rules('email', 'Địa chỉ email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|min_length[10]');

            $this->form_validation->set_rules('marketer_id', 'Marketer', 'required|callback_check_marketer');
            $this->form_validation->set_message('check_marketer', 'Marketer bắt buộc phải chọn');

            $this->form_validation->set_rules('source_id', 'Marketer', 'required|callback_check_source');
            $this->form_validation->set_message('check_source', 'Source bắt buộc phải chọn');

            $this->form_validation->set_rules('type', 'Marketer', 'required|callback_check_type');
            $this->form_validation->set_message('check_type', 'Đại lý bắt buộc phải chọn');


            if($this->form_validation->run()){
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $phone = $this->input->post('phone');

                $type = $this->input->post('type');

                $link_tracking = $this->input->post('link_tracking');

                $marketer_id = $this->input->post('marketer_id');
                $source_id = $this->input->post('source_id');
                $telesale_id = $this->input->post('telesale_id');
                $update_at = date('Y-m-d', time());

                $data_update = array(
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'link_tracking' => $link_tracking,
                    'marketer_id' => $marketer_id,
                    'source_id' => $source_id,
                    'telesale_id' => $telesale_id,
                    'type'  => $type,
                    'update_at' =>$update_at

                );

                //thuc hien
                if($this->Mcustomers->update($id, $data_update)){
                    $this->session->set_flashdata('msg_customers_success', 'Cập nhật khách hàng thành công');

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

                    // Thay đổi dữ liệu customer shop
                    // xóa tất cả những thằng đang tồn tại
                    $all_shop = $this->Mcustomershop->get_by_customer_id($id);
                    if(isset($all_shop)&&!empty($all_shop)){
                        foreach($all_shop as $item){
                            $this->Mcustomershop->delete($item['id']);
                        }
                    }                   
                    $shop_ids = $this->input->post('shop_id');
                    $shop_customer_arr = array();
                    if(isset($shop_ids) && !empty($shop_ids)){
                        foreach ($shop_ids as $key => $item){
                            $shop_customer_arr['customer_id'] = $id;
                            $shop_customer_arr['shop_id'] = $item;
                            $shop_customer_arr['update_at'] = $update_at;
                            // insert data 
                            $this->Mcustomershop->insert($shop_customer_arr);
                        }
                    }
                    //redirect

                    redirect(base_url().'customers_mkt/index');
                }else{
                    $this->session->set_flashdata('msg_customers_error', 'Cập nhật khách hàng chưa thành công');
                }
            }
        }


        $this->load->view('customers_mkt/edit', $this->_data);

    }

    /*
     * delivery
     */
    public function delivery(){
        //kiem tra login
        $login = $this->session->get_userdata();
        $email = @$login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        //check group permission
        $arr_permission_check = $this->globals->get_group_permission($user_info['group_id'], 'mkt');

        if(in_array("add", $arr_permission_check) == false) {
            redirect('home/index');
        }
        // end check permission group -->

        if($email){
            $id = $this->input->post('id');
            $telesale_id = $this->input->post('telesale_id');
            //chuyen trang thai 1 -> 2 da xuat kho, sale se tiep nhan
            $data_update = array(
                'status' => 2
            );
            if($this->Mcustomers->delivery_mkt($id,$data_update)){
                //thong bao
                $this->session->set_flashdata('msg_customers_success', 'Xuất thành công dữ liệu');
                //success, cap nhat du lieu sang sale
                //cap nhat nhan vien telesale
                $this->Mcustomers->update($id, array('telesale_id' => $telesale_id));
                //lay thong tin khach hang
                $cus_info = $this->Mcustomers->get_customer($id);
                //lay thong tin chen vao bang sale_overview
                $data_sale = array(
                    'customer_id' => $id,
                    'create_at' => date('Y-m-d',time())

                );
                //insert
                $insert_sale_id = $this->Msales_overview->insert($data_sale);
                if(!empty($insert_sale_id)){
                    //cap nhat bang sales_detail
                    $data_sales_detail = array(
                        'sale_id' => $insert_sale_id,
                        'create_at' => date('Y-m-d',time())
                    );
                    $this->Msales_detail->insert($data_sales_detail);
                }
                //redirect
                redirect(base_url().'customers_mkt/index');

            }else{
                $this->session->set_flashdata('msg_customers_error', 'Xuất chưa thành công dữ liệu');
                redirect(base_url().'customers_mkt/index');
            }
        }else{
            redirect(base_url().'auth/login');
        }
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
        $arr_permission_check = $this->globals->get_group_permission($user_info['group_id'], 'mkt');

        if(in_array("del", $arr_permission_check) == false) {
            redirect('home/index');
        }
        // end check permission group -->

        if($email){
            $id = intval($this->uri->rsegment(3));
            if($this->Mcustomers->delete_customer_mkt($id)){
                //xoa du lieu meta_customers
                $this->Mmeta_customers->delete($id);

                // xoa du lieu customer_shops
                $all_shop = $this->Mcustomershop->get_by_customer_id($id);
                if(isset($all_shop)&&!empty($all_shop)){
                    foreach($all_shop as $item){
                        $this->Mcustomershop->delete($item['id']);
                    }
                }

                //thong bao
                $this->session->set_flashdata('msg_customers_success', 'Xóa thành công dữ liệu');
                redirect(base_url().'customers_mkt/index');

            }else{
                $this->session->set_flashdata('msg_customers_error', 'Xóa chưa thành công dữ liệu');
                redirect(base_url().'customers_mkt/index');
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
        $email = @$login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        //check group permission
        $arr_permission_check = $this->globals->get_group_permission($user_info['group_id'], 'mkt');

        if(in_array("view", $arr_permission_check) == false) {
            redirect('home/index');
        }
        // end check permission group -->

        $list_customers = $this->Mcustomers->get_all_customers_filter_mkt();
        if($list_customers){
            $this->_data['list_customers'] = $list_customers;
        }

        //hien thi danh sach attr_customers
        @$list_attr_customers = $this->Mattr_customers->get_all_attr_customers();
        if($list_attr_customers){
            $this->_data['list_attr_customers'] = $list_attr_customers;
        }

        $this->load->view('customers_mkt/export', $this->_data);
    }

    //========= phan danh cho detail =========================================
    public function detail(){
        $this->_data['page_title'] = 'Chăm sóc khách hàng';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //hien thi thong tin chi tiet
        $customer_id = intval($this->uri->rsegment(3));
        if($customer_id){

            //-----------------------------------------
            $info = $this->Mcustomers->get_customer($customer_id);
            $this->_data['info'] = $info;

            //hien thi danh sach detail => lay lich su cham soc
            $list_mkt_detail = $this->Mmkt_detail->get_all_mkt_detail($customer_id);
            $this->_data['list_mkt_detail'] = $list_mkt_detail;
        }
        //========================================== update_customers =================================================
        //cap nhat thong tin update customer

        //========================================== end update_customers =================================================
        //========================================== update_care =================================================
        //cap nhat thong tin update care detail
        if($this->input->post() && $this->input->post('action') == 'update_care'){
//            $this->form_validation->set_rules('time_callback', 'Thời gian gọi lại', 'required');

            $content = $this->input->post('content');
            $time_callback = ($this->input->post('time_callback'))?date('Y-m-d', strtotime($this->input->post('time_callback'))):'';
            $is_action = $this->input->post('is_action');

            $data_detail = array(
                'customer_id' => $customer_id,
                'content' => $content,
                'time_callback' => $time_callback,
                'is_action' => $is_action,
                'create_at' => date('Y-m-d',time())
            );

            //tien hanh cap nhat thong tin khach hang sau chinh sua

            //cap nhat bang mkt_detail
            $this->Mmkt_detail->insert($data_detail);
            //redirect
            redirect(base_url('customers_mkt/detail/'.$customer_id.'#care_note'));
        }
        //========================================== end update_care =================================================

        //view
        $this->load->view('customers_mkt/detail', $this->_data);
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
            if($this->Mmkt_detail->delete_detail($input)){
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
