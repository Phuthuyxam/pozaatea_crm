<?php
class Mgroups extends CI_Model
{
    protected $_table = 'groups';
    public function __construct()
    {
        parent::__construct();

    }

    public function get_all_groups(){
        $this->db->order_by('create_at','asc');
        $query = $this->db->get($this->_table);
        return $query->result_array();
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
        $this->db->where('id', $id);
        $query = $this->db->delete($this->_table);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }

    public function get_group($id){
        $this->db->where('id', $id);
        $query = $this->db->get($this->_table);
        return $query->row_array();
    }

    /*
     * check user thuoc group
     */
    public function check_user($id){
        $this->db->where('group_id', $id);
        $query = $this->db->get('users')->row_array();
        if($query > 0){
            return false;
        }else{
            return true;
        }
    }

}
?>