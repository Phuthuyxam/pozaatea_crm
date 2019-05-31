<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Mshops extends CI_Model {

    protected $_table = 'shops';

    public function __construct()
    {
        parent::__construct();
        
    }
    //  get all shops order bay create_at
    public function get_all_shops(){
        $this->db->order_by('create_at','asc');
        $query = $this->db->get($this->_table)->result_array();
        return $query;
    }

    public function insert($data_insert){
        $this->db->insert($this->_table, $data_insert);
        $insert_id = $this->db->insert_id();
        return $insert_id;
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

    public function delete($id){
        $this->db->where('id', $id);
        // $this->db->where('email !=', $email);
        $query = $this->db->delete($this->_table);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }
    /*
     * get shop
     */
    public function get_shop($id){
        $this->db->where('id', $id);
        $query = $this->db->get($this->_table)->row_array();
        return $query;
    }
    

}
/* End of file ModelName.php */
?>