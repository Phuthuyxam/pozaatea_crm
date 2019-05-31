<?php
class Mattr_customers extends CI_Model{
    protected $_table = 'attr_customers';

    public function __construct()
    {
        parent::__construct();
    }

    /*
     * list
     */
    public function get_all_attr_customers(){
        $this->db->order_by('create_at', 'asc');
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }

    /*
     * add
     */
    public function insert($data_insert){
        $query = $this->db->insert($this->_table, $data_insert);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    /*
     * get_attr_customers
     */
    public function get_attr_customer($id){
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
     * delete
     */
    public function delete($id){
        $this->db->where('id', $id);
        $query = $this->db->delete($this->_table);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }

    /*
     * check attr_customers exit
     */
    public function check_attr_customers_exit($key){
        $this->db->where('key', $key);
        $query = $this->db->get($this->_table)->num_rows();
        return $query;
    }
}