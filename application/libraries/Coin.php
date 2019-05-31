<?php
class Coin
{
    public function get_list_coin($type, $start_volume = '', $end_volume = '', $buy_sell = '')
    {
        $CI =& get_instance();
        $CI->load->model('Mhome');

        $filter = array();

       
        if (!empty($start_volume) && !empty($end_volume))
            {
                $filter['volume>='] = $start_volume;
                $filter['volume<='] = $end_volume;
            }

        if (!empty($buy_sell))
            {
                $filter['rate_buy_sell>='] = $buy_sell;
            }

        return $CI->Mhome->get_list_coin($type, $filter);
    }
}
?>