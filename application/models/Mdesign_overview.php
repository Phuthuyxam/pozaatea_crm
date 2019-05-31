<?php
class Mdesign_overview extends CI_Model
{
    protected $_table = 'design_overview';
    public function __construct()
    {
        parent::__construct();

    }


    public function insert($data){
        $this->db->insert($this->_table, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
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

    public function delete($id){
        $this->db->where('sale_id', $id);
        $query = $this->db->delete($this->_table);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
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

    public function get_design_id($sale_id){
        $this->db->select('id');
        $this->db->from($this->_table);
        $this->db->where('sale_id', $sale_id);
        $query = $this->db->get()->row_array();
        return $query;
    }

}
?>