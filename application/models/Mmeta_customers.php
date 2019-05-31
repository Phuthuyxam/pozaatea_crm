<?php
class Mmeta_customers extends CI_Model{
    protected $_table = 'meta_customers';

    public function __construct()
    {
        parent::__construct();
    }

    /*
     * list
     */
    public function get_all_meta_customers(){
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }

    /*
     * add
     */
    public function insert($data_insert){
        $query = $this->db->insert($this->_table, $data_insert);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    /*
     * get_attr_customers
     */
    public function get_meta_customers($customer_id){
        $this->db->select('a.key, a.name,m.id, m.value');
        $this->db->from('meta_customers m');
        $this->db->join('attr_customers a','m.key = a.key','inner');
        $this->db->where('m.customer_id', $customer_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    /*
     * update
     */
    public function update($key, $customer_id, $data_update){
        $this->db->where('key', $key);
        $this->db->where('customer_id', $customer_id);
        $query = $this->db->update($this->_table, $data_update);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    /*
     * delete
     */
    public function delete($id){
        $this->db->where('customer_id', $id);
        $query = $this->db->delete($this->_table);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    /*
     * get_meta_value_customers
     */
    public function get_meta_value_customers($key, $customer_id){
        $this->db->where(array('key' => $key, 'customer_id' => $customer_id));
        $query =  $this->db->get($this->_table)->row_array();
        return $query;
    }

    /*
     * check meta da ton tai chua?
     */
    public function check_meta_customer($customer_id, $key){
        $this->db->where(array('customer_id' => $customer_id, 'key' => $key));
        $query =  $this->db->get($this->_table)->num_rows();
        if($query > 0){
            return true;
        }else{
            return false;
        }
    }
}