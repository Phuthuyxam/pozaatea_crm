<?php
Class Mhome extends CI_Model{

    protected $_table='customers';

    public function __construct()
    {
        parent::__construct();
    }

    /*
    * update
    */

        public function update($id, $data_update){
            $this->db->where('id', $id);
            $this->db->update($this->_table, $data_update);
            if($this->db->affected_rows()){
                return true;
            }else{
                return false;
            }
        }
}
?>