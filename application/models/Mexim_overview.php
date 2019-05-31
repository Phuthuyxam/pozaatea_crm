<?php
class Mexim_overview extends CI_Model
{
    protected $_table = 'exim_overview';
    public function __construct()
    {
        parent::__construct();

    }

    public function get_list_import(){
        $this->db->select('id, code, quantity, total, create_at');
        $this->db->where('type',0); //type 0 import
        $this->db->order_by('create_at','DESC');
        $query  = $this->db->get($this->_table)->result_array();
        return $query;
    }

    public function get_list_export(){
        $this->db->select('id, code, quantity, total, create_at');
        $this->db->where('type',1); //type 1 export
        $this->db->order_by('create_at','DESC');
        $query  = $this->db->get($this->_table)->result_array();
        return $query;
    }

    /*
     * insert
     */
    public function insert($data){
        $this->db->insert($this->_table, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    /*
     * del
     */
    public function delete($id){
        $this->db->where('id',$id);
        $this->db->delete($this->_table);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }

    /*
     * get all
     */
    public function get_all_exim_overview(){
       $query = $this->db->get($this->_table)->result_array();
       return $query;
    }

    /*
     * get exim
     */
    public function get_exim_overview($id){
        $this->db->where('id',$id);
        $query = $this->db->get($this->_table)->row_array();
        return $query;
    }

    /*
     * get customer by export
     */
    public function get_all_customers(){
        //ket qua
        $this->db->select('c.id, c.name');
        $this->db->from('sales_overview s');
        $this->db->join('customers c','c.id = s.customer_id','inner');
        $this->db->join('care_overview care','s.id = care.sale_id','inner');
        $this->db->order_by('c.create_at','DESC');
        $query = $this->db->get()->result_array();
        return $query;
    }


}
?>