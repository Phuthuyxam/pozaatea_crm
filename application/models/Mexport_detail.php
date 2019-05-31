<?php
class Mexport_detail extends CI_Model
{
    protected $_table = 'export_detail';
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
    * del
    */
    public function delete($import_id){
        $this->db->where('export_id',$import_id);
        $this->db->delete($this->_table);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }

    /*
     * show detail
     */
    public function get_all_export_detail($id_detail){
        $this->db->select('ex.quantity,ex.customer_id, exim.code, exim.quantity as total_quantity, exim.total, exim.create_at, 
         m.name, m.price_ex1,m.price_ex2,m.price_ex3,m.price_ex4, m.unit');
        $this->db->from('export_detail ex');
        $this->db->join('exim_overview exim','ex.export_id = exim.id','inner');
        $this->db->join('materials m','ex.material_id = m.id','inner');
        $this->db->where('ex.export_id',$id_detail);
        $this->db->order_by('ex.create_at','DESC');
        $query = $this->db->get()->result_array();
        return $query;
    }


}
?>