<?php
class Mmkt_detail extends CI_Model
{
    protected $_table = 'mkt_detail';
    public function __construct()
    {
        parent::__construct();

    }

    public function delete($id){
        $this->db->where('customer_id', $id);
        $this->db->delete($this->_table);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }

    //=================== phan danh cho detail =======================================

    /*
     * list detail
     */
    public function get_all_mkt_detail($cutomer_id){
        $this->db->select('m.id, m.create_at, m.time_callback,m.is_action, m.content,c.marketer_id');
        $this->db->from('mkt_detail m');
        $this->db->join('customers c','m.customer_id = c.id','inner');
        $this->db->where('m.customer_id',$cutomer_id);
        $this->db->order_by('m.create_at','DESC');
        $query = $this->db->get()->result_array();
        return $query;
    }

    /*
     * insert dung chung cho overview, detail
     */

    public function insert($data){
        $this->db->insert($this->_table, $data);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }

    public function update($id, $data){
        $this->db->where('id', $id);
        $query = $this->db->update($this->_table, $data);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function delete_detail($input = array()){
        $this->db->where($input);
        $this->db->delete($this->_table);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }

}
?>