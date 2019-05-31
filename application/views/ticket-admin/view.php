<?php
require_once(APPPATH.'views/header.php');
require_once(APPPATH.'views/sidebar.php');
?>
<!-- check permission group -->
<?php
$arr_permission_check = $this->globals->get_group_permission($user_info['group_id'], 'setup');
?>
<!-- check permission -->
<?php if($arr_permission_check): ?>
<!-- check quyen view -->
<?php if(in_array("view", $arr_permission_check)): ?>
<div class="row small-spacing">
    <div class="col-xs-12">
        <div class="box-content">
            <!-- hien thi thong bao o day -->
            <?php
            //hien thi thong bao thanh cong
            if($this->session->flashdata('msg_users_success')){
                ?>
                <div class="alert alert-success" role="alert">
                    <strong>Success!</strong> <?php echo $this->session->flashdata('msg_users_success'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
            }
            //hien thi thong bao khong thanh cong
            if($this->session->flashdata('msg_users_error')){
                ?>
                <div class="alert alert-warning" role="alert">
                    <strong>Error!</strong> <?php echo $this->session->flashdata('msg_users_error'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
            }
            ?>


            <!-- /.dropdown js__dropdown -->
            <div class="container">
            <h3 class=" text-center">Tickets</h3>
            <div class="messaging">
                <div class="inbox_msg">
                    <div class="mesgs">
                    <!-- content  -->
                    <div class="msg_history">

                        <?php
                        $id = intval($this->uri->rsegment(3));

                        $ticket_info = $this->globals->get_ticket($id);
                        $customer_info = $this->globals->get_customer($ticket_info['customer_id']);

                        if(isset($all_ticket) && !empty($all_ticket)):
                            foreach($all_ticket as $key => $item):  
                                
                        ?>

                        <!-- nếu k tồn tại user -->

                        <?php if($item['user_id'] > 0): ?>
                            
                        <div class="outgoing_msg">
                            <div class="sent_msg">
                                <p><?php echo $item['content'] ?></p>
                                <span class="time_date">
                                   <b><?php $curent_user_info = $this->globals->get_user($item['user_id']); echo $curent_user_info['fullname']; ?> </b> | <?php echo $item['create_at']; ?>
                                </span> 
                            </div>
                        </div>

                        <?php else: ?>
                            <div class="incoming_msg">


                                <div class="incoming_msg_img"> 
                                    <span>
                                        <?php echo $customer_info['name'] ;?>

                                    </span> 
                                </div>


                                <div class="received_msg">
                                    <div class="received_withd_msg">
                                    <p>
                                    
                                        <?php echo $item['content']; ?>
                                    </p>
                                    <span class="time_date">
                                   
                                        <?php echo $item['create_at']; ?>
                                    </span></div>
                                </div>
                            </div>
                            <!--  -->
                        <?php endif; ?>
                        <?php endforeach; endif; ?>

                    </div>

                    <!-- end content -->
                    <div class="type_msg">
                        <form class="input_msg_write" method="post" action="">
                            <input type="text" class="write_msg" name="mess" placeholder="Nội dung trả lời" />
                            <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                        </form>
                    </div>

                    </div>
                </div>
                
                
                </div>
            </div>
            



        </div>
        <!-- /.box-content -->
    </div>
    <!-- /.col-xs-12 -->
</div>
    <?php else:?>
        <div class="content-wrapper" style="padding-top: 74px; text-align: center">
            <div class="alert alert-warning">Bạn không có quyền truy cập chức năng</div>
        </div>
    <?php endif; endif; ?>
<!-- end check permission -->
<?php
require_once(APPPATH.'views/footer.php');
?>
