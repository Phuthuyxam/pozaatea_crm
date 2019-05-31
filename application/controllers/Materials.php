<?php 
class Materials extends CI_Controller
{
    protected  $_data;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Mmaterials');
        $this->load->model('Musers');
        $this->load->library('Globals');
    }


    public function index()
    {
        $this->_data['page_title'] = 'Danh sách nguyên liệu';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info; 

        // Hiển thị danh sách
        $list_materials = $this->Mmaterials->get_all_materials();

        if($list_materials){
            $this->_data['list_materials'] = $list_materials;
        }

        $this->load->view('materials/index.php', $this->_data);

    }


    public function add()
    {
        $this->_data['page_title'] = 'Thêm mới nguyên liệu';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;


        if ($this->input->post()) 
        {
            $this->form_validation->set_rules('name', 'Tên nguyên liệu', 'required');
            // $this->form_validation->set_rules('description', '', 'required');
            $this->form_validation->set_rules('price_im', 'Giá nhập', 'required');
            $this->form_validation->set_rules('price_ex1', 'Giá bán cấp 1', 'required');
            $this->form_validation->set_rules('price_ex2', 'Giá bán cấp 2', 'required');
            $this->form_validation->set_rules('price_ex3', 'Giá bán cấp 3', 'required');
            $this->form_validation->set_rules('price_ex4', 'Giá bán cấp 4', 'required');
            $this->form_validation->set_rules('price_single', 'Giá bán lẻ', 'required');
            $this->form_validation->set_rules('unit', 'Đơn vị', 'required');

            if($this->form_validation->run())
            {
                $name = $this->input->post('name');
                $description = $this->input->post('description');
                $price_im = $this->input->post('price_im');
                $price_ex1 = $this->input->post('price_ex1');
                $price_ex2 = $this->input->post('price_ex2');
                $price_ex3 = $this->input->post('price_ex3');
                $price_ex4 = $this->input->post('price_ex4');
                $price_single = $this->input->post('price_single');
                $unit = $this->input->post('unit');
                $create_at = date('Y-m-d', time());

                $data_insert = array(
                    'name' => $name,
                    'description' => ($description)?$description:'',
                    'price_im' => $price_im,
                    'price_ex1' => $price_ex1,
                    'price_ex2' => $price_ex2,
                    'price_ex3' => $price_ex3,
                    'price_ex4' => $price_ex4,
                    'price_single' => $price_single,
                    'unit' => $unit,
                    'create_at' =>$create_at,

                );

                //thuc hien
                $insert_id = $this->Mmaterials->insert($data_insert);

                if(!empty($insert_id)){
                    $this->session->set_flashdata('msg_materials_success', 'Sửa nguồn thành công');
                    //redirect
                    redirect(base_url().'materials/index');
                }else{
                    $this->session->set_flashdata('msg_materials_error', 'Sửa nguồn chưa thành công');
                }


            }
        }
        //view
        $this->load->view('materials/add.php', $this->_data);
    }


    public function edit()
    {
        $this->_data['page_title'] = 'Sửa nguyên liệu';
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        //hien thi thong tin chinh sua
        $id = intval($this->uri->rsegment(3));
        if($id)
        {
            $info_group = $this->Mmaterials->get_material($id);
            $this->_data['info'] = $info_group;
        }

        if($this->input->post()){
            $this->form_validation->set_rules('name', 'Tên nguyên liệu', 'required');
            // $this->form_validation->set_rules('description', '', 'required');
            $this->form_validation->set_rules('price_im', 'Giá nhập', 'required');
            $this->form_validation->set_rules('price_ex1', 'Giá bán cấp 1', 'required');
            $this->form_validation->set_rules('price_ex2', 'Giá bán cấp 2', 'required');
            $this->form_validation->set_rules('price_ex3', 'Giá bán cấp 3', 'required');
            $this->form_validation->set_rules('price_ex4', 'Giá bán cấp 4', 'required');
            $this->form_validation->set_rules('price_single', 'Giá bán lẻ', 'required');
            $this->form_validation->set_rules('unit', 'Đơn vị', 'required');

            if($this->form_validation->run()){
                $name = $this->input->post('name');
                $description = $this->input->post('description');
                $price_im = $this->input->post('price_im');
                $price_ex1 = $this->input->post('price_ex1');
                $price_ex2 = $this->input->post('price_ex2');
                $price_ex3 = $this->input->post('price_ex3');
                $price_ex4 = $this->input->post('price_ex4');
                $price_single = $this->input->post('price_single');
                $unit = $this->input->post('unit');
                $update_at = date('Y-m-d', time());


                $data_insert = array(
                    'name' => $name,
                    'description' => ($description)?$description:'',
                    'price_im' => $price_im,
                    'price_ex1' => $price_ex1,
                    'price_ex2' => $price_ex2,
                    'price_ex3' => $price_ex3,
                    'price_ex4' => $price_ex4,
                    'price_single' => $price_single,
                    'unit' => $unit,
                    'update_at' =>$update_at

                );

                //thuc hien
                if($this->Mmaterials->update($id, $data_insert)){
                    $this->session->set_flashdata('msg_materials_success', 'Cập nhật nguồn thành công');

                    //redirect
                    redirect(base_url().'materials/index');
                }else{
                    $this->session->set_flashdata('msg_materials_error', 'Cập nhật nguồn chưa thành công');
                }
            }
        }

        $this->load->view('materials/edit.php', $this->_data);
    }




    public function del($id){
        //kiem tra login
        $login = $this->session->get_userdata();
        $email = $login['user_login'];
        $user_info = $this->Musers->get_user_info($email);
        $this->_data['user_info'] = $user_info;

        // //check group permission
        $arr_permission_check = $this->globals->get_group_permission($user_info['group_id'], 'setup');

        if(in_array("del", $arr_permission_check) == false) {
            redirect('home/index');
        }
        // end check permission group -->

        if($login){
            $id = intval($this->uri->rsegment(3));
            if($this->Mmaterials->delete($id)){
                $this->session->set_flashdata('msg_materials_success', 'Xóa thành công dữ liệu');

                //redirect
                redirect(base_url().'materials/index');
            }else{
                $this->session->set_flashdata('msg_materials_error', 'Xóa chưa thành công dữ liệu');
                redirect(base_url().'materials/index');
            }
        }
        
    }



}

 ?>