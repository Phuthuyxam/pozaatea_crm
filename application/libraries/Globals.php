<?php
class Globals
{
    public function get_message($type, $title, $content)
    {
        ?>
        <script>
            jQuery.msgBox({
                title: "<?php echo $title; ?>",
                content:"<?php echo $content; ?>",
                type:"<?php echo $type; ?>"
            });
        </script>
        <?php
    }

    public function get_dateformat($strDate, $format)
    {
        $date=date_create($strDate);
        return date_format($date, $format);
    }

    public function sendMail($to, $subject, $content)
    {
        require_once(APPPATH.'libraries/phpmailer/class.phpmailer.php');
        require_once(APPPATH.'libraries/phpmailer/class.smtp.php');
        $mail = new PHPMailer();


        $mail->IsSMTP(); // set mailer to use SMTP


        $mail->Host='smtp.gmail.com';
        $mail->Port = '587'; // set the port to use
        $mail->SMTPAuth = true; // turn on SMTP authentication

        $mail->SMTPSecure='tls';
        $mail->Username = 'n4m.nv.1997@gmail.com'; // your SMTP username or your gmail username
        $mail->Password = 'rublvpsglaycrgyc'; // your SMTP password or your gmail password
        //$mail->Timeout = 3600;

        $mail->From = 'n4m.nv.1997@gmail.com';
        $mail->FromName = 'sys';
        // Name to indicate where the email came from when the recepient received
        $mail->AddAddress($to);
        $mail->CharSet = 'UTF-8';
        $mail->WordWrap = 50; // set word wrap
        $mail->IsHTML(true); // send as HTML
        $mail->Subject = $subject;
        $mail->Body = $content; //HTML Body

        $mail->SMTPDebug =2;
        if(!$mail->Send())
        {
            return false;
            echo 'gửi chưa thành công';
        }
        else
        {
            return true;
            echo 'gửi thành công';
        }
    }

