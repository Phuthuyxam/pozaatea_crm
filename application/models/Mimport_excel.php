
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mimport_excel extends CI_Model {

    public function importData($data) {

        $res = $this->db->insert_batch('customers',$data);
        if($res){
            return TRUE;
        }else{
            return FALSE;
        }

    }

}

?>
