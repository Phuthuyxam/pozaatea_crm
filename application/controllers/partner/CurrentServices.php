<?php 

	Class CurrentServices extends CI_Controller
	{
		protected  $_data;

	    public function __construct()
	    {
	        parent::__construct();

	        $this->load->helper('url');
	        $this->load->model('Mservices');
	        
	        $this->load->model('Mcustomers');
	        $this->load->library('Globals');
	    }


	    public function index()
	    {
	    	$login = $this->session->get_userdata();
	    	$infoCustomer = $this->Mcustomers->get_customer($login['customer_login_id']);

	    	$service = $this->Mservices->get_service($infoCustomer['service_id']);
	    
	    	$this->_data['service'] = $service;
	    	$this->_data['page_title'] = "Dịch vụ đang dùng";
	    	
	    	$this->load->view('partner/currentservices/index', $this->_data);
	    	
	    }
	}


 ?>