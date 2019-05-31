<?php
Class Mauth extends CI_Model{

    protected $_table='users';

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
     * get_user_info
     */
    public function get_user_info($email)
    {
        $this->db->where('email', $email);
        return $this->db->get($this->_table)->row_array();
    }
}
?>