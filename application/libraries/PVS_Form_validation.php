<?php

class PVS_Form_validation extends CI_Form_validation{

    public function edit_unique($str, $field)
    {
        sscanf($field, '%[^.].%[^.].%[^.]', $table, $field, $value);
        return isset($this->CI->db)
            ? ($this->CI->db->limit(1)->get_where($table, array(''.$field.' !=' => $value))->num_rows() === 0)
            : FALSE;
    }
}
?>