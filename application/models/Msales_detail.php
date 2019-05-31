<?php
class Msales_detail extends CI_Model
{
    protected $_table = 'sales_detail';
    public function __construct()
    {
        parent::__construct();

    }

    public function delete($id){
        $this->db->where('sale_id', $id);
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
    public function get_sale_detail($sale_id){
        $this->db->select('c.id as cus_id, c.name, c.email, c.phone,c.phone2,c.address, c.level_id, c.link_tracking, c.service_id, c.marketer_id, c.source_id,
        c.telesale_id, c.note as note_customer,c.create_at, c.status, s.id as sale_id, s.customer_id, s.status_care_id, s.note as note_sale, s.opening_date, s.duration, s.deposit, s.contract');
        $this->db->from('sales_overview s');
        $this->db->join('customers c','s.customer_id = c.id','inner');
        $this->db->where('s.id',$sale_id);
        $query = $this->db->get()->row_array();
        return $query;
    }

    /*
     * list detail
     */
    public function get_all_sales_detail($sale_id){
        $this->db->select('sd.id, s.id as sale_id, sd.create_at, sd.level_history, sd.status_history, sd.time_callback,sd.is_action, sd.content,
        s.note as note_sale, c.telesale_id');
        $this->db->from('sales_overview s');
        $this->db->join('sales_detail sd','s.id = sd.sale_id','inner');
        $this->db->join('customers c','s.customer_id = c.id','inner');
        $this->db->where('sd.sale_id',$sale_id);
        $this->db->order_by('sd.create_at','');
        $query = $this->db->get()->result_array();
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