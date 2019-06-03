<?php 
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Mleades extends CI_Model {

        protected $_table = 'leads';

        /*
        * insert
        */
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
        
    
    }
    
    /* End of file ModelName.php */
    
?>
