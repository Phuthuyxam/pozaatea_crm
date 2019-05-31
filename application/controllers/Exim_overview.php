<?php
class Exim_overview extends CI_Controller
{
    protected $_data;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Musers');
        $this->load->model('Mexim_overview');
        $this->load->model('Mimport_detail');
        $this->load->model('Mexport_detail');
        $this->load->model('Minventory');
        $this->load->model('Mcustomers');
        $this->load->library('Globals');
    }

    public function index()
    {
        $this->_data['page_title'] = 'Quản lý nhập xuất kho - Admin';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        //view
        $this->load->view('exim_overview/index', $this->_data);
    }
    /*
     * show import
     */
    public function show_import(){
        $data=$this->Mexim_overview->get_list_import();
        echo json_encode($data);
    }

    /*
     * show export
     */
    public function show_export(){
        $data=$this->Mexim_overview->get_list_export();
        echo json_encode($data);
    }

    /*
     * add import
     */
    public function import(){
        $this->_data['page_title'] = 'Nhập kho - Admin';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        if($this->input->post()){
            $this->form_validation->set_rules('quantity[]','Số lượng','greater_than[0]');

            if($this->form_validation->run() == true){
                $material_id = $this->input->post('material_id');
                $quantity = $this->input->post('quantity');

                $data =  array();
                @$total_quantity = 0;
                @$amount = 0;
                for ($i = 0; $i < count($material_id); $i++){
                    $data[] = array(
                        'material_id' => $material_id[$i],
                        'quantity' => $quantity[$i],
                        'create_at' => date('Y-m-d',time())
                    );
                    @$total_quantity += $quantity[$i];

                    @$material = $this->globals->get_material($material_id[$i]);
                    @$amount += $quantity[$i]*$material['price_im'];
                }

                //thuc hien insert exim_overview va import_detail
                if($data){
                    //insert exim_overview
                    $data_exim = array(
                        'code' => strtoupper('NK-'.md5(uniqid())),
                        'quantity' => $total_quantity,
                        'total' => $amount,
                        'type' => 0, // import
                        'create_at' => date('Y-m-d',time())
                    );
                    $insert_id = $this->Mexim_overview->insert($data_exim);
                    if($insert_id){
                        //thuc hien insert import_Detail
                        foreach ($data as $item){
                            //them danh sach vao bang inventory hang ton kho
                            //kiem tra material_id da ton tai trong bang inventory chua
                            //neu da ton tai thi cap nhat quantity, con chua thi them moi
                            if($this->Minventory->check_exit_inventory($item['material_id'])){
                                //true, da ton tai, tien hanh cap nhat
                                $inventory = $this->Minventory->get_inventory($item['material_id']);
                                $quantity_inventory = $inventory['quantity'] + $item['quantity'];

                                $data_inventory = array(
                                    'quantity' => $quantity_inventory,
                                    'update_at' => date('Y-m-d',time())
                                );

                                //cap nhat
                                $this->Minventory->update($item['material_id'],$data_inventory);
                            }else{
                                //false, tien hanh them moi
                                $this->Minventory->insert($item);
                            }

                            //================
                            $item['import_id'] = $insert_id;
                            if($this->Mimport_detail->insert($item)){
                                $flag = true;
                            }else{
                                $flag = false;
                           }
                        }

                        //check flag
                        if($flag == true){
                            $this->session->set_flashdata("msg_exim_overview_success","Nhập kho thành công!");

                            //reidrect
                            redirect(base_url().'exim_overview/index');
                        }else{
                            $this->session->set_flashdata("msg_exim_overview_error","Nhập kho chưa thành công!");
                        }
                    }

                }

            }
        }

        //view
        $this->load->view('exim_overview/import', $this->_data);
    }

    /*
     * export
     */
    public function export(){
        $this->_data['page_title'] = 'Xuất kho - Admin';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        if($this->input->post()){
            $this->form_validation->set_rules('customer_id','Khách hàng','required');
            $this->form_validation->set_rules('quantity[]','Số lượng','greater_than[0]');

            if($this->form_validation->run() == true){
                $customer_id = $this->input->post('customer_id');
                $material_id = $this->input->post('material_id');
                $quantity = $this->input->post('quantity');

                $data =  array();
                @$total_quantity = 0;
                @$amount = 0;
                for ($i = 0; $i < count($material_id); $i++){
                    //kiem tra so luong trong kho co dap ung so luong xuat kho,
                    $inventory_check = $this->Minventory->get_inventory($material_id[$i]);

                    if($quantity[$i] > $inventory_check['quantity']){
                        //neu so luong xuat lon hon so luong ton kho thi so luong ton kho
                        //them vao data
                        $data[] = array(
                            'material_id' => $material_id[$i],
                            'quantity' => $inventory_check['quantity'], //lay so luong ton kho con lai
                            'create_at' => date('Y-m-d',time())
                        );
                        @$total_quantity += $inventory_check['quantity'];
                    }else{
                        //con dap ung thi lay so luong xuat thuc te
                        //them vao data
                        $data[] = array(
                            'material_id' => $material_id[$i],
                            'quantity' => $quantity[$i],
                            'create_at' => date('Y-m-d',time())
                        );
                        @$total_quantity += $quantity[$i];
                    }

                    //kiem tra khach hang thuoc cap dai ly may (1,2,3,4) de tinh tien
                    $customer = $this->globals->get_customer($customer_id);
                    if($customer['type'] == 1){
                        //dai ly cap 1 => price_ex1
                        @$material = $this->globals->get_material($material_id[$i]);
                        @$amount += $quantity[$i]*$material['price_ex1'];
                    }else if($customer['type'] == 2){
                        //dai ly cap 2 => price_ex2
                        @$material = $this->globals->get_material($material_id[$i]);
                        @$amount += $quantity[$i]*$material['price_ex2'];
                    }else if($customer['type'] == 3){
                        //dai ly cap 3 => price_ex3
                        @$material = $this->globals->get_material($material_id[$i]);
                        @$amount += $quantity[$i]*$material['price_ex3'];
                    }else if($customer['type'] == 4){
                        //dai ly cap 4 => price_ex4
                        @$material = $this->globals->get_material($material_id[$i]);
                        @$amount += $quantity[$i]*$material['price_ex4'];
                    }
                    //------------------------------

                }

                //thuc hien insert exim_overview va export_detail
                if($data){
                    //insert exim_overview
                    $data_exim = array(
                        'code' => strtoupper('XH-'.md5(uniqid())),
                        'quantity' => $total_quantity,
                        'total' => $amount,
                        'type' => 1, // export
                        'create_at' => date('Y-m-d',time())
                    );
                    $insert_id = $this->Mexim_overview->insert($data_exim);
                    if($insert_id){
                        //thuc hien insert export_detail
                        foreach ($data as $item){
                            //tinh lai hang ton kho sau khi xuat trong bang inventory
                            //kiem tra material_id da ton tai trong bang inventory chua
                            //neu da ton tai thi thuc hien tinh toan
                            if($this->Minventory->check_exit_inventory($item['material_id'])){
                                //true, da ton tai, tien hanh cap nhat lai so luong sau khi xuat
                                $inventory = $this->Minventory->get_inventory($item['material_id']);
                                $quantity_inventory = $inventory['quantity'] - $item['quantity'];

                                $data_inventory = array(
                                    'quantity' => $quantity_inventory,
                                    'update_at' => date('Y-m-d',time())
                                );

                                //cap nhat
                                $this->Minventory->update($item['material_id'],$data_inventory);
                            }

                            //================
                            $item['export_id'] = $insert_id;
                            $item['customer_id'] = $customer_id;
                            if($this->Mexport_detail->insert($item)){
                                $flag = true;
                            }else{
                                $flag = false;
                            }
                        }

                        //check flag
                        if($flag == true){
                            $this->session->set_flashdata("msg_exim_overview_success","Xuất kho kho thành công!");

                            //reidrect
                            redirect(base_url().'exim_overview/index');
                        }else{
                            $this->session->set_flashdata("msg_exim_overview_error","Xuất kho chưa thành công!");
                        }
                    }

                }

            }
        }

        //view
        $this->load->view('exim_overview/export', $this->_data);
    }


    /*
     * del
     */
    public function del(){
        //kiem tra login
        $login = $this->session->get_userdata();
        $email = @$login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        if($email){
            if($this->input->post()){
                $id = $this->input->post('id');

                //xoa du lieu bang exim_overvew
                //kiem tra xem xoa du lieu import hay export thong qua type
                $exim_overview = $this->globals->get_exim_overview($id);

                if($this->Mexim_overview->delete($id)){

                    if($exim_overview['type'] == 0){
                        //xoa bang import detail
                        $this->Mimport_detail->delete($id);
                    }else if($exim_overview['type'] == 1){
                        //xoa bang export detail
                        $this->Mexport_detail->delete($id);
                    }

                    return 'success';
                }else{
                    return 'error';
                }
            }
        }else{
            redirect(base_url().'auth/login');
        }
    }

    /*
     * show import detail
     */
    public function show_import_detail(){
        $this->_data['page_title'] = 'Thông tin nhập kho nguyên liệu - Admin';
        //kiem tra login
        $login = $this->session->get_userdata();
        $email = @$login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        $id = intval($this->uri->rsegment(3));
        if($id){
            //hien thi danh sach
            $list_import_detail = $this->Mimport_detail->get_all_import_detail($id);
            $this->_data['list_import_detail'] = $list_import_detail;

            //hien thi thong tin exim_overview
            @$exim_overview = $this->Mexim_overview->get_exim_overview($id);
            $this->_data['info_exim'] = $exim_overview;
        }

        //view
        $this->load->view('exim_overview/show_import_detail', $this->_data);

    }

    /*
    * show export detail
    */
    public function show_export_detail(){
        $this->_data['page_title'] = 'Thông tin xuất kho nguyên liệu - Admin';
        //kiem tra login
        $login = $this->session->get_userdata();
        $email = @$login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        $id = intval($this->uri->rsegment(3));
        if($id){
            //hien thi danh sach
            $list_export_detail = $this->Mexport_detail->get_all_export_detail($id);
            $this->_data['list_export_detail'] = $list_export_detail;

            //hien thi thong tin exim_overview
            @$exim_overview = $this->Mexim_overview->get_exim_overview($id);
            $this->_data['info_exim'] = $exim_overview;
        }

        //view
        $this->load->view('exim_overview/show_export_detail', $this->_data);

    }

}
?>