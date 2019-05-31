<?php
Class Mauth extends CI_Model{

    protected $_table='customers';

    public function __construct()
    {
        parent::__construct();
    }

    /*
     * check_login
     */
    public function check_login($email, $password)
    {
        $this->db->where(array('email'=>$email, 'password'=>$password));
        $query = $this->db->get($this->_table)->num_rows();
        if($query > 0){
            return true;
        }else{
            return false;
        }
    }


    /*
     * get_cus_info
     */
    public function get_customer_info($email)
    {
        $this->db->where('email', $email);
        return $this->db->get($this->_table)->row_array();
    }

    public function check_email($email)
    {

        $this->db->where('email', $email);
        $query = $this->db->get($this->_table);
        if ($query->num_rows()>0)
        {
            return true;
        }

        return false;
    }


    /*
     * update forgot code
     */
    public function update_forgot_code($email, $data){
        $this->db->where('email', $email);
        $query = $this->db->update($this->_table, $data);
        if($query){
            return true;
        }else{
            return false;
        }
    }
}
?>