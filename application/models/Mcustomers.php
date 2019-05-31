<?php
class Mcustomers extends CI_Model{
    protected $_table = 'customers';

    public function __construct()
    {
        parent::__construct();

    }

    /*
     * them moi
     */
    public function insert($data_insert){
        $query = $this->db->insert($this->_table, $data_insert);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }


    /*
     *
     */
    public function get_all_customers_filter($input = array()){
        //xu ly du lieu dau vao
        $this->get_list_set_input($input);
        //lay du lieu
        $this->db->order_by('create_at','asc');
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }

    /*
     * mkt
     */
    public function get_all_customers_filter_mkt($input = array()){
        //xu ly du lieu dau vao
        $this->get_list_set_input($input);
        //lay du lieu
        $this->db->order_by('create_at','asc');
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }

    /*
     * sales
     */
    public function get_all_customers_filter_sales($input = array()){
        //xu ly du lieu dau vao
        if(@$input){
            foreach ($input as $item){
                $this->db->where($item);
            }
        }
        //ket qua
        $this->db->select('c.id, c.name, c.email, c.phone, c.level_id, c.link_tracking, c.service_id, c.marketer_id, c.source_id,
        c.telesale_id,c.create_at, c.status, s.id as sale_id, s.customer_id, s.status_care_id, s.note, s.opening_date, s.duration, s.deposit, s.contract');
        $this->db->from('customers c');
        $this->db->join('sales_overview s','c.id = s.customer_id','inner');
        $this->db->order_by('s.create_at','asc');
        $query = $this->db->get()->result_array();
        return $query;
    }

    /*
     * care
     */
    public function get_all_customers_filter_care($input = array()){

        //------------------------
        $this->db->select('c.name, c.email, c.phone, c.level_id, c.link_tracking, c.service_id, c.marketer_id,
        c.telesale_id, c.create_at, s.id, s.customer_id, s.status_care_id, s.note, s.opening_date, s.duration, s.deposit, s.contract,
        care.create_at as time_level');
        $this->db->from('sales_overview s');
        $this->db->join('care_overview care','s.id = care.sale_id','inner');
        $this->db->join('customers c','s.customer_id = c.id','inner');
        //xu ly du lieu dau vao
        $this->get_list_set_input($input);
        //ket qua
        $this->db->order_by('care.create_at','asc');
        $query = $this->db->get()->result_array();
        return $query;
    }

    /*
     * accountant
     */
    public function get_all_customers_filter_accountant($input = array()){

        //------------------------
        $this->db->select('c.name, c.email, c.phone, c.level_id, c.link_tracking, c.service_id, c.marketer_id,
        c.telesale_id, c.create_at, s.id, s.customer_id, s.status_care_id, s.note, s.opening_date, s.duration, s.deposit, s.contract,
        acc.create_at as time_level');
        $this->db->from('sales_overview s');
        $this->db->join('accountant_overview acc','s.id = acc.sale_id','inner');
        $this->db->join('customers c','s.customer_id = c.id','inner');
        //xu ly du lieu dau vao
        $this->get_list_set_input($input);
        //ket qua
        $this->db->order_by('acc.create_at','asc');
        $query = $this->db->get()->result_array();
        return $query;
    }

    /*
     * design
     */
    public function get_all_customers_filter_design($input = array()){

        //------------------------
        $this->db->select('c.name, c.email, c.phone, c.level_id, c.link_tracking, c.service_id, c.marketer_id,
        c.telesale_id, c.create_at, s.id, s.customer_id, s.status_care_id, s.note, s.opening_date, s.duration, s.deposit, s.contract,
        des.create_at as time_level');
        $this->db->from('sales_overview s');
        $this->db->join('design_overview des','s.id = des.sale_id','inner');
        $this->db->join('customers c','s.customer_id = c.id','inner');
        //xu ly du lieu dau vao
        $this->get_list_set_input($input);
        //ket qua
        $this->db->order_by('des.create_at','asc');
        $query = $this->db->get()->result_array();
        return $query;
    }

    /*
     * support
     */
    public function get_all_customers_filter_support($input = array()){

        //------------------------
        $this->db->select('c.name, c.email, c.phone, c.level_id, c.link_tracking, c.service_id, c.marketer_id,
        c.telesale_id, c.create_at, s.id, s.customer_id, s.status_care_id, s.note, s.opening_date, s.duration, s.deposit, s.contract,
        sp.create_at as time_level');
        $this->db->from('sales_overview s');
        $this->db->join('support_overview sp','s.id = sp.sale_id','inner');
        $this->db->join('customers c','s.customer_id = c.id','inner');
        //xu ly du lieu dau vao
        $this->get_list_set_input($input);
        //ket qua
        $this->db->order_by('sp.create_at','asc');
        $query = $this->db->get()->result_array();
        return $query;
    }


    /*
     * lay dieu kien
     */
    protected function get_list_set_input($input = array()){

        //dieu kien where
        if(isset($input['where']) && $input['where']){
            $this->db->where($input['where']);
        }

        //dieu kien like
        if(isset($input['like']) && $input['like']){
            $this->db->or_like($input['like']);
        }

    }

    /*
     * delivery
     */
    public function delivery_mkt($id,$data){
        $this->db->where('id', $id);
        $query = $this->db->update($this->_table, $data);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }

    /*
     * del
     */
    public function delete($id){
        $this->db->where('id', $id);
        $this->db->where('status != ', 2); // status = 2 khong duoc xoa
        $this->db->delete($this->_table);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }

    /*
    * del mkt
    */
    public function delete_customer_mkt($id){
        $this->db->where('id', $id);
        $this->db->where('status != ', 2); // status = 2 khong duoc xoa
        $this->db->delete($this->_table);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }

    /*
     * delete_customer_sale
     */
    public function delete_customer_sale($id){
        $this->db->where('id', $id);
        $this->db->delete($this->_table);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }

    /*
     * lay thong tin khach hang
     */
    public function get_customer($id){
        $this->db->where('id', $id);
        $query = $this->db->get($this->_table);
        return $query->row_array();
    }


    /*
     * update
     */
    public function update($id, $data_update){
        $this->db->where('id', $id);
        $query = $this->db->update($this->_table, $data_update);
        if($query){
            return true;
        }else{
            return false;
        }
    }


    /*
     * check email by edit
     */

    public function check_email_by_edit($id, $email){
        $this->db->where('id != ', $id);
        $this->db->where('email', $email);
        $query = $this->db->get($this->_table);
        if($query->row_array() > 0){
            return false;
        }else{
            return true;
        }
    }

    /*
     * check before delete setup
     */
    public function check_before_delete($input = array()){
        if(isset($input['where']) && $input['where']){
            $this->db->where($input['where']);
            $query = $this->db->get($this->_table)->num_rows();
            if($query > 0){
                return false;
            }else{
                return true;
            }
        }
    }


    /*
    * lay thong tin khach hang
    */
    public function get_customers_is_sale($telesale_id){
        $this->db->select('id');
        $this->db->where('telesale_id', $telesale_id);
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }


}