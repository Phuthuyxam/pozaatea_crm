<?php
class Sidebar_widget extends PVS_Widget
{
    function index()
    {
        $data = array();
        $this->load->model('Mhome');

        $global_data = $this->Mhome->get_data_coin_global();

        $data['marketData'] = $global_data['market_data'];
        $data['volume_binance_val'] = $global_data['volume_binance'];
        $data['volume_bittrex_val'] = $global_data['volume_bittrex'];
        $data['volume_kucoin_val'] = $global_data['volume_kucoin'];
        $this->load->view('view', $data);
    }
}
?>