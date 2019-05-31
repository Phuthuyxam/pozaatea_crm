<?php
class Maccountant_detail extends CI_Model
{
    protected $_table = 'accountant_detail';
    public function __construct()
    {
        parent::__construct();

    }


    public function delete($id){
        $this->db->where('account_id', $id);
        $this->db->delete($this->_table);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }

    //=================== phan danh cho detail =======================================
    /*
     * get sales detail
     */
    public function get_accountant_detail($sale_id){
        $this->db->select('c.id as cus_id, c.name, c.email, c.phone,c.phone2,c.address, c.level_id, c.link_tracking, c.service_id, c.marketer_id, c.source_id,
        c.telesale_id, c.note as note_customer,c.create_at, c.status, s.id as sale_id, s.customer_id, s.status_care_id, s.note as note_sale, s.opening_date, s.duration, s.deposit, s.contract,
        acc.id as account_id, acc.create_at as time_up');
        $this->db->from('sales_overview s');
        $this->db->join('customers c','s.customer_id = c.id','inner');
        $this->db->join('accountant_overview acc','s.id = acc.sale_id','inner');
        $this->db->where('acc.sale_id',$sale_id);
        $query = $this->db->get()->row_array();
        return $query;
    }

    /*
     * list detail
     */
    public function get_all_accountant_detail($account_id){
        $this->db->where('account_id', $account_id);
        $this->db->order_by('create_at','DESC');
        $query = $this->db->get($this->_table)->result_array();
        return $query;
    }

    /*
     * insert dung chung cho overview, detail
     */

    public function insert($data){
        $this->db->insert($this->_table, $data);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
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

    public function update_detail($detail_id, $data){
        $this->db->where('id', $detail_id);
        $this->db->update($this->_table, $data);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }

    public function delete_detail($input = array()){
        $this->db->where($input);
        $this->db->delete($this->_table);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }

}
?>