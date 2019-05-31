<?php
class Binance_coin
{
    public function get_list_coin($type, $filter=array())
    {
        $CI =& get_instance();
        $CI->load->model('Mbinance');

        return $CI->Mbinance->get_list_coin($type, $filter);
    }
}
?>