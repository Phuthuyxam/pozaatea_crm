<?php
class Permissions extends CI_Controller{
    protected $_data;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Mgroups');
        $this->load->model('Mpermissions');
        $this->load->model('Musers');
        $this->load->library('Globals');
    }

    /*
     * index
     */
    public function index()
    {

        //lay typy de xac dinh phan quyen cho chuc nang nao
        if (isset($_GET['module']) && $_GET['module']) {
            @$module = $_GET['module'];
            $this->_data['get_module'] = @$module;
        }

        $this->_data['page_title'] = 'Phân quyền';
        $login = $this->session->get_userdata();
        $user_email = $login['user_login'];
        $this->_data['user_info'] = $this->Musers->get_user_info($user_email);

        //hien thi danh sach nhom
        $list_groups = $this->Mgroups->get_all_groups();
        $this->_data['list_groups'] = $list_groups;

        //thuc hien set quyen ===========================================
        if($this->input->post()) {
            //tien hanh xoa het phan quyen cu truoc khi set quyen moi
            $this->Mpermissions->delete(@$module);
            //phan quyen theo nhom
            foreach ($list_groups as $item_gr) {
                @$permissions = $_POST['gr_permission' . $item_gr['id']];
                if ($permissions) {
                    $arr_gr = array(
                        'group_id' => $item_gr['id'],
                        'content' => json_encode($permissions),
                        'module' => @$module
                    );
                    $arr_all_gr[] = @$arr_gr;
                }

            }
            //            echo '<pre>';
            //            print_r($arr_all_gr);
            //thuc hien insert
            if(@$arr_all_gr){
                foreach (@$arr_all_gr as $row) {
                    @$data = $row;
                    if ($data) {
                        $this->Mpermissions->insert($data);
                    }
                }
            }


        }
        // ======================================
        //thuc hien hien thi cac quyen nhom ===================================
        foreach ($list_groups as $key=>$item){
            $permission_gr = $this->Mpermissions->get_permissions_groups($item['id'], @$module);
            $all_gr[$key]['group_id'] = $item['id'];
            $all_gr[$key]['content'] = json_decode($permission_gr['content'],true);

        }
        $this->_data['all_gr'] = $all_gr;

        $this->load->view('permissions/index', $this->_data);
    }
}