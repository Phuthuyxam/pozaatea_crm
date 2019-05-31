<?php
class Minventory extends CI_Model
{
    protected $_table = 'inventory';
    public function __construct()
    {
        parent::__construct();

    }

    /*
     * insert
     */
    public function insert($data){
        $this->db->insert($this->_table, $data);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }

    }

    /*
     * update
     */
    public function update($material_id, $data){
        $this->db->where('material_id',$material_id);
        $this->db->update($this->_table, $data);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }

    }

    /*
    * del
    */
    public function delete($import_id){
        $this->db->where('import_id',$import_id);
        $this->db->delete($this->_table);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }

    /*
     * check exit
     */
    public function check_exit_inventory($material_id){
        $this->db->where('material_id',$material_id);
        $query = $this->db->get($this->_table)->num_rows();
        if($query > 0){
            return true;
        }else{
            return false;
        }
    }

    /*
     * get inventory
     */
    public function get_inventory($material_id){
        $this->db->where('material_id',$material_id);
        $query = $this->db->get($this->_table)->row_array();
        return $query;
    }

    /*
     * show detail
     */
    public function get_all_inventory(){
        $this->db->select('ivt.id, ivt.material_id, ivt.quantity, m.name,');
        $this->db->from('inventory ivt');
        $this->db->join('materials m','ivt.material_id = m.id','inner');
        $this->db->where('quantity > ',0);
        $this->db->order_by('ivt.create_at','DESC');
        $query = $this->db->get()->result_array();
        return $query;
    }




}
?>