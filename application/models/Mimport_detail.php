<?php
class Mimport_detail extends CI_Model
{
    protected $_table = 'import_detail';
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
        $this->db->where('import_id',$import_id);
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
    public function get_all_import_detail($id_detail){
        $this->db->select('im.quantity, exim.code, exim.quantity as total_quantity, exim.total, exim.create_at, 
         m.name, m.price_im, m.unit');
        $this->db->from('import_detail im');
        $this->db->join('exim_overview exim','im.import_id = exim.id','inner');
        $this->db->join('materials m','im.material_id = m.id','inner');
        $this->db->where('im.import_id',$id_detail);
        $this->db->order_by('im.create_at','DESC');
        $query = $this->db->get()->result_array();
        return $query;
    }


}
?>