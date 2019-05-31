<?php
class Images_widget extends PVS_Widget
{
    function index()
    {
        $data = array();

        $this->load->model('admin/Mhome');
        $data['all_image'] = $this->Mhome->get_all_images();
        $this->load->view('view', $data);
    }
}
?>