<?php
class Msales_overview extends CI_Model{
    protected $_table = 'sales_overview';

    public function __construct()
    {
        parent::__construct();

    }

    /*
     * them moi
     */
    public function insert($data_insert){
        $this->db->insert($this->_table, $data_insert);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }



    /*
     * del
     */
    public function delete($id){
        $this->db->where('customer_id', $id);
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
    public function get_customer_sale($id, $input = array()){
        $this->db->select('c.name, c.email, c.phone, c.level_id, c.link_tracking, c.service_id, c.marketer_id, c.source_id,
        c.telesale_id,s.id, s.customer_id, s.status_care_id, s.note, s.opening_date, s.duration, s.deposit, s.contract');
        $this->db->from('customers c');
        $this->db->join('sales_overview s','c.id = s.customer_id','inner');
        $this->db->where('s.customer_id', $id);
        //kiem tra theo is_sale
        $this->get_list_set_input($input);
        //
        $this->db->order_by('s.create_at','asc');
        $query = $this->db->get()->row_array();
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
     * update
     */
    public function update($id, $data_update){
        $this->db->where('customer_id', $id);
        $this->db->update($this->_table, $data_update);
        if($this->db->affected_rows()){
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

    public function check_sale_id_exit($sale_id){
        $this->db->where('sale_id',$sale_id);
        $query = $this->db->get($this->_table)->num_rows();
        if($query > 0){
            return true;
        }else{
            return false;
        }
    }

    /*
    * lay thong tin khach hang
    */
    public function get_customers_is_sale_detail($sale_id){
        $this->db->select('customer_id');
        $this->db->where('id', $sale_id);
        $query = $this->db->get($this->_table);
        return $query->row_array();
    }


}