<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pre_supports extends CI_Controller
{

    protected $_data;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('partner/Mauth');
        $this->load->model('partner/Mhome');
        $this->load->model('Mcustomers');
        $this->load->model('Mmkt_detail');
        $this->load->model('Msales_overview');
        $this->load->model('Msales_detail');
        $this->load->model('Mcare_overview');
        $this->load->model('Mcare_detail');
        $this->load->model('Mdesign_overview');
        $this->load->model('Mdesign_detail');
        $this->load->model('Msupport_overview');
        $this->load->model('Msupport_detail');
        $this->load->model('Mattr_customers');
        $this->load->model('Mmeta_customers');
        $this->load->library('Globals');
    }

    public function index($id)
    {

        $this->_data['page_title'] = 'Danh sách khách hàng';
        $is_action = intval($this->uri->rsegment(3));
        if ($is_action) {
            if ($is_action == 1) {
                $this->_data['page_title'] = 'Danh sách khách hàng sau khai trương';
            } else {
                $this->_data['page_title'] = 'Danh sách khách hàng trước khai trương';
                $is_action = 0;
            }
            //dữ liệu bảng thiết kế
//            $info = $this->Mdesign_detail->get_design_detail_partner();
//            $this->_data['info_design'] = $info;
            $list_design_detail = $this->Mdesign_detail->get_all_design_detail_partner($is_action);
            $this->_data['list_design_detail'] = $list_design_detail;

            //dữ liệu bảng hỗ trợ
//            $info = $this->Msupport_detail->get_support_detail_partner();
//            $this->_data['info_support'] = $info;
            $list_support_detail = $this->Msupport_detail->get_all_support_detail_partner($is_action);
            $this->_data['list_support_detail'] = $list_support_detail;

            //dữ liệu bảng CSKH
//            $info = $this->Mcare_detail->get_care_detail_partner();
//            $this->_data['info_cskh'] = $info;
            $list_care_detail = $this->Mcare_detail->get_all_care_detail_partner($is_action);
            $this->_data['list_care_detail'] = $list_care_detail;

            //dữ liệu phòng sales
//            $info = $this->Msales_detail->get_sale_detail_partner();
//            $this->_data['info_sales'] = $info;
            $list_sales_detail = $this->Msales_detail->get_all_sales_detail_partner($is_action);
            $this->_data['list_sales_detail'] = $list_sales_detail;

            //dữ liệu phòng mkt
            $list_mkt_detail = $this->Mmkt_detail->get_all_mkt_detail_partner($is_action);
            $this->_data['list_mkt_detail'] = $list_mkt_detail;

            $this->load->view('partner/pre_supports/index', $this->_data);
        }

    }
}
