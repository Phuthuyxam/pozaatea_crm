<?php
class Mpermissions extends CI_Model{
    protected $_table = 'permissions';

    public function __construct()
    {
        parent::__construct();

    }

    public function insert($data){
        $query = $this->db->insert($this->_table, $data);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function get_permissions_groups($group_id, $module){
        $this->db->select('content');
        $this->db->from('permissions');
        $this->db->where(array('group_id' => $group_id, 'module' => $module));
        $query = $this->db->get();
        return $query->row_array();
    }


    public function delete($module){
        $this->db->where('module', $module);
        $this->db->delete($this->_table);
    }


    /*
     * get group permission
     */
    public function get_group_permission($group_id, $module){
        $this->db->where(array('group_id'=> $group_id, 'module' =>$module));
        $query = $this->db->get($this->_table);
        return $query->row_array();
    }
}