    public function to_slug($str)
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '_', $str);
        return $str;
    }

    public function get_meta_value_customers($meta_key, $customer_id)
    {
        $CI =& get_instance();
        $CI->load->model('Mmeta_customers');
        $row = $CI->Mmeta_customers->get_meta_value_customers($meta_key, $customer_id);
        return $row['value'];
    }

    public function get_group_permission($group_id, $module){
        if($group_id && $module){
            $CI =& get_instance();
            $CI->load->model('Mpermissions');
            $arr_per = $CI->Mpermissions->get_group_permission($group_id, $module);
            $arr_per = json_decode($arr_per['content'], true);
            return $arr_per;
        }

    }



    /*
     * get level
     */

    public function get_level($id)
    {
        $CI =& get_instance();
        $CI->load->model('Mlevel');
        return $CI->Mlevel->get_level($id);
    }

    /*
     * get all level
     */
    public function get_all_level(){
        $CI =& get_instance();
        $CI->load->model('Mlevel');
        return $CI->Mlevel->get_all_level();
    }

    /*
     * get level max
     */
    public function get_level_max(){
        $CI =& get_instance();
        $CI->load->model('Mlevel');
        $list_all =  $CI->Mlevel->get_all_level();
        $levelmax = 0;
        foreach ($list_all as $item){
            if($item['name'] > $levelmax){
                $levelmax = $item['name'];
            }
        }
        return $levelmax;
    }

    /*
     * get service
     */

    public function get_service($id)
    {
        $CI =& get_instance();
        $CI->load->model('Mservices');
        return $CI->Mservices->get_service($id);
    }

    /*
     * get all group
     */
    public function get_all_services(){
        $CI =& get_instance();
        $CI->load->model('Mservices');
        return $CI->Mservices->get_all_services();
    }

    /*
     * get group
     */

    public function get_group($id)
    {
        $CI =& get_instance();
        $CI->load->model('Mgroups');
        return $CI->Mgroups->get_group($id);
    }

    /*
     * get all group
     */
    public function get_all_groups(){
        $CI =& get_instance();
        $CI->load->model('Mgroups');
        return $CI->Mgroups->get_all_groups();
    }


    /*
     * get source
     */
    public function get_source($id){
        $CI =& get_instance();
        $CI->load->model('Msources');
        return $CI->Msources->get_source($id);
    }

    /*
     * get all source
     */
    public function get_all_sources(){
        $CI =& get_instance();
        $CI->load->model('Msources');
        return $CI->Msources->get_all_sources();
    }

    /*
     * get user
     */
    public function get_user($id){
        $CI =& get_instance();
        $CI->load->model('Musers');
        return $CI->Musers->get_user($id);
    }

    /*
     * get all source
     */
    public function get_all_users(){
        $CI =& get_instance();
        $CI->load->model('Musers');
        return $CI->Musers->get_all_users();
    }

    /*
     * get channel
     */
    public function get_channel($id){
        $CI =& get_instance();
        $CI->load->model('Mchannel');
        return $CI->Mchannel->get_channel($id);
    }

    /*
     * get all
     */
    public function get_all_channel(){
        $CI =& get_instance();
        $CI->load->model('Mchannel');
        return $CI->Mchannel->get_all_channel();
    }

    /*
     * get status
     */
    public function get_status_care($id){
        $CI =& get_instance();
        $CI->load->model('Mstatus_care');
        return $CI->Mstatus_care->get_status_care($id);
    }

    /*
    * get all status
    */
    public function get_all_status_care(){
        $CI =& get_instance();
        $CI->load->model('Mstatus_care');
        return $CI->Mstatus_care->get_all_status_care();
    }

    /*
    * get status
    */
    public function get_status_process($id){
        $CI =& get_instance();
        $CI->load->model('Mstatus_process');
        return $CI->Mstatus_process->get_status_process($id);
    }

    /*
    * get all status
    */
    public function get_all_status_process(){
        $CI =& get_instance();
        $CI->load->model('Mstatus_process');
        return $CI->Mstatus_process->get_all_status_process();
    }

    /*
    * get customers
    */
    public function get_customer($id){
        $CI =& get_instance();
        $CI->load->model('Mcustomers');
        return $CI->Mcustomers->get_customer($id);
    }

    /*
    * get all customers
    */
    public function get_all_customers(){
        $CI =& get_instance();
        $CI->load->model('Mcustomers');
        return $CI->Mcustomers->get_all_customers();
    }

    /*
     * get customers by is_sale
     */
    public function get_customers_is_sale($telesale_id){
        $CI =& get_instance();
        $CI->load->model('Mcustomers');
        $arr_cus = $CI->Mcustomers->get_customers_is_sale($telesale_id);
        $arr_new = array();
        foreach ($arr_cus as $key=>$value){
            foreach ($value as $value_new){
                $arr_new[$key] = $value_new;
            }
        }
        return $arr_new;
    }

    public function get_customers_is_sale_detail($sale_id){
        $CI =& get_instance();
        $CI->load->model('Mcustomers');
        $arr_cus = $CI->Msales_overview->get_customers_is_sale_detail($sale_id);
        return $arr_cus['customer_id'];
    }

    /*
     * get_all_attr_users
     */
    public function get_all_attr_users(){
        $CI =& get_instance();
        $CI->load->model('Mattr_users');
        return $CI->Mattr_users->get_all_attr_users();
    }



    /*
     * get_all_attr
     */
    public function get_all_attr_customers(){
        $CI =& get_instance();
        $CI->load->model('Mattr_customers');
        return $CI->Mattr_customers->get_all_attr_customers();
    }


    /*
     * get_care_id
     */
    public function get_care_id($sale_id){
        $CI =& get_instance();
        $CI->load->model('Mcare_overview');
        $care = $CI->Mcare_overview->get_care_id($sale_id);
        return $care['id'];
    }
    public function get_design_id($sale_id){
        $CI =& get_instance();
        $CI->load->model('Mdesign_overview');
        $design = $CI->Mdesign_overview->get_design_id($sale_id);
        return $design['id'];
    }
    public function get_accountant_id($sale_id){
        $CI =& get_instance();
        $CI->load->model('Maccountant_overview');
        $accountant = $CI->Maccountant_overview->get_accountant_id($sale_id);
        return $accountant['id'];
    }
    public function get_support_id($sale_id){
        $CI =& get_instance();
        $CI->load->model('Msupport_overview');
        $support = $CI->Msupport_overview->get_support_id($sale_id);
        return $support['id'];
    }

    /*
     * import data
     */
    public function importData($data = array()){
        $CI =& get_instance();
        $CI->load->model('Mimport_excel');
        $flag = $CI->Mimport_excel->importData($data);
        return $flag;
    }

    // get all shop id 

    public function get_shop_id(){ 
        $CI =& get_instance();
        $CI->load->model('Mshops');
        $result = $CI->Mshops->get_all_shops();
        return $result;
    }

    // get all shop id 

    public function get_shop_by_customer_id($cus_id){
        $CI =& get_instance();
        $CI->load->model('Mcustomershop');
        $result = $CI->Mcustomershop->get_by_customer_id($cus_id);
        return $result;
    }



}
?>