<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtickets extends CI_Model {

    protected $_table = 'tickets';

    
    public function __construct()
    {
        parent::__construct();
        
    }
    public function get_all_tickets(){
        $this->db->where('parent_id',0);
        $this->db->order_by('create_at','asc');
        $query = $this->db->get($this->_table)->result_array();
        return $query;
    }

    public function get_full_tickets(){
        // $this->db->where('parent_id',0);
        $this->db->order_by('create_at','asc');
        $query = $this->db->get($this->_table)->result_array();
        return $query;
    }
    public function insert($data_insert){
        $this->db->insert($this->_table, $data_insert);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function update($id, $data_update){
        $this->db->where('id', $id);
        $query = $this->db->update($this->_table, $data_update);
        if($query){
            return true;
        }else{
            return false;
        }
    }
    public function get_ticket($id){
        $this->db->where('id', $id);
        $query = $this->db->get($this->_table)->row_array();
        return $query;
    }

    public function get_all_tickets_by_customer_id($cus_id){
        $this->db->where('customer_id', $cus_id);
        $query = $this->db->get($this->_table)->result_array();
        return $query;
    }
    public function get_tickets_by_customer_id($cus_id){
        $this->db->where('customer_id', $cus_id);
        $query = $this->db->get($this->_table)->row_array();
        return $query;
    }

    
    

}

/* End of file ModelName.php */

?>