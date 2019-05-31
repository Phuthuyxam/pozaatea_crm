<?php
Class Musers extends CI_Model{
    protected $_table = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    /*
     * get_all
     */
    public function get_all_users(){
        $this->db->order_by('create_at','asc');
        $query = $this->db->get($this->_table)->result_array();
        return $query;
    }

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


    /*
     * get user
     */
    public function get_user($id){
        $this->db->where('id', $id);
        $query = $this->db->get($this->_table)->row_array();
        return $query;
    }

    /*
     * get user info
     */
    public function get_user_info($email){
        $this->db->where('email', $email);
        $query = $this->db->get($this->_table)->row_array();
        return $query;
    }

    /*
     * check email by edit user
     */
    public function check_email_by_edit($email, $id){
        $this->db->where('id != ', $id);
        $this->db->where('email', $email);
        $query = $this->db->get($this->_table);
        if($query->row_array() > 0){
            return false;

        }else{
            return true;
        }
    }

    /*
     * delete
     */
    public function delete($id, $email){
        $this->db->where('id', $id);
        $this->db->where('email !=', $email);
        $query = $this->db->delete($this->_table);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
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

    /*
     * check api
     */
    public function check_api($api_key,$api_secret){
        $this->db->where(array('username' => $api_key, 'api_secret' => $api_secret));
        $query = $this->db->get($this->_table)->num_rows();
        if($query > 0){
            return true;
        }else{
            return false;
        }
    }

    /*
     * check before delete setup
     */
    public function check_before_delete($input = array()){
        if(isset($input['where']) && $input['where']){
            $this->db->where($input['where']);
            $query = $this->db->get($this->_table)->num_rows();
            if($query > 0){
                return false;
            }else{
                return true;
            }
        }
    }


}
?>